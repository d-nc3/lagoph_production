<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        //User related data
        $this->load->model('Users_model','M_users');

        //Email related data
        $this->load->model('Email_verifications_model','M_email_verifications');
        $this->load->model('User_referrals_model','M_referrals');

        $this->_create_additional = array(
            'created_by' => isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,
            'created_at' => NOW
        );

        $this->_update_additional = array(
            'updated_by' => isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,
            'updated_at' => NOW
        );

        $this->_delete_additional = array(
            'deleted_by' => isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,
            'deleted_at' => NOW
        );
    }

    public function verify() {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $referral_code = $this->M_referrals->get_by_code($post_data['ref']);
            if (empty($referral_code)) {
                return $this->_send_json_response(FALSE, 'Referral link has already expired. Please ask for a new one.');
            }
    
            $rules = [
                ['field' => 'multiStepsEmail', 'label' => 'Email', 'rules' => 'required|valid_email'],
                ['field' => 'multiStepsCode', 'label' => 'Code', 'rules' => 'required|min_length[6]|max_length[6]'],
            ];
            
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $validation_errors = $this->form_validation->error_array();
                return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
            } 
    
            $email = $post_data['multiStepsEmail'];
            $code = $post_data['multiStepsCode'];
    
            $user = $this->M_users->get_user_by_email($email);
            if (empty($user)) {
                return $this->_send_json_response(FALSE, 'User not found. Please register first.');
            }
    
            $user_verification = $this->M_email_verifications->verify($user['id'], $code);
            if (empty($user_verification)) {
                return $this->_send_json_response(FALSE, 'Incorrect verification code! Please try again.');
            }
            
            try {
                $this->db->trans_start();
        
                // Update user status to active
                if (!$this->M_users->update($user['id'], ['status' => 'active'] + $this->_update_additional)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'Failed to verify your email.');
                }
        
                // Update verification record
                if (!$this->M_email_verifications->update($user_verification['id'], $this->_update_additional)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'Failed to verify your email.');
                }
        
                // Update referral status
                if (!$this->M_referrals->update($referral_code['id'], ['to_user_id ' => $user['id'], 'status' => 'processing'] + $this->_update_additional)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'Failed to verify your email.');
                }
                
              
                $this->db->trans_commit();
                return $this->_send_json_response(TRUE, 'Email verified successfully!');
            } catch (DatabaseException $e) {
                // Handle database-related exceptions (e.g., constraint violation)
                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            } catch (Exception $e) {
                // Handle other types of exceptions
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }
        }
    
        return $this->_send_json_response(FALSE, 'Incorrect verification code! Please try again.');
    }

    public function resend() {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $rules = [
                ['field' => 'multiStepsEmail', 'label' => 'Email', 'rules' => 'required|valid_email']
            ];
    
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $validation_errors = $this->form_validation->error_array();
                return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
            } 
            
            $email = $post_data['multiStepsEmail'];
            $user = $this->M_users->get_user_by_email($email);
            if (!$user || $user['status'] == 'active') {
                return $this->_send_json_response(FALSE, 'Email verification sending failed. Please contact your technical support.');
            }
    
            $code = mt_rand(100000, 999999);
            $email_verification = $this->M_email_verifications->get_by_user($user['id']);
            try {
                if($email_verification) {
                    $this->M_email_verifications->update($email_verification['id'], ['code' => $code] + $this->_update_additional);
                } else {
                    $this->M_email_verifications->insert(['code' => $code] + $this->_create_additional);
                }
                return $this->_send_json_response(TRUE, 'A new verification code has been sent to your email!');
            } catch (DatabaseException $e) {
                // Handle database-related exceptions (e.g., constraint violation)
                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            } catch (Exception $e) {
                // Handle other types of exceptions
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }
        }
        return $this->_send_json_response(FALSE, 'Email verification sending failed. Please contact your technical support.');
    }
    

    private function _format_validation_errors($rules, $validation_errors) 
    {
        $formatted_errors = [];
        foreach ($validation_errors as $field => $error) {
            foreach ($rules as $rule) {
                if ($rule['field'] === $field) {
                    $formatted_errors[$field] = [
                        'label' => $rule['label'],
                        'message' => $error
                    ];
                    break;
                }
            }
        }
        return $formatted_errors;
    }

    private function _send_json_response($status, $message, $additional_data = [])
    {
        $response = array_merge(['status' => $status, 'message' => $message], $additional_data);
        exit(json_encode($response));
    }
}
