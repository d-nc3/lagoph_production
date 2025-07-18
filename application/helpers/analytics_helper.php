<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('count_all')) {
	function count_all($table_name, $column_key, $key)
	{
		$ci = &get_instance();
		return $ci->db->where($column_key, $key)
			->from($table_name)
			->count_all_results(); // Count the matching rows
	}
}

if (!function_exists('total_amount_calculator')) {
	function total_amount_calculator($table_name, $key, $status, $column_key)
	{
		$ci = &get_instance();
		$ci->db->select_sum($key);
		$ci->db->where($column_key, $status);
		$query = $ci->db->get($table_name);
		$result = $query->row();

		return $result->$key; // Return the sum of the column
	}
}

function recent_accountability($select, $where_column, $where_value, $table) {
    $ci =& get_instance();
    $ci->db->select($select);
    $ci->db->where($where_column, $where_value);
    $ci->db->where('due_date >=', date('Y-m-d')); // upcoming only
    $ci->db->order_by('due_date', 'ASC'); // soonest first
    $ci->db->limit(1);
    $query = $ci->db->get($table);
    $row = $query->row();

    return $row ? $row->$select : null;
}



if (!function_exists('get_time_ago')) {
	function get_time_ago($timestamp)
	{
		$time = new DateTime($timestamp);
		$now = new DateTime();
		$interval = $now->diff($time);

		if ($interval->y >= 1) {
			return $interval->y . " year ago";
		} elseif ($interval->m >= 1) {
			return $interval->m . " month ago";
		} elseif ($interval->d >= 1) {
			return $interval->d . " day ago";
		} elseif ($interval->h >= 1) {
			return $interval->h . " hour ago";
		} else {
			return "Just now";
		}
	}
}
