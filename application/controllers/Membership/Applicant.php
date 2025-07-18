<?php defined('BASEPATH') or exit('No direct script access allowed');



class Applicant extends CI_Controller

{



    public function __construct()

    {

        parent::__construct();



        // User related models

        $this->load->model('Users_model', 'M_users');

        $this->load->model('User_logs_model', 'M_user_logs');

        $this->load->model('Billing_address_model', 'M_billing_address');

        $this->load->model('User_referrals_model', 'M_referrals');

        $this->load->model('User_roles_model', 'M_user_roles');



        // Payment related models

        $this->load->model('Payment_records_model', 'M_payment_records');



        // Applicant related models

        $this->load->model('Members_model', 'M_members');

        $this->load->model('Member_beneficiaries_model', 'M_beneficiaries');

        $this->load->model('User_documents_model', 'M_documents');

        $this->load->model('Member_educ_backgrounds_model', 'M_educ_backgrounds');

        $this->load->model('Member_work_backgrounds_model', 'M_work_backgrounds');





        //helpers

        $this->load->helper('analytics_helper');

        $this->load->helper('data_table_helper');



        $this->_create_additional = array(

            'created_by' => $this->session->userdata('user_email') ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,

            'created_at' => NOW

        );



        $this->_update_additional = array(

            'updated_by' => $this->session->userdata('user_email') ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,

            'updated_at' => NOW

        );



        $this->_delete_additional = array(

            'deleted_by' => $this->session->userdata('user_email') ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,

            'deleted_at' => NOW

        );





        $this->_log_additional = array(

            'user_id' => $this->session->userdata('user_id') ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_EMAIL,

            'entity_name' => 'Employee',

            'ip_address' =>  $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'],

            'ip_address' => $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']

        );



        $this->_notifications_data = [

            'notifications' => get_top_notifications($this->session->userdata('user_id')),

            'unread_count' => get_unread_count($this->session->userdata('user_id')),

            'new_count' => get_new_count($this->session->userdata('user_id'))

        ];



        $this->_user_id  = $this->session->userdata('user_id') ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;

        $this->_user_email  = $this->session->userdata('user_email') ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;

        $this->_user_role  = $this->session->userdata('user_role') ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;

        $this->redirect_if_not_logged_in();

    }



    // Private method to check if the user is logged in

    private function redirect_if_not_logged_in()

    {

        if (!$this->session->userdata('user_email')) {

            redirect('Auth');

        }

    }





    public function dt_list()

    {



        $formatter = function ($item) {

            return [

                'id' => $item->id,

                'reference_number' => $item->reference_number,

                'first_name' => $item->first_name,

                'middle_name' => $item->middle_name,

                'last_name' => $item->last_name,

                'sex' => $item->sex,

                'civil_status' => $item->civil_status,

                'email' => $item->email,

                'mobile_number' => $item->mobile_number,

            ];

        };





        $filters = array(

            'search' => $this->input->post('search')['value'],

            'id' => $this->input->post('id'),

            'sex' => $this->input->post('sex'),

            'civil_status' => $this->input->post('civil_status'),

            'place_of_birth' => $this->input->post('place_of_birth'),

            'status' => $this->input->post('status')

        );



    $output = get_datatable($this, $this->M_members, $formatter, $filters);



        // Return the JSON response

        exit(json_encode($output));

    }







    public function index()

    {



        if (!has_permissions('view_membership_application')) {

            show_404();

            return;

        }



        $data['page_data'] = [

            'system_module' => 'Applicants',

            'system_section' => '',

            'title' => 'Applicants',

            'styles_path' => [

                'assets/vendor/libs/select2/select2.css',

                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',

                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',

                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',

                'assets/vendor/libs/@form-validation/form-validation.css',

            ],

            'scripts_path' => [

                'assets/vendor/libs/moment/moment.js',

                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',

                'assets/vendor/libs/@form-validation/popular.js',

                'assets/vendor/libs/@form-validation/bootstrap5.js',

                'assets/vendor/libs/@form-validation/auto-focus.js',

                'assets/js/applicant/index.js',

                'assets/js/applicant/index-manager.js'



            ]

        ] + $this->_notifications_data;



        $data['pending_member_approval'] = count_all('members', 'status', 'Processing');

        $data['approved_member'] = count_all('members', 'status', 'Approved');

        $data['total_users'] = count_all('users', 'deleted_at', NULL);



        $this->load->view('pages/applicant/index', $data);

    }



    public function view($id = NULL)

    {



        if (!$id) {

            show_404();

            exit();

        }



        $data['page_data'] = [

            'system_module' => 'Applicants',

            'system_section' => '',

            'title' => 'Applicants',

            'styles_path' => [

                'assets/vendor/libs/select2/select2.css',

                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',

                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',

                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',

                'assets/vendor/libs/@form-validation/form-validation.css',

                'assets/vendor/libs/bs-stepper/bs-stepper.css'

            ],

            'scripts_path' => [

                'assets/vendor/libs/moment/moment.js',

                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',

                'assets/vendor/libs/@form-validation/popular.js',

                'assets/vendor/libs/@form-validation/bootstrap5.js',

                'assets/vendor/libs/@form-validation/auto-focus.js',

                'assets/vendor/libs/cleavejs/cleave.js',

                'assets/vendor/libs/cleavejs/cleave-phone.js',

                'assets/vendor/libs/bs-stepper/bs-stepper.js',

                'assets/js/applicant/view.js'

            ]

        ] + $this->_notifications_data;





        $data['info'] = $applicant  =   $this->M_members->get($id);



        $data['educ_backgrounds']   =   $educ_backgrounds   =   $this->M_educ_backgrounds->list_by_member($applicant['id']);

        $data['work_backgrounds']   =   $work_backgrounds   =   $this->M_work_backgrounds->list_by_member($applicant['id']);

        $data['documents']  =   $documents  =   $this->M_documents->list_by_user($applicant['user_id']);

        $data['payment_records'] =   $payment_records  = $this->M_payment_records->get_by_id($applicant['user_id'], 'completed');



        $this->load->view('pages/applicant/view', $data);

    }

    public function approve()

    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $id = $post_data['user_id'];
            $member_id= $post_data['member_id'];
            $role = get_by_code_and_table($this->_user_id, 'user_id', 'user_roles');  // Get the current role
            $status = '';
            $role_id = '';


            try {

                // Start a transaction

                $this->db->trans_start();

                //revise
                if ($role['role_id'] == MEMBER_ADMIN_ID) {
                    $status = ['status' => 'Pending Manager Approval'] + $this->_update_additional;
                    $role_id = 7;
                } else if ($role['role_id'] == MANAGER_ADMIN_ID) {
                    $status = ['status' => 'Approved'] + $this->_update_additional;
                    $role_id = 8;
                    $referralLink =['status'=> 'approved'] + $this->_update_additional;

                    if (!$this->M_referrals->updateByUserId($member_id, $referralLink)) {
                            $this->db->trans_rollback();
                            return $this->_send_json_response(FALSE, 'A database error occurred while updating referral. Please try again later.');
                        }


                } else {
                    // Handle any role that does not meet the expected values (for logging or error)
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'Invalid role for approval.');
                }



                // Log the action

                $admin_logs = [
                    'type_of_action' => 'Membership Application Approved',
                    'action_description' => 'User ' . $this->_user_email  . ' approved a new member in the database'
                ] + $this->_log_additional;



                // Update user role to the next stage or final role (Manager in the case of Officer)

                if (!$this->M_user_roles->update_by_userId($id, ['role_id' => $role_id] + $this->_update_additional)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                }



                // Update membership status

                if (!$this->M_members->update($member_id, $status)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                }



                if (!$this->M_user_logs->insert($admin_logs)) {
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                }


                $this->db->trans_commit();
                return $this->_send_json_response(TRUE, 'Membership application successfully submitted!');

            } catch (DatabaseException $e) {
                // Handle specific database exception
                $this->db->trans_rollback();
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            } catch (Exception $e) {
                // Handle general exceptions
                $this->db->trans_rollback();
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }

        }

    }



    public function reject()

    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {



            $member_id= $post_data['member_id'];

            $Remarks = $post_data['remarks'];

            $role = get_by_code_and_table($this->_user_id, 'user_id', 'user_roles');  // Get the current role

                try {

                    // Start a transaction

                    $this->db->trans_start();

                    if ($role['role_id'] == 17) {



                        $status = ['status' => 'On Hold' ,

                        'remarks' => $Remarks

                        ] + $this->_update_additional;





                    } else if ($role['role_id'] == 19) {



                        $status = ['status' => 'Rejected by Manager',

                        'remarks' =>$Remarks] + $this->_update_additional;



                    } else {

                        // Handle any role that does not meet the expected values (for logging or error)

                        $this->db->trans_rollback();

                        return $this->_send_json_response(FALSE, 'Invalid role for approval.');

                    }



                $admin_logs = [

                    'type_of_action' => 'Membership Application Rejected',

                    'action_description' => 'User ' . $this->_user_email  . ' Rejected an applicant in the form'

                ] + $this->_log_additional;







                if (!$this->M_members->update($member_id, $status)) {

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

                }





                if (!$this->M_user_logs->insert($admin_logs)) {

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

                }



                $this->db->trans_commit();

                return $this->_send_json_response(TRUE, 'Membership application successfully submitted!');

            } catch (DatabaseException $e) {

                // Handle other types of exceptions

                $this->db->trans_rollback();

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');

            } catch (Exception $e) {

                // Handle other types of exceptions

                $this->db->trans_rollback();

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');

            }

        }

    }



    private function _send_json_response($status, $message, $additional_data = [])

    {

        $response = ['status' => $status, 'message' => $message, 'validation_errors' => $additional_data];

        exit(json_encode($response));

    }





}

