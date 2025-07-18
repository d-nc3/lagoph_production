
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments_model extends CI_Model {

    protected $_table = 'departments';

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

      public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('deleted_at', null);

        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                    $this->db->like('department_name', $filters['search']);
                    $this->db->or_like('department_head', $filters['search']);
                    $this->db->or_like('description', $filters['search']);
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
        return $this->db->where('deleted_at', null)->count_all_results($this->_table);
    }

    public function count_filtered($filters = NULL) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('deleted_at', null);

        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                    $this->db->like('department_name', $filters['search']);
                    $this->db->or_like('department_head', $filters['search']);
                    $this->db->or_like('description', $filters['search']);
                $this->db->group_end();
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
}    
?>