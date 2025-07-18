
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pending_invoice extends CI_Controller
{

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

        //helpers: 
        $this->load->helper('analytics_helper');
        $this->load->helper('data_table_helper');
        // User session related models
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
    }

    private function redirect_if_not_logged_in()
    {
        if (!isset($_SESSION['user_email'])) {
            redirect('Auth');
        }
    }

    public function index()
    {

        if (!has_permissions('process_payments')) {
            show_404();
            return;
        }

        $data['page_data'] = [
            'system_module' => 'Invoice',
            'system_section' => '',
            'title' => 'Invoice',
            'styles_path' => [

                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
                'assets/vendor/libs/typeahead-js/typeahead.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/  buttons.bootstrap5.css',
                'assets/vendor/libs/bootstrap-select/bootstrap-select.css',
                'assets/vendor/libs/select2/select2.css',

            ],
            'scripts_path' => [
                'assets/vendor/libs/moment/moment.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/js/cashier/cashiering-index.js',
            ]
        ] + $this->_notifications_data;

        $data['cash_accounts'] = $this->M_cash_accounts->get_all();

        //for data analytics: 
        $data['total_pending_invoice'] = count_all('cashiering_invoice','status', 'pending');
        $data['paid_users'] = count_all('payment_records','status','Completed');
        $data['total_payments'] = total_amount_calculator('payment_records','total_payment','completed','status');
        $data['total_pending_collection'] = total_amount_calculator('cashiering_invoice','amount','pending','status');
        $this->load->view('pages/cashier/online-payment-approval', $data);
    }

    public function dt_list() {

      $formatter = function($particular) {
        return [
            'id' => $particular->id,
            'first_name' => $particular->first_name,
            'last_name' => $particular->last_name,
            'cashiering_invoice_id' => $particular->cashiering_invoice_id,
            'user_id' => $particular->user_id,
            'email' => $particular->email,
            'invoice_number' => $particular->invoice_number,
            'transaction_name' => $particular->transaction_name,
            'date_issued' => $particular->date_issued,
            'status' => $particular->status
        ];
      };
      
        $custom_filters = [
            'status' => 'pending'
        ];                  
    
        $output = get_datatable($this, $this->M_invoice_particular, $formatter, $custom_filters);
        echo json_encode($output);
         
    }



    public function view($invoice_number = NULL)
    {
        if ($invoice_number === NULL || !has_permissions('process_payments')) {
            show_404();
            return;
        }
        $data['page_data'] = [
            'system_module' => 'Transaction',
            'system_section' => '',
            'title' => 'Pending Invoice',
            'styles_path' => [

                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/css/pages/app-invoice.css',
                'assets/vendor/libs/select2/select2.css',
            ],
            'scripts_path' => [
                'assets/vendor/libs/moment/moment.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/flatpickr/flatpickr.js',
                'assets/vendor/libs/jquery-repeater/jquery-repeater.js',
                'assets/js/cards-actions.js',
                'assets/js/utilities/selectHandler.js',
                'assets/js/transaction/or_payment.js',
            ]
        ]  + $this->_notifications_data;

        $cashiering_invoice = $this->M_cashiering_invoice->get_by_invoice_num($invoice_number);

        $data['items'] = $this->M_items->get_all();
        $data['payment_options'] = $this->M_payment_options->get_all();
        $data['users'] = $this->M_users->get($cashiering_invoice['user_id']);
        $data['billing_address'] = $this->M_billing_address->get($cashiering_invoice['user_id']);
        $data['payment_method'] = $this->M_payment_method->get_all();
        $data['invoice_particulars'] = $this->M_invoice_particular->get_invoice_by_status($invoice_number);

        $this->load->view('pages/transactions/status/pending', $data);
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
