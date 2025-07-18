<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_payment_due')){

 function get_payment_due($payment)
{   

    if ($payment['status'] == 'pending') {
        $current_date = new DateTime(date('Y-m-d'));
        $due_date = new DateTime($payment['due_date']);
        $interval = $current_date->diff($due_date);
        $days_left = $interval->days;
      


        switch (true) {
            case ($days_left <= 3):
                $text_color = 'text-danger';
                $bg_color = 'bg-danger text-white';
                break;

            case ($days_left <= 10):
                $text_color = 'text-success';
                $bg_color = 'bg-success text-white';
                break;

            default:
                $text_color = 'text-muted';
                $bg_color = 'bg-light text-dark';
                break;
        }

        if ($interval->invert == 0) {
            $formatted_due_date = $due_date->format('l, F j, Y');
            return "
            <div class='timeline-event'>
                <p class='mb-1'>$formatted_due_date</p>
               <small class='$text_color'>$days_left day(s) left</small>
            </div>";
        }
    }
    return null;
}   
}

if (!function_exists('generateInvoiceNumber')) {
    function generateInvoiceNumber()
    {
        $prefix = "INV-";
        $date = date("YmdHis");
        $randomNumber = mt_rand(1000, 9999);
        $referenceNumber = $prefix . $date . $randomNumber;
        return $referenceNumber;
    }
}

if (!function_exists('get_record')) {
    function get_record($filters = [])
    {
        $this->db->where($filters);
        return $this->db->get($this->_table)->row_array();
    }
}

if (!function_exists('format_number_with_commas')) {
    function format_number_with_commas($number)
    {
        return number_format($number, 2, '.', ','); // Adjust decimal places as needed
    }
}
