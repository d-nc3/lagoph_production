<?php



use function PHPUnit\Framework\isEmpty;



defined('BASEPATH') or exit('No direct script access allowed');



class Settings extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();





        //Employees related modelspr

        $this->load->model('Employees_model', 'M_employees');

        $this->load->model('Positions_model', 'M_positions');

        $this->load->model('Departments_model', 'M_departments');



        //User related models

        $this->load->model('Users_model', 'M_users');

        $this->load->model('User_logs_model', 'M_user_logs');

        $this->load->model('Billing_address_model', 'M_billing_address');





        //Member related models

        $this->load->model('Members_model', 'M_members');

        $this->load->model('Units_model', 'M_units');



        //Loans related models

        $this->load->model('Loans_model', 'M_loans');

        $this->load->model('Loans_repayment_schedule_model', 'M_loan_repayment_schedule');



        //Payment related models

        $this->load->model('Payment_method_model', 'M_payment_method');
        $this->load->model('Payment_options_model', 'M_payment_options');
        $this->load->model('Account_types_model', 'M_account_types');
        $this->load->model('Items_model', 'M_items');
        $this->load->model('Payment_account_model', 'M_payment_account');
        $this->load->model('Cashiering_invoice_model', 'M_cashiering_invoice');
        $this->load->model('Invoice_particulars_model', 'M_invoice_particular');
        $this->load->model('Cash_accounts_model', 'M_cash_accounts');
        $this->load->model('Ledger_model', 'M_ledger_model');
        $this->load->model('Payment_records_model', 'M_payment_records');
        $this->load->model('Payment_method_model', 'M_payment_methods');
        $this->load->model('Financial_accounts_model', 'M_financial_accounts');



        //Capital Contribution related models

        $this->load->model('Capital_contributions_model', 'M_capital_contributions');
        $this->load->model('Transaction_category_model', 'M_transaction_category');
        $this->load->model('Cap_share_account_dues', 'M_cap_account_due');
        $this->load->model('User_documents_model', 'M_documents');
        $this->load->model('Official_receipts_model', 'M_official_receipt');
        $this->load->model('Receipt_particulars_model', 'M_receipt_particulars');





        //User session related data

        $this->_user_id = $this->session->userdata('user_id') ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
        $this->_user_email = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;
        $this->_user_role = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
        $this->_first_name = isset($_SESSION['first_name']) ? $this->session->userdata('first_name') : DEFAULT_ADMIN_USER_ROLE;
        $this->_last_name = isset($_SESSION['last_name']) ? $this->session->userdata('last_name') : DEFAULT_ADMIN_USER_ROLE;





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



        // User session related models





        $this->_user_id = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
        $this->_user_email = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;
        $this->_user_role = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
    }







    public function index($id = NULL)
    {

        $data['info'] = $info = $this->M_users->get($this->_user_id);
        $data['user_documents'] = $user_documents = $this->M_documents->list_by_user_profile($this->_user_id, '2X2 ID Picture');

        if (empty($info)) {
            show_404();
            exit();
        }

        $data['page_data'] = [
            'system_module' => 'Profile',
            'system_section' => 'My Profile',
            'title' => 'Profile Overview',
            'styles_path' => [
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css',
                'assets/vendor/css/pages/page-profile.css',
            ],

            'scripts_path' => [
                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
                'assets/js/app-user-view-account.js',
                'assets/js/profile/personalInformation/index.js',
            ]

        ] + $this->_notifications_data;


        $data['employees'] = $this->M_employees->get($this->_user_id);
        $data['positions'] = $this->M_positions->get_all();
        $data['user_logs'] = $this->M_user_logs->get_logs_by_user_id($this->_user_id);
        $data['info'] = $this->M_members->get_by_user($this->_user_id);

        // check entity type and load the correct view for each types
        $this->load->view('pages/profile/profile-settings', $data);
    }



    public function security()
    {
       

        $data['info'] = $info = $this->M_users->get($this->_user_id);
        $data['user_documents'] = $user_documents = $this->M_documents->list_by_user_profile($this->_user_id, '2X2 ID Picture');



        if (empty($info)) {
            show_404();
            exit();
        }



        $data['page_data'] = [
            'system_module' => 'Security',
            'system_section' => 'Security',
            'title' => 'Security Overview',
            'styles_path' => [
                'assets/vendor/css/pages/page-profile.css',
                'assets/vendor/css/pages/page-account-settings.css'
            ],

            'scripts_path' => [
                'assets/js/profile/security.js',
            ]
        ] + $this->_notifications_data;





        $data['employees'] = $this->M_employees->get($this->_user_id);
        $data['positions'] = $this->M_positions->get_all();
        $data['user_logs'] = $this->M_user_logs->get_logs_by_user_id($this->_user_id);

        $view_path = APPPATH . 'views/pages/profile/security.php';
            if (file_exists($view_path)) {
                $this->load->view('pages/profile/security', $data);
            } else {
                 redirect('error_404'); // or redirect to a controller method
            }

    }



    public function Billing()
    {



        $data['info'] = $info = $this->M_users->get($this->_user_id);
        $data['user_documents'] = $user_documents = $this->M_documents->list_by_user_profile($this->_user_id, '2X2 ID Picture');



        if (empty($info)) {
            show_404();
            exit();
        }



        $data['page_data'] = [
            'system_module' => 'Billings',
            'system_section' => 'Billings',
            'title' => 'Billings & Plans Overview',
            'styles_path' => [



                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',

                'assets/vendor/libs/typeahead-js/typeahead.css',

                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',

                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',

                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',

                'assets/vendor/libs/bootstrap-select/bootstrap-select.css',

                'assets/vendor/libs/select2/select2.css',

                'assets/vendor/libs/bs-stepper/bs-stepper.css',

                'assets/vendor/libs/moment/moment.js',



            ],

            'scripts_path' => [



                'assets/js/profile/billing/index.js',

                'assets/js/utilities/selectHandler.js',

            ]

        ] + $this->_notifications_data;





        $data['employees'] = $this->M_employees->get($this->_user_id);

        $data['positions'] = $this->M_positions->get_all();

        $data['user_logs'] = $this->M_user_logs->get_logs_by_user_id($this->_user_id);

        $data['billing_address'] = $this->M_billing_address->get_all_address($this->_user_id);

        $data['financial_accounts'] = $this->M_payment_methods->get_online_method();

        $data['account_types'] = $this->M_account_types->get_option_online();

        $data['payment_method'] = $this->M_payment_methods->get_online_method();



        $this->load->view('pages/profile/account_profile/billing', $data);
    }





    public function getCards()
    {

        $member_id = $this->M_members->get_by_user($this->_user_id);

        $info = $this->M_financial_accounts->get_id_method($member_id['id']);



        if (empty($info)) {

            return $this->_send_json_response(FALSE, 'Please contact your Admin Support and try again');
        }

        exit(json_encode($info));

        return $this->_send_json_response(FALSE, 'An error occurred. Please try again');
    }





    public function getBillingAddress()
    {



        $info = $this->M_billing_address->get($this->_user_id);



        if (empty($info)) {

            return $this->_send_json_response(FALSE, 'Please contact your Admin Support and try again');
        }

        exit(json_encode($info));

        return $this->_send_json_response(FALSE, 'An error occurred. Please try again');
    }





    public function get()
    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            $info = $this->M_billing_address->get_by_id($post_data['id']);

            if (empty($info)) {

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }



            exit(json_encode($info));

            echo $info;
        }



        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
    }



    // for editing a card billing

    public function get_edit_cards()
    {



        if ($post_data = $this->security->xss_clean($this->input->post())) {

            $info = get_by_code_and_table($post_data['id'], 'id', 'financial_accounts');

            if (empty($info)) {

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }



            exit(json_encode($info));
        }
    }



    public function add_account()
    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            try {



                $rules = [

                    ['field' => 'modal_add_name', 'label' => 'Account Name', 'rules' => 'required'],

                    ['field' => 'account_institution', 'label' => 'Financial Institution', 'rules' => 'required'],

                    ['field' => 'modal_add_card_num', 'label' => 'Card Number', 'rules' => 'required'],

                    ['field' => 'account_type', 'label' => 'Card Type', 'rules' => 'required'],

                ];



                $this->form_validation->set_rules($rules);

                if ($this->form_validation->run() === FALSE) {

                    $validation_errors = $this->form_validation->error_array();

                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }



                $this->db->trans_begin();

                // Verification if account number is existing: 



                $member_id = $this->M_members->get_by_user($this->_user_id);

                if (empty($member_id)) {

                    return $this->_send_json_response(FALSE, 'Please Complete the billing address only');
                }

                // Get the data: 

                $account_name = $post_data['modal_add_name'];

                $method_id = $post_data['account_institution'];

                $account_number = $post_data['modal_add_card_num'];

                $account_type = $post_data['account_type'];



                $is_existing = $this->M_financial_accounts->get_account_number($account_number);



                if ($is_existing) {

                    return $this->_send_json_response(FALSE, 'The account is already saved. Please use a different name');
                }



                $account_information = [

                    'member_id' => $member_id['id'],

                    'method_id' => $method_id,

                    'account_name' => $account_name,

                    'account_number' => $account_number,

                    'account_type' => $account_type,

                ] + $this->_create_additional;



                $insert_acc_info = $this->M_financial_accounts->insert($account_information);



                if (!$insert_acc_info) {

                    return $this->_send_json_response(FALSE, 'An error occured Please Try Again');
                }



                // Commit transaction

                $this->db->trans_commit();

                return $this->_send_json_response(TRUE, 'Data saved successfully!');
            } catch (DatabaseException $e) {

                // Handle database-related exceptions (e.g., constraint violation)

                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            } catch (Exception $e) {

                // Handle other types of exceptions

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }
        }
    }





    public function addBilling()
    {



        if ($post_data = $this->security->xss_clean($this->input->post())) {

            try {
                $rules = [

                    ['field' => 'billing_email', 'label' => 'Billing Email', 'rules' => 'required'],
                    ['field' => 'mobile_number', 'label' => 'Mobile Number', 'rules' => 'required'],
                    ['field' => 'address', 'label' => 'Address', 'rules' => 'required'],
                    ['field' => 'province', 'label' => 'Province', 'rules' => 'required'],
                ];


                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() === FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }

                $this->db->trans_begin();

                // Verification if account number is existing: 
                $member_id = $this->M_members->get_by_user($this->_user_id);
                $billing_email = $post_data['billing_email'];
                $mobile_number = $post_data['mobile_number'];
                $address = $post_data['address'];
                $province = $post_data['province'];

                $account_information = [
                    'user_id' => $this->_user_id,
                    'street_address' => $address,
                    'municipality' => $province,
                    'billing_email' => $billing_email,
                    'mobile_number' => $mobile_number,
                ];

                $insert_acc_info = $this->M_billing_address->insert($account_information);

                if (!$insert_acc_info) {
                    return $this->_send_json_response(FALSE, 'An error occured Please Try Again');
                }

                $this->db->trans_commit();

                return $this->_send_json_response(TRUE, 'Data saved successfully!');
            } catch (DatabaseException $e) {
                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            } catch (Exception $e) {
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }
        }
    }


    public function edit_billing()
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {

            try {

                $rules = [
                    ['field' => 'edit_email', 'label' => 'Billing Email', 'rules' => 'required'],
                    ['field' => 'edit_province', 'label' => 'Mobile Number', 'rules' => 'required'],
                    ['field' => 'edit_address', 'label' => 'Address', 'rules' => 'required'],
                    ['field' => 'edit_province', 'label' => 'Province', 'rules' => 'required'],

                ];



                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() === FALSE) {
                    $validation_errors = $this->form_validation->error_array();
                    return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                }



                $this->db->trans_begin();

                // Verification if account number is existing: 



                $member_id = $this->M_billing_address->get($this->_user_id);



                // Get the data: 

                $billing_email = $post_data['edit_email'];

                $mobile_number = $post_data['edit_number'];

                $address = $post_data['edit_address'];

                $province = $post_data['edit_province'];





                $account_information = [

                    'user_id' => $this->_user_id,

                    'street_address' => $address,

                    'municipality' => $province,

                    'billing_email' => $billing_email,

                    'mobile_number' => $mobile_number,

                ];



                $insert_acc_info = $this->M_billing_address->update($post_data['id'], $account_information);


                if (!$insert_acc_info) {
                    return $this->_send_json_response(FALSE, 'An error occured Please Try Again');
                }


                $this->db->trans_commit();
                return $this->_send_json_response(TRUE, 'Data updated successfully!');
            } catch (DatabaseException $e) {

                // Handle database-related exceptions (e.g., constraint violation)

                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            } catch (Exception $e) {

                // Handle other types of exceptions

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }
        }
    }

    public function delete_billing()
    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            $info = $this->M_billing_address->get_by_id($post_data['id']);

            if (empty($info)) {

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }



            try {

                if (!$this->M_billing_address->delete($info['id'], $this->_delete_additional)) {

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                }



                return $this->_send_json_response(TRUE, 'Data deleted successfully!');
            } catch (DatabaseException $e) {

                // Handle database-related exceptions (e.g., constraint violation)

                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            } catch (Exception $e) {

                // Handle other types of exceptions

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }
        }



        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
    }





    public function editProfile($id = null)
    {
        $info = $this->M_members->get_by_user($this->_user_id);
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            //declare the rules for the input
            $rules = array(
                ['field' => 'first_name', 'label', 'first_name', 'rules' => 'required|trim'],
                ['field' => 'middle_name', 'label', 'middle_name', 'rules' => 'required|trim'],
                ['field' => 'last_name', 'label', 'last_name', 'rules' => 'required|trim'],
                ['field' => 'phone_number', 'label', 'mobile_number', 'rules' => 'required|trim'],
                ['field' => 'email', 'label', 'email', 'rules' => 'required|trim'],
            );


            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == false) {
                $validation_errors = $this->form_validation->error_array();
                return $this->_send_json_response(FALSE, 'A  error occurred. Please try again later.');
            }


            $upload = $this->uploadPfP($post_data,$info['id']);

            if (!$upload) {
                return $this->_send_json_response(FALSE, 'An error occurred while uploading the profile picture. Please try again.');
            }

            $data = [
                'first_name' => $post_data['first_name'],
                'middle_name' => $post_data['middle_name'],
                'last_name' => $post_data['last_name'],
                'mobile_number' => $post_data['phone_number'],
                'address' => $post_data['address'],
                'email' => $post_data['email']
            ] + $this->_update_additional;



            $this->db->trans_start();

            try {
                if (!$this->M_members->update($info['id'], $data)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'An error occurred while updating your profile. Please try again later.');
                }
                $this->db->trans_complete();
                return $this->_send_json_response(TRUE, 'Profile updated successfully!');
            } catch (Exception $ex) {

                $this->db->trans_rollback();
                return $this->_send_json_response(FALSE, 'An error occurred while updating your profile. Please try again later.');
            }
        }
    }

    public function uploadPfP($post_data,$info)
    {
        $key = 'profile-picture';


         $profile_metadata = [
            'label' => 'Profile picture',
            'allowed_extensions' => ['jpg','jpeg','png'],
            'allowed_mime_types' => ['image/jpeg', 'image/jpg']
        ];


        $this->db->trans_begin();

        if (empty($_FILES[$key]['name'])) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, $profile_metadata['label']. "field is required.");
        }


        $file_name = $_FILES[$key]['name'];
        $file_tmp_name = $_FILES[$key]['tmp_name'];
        $file_type = $_FILES[$key]['type'];
        $file_error = $_FILES[$key]['error'];
        $file_size = $_FILES[$key]['size'];
        
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
      
        $file_mime = mime_content_type($file_tmp_name);


        

        if (!in_array($file_extension, $profile_metadata['allowed_extensions'])) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, "Only " . implode(', ', $profile_metadata['allowed_extensions']) . " files are allowed for." . $profile_metadata['label']);
        }

        if (!in_array($file_mime, $profile_metadata['allowed_mime_types'])) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, "Invalid file type for" . $profile_metadata['allowed_mime_types']. " Allowed types: " . implode(', ', $allowed_mime_types));
        }


        $upload_path = FCPATH .'/uploads/user/profile/' . $this->_user_id . '/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 077, true);
        }


        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = implode('|', $profile_metadata['allowed_extensions']);
        $config['file_name'] = uniqid(); // Generate unique filename


       

        $this->upload->initialize($config);

        $_FILES['file'] = [
            'name' => $file_name,
            'type' => $file_type,
            'tmp_name' => $file_tmp_name,
            'error' => $file_error,
            'size' => $file_size,
        ];


        if ($this->upload->do_upload('file')) {
            $upload_data = $this->upload->data();
            $file_type = pathinfo($upload_data['file_name'], PATHINFO_EXTENSION);
            $relative_path = $upload_path . $upload_data['file_name'];

            $pfp = [
                'profile_path' => $relative_path,
            ] + $this->_update_additional;
        

            if (!$this->M_members->update($info, $pfp)) {
                $this->db->trans_rollback();
                log_message('error', '❌ Failed to update profile_path in DB.');
                return $this->_send_json_response(FALSE, 'Database error while saving profile.');
            }

        } else {
            $this->db->trans_rollback();
            $error = $this->upload->display_errors('', '');

            return $this->_send_json_response(FALSE, "Upload error: $error");
        }


        $this->db->trans_commit();
        return TRUE;
    }


    private function _send_json_response($status, $message, $data = [])
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        exit(json_encode($response));
    }
}
