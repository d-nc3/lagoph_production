
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_permissions_model extends CI_Model {

    protected $_table = 'role_permissions';

    public function get_all() {
        return $this->db->where('deleted_at', null)
                        ->get($this->_table)
                        ->result_array();
    }

    public function get($id) {
        return $this->db->where('id', $id)
                        ->where('deleted_at', null)
                        ->get($this->_table)
                        ->row_array();
    }

    public function insert($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }
    public function insert_batch($data) {
        if (!empty($data) && is_array($data)) {
            return $this->db->insert_batch($this->_table, $data);
        } 
        return false;
    }


    public function update($id, $data) {
        $this->db->where('id', $id)
                 ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function get_by_name($role_name) {

        return $this->db->where('deleted_at', null)
            ->where('role_name', $role_name)
            ->get($this->_table)
            ->row_array();
    }
   

    public function delete($id, $data) {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
                 ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function get_with_filters($filters = array()) {
        $this->db->from($this->_table)
                ->where('deleted_at', null);
        
        if (!empty($filters)) {
            if (isset($filters['status'])) {
                $this->db->where('status', $filters['status']);
            }
        }
        
        return $this->db->get()->result_array();
    }

    public function get_user_by_email($email){ 
        return $this->db->where('email', $email)
                        ->where('deleted_at', null)
                        ->get($this->_table)
                        ->row_array();

    }


    //** Customized Routines *//

    public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL) {
        $this->db->select('A.role_id, B.role_name, GROUP_CONCAT(C.permission_name ORDER BY C.permission_name) AS permission_name');
        $this->db->from('role_permissions AS A');
        $this->db->join('roles AS B', 'A.role_id = B.id', 'left');
        $this->db->join('permissions AS C', 'A.permissions_id = C.id', 'left');
        $this->db->where('A.deleted_at', null);
        $this->db->where('B.deleted_at', null);
        $this->db->where('C.deleted_at', null);
    

        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('B.role_name', $filters['search']);
                $this->db->like('C.permission_name', $filters['search']);
                $this->db->group_end();
            }
        }
    
   
        $this->db->group_by('A.role_id');
    
        // Apply ordering if present
        if (isset($order)) {
            $column = $order[0]['column'];
            $dir = $order[0]['dir'];
            $this->db->order_by($column, $dir);
        }
    

        if (isset($start) && isset($length) && $length > 0) {
            $this->db->limit($length, $start);
        }
    
        $query = $this->db->get();
        return $query->result();
    }
    
    public function count_all() {
        return $this->db->count_all($this->_table);
    }
    public function count_filtered($filters = NULL) {
        $this->db->select('A.role_id, B.role_name, GROUP_CONCAT(C.permission_name ORDER BY C.permission_name) AS permission_name');
        $this->db->from($this->_table . ' AS A');
        $this->db->join('roles AS B', 'A.role_id = B.id', 'left');
        $this->db->join('permissions AS C', 'A.permissions_id = C.id', 'left');
        $this->db->where('A.deleted_at', null);
        $this->db->where('B.deleted_at', null);
        $this->db->where('C.deleted_at', null);
    

        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                    $this->db->like('B.role_name', $filters['search']);
                    $this->db->or_like('C.permission_name', $filters['search']); 
                $this->db->group_end();
            }
        }
    
       
        $this->db->group_by('A.role_id');
    
     
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    
}
?>
