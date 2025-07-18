
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_types_cash_account_model extends CI_Model {

    protected $_table = 'transaction_types_cash_account';

    public function get_all() {
        return $this->db->where('deleted_at', null)
                        ->get($this->_table)
                        ->result_array();
    }

   
    
    public function insert($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id)
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function delete($id, $data) {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
                ->where('deleted_at', null)
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    //** Customized Routines for transaction cash account */

    public function get($id) {
        $this->db->select('A.*, B.transaction_name, B.description, C.code_of_cash_account, C.title');
        $this->db->from($this->_table . ' AS A')
                 ->join('transaction_types AS B', 'A.transaction_type_id = B.id', 'left')
                 ->join('cash_accounts AS C', 'A.cash_account_id = C.id', 'left')
                 ->where([
                     'A.id'=> $id,
                     'B.deleted_at' => null,
                     'C.deleted_at' => null
                 ]);
        
        return $this->db->get()->row_array();
    }

    public function get_debit_transaction($data) {
        $result = $this->db->select('id')
                           ->where('transaction_type_id', $data)
                           ->where('account_type','debit')
                           ->get($this->_table)
                           ->row_array(); // Fetch a single row as an associative array
    
        return $result ? $result['id'] : null; // Return only the 'id' or null if not found
    }

    public function get_credit_transaction($data) {
        $result = $this->db->select('id')
                           ->where('transaction_type_id', $data)
                           ->where('account_type','credit')
                           ->get($this->_table)
                           ->row_array(); // Fetch a single row as an associative array
    
        return $result ? $result['id'] : null; // Return only the 'id' or null if not found
    }
    

   

    public function get_by_id($id) {
        $this->db->select('A.*, B.*, C.*');
        $this->db->from($this->_table . ' AS A')
                 ->join('transaction_types AS B', 'A.transaction_type_id = B.id', 'left')
                 ->join('cash_accounts AS C', 'A.cash_account_id = C.id', 'left')
                 ->where([
                     'B.deleted_at' => null,
                     'C.deleted_at' => null
                 ]);
        
        return $this->db->get()->row_array();
    }

    public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL) {
        $this->db->select('A.*,B.transaction_name, B.description ,C.title, C.code_of_cash_account');
        $this->db->from($this->_table . ' AS A')
                ->join('transaction_types AS B', 'A.transaction_type_id = B.id','left')
                ->join('cash_accounts AS C', 'A.cash_account_id = C.id','left')
                ->where([
                    'B.deleted_at' => null,
                    'C.deleted_at' => null,
                 
                ]);
        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                    $this->db->like('B.transaction_name', $filters['search']);
                    $this->db->or_like('B.description', $filters['search']);
                    $this->db->or_like('C.code_of_cash_account', $filters['search']);   
                    $this->db->or_like('C.title', $filters['search']);   
                   
                $this->db->group_end();
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

    public function count_all() {
        return $this->db->count_all_results($this->_table);
    }

    public function count_filtered($filters = NULL) {
        $this->db->select('A.*,B.*,C.*');
        $this->db->from($this->_table . ' AS A')
                ->join('transaction_types AS B', 'A.transaction_type_id = B.id','left')
                ->join('cash_accounts AS C', 'A.cash_account_id = C.id','left')
                ->where([
                   
                    'B.deleted_at' => null,
                    'C.deleted_at' => null,
                 
                
                ]);


        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('B.transaction_name', $filters['search']);
                $this->db->or_like('B.description', $filters['search']);
                $this->db->or_like('C.code_of_cash_account', $filters['search']);   
                $this->db->or_like('C.title', $filters['search']); 
                $this->db->group_end();
            }

            
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
}    
?>