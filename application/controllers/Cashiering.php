<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashiering extends CI_Controller {

        public function __construct()
        {
            parent::__construct();

            //Employees related models
            $this->load->model('Employees_model', 'M_employees');
            $this->load->model('Positions_model', 'M_positions');
            $this->load->model('Departments_model', 'M_departments');

            //User related models
            $this->load->model('Users_model', 'M_users');
            $this->load->model('User_logs_model', 'M_user_logs');
            $this->load->model('Billing_address_model', 'M_billing_address');
         
      
            //Member related models
            $this->load->model('Members_model', 'M_member');
            $this->load->model('Units_model', 'M_units');

            //Loans related models
            $this->load->model('Loans_model', 'M_loans');
            $this->load->model('Loans_repayment_schedule_model', 'M_loan_repayment_schedule');

            //Payment related models
            $this->load->model('Payment_method_model', 'M_payment_method');
            $this->load->model('Payment_options_model', 'M_payment_options');
            $this->load->model('Items_model', 'M_items');
            $this->load->model('Payment_account_model', 'M_payment_account');
            $this->load->model('Cashiering_invoice_model', 'M_cashiering_invoice');
            $this->load->model('Invoice_particulars_model', 'M_invoice_particular');
            $this->load->model('Cash_accounts_model', 'M_cash_accounts');
            $this->load->model('Ledger_model', 'M_ledger_model');
            $this->load->model('Payment_records_model', 'M_payment_records');

            //Capital Contribution related models
            $this->load->model('Capital_contributions_model', 'M_capital_contributions');
            $this->load->model('Transaction_category_model', 'M_transaction_category');
            $this->load->model('Cap_share_account_dues', 'M_cap_account_due');

            //Official receipt related models
            $this->load->model('Official_receipts_model', 'M_official_receipt');
            $this->load->model('Receipt_particulars_model', 'M_receipt_particulars');


            //User session related data
            $this->_user_id  = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
            $this->_user_email  = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;
            $this->_user_role  = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
            $this->_first_name  = isset($_SESSION['first_name']) ? $this->session->userdata('first_name') : DEFAULT_ADMIN_USER_ROLE;
            $this->_last_name  = isset($_SESSION['last_name']) ? $this->session->userdata('last_name') : DEFAULT_ADMIN_USER_ROLE;
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

        
    
        public function dt_list() {

            $search = $this->security->xss_clean($this->input->post('search'));
            $order = $this->security->xss_clean($this->input->post('order'));
            $start = $this->security->xss_clean($this->input->post('start'));   
            $length = $this->security->xss_clean($this->input->post('length'));
            $draw = $this->security->xss_clean($this->input->post('draw'));
          
        
            // Apply filters
            $filters = array();
            if (!empty($search['value'])) {
                $filters['search'] = $search['value'];
            }
          
            // remove uneccesarry joins and datas
            $list = $this->M_invoice_particular->get_all_filtered($filters, $order, $start, $length);
            $data = array();
            $no = $start;
            foreach ($list as $particular) {
                $no++;    
                $row = array();
                $row['id'] = $particular->id;
                $row['first_name'] = $particular->first_name;
                $row['last_name'] = $particular->last_name;
                $row['cashiering_invoice_id'] =$particular->cashiering_invoice_id;
                $row['user_id'] =$particular->user_id;
                $row['email'] = $particular->email;
                $row['invoice_number'] =$particular->invoice_number;
                $row['transaction_name'] =$particular->transaction_name;
                $row['date_issued'] =$particular->date_issued;
                $row['status'] =$particular->status;
                $data[] = $row;
            }
        
            // Prepare the output for DataTables
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->M_invoice_particular->count_all(),
                "recordsFiltered" => $this->M_invoice_particular->count_filtered($filters),
                "data" => $data,
            );
        
            echo json_encode($output);
             
        }

       
        public function index() {
            $data['page_data'] = [
                'system_module' => 'Invoice',
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
                
                ],
                'scripts_path' => [
                'assets/vendor/libs/moment/moment.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/js/cashier/cashiering-index.js',
                ]
            ] +$this->_notifications_data;        
        
            $data['cash_accounts'] = $this->M_cash_accounts->get_all();
            $this->load->view('pages/cashier/online-payment-approval', $data);
        }

        //routine to get the items in the db
        public function get_item()
        {
           if ($post_data =$this->security->xss_clean($this->input->post())){ 
               $info = $this->M_items->get($post_data['id']);
               
           if (empty($info)){
               return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');

           }
               exit(json_encode($info));
           }
       }

        
        public function cashier_billing() {

            $data['page_data'] = [
                'system_module' => 'Payment Verification',
                'system_section' => '',
                'title' => 'Payments',
                'styles_path' => [
                 
                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
                'assets/vendor/libs/typeahead-js/typeahead.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/css/pages/app-invoice.css',
                
                ],
                'scripts_path' => [
                'assets/vendor/libs/moment/moment.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/flatpickr/flatpickr.js',    
                'assets/vendor/libs/jquery-repeater/jquery-repeater.js',
                'assets/js/cashier/transaction-user.js',
                ]
            ]  + $this->_notifications_data; 
        
            $data['items'] = $this->M_items->get_all();
            $data['payment_options'] = $this->M_payment_options->get_all();
            $data['users'] = $this->M_users->get_all();
            
            $this->load->view('pages/cashier/cashier-billing', $data);
        }


        public function get_item_data() 
        {
            if ($post_data = $this->security->xss_clean($this->input->post())) {
                $info = $this->M_payment_records->get_item_data($post_data['id']);
                if (empty($info)) {
                    return $this->_send_json_response(FALSE, 'An error occurred. Please try again later OO1X.');
                }
    
                exit(json_encode($info));
            }
    
            return $this->_send_json_response(FALSE, 'An error occurred. Please try again later 002x.');
        }


      
        // to display the billing for capital share
        public function capital_share_approval($id=NULL) {
            if (!$id) {
                show_404();
                die();
            }
            $data['page_data'] = [
                'system_module' => 'Invoice Approval Receipt',
                'system_section' => '',
                'title' => 'Invoice Approval Receipt',
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
                    'assets/js/cashier/approval.js',
                ]
            ];
        
            $invoice_details = $this->M_invoice_particular->get_by_user($id);
        
            $matching_invoice = null;
            foreach ($invoice_details as $invoice) {
                if ($invoice['transaction_name'] === 'capital_contribution' && in_array($invoice['status'], ['pending'])) {
                    $matching_invoice = $invoice;
                    break;
                }
            }
        
            if ($matching_invoice) {
                $data['payment_records'] = $this->M_payment_records->get($id);
                $data['payment_options'] = $this->M_payment_options->get_all();
                $data['financial_institution']= $this->M_payment_method->get_all();
               
                $data['invoice_particulars'] = $matching_invoice;
                $data['billing_address'] = $this->M_billing_address->get($id);
                $data['items'] = $this->M_items->get_all();
                $data['users'] = $this->M_users->get_all();
                
                $view = 'pages/cashier/cashier-approval-index';
            } else {
                $view = 'pages/cashier/cashier-approval-index';
            }
        
            $this->load->view($view, $data);
        }

        public function member_approval_billing($id=NULL) {
            if (!$id) {
                show_404();
                die();
            }
            $data['page_data'] = [
                'system_module' => 'Invoice Approval Receipt',
                'system_section' => '',
                'title' => 'Invoice Approval Receipt',
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
                    'assets/js/cashier/approval.js',
                ]
            ] + $this->_notifications_data;
        
            $invoice_details = $this->M_invoice_particular->get_by_user($id);
        
            $matching_invoice = null;
            foreach ($invoice_details as $invoice) {
                if ($invoice['transaction_name'] === 'membership_fee' && in_array($invoice['status'], ['pending'])) {
                    $matching_invoice = $invoice;
                    break;
                }
            }
        
            if ($matching_invoice) {
                $data['financial_institution']= $this->M_payment_method->get_all();
                $data['payment_records'] = $this->M_payment_records->get($id);
                $data['payment_options'] = $this->M_payment_options->get_all();
                $data['invoice_particulars'] = $matching_invoice;
                $data['billing_address'] = $this->M_billing_address->get($id);
                $data['items'] = $this->M_items->get_all();
                $data['users'] = $this->M_users->get_all();
                
                $view = 'pages/cashier/cashier-approval-index';
            } else {
                $view = 'pages/cashier/cashier-approval-index';
            }
        
            $this->load->view($view, $data);
        }
    
    

    
        //  public function save_payment_transaction()
        // {
        //     // Start a database transaction
        //     $this->db->trans_begin();

        //     // Sanitize POST data
        //     $post_data = $this->security->xss_clean($this->input->post());

        //     if (!$post_data) {
        //         return $this->_send_json_response(FALSE, 'Invalid request data. Please try again.');
        //     }
        //     $info = $this->M_cashiering_invoice->get_invoice_id(($post_data['invoice_id']));
        
        //     $transactionType = $info['transaction_name'] ?? '';
           

        //     try {
        //         switch ($transactionType) {
        //             case 'membership_fee':
        //                 $result = $this->_save_membership_payment($post_data);
        //                 break;

        //             case 'capital_contribution':
        //                 $result = $this->_save_contribution_payment($post_data);
        //                 break;

        //             default:
        //                 throw new Exception('Unknown transaction type.');
        //         }

        //         if (!$result) {
        //             throw new Exception('Failed to save payment transaction.');
        //         }

        //         // Commit the transaction if everything is successful
        //         $this->db->trans_commit();
        //         return $this->_send_json_response(TRUE, 'Transaction saved successfully!');

        //     } catch (Exception $e) {
        //         // Rollback the transaction in case of error
        //         $this->db->trans_rollback();
        //         log_message('error', 'Error saving transaction: ' . $e->getMessage());
        //         return $this->_send_json_response(FALSE, 'An error occurred. Please try again later #01F00.');
        //     }
        // }


    //     private function _save_membership_payment($post_data) {

    //       if ($post_data = $this->security->xss_clean($post_data)){
    //         try{ 
    //             $this->form_validation->set_rules([
    //                 ['field' => 'payment_mode', 'label' => 'Payment Mode', 'rules' => 'required'],
    //                 ['field' => 'payment_status', 'label' => 'Payment Status', 'rules' => 'required'],
    //                 ['field' => 'account_num', 'label' => 'Account Number', 'rules' => 'required'],
    //                 ['field' => 'total_payment', 'label' => 'Payment', 'rules' => 'required'],
    //                 ['field' => 'reference_no', 'label' => 'Reference Number', 'rules' => 'required'],
    //             ]);
            
    //             if ($this->form_validation->run() == FALSE) {
    //                 $validation_errors = $this->form_validation->error_array();
    //                 log_message('error', 'Validation errors: ' . print_r($validation_errors, true));
    //                 return FALSE;
    //             }
            
    //             // Fetch invoice and payment details
    //             $info = $this->M_cashiering_invoice->get($post_data['invoice_id']);
    //             $invoice_details = $this->M_invoice_particular->get($post_data['invoice_id']);
    //             $payment_record_details = $this->M_payment_records->get_by_invoice_id($invoice_details['id']);
                
            
    //             if (empty($info)) {
    //                 log_message('error', 'Invoice not found for ID: ' . $post_data['invoice_id']);
    //                 return FALSE;
    //             }
            
          
    //             $payment_mode = $post_data['payment_mode'] ?? 0;
    //             $status = $post_data['payment_status'] ?? '';
    //             $cashier = $post_data['cashier_name'] ?? '';
    //             $account_number = $post_data['account_num'] ?? '';
    //             $reference_number = $post_data['reference_no'] ?? '';
    //             $payment = $post_data['total_payment'] ?? '';
    //             $OrNumber = $this->generateOrNumber();
            
            
    //             $invoice_data = [
    //                 'status' => $status,
    //                 'issued_by' => $cashier
    //             ] + $this->_update_additional;
            
            
    //             $transactions_update = [
    //                 'payment_date' => $payment_record_details['payment_date'],
    //                 'processed_by' => $cashier,
    //                 'official_receipt_number' => $OrNumber,
    //                 'user_id' => $info['user_id'],
    //                 'billing_address_id' =>$info['billing_address_id']
    //             ] + $this->_create_additional;

            
            
    //             if (!$this->M_cashiering_invoice->update($post_data['invoice_id'], $invoice_data)) {
    //                 log_message('error', 'Failed to update invoice for ID: ' . $post_data['invoice_id']);
    //                 return $this->_send_json_response(FALSE, 'Database error.');
    //             }
                
    //             $receipt_id = $this->M_official_receipt->insert($transactions_update);
                
    //             $or_particulars = [ 
    //                 'item_id' => $invoice_details['item_id'],
    //                 'receipt_id' =>$receipt_id ,
    //                 'invoice_number' => $info['invoice_number'],
    //                 'quantity' => $invoice_details['quantity'],
    //                 'unit_cost'=>$invoice_details['unit_cost'], 
    //                 'total_cost'=> $invoice_details['total_cost'],
    //             ] +$this->_create_additional;

    //             if (!$receipt_id) {
    //                 log_message('error', 'Failed to insert financial transaction record.');
    //                 return $this->_send_json_response(FALSE, 'Database error.');
    //             }

    //             $payment_records = [
    //                 'status ' => $status,
    //                 'payment_type_id' => $payment_mode,
    //                 'or_id' =>$receipt_id,
    //                 'account_num' => $account_number,
    //                 'reference_num' => $reference_number,
    //                 'total_payment' => $payment,
    //             ] + $this->_update_additional;
            
    //                 // Update payment records
    //             if (!$this->M_payment_records->update_status_invoice($invoice_details['id'], $payment_records)) {
    //                 log_message('error', 'Failed to update payment records for invoice ID: ' . $invoice_details['id']);
    //                 return $this->_send_json_response(FALSE, 'Database error.');
    //             }


    //             if (!$this->M_receipt_particulars->insert($or_particulars)) {
    //                 log_message('error', 'Failed to update payment records for invoice ID: ' . $invoice_details['id']);
    //                 return $this->_send_json_response(FALSE, 'Database error.');
    //             }

    //             $this->db->trans_commit();
    //             log_message('info', 'Official Receipt data inserted successfully.');
    //             return $this->_send_json_response(TRUE, 'Data updated successfully!');
                
    //          } catch (Exception $e) {
    //             // Rollback transaction and return error response
    //             $this->db->trans_rollback();
    //             return $this->_send_json_response(FALSE, 'An error occurred: ' . $e->getMessage());
    //         }
    //         } else {
    //             // Handle missing or invalid POST data
    //             return $this->_send_json_response(FALSE, 'No data received.');
    //         }
    //    }

        
      

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

