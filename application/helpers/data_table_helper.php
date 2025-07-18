<?php 

defined('BASEPATH') OR exit('No direct script access allowed');





if (!function_exists('get_datatable')) {

    function get_datatable($ci_instance, $model, $formatter, $custom_filters = []) {

        $search = $ci_instance->security->xss_clean($ci_instance->input->post('search'));
        $order = $ci_instance->security->xss_clean($ci_instance->input->post('order'));
        $start = $ci_instance->security->xss_clean($ci_instance->input->post('start'));
        $length = $ci_instance->security->xss_clean($ci_instance->input->post('length'));
        $draw = $ci_instance->security->xss_clean($ci_instance->input->post('draw'));


        $filters = $custom_filters;
        if (!empty($search['value'])) {
            $filters['search'] = $search['value'];
        }



        $list = $model->get_all_filtered($filters, $order, $start, $length);
        $users = array();
        $data = array();

        foreach ($list as $item) {

            if (isset($users[$item->id])) {
                continue; 
            }

            $data[] = $formatter($item);
            $users[$item->id] = true;

        }
        // Output structure for DataTables

        return array(

            "draw" => $draw,
            "recordsTotal" => $model->count_all(),
            "recordsFiltered" => $model->count_filtered($filters),
            "data" => $data,

        );

    }

}





?>