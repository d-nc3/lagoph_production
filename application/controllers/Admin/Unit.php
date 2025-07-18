<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Departments_model', 'M_departments');
        $this->load->model('Units_model', 'M_units');
        $this->load->model('Billing_address_model', 'M_billing_address');

        $this->load->helper('data_table_helper');
       
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

        $this->_notifications_data = [
            'notifications' => get_top_notifications($_SESSION['user_id']),
            'unread_count' => get_unread_count($_SESSION['user_id']),
            'new_count' => get_new_count($_SESSION['user_id'])
        ];

        $this->redirect_if_not_logged_in();
    }

    // Private method to check if the user is logged in
    private function redirect_if_not_logged_in()
    {
        if (!isset($_SESSION['user_email'])) {
            redirect('Auth');
        }
    }


    public function dt_list(){ 
        $formatter = function($unit) {
            return [
                'id' => $unit->id,
                'department_name' => $unit->department_name,    
                'unit_name' => $unit->unit_name,
                'unit_head' => $unit->unit_head,    
                'description' => $unit->description 
            ]; 
        };

        $filter = [
            'search' => $this->input->post('search')['value'],
            'department_id' => $this->input->post('department_id') ? $this->security->xss_clean($this->input->post('department_id')) : ''
        ];
        $output = get_datatable($this,$this->M_units, $formatter ,$filter);
        echo json_encode($output);
    }
     public function index() 
    {
        $data['page_data'] = [
            'system_module' => 'Settings',
            'system_section' => 'Units',
            'title' => 'Unit',
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
                'assets/vendor/libs/@form-validation/popular.js',
                'assets/vendor/libs/@form-validation/bootstrap5.js',
                'assets/vendor/libs/@form-validation/auto-focus.js',
                'assets/js/unit/index.js',
            ]
        ] + $this->_notifications_data;

        if ($post_data = $this->security->xss_clean($this->input->post())) {
            try {
                $rules = [
                    ['field' => 'department_id', 'label' => 'Department', 'rules' => 'required'],
                    ['field' => 'unit_name', 'label' => 'Unit Name', 'rules' => 'required'],
                    ['field' => 'unit_head', 'label' => 'Unit Head', 'rules' => 'required']
                ];

                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }

                // Validation passed, proceed with data insertion.
                $department_id = isset($post_data['department_id']) ? $post_data['department_id'] : '';
                $unit_name = isset($post_data['unit_name']) ? $post_data['unit_name'] : '';
                $unit_head = isset($post_data['unit_head']) ? $post_data['unit_head'] : '';
                $description = isset($post_data['description']) ? $post_data['description'] : '';

                // Check if the department already exists
                $is_existing = $this->M_units->get_by_name($unit_name);
                if ($is_existing) {
                    return $this->_send_json_response(FALSE, 'Unit already exists. Please try again with a different unit name.');
                }

                $unit_data = [
                    'department_id' => $department_id,
                    'unit_name' => $unit_name,
                    'unit_head' => $unit_head,
                    'description' => $description,
                ] + $this->_create_additional;

                if (!$this->M_units->insert($unit_data)) {
                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                }

                return $this->_send_json_response(TRUE, 'Data saved successfully!');
            } catch (DatabaseException $e) {
                // Handle database-related exceptions (e.g., constraint violation)
                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            } catch (Exception $e) {
                // Handle other types of exceptions
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }
        }
        $data['departments'] = $this->M_departments->get_all();
        // Load default view if no data is posted.
        $this->load->view('pages/unit/index', $data);
    }

    public function get() 
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $info = $this->M_units->get($post_data['id']);
            if (empty($info)) {
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }

            exit(json_encode($info));
        }

        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
    }

    public function edit() 
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $info = $this->M_units->get($post_data['id']);
            if (empty($info)) {
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }

            try {
                $rules = [
                    ['field' => 'department_id', 'label' => 'Department', 'rules' => 'required'],
                    ['field' => 'unit_name', 'label' => 'Unit Name', 'rules' => 'required'],
                    ['field' => 'unit_head', 'label' => 'Unit Head', 'rules' => 'required']
                ];

                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }

                // Validation passed, proceed with data insertion.
                $department_id = isset($post_data['department_id']) ? $post_data['department_id'] : 0;
                $unit_name = isset($post_data['unit_name']) ? $post_data['unit_name'] : '';
                $unit_head = isset($post_data['unit_head']) ? $post_data['unit_head'] : '';
                $description = isset($post_data['description']) ? $post_data['description'] : '';

                // Check if the unit already exists
                if ($info['unit_name'] !== $post_data['unit_name']) {
                    $is_existing = $this->M_units->get_by_name($unit_name);
                    if ($is_existing) {
                        return $this->_send_json_response(FALSE, 'Unit already exists. Please try again with a different Unit name.');
                    }
                }
                
                $unit_data = [
                    'department_id' => $department_id,
                    'unit_name' => $unit_name,
                    'unit_head' => $unit_head,
                    'description' => $description,
                ] + $this->_update_additional;

                if (!$this->M_units->update($info['id'], $unit_data)) {
                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                }

                return $this->_send_json_response(TRUE, 'Data updated successfully!');
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

    public function view($id = NULL) 
    {
        $data['info'] = $info = $this->M_units->get($id);
        if (empty($info)) {
            show_404();
            exit();
        }

        $data['page_data'] = [
            'system_module' => 'Settings',
            'system_section' => 'Units',
            'title' => 'Unit',
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
                'assets/vendor/libs/@form-validation/popular.js',
                'assets/vendor/libs/@form-validation/bootstrap5.js',
                'assets/vendor/libs/@form-validation/auto-focus.js',
                'assets/js/unit/view.js',
            ]
        ];

        $this->load->view('pages/unit/view', $data);
    }

    public function delete() 
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $info = $this->M_units->get($post_data['id']);
            if (empty($info)) {
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }

            try {
                if (!$this->M_units->delete($info['id'], $this->_delete_additional)) {
                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                }

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