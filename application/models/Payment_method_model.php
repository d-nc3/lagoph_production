
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_method_model extends CI_Model {

    protected $_table = 'payment_methods';


  
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

    public function delete($id, $data) {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
                ->where('deleted_at', null)
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    
    public function get_by_mode($mode) {
        return $this->db->where('deleted_at', null)
                        ->where('account_type_id', $mode)
                        ->get($this->_table)
                        ->result_array();
    }

 
    public function get_online_method() {
        $types = ['Bank', 'E-wallet']; 
        return $this->db->where_in('type', $types) 
            ->get($this->_table)
            ->result_array();
    }
}