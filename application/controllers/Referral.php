<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_referrals_model', 'M_referrals');

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
    }

    public function index($ref = null)
    {
        if ($get_data = $this->security->xss_clean($this->input->get())) {
            if(!$get_data['ref']) {
                show_404();
                exit;
            }

            // check if referral code is existing and is not used
            $is_existing = $this->M_referrals->get_by_code($get_data['ref']);
            if (!$is_existing) {
                show_404();
                exit;
            }

            // store the page data to an array, to be sent to the views
            $data['page_data'] = [
                'system_module' => '',
                'system_section' => '',
                'title' => 'Register',
                'styles_path' => [
                    'assets/vendor/libs/bs-stepper/bs-stepper.css',
                    'assets/vendor/css/pages/page-auth.css'
                ],
                'scripts_path' => [
                    'assets/js/register/index.js'
                ]
            ];
            
            $data['referral_code'] = $get_data['ref'];
            // load the view and include the page datas on each view
            return $this->load->view('pages/register/index', $data);
        } else {
            show_404();
            exit;
        }
    }

    // public function generate() {
    //     $data = [
    //         'from_user_id' => $this->session->userdata('user_info')['id'],
    //         'code' => $this->uuid->v4(),
    //     ] + $this->_create_additional;
        
    //     if($this->M_referrals->insert($data)) {
    //         exit(json_encode([
    //             'status' => TRUE,
    //             'message' => 'Successfully generated referral code.'
    //         ]));
    //     } else {
    //         exit(json_encode([
    //             'status' => FALSE,
    //             'message' => 'Something went wrong! Please try again'
    //         ]));
    //     }
    // }
}
