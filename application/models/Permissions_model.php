
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions_model extends CI_Model {

    protected $_table = 'permissions';

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


    public function update($id, $data) {
        $this->db->where('id', $id)
                 ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function get_by_permission($permission_name) {

        return $this->db->where('deleted_at', null)
            ->where('permission_name', $permission_name)
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
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('deleted_at', null);


        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                    $this->db->like('first_name', $filters['search']);
                $this->db->group_end();
            }
            
       
        }

        // Order by
        if (isset($order)) {
            $column = $order[0]['column'];
            $dir = $order[0]['dir'];
            $this->db->order_by($column, $dir);
        }

        // Pagination
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
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('deleted_at', null);


        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                    $this->db->like('first_name', $filters['search']);
            
                $this->db->group_end();
            }
            
           
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
}
?>
