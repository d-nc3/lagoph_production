<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class User_referrals_model extends CI_Model {



    protected $_table = 'user_referrals';



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

                 ->update($this->_table, $data);

        return $this->db->affected_rows();

    }

    public function updateByUserId($id,$data){
        $this->db->where('to_user_id', $id)
         ->update($this->_table,$data);
         return $this->db->affected_rows();
    }



    public function delete($id,$data) {

        // Soft delete by updating 'deleted_at' timestamp

        $this->db->where('id', $id)

                 ->update($this->_table, $data);

        return $this->db->affected_rows();

    }



    public function get_by_code($code) {

        return $this->db->where('code', $code)

                        ->where('deleted_at', null)

                        ->where('status', 'available')

                        ->get($this->_table)

                        ->row_array();

    }



    public function is_referral_code_available($code) {



        $query   = $this->db->where('code', $code)

                        ->where('status', 'available')

                        ->where('deleted_at', null)

                        ->get($this->_table);



        return $query->num_rows() > 0;

    }





    // customize routines



    public function get_code($id){

    return $this->db->where('from_user_id', $id)

    ->where('status','available')

                ->get($this->_table)

                ->row_array();

    }


    public function from_user_id($id){

    return $this->db->where('to_user_id', $id)
                ->get($this->_table)

                ->row_array();

    }




    public function get_all_filtered($filters = NULL, $order = NULL, $start = NULL, $length = NULL){

        $this->db->select('A.from_user_id,A.to_user_id,A.status,A.code,B.id,B.first_name,B.last_name,B.email');

        $this->db->from($this->_table . ' AS A ');

        $this->db->join('users AS B', 'A.to_user_id = B.id', 'left');

        $this->db->where([

            'A.deleted_at' => NULL,

            'B.deleted_at' => NULL,





        ]);

        // $this->db->where('A.to_user_id IS NOT NULL'); // Additional condition outside the array



        if(!empty($filters)){

            if (isset($filters['search']) && $filters['search']){

                $this->db->group_start();

                $this->db->like('B.first_name',$filters['search']);

                $this->db->or_like('B.last_name', $filters['search']);

                $this->db->or_like('B.to_user_id', $filters['search']);

                $this->db->group_end();

            }



            if (isset($filters['user_id']) && $filters['user_id']) {

                $this->db->where('A.from_user_id', $filters['user_id']);

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



    public function count_all(){

        return $this->db->count_all_results($this->_table);

    }



    public function count_filtered($filters = NULL) {

        $this->db->select('A.from_user_id,A.to_user_id,A.status,B.id,B.first_name,B.last_name');

        $this->db->from($this->_table . ' AS A ');

        $this->db->join('users AS B ', 'A.to_user_id = B.id', 'left');

        $this->db->where([

            'A.deleted_at' => NULL,

            'B.deleted_at' => NULL,

            'A.status'=> 'available'



        ]);

        $this->db->where('A.to_user_id IS NOT NULL'); // Additional condition outside the array



        if(!empty($filters)){

            if (isset($filters['search']) && $filters['search']){

                $this->db->group_start();

                    $this->db->like('B.first_name');

                    $this->db->or_like('B.last_name');

                    $this->db->or_like('B.id');

                    $this->db->group_end();

            }



            if (isset($filters['user_id']) && $filters['user_id']) {

                $this->db->where('A.from_user_id', $filters['user_id']);

            }



        }



        $query = $this->db->get();

        return $query->num_rows();

    }

}

?>

