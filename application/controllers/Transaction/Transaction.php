<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{



    public function __construct()
    {

        parent::__construct();





        //Employees related models

        $this->load->model('Employees_model', 'M_employees');

        $this->load->model('Members_model', 'M_members');

        $this->load->model('Positions_model', 'M_positions');

        $this->load->model('Departments_model', 'M_departments');



        //User related models

        $this->load->model('Users_model', 'M_users');

        $this->load->model('User_logs_model', 'M_user_logs');

        $this->load->model('Billing_address_model', 'M_billing_address');





        //Member related models

        $this->load->model('Members_model', 'M_member');

        $this->load->model('Units_model', 'M_units');

        $this->load->model('Member_balance_model', 'M_member_balance');



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

            'ip_address' => $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']



        );





        $this->_notifications_data = [

            'notifications' => get_top_notifications($_SESSION['user_id']),

            'unread_count' => get_unread_count($_SESSION['user_id']),

            'new_count' => get_new_count($_SESSION['user_id'])

        ];





        $this->_user_id = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;

        $this->_user_email = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;

        $this->_user_role = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;

        $this->_first_name = isset($_SESSION['first_name']) ? $this->session->userdata('first_name') : DEFAULT_ADMIN_USER_ROLE;

        $this->_last_name = isset($_SESSION['last_name']) ? $this->session->userdata('last_name') : DEFAULT_ADMIN_USER_ROLE;

        $this->redirect_if_not_logged_in();



        $this->_log_additional = array(

            'user_id' => isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_EMAIL,

            'entity_name' => $this->_user_role,

            'ip_address' => $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']



        );

    }



    private function redirect_if_not_logged_in()
    {

        if (!isset($_SESSION['user_email'])) {

            redirect('Auth');

        }

    }



    public function user_dt_list()
    {


        $formatter = function ($detail) {

            return [
                'id' => $detail->id,
                'first_name' => $detail->first_name,
                'last_name' => $detail->last_name,
                'email' => $detail->email,
                'date_issued' => $detail->date_issued,
                'status' => !empty($detail->status)
                    ? ($detail->status === 'payment-initiated' ? 'Payment Initiated' : 'Completed')
                    : 'No Activity',
            ];

        };

        $filters = array(

            'search' => $this->input->post('search')['value'],  // Getting search term from DataTable
            'status' => $this->input->post('status'),
            'start' =>$this->input->post('start'),
            'length' =>$this->input->post('length')


        );




        $output = get_datatable($this, $this->M_users, $formatter, $filters);
        echo json_encode($output);

    }



    public function payment_dt_list()
    {
       $formatter = function ($detail) {
            return [
                'id' => $detail->id,
                'first_name' => $detail->first_name,
                'last_name' => $detail->last_name,
                'payment_date' => $detail->payment_date,
                'status' => $detail->status,
            ];
        };

        $filters = array(
            'search' => $this->input->post('search'),  // Getting search term from DataTable
            'user_id' => $this->input->post('user_id'),
            'status' => $this->input->post('status')
        );

        $output = get_datatable($this, $this->M_payment_records, $formatter, $filters);
        echo json_encode($output);
    }



    public function index()
    {

        if (!has_permissions('process_payments')) {

            show_404();

            return;

        }



        $data['page_data'] = [

            'system_module' => 'Payment Verification',

            'system_section' => 'Sales & Payment',

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

        ] + $this->_notifications_data;



        $data['items'] = $this->M_items->get_all();

        $data['payment_options'] = $this->M_payment_options->get_all();

        $data['users'] = $this->M_users->get_all();





        $data['all_users'] = count_all('users', 'deleted_at', NULL);

        $data['paid_users'] = count_all('payment_records', 'status', 'Completed');



        $data['total_payments'] = total_amount_calculator('payment_records', 'total_payment', 'completed', 'status');

        $data['total_pending_collection'] = total_amount_calculator('cashiering_invoice', 'amount', 'pending', 'status');

        $this->load->view('pages/cashier/cashier-billing', $data);

    }



    public function view($id = NULL)
    {

        if ($id === NULL || !has_permissions('process_payments')) {

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

                'assets/js/cashier/cashier-billing-index.js',

                'assets/js/transaction/or_payment.js',

            ]

        ] + $this->_notifications_data;







        $data['items'] = $this->M_items->get_all();

        $data['payment_options'] = $this->M_payment_options->get_all();

        $data['transaction_category'] = $this->M_transaction_category->get_all();

        $data['users'] = $this->M_users->get($id);

        $data['billing_address'] = $this->M_billing_address->get($id);

        $data['payment_method'] = $this->M_payment_method->get_all();

        $data['payment_records'] = $this->M_payment_records->get_by_user_id($id, 'pending');





        $this->load->view('pages/transactions/status/payment-initiated', $data);

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



    public function get_method()
    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            $info = $this->M_payment_method->get_by_mode($post_data['id']);



            if (empty($info)) {

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later OO1X.');

            }



            exit(json_encode($info));

        }



        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later 002x.');

    }



    public function capital_share_approval($id = NULL)
    {

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

            $data['financial_institution'] = $this->M_payment_method->get_all();



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





    public function member_approval_billing($id = NULL)
    {

        if ($id === NULL || !has_permissions('process_payments')) {

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

            $data['financial_institution'] = $this->M_payment_method->get_all();

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





    public function payment()
    {

        $post_data = $this->security->xss_clean($this->input->post());

        if (!$post_data) {

            return $this->_send_json_response(FALSE, 'No data received.');

        }



        try {

            $info = $this->M_cashiering_invoice->get($post_data['invoice_id'] ?? null);



            switch ($info) {

                case NULL:

                    return $this->process_direct_payment($post_data);

                case !NULL:

                    return $this->save_invoice_payment($info);

                default:

                    return $this->_send_json_response(FALSE, 'Invalid payment method.');

            }

        } catch (Exception $e) {

            log_message('error', 'Payment error: ' . $e->getMessage());

            return $this->_send_json_response(FALSE, 'An unexpected error occurred.');

        }

    }





    public function process_direct_payment($post_data, $info = null)
    {

        $this->form_validation->set_rules([

            ['field' => 'payment_mode', 'label' => 'Payment Mode', 'rules' => 'required'],

            ['field' => 'total_payment', 'label' => 'Total Payment', 'rules' => 'required|numeric'],

            ['field' => 'payment_status', 'label' => 'Payment Status', 'rules' => 'required']

        ]);



        if ($this->form_validation->run() === FALSE) {

            return $this->_send_json_response(FALSE, validation_errors());

        }



        $this->db->trans_begin();



        try {



            $cashier = $post_data['issued_by'];

            $orNumber = generate_or_number();

            $billing_id = $post_data['billing_id'];

            $user_id = $post_data['user_id'];

            $transaction_category = $post_data['transaction_category'];



            // Process Capital Contribution

            if ($transaction_category === '5') {



                $this->_update_member_balance($post_data);



                $capital_share = $this->M_capital_contributions->get_by_user_id($user_id);

                $contribution_summary = $this->M_cap_account_due->get_by_user_id($user_id);

                $date = date('Y-m-d H:i:s');







                $subscribed_amount = isset($capital_share['outstanding_balance'])

                    ? $capital_share['outstanding_balance']

                    : (isset($capital_share['subscribed_amount']) ? $capital_share['subscribed_amount'] : 0);



                $parValue = isset($capital_share['amount_per_share']) ? $capital_share['amount_per_share'] : 0;

                $balance = $subscribed_amount - $post_data['total_payment'];



                $new_parValue = $balance / $parValue + 1;



                $share_update = [

                    'outstanding_balance' => $balance,

                    'number_of_shares' => $new_parValue,

                ] + $this->_update_additional;



                if (!$this->M_capital_contributions->update($capital_share['id'], $share_update)) {

                    log_message('error', 'Failed to update capital contribution balance for ID: ' . $capital_share['id']);

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'Error updating capital contribution balance.');

                }



                if ($capital_share['outstanding_balance'] === NULL) {

                    if (!$this->_process_contribution($capital_share, $contribution_summary, $date, $post_data['total_payment'])) {

                        $this->db->trans_rollback();

                        return $this->_send_json_response(FALSE, 'Invalid data');

                    }

                } else {

                    if (!$this->_update_contribution_balance($capital_share, $post_data['total_payment'])) {

                        $this->db->trans_rollback();

                        return $this->_send_json_response(FALSE, 'Invalid data');

                    }

                }

            }



            // Official Receipt Data

            $official_receipt = [

                'billing_address_id' => $billing_id,

                'user_id' => $post_data['user_id'],

                'transaction_category_id' => $post_data['transaction_category_id'] ?? '4',

                'payment_date' => date('Y-m-d H:i:s'),

                'processed_by' => $cashier,

                'official_receipt_number' => $orNumber,

            ];



            $receipt_id = $this->M_official_receipt->insert($official_receipt);

            if (!$receipt_id) {

                $this->db->trans_rollback();

                throw new Exception('Failed to create official receipt.');

            }



            // Process Particulars

            $this->_process_receipt_particulars($post_data['group-a'] ?? [], $receipt_id, $post_data);



            // Commit the transaction if everything is successful

            $this->db->trans_commit();

            return $this->_send_json_response(TRUE, 'Direct payment successfully processed.');

        } catch (Exception $e) {

            // Rollback on error

            $this->db->trans_rollback();

            log_message('error', 'Direct Payment Error: ' . $e->getMessage());

            return $this->_send_json_response(FALSE, 'Failed to process payment. Please try again.');

        }

    }



    public function save_invoice_payment($info)
    {

        if (!$this->input->post()) {

            return $this->_send_json_response(FALSE, 'No payment data submitted.');

        }



        $post_data = $this->security->xss_clean($this->input->post());



        try {



            if (empty($info)) {

                return $this->_send_json_response(FALSE, 'Payment cannot be processed at this time.');

            }



            // Validate required fields

            if (empty($post_data['total_payment']) || !is_numeric($post_data['total_payment'])) {

                return $this->_send_json_response(FALSE, 'Payment cannot be processed at this time');

            }



            $this->_validate_payment($post_data);





            $this->db->trans_start();

            $receipt_id = $this->_process_payment($info, $post_data);

            $this->_log_admin_action();

            $this->db->trans_complete();



            if ($this->db->trans_status() === FALSE) {

                return $this->_send_json_response(FALSE, 'Payment cannot be processed at this time');

            }

            return $this->_send_json_response(TRUE, 'Payment successfully submitted!', ['receipt_id' => $receipt_id]);

        } catch (DatabaseException $e) {

            $this->db->trans_rollback();

            log_message('error', 'Database Error: ' . $e->getMessage());

            return $this->_send_json_response(FALSE, 'Payment failed. Please try again.');

        } catch (Exception $e) {

            $this->db->trans_rollback();

            log_message('error', 'Error: ' . $e->getMessage());

            return $this->_send_json_response(FALSE, $e->getMessage());

        }

    }





    private function _validate_payment($post_data)
    {

        $rules = [

            ['field' => 'payment_mode', 'label' => 'Payment Mode', 'rules' => 'required'],

            ['field' => 'total_payment', 'label' => 'Total Payment', 'rules' => 'required'],

            ['field' => 'payment_status', 'label' => 'Payment Status', 'rules' => 'required']

        ];



        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() === FALSE) {

            throw new Exception(validation_errors());

        }

    }



    private function _process_payment($info, $post_data)
    {

        $payment_mode = $post_data['payment_mode'];

        $payment_method = $post_data['payment_method'];

        $status = $post_data['payment_status'];

        $remarks = $post_data['remarks'] ?? NULL;

        $user_id = $post_data['user_id'];

        $billing_id = $post_data['billing_id'];

        $cashier = $post_data['issued_by'];

        $orNumber = generate_or_number();

        $transaction_category = $info['transaction_category_id'];



        switch ($transaction_category) {

            case 5:

            case 2:  // Capital Contribution

                $this->_process_capital_contribution($user_id, $post_data);

                $this->_update_member_balance($post_data);

                break;





            case 3: // Loan Payment

                $this->_process_loans($user_id, $post_data);



                $member_id = $this->M_members->get_by_user($user_id);

                $get_loan = get_by_code_and_table($member_id['id'], 'member_id', 'loans');

                $member_balance = get_by_code_and_table($user_id, 'user_id', 'member_balance');



                if ($get_loan['remaining_balance'] == 0.00) {

                    $reimburse_amount = $member_balance['available_credit'] + $get_loan['loan_amount'];

                    $reimburse_data = ['available_credit' => $reimburse_amount] + $this->_update_additional;



                    $update_balance = $this->M_member_balance->update($user_id, $reimburse_data);

                    if (!$update_balance) {

                        return $this->_send_json_response(FALSE, 'Payment cannot be processed at this time. Please try again.');

                    }

                }

                break;

        }



        // This section must be outside the switch to always execute

        $official_receipt = $this->_create_official_receipt(

            $post_data,

            $user_id,

            $billing_id,

            $cashier,

            $orNumber,

            $transaction_category

        );



        $receipt_id = $this->M_official_receipt->insert($official_receipt);

        if (!$receipt_id) {

            throw new Exception('Failed to create official receipt.');

        }



        $invoice_data = [

            'status' => $status,

            'issued_by' => $cashier,

        ] + $this->_update_additional;



        if (!$this->M_cashiering_invoice->update($post_data['invoice_id'], $invoice_data)) {

            throw new Exception('Failed to update invoice.');

        }



        $this->_process_receipt_particulars($post_data['group-a'] ?? [], $receipt_id, $post_data);



        return $receipt_id;

    }





    private function _update_member_balance($post_data)
    {

        $member_id = $post_data['user_id'];

        $member_balance = $this->M_member_balance->get_by_user_id($member_id);



        if ($member_balance === NULL) {



            $total_payment = $post_data['total_payment'];

            $balance = $total_payment * 0.9; // because 0.9 is the multiplier for the member balance

            // also remember to consider the deposits so if deposit function occurs add the following



            /* ($total_payment + $member_balance['total_deposit'])*0.9

        This block of code considers the total deposit of the member

        */



            $member_balance_update = [

                'user_id' => $member_id,

                'total_contributions' => $post_data['total_payment'],

                'available_credit' => $balance,

            ] + $this->_create_additional;





            if (!$this->M_member_balance->insert($member_balance_update)) {

                log_message('error', 'Member Inserting Data ');

                throw new Exception('Error updating member balance.');

            }

        } else {

            // Update existing balance

            $total_payment = $post_data['total_payment'];

            $balance = ($total_payment + $member_balance['total_contributions']) * 0.9; // because 0.9 is the multiplier for the member balance



            $member_balance_update = [

                'total_contributions' => $member_balance['total_contributions'] + $post_data['total_payment'],

                'available_credit' => $balance,

            ];



            $updateData = $this->M_member_balance->update($member_id, $member_balance_update);

            if (!$updateData) {

                log_message('error', 'Member Balance Update Failed');

                throw new Exception('Error updating member balance.');

            } else {

                log_message('info', 'Member Balance Successfully Updated: User ID ' . $member_id);

            }

        }

    }







    private function _create_official_receipt($post_data, $user_id, $billing_id, $cashier, $orNumber, $transaction_category)
    {

        return [

            'user_id' => $user_id,

            'billing_address_id' => $billing_id,

            'transaction_category_id' => $transaction_category,

            'payment_date' => date("YmdHis"),

            'processed_by' => $cashier,

            'official_receipt_number' => $orNumber

        ] + $this->_create_additional;

    }



    private function _log_admin_action()
    {

        $admin_logs = [

            'type_of_action' => 'Payment Approved',

            'action_description' => 'User ' . $this->_user_email . ' generated an invoice for membership'

        ] + $this->_log_additional;



        if (!$this->M_user_logs->insert($admin_logs)) {

            throw new Exception('A database error occurred. Please try again later.');

        }

    }



    private function _process_capital_contribution($user_id, $post_data)
    {

        $capital_share = $this->M_capital_contributions->get_by_user_id($user_id);

        $contribution_summary = $this->M_cap_account_due->get_by_user_id($user_id);

        $date = date('Y-m-d');



        $subscribed_amount = isset($capital_share['outstanding_balance'])

            ? $capital_share['outstanding_balance']

            : (isset($capital_share['subscribed_amount']) ? $capital_share['subscribed_amount'] : 0);



        $parValue = isset($capital_share['amount_per_share']) ? $capital_share['amount_per_share'] : 0;

        $balance = $subscribed_amount - $post_data['total_payment'];

        $new_parValue = $balance / $parValue + 1;



        $share_update = [

            'outstanding_balance' => $balance,

            'number_of_shares' => $new_parValue,

        ] + $this->_update_additional;



        if (!$this->M_capital_contributions->update($capital_share['id'], $share_update)) {

            log_message('error', 'Failed to update capital contribution balance for ID: ' . $capital_share['id']);

            throw new Exception('Error updating capital contribution balance.');

        }



        if ($capital_share['outstanding_balance'] === NULL) {

            $this->_process_contribution($capital_share, $contribution_summary, $date, $post_data['total_payment']);

        } else {

            $this->_update_contribution_balance($capital_share, $post_data['total_payment']);

        }

    }



    // this logic is for processing loans

    private function _process_loans($user_id, $post_data)
    {

        $memberId = $this->M_member->get_by_user($user_id);

        $loan = $this->M_loans->get_loan_info($memberId['id']);



        // Validate loan exists

        if (!$loan || empty($loan['loan_id'])) {

            throw new Exception('No active loan found for the member.');

        }



        $loan_repayment = $this->M_loan_repayment_schedule->pending_loan_repayment($memberId['id'], $post_data['transaction_reference_id']);





        if (!$loan_repayment) {

            return $this->_send_json_response(FALSE, 'payment cannot be processed at this time');

        }



        $total_payment = (float) ($post_data['total_payment'] ?? 0);



        if ($total_payment <= 0) {

            return $this->_send_json_response(FALSE, 'Payment cannot be processed at this time');

        }



        $loan_amount = $loan['remaining_balance'] ?? ($loan['principal_with_interest'] ?? 0);



        if ($total_payment > $loan_amount) {

            return $this->_send_json_response(FALSE, 'Payment cannot be processed at this time');

        }



        $balance = (float) $loan_amount - (float) $total_payment;



        $loan_update = [

            'remaining_balance' => $balance,

        ] + $this->_update_additional;



        if ($balance === 0.0) {

            $update_data = [

                'loan_status' => 'Fully Paid'

            ] + $this->_update_additional;



            if (!$this->M_loans->update($loan['loan_id'], $update_data)) {

                $this->db->trans_rollback();

                return $this->_send_json_response(FALSE, 'Payment cannot be processed at this time');

            }

        }

        // Start transaction

        $this->db->trans_start();





        if (!$this->M_loans->update($loan['loan_id'], $loan_update)) {

            log_message('error', 'Loan balance update failed for ID: ' . $loan['loan_id']);

            $this->db->trans_rollback();

            throw new Exception('Error updating loan balance.');

        }



        if (

            !$this->M_loan_repayment_schedule->update(

                $loan_repayment['id'],

                ['status' => 'paid', 'amount_paid' => $post_data['total_payment']]

            )

        ) {

            log_message('error', 'Repayment status update failed for ID: ' . $loan_repayment['id']);

            $this->db->trans_rollback();

            throw new Exception('Error updating repayment status.');

        }



        $this->db->trans_complete();



        if ($this->db->trans_status() === false) {

            throw new Exception('Transaction failed.');

        }

    }









    private function _process_contribution($capital_share, $contribution_summary, $date, $payment)
    {

        $subscribed_amount = isset($capital_share['subscribed_amount']) ? $capital_share['subscribed_amount'] : 0;

        $parValue = isset($capital_share['amount_per_share']) ? $capital_share['amount_per_share'] : 0;

        $balance = $subscribed_amount - $payment;



        $new_parValue = $balance / $parValue + 1;





        for ($i = 0; $i < $new_parValue; $i++) {





            $due_date = date('Y-m-d H:i:s', strtotime($date . " +$i month"));

            $status = ($i === 0) ? 'paid' : 'pending';

            $payment_due = ($i === 0) ? $payment : $parValue;



            $data = [

                'capital_contribution_id' => $capital_share['id'],

                'amount_due' => $payment_due,

                'due_date' => $due_date,

                'status' => $status,

            ] + $this->_create_additional;



            $inserted = $this->M_cap_account_due->insert($data);



            if (!$inserted) {

                $this->db->trans_rollback();

                return $this->_send_json_response(FALSE, 'Database error.');

            }

        }

    }



    private function _process_receipt_particulars(array $particulars, $receipt_id, $post_data)
    {

        foreach ($particulars as $particular) {

            if (isset($particular['item_details'], $particular['item_cost'], $particular['item_quantity'], $particular['item_total'])) {

                $data = [

                    'item_id' => $this->security->xss_clean($particular['item_details']),

                    'receipt_id' => $receipt_id,

                    'quantity' => $this->security->xss_clean($particular['item_quantity']),

                    'unit_cost' => $this->security->xss_clean($particular['item_cost']),

                    'total_cost' => $this->security->xss_clean($particular['item_total']),

                ];



                $or_id = $this->M_receipt_particulars->insert($data);



                if (!$or_id) {

                    throw new Exception('Failed to insert receipt particulars.');

                }



                if (!empty($post_data['particulars_id'])) {

                    $payment = [



                        'payment_method_id' => $post_data['payment_method'] ?: NULL,

                        'total_payment' => $post_data['total_payment'],

                        'status' => $post_data['payment_status'],

                        'date_verified' => date('Y-m-d H:i:s'),

                        'payment_method_id' => $post_data['payment_method'],

                        'or_particulars_id' => $or_id,

                        // 'account_name' => $post_data['account_name'],

                        // 'account_number' => $post_data['account_num'],

                        'reference_number' => $post_data['reference_no']

                    ] + $this->_update_additional;



                    $update_invoice = $this->M_payment_records->update_status_invoice($post_data['particulars_id'], $payment);

                } else {





                    $insertPayment = [



                        'status' => $post_data['payment_status'],

                        'payment_date' => date('Y-m-d H:i:s'),

                        'date_verified' => date('Y-m-d H:i:s'),

                        'total_payment' => $post_data['total_payment'],

                        'status' => $post_data['payment_status'],

                        'payment_method_id' => $post_data['payment_method'],

                        'or_particulars_id' => $or_id,

                        'transaction_category_id' => $post_data['transaction_category'],

                        // 'account_name' => $post_data['account_name'],

                        // 'account_number' => $post_data['account_num'],

                        'reference_number' => $post_data['reference_no'],

                    ] + $this->_create_additional;



                    $insert_payment = $this->M_payment_records->insert($insertPayment);

                }

            }

        }

    }





    // this is to update the contributions in the cap_share_account_due table

    private function _update_contribution_balance($capital_share, $user_payment)
    {

        $total_paid = 0; // Track the total paid amount

        $id = $capital_share['id'];



        $payments = $this->M_cap_account_due->get_all_id($id); // Fetch all scheduled payments





        foreach ($payments as $payment) {

            if (in_array($payment['status'], ['pending', 'payment_initiated'])) {

                if ($user_payment >= $payment['amount_due']) {



                    $user_payment -= $payment['amount_due'];

                    $total_paid += $payment['amount_due'];





                    $data = [

                        'status' => 'paid',

                        'updated_at' => date('Y-m-d H:i:s')

                    ] + $this->_update_additional;



                    if (!$this->M_cap_account_due->update($payment['id'], $data)) {

                        echo "Update failed for payment ID: {$payment['id']}";

                    }

                }





                if ($user_payment <= 0) {

                    break;

                }

            }

        }



        return $total_paid; // Return the total paid amount

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

