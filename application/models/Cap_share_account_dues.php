
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cap_share_account_dues extends CI_Model
{

    protected $_table = 'cap_share_account_dues';

    public function get_all()
    {
        return $this->db->where('deleted_at', null)
            ->where('status', 'pending')
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
    public function get_all_id($id)
    {
        return $this->db->where('capital_contribution_id', $id)
            ->where('deleted_at', null)
            ->get($this->_table)
            ->result_array();
    }

    public function get_cap_id($id)
    {
        return $this->db->where('deleted_at', null)
            ->where('capital_contribution_id', $id)
            ->get($this->_table)
            ->result_array();
    }

    public function get_by_user_id($id)
    {
        $query = $this->db->select('A.*, B.user_id,B.subscribed_amount,B.outstanding_balance,B.amount_per_share,B.amount,B.date_issued,B.date_paid')
            ->from($this->_table . ' AS A')
            ->join('capital_contributions AS B', 'A.capital_contribution_id = B.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
                'B.user_id' => $id,
                'A.status' => 'pending',
        
            ])
            ->get();

        return $query->result_array();
    }

    public function update_by_status($status,$data){
        $this->db->where('status' , $status)
                 ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    public function insert($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    public function update($id,$data)
    {
        $this->db->where('id', $id)
            ->update($this->_table, $data);
        return $this->db->affected_rows();
    }


    public function delete($id)
    {
        // Soft delete by updating 'deleted_at' timestamp
        $this->db->where('id', $id)
            ->where('status', 'Processing')
            ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    //*Customized Routines**//

 

    public function get_by_user($id)
    {
        return $this->db->where('user_id', $id)
            ->where('deleted_at', null)
            ->where('status', 'Processing')
            ->get($this->_table)
            ->row_array();
    }

 
    public function get_all_records($filters = NULL, $order = NULL, $start = NULL, $length = NULL)
    {
      
        $this->db->select('A.*,B.outstanding_balance,B.subscribed_amount')
            ->from($this->_table . ' AS A')
            ->join('capital_contributions AS B', 'A.capital_contribution_id = B.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
            ]);


        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('A.due_date', $filters['search']);
                $this->db->or_like('A.amount_due', $filters['search']);
                $this->db->group_end();
            }
        }

        if (isset($filters['user_id']) && $filters['user_id']) {
            $this->db->where('B.user_id', $filters['user_id']);
        }



        if (isset($order)) {
            $column = $order[0]['column'];
            $dir = $order[0]['dir'];
            $this->db->order_by($column, $dir);
        }


        if (isset($start) && isset($length) && $length > 0) {
            $this->db->limit($length, $start);
        }

        $query = $this->db->get();
        return $query->result();
    }


    public function count_all_record()
    {
        return $this->db->count_all($this->_table);
    }

    public function count_filtered_record($filters = NULL)
    {
        $this->db->select('A.*,B.subscribed_amount,B.outstanding_balance')
            ->from($this->_table . ' AS A')  // Define the main table
            ->join('capital_contributions AS B', 'A.capital_contribution_id = B.id', 'left')
            ->where([
                'A.deleted_at' => null,
                'B.deleted_at' => null,
            ]);

        if (!empty($filters)) {
            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('A.due_date', $filters['search']);
                $this->db->or_like('A.amount_due', $filters['search']);
                $this->db->group_end();
            }
        }
        if (isset($filters['user_id']) && $filters['user_id']) {
            $this->db->where('B.user_id', $filters['user_id']);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
}

?>