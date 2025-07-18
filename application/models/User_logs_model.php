
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_logs_model extends CI_Model {

    protected $_table = 'user_logs';

    protected $user ='users';

    public function get($id) {
        return $this->db->where('id', $id)
                        ->get($this->_table)
                        ->row_array();
    }

    public function get_logs_by_user_id($user_id) {
        return $this->db->select('A.*, B.*')
                        ->from('user_logs AS A')
                        ->join('users AS B', 'A.user_id = B.id', 'inner')
                        ->where('A.user_id', $user_id)
                        ->where('A.deleted_at', null)
                        ->get()
                        ->result_array();
    }


    public function insert($data) {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id)
                ->where('status', 'Processing')
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function delete($id,$data) {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
                ->where('status', 'Processing')
                ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function get_by_user($id) {
        return $this->db->where('user_id', $id)
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