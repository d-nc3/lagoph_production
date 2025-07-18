<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashiering extends CI_Controller {

        public function __construct()
        {
            parent::__construct();

        
            $this->load->model('Employees_model', 'M_employees');
            $this->load->model('Users_model', 'M_users');
            $this->load->model('Units_model', 'M_units');
            $this->load->model('Positions_model', 'M_positions');
            $this->load->model('Departments_model', 'M_departments');
            $this->load->model('User_logs_model', 'M_user_logs');
            $this->load->model('Cashiering_invoice_model','M_cashiering_invoice');
            $this->load->helper('string');
            $this->load->model('Invoice_particulars_model', 'M_invoice_particular');
            $this->load->model('Capital_contributions_model', 'M_capital_contributions');
            $this->load->model('Cash_accounts_model', 'M_cash_accounts');
            $this->load->model('Billing_address_model' , 'M_billing_address');
            $this->load->model('Ledger_model', 'M_ledger_model');
            $this->load->model('Payment_records_invoice_model','M_payments_invoice');
            $this->load->model('Official_receipts_model', 'M_official_receipt');  
            $this->load->model('Receipt_particulars_model', 'M_receipt_particulars');    
            $this->load->model('Payment_options_model', 'M_payment_options');
            $this->load->model('Items_model', 'M_items');

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

            $this->_user_additional = array (
                'user_id' => isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_EMAIL,
                'entity_name' => 'Employee',
                'ip_address' =>  $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']
                        
            );

            $this->_user_id  = isset($_SESSION['user_id']) ? $this->session->userdata('user_id') : DEFAULT_ADMIN_USER_ID;
            $this->_user_email  = isset($_SESSION['user_email']) ? $this->session->userdata('user_email') : DEFAULT_ADMIN_USER_EMAIL;
            $this->_user_role  = isset($_SESSION['user_role']) ? $this->session->userdata('user_role') : DEFAULT_ADMIN_USER_ROLE;
            $this->_first_name  = isset($_SESSION['first_name']) ? $this->session->userdata('first_name') : DEFAULT_ADMIN_USER_ROLE;
            $this->_last_name  = isset($_SESSION['last_name']) ? $this->session->userdata('last_name') : DEFAULT_ADMIN_USER_ROLE;
            $this->redirect_if_not_logged_in();

        }
 
          
        public function dt_list() {
            $search = $this->security->xss_clean($this->input->post('search'));
            $order = $this->security->xss_clean($this->input->post('order'));
            $start = $this->security->xss_clean($this->input->post('start'));   
            $length = $this->security->xss_clean($this->input->post('length'));
            $draw = $this->security->xss_clean($this->input->post('draw'));
          
        
            // Apply filters
            $filters = array();
            if (!empty($search['value'])) {
                $filters['search'] = $search['value'];
            }
          
            // Get filtered data 

            // remove uneccesarry joins and datas
            $list = $this->M_official_receipts->get_all_filtered($filters, $order, $start, $length);
            $data = array();
            $no = $start;
            foreach ($list as $transactions) {
                $no++;    
                $row = array();
                $row['id'] = $transactions->id;
                $row['cashiering_invoice_id'] =$transactions->cashiering_invoice_id;
                $row['user_id'] =$transactions->user_id;
                $row['official_receipt_number'] =$transactions->official_receipt_number;
                $row['invoice_number'] =$transactions->invoice_number;
                $row['invoice_type'] =$transactions->invoice_type;
                $row['payment_date'] =$transactions->payment_date;
                $row['status'] =$transactions->status;
                $data[] = $row;
            }
        
            // Prepare the output for DataTables
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->M_official_receipts->count_all(),
                "recordsFiltered" => $this->M_official_receipts->count_filtered($filters),
                "data" => $data,
            );
        
            // Return the JSON response
          
          
            echo json_encode($output);
             
        }


}

