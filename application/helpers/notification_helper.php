<?php
defined('BASEPATH') or exit('No direct script access allowed');

// any_in_array() is not in the Array Helper, so it defines a new function
function get_top_notifications($system_user_id) {

    $ci = &get_instance();
    $ci->load->model('User_notifications_model', 'M_user_notification');
    $notifications = $ci->M_user_notification->get_top_by_user_id($system_user_id);
    return !empty($notifications) ? $notifications : null;
}

function get_unread_count($system_user_id) {

    $ci = &get_instance();
    $ci->load->model('User_notifications_model', 'M_user_notification');
    $notifications = $ci->M_user_notification->get_unread_by_user_id($system_user_id);
    return !empty($notifications) ? count($notifications) : 0;
}

function get_new_count($system_user_id) {

    $ci = &get_instance();
    $ci->load->model('User_notifications_model', 'M_user_notification');
    $notifications = $ci->M_user_notification->get_new_by_user_id($system_user_id);
    return !empty($notifications) ? count($notifications) : 0;
}

function notify_user($data) {

    $ci = &get_instance();
    $ci->load->model('User_notifications_model', 'M_user_notification');
    $id = $ci->M_user_notification->insert($data);
    return $id ? $id : null;

}