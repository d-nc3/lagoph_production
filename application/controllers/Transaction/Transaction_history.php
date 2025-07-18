<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_history extends CI_Controller
{

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
        $this->load->model('Transaction_types_cash_account_model','M_transaction_cash_map');

        //helpers:
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

        $this->_user_additional = array(
            'user_id' => isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_EMAIL,
            'entity_name' => 'Employee',
            'ip_address' =>  $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']

        );

        $this->_notifications_data = [
            'notifications' => get_top_notifications($_SESSION['user_id']),
            'unread_count' => get_unread_count($_SESSION['user_id']),
            'new_count' => get_new_count($_SESSION['user_id'])
        ];



        $this->_user_id  = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
        $this->_user_email  = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;
        $this->_user_role  = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
        $this->_first_name  = isset($_SESSION['first_name']) ? $this->session->userdata('first_name') : DEFAULT_ADMIN_USER_ROLE;
        $this->_last_name  = isset($_SESSION['last_name']) ? $this->session->userdata('last_name') : DEFAULT_ADMIN_USER_ROLE;
        $this->redirect_if_not_logged_in();
    }

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
        $draw = $this->security->xss_clean($this->input->post('draw'));


        // Apply filters
        $filters = array();
        if (!empty($search['value'])) {
            $filters['search'] = $search['value'];
        }

        // Get filtered data 

        // remove uneccesarry joins and datas
        $list = $this->M_receipt_particulars->get_all_filtered($filters, $order, $start, $length);
        $data = array();
        $no = $start;
        foreach ($list as $transactions) {
            $no++;
            $row = array();
            $row['id'] = $transactions->id;
            $row['name'] = $transactions->name;
            $row['transaction_name'] = $transactions->transaction_name;
            $row['email'] = $transactions->email;
            $row['first_name'] = $transactions->first_name;
            $row['last_name'] = $transactions->last_name;
            $row['user_id'] = $transactions->user_id;
            $row['receipt_id'] = $transactions->receipt_id;
            $row['official_receipt_number'] = $transactions->official_receipt_number;
            $row['invoice_number'] = $transactions->invoice_number;
            $row['payment_date'] = $transactions->payment_date;

            $data[] = $row;
        }

        // Prepare the output for DataTables
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->M_receipt_particulars->count_all(),
            "recordsFiltered" => $this->M_receipt_particulars->count_filtered($filters),
            "data" => $data,
        );

        // Return the JSON response


        echo json_encode($output);
    }


    public function index()
    {
        // if (!has_permissions('view_transaction_history')){
        //     show_404();
        //     return;
        // }

        $data['page_data'] = [
            'system_module' => 'Official Receipt History',
            'system_section' => '',
            'title' => 'Official Receipt',
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
                'assets/js/transaction/index.js',
            ]
        ] + $this->_notifications_data;


        $this->load->view('pages/cashier/transactions-history', $data);
    }

        
    public function view($id=NULL) {

        // if (!$id ||!has_permissions('view_transaction_history') ) {
        //     show_404();
        //     return;
        // }

        $data['page_data'] = [
            'system_module' => 'Transaction Receipt',
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
                'assets/js/payment/payment.js',
                'assets/js/invoice/member-invoice-index.js',
            ]
        ] + $this->_notifications_data;
    
        // Fetch the invoice details from the model using the id for the or receipt
        $data['payment_details'] = $this->M_payment_records->_get_receipt_details($id);
        $payment_details = isset($data['payment_details'][0]) ? $data['payment_details'][0] : [];
        $data['payment_details'] = $payment_details;
        $this->load->view('pages/general/official-receipt-index', $data);
        
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
