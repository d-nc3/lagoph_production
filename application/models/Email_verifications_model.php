<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_verifications_model extends CI_Model {

    protected $_table = 'email_verifications';

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

    public function verify($user_id, $code) {
        return $this->db->where('user_id', $user_id)
                        ->where('code', $code)
                        ->where('deleted_at', null)
                        ->get($this->_table)
                        ->row_array();
    }

    public function get_by_user($user_id) {
        return $this->db->where('user_id', $user_id)
                        ->where('deleted_at', null)
                        ->get($this->_table)
                        ->row_array();
    }

    public function get_with_filters($filters = array()) {
        $this->db->from($this->_table)
                ->where('deleted_at', null);

        if (!empty($filters)) {
            if (isset($filters['user_id'])) {
                $this->db->where('user_id', $filters['user_id']);
            }
        }
        
        if (!empty($filters)) {
            if (isset($filters['code'])) {
                $this->db->where('code', $filters['code']);
            }
        }
        
        return $this->db->get()->result_array();
    }

    
}
?>
