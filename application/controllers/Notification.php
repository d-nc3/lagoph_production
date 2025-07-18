<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{
	public function __construct() {
		
		parent::__construct();

		$this->load->model('User_notifications_model', 'M_user_notification');

		$this->_create_additional = array(
			'created_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['user_email'] : DEFAULT_ADMIN_USER_EMAIL,
			'created_at' => NOW
		);

		$this->_update_additional = array(
			'updated_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['username'] :  DEFAULT_ADMIN_USER_EMAIL,
			'updated_at' => NOW
		);

		$this->_delete_additional = array(
			'deleted_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['username'] :  DEFAULT_ADMIN_USER_EMAIL,
			'deleted_at' => NOW
		);
	}

	public function mark_read() {
		
		// check if there are submitted data
        if ($post_data = $this->input->post()) {

			$data = [   
				'is_read' => BOOL_YES,
				'read_at' => NOW
			] + $this->_update_additional;

			if (!$this->M_user_notification->update($data, $post_data['id'])) {
				exit(json_encode([
					'status' => 'RESULT_FAILED',
					'message' => 'Something went wrong! Please contact your technical support.'
				]));
			}

            // return Login success
			exit(json_encode([	
				'status' => 'RESULT_SUCCESS',
				'message' => 'Mark as read successfully!',
			]));
		}

		show_404();
		die();
	}

    public function mark_unread() {
		
		// check if there are submitted data
        if ($post_data = $this->input->post()) {

			$data = [
				'is_read' => BOOL_NO,
				'read_at' => null
			] + $this->_update_additional;

			if (!$this->M_user_notification->update($data, $post_data['id'])) {
				exit(json_encode([
					'status' => 'RESULT_FAILED',
					'message' => 'Something went wrong! Please contact your technical support.'
				]));
			}

            // return Login success
			exit(json_encode([	
				'status' => 'RESULT_SUCCESS',
				'message' => 'Mark as unread successfully!',
			]));
		}

		show_404();
		die();
	}
}
