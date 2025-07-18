<?php



use function PHPUnit\Framework\isEmpty;

defined('BASEPATH') or exit('No direct script access allowed');



class Loan extends CI_Controller
{



    public function __construct()
    {

        parent::__construct();



        // User Related Models

        $this->load->model('Users_model', 'M_users');

        $this->load->model('Members_model', 'M_members');

        $this->load->model('Billing_address_model', 'M_billing_address');

        $this->load->model('User_logs_model', 'M_user_logs');



        //Loans Related Models

        $this->load->model('Member_balance_model', 'M_member_balance');

        $this->load->model('Loans_model', 'M_loans');

        $this->load->model('Loans_repayment_schedule_model', 'M_loan_repayment_schedule');

        $this->load->model('Items_model', 'M_items');



        // Payment Related Models

        $this->load->model('Payment_records_model', 'M_payment_records');

        $this->load->model('Invoice_particulars_model', 'M_invoice_particular');

        $this->load->model('Transaction_category_model', 'M_transaction_category');



        // $this->load->model('Cashiering_invoice_model', 'M_cashiering_invoice');

        $this->load->model('Payment_options_model', 'M_payment_options');

        $this->load->model('Payment_records_model', 'M_payment_record');
        $this->load->model('User_roles_model', 'M_user_role');

        $this->load->model('Payment_method_model', 'M_payment_methods');

        $this->load->model('Cashiering_invoice_model', 'M_cashiering_invoice');





        //Contributions Related Model

        $this->load->model('Cap_share_account_dues', 'M_capital_share_account_dues');

        $this->load->model('Capital_contributions_model', 'M_capital_contribution');





        //Helpers related to transactions

        $this->load->helper('db_helper');

        $this->load->helper('transaction_helper');

        $this->load->helper('analytics_helper');

        $this->load->helper('data_table_helper');



        // Session Information

        $this->_user_id = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;

        $this->_user_role = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;

        $this->_user_email = isset($SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;



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





        $this->_notifications_data = array(

            'notifications' => get_top_notifications($_SESSION['user_id']),

            'unread_count' => get_unread_count($_SESSION['user_id']),

            'new_count' => get_new_count($_SESSION['user_id'])

        );



        $this->_log_additional = array(

            'user_id' => isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_EMAIL,

            'entity_name' => $this->_user_role,

            'ip_address' => $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']



        );



        $this->_user_id = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;

    }





    public function loan_dt_list()
    {



        $formatter = function ($loan) {

            return [

                'id' => $loan->id,

                'user_id' => $loan->user_id,

                'first_name' => $loan->first_name,

                'last_name' => $loan->last_name,

                'loan_amount' => $loan->loan_amount,

                'loan_status' => $loan->loan_status,

                'loan_type' => $loan->loan_type,

                'loan_term' => $loan->loan_term,

            ];

        };



        $filter = [

            'search' => $this->security->xss_clean($this->input->post('search')['value']),

            'loan_status' => $this->input->post('status') ? $this->security->xss_clean($this->input->post('status')) : '',

            'user_id' => $this->input->post('user_id') ? $this->security->xss_clean($this->input->post('user_id')) : ''

        ];

        $output = get_datatable($this, $this->M_loans, $formatter, $filter);

        exit(json_encode($output));

    }



    public function getAmount()
    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            $member_id = $this->M_members->get_by_user($this->_user_id);

            $info = $this->M_loan_repayment_schedule->get_loan_info($member_id['id']);

            if (empty($info)) {

                return $this->_send_json_response(FALSE, 'An error occurred. Please try again later OO1X.');

            }



            exit(json_encode($info));

        }



        return $this->_send_json_response(FALSE, 'An error occurred. Please try again later 002x.');

    }





    public function repayment_dt_list()
    {



        $formatter = function ($repayment) {

            return [

                'id' => $repayment->id,

                'amount_due' => $repayment->amount_due,

                'due_date' => $repayment->due_date,

                'status' => $repayment->status,

            ];

        };



        $filter = [

            'search' => $this->security->xss_clean($this->input->post('search')['value']),

            'user_id' => $this->_user_id ?? $this->input->post('user_id'),

            'status' => $this->input->post('status')

        ];



        $output = get_datatable($this, $this->M_loan_repayment_schedule, $formatter, $filter);

        exit(json_encode($output));

    }










    public function loanApplication()
    {
        if (!has_permissions('view_loan')) {
            show_404();
        }
        $data['page_data'] = [
            'system_module' => 'Loan Application',
            'system_section' => '',
            'title' => 'Loans',
            'styles_path' => [
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/bs-stepper/bs-stepper.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/rateyo/rateyo.css',
                'assets/vendor/libs/@form-validation/form-validation.css',
                'assets/vendor/css/pages/wizard-ex-checkout.css',
            ],
            'scripts_path' => [
                'assets/js/loan/utils/index.js',
                'assets/js/loan/index-copy.js',
                'assets/vendor/libs/moment/moment.js',
                'assets/js/loan/user/index.js',
                'assets/js/loan/admin/view.js',
                'assets/js/wizard-ex-checkout.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'
            ]
        ] + $this->_notifications_data;
        $data['payment_options'] = $this->M_payment_options->get_all() ?? [];
        $data['payment_method'] = $this->M_payment_methods->get_all() ?? [];
        $data['members'] = $members = $this->M_members->get_by_user($this->_user_id) ?? [];
        $data['payment_schedule'] = $this->M_loan_repayment_schedule->get_by_user_id($members['id'] ?? 0) ?? [];
        $data['info'] = $this->M_loans->get_loan_info($members['id'] ?? 0) ?? [];
        $data['balance'] = $this->M_member_balance->get_by_user_id($this->_user_id) ?? 0;
        $data['info_capital_dues'] = $this->M_capital_share_account_dues->get_all() ?? [];
        $data['billing_info'] = $this->M_billing_address->get($this->_user_id) ?? [];
        $data['financial_info'] = get_by_user_id_and_table($this->_user_id, 'members', 'member_id', 'financial_accounts') ?? [];
        $this->load->view('pages/loan/loan-general-index', $data);
    }

    public function loanRepayment() {
          $data['page_data'] = [
            'system_module' => 'Loan Application',
            'system_section' => '',
            'title' => 'Loans',
            'styles_path' => [
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/bs-stepper/bs-stepper.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/rateyo/rateyo.css',
                'assets/vendor/libs/@form-validation/form-validation.css',
                'assets/vendor/css/pages/wizard-ex-checkout.css',
            ],
            'scripts_path' => [
                'assets/js/loan/utils/index.js',
                'assets/js/loan/index-copy.js',
                'assets/vendor/libs/moment/moment.js',
                'assets/js/loan/user/index.js',
                'assets/js/loan/admin/view.js',
                'assets/js/wizard-ex-checkout.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'
            ]
        ] + $this->_notifications_data;
        $data['payment_options'] = $this->M_payment_options->get_all() ?? [];
        $data['payment_method'] = $this->M_payment_methods->get_all() ?? [];
        $data['members'] = $members = $this->M_members->get_by_user($this->_user_id) ?? [];
        $data['payment_schedule'] = $this->M_loan_repayment_schedule->get_by_user_id($members['id'] ?? 0) ?? [];
        $data['info'] = $this->M_loans->get_loan_info($members['id'] ?? 0) ?? [];
        $data['balance'] = $this->M_member_balance->get_by_user_id($this->_user_id) ?? 0;
        //   $data['info_capital_dues'] = $this->M_capital_share_account_dues->get_all() ?? [];                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          3>get_all() ?? [];
        $data['billing_info'] = $this->M_billing_address->get($this->_user_id) ?? [];
        $data['financial_info'] = get_by_user_id_and_table($this->_user_id, 'members', 'member_id', 'financial_accounts') ?? [];
        $this->load->view('pages/loan/user/status/disbursed', $data);
    }
    public function index()
    {
        if (!has_permissions('view_loan')) {
            show_404();
        }
        $data['page_data'] = [
            'system_module' => 'Loan',
            'system_section' => '',
            'title' => 'Loans',
            'styles_path' => [
                'assets/vendor/libs/select2/select2.css',
                'assets/vendor/libs/bs-stepper/bs-stepper.css',
                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',
                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',
                'assets/vendor/libs/rateyo/rateyo.css',
                'assets/vendor/libs/@form-validation/form-validation.css',
                'assets/vendor/css/pages/wizard-ex-checkout.css',
            ],
            'scripts_path' => [
                'assets/js/loan/utils/index.js',
                'assets/js/loan/index-copy.js',
                'assets/vendor/libs/moment/moment.js',
                'assets/js/loan/user/index.js',
                'assets/js/loan/admin/view.js',
                'assets/js/wizard-ex-checkout.js',
                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'
            ]
        ] + $this->_notifications_data;

         $member_id = $this->M_members->get_by_user($this->_user_id) ?: NULL;


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

        
        $this->load->view('pages/loan/loanDashboard', $data);
    }


    public function overview($id = NULL)
    {

        if (!$id) {

            show_404();

        }



        if (!has_permissions('view_loan')) {

            show_404();

        }



        $data['page_data'] = [

            'system_module' => 'Overview',

            'system_section' => '',

            'title' => 'Loans',

            'styles_path' => [

                'assets/vendor/libs/select2/select2.css',

                'assets/vendor/libs/bs-stepper/bs-stepper.css',

                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',

                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',

                'assets/vendor/libs/rateyo/rateyo.css',

                'assets/vendor/libs/@form-validation/form-validation.css',

                'assets/vendor/css/pages/wizard-ex-checkout.css',

            ],

            'scripts_path' => [

                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',

                'assets/vendor/libs/moment/moment.js',

                'assets/js/loan/loan_officer/view.js',

                'assets/js/wizard-ex-checkout.js',



            ]

        ] + $this->_notifications_data;



        $data['info'] = $info = get_by_code_and_table($id, 'user_id', 'Members');



        $data['invoice'] = get_by_code_and_table($info['id'], 'member_id', 'loans');



        $this->load->view('pages/loan/loan_officer/overview', $data);

    }



    public function payment_history($id = NULL)
    {

        if (!$id) {

            show_404();

        }



        if (!has_permissions('view_loan')) {

            show_404();

        }



        $data['page_data'] = [

            'system_module' => 'Statement',

            'system_section' => '',

            'title' => 'Loans',

            'styles_path' => [

                'assets/vendor/libs/select2/select2.css',

                'assets/vendor/libs/bs-stepper/bs-stepper.css',

                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',

                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',

                'assets/vendor/libs/rateyo/rateyo.css',

                'assets/vendor/libs/@form-validation/form-validation.css',

                'assets/vendor/css/pages/wizard-ex-checkout.css',

            ],

            'scripts_path' => [

                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',

                'assets/vendor/libs/moment/moment.js',

                'assets/js/loan/loan_officer/payment_list.js',

                'assets/js/wizard-ex-checkout.js',



            ]

        ] + $this->_notifications_data;



        $data['info'] = $info = get_by_code_and_table($id, 'user_id', 'Members');



        $data['invoice'] = get_by_code_and_table($info['id'], 'member_id', 'loans');



        $this->load->view('pages/loan/loan_officer/payment_history', $data);

    }



    public function view_invoice($id = NULL)
    {

        if (!has_permissions('view_loan_invoice')) {

            show_404();

        }



        $data['page_data'] = [

            'system_module' => 'Loan',

            'system_section' => '',

            'title' => 'Loans',

            'styles_path' => [

                'assets/vendor/libs/select2/select2.css',

                'assets/vendor/libs/bs-stepper/bs-stepper.css',

                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',

                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',

                'assets/vendor/libs/rateyo/rateyo.css',

                'assets/vendor/libs/@form-validation/form-validation.css',

                'assets/vendor/css/pages/wizard-ex-checkout.css',

            ],

            'scripts_path' => [

                'assets/js/utilities/selectHandler.js',

                'assets/js/loan/user/view_invoice.js',

                'assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',



            ]

        ] + $this->_notifications_data;



        $data['loan_info'] = $this->M_loan_repayment_schedule->get($id) ?? [];

        $data['payment_method'] = $this->M_payment_methods->get_all() ?? [];

        $data['members'] = $members = $this->M_members->get_by_user($this->_user_id);

        $data['payment_schedule'] = $this->M_loan_repayment_schedule->get_by_user_id($members['id']) ?? [];

        $data['info'] = $info = $this->M_loans->get_loan_info($members['id']) ?? [];

        $data['payment_options'] = $this->M_payment_options->get_all() ?? [];





        // repayment schedule should be based per user: 

        $this->load->view('pages/loan/user/view-invoice', $data);

    }





    public function index_admin()
    {

        if (!has_permissions('can_view_loan_applicants')) {

            show_404();

        }



        $data['page_data'] = [

            'system_module' => 'Loan Approval',

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

                'assets/js/loan/admin/index.js'

            ]

        ] + $this->_notifications_data;



        $data['pending_loans'] = count_all('loans', 'loan_status', 'Pending');



        $data['disbursed_loans'] = count_all('loans', 'loan_status', 'Disbursed');



        $data['rejected_loans'] = count_all('loans', 'loan_status', 'Rejected');



        $data['all_loans'] = count_all('loans', 'deleted_at', NULL);





        $this->load->view('pages/loan/admin/index', $data);

    }



    public function index_view($id = NULL)
    {



        if (!has_permissions('can_view_loan_applicants')) {

            show_404();

        }



        $member_id = $this->M_members->get_by_user($id);



        $data['page_data'] = [

            'system_module' => 'Applicant View',

            'system_section' => '',

            'title' => 'Loan Applicant',

            'styles_path' => [

                'assets/vendor/libs/select2/select2.css',

                'assets/vendor/libs/bs-stepper/bs-stepper.css',

                'assets/vendor/libs/rateyo/rateyo.css',

                'assets/vendor/libs/@form-validation/form-validation.css',

                'assets/vendor/css/pages/wizard-ex-checkout.css',

            ],

            'scripts_path' => [

                'assets/js/loan/utils/index.js',
                'assets/vendor/libs/cleavejs/cleave.js',

                'assets/vendor/libs/cleavejs/cleave-phone.js',

                'assets/js/loan/admin/view.js',

                'assets/js/loan/index-copy.js',

                'assets/js/wizard-ex-checkout.js',



            ]

        ] + $this->_notifications_data;





        $data['info'] = $this->M_loans->get_loan_info($member_id['id']);





        $this->load->view('pages/loan/admin/view', $data);

    }



    public function member_list()
    {



        if (!has_permissions('can_view_loan_applicants')) {

            show_404();

        }



        $data['page_data'] = [

            'system_module' => 'Loan Approval',

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

                'assets/js/loan/loan_officer/index.js'

            ]

        ] + $this->_notifications_data;



        $data['pending_loans'] = count_all('loans', 'loan_status', 'Pending');



        $data['disbursed_loans'] = count_all('loans', 'loan_status', 'Disbursed');



        $data['rejected_loans'] = count_all('loans', 'loan_status', 'Rejected');



        $data['all_loans'] = count_all('loans', 'deleted_at', NULL);





        $this->load->view('pages/loan/admin/active-list-index', $data);

    }





    public function cashier_index()
    {

        if (!has_permissions('disburse_loan')) {

            show_404();

        }



        $data['page_data'] = [

            'system_module' => 'Loan',

            'system_section' => '',

            'title' => 'Loans',

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

                'assets/js/loan/cashier/index.js'

            ]

        ] + $this->_notifications_data;



        $data['payment_options'] = $this->M_payment_options->get_all();

        $data['payment_method'] = $this->M_payment_methods->get_all();

        $data['pending_payments'] = $this->M_capital_share_account_dues->get_by_user_id($this->_user_id);

        $data['subscribed_transaction'] = $this->M_capital_contribution->get_by_user_id($this->_user_id);

        $data['info '] = $this->M_capital_share_account_dues->get_all();



        $this->load->view('pages/loan/cashier/index', $data);

    }





    public function repaymentIndex()
    {

        if (!has_permissions('disburse_loan')) {

            show_404();

        }



        $data['page_data'] = [

            'system_module' => 'Loan',

            'system_section' => '',

            'title' => 'Loans',

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

                'assets/js/loan/cashier/index.js'

            ]

        ] + $this->_notifications_data;



        $data['payment_options'] = $this->M_payment_options->get_all();

        $data['payment_method'] = $this->M_payment_methods->get_all();

        $data['pending_payments'] = $this->M_capital_share_account_dues->get_by_user_id($this->_user_id);

        $data['subscribed_transaction'] = $this->M_capital_contribution->get_by_user_id($this->_user_id);

        $data['info '] = $this->M_capital_share_account_dues->get_all();



        $this->load->view('pages/loan/cashier/index', $data);

    }







    public function cashier_view($id = NULL)
    {

        if (!has_permissions('disburse_loan')) {

            show_404();

        }



        $member_id = $this->M_members->get_by_user($id);

        $data['page_data'] = [

            'system_module' => 'Loan',

            'system_section' => '',

            'title' => 'Loans',

            'styles_path' => [

                'assets/vendor/libs/select2/select2.css',

                'assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css',

                'assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css',

                'assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css',

                'assets/vendor/libs/@form-validation/form-validation.css',

            ],

            'scripts_path' => [



                'assets/js/loan/utils/index.js',

                'assets/js/loan/cashier/index.js',





            ]

        ] + $this->_notifications_data;



        $data['info'] = $this->M_loans->get_loan_info($member_id['id']);



        $this->load->view('pages/loan/cashier/view', $data);

    }



    public function manager_index()
    {



        if (!has_permissions('can_view_loan_applicants')) {

            show_404();

        }



        $data['page_data'] = [

            'system_module' => 'Loan Approval',

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

                'assets/js/loan/manager/index.js'

            ]

        ] + $this->_notifications_data;



        $data['pending_loans'] = count_all('loans', 'loan_status', 'Pending');

        $data['disbursed_loans'] = count_all('loans', 'loan_status', 'Disbursed');

        $data['rejected_loans'] = count_all('loans', 'loan_status', 'Rejected');

        $data['all_loans'] = count_all('loans', 'deleted_at', NULL);





        $this->load->view('pages/loan/admin/index', $data);

    }





    public function generate_loan_reference_number()
    {

        $yearMonth = date('ym');

        $lastSequence = $this->M_loans->get_last_sequence($yearMonth);

        $newSequence = str_pad($lastSequence + 1, 4, '0', STR_PAD_LEFT); // Ensures 4-digit format

        $referenceNumber = "LN-{$yearMonth}{$newSequence}";

        return $referenceNumber;

    }







    public function loan_application()
    {



        if ($post_data = $this->security->xss_clean($this->input->post())) {



            $rules = [

                ['field' => 'loan_amount', ' ' => 'Loan', 'rules' => 'required'],

                ['field' => 'payment_schedule', 'label' => 'Terms', 'rules' => 'required'],

                ['field' => 'disbursment_account', 'label' => 'Select account', 'rules' => 'required'],

            ];



            $this->form_validation->set_rules($rules);



            if ($this->form_validation->run() == FALSE) {

                $validation_errors = $this->form_validation->error_array();

                return $this->_send_json_response(FALSE, 'Validation Error', $this->_format_validation_errors($rules, $validation_errors));

            }



            $loan_amount = $post_data['loan_amount'];

            $payment_term = $post_data['payment_schedule'];

            $disbursment_account = $post_data['disbursment_account'];

            $start_date = date("Y-m-d"); // Example: "2025-01-13"



            /* take note that the interest rate is 2.25% and 

           a service charge of 2.50% */



            $interest_rate = 0.0225;

            $serviceCharge = 0.025;



            $totalInterest = 0.0225 * $payment_term;

            $repayment_amount = $loan_amount * $totalInterest; //with interest

            $serviceFee = $loan_amount * $serviceCharge; // service charge based on the amount

            $repayment_amount_w_service_fee = $repayment_amount + $serviceFee;

            $principal_with_interest = $repayment_amount_w_service_fee + $loan_amount;



            $member_id = $this->M_members->get_by_user($this->_user_id);



            $loan_information = [

                'member_id' => $member_id['id'],

                'disbursment_account_id' => $disbursment_account,

                'loan_reference_number' => $this->generate_loan_reference_number(),

                'principal_with_interest' => $principal_with_interest,

                'remaining_balance' => $principal_with_interest,

                'loan_amount' => $loan_amount,

                'loan_type' => 'personal',

                'loan_term' => $payment_term,

                'start_date' => NULL,

                'end_date' => NULL,

                'loan_status' => 'pending',

            ] + $this->_create_additional;



            $loan_upload = $this->M_loans->insert($loan_information);

            // this part of the code updates the user's current balance to all transactions.

            $member_balance = $this->M_member_balance->get_by_user_id($this->_user_id);



            $available_credit = $member_balance['available_credit'] - $loan_amount;



            $data = [

                'available_credit' => $available_credit

            ] + $this->_update_additional;





            $result = $this->M_member_balance->update($this->_user_id, $data);



            if (!$result) {

                log_message('error', 'Update failed for user_id: ' . $this->_user_id);

                $this->db->trans_rollback();

                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

            }





            if (!$loan_upload) {

                $this->db->trans_rollback();

                throw new Exception('The system failed to process your loan at this time. Contact Admin Support');

            }



            $this->db->trans_commit();

            return $this->_send_json_response(TRUE, 'Loan application submitted');

        } else {

            $this->db->trans_rollback();

            return $this->_send_json_response(FALSE, 'The loan application is not available this time. Please contact admin support.');

        }

    }





    public function approve()
    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            $loan_id = $post_data['loan_id'];

            $role = get_by_code_and_table($this->_user_id, 'user_id', 'user_roles');  // Get the current role

            $status = '';

            $role_id = '';



            try {

                $this->db->trans_start();



                if ($role['role_id'] == 18) {

                    $status = ['loan_status' => 'Pending Manager Approval'] + $this->_update_additional;



                } else if ($role['role_id'] == 19) {

                    $status = ['loan_status' => 'Approved'] + $this->_update_additional;

                } else {

                    // Handle any role that does not meet the expected values (for logging or error)

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'Invalid role for approval.');

                }



                $admin_logs = [

                    'type_of_action' => 'Loan Application Approved',

                    'action_description' => 'User ' . $this->_user_email . ' Approved a Loan Application'

                ] + $this->_log_additional;



                if (!$this->M_loans->update($loan_id, $status)) {

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

                }



                if (!$this->M_user_logs->insert($admin_logs)) {

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

                }



                $this->db->trans_commit();

                return $this->_send_json_response(TRUE, 'Loan application successfully updated!');

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





    public function reject()
    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            $id = $post_data['id'];

            $Remarks = $post_data['remarks'];

            try {

                $admin_logs = [

                    'type_of_action' => 'Loan Application Rejected',

                    'action_description' => 'User ' . $this->_user_email . ' Rejected an applicant in the form'

                ] + $this->_log_additional;



                $data = [

                    'loan_status' => 'Rejected',

                    'remarks' => $Remarks,

                ] + $this->_update_additional;







                $loan = $this->M_loans->get($id);

                $user_id = $this->M_members->get($loan['member_id']);

                $loan_balance = $this->M_member_balance->get_by_user_id($user_id['user_id']);



                $available_credit = $loan_balance['available_credit'] + $loan['loan_amount'];



                $reimburse_credit = [

                    'available_credit' => $available_credit

                ] + $this->_update_additional;





                $result = $this->M_member_balance->update($user_id['user_id'], $reimburse_credit);



                if (!$result) {

                    log_message('error', 'Update failed for user_id: ' . $this->_user_id);

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

                }



                if (!$this->M_loans->update($id, $data)) {

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

                }





                if (!$this->M_user_logs->insert($admin_logs)) {

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

                }



                $this->db->trans_commit();

                return $this->_send_json_response(TRUE, 'Loan application rejected Successfuly!');

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



    // disburse and reject user interface

    public function disburse()
    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            $loan_id = $post_data['loan_id'];



            $loan_details = $this->M_loans->get($loan_id);

            $member_info = $this->M_members->get($loan_details['member_id']);

            $get_loan_balance = $this->M_member_balance->get_by_user_id($member_info['user_id']);



            if (!$get_loan_balance) {

                return $this->_send_json_response(FALSE, 'Member balance record not found.');

            }



            $loan_amount = $post_data['amount_due'];

            $payment_term = $post_data['payment_term'];





            $available_credit = floatval($get_loan_balance['available_credit']);





            $data = [

                'available_credit' => $available_credit,



            ] + $this->_update_additional;



            try {



                $status = ['loan_status' => 'Disbursed'] + $this->_update_additional;

                $admin_logs = [

                    'type_of_action' => 'Loan Amount Disbursed To Account',

                    'action_description' => 'User ' . $this->_user_email . ' Approved a Loan Application'

                ] + $this->_log_additional;





                if (!$this->M_member_balance->update($get_loan_balance['user_id'], $data)) {

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'The system failed to update member loan balance. Please try again.');

                }



                if (!$this->M_loans->update($loan_id, $status)) {

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

                }



                if (!$this->_process_loan_repayment($loan_id, $loan_amount, $payment_term, $member_info, $loan_details)) {

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

                }



                if (!$this->M_user_logs->insert($admin_logs)) {

                    $this->db->trans_rollback();

                    return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

                }





                $this->db->trans_commit();

                return $this->_send_json_response(TRUE, 'Loan application successfully updated!');

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







    private function _get_validation_rules()
    {

        return [

            ['field' => 'payment_method', 'label' => 'Details', 'rules' => 'required'],

            ['field' => 'payment_mode', 'label' => 'Payment mode', 'rules' => 'required'],

            // ['field' => 'payment_scope', 'label' => 'Payment scope', 'rules' => 'required'],

            ['field' => 'total_payment', 'label' => 'Payment amount', 'rules' => 'required'],

        ];

    }







    private function _send_json_response($status, $message, $additional_data = [])
    {

        $response = array_merge(['status' => $status, 'message' => $message], ['validation_errors' => $additional_data]);

        exit(json_encode($response));

    }





    private function _process_loan_repayment($loan_id, $amount_due, $payment_term, $member_info, $loan_details)
    {

        // Calculate service fee, interest rate, total amount, and monthly repayment

        $serviceFee = 0.025 * $amount_due;

        $interestRate = 0.0225 * $amount_due * $payment_term;

        $total_amount = $amount_due + $interestRate + $serviceFee;

        $monthlyRepayment = floor(($total_amount / $payment_term) * 100) / 100; // rounded off to get the exact amount in balance

        $last_payment = $total_amount - ($monthlyRepayment * ($payment_term - 1));





        // Generate a unique invoice number

        $invNumber = generateInvoiceNumber();

        $itemId = $this->M_items->get_by_category(3);



        // Fetch user's billing address

        $billing_address = get_by_code_and_table($member_info['user_id'], 'user_id', 'billing_address');



        if (!$billing_address) {

            return $this->_send_json_response(FALSE, 'Billing address not found.');

        }





        $this->db->trans_start();





        for ($i = 0; $i < $payment_term; $i++) {



            $due_date = date('Y-m-d H:i:s', strtotime("+" . ($i + 1) . " month"));



            $status = "Pending";



            // this is to identify if the member is at its last payment

            $payment_amount = ($i == $payment_term - 1) ? round($last_payment, 2) : round($monthlyRepayment, 2);



            // Prepare loan repayment schedule data this is the code to be revised.

            $data = [

                'loan_id' => $loan_id,

                'amount_due' => $payment_amount,

                'due_date' => $due_date,

                'status' => $status,

            ] + $this->_create_additional;





            // Insert loan repayment schedule

            $inserted = $this->M_loan_repayment_schedule->insert($data);

            if (!$inserted) {

                $this->db->trans_rollback();

                return $this->_send_json_response(FALSE, 'Failed to insert loan repayment schedule.');

            }

            // Prepare invoice data

            $invoice_data = [

                'user_id' => $member_info['user_id'],

                'invoice_number' => $invNumber,

                'transaction_category_id' => 3, // Use from loan details

                'date_issued' => date('Y-m-d H:i:s'),

                'billing_address_id' => $billing_address['id'],

                'status' => 'pending',

                'amount' => $payment_amount,

            ] + $this->_create_additional;



            // Insert invoice data

            $invoice_id = $this->M_cashiering_invoice->insert($invoice_data);

            if (!$invoice_id) {

                $this->db->trans_rollback();

                return $this->_send_json_response(FALSE, 'Failed to insert invoice data.');

            }



            // Prepare invoice particular data

            $invoice_particular = [

                'cashiering_invoice_id' => $invoice_id,

                'item_id' => 3,

                'quantity' => 1,

                'unit_cost' => $payment_amount,

                'total_cost' => $payment_amount,

            ] + $this->_create_additional;



            // Insert invoice particular data

            $particular_id = $this->M_invoice_particular->insert($invoice_particular);

            if (!$particular_id) {

                $this->db->trans_rollback();

                return $this->_send_json_response(FALSE, 'Failed to insert invoice particular.');

            }

        }



        // Commit the transaction

        $this->db->trans_complete();



        if ($this->db->trans_status() === FALSE) {

            return $this->_send_json_response(FALSE, 'Transaction failed.');

        }



        return $this->_send_json_response(TRUE, 'Loan repayment schedule and invoices created successfully.');

    }





    public function payment()
    {

        if ($post_data = $this->security->xss_clean($this->input->post())) {

            $this->form_validation->set_rules($this->_get_validation_rules());



            if ($this->form_validation->run() == FALSE) {

                return $this->_send_json_response(FALSE, validation_errors(), NULL);

            }



            $this->db->trans_start();



            // handles file upload

            $upload_data = $this->_handle_file_upload();



            if (!$upload_data) {

                return $this->_send_json_response(FALSE, 'File upload failed.');

            }



            $invoice = get_by_two_keys_and_table('status', 'pending', 'transaction_category_id', 3, $this->_user_id, 'cashiering_invoice');



            if (!$invoice) {

                return $this->_send_json_response(FALSE, 'Invoice not found.');

            }



            // Retrieve invoice particulars

            if (!$invoice_particular = $this->M_invoice_particular->get_invoice_by_id($invoice['id'])) {

                $this->_send_json_response(FALSE, 'Invoice particular is not found.');

            }



            if (!$member_id = get_by_code_and_table($this->_user_id, 'user_id', 'members')) {

                return $this->_send_json_response(FALSE, 'Member not found');

            }



            // Retrieve pending loan repayment

            $info = $this->M_loan_repayment_schedule->pending_loan_repayment($member_id['id'], $post_data['schedule_id']);



            // automatically updates the loan repayment schedule even if the user selects a different date.

            if (!$info) {

                return $this->_send_json_response("No pending loan repayment found.");

            }



            // Update loan repayment status

            $update = $this->M_loan_repayment_schedule->update($info['id'], ['status' => 'payment_initiated', 'amount_paid' => $post_data['total_payment']]);



            if (!$update) {

                return $this->_send_json_response("Failed to update loan repayment status.");

            }





            $paymentData = [

                'invoice_particulars_id' => $invoice_particular['id'],

                'transaction_category_id' => 3,

                'transaction_reference_id' => $post_data['schedule_id'],

                'payment_date' => date('Y-m-d'),

                'payment_method_id' => $post_data['payment_method'],

                'account_name' => $post_data['account_name'],

                'account_number' => $post_data['account_number'],

                'reference_number' => $post_data['reference_number'],

                'total_payment' => $post_data['total_payment'],

                'payment_proof' => $upload_data,

                'status' => 'pending',

            ] + $this->_create_additional;



            $insertId = $this->M_payment_records->insert($paymentData);



            if (!$insertId) {

                $this->db->trans_rollback();

                log_message('error', 'Failed to insert payment data.');

                return $this->_send_json_response(FALSE, 'Payment Insertion Unsuccessful.');

            }



            $role = ['role' => $this->_user_role] + $this->_update_additional;



            $admin_logs = [

                'type_of_action' => 'User Payment Initiated',

                'action_description' => 'User ' . $this->_user_email . 'Initiate loan repayment'

            ] + $this->_log_additional;



            if (!$this->M_user_logs->insert($admin_logs)) {

                $this->db->trans_rollback();

                return $this->_send_json_response(FALSE, 'A database error occurred. Please try again later.');

            }





            $updated_invoice = $this->M_cashiering_invoice->update($invoice['id'], ['status' => 'payment-initiated']);





            $this->db->trans_commit();

            // Return success response with inserted ID

            return $this->_send_json_response(TRUE, 'Payment recorded successfully.', $insertId);

        }



        // If no post data is received, return an error

        return $this->_send_json_response(FALSE, NULL, 'No data received.');

    }







    private function _handle_file_upload()
    {

        $upload_path = 'uploads/payments/payment_receipt/' . $this->_user_id . '/';

        // modify this part specifically the upload path permission

        if (!is_dir($upload_path) && !mkdir($upload_path, 0757, true)) {

            log_message('error', 'Failed to create directory: ' . $upload_path);

            return $this->_send_json_response(FALSE, 'Failed to create upload directory.');

        }



        $receipt_metadata = [

            'label' => 'payment_receipt',

            'allowed_extensions' => ['jpg', 'jpeg'],

            'allowed_mime_types' => ['image/jpeg', 'image/jpg']

        ];



        $receipt_key = 'payment-receipt';



        // Check if file exists in $_FILES

        if (!isset($_FILES['attachments']['name'][$receipt_key])) {

            log_message('error', 'No file found in $_FILES for key: ' . $receipt_key);

            return $this->_send_json_response(FALSE, 'No file uploaded.', null);

        }



        // Get file extension and MIME type

        $file_extension = pathinfo($_FILES['attachments']['name'][$receipt_key], PATHINFO_EXTENSION);

        $file_mime = mime_content_type($_FILES['attachments']['tmp_name'][$receipt_key]);



        // Validate file extension

        if (!in_array($file_extension, $receipt_metadata['allowed_extensions'])) {

            return $this->_send_json_response(FALSE, 'Invalid file extension. Allowed: ' . implode(', ', $receipt_metadata['allowed_extensions']));

        }



        // Validate MIME type

        if (!in_array($file_mime, $receipt_metadata['allowed_mime_types'])) {

            return $this->_send_json_response(FALSE, 'Invalid MIME type. Allowed: ' . implode(', ', $receipt_metadata['allowed_mime_types']));

        }



        // Upload configuration

        $config = [

            'upload_path' => $upload_path,

            'allowed_types' => implode('|', $receipt_metadata['allowed_extensions']),

            'file_name' => uniqid(),

        ];

        $this->upload->initialize($config);



        // Set the file data for upload

        $_FILES['file'] = [

            'name' => $_FILES['attachments']['name'][$receipt_key],

            'type' => $_FILES['attachments']['type'][$receipt_key],

            'tmp_name' => $_FILES['attachments']['tmp_name'][$receipt_key],

            'error' => $_FILES['attachments']['error'][$receipt_key],

            'size' => $_FILES['attachments']['size'][$receipt_key]

        ];



        // Attempt to upload the file

        if (!$this->upload->do_upload('file')) {

            log_message('error', 'File upload error: ' . $this->upload->display_errors('', ''));

            return $this->_send_json_response(FALSE, 'File upload failed: ' . $this->upload->display_errors('', ''));

        }



        // Return uploaded file data

        $upload_data = $this->upload->data();

        return $upload_path . $upload_data['file_name']; // Return the path to the uploaded file

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

}

