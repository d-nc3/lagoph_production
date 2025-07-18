<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // Employee related Models
        $this->load->model('Employees_model', 'M_employees');
        $this->load->model('Units_model', 'M_units');
        $this->load->model('Positions_model', 'M_positions');
        $this->load->model('Departments_model', 'M_departments');

        // User related Models
        $this->load->model('Billing_address_model', 'M_billing_address');
        $this->load->model('Members_model', 'M_members');
        $this->load->model('Member_balance_model', 'M_member_balance');
        $this->load->model('User_logs_model', 'M_user_logs');
        $this->load->model('Users_model', 'M_users');
        $this->load->helper('data_table_helper');

        //User session related models:
        $this->_user_id  = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
        $this->_user_email  = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;
        $this->_user_role  = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
        $this->redirect_if_not_logged_in();



        $this->_create_additional = array();
        $this->_create_additional = array(
            'created_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
            'created_at' => NOW
        );

        $this->_update_additional = array(
            'updated_by' => isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,
            'updated_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
            'updated_at' => NOW
        );

        $this->_delete_additional = array(
            'deleted_by' => isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL,
            'deleted_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
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
        $data['page_data'] = [
            'system_module' => 'Member_list',
            'system_section' => '',
            'title' => 'Members',
            'styles_path' => [
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/tagify/tagify.css',
                'assets/vendor/libs/flatpickr/flatpickr.css',
                'assets/vendor/libs/@form-validation/form-validation.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
            ],
            'scripts_path' => [
                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
                'assets/vendor/libs/select2/select2.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/@form-validation/popular.js',
                'assets/vendor/libs/@form-validation/bootstrap5.js',
                'assets/vendor/libs/@form-validation/auto-focus.js',
                'assets/js/member/index.js',
            ]
        ] + $this->_notifications_data;



        $data['departments'] = $this->M_departments->get_all();
        $data['units'] = $this->M_units->get_all();
        $data['employees'] = $this->M_employees->get_all();
        $data['positions'] = $this->M_positions->get_all();
        $this->load->view('pages/member/index', $data);
    }

    public function dt_list()
    {

        $formatter =
            function ($member) {
                return [
                    'id'=>$member->id,
                    'user_id' => $member->user_id,
                    'first_name' => $member->first_name,
                    'middle_name' => $member->middle_name,
                    'last_name' => $member->last_name,
                    'email' => $member->email,
                    'mobile_number' => $member->mobile_number,
                    'address' => $member->address,
                    'status' => $member->status,
                    'created_at' => $member->created_at,
                    'updated_at' => $member->updated_at,
                ];
            };

        $filters = array(
            'search' => $this->input->post('search')['value'],
            'status' => $this->input->post('status'),
            'civil_status' => $this->input->post('civil_status')
        );

        $output = get_datatable($this, $this->M_members, $formatter, $filters);

        // Return the JSON response
        exit(json_encode($output));
    }


    public function view($id = NULL)
    {


            if (empty($id)) {
                show_404();
            }

        $data['page_data'] = [
            'system_module' => 'Overview',
            'system_section' => '',
            'title' => 'Employee',
            'styles_path' => [
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/tagify/tagify.css',
                'assets/vendor/libs/flatpickr/flatpickr.css',
                'assets/vendor/libs/@form-validation/form-validation.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
            ],
            'scripts_path' => [
                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
                'assets/vendor/libs/select2/select2.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/@form-validation/popular.js',
                'assets/vendor/libs/@form-validation/bootstrap5.js',
                'assets/vendor/libs/@form-validation/auto-focus.js',
                'assets/js/member/view.js',
            ]
        ] + $this->_notifications_data;



        $data['info'] =$info = $this->M_members->get_by_user($id) ?? NULL;
  
        $data['user_id'] = $info['user_id'] ?? NULL;
        $data['credit_information'] = $this->M_member_balance->get_by_user_id($id) ?? NULL;
    
        
        $this->load->view('pages/member/view', $data);
    }

    public function adjustCreditScore () {
        
            if ($post_data = $this->security->xss_clean($this->input->post())) {
                try {

             
                    $rules = [
                        ['field'=>'creditAmount', 'label'=>'Credit amount',   'rules'=>'required'],
                     
                        ['field'=>'adjustmentNote', 'label'=>'Remarks',   'rules'=>'required']
                     ];
                  
                     $this->form_validation->set_rules($rules);

                    if ($this->form_validation->run() == FALSE) {
                        $validation_errors = $this->form_validation->error_array();
                        return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
                    }   
                    
                
                    $creditAmount = $post_data['creditAmount'];
                    $userId = $post_data['userId'];
                    $adjustmentNote = $post_data['adjustmentNote'];
            
                   
                   $data = [
                      'available_credit' => $creditAmount,
                   ] + $this->_update_additional;

                    $admin_logs = [
                        'user_id' => $this->_user_id,
                        'type_of_action' => 'Credit Balance Edit',
                        'action_description' => $adjustmentNote,
                    ] + $this->_user_additional;
            
    
                    $memberBalance = $this->M_member_balance->update($userId, $data);

    
                    if (!$memberBalance) {
                        $this->db->trans_rollback();
                         $this->_send_json_response(FALSE, 'Failed to update member balance. Please try again later.');
                    }
            

                    if (!$this->M_user_logs->insert($admin_logs)) {
                        $this->db->trans_rollback();
                       $this->_send_json_response(FALSE, 'Failed to log the action. Please try again later.');
                    }
                     // Commit transaction if all operations succeed
                     $this->db->trans_commit();
                     return $this->_send_json_response(TRUE, 'Data saved successfully');
                        
                
                } catch (DatabaseException $e) {
                    // Handle database-related exceptions (e.g., constraint violation)
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
                } catch (Exception $e) {
                    // Handle other types of exceptions
                    $this->db->trans_rollback();
                    return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
                }
            }
    }
    

    public function event_logs($id = NULL)
    {

        $data['page_data'] = [
            'system_module' => 'event-logs',
            'system_section' => '',
            'title' => 'Employee',
            'styles_path' => [
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/tagify/tagify.css',
                'assets/vendor/libs/flatpickr/flatpickr.css',
                'assets/vendor/libs/@form-validation/form-validation.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
                'assets/vendor/css/pages/ui-carousel.css',
            ],
            'scripts_path' => [
                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
                'assets/vendor/libs/select2/select2.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/@form-validation/popular.js',
                'assets/vendor/libs/@form-validation/bootstrap5.js',
                'assets/vendor/libs/@form-validation/auto-focus.js',
                'assets/js/member/view.js',
                'assets/js/ui-carousel.js'
            ]
        ] + $this->_notifications_data;


        $data['info'] = $this->M_members->get_by_user($id);
        $data['user_id'] = $this->_user_id ?? NULL;
        $data['credit_information'] = $this->M_member_balance->get_by_user_id($id);
        // echo json_encode($data['info']);
        $this->load->view('pages/member/event-logs-index', $data);
     
    }

    public function statement($id = NULL)
    {

        $data['page_data'] = [
            'system_module' => 'statement',
            'system_section' => '',
            'title' => 'Employee',
            'styles_path' => [
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/tagify/tagify.css',
                'assets/vendor/libs/flatpickr/flatpickr.css',
                'assets/vendor/libs/@form-validation/form-validation.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',
            ],
            'scripts_path' => [
                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
                'assets/vendor/libs/select2/select2.js',
                'assets/vendor/libs/moment/moment.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/@form-validation/popular.js',
                'assets/vendor/libs/@form-validation/bootstrap5.js',
                'assets/vendor/libs/@form-validation/auto-focus.js',
                'assets/js/member/statement.js',
            ]
        ] + $this->_notifications_data;
        $data['info'] = $this->M_members->get_by_user($id) ?? NULL;
        $data['user_id'] = $this->_user_id ?? NULL;
        $data['credit_information'] = $this->M_member_balance->get_by_user_id($id) ?? NULL;
      
        $this->load->view('pages/member/statement',$data);
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

    private function _format_validation_errors($rules, $validation_errors)
    {
        $formatted_errors = [];
        foreach ($rules as $rule) {
            if (isset($validation_errors[$rule['field']])) {
                $formatted_errors[$rule['field']] = $validation_errors[$rule['field']];
            }
        }
        return $formatted_errors;
    }
}