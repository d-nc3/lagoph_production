<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_notifications_model extends CI_Model 
{
    private $_table_name = 'user_notifications';

    function __construct() {

        parent::__construct();
    }

    # ** Default Routines Here ** #
    public function get_all() {

		return $this->db->where('deleted_at', null)
			->get($this->_table_name)
			->result_array();
	}

    public function get($id) {

		return $this->db->where('id', $id)
            ->where('deleted_at', null)
			->get($this->_table_name)
			->row_array();
	}

	public function insert($data) {

		$this->db->insert($this->_table_name, $data);
		return $this->db->insert_id();
	}

	public function update($data, $id) {

		$this->db->where('id', $id)
            ->where('deleted_at', null)
			->update($this->_table_name, $data);

		return $id;
	}

	public function delete($data, $id) {

		$this->db->where('id', $id)
            ->where('deleted_at', null)
			->update($this->_table_name, $data);

		return $id;
	}

	# ** Customized Routines Here ** #
    public function get_top_by_user_id($user_id) {

		return $this->db->where('deleted_at', null)
			->where('user_id', $user_id)
			->order_by('created_at', 'desc')
			->limit(10)
			->get($this->_table_name)
			->result_array();

	}

	public function count_new_notification($user_id) {
		return $this->db->where('deleted_at', null)
			->where('user_id', $user_id)
			->where('is_read', 0)
			->get($this->_table_name)
			->result_array();

	}

	public function get_unread_by_user_id($user_id) {

		return $this->db->where('deleted_at', null)
			->where('user_id', $user_id)
			->where('is_read', 0)
			->order_by('created_at', 'desc')
			->get($this->_table_name)
			->result_array();
	}

	public function get_new_by_user_id($user_id) {
		return $this->db->where('deleted_at', null)
			->where('user_id', $user_id)
			->where('is_read', 1)
			->order_by('created_at', 'desc')
			->get($this->_table_name)
			->result_array();
	}
}
?>