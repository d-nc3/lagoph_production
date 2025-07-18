
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model {

        protected $_table = 'employees';
        protected $departments = 'departments';
        protected $positions = 'positions';
        protected $units = 'units';
        protected $logs = 'user_logs';
  

        public function get_all() {
            return $this->db->select('A.*, B.position_title, C.unit_name, D.department_name')
                            ->from($this->_table . ' AS A')
                            ->join('positions AS B', 'A.position_id = B.id', 'inner')
                            ->join('units AS C', 'B.unit_id = C.id', 'inner')
                            ->join('departments AS D', 'C.department_id = D.id', 'inner')
                            ->where('A.deleted_at', null)
                            ->where('B.deleted_at', null)
                            ->where('C.deleted_at', null)
                            ->where('D.deleted_at', null)
                            ->get()
                            ->result_array();
        }
        
        
  

        public function get($id) {
            return $this->db->where('id', $id)
                            ->where('deleted_at', null)
                            ->get($this->_table)
                            ->row_array();
        }

        public function get_user_id($id) {
            return $this->db->select('A.*, B.position_title')
            ->from($this->_table . ' AS A')
            ->join('positions AS B', 'A.position_id = B.id', 'left outer')
            ->where('A.user_id',$id)   
            ->where('A.deleted_at', null)
            ->where('B.deleted_at', null)
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

        public function delete($id, $data) {
            // Soft delete by updating 'deleted_at' timestamp
            $this->db->where('id', $id)
                    ->where('deleted_at', null)
                    ->update($this->_table, $data);
            return $this->db->affected_rows();
        }

   

 
        public function get_employee_by_name($modal_first_name, $modal_last_name) {
            $query = $this->db->where('first_name', $modal_first_name)
                            ->where('last_name', $modal_last_name)
                            ->where('deleted_at', null)
                            ->get($this->_table);
        
            return $query->num_rows() > 0;
        }

        
        public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL) {
            $this->db->select('A.* , B.position_title , C.unit_name, D.department_name');
            $this->db->from($this->_table . ' AS A' );
            $this->db->join('positions AS B', 'A.position_id = B.id', 'inner' );
            $this->db->join('units AS C', 'B.unit_id = C.id', 'inner' );
            $this->db->join('departments AS D', 'C.department_id = D.id', 'inner' );
            $this->db->where('A.deleted_at',null);
            $this->db->where('B.deleted_at',null);
            $this->db->where('C.deleted_at',null);
            $this->db->where('D.deleted_at',null);
           

            // Initialize filter
            if (!empty($filters)) {
                
                if (isset($filters['search']) && $filters['search']) {
                    $this->db->group_start();
                    $this->db->like('A.first_name', $filters['search']);
                    $this->db->or_like('A.last_name', $filters['search']);
                    $this->db->or_like('A.middle_name', $filters['search']);
                    $this->db->or_like('A.date_of_birth', $filters['search']);
                    $this->db->or_like('A.sex', $filters['search']);
                    $this->db->or_like('A.mobile_number', $filters['search']);
                    $this->db->or_like('A.email', $filters['search']);
                    $this->db->or_like('A.date_hired', $filters['search']);
                    $this->db->or_like('A.status', $filters['search']);
                    $this->db->or_like('B.position_title', $filters['search']);
                    $this->db->or_like('C.unit_name', $filters['search']);
                    $this->db->or_like('D.department_name', $filters['search']);
                    $this->db->group_end();
                }
                
                if (isset($filters['department_id']) && $filters['department_id']) {
                    $this->db->where('D.id', $filters['department_id']);
                }

                if (isset($filters['unit_id']) && $filters['unit_id']) {
                    $this->db->where('C.id', $filters['unit_id']);
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
            $this->db->select('A.* , B.position_title , C.unit_name, D.department_name');
            $this->db->from($this->_table . ' AS A' );
            $this->db->join('positions AS B', 'A.position_id = B.id', 'inner' );
            $this->db->join('units AS C', 'B.unit_id = C.id', 'inner' );
            $this->db->join('departments AS D', 'C.department_id = D.id', 'inner' );
            $this->db->where('A.deleted_at',null);
            $this->db->where('B.deleted_at',null);
            $this->db->where('C.deleted_at',null);
            $this->db->where('D.deleted_at',null);

            // Initialize filter
            if (!empty($filters)) {
                if (isset($filters['search']) && $filters['search']) {
                   
                    if (isset($filters['search']) && $filters['search']) {
                        $this->db->group_start();
                        $this->db->like('A.first_name', $filters['search']);
                        $this->db->or_like('A.last_name', $filters['search']);
                        $this->db->or_like('A.middle_name', $filters['search']);
                        $this->db->or_like('A.date_of_birth', $filters['search']);
                        $this->db->or_like('A.sex', $filters['search']);
                        $this->db->or_like('A.mobile_number', $filters['search']);
                        $this->db->or_like('A.email', $filters['search']);
                        $this->db->or_like('A.date_hired', $filters['search']);
                        $this->db->or_like('A.status', $filters['search']);
                        $this->db->or_like('B.position_title', $filters['search']);
                        $this->db->or_like('C.unit_name', $filters['search']);
                        $this->db->or_like('D.department_name', $filters['search']);
                        
                        $this->db->group_end();
                    }
                   
                }
                
                if (isset($filters['department_id']) && $filters['department_id']) {
                    $this->db->where('D.id', $filters['department_id']);
                }

                if (isset($filters['unit_id']) && $filters['unit_id']) {
                    $this->db->where('C.id', $filters['unit_id']);
                }

              
            }

            $query = $this->db->get();
            return $query->num_rows();

        }
}


?>