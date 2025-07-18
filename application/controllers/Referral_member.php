<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Referral_member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('qr_code_helper');
        
        $this->load->model('User_referrals_model', 'M_referrals');
        $this->load->model('Billing_address_model', 'M_billing_address');

        $this->_create_additional = array(
            'created_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
            'created_at' => NOW
        );

        $this->_update_additional = array(
            'updated_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
            'updated_at' => NOW
        );

        $this->_delete_additional = array(
            'deleted_by' => isset($_SESSION['user_info']) ? $this->session->userdata('user_info')['email'] : DEFAULT_ADMIN_USER_EMAIL,
            'deleted_at' => NOW
        );

        $this->_notifications_data = array(
            'notifications' => get_top_notifications($_SESSION['user_id']),
            'unread_count' => get_unread_count($_SESSION['user_id']),
            'new_count' => get_new_count($_SESSION['user_id'])
        );

        $this->_user_id  = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
        $this->_user_email  = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;
        $this->_user_role  = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
        $this->_first_name  = isset($_SESSION['first_name']) ? $this->session->userdata('first_name') : DEFAULT_ADMIN_USER_ROLE;
        $this->_last_name  = isset($_SESSION['last_name']) ? $this->session->userdata('last_name') : DEFAULT_ADMIN_USER_ROLE;
    }

    public function index($ref = null)
    {

        // store the page data to an array, to be sent to the views
        $data['page_data'] = [
            'system_module' => 'Referrals',
            'system_section' => '',
            'title' => 'Referrals',
            'styles_path' => [
                'assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
                'assets/vendor/libs/typeahead-js/typeahead.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css'
            ],

            'scripts_path' => [
                'assets/vendor/libs/moment/moment.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/libs/@form-validation/popular.js',
                'assets/vendor/libs/@form-validation/bootstrap5.js',
                'assets/js/referral/index.js'
            ]

        ] + $this->_notifications_data;

        // load the view and include the page datas on each view
        $data['referral'] = $this->M_referrals->get_code($this->_user_id);
        return $this->load->view('pages/referral/member-index', $data);
    }


    public function get_referral_code($id = NULL)
    {
        if ($post_data = $this->security->xss_clean($this->input->post())) {
            $referral = $this->M_referrals->get_code($id);

            if (empty($referral)) {
                return $this->_send_json_response(FALSE, 'The data is not loading properly');
            }
            exit(json_encode($$referral));
        }
        return $this->_send_json_response(FALSE, 'Database Error please contact your database administrator');
    }


      public function dt_list_users()
    {
        $search = $this->security->xss_clean($this->input->post('search'));
        $order = $this->security->xss_clean($this->input->post('order'));
        $start = $this->security->xss_clean($this->input->post('start'));
        $length = $this->security->xss_clean($this->input->post('length'));
        $user_id = $this->_user_id;

        $filters['search'] = $search['value'];


        if (isset($user_id) && $user_id) {
            $filters['user_id'] = $user_id;
        }
        $list = $this->M_referrals->get_all_filtered($filters, $order, $start, $length);

        $data = array();
        $no = $start;

        foreach ($list as $referral) {
            $no++;
            $row = array();
            $row['id'] = $referral->id;
            $row['from_user_id'] = $referral->from_user_id;
            $row['to_user_id'] = $referral->to_user_id;
            $row['first_name'] = $referral->first_name;
            $row['last_name'] = $referral->last_name;
            $row['email'] = $referral->email;
            $row['status'] = $referral->status;
            $row['code'] = $referral->code;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->M_referrals->count_all(),
            "recordsFiltered" => $this->M_referrals->count_filtered(),
            "data" => $data,

        );
        echo json_encode($output);
    }

    public function generate() {
       
        $data = $this->input->get('data');
        
     
        if (empty($data)) {
            $data = 'Default QR Code Content'; 
        }
    
      
        $qrCode = new \Endroid\QrCode\QrCode($data);
        $qrCode->setSize(300); 
        $qrCode->setMargin(10); 
    
       
        $writer = new \Endroid\QrCode\Writer\PngWriter();
        $qrCodeImage = $writer->write($qrCode); 
   
        echo base64_encode($qrCodeImage->getString()); 
     
    }
    
    public function view() {

        $data['page_data'] = [

            'scripts_path' => [
                'assets/vendor/libs/moment/moment.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
                'assets/vendor/jquery-3.6.0.min.js',
                'assets/vendor/libs/@form-validation/popular.js',
                'assets/vendor/libs/@form-validation/bootstrap5.js',
                'assets/js/referral/index.js'
            ]

        ] + $this->_notifications_data;

        $this->load->view('pages/referral/qr_code_view',$data);
    }
    


    public function generate_link() {
        $data = [
            'from_user_id' => $this->_user_id,
            'code' => $this->uuid->v4(),  // This generates the referral code
        ] + $this->_create_additional;
        
        // Save the data into the database
        if ($this->M_referrals->insert($data)) {
            // Return the generated referral code in the response
            exit(json_encode([
                'status' => TRUE,
                'message' => 'Successfully generated referral code.',
                'referral_code' => $data['code']  // Return the actual referral code
            ]));
        } else {
            exit(json_encode([
                'status' => FALSE,
                'message' => 'Something went wrong! Please try again',
                'referral_code' => $data  // Optionally return the attempted data
            ]));
        }
    }
    
}