<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_types extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Transaction_types_model', 'M_transaction_types');

       
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

        $this->redirect_if_not_logged_in();
    }

    // Private method to check if the user is logged in
    private function redirect_if_not_logged_in()
    {
        if (!isset($_SESSION['user_email'])) {
            redirect('Auth');
        }
    }

    public function dt_list() 
    {
        $search = $this->security->xss_clean($this->input->post('search'));
        $order = $this->security->xss_clean($this->input->post('order'));
        $start = $this->security->xss_clean($this->input->post('start'));   
        $length = $this->security->xss_clean($this->input->post('length'));
    

        $filters['search'] = $search['value'];


        $list = $this->M_transaction_types->get_all_filtered($filters,$order, $start, $length);
        $data = array();
        $no = $start;
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row['id'] = $item->id;
            $row['transaction_name'] = $item->transaction_name;
            $row['description'] = $item->description;
        
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->M_transaction_types->count_all(),
            "recordsFiltered" => $this->M_transaction_types->count_filtered($filters),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function index() 
    {
        $data['page_data'] = [
            'system_module' => 'Settings',
            'system_section' => 'Transaction Types',
            'title' => 'Transaction types',
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
                'assets/js/transaction/add-index.js',
            ]
        ];

        if ($post_data = $this->security->xss_clean($this->input->post())) {
            try {
                $rules = [
                    ['field' => 'transaction_name', 'label' => 'Transaction Name', 'rules' => 'required'],
                    ['field' => 'description', 'label' => 'Description', 'rules' => 'required']
                ];

                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }

                // Validation passed, proceed with data insertion.
                $transaction_name = isset($post_data['transaction_name']) ? $post_data['transaction_name'] : '';
                $description = isset($post_data['description']) ? $post_data['description'] : '';

                // Check if the transaction already exists
                $is_existing = $this->M_transaction_types->get_by_name($transaction_name);
                if ($is_existing) {
                    return $this->_send_json_response(FALSE, 'Department already exists. Please try again with a different department name.');
                }

                $transaction_type_data = [
                    'transaction_name' => $transaction_name,
                    'description' => $description,
                ] + $this->_create_additional;

                if (!$this->M_transaction_types->insert($transaction_type_data)) {
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

        // Load default view if no data is posted.
        $this->load->view('pages/cashier/transactions/transaction-add-index', $data);
    }

    public function get() 
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $info = $this->M_transaction_types->get($post_data['id']);
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
            $info = $this->M_transaction_types->get($post_data['id']);
            if (empty($info)) {
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }

            try {
                $rules = [
                    ['field' => 'transaction_name', 'label' => 'Transaction Name', 'rules' => 'required'],
                    ['field' => 'description', 'label' => 'Description', 'rules' => 'required']
                ];

                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }

                // Validation passed, proceed with data insertion.
                $transaction_name = isset($post_data['transaction_name']) ? $post_data['transaction_name'] : '';
                $description = isset($post_data['description']) ? $post_data['description'] : '';

                // Check if the department already exists
                $is_existing = $this->M_transaction_types->get_by_name($transaction_name);
                if ($is_existing) {
                    return $this->_send_json_response(FALSE, 'Department already exists. Please try again with a different department name.');
                }
                
                $transaction_type_data = [
                    'transaction_name' => $transaction_name,
                    'description' => $description,
                ] + $this->_create_additional;


                if (!$this->M_transaction_types->update($info['id'], $transaction_type_data)) {
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

    // public function view($id = NULL) 
    // {
    //     $data['info'] = $info = $this->M_departments->get($id);
    //     if (empty($info)) {
    //         show_404();
    //         exit();
    //     }

    //     $data['page_data'] = [
    //         'system_module' => 'Settings',
    //         'system_section' => 'Departments',
    //         'title' => 'Department',
    //         'styles_path' => [
    //             'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
    //             'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
    //             'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
    //             'assets/vendor/libs/select2/select2.css',
    //             'assets/vendor/libs/@form-validation/form-validation.css',
    //         ],
    //         'scripts_path' => [
    //             'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    //             'assets/vendor/libs/select2/select2.js',
    //             'assets/vendor/libs/@form-validation/popular.js',
    //             'assets/vendor/libs/@form-validation/bootstrap5.js',
    //             'assets/vendor/libs/@form-validation/auto-focus.js',
    //             'assets/js/department/view.js',
    //         ]
    //     ];

    //     $this->load->view('pages/department/view', $data);
    // }

    // public function delete() 
    // {
    //     if ($post_data = $this->security->xss_clean($this->input->post())) {
    //         $info = $this->M_departments->get($post_data['id']);
    //         if (empty($info)) {
    //             return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
    //         }

    //         try {
    //             if (!$this->M_departments->delete($info['id'], $this->_delete_additional)) {
    //                 return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
    //             }

    //             return $this->_send_json_response(TRUE, 'Data deleted successfully!');
    //         } catch (DatabaseException $e) {
    //             // Handle database-related exceptions (e.g., constraint violation)
    //             return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
    //         } catch (Exception $e) {
    //             // Handle other types of exceptions
    //             return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
    //         }
    //     }

    //     return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
    // }

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
    