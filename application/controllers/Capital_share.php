<?php

use function PHPUnit\Framework\isEmpty;

defined('BASEPATH') or exit('No direct script access allowed');

class Capital_share extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //User related models
        $this->load->model('Users_model', 'M_users');
        $this->load->model('Billing_address_model', 'M_billing_address');
        $this->load->model('User_logs_model', 'M_user_logs');

        //Member related models
        $this->load->model('Members_model', 'M_member');

        //Payment related models
        $this->load->model('Payment_records_model', 'M_payment_records');
        $this->load->model('Payment_options_model', 'M_payment_options');
        $this->load->model('Payment_records_model', 'M_payment_record');
        $this->load->model('Payment_method_model', 'M_payment_methods');
        $this->load->model('Transaction_category_model', 'M_transaction_category');

        //Cpntributions related models
        $this->load->model('Cap_share_account_dues', 'M_capital_share_account_dues');
        $this->load->model('Capital_contributions_model', 'M_capital_contribution');

        //Cashiering related models
        $this->load->model('Cashiering_invoice_model', 'M_cashiering_invoice');
        $this->load->model('Invoice_particulars_model', 'M_invoice_particular');
        $this->load->model('Items_model', 'M_items');

        //Loan related models
        $this->load->model('Loans_repayment_schedule_model', 'M_loan_repayment_schedule');

        //Helpers
        $this->load->helper('transaction_helper');
        $this->load->helper('db_helper');

        //User session related data
        $this->_user_id  = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
        $this->_user_role  = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
        $this->_user_email = isset($SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;

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


        $this->_notifications_data = array(
            'notifications' => get_top_notifications($_SESSION['user_id']),
            'unread_count' => get_unread_count($_SESSION['user_id']),
            'new_count' => get_new_count($_SESSION['user_id'])
        );

        $this->_log_additional = array(
            'user_id' => isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_EMAIL,
            'entity_name' => $this->_user_role,
            'ip_address' =>  $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']

        );
    }



    public function contribution_dt_list($userId = NULL)
    {

        $search = $this->security->xss_clean($this->input->post('search'));
        $order = $this->security->xss_clean($this->input->post('order'));
        $start = $this->security->xss_clean($this->input->post('start'));
        $length = $this->security->xss_clean($this->input->post('length'));
        $draw = $this->security->xss_clean($this->input->post('draw'));
        $user_id = $userId ? $userId : $this->_user_id;


        $filters = array();
        if (!empty($search['value'])) {
            $filters['search'] = $search['value'];
        }

        if (isset($user_id) && $user_id) {
            $filters['user_id'] = $user_id;
        }

        // remove uneccesarry joins and datas
        $list = $this->M_capital_share_account_dues->get_all_records($filters, $order, $start, $length);
        $data = array();
        $no = $start;
        foreach ($list as $detail) {
            $no++;
            $row = array();

            $row['subscribed_amount'] = $detail->subscribed_amount;
            $row['amount_due'] = $detail->amount_due;
            $row['due_date'] = $detail->due_date;
            $row['status'] = $detail->status;
            $row['outstanding_balance'] = $detail->outstanding_balance;

            $data[] = $row;
        }

        // Prepare the output for DataTables
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->M_capital_share_account_dues->count_all_record(),
            "recordsFiltered" => $this->M_capital_share_account_dues->count_filtered_record($filters),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function payment_dt_list()
    {


        $search = $this->security->xss_clean($this->input->post('search'));
        $order = $this->security->xss_clean($this->input->post('order'));
        $start = $this->security->xss_clean($this->input->post('start'));
        $length = $this->security->xss_clean($this->input->post('length'));
        $draw = $this->security->xss_clean($this->input->post('draw'));
        $user_id = $this->_user_id;


        $filters = array();
        if (!empty($search['value'])) {
            $filters['search'] = $search['value'];
        }

        if (isset($user_id) && $user_id) {
            $filters['user_id'] = $user_id;
        }
        // remove uneccesarry joins and datas
        $list = $this->M_payment_records->get_all_records($filters, $order, $start, $length);
        $data = array();
        $no = $start;
        foreach ($list as $detail) {
            $no++;
            $row = array();
            $row['id'] = $detail->id;
            $row['payment_date'] = $detail->payment_date;
            $row['financial_service_provider'] = $detail->financial_service_provider;
            $row['transaction_name'] = $detail->transaction_name;
            $row['account_number'] = $detail->account_number;
            $row['reference_number'] = $detail->reference_number;
            $row['receipt_id'] = $detail->receipt_id;
            $row['total_payment'] = $detail->total_payment;
            $row['status'] = $detail->status;
            $data[] = $row;
        }

        // Prepare the output for DataTables
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->M_payment_records->count_all_record(),
            "recordsFiltered" => $this->M_payment_records->count_filtered_record($filters),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function getAmount()
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $info = $this->M_capital_contribution->get_by_user_id($post_data['id']);
            if (empty($info)) {
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later OO1X.');
            }

            exit(json_encode($info));
        }

        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later 002x.');
    }




    public function index()
    {
        if(!has_permissions('view_contribution')){
            show_404();
            return;
        }

        $data['page_data'] = [
            'system_module' => 'Capital Share',
            'system_section' => '',
            'title' => 'Capital Contribution',
            'styles_path' => [
                'assets/vendor/css/pages/page-auth.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/flatpickr/flatpickr.css',
                'assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css',
                'assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css',
                'assets/vendor/libs/jquery-timepicker/jquery-timepicker.css',
                'assets/vendor/libs/pickr/pickr-themes.css',
            ],
            'scripts_path' => [
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/select2/select2.js',
                'assets/vendor/libs/moment/moment.js',
                'assets/js/utilities/selectHandler.js',
                'assets/js/capital-share/index.js',
                'assets/js/capital-share/modal.js',

            ]
        ] + $this->_notifications_data;

        $data['payment_options'] = $this->M_payment_options->get_all() ?? [];
        $data['payment_method'] = $this->M_payment_methods->get_all() ?? [];
        $data['pending_payments'] = $this->M_capital_share_account_dues->get_by_user_id($this->_user_id) ?? [];
        $data['subscribed_transaction'] = $this->M_capital_contribution->get_by_user_id($this->_user_id) ?? [];
        $data['info '] = $this->M_capital_share_account_dues->get_all() ?? [];
        $data['billing_info'] = $this->M_billing_address->get($this->_user_id) ?? [];
       
       
       

        $data['financial_info'] = get_by_user_id_and_table($this->_user_id,'members','member_id','financial_accounts');
        

        $this->load->view('pages/capital-share/index', $data);
    }

    /*this is the index for the serves/payments module where user
     may have the capacity to settle account dues.*/
    public function view_payment()
    {
        if(!has_permissions('initiate_contribution_payment')){
            show_404();
            return;
        }

        $data['page_data'] = [
            'system_module' => 'Payment',
            'system_section' => '',
            'title' => 'Settle Accounts',
            'styles_path' => [
                'assets/vendor/css/pages/page-auth.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/flatpickr/flatpickr.css',
                'assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css',
                'assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css',
                'assets/vendor/libs/jquery-timepicker/jquery-timepicker.css',
                'assets/vendor/libs/@form-validation/form-validation.css',
                'assets/vendor/libs/pickr/pickr-themes.css',
            ],
            'scripts_path' => [
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/select2/select2.js',
                'assets/js/capital-share/modal.js',
                'assets/js/utilities/selectHandler.js',
                'assets/js/capital-share/index.js',


            ]
        ] + $this->_notifications_data;

        $data['payment_options'] = $this->M_payment_options->get_all() ?? [];
        $data['payment_method'] = $this->M_payment_methods->get_all() ?? [];
        $data['pending_payments'] = $this->M_capital_share_account_dues->get_by_user_id($this->_user_id) ?? [];
        $data['transaction_category'] = $this->M_transaction_category->get_all();
        $data['subscribed_transaction'] = $this->M_capital_contribution->get_by_user_id($this->_user_id)?? [] ;
        $data['info'] = $this->M_capital_share_account_dues->get_all() ?? [];


        $this->load->view('pages/capital-share/payment-index', $data);
    }


    public function confirming_receipt($id = NULL)
    {

        if (!$id) {
            show_404();
            die();
        }

        $data['page_data'] = [
            'system_module' => 'Capital Share',
            'system_section' => '',
            'title' => 'Capital Contribution',
            'styles_path' => [
                'assets/vendor/css/pages/page-auth.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/flatpickr/flatpickr.css',
                'assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css',
                'assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css',
                'assets/vendor/libs/jquery-timepicker/jquery-timepicker.css',
                'assets/vendor/libs/@form-validation/form-validation.css',
                'assets/vendor/libs/pickr/pickr-themes.css',
            ],
            'scripts_path' => [
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/select2/select2.js',
                'assets/js/capital-share/modal.js',
                'assets/js/utilities/selectHandler.js',
                'assets/js/capital-share/index.js',


            ]
        ] + $this->_notifications_data;

        $data['payment_options'] = $this->M_payment_options->get_all();
        $data['payment_method'] = $this->M_payment_methods->get_all();
        $data['pending_payments'] = $this->M_capital_share_account_dues->get_by_user_id($this->_user_id);
        $data['subscribed_transaction'] = $this->M_capital_contribution->get_by_user_id($this->_user_id);
        $data['info'] = $this->M_capital_share_account_dues->get_all();
        $data['cashiering'] = $this->M_cashiering_invoice->get($this->_user_id);
        $data['payment_record'] = $this->M_payment_record->get_item_data($id);

        $this->load->view('pages/capital-share/confirming-receipt', $data);
    }


    //modify and adjust based on loans
    public function payment()
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $this->form_validation->set_rules($this->_get_validation_rules());

            if ($this->form_validation->run() == FALSE) {
                return $this->_send_json_response(FALSE, validation_errors(), NULL);
            }

            $this->db->trans_start();

            // handles file upload
            $upload_data = $this->_handle_file_upload();
            if (!$upload_data) {
                return $this->_send_json_response(FALSE, 'File upload failed.');
            }

            // Prepare and insert invoice particulars
            $particular_id = $this->_insert_invoice_particulars($post_data);

            if (!$particular_id) {
                return $this->_send_json_response('failed to update invoice particulars.');
            }

            $paymentData = [
                'payment_date'          => date('Y-m-d'),
                'payment_method_id'     => $post_data['payment_method'],
                'transaction_category_id' => $post_data['transaction_name'],
                'invoice_particulars_id' => $particular_id,
                'account_name'          => $post_data['account_name'],
                'account_number'        => $post_data['account_number'],
                'reference_number'      => $post_data['reference_number'],
                'total_payment'         => $post_data['total_payment'],
                'payment_proof'         => $upload_data, // Replace with actual file path
                'status'                => 'pending',
            ] + $this->_create_additional;

            $insertId = $this->M_payment_records->insert($paymentData);

            if (!$insertId) {
                $this->db->trans_rollback();
                log_message('error', 'Failed to insert payment data.');
                return $this->_send_json_response(TRUE, 'Payment recorded successfully.');
            }

           
            $admin_logs = [
                'type_of_action' => 'User Payment Initiated',
                'action_description' => 'User ' . $this->_user_email  . ' Generated an Invoice for membership'
            ] + $this->_log_additional;
            if (!$this->M_user_logs->insert($admin_logs)) {
                $this->db->trans_rollback();
                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            }
            // Notify cashiers
            // $this->_notify_cashiers($post_data);

            // // Update dues based on the date range
            $this->_update_due_dates($post_data);

            $this->db->trans_commit();
            // Return success response with inserted ID
            return $this->_send_json_response(TRUE, 'Payment recorded successfully.', $insertId);
        }

        // If no post data is received, return an error
        return $this->_send_json_response(FALSE, NULL, 'No data received.');
    }







    private function _handle_file_upload()
    {
        $upload_path = 'uploads/payments/payment_receipt/' . $this->_user_id . '/';
        if (!is_dir($upload_path) && !mkdir($upload_path, 0777, true)) {
            log_message('error', 'Failed to create directory: ' . $upload_path);
            return $this->_send_json_response(FALSE, 'Failed to create upload directory.');
        }

        $receipt_metadata = [
            'label' => 'payment_receipt',
            'allowed_extensions' => ['jpg', 'jpeg'],
            'allowed_mime_types' => ['image/jpeg', 'image/jpg']
        ];

        $receipt_key = 'payment_receipt';

        // Check if file exists in $_FILES
        if (!isset($_FILES['attachments']['name'][$receipt_key])) {
            log_message('error', 'No file found in $_FILES for key: ' . $receipt_key);
            return $this->_send_json_response(FALSE, 'No file uploaded.', null);
        }

        // Get file extension and MIME type
        $file_extension = pathinfo($_FILES['attachments']['name'][$receipt_key], PATHINFO_EXTENSION);
        $file_mime = mime_content_type($_FILES['attachments']['tmp_name'][$receipt_key]);

        // Validate file extension
        if (!in_array($file_extension, $receipt_metadata['allowed_extensions'])) {
            return $this->_send_json_response(FALSE, 'Invalid file extension. Allowed: ' . implode(', ', $receipt_metadata['allowed_extensions']));
        }

        // Validate MIME type
        if (!in_array($file_mime, $receipt_metadata['allowed_mime_types'])) {
            return $this->_send_json_response(FALSE, 'Invalid MIME type. Allowed: ' . implode(', ', $receipt_metadata['allowed_mime_types']));
        }

        // Upload configuration
        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => implode('|', $receipt_metadata['allowed_extensions']),
            'file_name'     => uniqid(),
        ];
        $this->upload->initialize($config);

        // Set the file data for upload
        $_FILES['file'] = [
            'name'     => $_FILES['attachments']['name'][$receipt_key],
            'type'     => $_FILES['attachments']['type'][$receipt_key],
            'tmp_name' => $_FILES['attachments']['tmp_name'][$receipt_key],
            'error'    => $_FILES['attachments']['error'][$receipt_key],
            'size'     => $_FILES['attachments']['size'][$receipt_key]
        ];

        // Attempt to upload the file
        if (!$this->upload->do_upload('file')) {
            log_message('error', 'File upload error: ' . $this->upload->display_errors('', ''));
            return $this->_send_json_response(FALSE, 'File upload failed: ' . $this->upload->display_errors('', ''));
        }

        // Return uploaded file data
        $upload_data = $this->upload->data();
        return $upload_path . $upload_data['file_name']; // Return the path to the uploaded file
    }




    // adjust this based on the transaction category
    private function _insert_invoice_particulars($post_data)
    {

        // Calculate service fee, interest rate, total amount, and monthly repayment
        $billing_address = $this->M_billing_address->get($this->_user_id);
        $invNumber = generateInvoiceNumber();
        $transaction = $this->M_transaction_category->get($post_data['transaction_name']);
        $itemId = $this->M_items->get_by_category($post_data['transaction_name']);
        $amount = $post_data['total_payment'] / $post_data['number_of_payments'];
        $invoice_data = [
            'user_id' => $this->_user_id,
            'invoice_number' => $invNumber,
            'transaction_category_id' => $post_data['transaction_name'],
            'date_issued' => date('Y-m-d H:i:s'),
            'billing_address_id' => $billing_address['id'],
            'status' => 'payment-initiated',
            'amount' => $post_data['total_payment']
        ] + $this->_create_additional;

        $invoice_id = $this->M_cashiering_invoice->insert($invoice_data);

        if (!$invoice_id) {
            throw new Exception('Failed to insert invoice data.');
        }

        $invoice_particular = [
            'cashiering_invoice_id' => $invoice_id,
            'item_id'               => $itemId['id'],
            'quantity'              => 1,
            'unit_cost'             => ($itemId['amount'] != NULL) ? $itemId['amount'] : $amount,
            'total_cost'            => $post_data['total_payment'],
        ] + $this->_create_additional;

        return  $particular_id = $this->M_invoice_particular->insert($invoice_particular);
    }

    // private function _notify_cashiers($post_data)
    // {
    //     $cashier_role_id = get_by_code_and_table('cashier','role', 'users')['id'] ?? 0;
    //     $cashiers = $this->M_users->get_by_role($cashier_role_id);


    //     foreach ($cashiers as $cashier) {
    //         $notification_data = [
    //             'user_id'             => $cashier['id'],
    //             'notification_title'  => 'New Online Payment Received!',
    //             'message'             => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' submitted an online payment',
    //             'link'                => NULL,
    //         ] + $this->_create_additional;

    //         notify_user($notification_data);
    //     }
    // }

    private function _update_due_dates($post_data)
    {
        $transaction_category = $post_data['transaction_name'];

        // Default to 'M_capital_share_account_dues' for category 2 and load records accordingly
        if ($transaction_category == 2) {
            $info = $this->M_capital_share_account_dues->get_by_user_id($this->_user_id, 'pending');
        }
        // For category 3, load records from both 'M_loan_repayment_schedule' and 'M_cashiering_invoice'
        elseif ($transaction_category == 3) {
            $member_id = $this->M_member->get_by_user($this->_user_id);
            $info = $this->M_loan_repayment_schedule->get_by_user_id($member_id['id']);
            $info_invoice = $this->M_cashiering_invoice->get_all(['order_by' => 'due_date ASC']);
            $no_of_payment_invoice = min($post_data['number_of_payments'], count($info_invoice));
            $dates_to_update_invoice = array_slice($info_invoice, 0, $no_of_payment_invoice);
        }

        // Number of payments to update based on the available records
        $no_of_payment = min($post_data['number_of_payments'], count($info));
        $dates_to_update = array_slice($info, 0, $no_of_payment);

        switch ($transaction_category) {
            case 2:
                $this->_update_status($dates_to_update, 'M_capital_share_account_dues', 'payment_initiated');
                break;
            case 3:
                $this->_update_status($dates_to_update, 'M_loan_repayment_schedule', 'payment_initiated');
                $this->_update_status($dates_to_update_invoice, 'M_cashiering_invoice', 'payment_initiated');
                break;
        }
    }

    // Helper function to update the status for the records
    private function _update_status($records, $model, $status)
    {
        foreach ($records as $entry) {
            $update_data = [
                'status' => $status,
            ] + $this->_update_additional;

            // Dynamically load the model based on transaction category
            $this->{$model}->update($entry['id'], $update_data);
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


    private function _get_validation_rules()
    {
        return [
            ['field' => 'payment_method', 'label' => 'Details', 'rules' => 'required'],
            ['field' => 'payment_mode', 'label' => 'Payment mode', 'rules' => 'required'],
            // ['field' => 'payment_scope', 'label' => 'Payment scope', 'rules' => 'required'],
            ['field' => 'total_payment', 'label' => 'Payment amount', 'rules' => 'required'],
        ];
    }


    private function _send_json_response($status, $message, $insertId, $additional_data = [])
    {
        $response = array_merge(['status' => $status, 'message' => $message, 'id' => $insertId], ['validation_errors' => $additional_data]);
        exit(json_encode($response));
    }
}
