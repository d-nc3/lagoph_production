
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Financial_accounts_model extends CI_Model
{

    protected $_table = 'financial_accounts';

    public function get_all()
    {
        return $this->db->where('deleted_at', null)
            ->get($this->_table)
            ->result_array();
    }

    public function get($id)
    {
        return $this->db->where('member_id', $id)
            ->get($this->_table)
            ->result_array();
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
        $this->db->where('id', $id)
            ->where('deleted_at', null)
            ->update($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function get_by_user($id)
    {
        return $this->db->where('user_id', $id)
            ->where('deleted_at', null)
            ->get($this->_table)
            ->row_array();
    }
    public function get_account_number($acc_num)
    {
        return $this->db->where('account_number', $acc_num)
            ->get($this->_table)
            ->row_array();
    }

    public function get_id_method($id)
    {
        $this->db->select('A.*,B.financial_service_provider')
            ->from($this->_table . ' AS A')  // Ensure $this->table is defined
            ->join('payment_methods AS B', 'A.method_id = B.id', 'left')
            ->where('A.member_id', $id)
            ->where('A.deleted_at', NULL);

        $query = $this->db->get();

        return $query->result_array();
    }
}
?>