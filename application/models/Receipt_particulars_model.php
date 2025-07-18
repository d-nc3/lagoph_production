
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receipt_particulars_model extends CI_Model
{

    protected $_table = 'or_particulars';
    protected $items = 'items';
    protected $users = 'users';
    protected $cash_accounts = 'cash_accounts';
    protected $billing_address = 'billing_address';




    public function get_all()
    {
        return $this->db->where('deleted_at', null)
            ->get($this->_table)
            ->result_array();
    }
    // for processing 
    public function get($id)
    {
        return $this->db->where('cashiering_invoice_id', $id)
            ->where('deleted_at', null)
            ->get($this->_table)
            ->row_array();
    }

    public function insert($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    // routine for invoice particulars
    public function update($id, $data)
    {
        $this->db->where('id', $id)
            ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    public function delete($id)
    {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
            ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    //** Customized Routines */

    public function get_by_receipt_num($id)
    {
        $query = $this->db->select('A.*, B.*,C.*')
            ->from($this->_table . ' AS A')
            ->join('official_receipts AS B', 'A.receipt_id = B.id', 'left')
            ->join('items AS C', 'A.item_id = C.id')
            ->join('users AS D', 'B.user_id = D.id', 'left')
            ->join('billing_address AS E', 'B.billing_address_id = E.id', 'left')

            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'C.deleted_at' => null,
                'B.user_id'   => $id,
            ])
            ->get();

        // Return the result as an array
        return $query->row_array();
    }





    public function get_by_user($id)
    {
        // Construct and execute the query
        $query = $this->db->select('A.*, B.*,C.*, D.*, E.id,E.first_name, E.last_name , F.code_of_cash_account,F.title')
            ->from($this->_table . ' AS A')
            ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
            ->join('billing_address AS C', 'B.billing_address_id = C.id', 'left')
            ->join('items AS D', 'A.item_id = D.id', 'left')
            ->join('users AS E', 'B.user_id = E.id', 'left')
            ->join('cash_accounts AS F', 'D.cash_account_id = F.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'D.deleted_at' => null,
                'E.deleted_at' => null,
                'F.deleted_at' => null,
                'B.user_id'    => $id,
            ])
            ->get();

        // Return the result as an array
        return $query->result_array();
    }

    public function get_by_type($id)
    {
        // Construct and execute the query
        $query = $this->db->select('A.*, B.*,C.*, D.*, E.id,E.first_name, E.last_name, F.code_of_cash_account,F.title')
            ->from($this->_table . ' AS A')
            ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
            ->join('billing_address AS C', 'B.billing_address_id = C.id', 'left')
            ->join('items AS D', 'A.item_id = D.id', 'left')
            ->join('users AS E', 'B.user_id = E.id', 'left')
            ->join('cash_accounts AS F', 'D.cash_account_id = F.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'D.deleted_at' => null,
                'E.deleted_at' => null,
                'F.deleted_at' => null,
                'B.user_id'    => $id,
            ])
            ->get();

        // Return the result as an array
        return $query->result_array();
    }


    //used in invoice (upload receipt)
    public function get_invoice_by_status($data)
    {
        $query = $this->db->select('A.*,B.invoice_number')
            ->from($this->_table . ' AS A')
            ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
            ->where('A.deleted_at IS NULL', null, false)  // Check for NULL properly
            ->where('B.deleted_at IS NULL', null, false)  // Check for NULL properly
            ->where('B.status', 'pending')
            ->where('B.invoice_number', $data)   // Check $data type/value
            ->get();

        return $query->row_array();  // Use row_array() if expecting only one row
    }


    public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL)
    {
        $this->db->select('A.*, B.*,C.*,D.first_name,D.last_name,D.email,F.transaction_name');
        $this->db->from($this->_table . ' AS A')  // Define the main table
            ->join('items AS B', 'A.item_id = B.id', 'left')
            ->join('official_receipts AS C', 'A.receipt_id = C.id', 'left')
            ->join('users AS D', 'C.user_id = D.id', 'left')
            ->join('billing_address AS E', 'C.billing_address_id= E.id', 'left')
            ->join('transaction_category AS F', 'C.transaction_category_id = F.id ', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'C.deleted_at' => null,
                'D.deleted_at' => null,


            ]);


        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('A.unit_cost', $filters['search']);
                $this->db->or_like('B.name', $filters['search']);

                $this->db->group_end();
            }

            if (!isset($filters['user_id']) || $filters['user_id'] === NULL  || $filters['user_id'] === '') {
                // No user_id filter applied, so it fetches all records.
            } else {
                $this->db->where('C.user_id', $filters['user_id']);
            }
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

    public function count_all()
    {
        return $this->db->count_all($this->_table);
    }


    public function count_filtered($filters = NULL)
    {
        $this->db->select('A.*, B.*,C.*,D.first_name,D.last_name,D.email,F.transaction_name');
        $this->db->from($this->_table . ' AS A')  // Define the main table
            ->join('items AS B', 'A.item_id = B.id', 'left')
            ->join('official_receipts AS C', 'A.receipt_id = C.id', 'left')
            ->join('users AS D', 'C.user_id = D.id', 'left')
            ->join('billing_address AS E', 'C.billing_address_id= E.id', 'left')
            ->join('transaction_category AS F', 'C.transaction_category_id = F.id ', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'C.deleted_at' => null,
                'D.deleted_at' => null,


            ]);


        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('A.unit_cost', $filters['search']);
                $this->db->or_like('B.name', $filters['search']);

                $this->db->group_end();
            }

            if (!isset($filters['user_id']) || $filters['user_id'] === NULL  || $filters['user_id'] === '') {
                // No user_id filter applied, so it fetches all records.
            } else {
                $this->db->where('C.user_id', $filters['user_id']);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
}

?>