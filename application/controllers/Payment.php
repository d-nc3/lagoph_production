<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Payment extends CI_Controller {



    public function __construct()

    {

        parent::__construct();



        // User logs related data

        $this->load->model('Users_model', 'M_users');

        $this->load->model('User_logs_model', 'M_user_logs');

        $this->load->model('Billing_address_model' , 'M_billing_address');



        //Cashiering related model

        $this->load->model('Cashiering_invoice_model','M_cashiering_invoice');

        $this->load->helper('string');



        //Invoice related model

        $this->load->model('Invoice_particulars_model', 'M_invoice_particular');

        $this->load->model('Ledger_model', 'M_ledger_model');

        $this->load->model('Payment_records_model','M_payment_records');



        // User session related data4

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



   

   

    public function payment_dt_list($id=NULL){

        if (!$id) {

            show_404();

            die();

        }

   

        $search = $this->security->xss_clean($this->input->post('search'));

        $order = $this->security->xss_clean($this->input->post('order'));

        $start = $this->security->xss_clean($this->input->post('start'));   

        $length = $this->security->xss_clean($this->input->post('length'));

        $draw = $this->security->xss_clean($this->input->post('draw'));

        

       

    

        $filters = array();

        if (!empty($search['value'])) {

            $filters['search'] = $search['value'];

        }

      

      

  // remove uneccesarry joins and datas

        $list = $this->M_payment_records->get_all_filtered($id,$filters, $order, $start, $length);

        $data = array();

        $no = $start;

        foreach ($list as $detail) {

            $no++;    

            $row = array();

            $row['id'] = $detail->id;

            $row['first_name'] =$detail->first_name;

            $row['last_name'] =$detail->last_name;

            $row['payment_date'] =$detail->payment_date;

            $row['status'] =$detail->status;

            $data[] = $row;

        }

    

        // Prepare the output for DataTables

        $output = array(

            "draw" => $this->input->post('draw'),

            "recordsTotal" => $this->M_payment_records->count_all(),

            "recordsFiltered" => $this->M_payment_records->count_filtered($filters),

            "data" => $data,

        );

    

        echo json_encode($output);

    }







   

    public function upload_receipt() {

        // Secure input data

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            // Set validation rules

            $receipt_metadata = [
                'membership_receipt' => ['label' => 'Membership Fee Receipt','allowed_extensions' => ['jpg', 'jpeg'],'allowed_mime_types' => ['image/jpeg', 'image/jpg']],
                'contribution_receipt' => ['label' => 'Contribution Fee Receipt','allowed_extensions' => ['jpg', 'jpeg'],'allowed_mime_types' => ['image/jpeg', 'image/jpg']],

            ];

    

            $this->form_validation->set_rules($rules);

    

            try {

                                            // Validate form data

                if ($this->form_validation->run() == FALSE) {

                    $validation_errors = $this->form_validation->error_array();

                    log_message('error', 'Form validation failed: ' . json_encode($validation_errors));

                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));

                }

        

                // Retrieve invoice details

                $invoice_details = $this->M_invoice_particular->get_invoice_by_id($post_data['invoice_id']);

                if (!$invoice_details) {

                    log_message('error', 'Invoice details not found for ID: ' . $post_data['invoice_id']);

                    return $this->_send_json_response(FALSE, 'Invalid invoice ID.');

                }

        

                // Set upload path

                $upload_path = 'uploads/payments/' . $invoice_details['user_id'] . '/' . $invoice_details['invoice_number'] . '/';

                if (!is_dir($upload_path)) {

                    mkdir($upload_path, 0777, true);

                }

        

                // File upload handling

                $receipt_metadata = [

                    'label' => 'Payment_Receipt',

                    'allowed_extensions' => ['jpg', 'jpeg'],

                    'allowed_mime_types' => ['image/jpeg', 'image/jpg']

                ];

        

                $receipt_key = 'payment_receipt';

        

                // Check if the file exists in the $_FILES array

                if (!isset($_FILES['attachments']['name'][$receipt_key])) {

                    log_message('error', 'No file found in $_FILES for key: ' . $receipt_key);

                    return $this->_send_json_response(FALSE, 'No file uploaded.');

                }

        

                // Get file extension and MIME type

                $file_extension = pathinfo($_FILES['attachments']['name'][$receipt_key], PATHINFO_EXTENSION);

                $file_mime = mime_content_type($_FILES['attachments']['tmp_name'][$receipt_key]);

        

                if (!in_array($file_extension, $receipt_metadata['allowed_extensions'])) {

                    return $this->_send_json_response(FALSE, 'Invalid file extension. Allowed: ' . implode(', ', $receipt_metadata['allowed_extensions']));

                }

        

                if (!in_array($file_mime, $receipt_metadata['allowed_mime_types'])) {

                    return $this->_send_json_response(FALSE, 'Invalid MIME type. Allowed: ' . implode(', ', $receipt_metadata['allowed_mime_types']));

                }

        

                // Set upload configuration

                $config['upload_path'] = $upload_path;

                $config['allowed_types'] = implode('|', $receipt_metadata['allowed_extensions']);

                $config['file_name'] = uniqid(); // Generate unique filename

        

                // Initialize upload library

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

                    $error = $this->upload->display_errors();

                    log_message('error', 'File upload failed: ' . $error);

                    return $this->_send_json_response(FALSE, 'File upload error: ' . $error);

                }

        

                // Get upload data and file path

                $upload_data = $this->upload->data();

                $file_path = $upload_data['full_path'];

        

                // Prepare data for payment insertion

                $paymentData = [

                    'payment_date'   => $post_data['payment_date'],

                    'payment_method_id'=>$post_data['payment_method'],

                    'transaction_category_id' => $invoice_details['transaction_category_id'],

                    'invoice_particulars_id' => $invoice_details['id'],

                    'account_name'=>$post_data['account_name'],

                    'account_number'=>$post_data['account_number'],

                    'reference_number'=> $post_data['reference_number'],

                    'total_payment'=>$post_data['total_payment'],

                    'details'        => $post_data['receipt_details'],

                    'payment_proof'  => $upload_path . $upload_data['file_name'],

                    'status'         => 'pending',

            

                ]+ $this->_create_additional;

        

                $status = [

                    'status'     => 'payment-initiated',

                    'updated_by' => $this->_user_id,

                    'updated_at' => date('Y-m-d H:i:s')

                ];

        

                // Begin transaction

                $this->db->trans_begin();

        

                // Insert payment data

                if (!$this->M_payment_records->insert($paymentData)) {

                    $this->db->trans_rollback();

                    log_message('error', 'Failed to insert payment data.');

                    return $this->_send_json_response(FALSE, 'Database error.');

                }

        

                // Update invoice status

                if (!$this->M_cashiering_invoice->update($invoice_details['cashiering_invoice_id'], $status)) {

                    $this->db->trans_rollback();

                    log_message('error', 'Failed to update invoice status.');

                    return $this->_send_json_response(FALSE, 'Database error.');

                }

        

    

                // Retrieve cashier role ID

                $cashier = get_by_code_and_table('9','role_id', 'user_roles') ? get_by_code_and_table('9','role_id', 'user_roles')['id'] : 0;

        

                $link = base_url('Cashiering/cashier_billing/' . $invoice_details['user_id']);  // Construct your link

    

                if (!empty($cashiers)) {

                    foreach ($cashiers as $cashier) {



                        $notification_data = [

                        'user_id' => $cashier['user_id'],

                        'notification_title' => 'New Online Payment Received!',

                        'message' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' submitted an online payment for' . $invoice_details['transaction_name'],

                        'link' => $link

                        ] + $this->_create_additional;

                        $notification_result = notify_user($notification_data);

                        

                    }

                }

    

            } catch (Exception $e) {

                // Rollback transaction and return error response

                $this->db->trans_rollback();

              

                return $this->_send_json_response(FALSE, 'An error occurred: ' . $e->getMessage());

            }



            $role = ['role' => $this->_user_role] + $this->_update_additional;

            $admin_logs = [

                'type_of_action' => 'Payment Initiated',

                'action_description' => 'User ' . $this->_user_email  . ' Generated an Invoice for membership'

            ] + $this->_log_additional;



            if (!$this->M_user_logs->insert($admin_logs)) {

                $this->db->trans_rollback();

                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

            }

    

            // Commit transaction

            $this->db->trans_commit();

          

            return $this->_send_json_response(TRUE, 'Payment submitted. Thank you!');

    

        }

    }



  

    public function cash_payment() {

        // Secure input data

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            // Set validation rules

            $rules = [

                ['field' => 'invoice_id', 'invoice id' => 'Invoice', 'rules' => 'required'],

            ];

    

            $this->form_validation->set_rules($rules);

    

            try {

                                            // Validate form data

                if ($this->form_validation->run() === FALSE) {

                    $validation_errors = $this->form_validation->error_array();

                    log_message('error', 'Form validation failed: ' . json_encode($validation_errors));

                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));

                }

        

                // Retrieve invoice details

                $invoice_details = $this->M_invoice_particular->get_invoice_by_status($post_data['invoice_id']);

                if (!$invoice_details) {

                    log_message('error', 'Invoice details not found for ID: ' . $post_data['invoice_id']);

                    return $this->_send_json_response(FALSE, 'Invalid invoice ID.');

                }

        

                // Set upload path

               

        

                // Prepare data for payment insertion

                $paymentData = [

                    'invoice_particulars_id' => $invoice_details['id'],

                    'status'         => 'pending',

                    'created_by'     => $this->_user_id,

                    'created_at'     => date('Y-m-d H:i:s')

                ];

        

                $status = [

                    'status'     => 'payment-initiated',

                    'updated_by' => $this->_user_id,

                    'updated_at' => date('Y-m-d H:i:s')

                ];

        

                // Begin transaction

                $this->db->trans_begin();

        

                // Insert payment data

                if (!$this->M_payment_records->insert($paymentData)) {

                    $this->db->trans_rollback();

                    log_message('error', 'Failed to insert payment data.');

                    return $this->_send_json_response(FALSE, 'Database error.');

                }

        

                // Update invoice status

                if (!$this->M_cashiering_invoice->update($invoice_details['cashiering_invoice_id'], $status)) {

                    $this->db->trans_rollback();

                    log_message('error', 'Failed to update invoice status.');

                    return $this->_send_json_response(FALSE, 'Database error.');

                }

        

    

                // Retrieve cashier role ID

                $cashier_role_id = get_by_code_and_table('cashier','role', 'users') ? get_by_code_and_table('cashier','role', 'users')['id'] : 0;

                $cashiers = $this->M_users->get_by_role($cashier_role_id);

                $link = base_url('Cashiering/cashier_billing/' . $invoice_details['user_id']);  // Construct your link

    

                if (!empty($cashiers)) {

                    foreach ($cashiers as $cashier) {



                        $notification_data = [

                        'user_id' => $cashier['id'],

                        'notification_title' => 'New Online Payment Received!',

                        'message' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' submitted an online payment for' . $invoice_details['transaction_name'],

                        'link' => $link

                        ] + $this->_create_additional;

                        $notification_result = notify_user($notification_data);

                        

                    }

                }

    

            } catch (Exception $e) {

                // Rollback transaction and return error response

                $this->db->trans_rollback();

              

                return $this->_send_json_response(FALSE, 'An error occurred: ' . $e->getMessage());

            }

    

            // Commit transaction

            $this->db->trans_commit();

          

            return $this->_send_json_response(TRUE, 'Payment successfully submitted');

    

        }

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

