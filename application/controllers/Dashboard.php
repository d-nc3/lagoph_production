<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Dashboard extends CI_Controller
{



    public function __construct()
    {

        parent::__construct();



        $this->load->model('Users_model', 'M_users');

        $this->load->model('Billing_address_model', 'M_billing_address');

        $this->load->model('Member_balance_model', 'M_member_balance');

        $this->load->model('Members_model', 'M_member');

        $this->load->model('Loans_model', 'M_loans');

        $this->load->model('User_roles_model', 'M_user_role');

        $this->load->model('User_logs_model', 'M_user_logs');

        $this->load->model('Payment_records_model', 'M_payment_records');

        $this->load->helper('analytics_helper');



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



        $this->redirect_if_not_logged_in();

        $this->_user_id = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;

        $this->_user_role = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;

        $this->_user_email = isset($SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;



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

            'system_module' => 'Dashboard',

            'system_section' => '',

            'title' => 'Dashboard',

            'styles_path' => [

                    'assets/vendor/libs/swiper/swiper.css',

                    'assets/vendor/css/pages/ui-carousel.css',

                    'assets/vendor/libs/apex-charts/apex-charts.css',



                    'assets/vendor/apex-charts.css',

                    'assets/vendor/css/pages/dashboard.css',

                    'assets/vendor/css/pages/app-logistics-dashboard.css',

                    'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',

                    'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',

                    'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',

                    'assets/vendor/libs/fullcalendar/fullcalendar.css',

                    'assets/vendor/libs/select2/select2.css',

                    'assets/vendor/libs/flatpickr/flatpickr.css',

                    'assets/vendor/css/pages/calendar/calendar.css',

                ],

            'scripts_path' => [

                'assets/vendor/libs/swiper/swiper.js',

                'assets/vendor/libs/apex-charts/apexcharts.js',

                'assets/js/charts-apex.js',

                'assets/js/charts-chartjs.js',

                'assets/js/dashboard/cashier/index.js',

                'assets/js/app-logistics-dashboard.js',

                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',

                'assets/js/dashboard/index.js',

                'assets/vendor/libs/fullcalendar/fullcalendar.js',

                'assets/vendor/libs/moment/moment.js',

                'assets/vendor/libs/flatpickr/flatpickr.js',

                'assets/js/membership/schedules/app-calendar-events.js',

                'assets/js/membership/app-calendar-member.js',

                'assets/js/ui-carousel.js',
                'assets/js/dasboard/member/index.js'

            ]

        ] + $this->_notifications_data;



        $member_id = $this->M_member->get_by_user($this->_user_id) ?: NULL;



        if ($member_id !== null && isset($member_id['id'])) {

            $data['loan_count'] = count_all('loans', 'member_id', $member_id['id']);

        } else {

            $data['loan_count'] = 0;

        }



        $data['member_balance'] = $this->M_member_balance->get_by_user_id($this->_user_id) ?? 0;

        $data['referral_count'] = count_all('user_referrals', 'from_user_id', $this->_user_id) ?? 0;

        $data['user_information'] = $member = get_by_code_and_table($this->_user_id, 'user_id', 'members') ?? [];

        $data['member_application'] = count_all('members', 'status', 'Processing') ?? 0;

        $data['all_members'] = count_all('members', 'status', 'Approved') ?? 0;

        $data['pending_payments'] = count_all('payment_records', 'status', 'Pending') ?? 0;

        $data['loan_counts'] = count_all('loans', 'loan_status', 'Approved') ?? 0;

        $data['completed_transactions'] = count_all('payment_records', 'status', 'Completed') ?? 0;

        $data['contributions'] = $contributions = get_by_code_and_table($this->_user_id, 'user_id', 'capital_contributions') ?? 0;

        $loan = $this->M_loans->get_by_memberId($member['id'] ?? 0);

        $data['due_date'] = isset($loan['id'])

            ? (recent_accountability('due_date', 'loan_id', $loan['id'], 'loan_repayment_schedules') ?? '-')

            : '-';



        $data['contribution_due'] = isset($contributions['id']) ? (recent_accountability('due_date', 'capital_contribution_id', $contributions['id'], 'cap_share_account_dues') ?? '-') : '-';



        $data['user_role'] = $this->M_user_role->get_role($this->_user_id) ?? 'Member';

        $data['billing_address'] = $this->M_billing_address->get($this->_user_id);

        $data['transactions'] = $this->M_payment_records->get_by_id($this->_user_id, 'completed') ?? [];

        $this->load->view('pages/dashboard/general-index', $data);

    }

}

