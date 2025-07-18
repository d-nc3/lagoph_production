<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Auth extends CI_Controller

{



    public function __construct()

    {

        parent::__construct();



        $this->load->model('Users_model', 'M_users');

        $this->load->model('User_roles_model', 'M_user_roles');
         $this->load->model('Members_model', 'M_members');



        $this->_create_additional = array(

            'created_by' => isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,

            'created_at' =>NOW

        );




        $this->_user_id  = $this->session->userdata('user_id') ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;

        $this->_update_additional = array(

            'updated_by' => isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,

            'updated_at' => NOW

        );



        $this->_delete_additional = array(

            'deleted_by' => isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,

            'deleted_at' =>NOW

        );

    }







    public function index()

    {

        if (isset($_SESSION['user_email'])) {

            redirect('Dashboard');

        }



        $data['page_data'] = [

            'system_module' => '',

            'system_section' => '',

            'title' => 'Login',

            'styles_path' => [

                'assets/vendor/css/pages/page-auth.css',

            ],

            'scripts_path' => [

                'assets/js/auth/index-copy.js'

            ]

        ];



        if ($post_data = $this->security->xss_clean($this->input->post())) {

            try {

                $rules = [

                    ['field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'],

                    ['field' => 'password', 'label' => 'Password', 'rules' => 'required'],

                ];



                $this->form_validation->set_rules($rules);

                if ($this->form_validation->run() == FALSE) {

                    $validation_errors = $this->form_validation->error_array();

                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));

                }



                $email = $post_data['email'];

                $password = $post_data['password'];

                $user = $this->M_users->get_user_by_email($email);





                if (!$user) {

                    return $this->_send_json_response(FALSE, 'Incorrect Credentials! Please try again.');

                }



                if ($user['login_attempts'] >= 4) {

                    return $this->_send_json_response(FALSE, 'Maximum login attempts reached. Please reset your password.');

                }



                $verify = password_verify($password, $user['password']);

                if (!$verify) {

                    $this->M_users->update($user['id'], ['login_attempts' => $user['login_attempts'] + 1, 'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => $email]);

                    return $this->_send_json_response(FALSE, 'Incorrect Credentials! Please try again.');

                }



                $this->M_users->update($user['id'], ['login_attempts' => 0, 'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => $email]);
                $member = $this->M_members->get_by_user($user['id']);
                $role = $this->M_user_roles->get_role($user['id']);

                $this->session->set_userdata('user_id', $user['id']);
                $this->session->set_userdata('user_role', $role['role_name']);
                $this->session->set_userdata('profile', $member['profile_path'] ?? '') ?? NULL;
                $this->session->set_userdata('user_email', $user['email']);
                $this->session->set_userdata('first_name', $user['first_name']);
                $this->session->set_userdata('last_name', $user['last_name']);
                $this->session->set_userdata('user', $user);



                return $this->_send_json_response(TRUE, 'Logged in successfully!');

            } catch (DatabaseException $e) {

                // Handle database-related exceptions (e.g., constraint violation)

                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

            } catch (Exception $e) {

                // Handle other types of exceptions

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');

            }

        }







        $this->load->view('pages/auth/index', $data);

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

        $response = ['status' => $status, 'message' => $message, 'validation_errors' => $additional_data];

        $this->output->set_content_type('application/json')->set_output(json_encode($response));

    }



    public function logout()

    {

        $this->session->unset_userdata('user_id');

        $this->session->unset_userdata('user_email');

        $this->session->unset_userdata('user_role');

        $this->session->unset_userdata('first_name');

        $this->session->unset_userdata('last_name');

        $this->session->sess_regenerate(TRUE); // Regenerate session ID and delete old session data

        redirect('Landing');

    }

}

