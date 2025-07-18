<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

        public function __construct()
        {
            parent::__construct();

            // Employee related Models
            $this->load->model('Employees_model', 'M_employees');
            $this->load->model('Units_model', 'M_units');
            $this->load->model('Positions_model', 'M_positions');
            $this->load->model('Departments_model', 'M_departments');

            // User related Models
            $this->load->model('Billing_address_model', 'M_billing_address');
            $this->load->model('User_logs_model', 'M_user_logs');
            $this->load->model('Users_model', 'M_users');
            $this->load->helper('data_table_helper');

            //User session related models:
            $this->_user_id  = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
            $this->_user_email  = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;
            $this->_user_role  = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
            $this->redirect_if_not_logged_in();
        

            $this->_create_additional = array(
                
            );

            $this->_update_additional = array(
                'updated_by' => isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,
                'updated_at' => NOW
            );

            $this->_delete_additional = array(
                'deleted_by' => isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,
                'deleted_at' => NOW
            );

            $this->_user_additional = array (
                'user_id' => isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_EMAIL,
                'entity_name' => 'Employee',
                'ip_address' =>  $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']
                        
            );

            $this->_notifications_data = [
                'notifications' => get_top_notifications($_SESSION['user_id']),
                'unread_count' => get_unread_count($_SESSION['user_id']),
                'new_count' => get_new_count($_SESSION['user_id'])
            ];

          

        }
 
        private function redirect_if_not_logged_in()
        {
            if (!isset($_SESSION['user_email'])) {
                redirect('Auth');
            } 
        }


        public function dt_list(){

            $formatter = function($details) {
                return [
                    'id' => $details->id,
                    'email'=>$details->email,
                    'first_name'=>$details->first_name,
                    'last_name'=>$details->last_name,
                    'middle_name'=>$details->middle_name,
                    'position_title'=>$details->position_title,
                    'department_name'=>$details->department_name,
                    'birth_place'=>$details->birth_place,
                    'date_of_birth'=>$details->date_of_birth,
                    'mobile_number'=>$details->mobile_number,
                    'date_hired'=>$details->date_hired,
                    'sex'=>$details->sex,
                    'status'=>$details->status,
                   
                ];
            };
    
            $filter = [
                'search' => $this->input->post('search')['value'] ?? NULL,
                'department_id' => $this->input->post('department_id') ? $this->security->xss_clean($this->input->post('department_id')) : '',
                'unit_id' => $this->input->post('unit_id') ? $this->security->xss_clean($this->input->post('unit_id')) : ''
            ];
    
            $output = get_datatable($this, $this->M_employees, $formatter, $filter);
            exit(json_encode($output));
           }




        public function generate_Employee_Password($length=6) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
            $charactersLength = strlen($characters);
            $password = '';
            // Generate random indices and map to characters
            for ($i = 0; $i < $length; $i++) {
                $randomIndex = random_int(0, $charactersLength - 1);
                $password .= $characters[$randomIndex];
            }
        
            return $password;
        }
    
        
        public function index() {
            $data['page_data'] = [
                'system_module' => 'Employees',
                'system_section' => '',
                'title' => 'Employee',
                'styles_path' => [
                    'assets/vendor/libs/select2/select2.css',
                    'assets/vendor/libs/tagify/tagify.css',
                    'assets/vendor/libs/flatpickr/flatpickr.css',
                    'assets/vendor/libs/@form-validation/form-validation.css',
                    'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                    'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                    'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
                ],
                'scripts_path' => [
                    'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
                    'assets/vendor/libs/select2/select2.js',
                    'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                    'assets/vendor/libs/@form-validation/popular.js',
                    'assets/vendor/libs/@form-validation/bootstrap5.js',
                    'assets/vendor/libs/@form-validation/auto-focus.js',
                    'assets/js/employee/index.js',
                ]
            ] + $this->_notifications_data;        
        
            if ($post_data = $this->security->xss_clean($this->input->post())) {
                try {

                    $rules = [
                        ['field' => 'modal_first_name', 'label' => 'First Name', 'rules' => 'required'],
                        ['field' => 'modal_last_name', 'label' => 'Last Name', 'rules' => 'required'],
                        ['field' => 'modal_middle_name', 'label' => 'Middle Name', 'rules' => 'required'],
                        ['field' => 'modal_date_of_birth', 'label' => 'Date of Birth', 'rules' => 'required'],
                        ['field' => 'modal_sex', 'label' => 'sex', 'rules' => 'required'],
                        ['field' => 'modal_place_of_birth', 'label' => 'Place of Birth', 'rules' => 'required'],
                        ['field' => 'modal_mobile_number', 'label' => 'Mobile Number', 'rules' => 'required'],
                        ['field' => 'modal_employment_status', 'label' => 'Employment Status', 'rules' => 'required'],
                        ['field' => 'modal_position_id', 'label' => 'Position', 'rules' => 'required'],
                        ['field' => 'modal_date_hired', 'label' => 'Date Hired', 'rules' => 'required'],
                        ['field' => 'modal_email', 'label' => 'Email', 'rules' => 'required']
                    ];
            
                    $this->form_validation->set_rules($rules);

                    if ($this->form_validation->run() == FALSE) {
                        $validation_errors = $this->form_validation->error_array();
                        return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                    }   
                    
                
                    $modal_first_name = $post_data['modal_first_name'] ?? '';
                    $modal_last_name = $post_data['modal_last_name'] ?? '';
                    $modal_sex = $post_data['modal_sex'] ?? '';
                    $modal_middle_name = $post_data['modal_middle_name'] ?? '';
                    $modal_date_of_birth = $post_data['modal_date_of_birth'] ?? '';
                    $modal_place_of_birth = $post_data['modal_place_of_birth'] ?? '';
                    $modal_mobile_number = $post_data['modal_mobile_number'] ?? '';
                    $modal_date_hired = $post_data['modal_date_hired'] ?? '';
                    $employment_status = $post_data['modal_employment_status'] ?? '';
                    $position_id = $post_data['modal_position_id'] ?? '';
                    $modal_email = $post_data['modal_email'] ?? '';
            
                    $generate_password = $this->generate_Employee_Password(6);
                    $is_Existing = $this->M_employees->get_employee_by_name($modal_first_name, $modal_last_name);
                    
                    if ($is_Existing) {
                        // If the employee already exists, return an error message
                        return $this->_send_json_response(FALSE, 'Employee already exists. Please try again with a different name.');
                    }
            
                    $position = $this->M_positions->get($position_id);
                    $this->db->trans_begin(); // Start transaction
            
                    $userCredential = [
                        'email' => $modal_email,
                        'password' => password_hash($generate_password, PASSWORD_DEFAULT),
                        'role' => 'Employee',
                        'status' => 'Active',
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $_SESSION['user_info']['email'] ?? DEFAULT_ADMIN_USER_EMAIL
                    ] + $this->_create_additional;
                    
                    $admin_logs = [
                        'type_of_action' => 'User Add',
                        'action_description' => 'User ' . $this->_user_email . ' added a new employee in the database'
                    ] + $this-> _user_additional;
            
    
                    $user_id = $this->M_users->insert($userCredential);

                    $employee_data = [
                        'user_id' => $user_id,
                        'first_name' => $modal_first_name,
                        'last_name' => $modal_last_name,
                        'middle_name' => $modal_middle_name,
                        'sex' => $modal_sex,
                        'date_of_birth' => $modal_date_of_birth,
                        'birth_place' => $modal_place_of_birth,
                        'mobile_number' => $modal_mobile_number,
                        'date_hired' => $modal_date_hired,
                        'position_id' => $position_id,
                        'department_id' => $position['department_id'],
                        'unit_id' => $position['unit_id'],
                        'status' => $employment_status,
                        'email' => $modal_email,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $_SESSION['user_info']['email'] ?? DEFAULT_ADMIN_USER_EMAIL
                    ] + $this->_create_additional;

                    if (!$user_id) {
                        $this->db->trans_rollback();
                        throw new Exception('Failed to insert user credentials.');
                    }
            
            
                    if (!$this->M_employees->insert($employee_data)) {
                        $this->db->trans_rollback();
                        throw new Exception('Failed to insert employee data.');
                    }

                    if (!$this->M_user_logs->insert($admin_logs)) {
                        $this->db->trans_rollback();
                        throw new Exception('Failed to insert employee data.');
                    }
                     // Commit transaction if all operations succeed
                     $this->db->trans_commit();
                     return $this->_send_json_response(TRUE, 'Data saved successfully. Your temporary password is: ' . $generate_password);
                        
                
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
            
            $data['departments'] = $this->M_departments->get_all();
            $data['units'] = $this->M_units->get_all();
            $data['employees'] = $this->M_employees->get_all();
            $data['positions'] = $this->M_positions->get_all();
            $this->load->view('pages/employee/index', $data);
        }

        public function get() {
        
            if ($post_data = $this->security->xss_clean($this->input->post())) {
                $info = $this->M_employees->get($post_data['id']);
                if (empty($info)) {
                    return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
                }

                exit(json_encode($info));
            }

            return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
        }

        //optimized
        public function edit() {
            if ( $post_data = $this->security->xss_clean($this->input->post())) {
               try { 
                    $info = $this->M_employees->get($post_data['id']);
                    if (empty($info)) {
                        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
                    }
        
                    $rules = [
                        ['field' => 'first_name', 'label' => 'First name', 'rules' => 'required'],
                        ['field' => 'middle_name', 'label' => 'Middle name', 'rules' => 'required'],
                        ['field' => 'last_name', 'label' => 'Last name', 'rules' => 'required'],
                        ['field' => 'position_title', 'label' => 'Position title', 'rules' => 'required'],
                        ['field' => 'sex', 'label' => 'Sex', 'rules' => 'required'],
                        ['field' => 'mobile_number', 'label' => 'Mobile number', 'rules' => 'required'],
                        ['field' => 'email', 'label' => 'Email', 'rules' => 'required'],
                        ['field' => 'status', 'label' => 'Status', 'rules' => 'required'],
                        ['field' => 'date_hired', 'label' => 'Date hired', 'rules' => 'required'],
                        ['field' => 'birth_place', 'label' => 'Place of birth', 'rules' => 'required'],
                        ['field' => 'date_of_birth', 'label' => 'Date of birth', 'rules' => 'required'],
                    ];
    
                    $this->form_validation->set_rules($rules);
                    if ($this->form_validation->run() == FALSE) {
                        $validation_errors = $this->form_validation->error_array();
                        return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                    }
        
                    $this->db->trans_begin();
                    // Extract POST data into variables with default values
                    $first_name = $post_data['first_name'] ?? '';
                    $last_name = $post_data['last_name'] ?? '';
                    $sex = $post_data['sex'] ?? '';
                    $middle_name = $post_data['middle_name'] ?? '';
                    $date_of_birth = $post_data['date_of_birth'] ?? '';
                    $birth_place = $post_data['birth_place'] ?? '';
                    $mobile_number = $post_data['mobile_number'] ?? '';
                    $date_hired = $post_data['date_hired'] ?? '';
                    $status = $post_data['status'] ?? '';
                    $position_title = $post_data['position_title'] ?? '';
                    $email = $post_data['email'] ?? '';
            
                    // Get position information from position title
                    $position = $this->M_positions->get($position_title);
            
                    // Prepare employee data for update
                    $employee_data = [
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'middle_name' => $middle_name,
                        'position_id' => $position_title,
                        'date_hired' => $date_hired,
                        'status' => $status,
                        'mobile_number' => $mobile_number,
                        'sex' => $sex,
                        'date_of_birth' => $date_of_birth,
                        'birth_place' => $birth_place,
                        'department_id' => $position['department_id'] ?? null,
                        'unit_id' => $position['unit_id'] ?? null,
                    ] + $this->_update_additional;
                
               
                    $admin_logs = [
                            'type_of_action' => 'User Edit',
                            'action_description' => 'User ' . $this->_user_email . ' edited an employee in the database'
                    ] +$this->_user_additional;
               
                  
                    if (!$this->M_employees->update($info['id'], $employee_data)) {
                        $this->db->trans_rollback();
                        return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                    }
                    
                    if (!$this->M_user_logs->insert($admin_logs)) {
                        $this->db->trans_rollback();
                        return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                    }
        
                    $this->db->trans_commit();
                    return $this->_send_json_response(TRUE, 'Data updated successfully!');
               
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
        }
        

        public function view($id = NULL) 
        {

            $data['info'] = $info = $this->M_employees->get($id) ?? [];
            $user_id = $info['user_id'] ?? [];
         
            if (empty($info)) {
                show_404();
                exit();
            }

            $data['page_data'] = [
                'system_module' => 'Employees',
                'system_section' => '',
                'title' => 'Employee',
                'styles_path' => [
                    'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                    'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                    'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
                    'assets/vendor/libs/select2/select2.css',
                    'assets/vendor/libs/@form-validation/form-validation.css',
                ],
                'scripts_path' => [
                    'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                    'assets/vendor/libs/select2/select2.js',
                    'assets/js/extended-ui-perfect-scrollbar.js',
                    'assets/vendor/libs/@form-validation/popular.js',
                    'assets/vendor/libs/@form-validation/bootstrap5.js',
                    'assets/vendor/libs/@form-validation/auto-focus.js',
                    'assets/js/Employee/view.js',
                ]
            ] + $this->_notifications_data;

            $data['employees'] = $this->M_employees->get_all();
            $data['positions'] = $this->M_positions->get_all();
            $data['user_logs'] = $this->M_user_logs->get_logs_by_user_id($user_id);
            $this->load->view('pages/employee/view', $data);
        }

        
        public function delete() {
            
            if ($post_data = $this->security->xss_clean($this->input->post())) {
                try {
                    $admin_logs = [
                        'type_of_action' => 'User Delete',
                        'action_description' => 'User ' .$this->_user_email . ' Deleted an employee in the database'
                    ] + $this->_user_additional;

                    $this->db->trans_begin();

                    $info = $this->M_employees->get($post_data['id']);

                    if (empty($info)) {
                        $this->db->trans_rollback();
                        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
                    }

                    if (!$this->M_employees->delete($info['id'], $this->_delete_additional)) {
                            $this->db->trans_rollback();
                            return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                    }

                
                    if (!$this->M_user_logs->insert($admin_logs)) {
                            $this->db->trans_rollback();
                            return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                    }
            
                        $this->db->trans_commit();
                        return $this->_send_json_response(TRUE, 'Data deleted successfully!');

                    } catch (DatabaseException $e) {
                        // Handle database-related exceptions (e.g., constraint violation)
                        return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                    } catch (Exception $e) {
                        // Handle other types of exceptions
                        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
                    }
            }
            return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
        }



        private function _format_validation_errors($rules, $validation_errors) {
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

        private function _send_json_response($status, $message, $additional_data = []){
        
            $response = array_merge(['status' => $status, 'message' => $message], ['validation_errors' => $additional_data]);
            exit(json_encode($response));
        }
        
}
