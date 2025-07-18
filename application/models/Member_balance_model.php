
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_balance_model extends CI_Model {

    protected $_table = 'member_balance';

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
        $this->db->where('user_id', $id)
                 ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function get_by_role($id) {

        return $this->db->where('deleted_at', null)
            ->where('id', $id)
            ->get($this->_table)
            ->result_array();
    }
   

    public function delete($id) {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
                 ->update($this->_table, $id);
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

    public function get_by_user_id($id){ 
        return $this->db->where('user_id', $id)
                        ->where('deleted_at', null)
                        ->get($this->_table)
                        ->row_array();

    }


    //** Customized Routines *//

    public function get_all_filtered($search, $order, $start, $length) {
        $this->db->select('A.*,B.status,B.date_issued');
        $this->db->from($this->_table . ' AS A');
        $this->db->join( 'cashiering_invoice AS B', 'B.user_id = A.id', 'left');
        // $this->db->where('A.id', 'B.user_id'); // Filtering by the user ID
        $this->db->where([
            'A.deleted_at' => NULL,
            'B.deleted_at'=>NULL,
           
        ]);
                
        // Search filter
        if (!empty($search['value'])) {
            $this->db->group_start();
                $this->db->like('first_name', $search['value']);
                $this->db->or_like('last_name', $search['value']);
            
            $this->db->group_end();
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

    public function count_filtered($search) {
        $this->db->select('A.*,B.status,B.date_issued');
        $this->db->from($this->_table . ' AS A');
        $this->db->join( 'cashiering_invoice AS B', 'B.user_id = A.id', 'left');
        $this->db->where([
            'A.deleted_at' => NULL,
            'B.deleted_at'=>NULL,
        ]);
 

        if (!empty($search['value'])) {
            $this->db->group_start();
            $this->db->like('first_name', $search['value']);
            $this->db->or_like('last_name', $search['value']);
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

}
?>
