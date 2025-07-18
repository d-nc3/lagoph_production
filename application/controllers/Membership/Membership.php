<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Membership extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();

      // User related data
      $this->load->model('Users_model', 'M_users');
      $this->load->model('User_logs_model', 'M_user_logs');
      $this->load->model('Billing_address_model', 'M_billing_address');

      // User documents related data
      $this->load->model('User_documents_model', 'M_documents');
      $this->load->model('User_referrals_model', 'M_referrals');

      //Member related data
      $this->load->model('Members_model', 'M_members');
      $this->load->model('Member_beneficiaries_model', 'M_beneficiaries');
      $this->load->model('Member_educ_backgrounds_model', 'M_educ_backgrounds');
      $this->load->model('Member_work_backgrounds_model', 'M_work_backgrounds');


      $this->load->model('Events_model', 'M_events');
      $this->load->model('Event_attendees_model', 'M_event_attendees');
      $this->load->model('Payment_options_model', 'M_payment_options');
      $this->load->model('Invoice_particulars_model', 'M_invoice_particular');
      $this->load->model('Payment_method_model', 'M_payment_methods');
      $this->load->model('Payment_records_model', 'M_payment_records');
      $this->load->model('Cashiering_invoice_model', 'M_cashiering_invoice');
      $this->load->model('Capital_contributions_model', 'M_capital_contributions');
      $this->load->helper('db_helper');
      //User session related data:

      $this->_user_id = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
      $this->_user_email = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;
      $this->_user_role = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
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

      $this->_log_additional = array(
         'user_id' => isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_EMAIL,
         'entity_name' => 'Employee',
         'ip_address' => $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']

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
         redirect('Landing');
      }
   }

   public function index()
   {

      $data['page_data'] = [
         'system_module' => 'Membership',
         'system_section' => '',
         'title' => 'Membership',
         'scripts_path' => [
            'assets/js/membership/on-hold.js',
         ]
      ] + $this->_notifications_data;

      $data['membership'] = $membership = $this->M_members->get_by_user($this->_user_id);



      if (empty($membership) || empty($membership['status'])) {
         $this->load->view('pages/membership/status/non-member', $data);
      } else if ($membership['status'] == 'Processing' || $membership['status'] == 'Pending Manager Approval') {

         $data['educ_backgrounds'] = $educ_backgrounds = $this->M_educ_backgrounds->list_by_member($membership['id']);
         $data['work_experience'] = $work_experience = $this->M_work_backgrounds->list_by_member($membership['id']);
         $data['referrals'] = $referrals = $this->M_referrals->get($this->_user_id) ?? NULL;
         $data['referral_member'] = get_by_code_and_table($this->_user_id, 'id', 'users');
         $data['documents'] = $documents = $this->M_documents->list_by_user($this->_user_id);
         $this->load->view('pages/membership/status/processing', $data);
      } else if ($membership['status'] == 'On Hold' || $membership['status'] == 'Rejected by Manager') {
         $this->load->view('pages/membership/status/rejected', $data);
      } else {
         show_404();
      }
   }


   public function get_events()
   {
      $info = $this->M_events->get_events();
      if (empty($info)) {
         return $this->_send_json_response(FALSE, 'An error occurred. Please try again later OO1X.');
      }

      exit(json_encode($info));
   }




   public function schedules()
   {

      $data['page_data'] = [
         'system_module' => 'Membership',
         'system_section' => '',
         'title' => 'Membership',
         'styles_path' => [
            'assets/vendor/libs/fullcalendar/fullcalendar.css',
            'assets/vendor/libs/select2/select2.css',
            'assets/vendor/libs/flatpickr/flatpickr.css',
            'assets/vendor/css/pages/app-calendar.css',
         ],
         'scripts_path' => [
            'assets/vendor/libs/fullcalendar/fullcalendar.js',
            'assets/vendor/libs/moment/moment.js',
            'assets/vendor/libs/flatpickr/flatpickr.js',
            'assets/js/membership/schedules/app-calendar-events.js',
            'assets/js/membership/app-calendar-member.js',

         ]
      ] + $this->_notifications_data;

      $data['events'] = $this->M_events->get_all();
      $data['booked_event'] = $this->M_event_attendees->get_event_details($this->_user_id);
      $this->load->view('pages/membership/schedules', $data);
   }

   public function event_scheduling()
   {
      $data['page_data'] = [
         'system_module' => 'Schedules',
         'system_section' => '',
         'title' => 'Schedules',

         'styles_path' => [
            'assets/vendor/libs/fullcalendar/fullcalendar.css',
            'assets/vendor/libs/flatpickr/flatpickr.css',
            'assets/vendor/css/pages/app-calendar.css',
         ],
         'scripts_path' => [
            'assets/vendor/libs/fullcalendar/fullcalendar.js',
            'assets/vendor/libs/moment/moment.js',
            'assets/vendor/libs/flatpickr/flatpickr.js',
            'assets/js/membership/schedules/app-calendar-events.js',
            'assets/js/membership/schedules/app-calendar.js',
         ]
      ] + $this->_notifications_data;


      $data['info'] = $this->M_users->get($this->_user_id);
      $this->load->view('pages/membership/member_officer/schedules', $data);
   }



   public function book_event()
   {
      try {
         if ($post_data = $this->security->xss_clean($this->input->post())) {
            $rules = [

               ['field' => 'event_date', 'label' => 'Event date', 'rules' => 'required'],

            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == FALSE) {
               $validation_errors = $this->form_validation->error_array();
               return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
            }

            // Start transaction
            $this->db->trans_begin();

            $booking_details = [
               'event_id' => $post_data['event_date'],
               'user_id' => $this->_user_id,
               'response_status' => 'accepted' // !-- TO DO AND FOR OPTIMIZATIONS
            ] + $this->_create_additional;


            $book = $this->M_event_attendees->insert($booking_details);
            if (!$book) {
               $this->db->trans_rollback();
               $this->_send_json_response(FALSE, 'Your request failed to process at this time, please try again later');
            }
         }
         // Commit transaction if everything is successful
         $this->db->trans_commit();
         return $this->_send_json_response(TRUE, 'Event successfully booked!'); // Provide success message here

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

   public function add_event()
   {
      try {
         if ($post_data = $this->security->xss_clean($this->input->post())) {

            $rules = [
               ['field' => 'calendar_id', 'label' => 'Calendar', 'rules' => 'required'],
               ['field' => 'creator_id', 'label' => 'Creator', 'rules' => 'required'],
               ['field' => 'title', 'label' => 'Title', 'rules' => 'required'],
               ['field' => 'description', 'label' => 'Description', 'rules' => 'required'],
               ['field' => 'location', 'label' => 'Location', 'rules' => 'required'],
               ['field' => 'video_link', 'label' => 'Video Link', 'rules' => 'required'],
               ['field' => 'start_datetime', 'label' => 'Start Date & Time', 'rules' => 'required'],
               ['field' => 'end_datetime', 'label' => 'End Date & Time', 'rules' => 'required'],
               ['field' => 'status', 'label' => 'Status', 'rules' => 'required']
            ];

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() == FALSE) {
               $validation_errors = $this->form_validation->error_array();
               return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
            }

            // Start transaction
            $this->db->trans_begin();

            $event_details = [
               'calendar_id' => $post_data['calendar_id'],
               'creator_id' => $post_data['creator_id'], // corrected 'user_id' to 'creator_id'
               'title' => $post_data['title'],
               'description' => $post_data['description'], // corrected 'post_datap'
               'location' => $post_data['location'],
               'video_link' => $post_data['video_link'],
               'start_datetime' => $post_data['start_datetime'],
               'end_datetime' => $post_data['end_datetime'],
               'status' => $post_data['status']
            ] + $this->_create_additional;

            // Insert the event details into the database
            $event_id = $this->M_events->insert($event_details);

            if (!$event_id) {
               // Rollback if insert fails
               $this->db->trans_rollback();
               return $this->_send_json_response(FALSE, 'There was an error while submitting your request. Please try again later.');
            }

            // Commit transaction if everything is successful
            $this->db->trans_commit();
            return $this->_send_json_response(TRUE, 'Event successfully created!'); // Provide success message here
         }
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



   public function generateInvoiceNumber()
   {
      $prefix = "INV-";
      $date = date("YmdHis");
      $randomNumber = mt_rand(1000, 9999);
      $referenceNumber = $prefix . $date . $randomNumber;
      return $referenceNumber;
   }


   public function Personal_information()
   {
      $member = $this->M_members->get_by_user($this->_user_id);

      $post_data = $this->security->xss_clean($this->input->post());
      if (!$post_data)
         return;

      try {
         $rules = [
            ['field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|required'],
            ['field' => 'last_name', 'label' => 'Surname', 'rules' => 'trim|required'],
            ['field' => 'sex', 'label' => 'Sex', 'rules' => 'required'],
            ['field' => 'date_of_birth', 'label' => 'Date of Birth', 'rules' => 'required'],
            ['field' => 'civil_status', 'label' => 'Civil Status', 'rules' => 'required'],
            ['field' => 'place_of_birth', 'label' => 'Place Of Birth', 'rules' => 'trim|required'],
            ['field' => 'mobile_number', 'label' => 'Mobile Number', 'rules' => 'trim|required|min_length[12]|max_length[12]'],
         ];

         $this->form_validation->set_rules($rules);
         if ($this->form_validation->run() == FALSE) {
            $validation_errors = $this->form_validation->error_array();
            return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
         }

         $this->db->trans_begin();

         $reference_number = $this->_generate_reference_number($this->_user_id);
         $member_data = [
            'user_id' => $this->_user_id,
            'reference_number' => $reference_number,
            'last_name' => strtoupper(trim($post_data['last_name'])),
            'first_name' => strtoupper(trim($post_data['first_name'])),
            'middle_name' => !empty($post_data['middle_name']) ? strtoupper(trim($post_data['middle_name'])) : '',
            'sex' => $post_data['sex'],
            'civil_status' => $post_data['civil_status'],
            'date_of_birth' => $post_data['date_of_birth'],
            'place_of_birth' => $post_data['place_of_birth'],
            'address' => strtoupper(trim($post_data['address'] ?? '')),
            'status' => '',
            'mobile_number' => $post_data['mobile_number'],
            'tel_number' => $post_data['tel_number'] ?? '',
            'email' => $post_data['email'] ?? '',
            'spouse_name' => !empty($post_data['spouse_name']) ? strtoupper(trim($post_data['spouse_name'])) : '',
            'spouse_occupation' => !empty($post_data['spouse_occupation']) ? strtoupper(trim($post_data['spouse_occupation'])) : '',
            'spouse_mobile_number' => $post_data['spouse_mobile_number'] ?? '',
         ] + $this->_create_additional;

         if (!$member) {
            $member_id = $this->M_members->insert($member_data);
         } else {
            $member_id = $this->M_members->update($member['id'], $member_data);
         }

         if (!$member_id) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
         }

         $this->db->trans_commit();
         return $this->_send_json_response(TRUE, 'Personal Details Successfully Submitted');
      } catch (DatabaseException $e) {
         $this->db->trans_rollback();
         return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
      } catch (Exception $e) {
         $this->db->trans_rollback();
         return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
      }
   }

   public function beneficiaries()
   {
      try {
         $member = $this->M_members->get_by_user($this->_user_id);

         if (!$member) {
            return $this->_send_json_response(FALSE, 'Member not found.');
         }

         $beneficiaries = $this->input->post('beneficiaries');

         if (empty($beneficiaries)) {
            return $this->_send_json_response(TRUE, 'No beneficiary data provided. Skipping.');
         }

         $this->db->trans_begin();

         foreach ($beneficiaries as $beneficiary) {
            $id = isset($beneficiary['id']) ? (int) $beneficiary['id'] : null;
            $name = trim($this->security->xss_clean($beneficiary['name']));
            $dob = trim($this->security->xss_clean($beneficiary['date_of_birth']));
            $relationship = trim($this->security->xss_clean($beneficiary['relationship_type']));

            if (!$name || !$dob || !$relationship) {
               $this->db->trans_rollback();
               return $this->_send_json_response(FALSE, 'Please complete all beneficiary fields.');
            }

            $data = [
               'member_id' => $member['id'],
               'name' => $name,
               'date_of_birth' => $dob,
               'relationship_type' => $relationship,
            ] + $this->_create_additional;


            $existing = $this->M_beneficiaries->get($id);


            if ($existing) {
               // Update beneficiary
               if (!$this->M_beneficiaries->update($id, $data)) {
                  $this->db->trans_rollback();
                  return $this->_send_json_response(FALSE, 'Failed to update beneficiary ID: ' . $id);
               }
            } elseif ($id === null || !$existing) {

               if (!$this->M_beneficiaries->insert($data)) {
                  $this->db->trans_rollback();
                  return $this->_send_json_response(FALSE, 'Failed to insert new beneficiary.');
               }
            } else {
               // $id provided but no matching beneficiary for this member
               $this->db->trans_rollback();
               return $this->_send_json_response(FALSE, 'Invalid beneficiary ownership.');
            }
         }
         $this->db->trans_commit();
         return $this->_send_json_response(TRUE, 'Beneficiaries saved successfully.');
      } catch (Exception $e) {
         $this->db->trans_rollback();
         return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
      }
   }



   public function educational_background()
   {
      try {
         $member = $this->M_members->get_by_user($this->_user_id);
         $member_id = $member['id'] ?? null;

         if (!$member_id) {
            return $this->_send_json_response(FALSE, 'Invalid member.');
         }

         $educ_backgrounds = $this->input->post('educ_background');

         if (empty($educ_backgrounds)) {
            return $this->_send_json_response(FALSE, 'Educational background tab is empty');
         }

         $this->db->trans_begin();

         foreach ($educ_backgrounds as $educ_background) {
            $id = $this->security->xss_clean($educ_background['id'] ?? '');
            $level = $this->security->xss_clean($educ_background['level'] ?? '');
            $course = $this->security->xss_clean($educ_background['education_course'] ?? '');
            $school = $this->security->xss_clean($educ_background['school_institution'] ?? '');


            if (empty($level) || empty($course) || empty($school)) {
               continue; // skip incomplete entries
            }

            $educ_background_data = [
               'member_id' => $member_id,
               'level' => $level,
               'education_course' => $course,
               'school_institution' => $school,
            ] + $this->_create_additional;

            $existing_rows = $this->M_educ_backgrounds->get_educ_level($member_id, $level);

            if ($existing_rows) {
               foreach ($existing_rows as $row) {

                  $updatedData = $this->M_educ_backgrounds->update($row['id'], $educ_background_data);


                  if (!$updatedData) {
                     $this->db->trans_rollback();
                     return $this->_send_json_response(FALSE, 'A database error occurred while updating.');
                  }

               }
            } else {
               if (!$this->M_educ_backgrounds->insert($educ_background_data)) {
                  $this->db->trans_rollback();
                  return $this->_send_json_response(FALSE, 'A database error occurred while inserting.');
               }
            }
         }

         $this->db->trans_commit();
         return $this->_send_json_response(TRUE, 'Educational background successfully submitted');
      } catch (DatabaseException $e) {
         $this->db->trans_rollback();
         return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
      } catch (Exception $e) {
         $this->db->trans_rollback();
         return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
      }
   }


   public function work_experience()
   {
      try {
         $member = $this->M_members->get_by_user($this->_user_id);
         $work_backgrounds = $this->input->post('work_experience');

         if (empty($work_backgrounds)) {
            return $this->_send_json_response(FALSE, 'Work experience tab is empty');
         }

         foreach ($work_backgrounds as $work_background) {
            $work_background_employment_status = $this->security->xss_clean($work_background['employment_status']);
            $work_background_office_company = $this->security->xss_clean($work_background['office_company']);
            $work_background_occupation_designation = $this->security->xss_clean($work_background['occupation_designation']);
            $work_background_salary_income = $this->security->xss_clean($work_background['salary_income']);
            $work_background_tel_number = $this->security->xss_clean($work_background['tel_number']);
            $work_background_address = $this->security->xss_clean($work_background['address']);


            if ($work_background_employment_status && $work_background_office_company && $work_background_occupation_designation) {
               $work_background_data = [
                  'member_id' => $member['id'],
                  'employment_status' => $work_background_employment_status,
                  'occupation' => $work_background_occupation_designation,
                  'office' => $work_background_office_company,
                  'address' => $work_background_address,
                  'income' => $work_background_salary_income,
                  'tel_no' => $work_background_tel_number,

               ] + $this->_create_additional;

               $existing = $this->M_work_backgrounds->list_by_member($member['id']);
               $target_record = null;

               foreach ($existing as $record) {
                  if ($record['employment_status'] === $work_background_employment_status) {
                     $target_record = $record;
                     break;
                  }
               }

               if ($target_record) {
                  // Update the specific work background by its ID
                  $this->M_work_backgrounds->update($target_record['id'], $work_background_data);
               } else {
                  // Fallback: insert if type not found
                  $this->M_work_backgrounds->insert($work_background_data);
               }
            }
         }

         $this->db->trans_commit();
         return $this->_send_json_response(TRUE, 'Work background Successfully Submitted');

      } catch (DatabaseException $e) {
         $this->db->trans_rollback();
         return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
      } catch (Exception $e) {
         $this->db->trans_rollback();
         return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
      }
   }

   public function administrative_offense()
   {
      if ($post_data = $this->security->xss_clean($this->input->post())) {
         try {
            $rules = [

               ['field' => 'has_admin_offense', 'label' => 'Have you ever been found guilty of any administrative offense?', 'rules' => 'required|callback__check_admin_offense'],
               ['field' => 'admin_offense', 'label' => 'Please provide details of administrative offense.', 'rules' => 'trim'],
               ['field' => 'is_convicted', 'label' => 'Have you ever been charged or convicted of any crime by any court or tribunal?', 'rules' => 'required|callback__check_convicted'],
               ['field' => 'convicted', 'label' => 'Please provide details of your conviction.', 'rules' => 'trim'],

            ];

            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
               $validation_errors = $this->form_validation->error_array();
               return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));
            }

            $this->db->trans_begin();

            $member_data = [
               'has_admin_offense' => $post_data['has_admin_offense'],
               'admin_offense' => $post_data['admin_offense'],
               'is_convicted' => $post_data['is_convicted'],
               'convicted' => $post_data['convicted'],
            ] + $this->_update_additional;

            $member_id = $this->M_members->get_by_user($this->_user_id);

            $update_member_info = $this->M_members->update($member_id['id'], $member_data);

            if (!$update_member_info) {
               $this->trans_rollback;
               $this->_send_json_response(FALSE, 'An error occured please try again');
            }

            $this->db->trans_commit();
            $this->_send_json_response(TRUE, 'Data Saved Successfully.');
         } catch (DatabaseException $e) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
         } catch (Exception $e) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
         }
      }
   }

   public function update_attachments_inline()
   {
      if ($post_data = $this->security->xss_clean($this->input->post())) {
         $membership = $this->M_members->get_by_user($this->_user_id);
         $upload_path = './uploads/' . $membership['reference_number'] . '/';

         if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
         }

         $required_documents = [
            'proof_of_identity' => ['label' => 'Proof of Identity', 'allowed_extensions' => ['jpg', 'jpeg'], 'allowed_mime_types' => ['image/jpeg', 'image/jpg']],
            'proof_of_dob' => ['label' => 'Proof of Date of Birth', 'allowed_extensions' => ['jpg', 'jpeg', 'pdf'], 'allowed_mime_types' => ['application/pdf', 'image/jpeg', 'image/jpg']],
            'proof_of_addr' => ['label' => 'Proof of Address', 'allowed_extensions' => ['jpg', 'jpeg', 'pdf'], 'allowed_mime_types' => ['application/pdf', 'image/jpeg', 'image/jpg']],
            'profile_pic' => ['label' => '2x2 ID Picture', 'allowed_extensions' => ['jpg', 'jpeg'], 'allowed_mime_types' => ['image/jpeg', 'image/jpg']],
         ];

         foreach ($required_documents as $key => $value) {
            if (empty($_FILES['attachments']['name'][$key])) {
               return ['success' => false, 'message' => $value['label'] . ' field is required.'];
            }

            $file_extension = pathinfo($_FILES['attachments']['name'][$key], PATHINFO_EXTENSION);
            if (!in_array($file_extension, $value['allowed_extensions'])) {
               return ['success' => false, 'message' => 'Error uploading file on ' . $value['label'] . '. Allowed types: ' . implode(', ', $value['allowed_extensions'])];
            }

            $file_mime = mime_content_type($_FILES['attachments']['tmp_name'][$key]);
            if (!in_array($file_mime, $value['allowed_mime_types'])) {
               return ['success' => false, 'message' => 'Invalid file type for ' . $value['label']];
            }

            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = implode('|', $value['allowed_extensions']);
            $config['file_name'] = uniqid();
            $this->upload->initialize($config);

            $_FILES['file']['name'] = $_FILES['attachments']['name'][$key];
            $_FILES['file']['type'] = $_FILES['attachments']['type'][$key];
            $_FILES['file']['tmp_name'] = $_FILES['attachments']['tmp_name'][$key];
            $_FILES['file']['error'] = $_FILES['attachments']['error'][$key];
            $_FILES['file']['size'] = $_FILES['attachments']['size'][$key];

            if ($this->upload->do_upload('file')) {
               $upload_data = $this->upload->data();
               $file_type = pathinfo($upload_data['file_name'], PATHINFO_EXTENSION);

               $documents_data = [
                  'user_id' => $this->_user_id,
                  'document_type' => $value['label'],
                  'doc_name' => $upload_data['file_name'],
                  'doc_path' => $upload_path . $upload_data['file_name'],
                  'doc_size' => $upload_data['file_size'],
                  'doc_type' => $file_type,
               ] + $this->_create_additional;

               if (!$this->M_documents->insert($documents_data)) {
                  return ['success' => false, 'message' => 'A database error occurred. Please try again later.'];
               }
            } else {
               return ['success' => false, 'message' => $this->upload->display_errors()];
            }
         }

         return ['success' => true];
      }

      return ['success' => false, 'message' => 'Invalid form data.'];
   }


   public function form()
   {
      $membership = $this->M_members->get_by_user($this->_user_id);

      if (!empty($membership) && isset($membership['status']) && $membership['status'] === "Processing") {
         show_404();
      }

      $data['page_data'] = [
         'system_module' => 'Membership',
         'system_section' => '',
         'title' => 'Membership',
         'styles_path' => [
            'assets/vendor/libs/bs-stepper/bs-stepper.css',
            'assets/vendor/libs/select2/select2.css',
            'assets/vendor/libs/tagify/tagify.css',
            'assets/vendor/libs/flatpickr/flatpickr.css'
         ],
         'scripts_path' => [
            'assets/vendor/libs/cleavejs/cleave.js',
            'assets/vendor/libs/tagify/tagify.js',
            'assets /vendor/libs/flatpickr/flatpickr.js',
            'assets/vendor/libs/cleavejs/cleave-phone.js',
            'assets/js/membership/form-functions.js',
            'assets/vendor/libs/moment/moment.js',
            'assets/vendor/libs/jquery-repeater/jquery-repeater.js',
            'assets/js/membership/form-copy-1.js',
            'assets/js/membership/contribution-calculator.js'
         ]
      ] + $this->_notifications_data;

      $data['payment_method'] = $this->M_payment_methods->get_all() ?? NULL;
      $data['invoice_details_membership'] = $this->M_invoice_particular->get_by_user_invoice_category($this->_user_id, 1) ?? NULL;
      $data['invoice_details_contribution'] = $this->M_invoice_particular->get_by_user_invoice_category($this->_user_id, 5) ?? NULL;
      $member_id = isset($membership['id']) ? $membership['id'] : null;
      $data['beneficiaries'] = $member_id ? $this->M_beneficiaries->list_by_member($member_id) : [];
      $data['educ_background'] = $member_id ? $this->M_educ_backgrounds->list_by_member($member_id) : [];
      $data['work_experience'] = $member_id ? $this->M_work_backgrounds->list_by_member($member_id) : [];

      if ($post_data = $this->security->xss_clean($this->input->post())) {
         $this->db->trans_begin();

         $attachment_response = $this->update_attachments_inline();
         if (!$attachment_response['success']) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, $attachment_response['message']);
         }
         try {

            $payment = $this->upload_receipt($post_data);

            if (!$payment) {
               return $this->_send_json_response(FALSE, 'Payment cannot be processed at this time');
            }

            $member_data = [
               'status' => 'Processing'
            ] + $this->_update_additional;

            $member_id = $this->M_members->update($membership['id'], $member_data);

            if (!$member_id) {
               $this->db->trans_rollback();
               return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            }

            if (!empty($admins)) {
               foreach ($admins as $admin) {

                  $notification_data = [
                     'user_id' => $admin['user_id'],
                     'notification_title' => 'New Information sheet received',
                     'message' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' submitted a membership information sheet form',
                     'link' => ''
                  ] + $this->_create_additional;

                  $notification_result = notify_user($notification_data);
               }
            }

            $referral_data = [
               'from_user_id' => $this->_user_id,
               'code' => $this->uuid->v4(),
            ] + $this->_create_additional;


            if (!$this->M_referrals->insert($referral_data)) {
               $this->db->trans_rollback();
               return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            }

            $this->db->trans_commit();
            return $this->_send_json_response(TRUE, 'Membership application successfully submitted!');
         } catch (DatabaseException $e) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
         } catch (Exception $e) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
         }
      }

      $data['membership'] = $this->M_members->get_by_user($this->_user_id);
      $this->load->view('pages/membership/form', $data);
   }

   public function comply()
   {
      if ($post_data = $this->security->xss_clean($this->input->post())) {
         try {
            $member_id = $post_data['member_id'];
            $this->db->trans_begin();

            // Attempt to update the member's status to 'Processing'
            $updated = $this->M_members->update($member_id, ['status' => 'Processing'] + $this->_update_additional);

            if (!$updated) {
               $this->db->trans_rollback();
               return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
            }

            // Get all admins with role_id = 15
            $admins = get_by_code_and_table('15', 'role_id', 'user_roles');

            if (!empty($admins)) {
               foreach ($admins as $admin) {
                  $notification_data = [
                     'user_id' => $admin['user_id'],
                     'notification_title' => 'Information sheet follow up compliance',
                     'message' => $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' submitted a membership information sheet form.',
                     'link' => ''
                  ] + $this->_create_additional;

                  notify_user($notification_data); // Assuming this function exists and handles failures internally
               }
            }

            $this->db->trans_commit();
            return $this->_send_json_response(TRUE, '🎉 Submission Successful!');
         } catch (DatabaseException $e) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
         } catch (Exception $e) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, 'An error occurred. Please try again later.');
         }
      }
   }


   public function _generate_reference_number($user_id)
   {
      // Get the current timestamp
      $timestamp = date('Y-m');

      // Format the user ID with leading zeros to be 9 digits long
      $formatted_user_id = sprintf('%09d', $user_id);

      // Combine member ID, timestamp, and random string to create the reference number
      $reference_number = 'M-' . $timestamp . '-' . $formatted_user_id;

      return $reference_number;
   }

   public function _check_admin_offense($value)
   {
      if ($value === 'Yes' && empty($this->input->post('admin_offense'))) {
         $this->form_validation->set_message('check_admin_offense', 'The {field} field is required when you have an administrative offense.');
         return FALSE;
      }
      return TRUE;
   }

   public function _check_convicted($value)
   {
      if ($value === 'Yes' && empty($this->input->post('convicted'))) {
         $this->form_validation->set_message('check_convicted', 'The {field} field is required when you have been convicted.');
         return FALSE;
      }
      return TRUE;
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

   public function upload_receipt($post_data)
   {
      // Document configurations for membership and contribution receipts
      $documents = [
         'membership_receipt' => [
            'label' => 'Membership receipt',
            'allowed_extensions' => ['jpg', 'jpeg'],
            'allowed_mime_types' => ['image/jpeg', 'image/jpg']
         ],
         'contribution-receipt' => [
            'label' => 'Contribution receipt',
            'allowed_extensions' => ['jpg', 'jpeg'],
            'allowed_mime_types' => ['image/jpeg', 'image/jpg']
         ],
      ];
      // Start the transaction
      $this->db->trans_begin();

      // Loop through the documents (membership and contribution)
      foreach ($documents as $key => $value) {
         // Check if the respective receipt is uploaded
         if (empty($_FILES['attachments']['name'][$key])) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, $value['label'] . ' field is required.');
         }

         $file_extension = pathinfo($_FILES['attachments']['name'][$key], PATHINFO_EXTENSION);
         if (!in_array($file_extension, $value['allowed_extensions'])) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, 'Error uploading file on ' . $value['label'] . '. Please select only ' . implode(', ', $value['allowed_extensions']) . ' files.');
         }

         $file_mime = mime_content_type($_FILES['attachments']['tmp_name'][$key]);
         if (!in_array($file_mime, $value['allowed_mime_types'])) {
            $this->db->trans_rollback();
            return $this->_send_json_response(FALSE, 'Error uploading file on ' . $value['label'] . '. Please select only ' . implode(', ', $value['allowed_mime_types']) . ' files.');
         }

         // this code is to insert the invoice in the db
         $billing_address = $this->M_billing_address->get($this->_user_id);
         $refNumber = $this->generateInvoiceNumber();

         $transaction_category_id = ($key === 'membership_receipt') ? 1 : 5;

         if ($key === 'contribution-receipt') {
            $capital_contributions = [
               'user_id' => $this->_user_id,
               'subscribed_amount' => $post_data['subscribed_amount'],
               'amount_per_share' => $post_data['share_amount'],
               'number_of_shares' => $post_data['share_frequency'],
               'amount' => $post_data['contribution_amount'],
               'detail' => 'Initial Capital Contribution, First Payment',
               'status' => 'pending',
               'date_issued' => date('Y-m-d H:i:s'),
               'date_paid' => date('Y-m-d H:i:s'),
               'created_by' => 'system',
               'updated_by' => 'system'
            ];

            $contribution = $this->M_capital_contributions->insert($capital_contributions);

            if (!$contribution) {
               return $this->_send_json_response(FALSE, 'An error occured please try again');
            }
         }

         $_membership_invoice = [
            'user_id' => $this->_user_id,
            'invoice_number' => $refNumber,
            'billing_address_id' => $billing_address['id'],
            'transaction_category_id' => $transaction_category_id,
            'amount' => ($key == 'membership_receipt') ? $post_data['m_payment_amount'] : $post_data['c_payment_amount'],
            'date_issued' => date('Y-m-d'),
            'date_due' => NULL,
            'created_by' => 'system',
            'updated_by' => 'system',
            'status' => 'payment-initiated',
         ];



         $invoice_id = $this->M_cashiering_invoice->insert($_membership_invoice);

         if (!$invoice_id) {
            return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
         }

         $user_info = $this->M_users->get($this->_user_id); // Assuming you have a model to get user info

         if (!$this->sendEmail($post_data, $user_info, $key)) {
           $this->send_json_response(FALSE, 'Email sending failed for ' . $key);
         }

         $_invoice_particular = [
            'cashiering_invoice_id' => $invoice_id,
            'item_id' => 1,
            'quantity' => 1,
            'unit_cost' => ($key == 'membership_receipt') ? $post_data['m_payment_amount'] : $post_data['c_payment_amount'],
            'total_cost' => ($key == 'membership_receipt') ? $post_data['m_payment_amount'] : $post_data['c_payment_amount'],
         ] + $this->_create_additional;


         $invoice_particular_id = $this->M_invoice_particular->insert($_invoice_particular);
         if (!$invoice_particular_id) {
            return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');
         }



         $upload_path = 'uploads/proof_of_payment/' . $this->_user_id . '/' . $refNumber . '/';
         if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
         }
         // Set the upload configuration
         $config['upload_path'] = $upload_path; // Define your path here
         $allowed_types = implode('|', $value['allowed_extensions']);
         $config['allowed_types'] = $allowed_types;
         $config['file_name'] = uniqid(); // Unique file name

         // Initialize the upload library
         $this->upload->initialize($config);

         // Set the file information
         $_FILES['file']['name'] = $_FILES['attachments']['name'][$key];
         $_FILES['file']['type'] = $_FILES['attachments']['type'][$key];
         $_FILES['file']['tmp_name'] = $_FILES['attachments']['tmp_name'][$key];
         $_FILES['file']['error'] = $_FILES['attachments']['error'][$key];
         $_FILES['file']['size'] = $_FILES['attachments']['size'][$key];

         // Perform the file upload
         if ($this->upload->do_upload('file')) {
            // Get the uploaded file data
            $upload_data = $this->upload->data();
            $file_type = pathinfo($upload_data['file_name'], PATHINFO_EXTENSION);

            // Prepare data for payment insertion based on the uploaded document
            $paymentData = [
               'payment_date' => date('Y-m-d H:i:s'),
               'payment_method_id' => ($key == 'membership_receipt') ? $post_data['m_payment_method'] : $post_data['c_payment_method'],
               'transaction_category_id' => $transaction_category_id, // Adjust according to your logic
               'invoice_particulars_id' => $invoice_particular_id,
               'reference_number' => ($key == 'membership_receipt') ? $post_data['m_reference_number'] : $post_data['c_reference_number'],
               'total_payment' => ($key == 'membership_receipt') ? $post_data['m_payment_amount'] : $post_data['c_payment_amount'],
               'payment_proof' => $upload_path . $upload_data['file_name'],
               'status' => 'pending',
            ] + $this->_create_additional; // Include any additional data here

            // Update invoice status for both membership and contribution


            if (!$this->M_payment_records->insert($paymentData)) {
               $this->db->trans_rollback();
               log_message('error', 'Failed to insert payment data.');
               return $this->_send_json_response(FALSE, 'Database error.');
            }
         } else {
            $this->db->trans_rollback();
            $error = $this->upload->display_errors();
            return $this->_send_json_response(FALSE, $error);
         }
      }
      $this->db->trans_commit();
      return true;
   }

   private function sendEmail($post_data, $userId, $key)
   {

      $data = [
         'name' => $userId['first_name'] . ' ' . $userId['last_name'],
         'payment_date' => date('Y-m-d H:i:s'),
         'transaction_category_id' => $key, // Adjust according to your logic
         'reference_number' => ($key == 'membership_receipt') ? $post_data['m_reference_number'] : $post_data['c_reference_number'],
         'total_payment' => ($key == 'membership_receipt') ? $post_data['m_payment_amount'] : $post_data['c_payment_amount'],
      ];


      $message = $this->load->view('pages/invoice/partials/invoice-email-template', $data, TRUE);

      $this->email->from('admin@lagoph.co', 'Lagoph Co. Cashier');
      $this->email->to($userId['email']);
      $this->email->subject('LagoPh Co. Membership Application Payment Confirmation');
      $this->email->message($message);

      // Send the email
      if ($this->email->send()) {
         return TRUE;
      } else {
         return FALSE;
      }
   }

}
