<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->model('Users_model','M_users');
		$this->load->model('Email_verifications_model','M_email_verifications');
		$this->load->model('User_referrals_model','M_referrals');
		

		$this->_create_additional = array(
			'created_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
			'created_at' => NOW
		);

		$this->_update_additional = array(
			'updated_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
			'updated_at' => NOW
		);

		$this->_delete_additional = array(
			'deleted_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
			'deleted_at' => NOW
		);
    }

	public function index()
	{
		$data['page_data'] = [
			'system_module' => '',
			'system_section' => '',
			'title' => 'Register',
			'styles_path' => [
				'assets/vendor/libs/bs-stepper/bs-stepper.css',
				'assets/vendor/css/pages/page-auth.css'
			],
			'scripts_path' => [
				'assets/js/register/index.js'
			]
		];

		if ($post_data = $this->security->xss_clean($this->input->post())) {
			$referral = $this->M_referrals->get_by_code($post_data['ref']);
            if (!$referral) {
                exit(json_encode([
					'status' => FALSE,
					'message' => 'Referral link has already expired. Please ask for new.'
				]));
            }

			// Validation rules for email, password, and confirm password
			$rules = array(
				['field' => 'multiStepsEmail', 'label' => 'Email', 'rules' => 'required|valid_email'],
				['field' => 'multiStepsPass', 'label' => 'Password', 'rules' => 'required|min_length[6]'],
				['field' => 'multiStepsConfirmPass', 'label' => 'Confirm Password', 'rules' => 'required|matches[multiStepsPass]'],
			);
		
			// Set validation rules
			$this->form_validation->set_rules($rules);
			
			// Check if the email exists and is active
			$user = $this->M_users->unique($post_data['multiStepsEmail']);
			if ($user) {
				if ($user['status'] == 'active') {
					// If email is already registered and active, return an error
					exit(json_encode([
						'status' => FALSE,
						'message' => 'The email is already registered.'
					]));
				} elseif ($user['status'] == 'inactive') {
					// If email is already registered but inactive, update email verification code and exit
					$code = mt_rand(100000, 999999);
					// Verify if email verification already exists, then update
					$email_verification = $this->M_email_verifications->get_by_user($user['id']);
						if($email_verification) {
						$email_verification_data = array(
							'code' => $code,
							'updated_at' => NOW,
							'updated_by' => $post_data['multiStepsEmail']
						);

						$this->M_email_verifications->update($email_verification['id'], $email_verification_data);
					} else {
						$email_verification_data = array(
							'code' => $code,
							'created_at' => NOW,
							'created_by' => $post_data['multiStepsEmail']
						);

						$this->M_email_verifications->insert($email_verification_data);
					}
					// Exit with success message
					exit(json_encode([
						'status' => TRUE,
						'message' => 'A new verification code has been sent to your email!'
					]));
				}
			}
		
			// Run form validation
			if ($this->form_validation->run() == FALSE) {
				// If validation fails, return validation errors
				$validation_errors = $this->form_validation->error_array();
				$formatted_errors = [];
				foreach ($validation_errors as $field => $error) {
					foreach ($rules as $rule) {
						if ($rule['field'] === $field) {
							$formatted_errors[$field] = [
								'label' => $rule['label'], // Get label from rules array
								'message' => $error, // Get error message from validation errors
							];
							break;
						}
					}
				}

				exit(json_encode([
					'status' => FALSE,
					'message' => 'Validation Error!',
					'validation_errors' => $formatted_errors,
				]));
			} else {
				try {
					$email = $post_data['multiStepsEmail'];
					$password =  $post_data['multiStepsPass'];
					$hashed_password = password_hash($password, PASSWORD_DEFAULT);
			
					// Start a transaction
					$this->db->trans_start();
			
					$user_data = array(
						'email' => $email,
						'password' => $hashed_password,
						'status' => 'inactive',
						'created_at' => NOW,
						'created_by' => $email
					);
			
					// Attempt to insert user
					$user_id = $this->M_users->insert($user_data);
			
					if ($user_id) {
						$code = mt_rand(100000, 999999);
			
						$email_verification_data = array(
							'user_id' => $user_id,
							'code'=> $code,
							'created_at' => NOW,
							'created_by' => $email
						);
			
						// Attempt to insert email verification
						if ($this->M_email_verifications->insert($email_verification_data)) {
							if ($this->M_referrals->update($referral['id'], ['to_user_id' => $user_id, 'updated_at' => NOW, 'updated_by' => $email])) {
								// If both insertions are successful, commit the transaction
								$this->db->trans_commit();
								// Exit with success message
								exit(json_encode([
									'status' => TRUE,
									'message' => 'A verification code has been sent to your email!'
								])); 
							} else throw new Exception('Failed to send verification code.');
						} else throw new Exception('Failed to send verification code.');
					} else throw new Exception('Failed to insert user data.');
				} catch (Exception $e) {
					$this->db->trans_rollback();
					exit(json_encode([
						'status' => FALSE,
						'message' => $e->getMessage()
					]));
				}
			}
		}

		$this->load->view('pages/register/index', $data);
	}
}
