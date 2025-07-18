
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashiering_invoice_model extends CI_Model {

    protected $_table = 'cashiering_invoice';

    public function get_all() {
        return $this->db->where('deleted_at', null)
                        ->where('status', 'Processing')
                        ->get($this->_table)
                        ->result_array();
    }

    public function get($id) {
        return $this->db->where('deleted_at', null)
                        ->where('id',$id)
                        ->get($this->_table)
                        ->row_array();
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

    public function delete($id) {
        $this->db->where('id', $id)
                ->where('status', 'Processing')
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    // Customized Routines // 
    public function get_by_user($id) {
        return $this->db->where('user_id', $id)
                        ->where('deleted_at', null)
                        ->get($this->_table)
                        ->row_array();
    }
    
    public function get_by_invoice_num($num) {
        return $this->db->where('invoice_number', $num)
                        ->where('deleted_at', null)
                        ->get($this->_table)
                        ->row_array();
    }
    
  public function get_invoice_id($id) {
    // Build the query
    $query = $this->db->select('A.*, B.transaction_name, B.description')
                      ->from($this->_table . ' AS A')
                      ->join('invoice_types AS B', 'A.invoice_type_id = B.id', 'left')
                      ->where([
                          'A.deleted_at' => null,
                          'A.id' => $id
                      ])
                      ->get(); // Execute the query

    // Return the result as an array
    return $query->row_array();
}

    public function get_by_type($id , $type) { 
        return $this->db->where('user_id', $id)
        ->where('deleted_at', null)
        ->where('transaction_category_id', $type)
        ->get($this->_table)
        ->row_array();
    }


 
    public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('status', 'Processing');

        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                    $this->db->like('first_name', $filters['search']);
                    $this->db->or_like('middle_name', $filters['search']);
                    $this->db->or_like('last_name', $filters['search']);
                    $this->db->or_like('reference_number', $filters['search']);
                    $this->db->or_like('mobile_number', $filters['search']);
                    $this->db->or_like('email', $filters['search']);
                $this->db->group_end();
            }
            
            if (isset($filters['sex']) && $filters['sex']) {
                $this->db->where('sex', $filters['sex']);
            }

            if (isset($filters['civil_status']) && $filters['civil_status']) {
                $this->db->where('civil_status', $filters['civil_status']);
            }

            if (isset($filters['place_of_birth']) && $filters['place_of_birth']) {
                $this->db->where('place_of_birth', $filters['place_of_birth']);
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
        return $this->db->where('status', 'Processing')->count_all($this->_table);
    }

    public function count_filtered($filters = NULL) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('status', 'Processing');

        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                    $this->db->like('first_name', $filters['search']);
                    $this->db->or_like('middle_name', $filters['search']);
                    $this->db->or_like('last_name', $filters['search']);
                    $this->db->or_like('reference_number', $filters['search']);
                    $this->db->or_like('mobile_number', $filters['search']);
                    $this->db->or_like('email', $filters['search']);
                $this->db->group_end();
            }
            
            if (isset($filters['sex']) && $filters['sex']) {
                $this->db->where('sex', $filters['sex']);
            }

            if (isset($filters['civil_status']) && $filters['civil_status']) {
                $this->db->where('civil_status', $filters['civil_status']);
            }

            if (isset($filters['place_of_birth']) && $filters['place_of_birth']) {
                $this->db->where('place_of_birth', $filters['place_of_birth']);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

}
?>