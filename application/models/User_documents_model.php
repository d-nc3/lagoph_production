
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_documents_model extends CI_Model {

    protected $_table = 'user_documents';

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

    public function list_by_user($id) {
        return $this->db->where('deleted_at', null)
                        ->where('user_id', $id)
                        ->get($this->_table)
                        ->result_array();
    }

    public function list_by_user_profile($id,$doc_type) {
        return $this->db->where('deleted_at', null)
                        ->where('user_id', $id)
                        ->where('document_type', $doc_type)
                        ->get($this->_table)
                        ->row_array();
    }
}
?>