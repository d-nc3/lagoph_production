
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_records_model extends CI_Model
{

    protected $_table = 'payment_records';
    protected $_table_invoice = 'cashiering_invoice';
    protected $user = 'users';

    public function get_all()
    {
        return $this->db->where('deleted_at', null)
            ->where('status', 'Processing')
            ->get($this->_table)
            ->result_array();
    }

    public function get($id)
    {
        return $this->db->where('deleted_at', null)
            ->where('id', $id)
            ->get($this->_table)
            ->row_array();
    }

    public function insert($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)
            ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    public function delete($id,$data)
    {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
            ->where('status', 'Processing')
            ->update($this->_table, $data);
        return $this->db->affected_rows();
    }






    //* Customized Routines ** //

    public function invoice_payments($id, $invoice_type)
    {
        return $this->db->select('A.*, B.*') // Select the necessary fields from all tables
            ->from($this->_table . ' AS A')
            ->join('cashiering_invoice AS B', 'A.invoice_id = B.id', 'left')
            ->where('B.user_id', $id)
            ->where('B. transaction_category', $invoice_type)
            ->where('A.deleted_at IS NULL')
            ->where('B.deleted_at IS NULL')
            ->get()
            ->result_array(); // Use row_array() for a single row
    }

    public function update_status_invoice($id, $data)
    {
        $this->db->where('invoice_particulars_id', $id);
        $this->db->update($this->_table, $data);

        $affected_rows = $this->db->affected_rows();
        log_message('debug', 'Rows affected in update_status_invoice: ' . $affected_rows);

        return $affected_rows > 0;
    }

    public function get_by_invoice_id($id)
    {
        return $this->db->select('A.*, B.*,C.name') // Select fields from both tables
            ->from($this->_table . ' AS A')
            ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left') // Join condition
            ->join('items AS C', 'B.item_id = C.id', 'left') // Join condition
            ->where('A.deleted_at', null)
            ->where('B.deleted_at', null)
            ->where('C.deleted_at', null)
            ->where('B.cashiering_invoice_id', $id)
            ->get()
            ->row_array(); // Get the first result as an array
    }


    public function get_payment_proof($id)
    {
        $this->db->select(' A.*,B.cashiering_invoice_id')
            ->from($this->_table . ' AS A')
            ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left')
            ->join('cashiering_invoice AS C', 'B.cashiering_invoice_id = C.id', 'left')
            ->where('B.cashiering_invoice_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function get_by_receipt_num($id)
    {
        $query = $this->db->select('A.*, B.*, C.*,D.first_name,D.last_name, E.*, F.*, G.name')
            ->from($this->_table . ' AS A')
            ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left')
            ->join('cashiering_invoice AS C', 'B.cashiering_invoice_id = C.id')
            ->join('users AS D', 'C.user_id = D.id', 'left')
            ->join('billing_address AS E', 'C.billing_address_id = E.id', 'left')
            ->join('official_receipts  AS F', 'A.or_id = F.id', 'left')
            ->join('items AS G', 'B.item_id = G.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'D.deleted_at' => null,
                'F.deleted_at' => null,
                'A.or_id' => $id,
            ])
            ->get();

        // Return the result as an array of all rows
        return $query->result_array();
    }

    public function get_item_data($id)
    {
        $query = $this->db->select(
            'A.id,
             A.invoice_particulars_id,
             A.payment_date,A.transaction_category_id,A.status,
             A.total_payment,A.account_name,
             A.reference_number,A.account_number,A.payment_method_id,
             B.item_id,B.quantity,B.unit_cost,B.total_cost,
             D.invoice_number,D.user_id,
             C.name, C.cash_account_id,
             E.account_type_id'
        )
            ->from($this->_table . ' AS A')
            ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left')
            ->join('items AS C', 'B.item_id = C.id', 'left')
            ->join('cashiering_invoice AS D', 'B.cashiering_invoice_id = D.id', 'left')
            ->join('payment_methods AS E', 'A.payment_method_id = E.id', 'left')
            ->join('payment_options AS F', 'E.account_type_id = F.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'C.deleted_at' => null,
                'D.deleted_at' => null,
                'E.deleted_at' => null,
                'F.deleted_at' => null,
                'A.id  ' => $id,

            ])
            ->get();

        return $query->row_array();
    }

    public function get_by_user_id($id, $status)
    {
        $query = $this->db->select('A.*,
        B.item_id,B.quantity,B.unit_cost,B.total_cost,B.cashiering_invoice_id, 
        C.name, C.cash_account_id,D.id,D.invoice_number, D.user_id, D.status, F.official_receipt_number,G.financial_service_provider,H.payment_name')
            ->from($this->_table . ' AS A')
            ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left')
            ->join('items AS C', 'B.item_id = C.id', 'left')
            ->join('cashiering_invoice AS D', 'B.cashiering_invoice_id = D.id', 'left')
            ->join('or_particulars AS E', 'A.or_particulars_id = E.id', 'left')
            ->join('official_receipts AS F', 'E.receipt_id = F.id', 'left')
            ->join('payment_methods AS G', 'A.payment_method_id = G.id', 'left')
            ->join('payment_options AS H', 'G.account_type_id = H.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'C.deleted_at' => null,
                'D.deleted_at' => null,
                'E.deleted_at' => null,
                'F.deleted_at' => null,
                'G.deleted_at' => null,
                'H.deleted_at' => null,
                'D.user_id  ' => $id,
                'A.status' => $status

            ])
            ->get();

        return $query->row_array();
    }

   public function get_by_id($id, $status)
    {
        $query = $this->db->select('A.id,A.invoice_particulars_id
        ,A.payment_date,A.payment_proof,A.details
        ,A.payment_method_id,A.total_payment,A.created_at,
        B.item_id,B.quantity,B.unit_cost,B.total_cost,B.cashiering_invoice_id, 
        C.name, C.cash_account_id,D.id,D.invoice_number, D.user_id, D.status, F.official_receipt_number,G.transaction_name,H.financial_service_provider,H.type')
            ->from($this->_table . ' AS A')
            ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left')
            ->join('items AS C', 'B.item_id = C.id', 'left')
            ->join('cashiering_invoice AS D', 'B.cashiering_invoice_id = D.id', 'left')
            ->join('or_particulars AS E', 'A.or_particulars_id = E.id', 'left')
            ->join('official_receipts AS F', 'E.receipt_id = F.id', 'left')
            ->join('transaction_category AS G', 'A.transaction_category_id = G.id', 'left')
            ->join('payment_methods AS H', 'A.payment_method_id = H.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'C.deleted_at' => null,
                'D.user_id  ' => $id,
                'A.status' => $status

            ])
            ->get();

        return $query->result_array();
    }
    public function _get_receipt_details($id)
    {
        $query = $this->db->select('A.payment_date,
        A.details,A.payment_proof,A.status,A.reference_number,A.account_number,A.account_name,A.total_payment,
        B.invoice_number,B.quantity,B.unit_cost,B.total_cost,
        C.official_receipt_number,C.payment_date,C.processed_by,
        F.name,F.unit,
        G.street_address,G.municipality,G.billing_email,G.mobile_number,G.province,
        H.first_name,H.last_name,I.financial_service_provider')
            ->from($this->_table . ' AS A')
            ->join('or_particulars AS B', 'A.or_particulars_id = B.id', 'left')
            ->join('official_receipts AS C', 'B.receipt_id = C.id', 'left')
            ->join('items AS F', 'B.item_id = F.id', 'left')
            ->join('billing_address AS G', 'C.billing_address_id = G.id', 'left')
            ->join('users AS H', 'C.user_id = H.id', 'left')
            ->join('payment_methods AS I', 'A.payment_method_id = I.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'C.deleted_at' => null,
                'F.deleted_at' => null,
                'H.deleted_at' => null,
                'B.receipt_id' => $id,
            ])
            ->get();

        // Return the result as an array of all rows
        return $query->result_array();
    }



    public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL)
    {
        $this->db->select('A.*, B.cashiering_invoice_id, B.item_id, C.user_id, C.billing_address_id, 
                           D.first_name, D.last_name, E.financial_service_provider')
                 ->from($this->_table . ' AS A')  // Main table
                 ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left')
                 ->join('cashiering_invoice AS C', 'B.cashiering_invoice_id = C.id', 'left')
                 ->join('users AS D', 'C.user_id = D.id', 'left')
                 ->join('payment_methods AS E', 'A.payment_method_id = E.id', 'left')

                 ->where([
                     'A.deleted_at' => null,
                     'B.deleted_at' => null,
                     'C.deleted_at' => null,
                     'D.deleted_at' => null,
                     'E.deleted_at' => null,
                    //  'A.status' => 'pending'
                 ]);
    
        // Apply search filter if available
        if (!empty($filters['search'])) {
            $this->db->group_start();  // Open group condition for search filters
            $this->db->like('A.payment_date', $filters['search']);
            $this->db->or_like('D.first_name', $filters['search']);
            $this->db->or_like('D.last_name', $filters['search']);
            $this->db->group_end();  // Close group condition for search filters
        }
    
        if (isset($filters['user_id']) && $filters['user_id']) {
            $this->db->where('C.user_id', $filters['user_id']);
        }

        if (isset($filters['status']) && $filters['status']) {
            $this->db->where('A.status', $filters['status']);
        }


        // Apply ordering if necessary
        if (isset($order) && !empty($order)) {
            $column = $order[0]['column'];
            $dir = $order[0]['dir'];
            $this->db->order_by($column, $dir);
        }
    
        // Apply pagination if necessary
        if (isset($start) && isset($length) && $length > 0) {
            $this->db->limit($length, $start);
        }
    
        // Execute the query and return the results
        $query = $this->db->get();
        return $query->result();
    }
    

    public function count_all()
    {
        return $this->db->count_all($this->_table);
    }

    public function count_filtered($filters = NULL)
    {
        $query = $this->db->select('A.*,
        B.cashiering_invoice_id,B.item_id,
        C.user_id, C.billing_address_id,
        D.first_name,D.last_name,
        E.financial_service_provider')

            ->from($this->_table . ' AS A')  // Define the main table
            ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left')
            ->join('cashiering_invoice AS C', 'B.cashiering_invoice_id = C.id', 'left')
            ->join('users AS D', 'C.user_id = D.id', 'left')
            ->join('payment_methods AS E', 'A.payment_method_id = E.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'C.deleted_at' => null,
                'D.deleted_at' => null,
                'E.deleted_at' => null,
                'A.status' => 'pending'

            ]);




        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('A.payment_date', $filters['search']);
                $this->db->or_like('D.first_name', $filters['search']);
                $this->db->or_like('D.last_name', $filters['search']);
                $this->db->group_end();
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }


    public function get_all_records($filters = NULL, $order = NULL, $start = NULL, $length = NULL)
    {

        $query = $this->db->select('A.*,
        B.cashiering_invoice_id,B.item_id,
        C.user_id, C.billing_address_id,C.transaction_category_id,
        D.first_name,D.last_name,
       ,E.financial_service_provider,F.transaction_name,G.receipt_id,H.user_id,H.id')
            ->from($this->_table . ' AS A')  // Define the main table
            ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left')
            ->join('cashiering_invoice AS C', 'B.cashiering_invoice_id = C.id', 'left')
            ->join('users AS D', 'C.user_id = D.id', 'left')
            ->join('payment_methods AS E', 'A.payment_method_id = E.id', 'left')
            ->join('transaction_category AS F', 'A.transaction_category_id = F.id OR C.transaction_category_id = F.id', 'left')
            ->join('or_particulars AS G', 'A.or_particulars_id = G.id', 'left')
            ->join('official_receipts AS H', 'G.receipt_id = H.id', 'left')

            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'C.deleted_at' => null,
                'D.deleted_at' => null,
                'E.deleted_at' => null,
                'F.transaction_name' => 'capital_contribution'

            ]);

        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start(); // Open bracket for group conditions
                $this->db->like('A.payment_date', $filters['search']);
                $this->db->or_like('D.first_name', $filters['search']);
                $this->db->or_like('D.last_name', $filters['search']);
                $this->db->group_end(); // Close bracket
            }
        }

        if (isset($filters['user_id']) && $filters['user_id']) {
            $this->db->where('C.user_id', $filters['user_id']);
            $this->db->or_where('H.user_id', $filters['user_id']);
        }



        // Order by
        if (isset($order)) {
            $column = $order[0]['column'];
            $dir = $order[0]['dir'];
            $this->db->order_by($column, $dir);
        }

        // Pagination
        if (isset($start) && isset($length) && $length > 0) {
            $this->db->limit($length, $start);
        }

        $query = $this->db->get();
        return $query->result();
    }


    public function count_all_record()
    {
        return $this->db->count_all($this->_table);
    }

    public function count_filtered_record($filters = NULL)
    {
        $query = $this->db->select('A.*,
        B.cashiering_invoice_id,B.item_id,
        C.user_id, C.billing_address_id,
        D.first_name,D.last_name,
        E.financial_service_provider')

            ->from($this->_table . ' AS A')  // Define the main table
            ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left')
            ->join('cashiering_invoice AS C', 'B.cashiering_invoice_id = C.id', 'left')
            ->join('users AS D', 'C.user_id = D.id', 'left')
            ->join('payment_methods AS E', 'A.payment_method_id = E.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'C.deleted_at' => null,
                'D.deleted_at' => null,
                'E.deleted_at' => null,
                'A.status' => 'pending'

            ]);




        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('A.payment_date', $filters['search']);
                $this->db->or_like('D.first_name', $filters['search']);
                $this->db->or_like('D.last_name', $filters['search']);
                $this->db->group_end();
            }
        }

        if (isset($filters['user_id']) && $filters['user_id']) {
            $this->db->where('C.user_id', $filters['user_id']);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
}
?>