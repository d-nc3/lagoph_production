<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_membership extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //User related model:
        $this->load->model('Users_model', 'M_users');
        $this->load->model('User_logs_model', 'M_user_logs');
        $this->load->model('Billing_address_model', 'M_billing_address');
        
        //Cashiering related model
        $this->load->model('Cashiering_invoice_model', 'M_cashiering_invoice');
        $this->load->model('Payment_records_model', 'M_payment_records');
        $this->load->model('Payment_method_model', 'M_payment_methods');
        $this->load->model('Payment_options_model', 'M_payment_options');
        $this->load->helper('string');

        //Invoice related model
        $this->load->model('Invoice_particulars_model', 'M_invoice_particular');
        $this->load->model('Transaction_category_model', 'M_transaction_category');

        // User session related data:
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

     

        $this->_log_additional = array(
            'user_id' => isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_EMAIL,
            'entity_name' => $this->_user_role,
            'ip_address' =>  $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']

        );
    }

    private function redirect_if_not_logged_in()
    {
        if (!isset($_SESSION['user_email'])) {
            redirect('Auth');
        }
    }


    
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
                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
                'assets/vendor/libs/typeahead-js/typeahead.css',
                'assets/vendor/libs/bs-stepper/bs-stepper.css',
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/@form-validation/form-validation.css',
            ],
            'scripts_path' => [
                'assets/js/payment/index.js',
                'assets/js/invoice/member-invoice-index.js',
                'assets/js/utilities/selectHandler.js',
            ]
        ] + $this->_notifications_data;

        $invoice_details = $this->M_invoice_particular->get_by_user($this->_user_id);

        $matching_invoice = null;
        foreach ($invoice_details as $invoice) {
            if ($invoice['transaction_name'] === 'Membership Fee' && in_array($invoice['status'], ['pending', 'payment-initiated', 'completed'])) {
                $matching_invoice = $invoice;
                break;
            }
        }

        if ($matching_invoice) {

            $data['invoice_particulars'] = $matching_invoice;
            $invoice_id = $matching_invoice['cashiering_invoice_id'];
            $data['receipt'] = $this->M_payment_records->get_payment_proof($invoice_id);
            $data['billing_address'] = $this->M_billing_address->get($this->_user_id);
            $data['payment_options'] = $this->M_payment_options->get_option_online();
            $data['payment_method'] = $this->M_payment_methods->get_online_method();

            $view = 'pages/invoice/billing-summary-index';
        } else {
            $view = 'pages/invoice/membership-agreement-index';
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

    // generate membership billing 
    public function generate_membership_billing()
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            try {

                $rules = [
                    ['field' => 'terms_checkbox', 'label' => 'Checkbox', 'rules' => 'required'],
                ];


                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() === FALSE) {

                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }

                $this->db->trans_begin();


                $billing_address = $this->M_billing_address->get($this->_user_id);
                $transaction_name = 'Membership Fee';
                $type_id =  $this->M_transaction_category->get_by_name($transaction_name);

                $refNumber = $this->generateInvoiceNumber();

                $_membership_invoice = [
                    'user_id' =>  $this->_user_id,
                    'invoice_number' => $refNumber,
                    'billing_address_id' => $billing_address['id'],
                    'transaction_category_id' => $type_id,
                    'amount' => 500,
                    'date_issued' => date('Y-m-d'),
                    'date_due' => NULL,
                    'billing_address_id' => $billing_address['id'],
                    'created_by' => 'system',
                    'updated_by' => 'system',
                    'status' => 'pending',
                ];



                $invoice_id = $this->M_cashiering_invoice->insert($_membership_invoice);

                if (!$invoice_id) {
                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                }


                $_invoice_particular = [
                    'cashiering_invoice_id' => $invoice_id,
                    'item_id' => 1,
                    'quantity' => 1,
                    'unit_cost' => 500,
                    'total_cost' => 500
                ] + $this->_create_additional;


                if (!$this->M_invoice_particular->insert($_invoice_particular)) {
                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                }

                $role = ['role' => 'Member'] + $this->_update_additional;
                $admin_logs = [
                    'type_of_action' => 'Generated An Invoice',
                    'action_description' => 'User ' . $this->_user_email  . ' Generated an Invoice for membership'
                ] + $this->_log_additional;

                if (!$this->M_user_logs->insert($admin_logs)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                }

                $this->db->trans_commit();
                return $this->_send_json_response(TRUE, 'You have successfully agreed to the Terms and Conditions');
            } catch (Exception $e) {

                $this->db->trans_rollback();
                return $this->_send_json_response(FALSE, 'An error occurred: ' . $e->getMessage());
            }
        } else {

            return $this->_send_json_response(FALSE, 'No data received.');
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
