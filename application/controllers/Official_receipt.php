<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Official_receipt extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

       
        $this->load->model('Employees_model', 'M_employees');
        $this->load->model('Users_model', 'M_users');
        $this->load->model('Units_model', 'M_units');
        $this->load->model('Positions_model', 'M_positions');
        $this->load->model('Departments_model', 'M_departments');
        $this->load->model('Payment_method_model','M_payment_method');
        $this->load->model('User_logs_model', 'M_user_logs');
        $this->load->model('Cashiering_invoice_model','M_cashiering_invoice');
        $this->load->helper('string');
        $this->load->model('Invoice_particulars_model', 'M_invoice_particular');
        $this->load->model('Capital_contributions_model', 'M_capital_contributions');
        $this->load->model('Cash_accounts_model', 'M_cash_accounts');
        $this->load->model('Billing_address_model' , 'M_billing_address');
        $this->load->model('Ledger_model', 'M_ledger_model');
        $this->load->model('Payment_records_model','M_payment_records');
    
        $this->load->model('Official_receipts_model', 'M_official_receipt');  
        $this->load->model('Receipt_particulars_model', 'M_receipt_particulars');    
        $this->load->model('Payment_options_model', 'M_payment_options');
        $this->load->model('Items_model', 'M_items');
        $this->load->model('Payment_account_model','M_payment_account');
        $this->load->model('Transaction_category_model', 'M_transaction_category');
        $this->load->model('Transaction_types_model', 'M_transaction_type');
    

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

    }

   
   
     //to display rceipt view
        public function receipt_view($invoice_id = NULL)
        {
        
            if (!$invoice_id) {
                show_404(); // Handle error if no invoice_id is passed
            }
        
            // Set up page data
            $data['page_data'] = [
                'system_module' => 'Invoice',
                'system_section' => '',
                'title' => 'Invoice',
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
                    'assets/js/cashier/approval.js',
                ]
            ] + $this->_notifications_data;
        
            // Get payment proof data
            $data['receipt'] = $this->M_payment_records->get_payment_proof($invoice_id);
            $this->load->view('pages/cashier/receipt-display', $data);
        }
        

  
   
}
