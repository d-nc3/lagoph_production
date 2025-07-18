<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_attendees_model extends CI_Model {

    protected $_table = 'event_attendees';
    protected $users = 'users';

    public function get_all() {
        return $this->db->where('deleted_at', null)
                        ->get($this->_table)
                        ->result_array();
    }


    public function get($id) {
        return $this->db->where('user_id', $id)
                        ->where('deleted_at', NULL)
                        ->get($this->_table)
                        ->row_array();
    }

    public function get_by_id($id) {
        return $this->db->where('id', $id)
                        ->get($this->_table)
                        ->row_array();
    }

    public function get_event_details($id){ 
        return $this->db->select('A.*, B.*')
        ->from($this->_table . ' AS A')
        ->join('events as B', 'A.event_id = B.id', 'left')
        ->where('A.deleted_at', NULL)
        ->where('A.user_id', $id)
        ->get()
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

    public function get_by_user($id) {
        return $this->db->where('user_id', $id)
                        ->where('deleted_at', null)
                        ->where('status', 'Processing')
                        ->get($this->_table)
                        ->row_array();
    }

    public function get_events() {
        return $this->db
            ->select('A.*, B.*')
            ->from($this->_table . ' AS A')
            ->join('events as B', 'A.event_id = B.id', 'left')
            ->where('A.deleted_at', NULL)
            ->get()
            ->result(); // This returns the query result as an array of objects
    }
    

}
?>
