
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_accounts_model extends CI_Model {

    protected $_table = 'cash_accounts';

    public function get_all() {
        return $this->db->where('deleted_at', null)
                        ->get($this->_table)
                        ->result_array();
    }

    public function get($id) {
        return $this->db->where('id', $id)
                        ->where('deleted_at', null)
                        ->where('status', 'Processing')
                        ->get($this->_table)
                        ->row_array();
    }

    public function insert($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id)
                ->where('status', 'Processing')
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    public function delete($id) {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
                ->where('status', 'Processing')
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function get_by_user($id) {
        return $this->db->where('user_id', $id)
                        ->where('deleted_at', null)
                        ->where('status', 'Processing')
                        ->get($this->_table)
                        ->row_array();
    }

   

}
?>