<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Users_model', 'M_users');
    $this->load->model('Email_verifications_model', 'M_email_verifications');
    $this->load->model('User_referrals_model', 'M_referrals');

    $this->_create_additional = array(
      'created_by' => $this->session->userdata('user_info') ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
      'created_at' => NOW
    );

    $this->_update_additional = array(
      'updated_by' => $this->session->userdata('user_info') ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
      'updated_at' => NOW
    );

    $this->_delete_additional = array(
      'deleted_by' => $this->session->userdata('user_info') ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
      'deleted_at' => NOW
    );
    $this->_user_id = $this->session->userdata('user_id');
  }

  public function verify()
  {
    if ($post_data = $this->security->xss_clean($this->input->post())) {
      $referral = $this->M_referrals->get_by_code($post_data['ref']);
      if (empty($referral)) {
        return $this->_send_json_response(FALSE, 'Referral link has already expired. Please ask for new.');
      }

      $rules = [
        ['field' => 'multiStepsEmail', 'label' => 'Email', 'rules' => 'required|valid_email'],
        ['field' => 'multiStepsCode', 'label' => 'Code', 'rules' => 'required|min_length[10]|max_length[10]'],
      ];

      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == FALSE) {
        $validation_errors = $this->form_validation->error_array();
        $formatted_errors = $this->_format_validation_errors($validation_errors, $rules);
        return $this->_send_json_response(FALSE, 'Validation Error!', ['validation_errors' => $formatted_errors]);
      } else {
        return $this->_process_verification($post_data);
      }
    } else {
      return $this->_send_json_response(FALSE, 'Incorrect verification code! Please try again.');
    }
  }

  private function _process_verification($post_data)
  {
    $email = $post_data['multiStepsEmail'];
    $code = $post_data['multiStepsCode'];

    $user = $this->M_users->unique($email);

    if (!$user) {
      return $this->_send_json_response(FALSE, 'Incorrect verification code! Please try again.');
    }

    $user_verification = $this->M_email_verifications->verify($user['id'], $code);
    if (empty($user_verification)) {
      return $this->_send_json_response(FALSE, 'Incorrect verification code! Please try again.');
    }

    $this->db->trans_start();

    $user_data = [
      'status' => 'active',
      'updated_at' => NOW,
      'updated_by' => $email
    ];

    if (
      $this->M_users->update($user['id'], $user_data) &&
      $this->M_email_verifications->update($user_verification['id'], ['updated_at' => NOW, 'updated_by' => $email]) &&
      $this->M_referrals->update($referral['id'], ['status' => 'processing', 'updated_at' => NOW, 'updated_by' => $email])
    ) {

      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE) {
        return $this->_send_json_response(FALSE, 'Failed to verify your email.');
      } else {
        return $this->_send_json_response(TRUE, 'Email verified successfully!');
      }
    }
  }

  public function resend()
  {
    if ($post_data = $this->security->xss_clean($this->input->post())) {
      $rules = [['field' => 'multiStepsEmail', 'label' => 'Email', 'rules' => 'required|valid_email']];
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == FALSE) {
        $validation_errors = $this->form_validation->error_array();
        $formatted_errors = $this->_format_validation_errors($validation_errors, $rules);
        return $this->_send_json_response(FALSE, 'Validation Error!', ['validation_errors' => $formatted_errors]);
      } else {
        return $this->_process_resend($post_data);
      }
    } else {
      return $this->_send_json_response(FALSE, 'Email verification sending failed. Please try again.');
    }
  }

  private function _process_resend($post_data)
  {
    $email = $post_data['multiStepsEmail'];
    $user = $this->M_users->unique($email);
    if ($user) {
      if ($user['status'] == 'active') {
        return $this->_send_json_response(FALSE, 'The email is already registered.');
      } elseif ($user['status'] == 'inactive') {
        $code = random_int(100000, 999999);

        $email_verification = $this->M_email_verifications->get_by_user($user['id']);
        if ($email_verification) {
          $verification_data = [
            'code' => $code,
            'updated_at' => NOW,
            'updated_by' => $post_data['multiStepsEmail']
          ];
          return $this->_update_verification($email_verification['id'], $verification_data);
        } else {
          $verification_data = [
            'user_id' => $user['id'],
            'code' => $code,
            'created_at' => NOW,
            'created_by' => $post_data['multiStepsEmail']
          ];
          return $this->_insert_verification($verification_data);
        }
      }
    } else {
      return $this->_send_json_response(FALSE, 'Email verification sending failed. Please try again.');
    }
  }

  private function _update_verification($verification_id, $data)
  {
    if (!$this->M_email_verifications->update($verification_id, $data)) {
      return $this->_send_json_response(FALSE, 'Email verification sending failed. Please try again.');
    } else {
      return $this->_send_json_response(TRUE, 'A new verification code has been sent to your email!');
    }
  }

  private function _insert_verification($data)
  {
    if (!$this->M_email_verifications->insert($data)) {
      return $this->_send_json_response(FALSE, 'Email verification sending failed. Please try again.');
    } else {
      return $this->_send_json_response(TRUE, 'A new verification code has been sent to your email!');
    }
  }

  private function _format_validation_errors($validation_errors, $rules)
  {
    $formatted_errors = [];
    foreach ($validation_errors as $field => $error) {
      foreach ($rules as $rule) {
        if ($rule['field'] === $field) {
          $formatted_errors[$field] = [
            'label' => $rule['label'],
            'message' => $error,
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
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
}
