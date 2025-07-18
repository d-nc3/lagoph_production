<?php



use function PHPUnit\Framework\isEmpty;



defined('BASEPATH') or exit('No direct script access allowed');



class Profile extends CI_Controller
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



        //Official receipt related models

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

                'assets/js/pages-account-settings-account.js',

            ]

        ] + $this->_notifications_data;





        $data['employees'] = $this->M_employees->get($this->_user_id);

        $data['positions'] = $this->M_positions->get_all();

        $data['user_logs'] = $this->M_user_logs->get_logs_by_user_id($this->_user_id);



        // check entity type and load the correct view for each types

        $this->load->view('pages/profile/profile', $data);

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



        $info = $this->M_billing_address->get_all_address($this->_user_id);



        if (empty($info)) {

            return $this->_send_json_response(FALSE, 'Please contact your Admin Support and try again');

        }

        exit(json_encode($info));

        return $this->_send_json_response(FALSE, 'An error occurred. Please try again');

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



                if (!$member_id) {

                    return $this->_send_json_response(FALSE, 'Please Complete the billing address only ');

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

        $data['financial_institution'] = $this->M_payment_methods->get_online_method();

        $data['account_types'] = $this->M_account_types->get_option_online();

        $data['payment_method'] = $this->M_payment_methods->get_online_method();



        $this->load->view('pages/profile/account_profile/billing', $data);

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



                // Get the data: 

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



    public function settings($id = null)
    {

        //declaration at which user profile is being fetched

        $data['info'] = $info = $this->M_members->get_by_user($this->_user_id);

        if (empty($info)) {

            show_404();

            exit;

        }



        $data['page_data'] = [

            'system_module' => 'Settings',

            'system_section' => 'Settings',

            'title' => 'Settings',

            'style_path' => [],

            'scripts_path' => [

                'assets/js/app-user-view-account.js',

                'assets/js/pages-account-settings-account.js',

            ],

        ] + $this->_notifications_data;



        $this->load->view('pages/profile/settings/settings-index', $data);

        if ($post_data = $this->security->xss_clean($this->input->post())) {



            //declare the rules for the input

            $rules = array(

                ['field' => 'first_name', 'label', 'First_name', 'rules' => 'required|trim'],

                ['field' => 'last_name', 'label', 'last_name', 'rules' => 'required|trim'],

                ['field' => 'mobile_number', 'label', 'mobile_number', 'rules' => 'required|trim'],

                ['field' => 'sex', 'label', 'sex', 'rules' => 'required|trim'],

                ['field' => 'civil_status', 'label', 'civil_status', 'rules' => 'required|trim'],

                ['field' => 'date_of_birth', 'label', 'date_of_birth', 'rules' => 'required|trim'],

                ['field' => 'place_of_birth', 'label', 'place_of_birth', 'rules' => 'required|trim'],

                ['field' => 'tel_number', 'label', 'tel_number', 'rules' => 'required|trim'],

                ['field' => 'email', 'label', 'email', 'rules' => 'required|trim'],

            );



            $this->form_validation->set_rules($rules);



            if ($this->form_validation->run() == false) {

                $validation_errors = $this->form_validation->error_array();

                return $this->_send_json_response(FALSE, 'A  error occurred. Please try again later.');

            }



            if (isset($_FILES['avatar']['name']) && $_FILES['avatar']['name']) {



                $valid_extension = array('png', 'jpeg', 'jpg');

                $file_path = FCPATH . USER_IMG_FOLDER_PATH . $info['id'] . '/';



                if (!is_dir($file_path)) {

                    if (!mkdir($file_path, 0777, true)) {

                        return $this->_send_json_response(FALSE, 'A  error occurred. Please try again later.');

                    }

                }



                $img = $_FILES['avatar']['name'];

                $tmp = $_FILES['avatar']['tmp_name'];



                //to extract the information inside the file/image



                $extract = strtolower(pathinfo($img, PATHINFO_EXTENSION));

                $new_avatar_name = strval(rand(1000000, 9999999)) . '.' . $extract;



                // verifies if  elements inside the array is valid

                if (in_array($extract, $valid_extenstions)) {

                    $path = $file_path . strtolower($new_avatar_name);

                    $img_url = USER_IMG_FOLDER_PATH . $info['id'] . '/' . $new_avatar_name;



                    if (isset($info['img_path_url']) && $info['img_path_url']) {

                        $existing_avatar_path = FCPATH . $info['img_path_url'];

                        if (file_exists($existing_avatar_path)) {

                            if (!unlink($existing_avatar_path)) {

                                exit(json_encode([

                                    'status' => RESULT_FAILED,

                                    'message' => 'Failed to delete existing avatar file. Please try again later!',

                                ]));

                            }

                        }

                    }

                }



                if (!move_uploaded_file($tmp, $path)) {

                    exit(json_encode([

                        'status' => RESULT_FAILED,

                        'message' => 'Oops! Something went wrong. Avatar uploading failed. Please try again later!',

                    ]));

                }



                $data = ['img_path_url' => $img_url] + $this->_update_additional;

                if (!$this->M_documents->update($data, $info['id'])) {

                    exit(json_encode([

                        'status' => RESULT_FAILED,

                        'message' => 'Oops! Something went wrong. Avatar uploading failed. Please try again later!',

                    ]));

                }

            } else {

                exit(json_encode([

                    'status' => RESULT_FAILED,

                    'message' => 'Invalid file format. Please upload a valid image file.',

                ]));

            }





            $data = [

                'first_name' => $post_data['first_name'],

                'middle_name' => $post_data['middle_name'],

                'last_name' => $post_data['last_name'],

                'sex' => $post_data['sex'],

                'civil_status' => $post_data['marital_status'],

                'date_of_birth' => $post_data['date_of_birth'],

                'place_of_birth' => $post_data['place_of_birth'],

                'mobile_number' => $post_data['mobile_number'],

                'tel_number' => $post_data['tel_number'],

                'address' => $post_data['address']



            ] + $this->_update_additional;



            $this->db->trans_start();



            try {

                if (!$this->M_members->insert($data, $info['id'])) {

                    throw new Exception('Ooops, Something went wrong while saving data. Contact your technical support');

                }

                $this->db->trans_complete();

                exit(json_encode([

                    'status' => RESULT_SUCCESS,

                    'message' => 'Data updated successfully!',

                ]));

            } catch (Exception $ex) {

                $this->db->trans_rollback();

                exit(json_encode([

                    'status' => RESULT_FAILED,

                    'message' => $ex,

                ]));

            }

        }

    }







    public function additional_information()
    {



        // check if profile exists, IF NOT then show error 404

        $data['info'] = $info = $this->M_users->get($id);

        if (empty($info)) {

            show_404();

            exit;

        }



        // store the page data to an array, to be sent to the views

        $data['page_data'] = [

            'system_module' => 'Notifications',

            'system_section' => 'Notifications',

            'title' => 'Additional Informations',

            'notifications' => get_top_notifications($this->_user_id),

            'unread_count' => get_unread_count($this->_user_id),

            'new_count' => get_new_count($this->_user_id)

        ];

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

        $response = array_merge(['status' => $status, 'message' => $message]);

        exit(json_encode($response));

    }









    // public function verify_password($post_data) {



    //     // check if there are submitted data

    //     if ($this->security->xss_clean($post_data)) {



    //         $separator = "_this_is_a_seperator_";

    //         $parts = explode($separator, $post_data);

    //         $system_user_id = $parts[0];

    //         $password = $parts[1];



    //         // check if profile exists, IF NOT then show error 404

    //         $info = $this->M_system_users->get($system_user_id);

    //         if (empty($info)) {

    //             show_404();

    //             exit;

    //         }   



    //         // check if the password entered is system generated and is match

    // 		// if not match, increment the login_attempt and return an error

    // 		$is_verified = password_verify($password, $info['password']);

    // 		if (!$is_verified) {

    // 			exit(json_encode([

    // 				'status' => RESULT_FAILED,

    // 				'message' => 'Incorrect password! Please try again.'

    // 			]));

    // 		}



    //         $data = [

    //             'is_active' => BOOL_NO

    //         ] + $this->_update_additional;



    //         if (!$this->M_system_users->update($data, $system_user_id)) {

    //             exit(json_encode([

    // 				'status' => RESULT_FAILED,

    // 				'message' => 'Something went wrong! Please try again.'

    // 			]));

    //         }



    //         exit(json_encode([

    //             'status' => RESULT_SUCCESS,

    //             'message' => 'Account successfully deactivated! You will now be logged out.'

    //         ]));

    //     }



    //     show_404();

    //     exit;

    // }



    // public function verify_code_and_password() {



    //     // check if there are submitted data

    //     if ($post_data = $this->security->xss_clean($this->input->post())) {

    //         // check if profile exists, IF NOT then show error 404

    //         $info = $this->M_system_users->get($post_data['kt_change_email_verify_id']);

    //         if (empty($info)) {

    //             show_404();

    //             exit;

    //         }



    //         // assign rules

    //         $rules = array(

    // 			['field' => 'kt_change_email_verify_code', 'label' => 'Verification Code', 'rules' => 'required|trim'],

    //             ['field' => 'kt_change_email_verify_password', 'label' => 'Confirm Password', 'rules' => 'required|trim']

    // 		);

    // 		$this->form_validation->set_rules($rules);



    //         // check, if the set rules are followed. IF NOT, then return an error

    // 		if ($this->form_validation->run() === FALSE) {

    // 			$validation_errors = $this->form_validation->error_array();

    // 			exit(json_encode([

    // 				'status' => RESULT_FAILED,

    // 				'message' => 'Oops! Something went wrong, please check all the fields and try again.',

    // 				'validation_errors' => $validation_errors,

    // 			]));

    // 		}



    //         // check if password is correct

    // 		$is_verified = password_verify($post_data['kt_change_email_verify_password'], $info['password']);

    //         if (!$is_verified) {

    // 			exit(json_encode([

    // 				'status' => RESULT_FAILED,

    // 				'message' => 'Incorrect password! Please try again.'

    // 			]));

    // 		}



    //         $filters = [ 

    //             'system_user_id' => $info['id'], 

    //             'email' => $post_data['kt_change_email_verify_email'], 

    //             'verification_code' => $post_data['kt_change_email_verify_code'] 

    //         ];



    //         $verification = $this->M_verifications->get_by_filters($filters);

    //         if (empty($verification)) {

    //             exit(json_encode([

    // 				'status' => RESULT_FAILED,

    // 				'message' => 'Incorrect verification code! Please try again.'

    // 			]));

    //         }



    //         $data = [

    //             'username' => $post_data['kt_change_email_verify_email'],

    //             'email' => $post_data['kt_change_email_verify_email'],

    //             'is_email_verified' => BOOL_YES

    //         ] + $this->_update_additional;



    //         if (!$this->M_system_users->update($data, $info['id'])) {

    //             exit(json_encode([

    //                 'status' => RESULT_FAILED,

    //                 'message' => 'Something went wrong! Please try again.'

    //             ]));

    //         }



    //         $verification_data = [

    //             'is_verified' => BOOL_YES

    //         ] + $this->_update_additional;



    //         if (!$this->M_verifications->update($verification_data, $verification['id'])) {

    //             exit(json_encode([

    //                 'status' => RESULT_FAILED,

    //                 'message' => 'Something went wrong! Please try again.'

    //             ]));

    //         }



    //         exit(json_encode([

    //             'status' => RESULT_SUCCESS,

    //             'message' => 'Email has been changed successfully!'

    //         ]));



    //     }



    //     show_404();

    //     exit;

    // }



    // public function verify_code_and_email() {



    //     // check if there are submitted data

    //     if ($post_data = $this->security->xss_clean($this->input->post())) {

    //         // check if profile exists, IF NOT then show error 404

    //         $info = $this->M_system_users->get($post_data['kt_verify_email_id']);

    //         if (empty($info)) {

    //             show_404();

    //             exit;

    //         }



    //         // assign rules

    //         $rules = array(

    //             ['field' => 'kt_verify_email_code', 'label' => 'Verification Code', 'rules' => 'required|trim'],

    //         );

    //         $this->form_validation->set_rules($rules);



    //         // check, if the set rules are followed. IF NOT, then return an error

    //         if ($this->form_validation->run() === FALSE) {

    //             $validation_errors = $this->form_validation->error_array();

    // 			exit(json_encode([

    // 				'status' => RESULT_FAILED,

    // 				'message' => 'Oops! Something went wrong, please check all the fields and try again.',

    // 				'validation_errors' => $validation_errors,

    // 			]));

    //         }



    //         // set filters

    //         $filters = [ 

    //             'system_user_id' => $info['id'], 

    //             'email' => $post_data['kt_verify_email'], 

    //             'verification_code' => $post_data['kt_verify_email_code'] 

    //         ];



    //         // check if verification code exists

    //         $verification = $this->M_verifications->get_by_filters($filters);

    //         if (empty($verification)) {

    //             exit(json_encode([

    //                 'status' => RESULT_FAILED,

    //                 'message' => 'Incorrect verification code! Please try again.'

    //             ]));

    //         }



    //         $data = [

    //             'is_email_verified' => BOOL_YES

    //         ] + $this->_update_additional;



    //         if (!$this->M_system_users->update($data, $info['id'])) {

    //             exit(json_encode([

    //                 'status' => RESULT_FAILED,

    //                 'message' => 'Something went wrong! Please try again.'

    //             ]));

    //         }



    //         $verification_data = [

    //             'is_verified' => BOOL_YES

    //         ] + $this->_update_additional;



    //         if (!$this->M_verifications->update($verification_data, $verification['id'])) {

    //             exit(json_encode([

    //                 'status' => RESULT_FAILED,

    //                 'message' => 'Something went wrong! Please try again.'

    //             ]));

    //         }



    //         exit(json_encode([

    //             'status' => RESULT_SUCCESS,

    //             'message' => 'Email has been verified successfully!'

    //         ]));



    //     }



    //     show_404();

    //     exit;

    // }



    // public function change_password() {



    //     // check if there are submitted data

    //     if ($post_data = $this->security->xss_clean($this->input->post())) {



    //         // check if profile exists, IF NOT then show error 404

    //         $info = $this->M_system_users->get($post_data['kt_change_password_id']);

    //         if (empty($info)) {

    //             show_404();

    //             exit;

    //         }



    //         // check if the password entered is system generated and is match

    // 		// if not match, increment the login_attempt and return an error

    // 		$is_verified = password_verify($post_data['kt_change_password_current'], $info['password']);

    // 		if (!$is_verified) {

    // 			exit(json_encode([

    // 				'status' => RESULT_FAILED,

    // 				'message' => 'Incorrect password! Please try again.'

    // 			]));

    // 		}



    //         // set rules

    //         $rules = array(

    // 			['field' => 'kt_change_password_current', 'label' => 'Current Password', 'rules' => 'required|trim'],

    // 			['field' => 'kt_change_password_new', 'label' => 'New Password', 'rules' => 'required|trim'],

    // 			['field' => 'kt_change_password_confirm_new', 'label' => 'Confirm New Password', 'rules' => 'required|trim|matches[kt_change_password_new]'] 

    // 		);

    // 		$this->form_validation->set_rules($rules);



    //         // check, if the set rules are followed. IF NOT, then return an error

    // 		if ($this->form_validation->run() === FALSE) {

    // 			$validation_errors = $this->form_validation->error_array();

    // 			exit(json_encode([

    // 				'status' => RESULT_FAILED,

    // 				'message' => 'Oops! Something went wrong, please check all the fields and try again.',

    // 				'validation_errors' => $validation_errors,

    // 			]));

    // 		}



    //         $new_password_hash = password_hash($post_data['kt_change_password_confirm_new'], PASSWORD_DEFAULT);

    //         $data = [

    //             'password' => $new_password_hash

    //         ] + $this->_update_additional;



    //         if (!$this->M_system_users->update($data, $info['id'])) {

    //             exit(json_encode([

    //                 'status' => RESULT_FAILED,

    //                 'message' => 'Something went wrong! Please try again.'

    //             ]));

    //         }



    //         exit(json_encode([

    //             'status' => RESULT_SUCCESS,

    //             'message' => 'Password updated successfully!'

    //         ]));

    //     }



    //     show_404();

    //     exit;

    // }



    // public function reset_password() {



    //     // check if there are submitted data

    //     if ($post_data = $this->security->xss_clean($this->input->post())) {



    //         // check if profile exists, IF NOT then show error 404

    //         $info = $this->M_system_users->get($post_data['system_user_id']);

    //         if (empty($info)) {

    //             show_404();

    //             exit;

    //         }



    //         $default_password_hash = password_hash(DEFAULT_PASSWORD, PASSWORD_DEFAULT);

    //         $data = [

    //             'password' => $default_password_hash

    //         ] + $this->_update_additional;



    //         if (!$this->M_system_users->update($data, $info['id'])) {

    //             exit(json_encode([

    //                 'status' => RESULT_FAILED,

    //                 'message' => 'Something went wrong! Please try again.'

    //             ]));

    //         }



    //         exit(json_encode([

    //             'status' => RESULT_SUCCESS,

    //             'message' => 'Password reset successfully! The default password is \'password\''

    //         ]));

    //     }

    // }



    // public function security($id = null) {



    //     // check if profile exists, IF NOT then show error 404

    //     $data['info'] = $info = $this->M_system_users->get($id);

    //     if (empty($info)) {

    //         show_404();

    //         exit;

    //     }



    // 	// check if there are submitted data

    //     if ($post_data = $this->input->post()) {



    // 	}



    // 	// store the page data to an array, to be sent to the views

    // 	$data['page_data'] = [

    // 		'system_module' => 'Profile',

    // 		'system_section' => 'My Profile',

    //         'title' => 'Profile Security',

    //         'styles_path' => [

    //             'resources/dist/assets/plugins/custom/datatables/datatables.bundle.css'

    // 		],

    // 		'scripts_path' => [

    //             'resources/dist/assets/plugins/custom/datatables/datatables.bundle.js',

    //             'assets/js/profile/employee/security.js'

    //         ]

    // 	];



    //     // check if user has default password

    //     $has_default_password = password_verify(DEFAULT_PASSWORD, $info['password']);

    //     $data['has_default_password'] = ($has_default_password) ? BOOL_YES : BOOL_NO;



    //     // get security details

    //     $data['login_history'] = $this->M_login_history->get_latest_by_system_user_id($info['id']);

    //     $data['success_count'] = $this->M_login_history->count_all_success_by_system_user_id($info['id']);

    //     $data['failed_count'] = $this->M_login_history->count_all_failed_by_system_user_id($info['id']);



    // 	// load the view and include the page datas on each view

    // 	$this->load->view('layouts/dash/head', $data);

    // 	$this->load->view('layouts/dash/head-nav', $data);

    //     // check entity type and load the correct view for each types

    //     switch($info['entity_type']) {

    //         case 'MEMBER':

    //             $data['member_info'] = $this->M_members->get_by_system_user_id($info['id']);

    // 	        $this->load->view('modules/profile/member/security', $data);

    //             break;

    //         case 'EMPLOYEE':

    //             $data['employee_info'] = $this->M_employees->get_by_system_user_id($info['id']);

    //             $this->load->view('modules/profile/employee/security', $data);

    //             break;

    //         default:

    //             redirect('Auth/logout');

    //     }

    // 	$this->load->view('layouts/dash/footer', $data);

    // 	$this->load->view('layouts/dash/drawers', $data);

    // 	$this->load->view('layouts/dash/foot', $data);

    // }



    // public function statements($id = null) {



    //     // check if profile exists, IF NOT then show error 404

    //     $data['info'] = $info = $this->M_system_users->get($id);

    //     if (empty($info)) {

    //         show_404();

    //         exit;

    //     }



    // 	// check if there are submitted data

    //     if ($get_data = $this->security->xss_clean($this->input->get())) {

    //         $data['year_filter'] = $get_data['statements_year_filter'];

    // 		$data['statements'] = $statements = $this->M_transactions->get_all_by_system_user_id_and_year($info['id'], $get_data['statements_year_filter']);

    // 	} else {

    //         $data['statements'] = $statements = $this->M_transactions->get_all_by_system_user_id_and_year($info['id'], YEAR_NOW);

    //     }



    // 	// store the page data to an array, to be sent to the views

    // 	$data['page_data'] = [

    // 		'system_module' => 'Profile',

    // 		'system_section' => 'My Profile',

    //         'title' => 'Statements',

    //         'styles_path' => [

    //             'resources/dist/assets/plugins/custom/datatables/datatables.bundle.css'

    // 		],

    // 		'scripts_path' => [

    //             'resources/dist/assets/plugins/custom/datatables/datatables.bundle.js',

    //             'assets/js/profile/employee/statements.js'

    //         ]

    // 	];



    //     // check if user has default password

    //     $has_default_password = password_verify(DEFAULT_PASSWORD, $info['password']);

    //     $data['has_default_password'] = ($has_default_password) ? BOOL_YES : BOOL_NO;



    // 	// load the view and include the page datas on each view

    // 	$this->load->view('layouts/dash/head', $data);

    // 	$this->load->view('layouts/dash/head-nav', $data);

    //     // check entity type and load the correct view for each types

    //     switch($info['entity_type']) {

    //         case 'MEMBER':

    //             $data['member_info'] = $this->M_members->get_by_system_user_id($info['id']);

    // 	        $this->load->view('modules/profile/member/statements', $data);

    //             break;

    //         case 'EMPLOYEE':

    //             $data['employee_info'] = $this->M_employees->get_by_system_user_id($info['id']);

    //             $this->load->view('modules/profile/employee/statements', $data);

    //             break;

    //         default:

    //             redirect('Auth/logout');

    //     }

    // 	$this->load->view('layouts/dash/footer', $data);

    // 	$this->load->view('layouts/dash/drawers', $data);

    // 	$this->load->view('layouts/dash/foot', $data);

    // }



    // public function referrals($id = null) {



    //     // check if profile exists, IF NOT then show error 404

    //     $data['info'] = $info = $this->M_system_users->get($id);

    //     if (empty($info)) {

    //         show_404();

    //         exit;

    //     }



    // 	// check if there are submitted data

    //     if ($get_data = $this->security->xss_clean($this->input->get())) {

    //         $data['year_filter'] = $get_data['referrals_year_filter'];

    // 		$data['referrals'] = $referrals = $this->M_referrals->get_all_by_system_user_id_and_year($info['id'], $get_data['referrals_year_filter']);

    // 	} else {

    //         $data['referrals'] = $referrals = $this->M_referrals->get_all_by_system_user_id_and_year($info['id'], YEAR_NOW);

    //     }



    // 	// store the page data to an array, to be sent to the views

    // 	$data['page_data'] = [

    // 		'system_module' => 'Profile',

    // 		'system_section' => 'My Profile',

    //         'title' => 'Referrals',

    //         'styles_path' => [

    //             'resources/dist/assets/plugins/custom/datatables/datatables.bundle.css'

    // 		],

    // 		'scripts_path' => [

    //             'resources/dist/assets/plugins/custom/datatables/datatables.bundle.js',

    //             'assets/js/profile/employee/referrals.js'

    //         ]

    // 	];



    //     // check if user has default password

    //     $has_default_password = password_verify(DEFAULT_PASSWORD, $info['password']);

    //     $data['has_default_password'] = ($has_default_password) ? BOOL_YES : BOOL_NO;



    //     // get all referral details

    //     $data['referrals_count'] = $this->M_referrals->count_all_by_system_user_id($info['id']);

    //     $data['referral_code'] = $referral_code = $this->generate_referral_code($info['id']);



    // 	// load the view and include the page datas on each view

    // 	$this->load->view('layouts/dash/head', $data);

    // 	$this->load->view('layouts/dash/head-nav', $data);

    //     // check entity type and load the correct view for each types

    //     switch($info['entity_type']) {

    //         case 'MEMBER':

    //             $data['member_info'] = $this->M_members->get_by_system_user_id($info['id']);

    // 	        $this->load->view('modules/profile/member/referrals', $data);

    //             break;

    //         case 'EMPLOYEE':

    //             $data['employee_info'] = $this->M_employees->get_by_system_user_id($info['id']);

    //             $this->load->view('modules/profile/employee/referrals', $data);

    //             break;

    //         default:

    //             redirect('Auth/logout');

    //     }

    // 	$this->load->view('layouts/dash/footer', $data);

    // 	$this->load->view('layouts/dash/drawers', $data);

    // 	$this->load->view('layouts/dash/foot', $data);

    // }





    // public function generate_referral_code($system_user_id = null) {



    //     if ($post_data = $this->input->post()) {

    //         $new_referral_code = generate_referral_code();

    //         $data = [

    //             'referral_from_system_user_id' => $post_data['system_user_id'],

    //             'referral_code' => $new_referral_code,

    //             'referral_to_system_user_id' => 0

    //         ] + $this->_create_additional;

    //         $this->M_referrals->insert($data);



    //         exit(json_encode([	

    //             'status' => RESULT_SUCCESS,

    //             'message' => 'New referral link generated successfully!',

    //             'referral_code' => $new_referral_code

    //         ]));

    // 	}



    //     $referral_code = $this->M_referrals->get_latest_by_system_user_id($system_user_id);

    //     if(empty($referral_code)) {

    //         $new_referral_code = generate_referral_code();

    //         $data = [

    //             'referral_from_system_user_id' => $system_user_id,

    //             'referral_code' => $new_referral_code,

    //             'referral_to_system_user_id' => 0

    //         ] + $this->_create_additional;

    //         $this->M_referrals->insert($data);



    //         return $new_referral_code;

    //     } else {

    //         return $referral_code['referral_code'];

    //     }

    // }

}

