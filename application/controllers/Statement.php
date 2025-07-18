<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statement extends CI_Controller {

        public function __construct()
        {
            parent::__construct();

            // Employee related models
            $this->load->model('Employees_model', 'M_employees');
            $this->load->model('Units_model', 'M_units');
            $this->load->model('Positions_model', 'M_positions');
            $this->load->model('Departments_model', 'M_departments');

            // User related models
            $this->load->model('Users_model', 'M_users'); 
            $this->load->model('User_logs_model', 'M_user_logs');
            $this->load->model('User_documents_model', 'M_documents');
            $this->load->model('Billing_address_model', 'M_billing_address');

            //Cashiering related models
            $this->load->model('Cashiering_invoice_model','M_cashiering_invoice');
            $this->load->model('Invoice_particulars_model', 'M_invoice_particular');
            $this->load->model('Capital_contributions_model', 'M_capital_contributions');
            $this->load->model('Cash_accounts_model', 'M_cash_accounts');
            $this->load->model('Items_model', 'M_items');
            
            //Receipt related models
            $this->load->model('Payment_records_model','M_payment_records');
            $this->load->model('Official_receipts_model', 'M_official_receipt');  
            $this->load->model('Receipt_particulars_model', 'M_receipt_particulars');    
        
            //Payment related models
            $this->load->model('Payment_method_model','M_payment_method');
            $this->load->model('Payment_options_model','M_payment_options');
            $this->load->model('Transaction_category_model', 'M_transaction_category');
        
       

            $this->load->helper('string');

            //User session related models:
            $this->_user_id  = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
            $this->_user_email  = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;
            $this->_user_role  = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
            $this->redirect_if_not_logged_in();

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
                    'id'=>$details->id,
                    'cashiering_invoice_id'=>$details->cashiering_invoice_id,
                    'user_id'=>$details->user_id,
                    'invoice_number'=>$details->invoice_number,
                    'transaction_name'=>$details->transaction_name,
                    'date_issued'=>$details->date_issued,
                    'status'=>$details->status,
                    'amount'=>$details->amount
                   
                ];
            };
            $filter = [
                'search' => $this->input->post('search')['value'] ?? NULL,

            ];
    
            $output = get_datatable($this, $this->M_invoice_particular, $formatter, $filter);
            exit(json_encode($output));
           }

           public function receipt_dt_list($id=NULL) {
            $formatter = function($details) {
                return [
                    'id'=>$details->id,
                    'official_receipt_number'=>$details->official_receipt_number,
                    'user_id'=>$details->user_id,
                    'transaction_name'=>$details->transaction_name,
                    'payment_date'=>$details->payment_date,
                    'first_name' =>$details->first_name,
                    'last_name' => $details->last_name,
                    'total_cost'=>$details->total_cost
                ];
              };
              $filter = [
                  'search' => $this->input->post('search')['value'] ?? NULL,
                  'user_id' =>  $this->input->post('user_id') ? $this->security->xss_clean($this->input->post('user_id')) : NULL
              ];
              $output = get_datatable($this, $this->M_receipt_particulars, $formatter, $filter);
              exit(json_encode($output));
              
          }
        public function index() {
            $data['page_data'] = [
                'system_module' => 'Billing',
                'system_section' => '',
                'title' => 'Invoice',
                'styles_path' => [
                 
                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
                'assets/vendor/libs/typeahead-js/typeahead.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
                'assets/vendor/libs/bootstrap-select/bootstrap-select.css',
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/bs-stepper/bs-stepper.css'
                
                ],
                'scripts_path' => [
                'assets/vendor/libs/moment/moment.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/bs-stepper/bs-stepper.js',
                'assets/js/statements/index.js',
                ]
            ]  + $this->_notifications_data;   
        
            $data['cashiering_invoice'] = $this->M_invoice_particular->get_all();
            $data['billing_address'] = $this->M_billing_address->get($this->_user_id);
            $this->load->view('pages/statement/index', $data);
        }


    public function billing_address() { 
            $post_data = $this->input->post();
        
            if ($post_data) {
                // Clean the input data
                $post_data = $this->security->xss_clean($post_data);
        
                // Define validation rules
                $rules = [
                    ['field' => 'billing_email', 'label' => 'Billing Email', 'rules' => 'required|valid_email'], 
                    ['field' => 'mobile_number', 'label' => 'Mobile Number', 'rules' => 'required'],
                    ['field' => 'address', 'label' => 'Address', 'rules' => 'required'],
                    ['field' => 'province', 'label' => 'Province', 'rules' => 'required']  
                ];
        
                // Set and run form validation
                $this->form_validation->set_rules($rules); 
                if ($this->form_validation->run() == FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }
        
                // Prepare billing address data for insertion
                $billing_address = [
                    'user_id' => $this->_user_id,
                    'billing_email' => $post_data['billing_email'], 
                    'mobile_number' => $post_data['mobile_number'], 
                    'street_address' => $post_data['address'], 
                    'municipality' => $post_data['province'],
                ];
        
                try {
                    // Start transaction
                    $this->db->trans_start();
        
                    // Insert billing address data
                    if (!$this->M_billing_address->insert($billing_address)) { 
                        throw new Exception('Error inserting billing address.');
                    }
        
                    // Commit transaction
                    $this->db->trans_complete();
        
                    // Check for transaction success
                    if ($this->db->trans_status() === FALSE) {
                        throw new Exception('Transaction failed.');
                    }
        
                    return $this->_send_json_response(TRUE, 'Data updated successfully!');
        
                } catch (Exception $e) {
                    // Rollback transaction in case of any failure
                    $this->db->trans_rollback();
        
                    // Log the exception message if necessary
                    log_message('error', $e->getMessage());
        
                    return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
                }
            }
        
            // If no post data, return an appropriate response or handle it as needed
            return $this->_send_json_response(FALSE, 'No data submitted.');
        }
        

        public function payment_index() {

            $data['page_data'] = [
                'system_module' =>'Receipt Information', 
                'system_section' => '',
                'title' => 'Payment Records',   
               'styles_path' => [
                     
                    'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
                    'assets/vendor/libs/typeahead-js/typeahead.css',
                    'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                    'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                    'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
                    'assets/vendor/libs/bootstrap-select/bootstrap-select.css',
                    'assets/vendor/libs/select2/select2.css',
                    
                    ],
                    'scripts_path' => [
                    'assets/vendor/libs/moment/moment.js',
                    'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                    'assets/js/statements/index-receipts.js',
                    ]
            ]  + $this->_notifications_data;   
    
                $data['payment_records'] = $this->M_payment_records->get_all();
                $this->load->view('pages/statement/view-receipt',$data);
        }
    
       

        public function view($id=NULL) {
            if (!$id) {
                show_404();
                die();
            }
            $data['page_data'] = [
                'system_module' => 'Statement History',
                'system_section' => '',
                'title' => 'Statement History',
                'styles_path' => [
                    'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
                    'assets/vendor/libs/typeahead-js/typeahead.css',
                    'assets/vendor/libs/bs-stepper/bs-stepper.css',
                    'assets/vendor/libs/bootstrap-select/bootstrap-select.css',
                    'assets/vendor/libs/select2/select2.css',
                    'assets/vendor/libs/@form-validation/form-validation.css',
                ],
                'scripts_path' => [
                    'assets/js/form-wizard-numbered.js',
                    'assets/js/form-wizard-validation.js',
                    'assets/vendor/libs/flatpickr/flatpickr.js',
                    'assets/vendor/libs/jquery-repeater/jquery-repeater.js',
                    'assets/js/cashier/cashier-billing-index.js',
                    'assets/js/payment/index.js',
                    'assets/js/invoice/member-invoice-index.js',
                    'assets/js/utilities/selectHandler.js', 
                ]
            ]  + $this->_notifications_data;   
        
        
                $data['invoice_particulars'] = $this->M_invoice_particular->get($id,$this->_user_id);
                $data['billing_address'] = $this->M_billing_address->get($this->_user_id);
                $data['items'] = $this->M_items->get_all();
                $data['payment_options'] = $this->M_payment_options->get_all();
                $data['payment_method'] = $this->M_payment_method->get_all();

                $this->load->view('pages/statement/view', $data);
                
              
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

