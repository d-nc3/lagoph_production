
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Official_receipts_model extends CI_Model {

    protected $_table = 'official_receipts';

    public function get_all() {
        return $this->db->where('deleted_at', null)
                        ->get($this->_table)
                        ->result_array();
    }

    public function get($id) {
        return $this->db->where('id', $id)
                        ->where('deleted_at', null)
                        ->get($this->_table)
                        ->row_array();
    }

    // public function get_by_user($id) {
    //     $query = $this->db->select('A.*, B.*,C.*, D.*, E.id, E.first_name, E.last_name')
    //                       ->from($this->_table . ' AS A')
    //                       ->join('invoice_particulars AS B', 'A.invoice_particulars_id = B.id', 'left')
    //                       ->join('cashiering_invoice AS C', 'B.cashiering_invoice_id = C.id','left')
    //                       ->join('items AS D', 'B.item_id = D.id', 'left')
    //                       ->join('users AS E', 'C.user_id = E.id', 'left')
    //                       ->where([
    //                           'A.deleted_at' => null,
    //                           'B.deleted_at' => null,
    //                           'D.deleted_at' => null,
    //                           'E.deleted_at' => null,
    //                           'C.user_id'    => $id,
    //                       ])
    //                       ->get();
    
    //     // Return the result as an array
    //     return $query->row_array();
    // }

 
    public function insert($data) { 
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id)
                ->where('deleted_at', null)
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

    public function get_by_name($name) {
        return $this->db->where('department_name', $name)
                        ->where('deleted_at', null)
                        ->get($this->_table)
                        ->row_array();
    }


//   public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL) {
//                     $this->db->select('A.*, B.*,C.*, D.*, E.*,F.*')
//                     ->from($this->_table . ' AS A')
//                     ->join('payment_records AS B', 'A.payment_record_id = B.id','left')
//                     ->join('invoice_particulars AS C', 'B.invoice_particulars_id = C.id')
//                     ->join('items AS D', 'C.item_id = D.id', 'left')
//                     ->join('cashiering_invoice AS E', 'C.cashiering_invoice_id = E.id', 'left')
//                     ->join('billing_address AS F' ,'E.billing_address_id = F.id', 'left')
//                     ->where([
//                         'A.deleted_at' => null,
//                         'B.deleted_at' => null,
//                         'D.deleted_at' => null,
//                         'E.deleted_at' => null,
                    
//                     ]);
        
      
//         // Initialize filter
//         if (!empty($filters)) {
//             if (isset($filters['search']) && $filters['search']) {
//                 $this->db->group_start();
//                 $this->db->like('A.official_receipt_number', $filters['search']);
//                 $this->db->or_like('D.item_id', $filters['search']);
//                 $this->db->or_like('E.invoice_number', $filters['search']);
//                 $this->db->group_end();
//             }
//         }
    
//         // Order by
//         if (isset($order)) {
//             $column = $order[0]['column'];
//             $dir = $order[0]['dir'];
//             $this->db->order_by($column, $dir);
//         }
    
//         // Pagination
//         if (isset($start) && isset($length) && $length > 0) {
//             $this->db->limit($length, $start);
//         }
    
//         $query = $this->db->get();
//         return $query->result();
//     }
    
//     public function count_all() {
//         return $this->db->count_all($this->_table);
//     }

//     public function count_filtered($filters = NULL) {
//         $this->db->select('A.*');
//         $this->db->from($this->_table . ' AS A');
       
            
//         if (!empty($filters)) {
//                 if (isset($filters['search']) && $filters['search']){
//                     $this->db->group_start();
//                     $this->db->like('A.official_receipt_number', $filters['search']);
//                     $this->db->or_like('D.item_id', $filters['search']);
//                     $this->db->or_like('C.invoice_number', $filters['search']);
//                 $this->db->group_end();
//                 }
//             }

//         $query = $this->db->get();
//         return $query->num_rows();
        

//     }
}

?>