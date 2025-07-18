<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permissions extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    // User related models
    $this->load->model('Users_model', 'M_users');
    $this->load->model('Billing_address_model', 'M_billing_address');
    $this->load->model('User_logs_model', 'M_user_logs');
    $this->load->model('Employees_model', 'M_employees');

    //Offive related models
    $this->load->model('Units_model', 'M_units');
    $this->load->model('Positions_model', 'M_positions');
    $this->load->model('Departments_model', 'M_departments');

    //Permissions related models
    $this->load->model('Permissions_model', 'M_permissions');
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

  public function dt_list()
  {

    $formatter = function ($item) {
      return [

        'permission_name' => $item->permission_name,
        'description' => $item->description,

      ];
    };

    $filter = [
      'search' => $this->input->post('search')['value']
    ];

    $output = get_datatable($this, $this->M_permissions, $formatter, $filter);
    echo json_encode($output);
  }


  // public function dt_list()
  // {
  //     $search = $this->security->xss_clean($this->input->post('search'));
  //     $order = $this->security->xss_clean($this->input->post('order'));
  //     $start = $this->security->xss_clean($this->input->post('start'));
  //     $length = $this->security->xss_clean($this->input->post('length'));
  //     $draw = $this->security->xss_clean($this->input->post('draw'));

  //     $filters['search'] = $search['value'];



  //     $list = $this->M_permissions->get_all_filtered($filters, $order, $start, $length);
  //     $data = array();
  //     $no = $start;
  //     foreach ($list as $item) {
  //         $no++;
  //         $row = array();
  //         $row['id'] = $item->id;
  //         $row['permission_name'] = $item->permission_name;
  //         $row['description'] = $item->description;
  //         $row['created_at'] = $item->created_at;
  //         $data[] = $row;
  //     }

  //     $output = array(
  //         "draw" => $this->input->post('draw'),
  //         "recordsTotal" => $this->M_permissions->count_all(),
  //         "recordsFiltered" => $this->M_permissions->count_filtered($filters),
  //         "data" => $data,
  //     );
  //     echo json_encode($output);
  // }


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
        'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
        'assets/vendor/libs/@form-validation/popular.js',
        'assets/vendor/libs/@form-validation/bootstrap5.js',
        'assets/vendor/libs/@form-validation/auto-focus.js',
        'assets/js/system_admin/modal-add-permission.js',
        'assets/js/system_admin/permissions.js',
      ]
    ] + $this->_notifications_data;



    $data['departments'] = $this->M_departments->get_all();
    $data['units'] = $this->M_units->get_all();
    $data['employees'] = $this->M_employees->get_all();
    $data['positions'] = $this->M_positions->get_all();
    $this->load->view('pages/system_admin/index/index-permissions', $data);
  }

  public function create_permissions()
  {
    $post_data = $this->input->post();

    if (!$post_data) {
      $this->_send_json_response('error', 'No data found');
    }

    $this->security->xss_clean($post_data);

    $rules = [
      ['field' => 'modalPermissionName', 'label' => 'Permission Name', 'rules' => 'required'],
      ['field' => 'modalDescription', 'label' => 'Description', 'rules' => 'required'],
    ];

    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == FALSE) {
      $validation_errors = $this->form_validation->error_array();
      $formatted_errors = $this->_format_validation_errors($rules, $validation_errors);
      $this->_send_json_response('error', 'Validation error', $formatted_errors);
    }

    try {
      // Start transaction
      $data = [
        'permission_name' => $post_data['modalPermissionName'],
        'description' => $post_data['modalDescription'],
        'created_by' => $this->_user_email,
        'created_at' => NOW
      ];
      $this->db->trans_start();

      $permission = $this->M_permissions->insert($data);

      if (!$permission) {
        trans_rollback();
        $this->_send_json_response('error', 'Permission not created');
      }

      // Commit transaction
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

  public function edit()
  {
    if ($post_data = $this->security->xss_clean($this->input->post())) {
      $info = $this->M_permissions->get($post_data['id']);
      if (empty($info)) {
        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
      }

      try {
        $rules = [
          ['field' => 'editPermissionName', 'label' => 'Permission Title', 'rules' => 'required'],
        ];

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
          $validation_errors = $this->form_validation->error_array();
          return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
        }

        // Validation passed, proceed with data insertion.
        $permission_name = isset($post_data['editPermissionName']) ? $post_data['editPermissionName'] : 0;


        // Check if the position already exists
        if ($info['permission_name'] !== $permission_name) {
          $is_existing = $this->M_permissions->get_by_permission($permission_name);
          if ($is_existing) {
            return $this->_send_json_response(FALSE, 'Permission already exists. Please try again with a different Unit name.');
          }
        }

        $permission_data = [
          'permission_name' => $permission_name,
        ] + $this->_update_additional;

        if (!$this->M_permissions->update($info['id'], $position_data)) {
          return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
        }

        return $this->_send_json_response(TRUE, 'Data updated successfully!');
      } catch (DatabaseException $e) {
        return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
      } catch (Exception $e) {
        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
      }
    }

    return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
  }


  public function delete()
  {
    if ($post_data = $this->security->xss_clean($this->input->post())) {
      $info = $this->M_permissions->get($post_data['id']);
      if (empty($info)) {
        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
      }

      try {
        if (!$this->M_permissions->delete($info['id'], $this->_delete_additional)) {
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
