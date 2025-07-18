<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_capital_contribution extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //Helper
        $this->load->helper('string');

        //User related data
        $this->load->model('Users_model', 'M_users');
        $this->load->model('User_logs_model', 'M_user_logs');
        $this->load->model('Billing_address_model', 'M_billing_address');

        //Cashiering related data
        $this->load->model('Payment_options_model', 'M_payment_options');
        $this->load->model('Cashiering_invoice_model', 'M_cashiering_invoice');

        //Invoice related data
        $this->load->model('Invoice_particulars_model', 'M_invoice_particular');

        //Payment related data
        $this->load->model('Payment_records_model', 'M_payment_records');
        $this->load->model('Payment_method_model', 'M_payment_methods');
        $this->load->model('Transaction_category_model', 'M_transaction_category');

        //Contributions related model
        $this->load->model('Capital_contributions_model', 'M_capital_contributions');

        // User session related data
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


        $this->_notifications_data = [
            'notifications' => get_top_notifications($_SESSION['user_id']),
            'unread_count' => get_unread_count($_SESSION['user_id']),
            'new_count' => get_new_count($_SESSION['user_id'])
        ];


        $this->_log_additional = array(
            'user_id' => isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_EMAIL,
            'entity_name' => 'Employee',
            'ip_address' =>  $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']

        );
    }

    private function redirect_if_not_logged_in()
    {
        if (!isset($_SESSION['user_email'])) {
            redirect('Auth');
        }
    }


    //former capital invoice
    public function index()
    {
        if (!$this->_user_id) {
            show_404();
            return;
        }

        $data['page_data'] = [
            'system_module' => 'Invoice Approval Receipt',
            'system_section' => '',
            'title' => 'Invoice Approval Receipt',
            'styles_path' => [
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/bs-stepper/bs-stepper.css',
                'assets/vendor/css/pages/wizard-ex-checkout.css',
                'assets/vendor/libs/select2/select2.css',
            ],
            'scripts_path' => [
                'assets/js/utilities/selectHandler.js',
                'assets/js/invoice/capital-share-index.js',
                'assets/vendor/libs/moment/moment.js',
                'assets/js/payment/index.js',

            ]
        ] + $this->_notifications_data;

        $invoice_details = $this->M_invoice_particular->get_by_user($this->_user_id);

        $matching_invoice = null;
        foreach ($invoice_details as $invoice) {
            if (
                $invoice['transaction_name'] === 'Initial Contribution' &&
                in_array($invoice['status'], ['pending', 'payment-initiated', 'completed'])
            ) {
                $matching_invoice = $invoice;
                break;
            }
        }

        if ($matching_invoice) {
            $data['payment_records'] = $this->M_payment_records->get($this->_user_id);
            $data['invoice_particulars'] = $matching_invoice;
            $data['billing_address'] = $this->M_billing_address->get($this->_user_id);
            $data['payment_options'] = $this->M_payment_options->get_option_online();
            $data['payment_method'] = $this->M_payment_methods->get_online_method();
            $view = 'pages/invoice/billing-summary-index';
        } else {
            $view = 'pages/invoice/invoice-capital-index';
        }

        $this->load->view($view, $data);
    }


    public function generateInvoiceNumber()
    {
        $prefix = "INV-";
        $date = date("YmdHis");
        $randomNumber = mt_rand(1000, 9999);
        $referenceNumber = $prefix . $date . $randomNumber;
        return $referenceNumber;
    }

    public function generate_billing_capital()
    {

        $post_data = $this->security->xss_clean($this->input->post());

        if (!$post_data) {
            return $this->_send_json_response(FALSE, 'No data received.');
        }
        $rules = [
            ['field' => 'contribution_amount', 'label' => 'Contribution Amount', 'rules' => 'required'],
            ['field' => 'share_frequency', 'label       ' => 'Number of Shares', 'rules' => 'required'],
            ['field' => 'share_amount', 'label' => 'Amount per Share', 'rules' => 'required'],
            ['field' => 'subscribed_contribution', 'label' => 'Subscribed  Share', 'rules' => 'required'],
            ['field' => 'terms_checkbox', 'label' => 'Terms and Conditions', 'rules' => 'required']
        ];
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() === FALSE) {
            $validation_errors = $this->form_validation->error_array();
            return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
        }
        $this->db->trans_begin();
        $billing_address = $this->M_billing_address->get($this->_user_id);
        $transaction_name = 'Initial Contribution';
        $type_id =  $this->M_transaction_category->get_by_name($transaction_name);

        try {

            $refNumber = $this->generateInvoiceNumber();
            $capital_contributions = [
                'user_id' => $this->_user_id,
                'subscribed_amount' => $post_data['subscribed_contribution'],
                'amount_per_share' => $post_data['share_amount'],
                'number_of_shares' => $post_data['share_frequency'],
                'amount' => $post_data['contribution_amount'],
                'detail' => 'Initial Capital Contribution, First Payment',
                'status' => 'pending',
                'date_issued' => date('Y-m-d H:i:s'),
                'date_paid' => date('Y-m-d H:i:s'),
                'created_by' => 'system',
                'updated_by' => 'system'
            ];

            $invoice_data = [
                'user_id' => $this->_user_id,
                'invoice_number' => $refNumber,
                'transaction_category_id' => $type_id,
                'date_issued' => date('Y-m-d H:i:s'),
                'billing_address_id' => $billing_address['id'],
                'status' => 'pending',
                'amount' => $post_data['contribution_amount']
            ] + $this->_create_additional;




            $invoice_id = $this->M_cashiering_invoice->insert($invoice_data);
            if (!$invoice_id) {
                throw new Exception('Failed to insert invoice data.');
            }


            $capital_contribution_insert = $this->M_capital_contributions->insert($capital_contributions);
            if (!$capital_contribution_insert) {
                throw new Exception('Failed to insert capital contributions.');
            }


            $invoice_particular = [
                'cashiering_invoice_id' => $invoice_id,
                'item_id' => 2,
                'quantity' => 1,
                'unit_cost' => 2000,
                'total_cost' => $post_data['contribution_amount']
            ] + $this->_create_additional;



            if (!$this->M_invoice_particular->insert($invoice_particular)) {
                throw new Exception('Failed to insert invoice particular.');
            }

            $role = ['role' => 'User'] + $this->_update_additional;
            $admin_logs = [
                'type_of_action' => 'Generated an Invoice',
                'action_description' => 'User ' . $this->_user_email  . 'Generated an invoice for Initial Capital share'
            ] + $this->_log_additional;

            if (!$this->M_user_logs->insert($admin_logs)) {
                $this->db->trans_rollback();
                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            }

            $this->db->trans_commit();
            return $this->_send_json_response(TRUE, 'Contribution terms and agreement submitted!');
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, 'An error occurred: ' . $e->getMessage());
        }
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
