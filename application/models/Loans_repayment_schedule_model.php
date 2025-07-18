
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loans_repayment_schedule_model extends CI_Model
{

    protected $_table = 'loan_repayment_schedules';

    public function get_all()
    {
        return $this->db->where('deleted_at', null)
            ->get($this->_table)
            ->result_array();
    }

    public function get($id)
    {
        return $this->db->where('id', $id)
            ->where('deleted_at', null)
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
            ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    /** Customized Routines */

    public function get_by_user_id($id)
    {
        $query = $this->db->select('A.*,B.member_id,B.loan_amount,B.member_id')
            ->from($this->_table . ' AS A')
            ->join('loans AS B', 'A.loan_id = B.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'B.member_id' => $id,
                
        
            ])
            ->get();

        return $query->result_array();
    }

    // for revision
    public function pending_loan_repayment($member_id, $id) {
        $this->db->select([ 'lr.id',   'lr.loan_id','lr.due_date','lr.amount_due','lr.status','l.member_id'])
        ->from($this->_table . ' AS lr') 
        ->join('loans AS l', 'lr.loan_id = l.id', 'INNER') 
        ->where('lr.deleted_at', null)
        ->where('l.deleted_at', null)
        ->where('l.member_id', $member_id)
        ->where('lr.id', $id)
        ->order_by('lr.due_date', 'ASC');
    
        $query = $this->db->get();
        return $query->num_rows() > 0 ? $query->row_array() : [];
    }

    
    
    public function get_last_sequence($yearMonth)
    {
        $query = "SELECT MAX(SUBSTRING(loan_reference_number, -4)) AS last_sequence
              FROM loans
              WHERE loan_reference_number LIKE 'LN-{$yearMonth}%'";

        $result = $this->db->query($query)->row();

        return $result ? (int)$result->last_sequence : 0;
    }

    public function get_with_filters($filters = array())
    {
        $this->db->from($this->_table)
            ->where('deleted_at', null);

        if (!empty($filters)) {
            if (isset($filters['status'])) {
                $this->db->where('status', $filters['status']);
            }
        }

        return $this->db->get()->result_array();
    }

    public function get_loan_info($id)
    {
        $this->db->select('A.*,B.member_id');
        $this->db->order_by('id', 'ASC');
        $this->db->from($this->_table . ' AS A');
        $this->db->join('loans AS B', 'A.loan_id = B.id', 'left');
        $this->db->where('B.member_id', $id);
        $this->db->where('A.deleted_at', null);
        $this->db->where('B.deleted_at', null);
    
        return $this->db->get($this->_table)->row_array();  // Ensure the result is returned
    }
    

    public function list_by_member($id)
    {
        return $this->db->where('deleted_at', null)
            ->where('member_id', $id)
            ->get($this->_table)
            ->result_array();
    }


    public function get_by_member($id)
    {
        return $this->db->where('deleted_at', null)
            ->where('member_id', $id)
            ->get($this->_table)
            ->row_array();
    }

    /** Customized Routines */

    public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL)
    {
        $this->db->select('A.*,B.member_id');
        $this->db->from($this->_table . ' AS A');
        $this->db->join('loans AS B', 'A.loan_id = B.id', 'left');
        $this->db->join('members AS C', 'B.member_id = C.id', 'left');
        $this->db->where('A.deleted_at', null);
        $this->db->where('B.deleted_at', null);
        $this->db->where('C.deleted_at', null);


        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->or_like('A.amount_due', $filters['search']);
                $this->db->or_like('A.status', $filters['search']);
                $this->db->or_like('A.loan_id', $filters['search']);
                $this->db->group_end();
            }
        }

        if (isset($filters['status']) && $filters['status']) {
            $this->db->where('A.status', $filters['status']);
        }
        
        if (isset($filters['user_id']) && $filters['user_id']) {
            $this->db->where('C.user_id', $filters['user_id']);
        }

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
        $this->db->select('A.*,B.member_id,C.user_id');
        $this->db->from($this->_table . ' AS A');
        $this->db->join('loans AS B', 'A.loan_id = B.id', 'left');
        $this->db->join('members AS C', 'B.member_id = C.id', 'left');
        $this->db->where('A.deleted_at', null);
        $this->db->where('B.deleted_at', null);
        $this->db->where('C.deleted_at', null);


        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->or_like('A.amount_due', $filters['search']);
                $this->db->or_like('A.status', $filters['search']);
                $this->db->or_like('A.loan_id', $filters['search']);
                $this->db->group_end();
            }
        }

        if (isset($filters['status']) && $filters['status']) {
            $this->db->where('A.status', $filters['status']);
        }
        
        if (isset($filters['user_id']) && $filters['user_id']) {
            $this->db->where('C.user_id', $filters['user_id']);
        }
        // Pagination
        if (isset($start) && isset($length) && $length > 0) {
            $this->db->limit($length, $start);
        }

        $query = $this->db->get();

        return $query->num_rows();
    }
}
?>