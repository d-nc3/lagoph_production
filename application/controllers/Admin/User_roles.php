<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_roles extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // User related models
        $this->load->model('Users_model', 'M_users');
        $this->load->model('Billing_address_model', 'M_billing_address');
        $this->load->model('User_logs_model', 'M_user_logs');
        $this->load->model('Employees_model', 'M_employees');

        //Office related models
        $this->load->model('Units_model', 'M_units');
        $this->load->model('Positions_model', 'M_positions');
        $this->load->model('Departments_model', 'M_departments');

        //Roles related models: 
        $this->load->model('Roles_model', 'M_roles');

        //Permissions related models:
        $this->load->model('Permissions_model', 'M_permissions');
        $this->load->model('Role_permissions_model', 'M_role_permissions');
        $this->load->model('User_roles_model', 'M_user_roles');

        $this->load->helper('analytics_helper');
        $this->load->helper('data_table_helper');

        //User session related models:
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
    }


    // Private method to check if the user is logged in
    private function redirect_if_not_logged_in()
    {
        if (!isset($_SESSION['user_email'])) {
            redirect('Auth');
        }
    }



   public function dt_list() {

    $formatter = function($item){
        return [

            'role_name' => $item->role_name,
            'first_name' => $item->first_name,
            'last_name' => $item->last_name,
            'email' => $item->email,
            'user_id'=>$item->user_id,
            'created_at' => $item->created_at
        ];
    };

    $filter = [
        'search' => $this->input->post('search')['value']
    ];  
  
    $output = get_datatable($this,$this->M_user_roles,$formatter,$filter);
    exit(json_encode($output));
   }


    public function index()
    {
        $data['page_data'] = [
            'system_module' => 'System_admin',
            'system_section' => 'System_admin',
            'title' => 'Admin',
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
                "assets/vendor/libs/tagify/tagify.js",
                "assets/vendor/libs/bootstrap-select/bootstrap-select.js",
                'assets/vendor/libs/typeahead-js/typeahead.js',
                'assets/vendor/libs/bloodhound/bloodhound.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/@form-validation/popular.js',
                'assets/vendor/libs/@form-validation/bootstrap5.js',
                'assets/vendor/libs/@form-validation/auto-focus.js',
                'assets/js/forms-selects.js',
                'assets/js/forms-typeahead.js',
                'assets/js/system_admin/user-role.js',
                'assets/js/system_admin/modal-add-user-role.js',


            ]
        ] + $this->_notifications_data;



        $data['roles'] = $this->M_roles->get_all();
        $data['users'] = $this->M_users->get_all();
        $data['positions'] = $this->M_positions->get_all();

        // Counter for members
        $data['count_member'] = count_all('user_roles','role_id','8'); 
        $data['loan_approver_count'] = count_all('user_roles','role_id','6');
        $data['admin_counter'] = count_all('user_roles','role_id',2);
        $data['user_counter'] = count_all('user_roles','role_id',7);
        $data['cashier_counter'] = count_all('user_roles','role_id',9);
        $this->load->view('pages/system_admin/index/user-role', $data);
    }


    public function get_all()
    {
        $post_data = $this->input->post();

        $this->security->xss_clean($post_data);
        $data = $this->M_user_roles->get_role($post_data['id']);

 


        if (empty($data)) {
            return $this->_send_json_response(FALSE, 'No data found');
        }

        // Send JSON response
        exit(json_encode($data));
    }


    public function create()
    {
        $post_data = $this->input->post();

        if (!$post_data) {
            $this->_send_json_response('error', 'No data found');
        }

        $this->security->xss_clean($post_data);

        $rules = [
            ['field' => 'modalRoleName', 'label' => 'Role Name', 'rules' => 'required'],
            ['field' => 'modalUserName', 'label' => 'User Name', 'rules' => 'required'],
        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $validation_errors = $this->form_validation->error_array();
            $formatted_errors = $this->_format_validation_errors($rules, $validation_errors);
            $this->_send_json_response('FALSE', 'Validation error', $formatted_errors);
        }

        try {

            $role_id = $post_data['modalRoleName'];
            $created_by = $this->_user_email;
            $created_at = NOW;
            $user_id = $post_data['modalUserName'];

            $is_existing = get_by_user_id_and_table($user_id,'users','user_id','user_roles');
            
            if ($is_existing){
              $this->_send_json_response(FALSE,'User exists with a role. Please try again');
            }

            $insert_data = [
                'role_id' => $role_id,
                'user_id' => $user_id, // ✅ Use ID from database
                'created_by' => $created_by,
                'created_at' => $created_at
            ] + $this->_create_additional;

            $add_data = $this->M_user_roles->insert($insert_data);
            
            if (!$add_data) {
                $this->_send_json_response(FALSE, "Failed to insert data in the database please tyr again");
            }
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Transaction failed.');
            }
            return $this->_send_json_response(TRUE, 'Data updated successfully!');
        } catch (Exception $e) {
            // Rollback transaction in case of any failure
            $this->db->trans_rollback();
            log_message('error', $e->getMessage());
            return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
        }
    }

    public function edit(){

        $post_data = $this->input->post();
        if (!$post_data) {
            $this->_send_json_response('error', 'No data found');
        }
        $this->security->xss_clean($post_data);
        $rules = [
            ['field' => 'editRole', 'label' => 'Role Name', 'rules' => 'required'],
            ['field' => 'editUserId', 'label' => 'User id', 'rules' => 'required'],
        ];
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            $validation_errors = $this->form_validation->error_array();
            $formatted_errors = $this->_format_validation_errors($rules, $validation_errors);
            $this->_send_json_response('FALSE', 'Validation error', $formatted_errors);
        }
        try {

            $role_id = $post_data['editRole'];
            $user_id = $post_data['editUserId'];
            $update_data = [
                'user_id' => $user_id,
                'role_id' => $role_id, 
            ] + $this->_update_additional;

            if (!$this->M_user_roles->update_by_userId($user_id, $update_data)) {
                return $this->_send_json_response(FALSE, "Failed to update data in the database please try again");
            }
            return $this->_send_json_response(TRUE, 'Data updated successfully!');
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
        }
    }

    
    public function delete()
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $info = $this->M_users->get($post_data['id']);
            if (empty($info)) {
                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
            }

            try {
                if (!$this->M_users->delete($info['id'], $this->_delete_additional)) {
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
