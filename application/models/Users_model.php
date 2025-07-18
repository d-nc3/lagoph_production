<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Users_model extends CI_Model
{



    protected $_table = 'users';



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



    public function get_by_role($id)
    {



        return $this->db->where('deleted_at', null)

            ->where('id', $id)

            ->get($this->_table)

            ->result_array();

    }





    public function delete($id, $data)
    {

        // Soft delete by updating 'deleted_at' timestamp

        $this->db->where('id', $id)

            ->update($this->_table, $data);

        return $this->db->affected_rows();

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



    public function get_user_by_email($email)
    {

        return $this->db->where('email', $email)

            ->where('deleted_at', null)

            ->get($this->_table)

            ->row_array();



    }





    //** Customized Routines *//





    public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL)
{
    $this->db->select('A.*, B.status, B.date_issued');
    $this->db->from($this->_table . ' AS A');
    $this->db->join('cashiering_invoice AS B', 'B.user_id = A.id', 'left');

    $this->db->where([
        'A.deleted_at' => NULL,
        'B.deleted_at' => NULL,
    ]);

    // Search filter
    if (!empty($filters)) {
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('A.first_name', $filters['search']);
            $this->db->or_like('A.last_name', $filters['search']);
            $this->db->or_like('A.email', $filters['search']);
            $this->db->group_end();
        }

        if (!empty($filters['status'])) {
            $this->db->where('B.status', $filters['status']);
        }
    }

    // Ordering
    if (!empty($order)) {
        $this->db->order_by("B.status = 'payment-initiated'", 'DESC');
        $this->db->order_by('B.date_issued', 'DESC');

    } else {

         $columns = $order[0]['column'];
        $dir = $order[0]['dir'];
        if (isset($columns['column'])) {
            $this->db->order_by($columns['column'], $dir);
        }
    }

    // Pagination
    if (isset($start) && isset($length) && $length > 0) {
        $this->db->limit($length, $start);
    }

    return $this->db->get()->result();
}




    public function count_all()
    {

        return $this->db->count_all($this->_table);

    }



    public function count_filtered($filters = NULL)
    {
        $this->db->select('A.*,B.status,B.date_issued');
        $this->db->from($this->_table . ' AS A');
        $this->db->join('cashiering_invoice AS B', 'B.user_id = A.id', 'left');



        $this->db->where([
            'A.deleted_at' => NULL,
            'B.deleted_at' => NULL,
        ]);


        // Search filter
        if (!empty($filters)) {

            if (isset($filters['search']) && $filters['search']) {
                $this->db->group_start();
                $this->db->like('first_name', $filters['search']);
                $this->db->or_like('last_name', $filters['search']);
                $this->db->group_end();

            }

              if (isset($filters['status']) && $filters['status']) {

                $this->db->where('B.status', $filters['status']);

            }

        }

        if (isset($order)) {
            $column = $order[0]['column'];
            $dir = $order[0]['dir'];
            $this->db->order_by("B.status = 'payment-initiated'", 'DESC');
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