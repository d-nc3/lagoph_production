<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // User related models
        $this->load->model('Users_model', 'M_users');
        $this->load->model('Email_verifications_model', 'M_email_verifications');
        $this->load->model('User_referrals_model', 'M_referrals');

        //User roles and permissions related models:
        $this->load->model('User_roles_model', 'M_user_roles');

        //helper 
        $this->load->helper('db_helper');

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

        $this->_user_id = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
    }

    public function index()
    {
        if ($get_data = $this->security->xss_clean($this->input->get())) {
            if (!isset($get_data['ref']) || empty($get_data['ref']) || !$this->M_referrals->get_by_code($get_data['ref'])) {
                show_404();
            }

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

            $this->session->set_userdata('ref', $get_data['ref']);
            $data['page_data']['ref'] = $get_data['ref'];
            $this->load->view('pages/register/index', $data);
        }

        if ($post_data = $this->security->xss_clean($this->input->post())) {
            try {
                $rules = [
                    ['field' => 'multiStepsFirstname', 'label' => 'First name', 'rules' => 'required'],
                    ['field' => 'multiStepsLastname', 'label' => 'Last name', 'rules' => 'required'],
                    ['field' => 'multiStepsEmail', 'label' => 'Email', 'rules' => 'required|valid_email|callback__validate_email_status'],
                    ['field' => 'multiStepsPass', 'label' => 'Password', 'rules' => 'required|min_length[6]'],
                    ['field' => 'multiStepsConfirmPass', 'label' => 'Confirm Password', 'rules' => 'required|matches[multiStepsPass]'],
                ];

                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }

                $email = $post_data['multiStepsEmail'];
                $first_name = $post_data['multiStepsFirstname'];
                $last_name = $post_data['multiStepsLastname'];
                $password = $post_data['multiStepsPass'];
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $this->db->trans_begin();

                if (!isset($post_data['ref']) || empty($post_data['ref']) || !$this->M_referrals->get_by_code($post_data['ref'])) {
                    show_404();
                }

                $user_id = $this->_manage_user_registration($email, $hashed_password, $first_name, $last_name);
                if (!$user_id) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
                }

                $code = mt_rand(100000, 999999);

                $email_verification_data = [
                    'user_id' => $user_id,
                    'code' => $code,
                    'created_at' => NOW,
                    'created_by' => $email
                ];
                // Insert verification code (ensure uniqueness)
                if (!$this->M_email_verifications->insert($email_verification_data)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'Error generating verification code.');
                }


                if (!$this->send_email($post_data, $code)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'Failed to send verification email.');
                }

                // Commit transaction
                $this->db->trans_commit();

                return $this->_send_json_response(TRUE, 'A verification code has been sent to your email!');
            } catch (DatabaseException $e) {
                // Handle database-related exceptions (e.g., constraint violation)
                $this->db->trans_rollback();
                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            } catch (Exception $e) {
                // Handle other types of exceptions
                $this->db->trans_rollback();
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }
        }

        // show_404();
    }

    private function _manage_user_registration($email, $hashed_password, $first_name, $last_name)
    {
        $user = $this->M_users->get_user_by_email($email);
        if (!$user) {
            // If user doesn't exist, insert new user data
            $user_data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $hashed_password,
                'status' => 'inactive',
                'created_at' => NOW,
                'created_by' => $email
            ];
            $user_id = $this->M_users->insert($user_data);
            $add_role = $this->_add_role_($user_id);

            return $user_id ? $user_id : FALSE;
        } else {
            // If user exists, update user data
            $user_data = [
                'updated_at' => NOW,
                'updated_by' => $email
            ];
            return $this->M_users->update($user['id'], $user_data) ? $user['id'] : FALSE;
        }
    }

    public function _validate_email_status($email)
    {
        $user = $this->M_users->get_user_by_email($email);



        if ($user && $user['status'] == 'active') {
            $this->form_validation->set_message('_validate_email_status', 'The email is already registered.');
            return FALSE;
        }
        return TRUE;
    }

    public function verification_link()
    {

        $data['page_data'] = [
            'system_module' => '',
            'system_section' => '',
            'title' => 'Register/link',
            'styles_path' => [
                'assets/vendor/libs/bs-stepper/bs-stepper.css',
                'assets/vendor/css/pages/page-auth.css'
            ],
            'scripts_path' => [
                'assets/js/register/index.js'
            ]
        ];

        $data['email_code'] = get_recent_verifications();

        $this->load->view('pages/register/email_code', $data);
    }

    private function _add_role_($user_id)
    {

        $data = [
            'user_id' => $user_id,
            'role_id' => 7 // User
        ];
        // add, insert the role to the user_roles id
        $this->M_user_roles->insert($data);
    }

    private function send_email($post_data, $code)
    {
        $data = [
            'name' => $post_data['multiStepsFirstname'],
            'verification_code' =>  $code,
        ];

     
        $message = $this->load->view('pages/register/partials/email-template', $data, TRUE);

        $this->email->from('lagoph.co@gmail.com', 'Lagoph Co. Admin');
        $this->email->to($post_data['multiStepsEmail']); 
        $this->email->subject('Account Email Verification');
        $this->email->message($message);

        // Send the email
        if ($this->email->send()) {
            $response = ['status' => true, 'message' => 'Verification email sent.'];
        } else {
            $response = [
                'status' => false,
                'message' => 'Failed to send verification email.',
                'debug' => $this->email->print_debugger(['headers'])
            ];
        }

        return $response;
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
        $response = array_merge(['status' => $status, 'message' => $message], ['validation_errors' => $additional_data]);
        exit(json_encode($response));
    }
}
