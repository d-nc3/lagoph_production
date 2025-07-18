
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loans_model extends CI_Model
{

    protected $_table = 'loans';

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

    public function get_by_memberId($member_id){
         return $this->db->where('member_id', $member_id)
                ->get($this->_table)
                ->row_array();
    }


    /** Customized Routines */

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
        $this->db->select(
    '   A.id AS loan_id,
        A.member_id,
        A.loan_reference_number,
        A.disbursment_account_id,
        A.principal_with_interest,
        A.loan_amount,
        A.remaining_balance,
        A.loan_type,
        A.loan_status,
        A.loan_term,
        B.user_id,
        C.first_name,
        C.last_name,
        D.account_name,
        D.account_number,
        E.financial_service_provider');
        
        $this->db->from($this->_table . ' AS A');
        $this->db->join('members AS B', 'A.member_id = B.id', 'left');
        $this->db->join('users AS C', 'B.user_id = C.id', 'left');
        $this->db->join('financial_accounts AS D', 'A.disbursment_account_id = D.id', 'left');
        $this->db->join('payment_methods AS E', 'D.method_id = E.id', 'left');
        $this->db->where('A.member_id', $id);
        $this->db->where('A.deleted_at', null);
        $this->db->where('B.deleted_at', null);
        $this->db->where('C.deleted_at', null);
        $this->db->where('D.deleted_at', null);
        $this->db->where('E.deleted_at', null);
    
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
        $this->db->select('A.id,A.member_id , A.disbursment_account_id,A.loan_amount,A.loan_type,
        A.loan_status,A.loan_term,B.user_id,C.first_name,C.last_name');
        $this->db->from($this->_table . ' AS A');
        $this->db->join('members AS B', 'A.member_id = B.id', 'left');
        $this->db->join('users AS C', 'B.user_id = C.id', 'left');
        $this->db->where('A.deleted_at', null);
        $this->db->where('C.deleted_at', null);

        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('C.first_name', $filters['search']);
                $this->db->or_like('C.last_name', $filters['search']);
                $this->db->or_like('A.loan_amount', $filters['search']);
                $this->db->or_like('A.loan_status', $filters['search']);
                $this->db->or_like('A.member_id', $filters['search']);
                $this->db->group_end();
            }
        }

        if (isset($filters['loan_status']) && $filters['loan_status']) {
            $this->db->where('A.loan_status', $filters['loan_status']);
        }

        if (isset($filters['user_id']) && $filters['user_id']) {
            $this->db->where('B.user_id', $filters['user_id']);
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
        $this->db->select('A.id, A.member_id, A.disbursment_account_id,A.loan_amount,A.loan_type,A.loan_status,
        A.loan_term,B.user_id,C.first_name,C.last_name');
        $this->db->from($this->_table . ' AS A');
        $this->db->join('members AS B', 'A.member_id = B.id', 'left');
        $this->db->join('users AS C', 'B.user_id = C.id', 'left');
        $this->db->where('A.deleted_at', null);
        $this->db->where('B.deleted_at', null);
        $this->db->where('C.deleted_at', null);

        // Initialize filter
        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('C.first_name', $filters['search']);
                $this->db->or_like('C.last_name', $filters['search']);
                $this->db->or_like('A.loan_amount', $filters['search']);
                $this->db->or_like('A.loan_status', $filters['search']);
                $this->db->or_like('A.member_id', $filters['search']);
                $this->db->group_end();
            }
        }

        // Pagination
        if (isset($start) && isset($length) && $length > 0) {
            $this->db->limit($length, $start);
        }

         if (isset($filters['loan_status']) && $filters['loan_status']) {
            $this->db->where('A.loan_status', $filters['loan_status']);
        }

        if (isset($filters['user_id']) && $filters['user_id']) {
            $this->db->where('B.user_id', $filters['user_id']);
        }


        $query = $this->db->get();

        return $query->num_rows();
    }
}
?>