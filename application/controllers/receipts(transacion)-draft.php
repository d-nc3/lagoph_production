
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->load->model('Employees_model', 'M_employees');
        $this->load->model('Users_model', 'M_users');
        $this->load->model('Units_model', 'M_units');
        $this->load->model('Positions_model', 'M_positions');
        $this->load->model('Departments_model', 'M_departments');
        $this->load->model('Payment_method_model', 'M_payment_method');
        $this->load->model('User_logs_model', 'M_user_logs');
        $this->load->model('Cashiering_invoice_model', 'M_cashiering_invoice');
        $this->load->helper('string');
        $this->load->model('Invoice_particulars_model', 'M_invoice_particular');
        $this->load->model('Capital_contributions_model', 'M_capital_contributions');
        $this->load->model('Cash_accounts_model', 'M_cash_accounts');
        $this->load->model('Billing_address_model', 'M_billing_address');
        $this->load->model('Ledger_model', 'M_ledger_model');
        $this->load->model('Payment_records_model', 'M_payment_records');
        $this->load->model('Official_receipts_model', 'M_official_receipt');
        $this->load->model('Receipt_particulars_model', 'M_receipt_particulars');
        $this->load->model('Payment_options_model', 'M_payment_options');
        $this->load->model('Items_model', 'M_items');
        $this->load->model('Payment_account_model', 'M_payment_account');
        $this->load->model('Transaction_category_model', 'M_invoice_types');
        $this->load->model('Transaction_types_model', 'M_transaction_type');
        $this->load->model('Transaction_types_cash_account_model', 'M_transaction_cash_map');
        $this->load->model('Invoice_transaction_maps_model', 'M_invoice_transaction_map');


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


    public function view_transaction($id = NULL, $invoice_number = NULL)
    {
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
                'assets/js/cashier/cashier-billing-index.js',
                'assets/js/transaction/or_payment.js',
            ]
        ] + $this->_notifications_data;

        if ($invoice_number !== NULL) {

            $data['invoice_particulars'] = $this->M_invoice_particular->get_invoice_by_status($invoice_number);
        } else if ($id !== NULL) {
            $data['items'] = $this->M_items->get_all();
            $data['payment_options'] = $this->M_payment_options->get_all();
            $data['users'] = $this->M_users->get($id);
            $data['billing_address'] = $this->M_billing_address->get($id);
            $data['payment_method'] = $this->M_payment_method->get_all();
            $data['payment_records'] = $this->M_payment_records->get_by_user_id($id, 'pending');
        } else {

            show_error('No transaction ID or invoice ID provided.');
            return;
        }

        $data['items'] = $this->M_items->get_all();
        $data['payment_options'] = $this->M_payment_options->get_all();
        $data['users'] = $this->M_users->get($id);
        $data['billing_address'] = $this->M_billing_address->get($id);
        $data['payment_method'] = $this->M_payment_method->get_all();
        $data['payment_records'] = $this->M_payment_records->get_by_user_id($id, 'pending');


        $this->load->view('pages/cashier/transactions/or-index', $data);
    }


 

    // public function cash_payment()
    // {
    //     if ($post_data = $this->security->xss_clean($this->input->post())) {
    //         try {
    //             // Retrieve invoice information
    //             $info = $this->M_cashiering_invoice->get($post_data['invoice_id']);
    //             echo json_encode($info);

    //             if (empty($info)) {
    //                 return $this->_send_json_response(FALSE, 'Invoice not found.');
    //             }
    //             $rules = [
    //                 ['field' => 'payment_mode', 'label' => 'Payment Mode', 'rules' => 'required'],
    //                 ['field' => 'payment_method', 'label' => 'Payment method', 'rules' => 'required'],
    //                 ['field' => 'total_payment', 'label' => 'Total Payment', 'rules' => 'required'],
    //                 ['field' => 'payment_status', 'label' => 'Payment Status', 'rules' => 'required']
    //             ];

    //             $this->form_validation->set_rules($rules);

    //             if ($this->form_validation->run() === FALSE) {
    //                 return $this->_send_json_response(FALSE, validation_errors());
    //             }

    //             $this->db->trans_begin();

    //             $payment_mode = $post_data['payment_mode'];
    //             $payment_method = $post_data['payment_method'];
    //             $status = $post_data['payment_status'];
    //             $user_id = $post_data['user_id'];
    //             $billing_id = $post_data['billing_id'];
    //             $cashier = $post_data['issued_by'];
    //             $orNumber = generate_or_number();
    //             $invoice_particular_id = $post_data['particulars_id'];

    //             $invoice_data = [
    //                 'status' => $status,
    //                 'issued_by' => $cashier,
    //             ] + $this->_update_additional;


    //             $official_receipt = [
    //                 'user_id' => $user_id,
    //                 'billing_address_id' => $billing_id,
    //                 'transaction_category_id' => $info['transaction_category_id'],
    //                 'payment_date' => date('Y-m-d H:i:s'),
    //                 'processed_by' => $cashier,
    //                 'official_receipt_number' => $orNumber
    //             ] + $this->_create_additional;

    //             $receipt_id = $this->M_official_receipt->insert($official_receipt);

    //             if (!$receipt_id) {
    //                 $this->db->trans_rollback();
    //                 return $this->_send_json_response(FALSE, 'Failed to create official receipt.');
    //             }


    //             if (!$this->M_cashiering_invoice->update($post_data['invoice_id'], $invoice_data)) {
    //                 $this->db->trans_rollback();
    //                 return $this->_send_json_response(FALSE, 'Failed to update invoice.');
    //             }

    //             // Process particulars
    //             $or_particulars = $post_data['group-a'] ?? [];
    //             if (is_array($or_particulars)) {
    //                 foreach ($or_particulars as $particular) {
    //                     if (isset($particular['item_details'], $particular['item_cost'], $particular['item_quantity'], $particular['item_total'])) {

    //                         // Sanitize fields
    //                         $item_details = $this->security->xss_clean($particular['item_details']);
    //                         $item_cost = $this->security->xss_clean($particular['item_cost']);
    //                         $item_quantity = $this->security->xss_clean($particular['item_quantity']);
    //                         $item_total = $this->security->xss_clean($particular['item_total']);


    //                         $or_particulars_data = [
    //                             'item_id' => $item_details,
    //                             'receipt_id' => $receipt_id,
    //                             'quantity' => $item_quantity,
    //                             'unit_cost' => $item_cost,
    //                             'total_cost' => $item_total,
    //                             'invoice_number' => $info['invoice_number'],
    //                         ] + $this->_create_additional;

    //                         $or_id = $this->M_receipt_particulars->insert($or_particulars_data);
    //                         if (!$or_id) {
    //                             $this->db->trans_rollback();
    //                             return $this->_send_json_response(FALSE, 'Failed to insert receipt particulars.');
    //                         }


    //                         $payment = [
    //                             'invoice_particulars_id' => $invoice_particular_id,
    //                             'payment_type_id' => $payment_mode,
    //                             'payment_method_id' => $post_data['payment_method'],
    //                             'status' => $status,
    //                             'or_particulars_id' => $or_id,
    //                         ] + $this->_create_additional;

    //                         // switch ($post_data['payment_method']) {
    //                         //     case '21':
    //                         //         $this->cash_payment();
    //                         //         break;

    //                         //     case '11':
    //                         //         $this->online_payment();
    //                         //         break;

    //                         //     case '2':
    //                         //         $this->bank_payment();
    //                         //         break;
    //                         // }

    //                         if (!$this->M_payment_records->insert($payment)) {
    //                             $this->db->trans_rollback();
    //                             return $this->_send_json_response(FALSE, 'Failed to record payment.');
    //                         }
    //                     } else {
    //                         return $this->_send_json_response(FALSE, 'Invalid particulars data.');
    //                     }
    //                 }
    //             }

    //             // Send notification
    //             $link = base_url('Membership');
    //             $notification_data = [
    //                 'user_id' => $user_id,
    //                 'notification_title' => 'Payment Approved!',
    //                 'message' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' approved your payment for ' . $info['invoice_number'],
    //                 'link' => $link
    //             ] + $this->_create_additional;
    //             notify_user($notification_data);

    //             $this->db->trans_commit();
    //             return $this->_send_json_response(TRUE, 'Payment successfully saved.');
    //         } catch (DatabaseException $e) {
    //             $this->db->trans_rollback();
    //             log_message('error', 'DatabaseException: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
    //             return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
    //         } catch (Exception $e) {
    //             $this->db->trans_rollback();
    //             return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
    //         }
    //     }
    // }



    public function save_invoice_payment()
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            try {
                $info = $this->M_cashiering_invoice->get($post_data['invoice_id']);
                $payment_record = $this->M_payment_records->get_by_invoice_id($post_data['particulars_id']);

                if (empty($info)) {
                    return $this->_send_json_response(FALSE, 'Invoice not found.');
                }
                // Retrieve invoice information

                $rules = [
                    ['field' => 'payment_mode', 'label' => 'Payment Mode', 'rules' => 'required'],
                    ['field' => 'payment_method', 'label' => 'Payment method', 'rules' => 'required'],
                    ['field' => 'total_payment', 'label' => 'Total Payment', 'rules' => 'required'],
                    ['field' => 'payment_status', 'label' => 'Payment Status', 'rules' => 'required']
                ];

                $this->form_validation->set_rules($rules);

                if ($this->form_validation->run() === FALSE) {
                    return $this->_send_json_response(FALSE, validation_errors());
                }

                $this->db->trans_begin();

                $payment_mode = $post_data['payment_mode'];
                $payment_method = $post_data['payment_method'];
                $status = $post_data['payment_status'];
                $user_id = $post_data['user_id'];
                $billing_id = $post_data['billing_id'];
                $cashier = $post_data['issued_by'];
                $orNumber = generate_or_number();
                $invoice_particular_id = $post_data['particulars_id'];

                $invoice_data = [
                    'status' => $status,
                    'issued_by' => $cashier,
                ] + $this->_update_additional;


                $official_receipt = [
                    'user_id' => $user_id,
                    'billing_address_id' => $billing_id,
                    'transaction_category_id' => $info['transaction_category_id'],
                    'payment_date' => date('Y-m-d H:i:s'),
                    'processed_by' => $cashier,
                    'official_receipt_number' => $orNumber
                ] + $this->_create_additional;

                $receipt_id = $this->M_official_receipt->insert($official_receipt);

                if (!$receipt_id) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'Failed to create official receipt.');
                }


                if (!$this->M_cashiering_invoice->update($post_data['invoice_id'], $invoice_data)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'Failed to update invoice.');
                }

                $or_particulars = $post_data['group-a'] ?? [];

                if (!empty($or_particulars)) {
                    foreach ($or_particulars as $particular) {
                        if (isset($particular['item_details'], $particular['item_cost'], $particular['item_quantity'], $particular['item_total'])) {
                            // Sanitize fields
                            $item_details = $this->security->xss_clean($particular['item_details']);
                            $item_cost = $this->security->xss_clean($particular['item_cost']);
                            $item_quantity = $this->security->xss_clean($particular['item_quantity']);
                            $item_total = $this->security->xss_clean($particular['item_total']);

                            $or_particulars_data = [
                                'item_id' => $item_details,
                                'receipt_id' => $receipt_id,
                                'quantity' => $item_quantity,
                                'unit_cost' => $item_cost,
                                'total_cost' => $item_total,
                                'invoice_number' => $info['invoice_number'],
                            ] + $this->_create_additional;

                            $or_id = $this->M_receipt_particulars->insert($or_particulars_data);

                            if (!$or_id) {
                                throw new Exception('Failed to insert receipt particular.');
                            }


                            $payment = [
                                'payment_type_id' => $payment_mode,
                                'payment_method_id' => $payment_method,
                                'total_payment' => $post_data['total_payment'],
                                'status' => $status,
                                'payment_method_id' => $payment_method,
                                'or_particulars_id' => $or_id,
                                'account_name' => $post_data['account_name'],
                                'account_number' => $post_data['account_num'],
                                'reference_number' => $post_data['reference_no']
                            ] + $this->_update_additional;

                            $update_invoice = $this->M_payment_records->update_status_invoice($post_data['particulars_id'], $payment);
                            if (!$update_invoice){
                                $insert_payment = $this->M_payment_records->insert($payment);
                            }  
                            
                        } else {
                            $this->db->trans_rollback();
                            return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                        }

                        $link = base_url('Membership');
                        $notification_data = [
                            'user_id' => $user_id,
                            'notification_title' => 'Payment Approved!',
                            'message' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' approved your payment for ' . $info['invoice_number'],
                            'link' => $link
                        ] + $this->_create_additional;

                        notify_user($notification_data);
                    }
                }
                $this->db->trans_commit();
                return $this->_send_json_response(TRUE, 'Payment Saved successfully submitted!');
            } catch (DatabaseException $e) {
                $this->db->trans_rollback();
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }
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
