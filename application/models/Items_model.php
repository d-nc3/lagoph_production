
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items_model extends CI_Model {

    protected $_table = 'items';

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


    public function delete($id) {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    // customized routines:

    public function get_by_category($id){
       return $this->db->where('transaction_category_id', $id)
                 ->where('deleted_at', NULL)
                 ->get($this->_table)
                 ->row_array();
    }



}
?>