    <?php

    defined('BASEPATH') or exit('No direct script access allowed');



    class Landing extends CI_Controller
    {



        public function __construct()
        {

            parent::__construct();

            $this->load->library('email');





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

            if (!$ref) {

            }



            $data['page_data'] = [

                'system_module' => '',

                'system_section' => '',

                'title' => 'LagoPH',

                'styles_path' => [

                    'assets/vendor/css/pages/landing-page/front-page-landing.css',

                    'assets/vendor/css/pages/landing-page/front-page.css',

                    'assets/vendor/libs/nouislider/nouislider.css',

                    'assets/vendor/libs/swiper/swiper.css',



                ],

                'scripts_path' => [

                    'assets/vendor/libs/popper/popper.js',

                    'assets/vendor/js/bootstrap.js',

                    'assets/vendor/libs/nouislider/nouislider.js',

                    'assets/vendor/libs/swiper/swiper.js',

                    'assets/vendor/js/dropdown-hover.js',

                    'assets/vendor/js/mega-dropdown.js',

                    'assets/js/landing/index.js',



                ]

            ];

            $this->load->view('pages/landing/index', $data);

        }

        public function membership()
        { {




                $data['page_data'] = [

                    'system_module' => '',

                    'system_section' => '',

                    'title' => 'LagoPH',

                    'styles_path' => [

                        'assets/vendor/css/pages/landing-page/front-page-landing.css',

                        'assets/vendor/css/pages/landing-page/front-page.css',

                        'assets/vendor/libs/nouislider/nouislider.css',

                        'assets/vendor/libs/swiper/swiper.css',



                    ],

                    'scripts_path' => [

                        'assets/vendor/libs/popper/popper.js',

                        'assets/vendor/js/bootstrap.js',

                        'assets/vendor/libs/nouislider/nouislider.js',

                        'assets/vendor/libs/swiper/swiper.js',

                        'assets/vendor/js/dropdown-hover.js',

                        'assets/vendor/js/mega-dropdown.js',

                        'assets/js/landing/index.js',



                    ]

                ];

                $this->load->view('pages/landing/membership', $data);

            }
        }

        public function aboutUs()
        { {




                $data['page_data'] = [

                    'system_module' => '',

                    'system_section' => '',

                    'title' => 'LagoPH',

                    'styles_path' => [

                        'assets/vendor/css/pages/landing-page/front-page-landing.css',

                        'assets/vendor/css/pages/landing-page/front-page.css',

                        'assets/vendor/libs/nouislider/nouislider.css',

                        'assets/vendor/libs/swiper/swiper.css',



                    ],

                    'scripts_path' => [

                        'assets/vendor/libs/popper/popper.js',

                        'assets/vendor/js/bootstrap.js',

                        'assets/vendor/libs/nouislider/nouislider.js',

                        'assets/vendor/libs/swiper/swiper.js',

                        'assets/vendor/js/dropdown-hover.js',

                        'assets/vendor/js/mega-dropdown.js',

                        'assets/js/landing/index.js',



                    ]

                ];

                $this->load->view('pages/landing/aboutUs', $data);

            }
        }

        public function FAQ() {

                $data['page_data'] = [

                    'system_module' => '',

                    'system_section' => '',

                    'title' => 'LagoPH',

                    'styles_path' => [

                        'assets/vendor/css/pages/landing-page/front-page-landing.css',

                        'assets/vendor/css/pages/landing-page/front-page.css',

                        'assets/vendor/libs/nouislider/nouislider.css',

                        'assets/vendor/libs/swiper/swiper.css',



                    ],

                    'scripts_path' => [

                        'assets/vendor/libs/popper/popper.js',

                        'assets/vendor/js/bootstrap.js',

                        'assets/vendor/libs/nouislider/nouislider.js',

                        'assets/vendor/libs/swiper/swiper.js',

                        'assets/vendor/js/dropdown-hover.js',

                        'assets/vendor/js/mega-dropdown.js',

                        'assets/js/landing/index.js',



                    ]

                ];

                $this->load->view('pages/landing/FAQ', $data);
        }



        public function sendEmail()
        {

            $post_data = $this->security->xss_clean($this->input->post());

            if (!$post_data) {

                return $this->_send_json_response(FALSE, 'No input data received.');

            }



            $rules = [

                ['field' => 'contactEmail', 'label' => 'Email', 'rules' => 'required|valid_email'],

                ['field' => 'fullName', 'label' => 'Full Name', 'rules' => 'required'],

                ['field' => 'contactMessage', 'label' => 'Message', 'rules' => 'required'],

            ];

            $this->form_validation->set_rules($rules);



            if (!$this->form_validation->run()) {

                $validation_errors = $this->form_validation->error_array();

                return $this->_send_json_response(FALSE, 'Validation Error!', $this->_format_validation_errors($rules, $validation_errors));

            }



            $email = html_escape($post_data['contactEmail']);

            $fullName = html_escape($post_data['fullName']);

            $message = html_escape($post_data['contactMessage']);



            $template_data = compact('email', 'fullName', 'message');



            $user_message = $this->load->view('pages/landing/email-template/inquiry-receipt', $template_data, TRUE);

            $admin_message = $this->load->view('pages/landing/email-template/inquiry-display-admin', $template_data, TRUE);



            $user_sent = $this->_send_email('no-reply@lagoph.co', 'Lagoph Co. Support', $email, "We received your inquiry, $fullName", $user_message);

            $admin_sent = $this->_send_email($email, 'Lagoph Contact Form', 'lagoph.co@gmail.com', "New Inquiry from $fullName", $admin_message);



            if ($user_sent && $admin_sent) {

                return $this->_send_json_response(TRUE, 'Your message has been sent successfully.');

            } else {

                log_message('error', 'Inquiry email sending failed: User sent=' . ($user_sent ? 'yes' : 'no') . ', Admin sent=' . ($admin_sent ? 'yes' : 'no'));

                return $this->_send_json_response(FALSE, 'Failed to send message. Please try again later.');

            }

        }



        private function _send_email($from_email, $from_name, $to_email, $subject, $message)
        {

            $this->email->clear();

            $this->email->from($from_email, $from_name);

            $this->email->to($to_email);

            $this->email->subject($subject);

            $this->email->message($message);

            return $this->email->send();

        }





        private function _send_json_response($status, $message, $data = [])
        {

            $response = [

                'status' => $status,

                'message' => $message,

                'data' => $data

            ];

            echo json_encode($response);

            exit;

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

