
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_particulars_model extends CI_Model {

    protected $_table = 'invoice_particulars';
    protected $_cashiering_invoice = 'cashiering_invoice';
    protected $items ='items';
    protected $users = 'users';
    protected $cash_accounts = 'cash_accounts';
    protected $billing_address = 'billing_address';

  
    

    public function get_all() {
        return $this->db->select('A.*, B.*')
                        ->from($this->_table . ' AS A')
                        ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
                        ->where('A.deleted_at', null)
                        ->get()
                        ->result_array();
    }



    public function insert($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    // routine for invoice particulars
    public function update($id, $data) {
        $this->db->where('id', $id)
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    public function delete($id) {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    //** Customized Routines for CRUD Functions */

    public function get_by_user($id) {
        $query = $this->db->select('A.*,B.status,B.user_id,B.invoice_number,B.date_issued,B.processed_by,C.*,D.cash_account_id,D.name,D.description,D.unit,E.id, 
        E.first_name,E.last_name,E.email,F.code_of_cash_account,F.title,G.transaction_name')
        ->from($this->_table . ' AS A')
        ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
        ->join('billing_address AS C', 'B.billing_address_id = C.id','left')
        ->join('items AS D', 'A.item_id = D.id', 'left')
        ->join('users AS E', 'B.user_id = E.id', 'left')
        ->join('cash_accounts AS F', 'D.cash_account_id = F.id', 'left')
        ->join('transaction_category AS G', 'B.transaction_category_id = G.id', 'left')
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

    public function get_by_user_invoice_category($id,$category) {
        $query = $this->db->select('A.*,B.status,B.user_id,B.invoice_number,B.date_issued,B.processed_by,C.*,D.cash_account_id,D.name,D.description,D.unit,E.id, 
        E.first_name,E.last_name,E.email,F.code_of_cash_account,F.title,G.transaction_name')
        ->from($this->_table . ' AS A')
        ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
        ->join('billing_address AS C', 'B.billing_address_id = C.id','left')
        ->join('items AS D', 'A.item_id = D.id', 'left')
        ->join('users AS E', 'B.user_id = E.id', 'left')
        ->join('cash_accounts AS F', 'D.cash_account_id = F.id', 'left')
        ->join('transaction_category AS G', 'B.transaction_category_id = G.id', 'left')
        ->where([
            'A.deleted_at' => null,
            'B.deleted_at' => null,
            'D.deleted_at' => null,
            'E.deleted_at' => null,
            'F.deleted_at' => null,
            'B.user_id'    => $id,
            'B.transaction_category_id' => $category,
        ])
        ->get();

        // Return the result as an array
        return $query->row_array();
    }

    // for processing 
    public function get($id,$user_id) {
        $query = $this->db->select('A.*,B.status,B.user_id, B.invoice_number, B.date_issued, B.processed_by , C.*, D.cash_account_id, D.name, D.description, D.unit, E.id , E.first_name, E.last_name,E.email, F.code_of_cash_account,F.title, G.transaction_name')
        ->from($this->_table . ' AS A')
        ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
        ->join('billing_address AS C', 'B.billing_address_id = C.id','left')
        ->join('items AS D', 'A.item_id = D.id', 'left')
        ->join('users AS E', 'B.user_id = E.id', 'left')
        ->join('cash_accounts AS F', 'D.cash_account_id = F.id', 'left')
        ->join('transaction_category AS G', 'B.transaction_category_id = G.id', 'left')
        ->where([
            'A.deleted_at' => null,
            'B.deleted_at' => null,
            'D.deleted_at' => null,
            'E.deleted_at' => null,
            'F.deleted_at' => null,
            'B.id'    => $id,
            'B.user_id' => $user_id
        ])
        ->get();

        // Return the result as an array
        return $query->row_array();
    }
    

    //used in invoice (upload receipt)
    public function get_invoice_by_id($data) {
        $query = $this->db->select('A.*,B.invoice_number,B.user_id,B.transaction_category_id,C.transaction_name,D.name')
                          ->from($this->_table . ' AS A')
                          ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
                          ->join('transaction_category AS C', 'B.transaction_category_id = C.id', 'left')
                          ->join('items AS D', 'A.item_id = D.id', 'left')
                          ->where([
                            'A.deleted_at' => null,
                            'B.deleted_at' => null,
                            'D.deleted_at' => null,
                            'B.status' =>'pending',
                            'A.cashiering_invoice_id'=>$data
                            
                        
                        ])
                      
                          ->get();
        
        return $query->row_array();  // Use row_array() if expecting only one row
    }
 
        //used in invoice (upload receipt)
        public function get_invoice_by_status($data) {
            $query = $this->db->select('A.*,B.invoice_number,B.user_id,B.transaction_category_id,C.transaction_name,D.name')
                              ->from($this->_table . ' AS A')
                              ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
                              ->join('transaction_category AS C', 'B.transaction_category_id = C.id', 'left')
                              ->join('items AS D', 'A.item_id = D.id', 'left')
                              ->where([
                                'A.deleted_at' => null,
                                'B.deleted_at' => null,
                                'D.deleted_at' => null,
                                'B.status' =>'pending',
                                'B.invoice_number'=>$data
                                
                            
                            ])
                          
                              ->get();
            
            return $query->row_array();  // Use row_array() if expecting only one row
        }

    public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL) {
        $this->db->select('A.*, B.*,C.*, D.*, E.id,E.first_name, E.last_name,E.email,F.transaction_name');
        $this->db->from($this->_table . ' AS A')  // Define the main table
                    ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
                    ->join('billing_address AS C', 'B.billing_address_id = C.id','left')
                    ->join('items AS D', 'A.item_id = D.id', 'left')
                    ->join('users AS E', 'B.user_id = E.id', 'left')
                    ->join('transaction_category AS F', 'B.transaction_category_id = F.id', 'left')
                    ->where([
                        'A.deleted_at' => null,
                        'B.deleted_at' => null,
                        'D.deleted_at' => null,
                        'E.deleted_at' => null,
                        'B.status' => 'pending'
                        

                        
                    
                    ]);
        
             
        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('A.unit_cost', $filters['search']);
                $this->db->or_like('A.item_id', $filters['search']);
                $this->db->or_like('B.invoice_number', $filters['search']);
                $this->db->group_end();
            }
            
            if (isset($filters['user_id']) && $filters['user_id']) {
                $this->db->where('B.user_id', $filters['user_id']);
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
        return $this->db->count_all($this->_table);
    }

    public function count_filtered($filters = NULL) {
        $this->db->select('A.*, B.*,C.*, D.*, E.id,E.first_name, E.last_name, F.transaction_name');
        $this->db->from($this->_table . ' AS A')  // Define the main table
                    ->join('cashiering_invoice AS B', 'A.cashiering_invoice_id = B.id', 'left')
                    ->join('billing_address AS C', 'B.billing_address_id = C.id','left')
                    ->join('items AS D', 'A.item_id = D.id', 'left')
                    ->join('users AS E', 'B.user_id = E.id', 'left')
                    ->join('transaction_category AS F', 'B.transaction_category_id = F.id', 'left')
                    ->where([
                        'A.deleted_at' => null,
                        'B.deleted_at' => null,
                        'D.deleted_at' => null,
                        'E.deleted_at' => null,
                        
                    
                    ]);
            
        if (!empty($filters)) {
                if (isset($filters['search']) && $filters['search']){
                    $this->db->group_start();
                    $this->db->like('A.unit_cost', $filters['search']);
                    $this->db->or_like('A.item_id', $filters['search']);
                    $this->db->or_like('A.cashiering_invoice_id', $filters['search']);
                $this->db->group_end();
                }

                if (isset($filters['user_id']) && $filters['user_id']) {
                    $this->db->where('B.id', $filters['user_id']);
                }
            }

        $query = $this->db->get();
        return $query->num_rows();
        

    }
}

?>