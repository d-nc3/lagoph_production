
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capital_contributions_model extends CI_Model {

    protected $_table = 'capital_contributions';

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

    public function get_by_user_id($id) {
        return $this->db->where('user_id', $id)
                        ->where('deleted_at', null)
                        ->get($this->_table)
                        ->row_array();
    }



    
    public function insert($data) {
        // Validate the data if needed (optional)
        if (empty($data)) {
            throw new Exception('Data to insert cannot be empty.');
        }
    
        // Insert the data into the table
        $this->db->insert($this->_table, $data);
    
        // Check for any database errors
        if ($this->db->affected_rows() > 0) {
            // Return the insert ID of the newly created record
            return $this->db->insert_id();
        } else {
            // Retrieve the last database error and throw an exception
            $error = $this->db->error();
            throw new Exception('Failed to insert data: ' . $error['message']);
        }
    }

    public function update($id, $data) {
        $this->db->where('id', $id)
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    public function delete($id) {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
                ->where('status', 'Processing')
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function get_by_user($id) {
        return $this->db->where('user_id', $id)
                        ->where('deleted_at', null)
                        ->where('status', 'pending')
                        ->get($this->_table)
                        ->row_array();
    }

    public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL) {
        $this->db->select('*');
        $this->db->from($this->_table);
   
        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                    $this->db->like('subscribed_amount', $filters['search']);
                 
                $this->db->group_end();
            }
            
            // if (isset($filters['sex']) && $filters['sex']) {
            //     $this->db->where('sex', $filters['sex']);
            // }

            // if (isset($filters['civil_status']) && $filters['civil_status']) {
            //     $this->db->where('civil_status', $filters['civil_status']);
            // }

            // if (isset($filters['place_of_birth']) && $filters['place_of_birth']) {
            //     $this->db->where('place_of_birth', $filters['place_of_birth']);
            // }
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

    public function count_all_record() {
        return $this->db->count_all($this->_table);
    }

    public function count_filtered_record($filters = NULL) {
        $this->db->select('*');
        $this->db->from($this->_table);
       

        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('subscribed_amount', $filters['search']);
                // $this->db->or_like('middle_name', $filters['search']);
                // $this->db->or_like('last_name', $filters['search']);
                // $this->db->or_like('reference_number', $filters['search']);
                // $this->db->or_like('mobile_number', $filters['search']);
                // $this->db->or_like('email', $filters['search']);
                $this->db->group_end();
            }
            
            // if (isset($filters['sex']) && $filters['sex']) {
            //     $this->db->where('sex', $filters['sex']);
            // }

            // if (isset($filters['civil_status']) && $filters['civil_status']) {
            //     $this->db->where('civil_status', $filters['civil_status']);
            // }

            // if (isset($filters['place_of_birth']) && $filters['place_of_birth']) {
            //     $this->db->where('place_of_birth', $filters['place_of_birth']);
            // }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

}
?>