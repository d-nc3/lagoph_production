<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Positions_model', 'M_positions');
        $this->load->model('Departments_model', 'M_departments');
        $this->load->model('Units_model', 'M_units');
        $this->load->model('Billing_address_model', 'M_billing_address');
        $this->load->helper('data_table_helper');

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

        $this->_notifications_data = [
            'notifications' => get_top_notifications($_SESSION['user_id']),
            'unread_count' => get_unread_count($_SESSION['user_id']),
            'new_count' => get_new_count($_SESSION['user_id'])
        ];
    }

    
    
    public function dt_list() {
        $formatter = function($data){
            return [
                'id' => $data->id,
                'position_title' => $data->position_title,
                'department_name' => $data->department_name,
                'unit_name' => $data->unit_name,
                'description' => $data->description,
            ];
        };

        $filters = [
            'search' => $this->input->post('search')['value'],
            'department_id' => $this->input->post('department_id') ? $this->security->xss_clean($this->input->post('department_id')) : '',
            'unit_id' => $this->input->post('unit_id') ? $this->security->xss_clean($this->input->post('unit_id')) : ''
        ];

        $output = get_datatable($this,$this->M_positions,$formatter,$filters);
        echo json_encode($output);
    }
    // public function dt_list() 
    // {
    //     $search = $this->security->xss_clean($this->input->post('search'));
    //     $order = $this->security->xss_clean($this->input->post('order'));
    //     $start = $this->security->xss_clean($this->input->post('start'));   
    //     $length = $this->security->xss_clean($this->input->post('length'));
    //     $department_id = $this->input->post('department_id') ? $this->security->xss_clean($this->input->post('department_id')) : '';

    //     $filters['search'] = $search['value'];

    //     if (isset($department_id) && $department_id) {
    //         $filters['department_id'] = $department_id;
    //     }


    //     if (isset($unit_id) && $unit_id ){ 
    //         $filters['unit_id'] = $unit_id;
    //     }
       
    //     $list = $this->M_positions->get_all_filtered($filters, $order, $start, $length);
    //     $data = array();
    //     $no = $start;
    //     foreach ($list as $item) {
    //         $no++;
    //         $row = array();
    //         $row['id'] = $item->id;
    //         $row['position_title'] = $item->position_title;
    //         $row['department_name'] = $item->department_name;
    //         $row['unit_name'] = $item->unit_name;
    //         $row['description'] = $item->description;
    //         $data[] = $row;

    //     }

    //     $output = array(
    //         "draw" => $this->input->post('draw'),
    //         "recordsTotal" => $this->M_positions->count_all(),
    //         "recordsFiltered" => $this->M_positions->count_filtered($filters),
    //         "data" => $data,
    //     );
    //     echo json_encode($output);
    // }


    public function index() {
        
        $data['page_data'] = [
            'system_module' => 'Settings',
            'system_section' => 'Positions',
            'title' => 'Positions',
            'styles_path' => [
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/@form-validation/form-validation.css',   
                'assets/vendor/css/pages/app-ecommerce.css'
            ],
            'scripts_path' => [
                'assets/vendor/libs/moment/moment.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/select2/select2.js',
                'assets/vendor/libs/@form-validation/popular.js',
                'assets/vendor/libs/@form-validation/bootstrap5.js',
                'assets/vendor/libs/@form-validation/auto-focus.js',
                'assets/js/position/index.js',
            ]
        ] + $this->_notifications_data; 
        if ($post_data = $this->security->xss_clean($this->input->post())) {
      
            try{
                $rules = [
                    ['field' => 'position_title', 'label' => 'Position Name', 'rules' => 'required'],
                    ['field' => 'department_id', 'label' => 'Department Name', 'rules' => 'required'],
                    ['field' => 'unit_id', 'label' => 'Unit Name', 'rules' => 'required'],
                ];
                
                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }
        
                $position_title = isset($post_data['position_title']) ? $post_data['position_title'] : '';
                $department_id = isset($post_data['department_id']) ? $post_data['department_id'] : '';
                $unit_id = isset($post_data['unit_id']) ? $post_data['unit_id'] : '';
                $description = isset($post_data['description']) ? $post_data['description'] : '';
            
                $is_existing = $this->M_positions->get_by_position_title($post_data['position_title']);
                if ($is_existing) {
                    return $this->_send_json_response(FALSE, 'Unit already exists. Please try again with a different unit name.');
                }
        
                $position_data = [
                    'position_title' => $position_title,
                    'unit_id' =>$unit_id,
                    'department_id' =>$department_id,
                    'description'=>$description,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL
                ] + $this->_create_additional;
            
                if (!$this->M_positions->insert($position_data)) {
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
        $data['departments']   =   $departments   =   $this->M_departments->get_all();
        $data['units']   =   $units   =   $this->M_units->get_all();
        $this->load->view('pages/position/index', $data);
    }

    
    public function get() 
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $info = $this->M_positions->get($post_data['id']);
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
            $info = $this->M_positions->get($post_data['id']);
            if (empty($info)) {
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }

            try {
                $rules = [
                    ['field' => 'position_title', 'label' => 'Position Title', 'rules' => 'required'],
                    ['field' => 'department_id', 'label' => 'Department Name', 'rules' => 'required'],
                    ['field' => 'unit_id', 'label' => 'Unit Name', 'rules' => 'required'],
                    ['field' => 'description', 'label' => 'description', 'rules' => 'required']
                ];

                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }

                // Validation passed, proceed with data insertion.
                $position_title = isset($post_data['position_title']) ? $post_data['position_title'] : 0;
                $department_id = isset($post_data['department_id']) ? $post_data['department_id'] : '';
                $unit_id = isset($post_data['unit_id']) ? $post_data['unit_id'] : '';
                $description = isset($post_data['description']) ? $post_data['description'] : '';

                // Check if the position already exists
                if ($info['position_title'] !== $post_data['position_title']) {
                    $is_existing = $this->M_positions->get_by_position_title($position_title);
                    if ($is_existing) {
                        return $this->_send_json_response(FALSE, 'Unit already exists. Please try again with a different Unit name.');
                    }
                }
                
                $position_data = [
                    'position_title' => $position_title,
                    'department_id' => $department_id,
                    'unit_id' => $unit_id,
                    'description' => $description,
                ] + $this->_update_additional;

                if (!$this->M_positions->update($info['id'], $position_data)) {
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


    public function delete() 
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $info = $this->M_positions->get($post_data['id']);
            if (empty($info)) {
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }

            try {
                if (!$this->M_positions->delete($info['id'], $this->_delete_additional)) {
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

     
    public function view($id = NULL) 
    {
        $data['info'] = $info = $this->M_positions->get($id);
        if (empty($info)) {
            show_404();
            exit();
        }

        $data['page_data'] = [
            'system_module' => 'Settings',
            'system_section' => 'Positions',
            'title' => 'Position',
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
                'assets/js/position/view.js',
            ]
        ];

        $this->load->view('pages/position/view', $data);
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
