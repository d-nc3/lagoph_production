<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_type_cash_account  extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Transaction_types_model', 'M_transaction_types');
        $this->load->model('Transaction_types_cash_account_model', 'M_transaction_cash_account');
        $this->load->model('Cash_accounts_model', 'M_cash_accounts');

       
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


        $list = $this->M_transaction_cash_account->get_all_filtered($filters,$order, $start, $length);
        $data = array();
        $no = $start;
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row['id'] = $item->id;
            $row['transaction_name'] = $item->transaction_name;
            $row['description'] = $item->description;
            $row['title'] = $item->title;
            $row['code_of_cash_account'] = $item->code_of_cash_account;
            $row['account_type'] =$item->account_type;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->M_transaction_cash_account->count_all(),
            "recordsFiltered" => $this->M_transaction_cash_account->count_filtered($filters),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function index() 
    {
        $data['page_data'] = [
            'system_module' => 'Settings',
            'system_section' => 'Cash account map',
            'title' => 'Cash account map',
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
                'assets/js/transaction/add-cash-account-index.js',
            ]
        ];

        if ($post_data = $this->security->xss_clean($this->input->post())) {
            try {
                $rules = [
                    ['field' => 'transaction_type', 'label' => 'Transaction Name', 'rules' => 'required'],
                    ['field' => 'cash_account', 'label' => 'Description', 'rules' => 'required'],
                    ['field' => 'account_type', 'label' => 'Account type', 'rules' => 'required']
                ];

                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }

                // Validation passed, proceed with data insertion.
                $transaction_type = isset($post_data['transaction_type']) ? $post_data['transaction_type'] : '';
                $cash_account = isset($post_data['cash_account']) ? $post_data['cash_account'] : '';
                $account_type = isset($post_data['account_type']) ? $post_data['account_type'] : '';

                // Check if the department already exists
               

                $transaction_type_data = [
                    'transaction_type_id' => $transaction_type,
                    'cash_account_id' => $cash_account,
                    'account_type' => $account_type,
                ];

                if (!$this->M_transaction_cash_account->insert($transaction_type_data)) {
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
        $data['cash_accounts'] = $this->M_cash_accounts->get_all();
        $data['transactions'] = $this->M_transaction_types->get_all();
        $this->load->view('pages/cashier/transactions/cash-acc-add-index', $data);
    }

    public function get() 
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $info = $this->M_transaction_cash_account->get($post_data['id']);
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
          

            try {
                $rules = [
                    ['field' => 'transaction_type', 'label' => 'Transaction Name', 'rules' => 'required'],
                    ['field' => 'cash_account', 'label' => 'Description', 'rules' => 'required'],
                    ['field' => 'account_type', 'label' => 'Account type', 'rules' => 'required']
                    
                   
                ];

                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }

               // Validation passed, proceed with data insertion.
               $transaction_type = isset($post_data['transaction_type']) ? $post_data['transaction_type'] : '';
               $cash_account = isset($post_data['cash_account']) ? $post_data['cash_account'] : '';
               $account_type = isset($post_data['account_type']) ? $post_data['account_type'] : '';
             

              
               $transaction_type_data = [
                'transaction_type_id' => $transaction_type,
                'cash_account_id' => $cash_account,
                'account_type' =>$account_type
                
                ];
               
                if (!$this->M_transaction_cash_account->update($post_data['id'], $transaction_type_data)) {
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
    