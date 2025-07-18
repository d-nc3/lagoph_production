<?php

/**
 * @author   Natan Felles <natanfelles@gmail.com>
 */
defined('BASEPATH') or exit('No direct script access allowed');


if (!function_exists('get_by_code_and_table')) {
	function get_by_code_and_table($code, $key, $table_name)
	{
		$ci = &get_instance();
		$data = $ci->db->select('*')
			->from($table_name)
			->where($key, $code)
			->get()
			->row_array();
		return !empty($data) ? $data : null;
	}
}

if (!function_exists('get_by_two_keys_and_table')) {
	function get_by_two_keys_and_table($key1, $value1, $key2,$value2,$key3, $table_name)
	{
		$ci = &get_instance();
		$data = $ci->db->select('*')
			->from($table_name)
			->where('user_id',$key3)
			->where($key1, $value1)
			->where($key2, $value2)
			->get()
			->row_array();
		return !empty($data) ? $data : null;
	}
}

if (!function_exists('get_recent_verifications')) {
	function get_recent_verifications()
	{   
		$ci = &get_instance();
		$ci->load->database();
		$ci->db->order_by('created_at', 'DESC'); // Sort by timestamp in descending order
		$ci->db->limit(1);
		return $ci->db->get('email_verifications')->row_array();
	}
}

if (!function_exists('has_permissions')) {
	function has_permissions($permission_name)
	{
		$ci = &get_instance();
		$ci->load->database();

		$user_id = $ci->session->userdata('user_id');
		if (!$user_id) {
			echo "User not logged in!";

			return;
		}


		$role = $ci->db->select('*')
			->from('user_roles')
			->where('user_id', $user_id)
			->where('deleted_at', null)
			->get()
			->row_array();

		if (!$role) {
			echo "No role assigned!";
			return;
		}



		$has_permission = $ci->db->select('rp.*, p.*')
			->from('role_permissions rp')
			->join('permissions p', 'rp.permissions_id = p.id', 'left')
			->where('rp.role_id', $role['role_id'])
			->where('p.permission_name', $permission_name)
			->get()
			->row_array();

		return $has_permission ? true : false;
	}
}

if (!function_exists('get_by_user_id_and_table')) {
	function get_by_user_id_and_table($userId,$key,$foreign_key,$table_name)
	{
		
		$ci = &get_instance();
		$ci->load->database(); 

		if (!$userId) {
			echo "User not logged in!";

			return;
		}

		$tableA = $ci->db->escape_str($key);
		$foreignKey = $ci->db->escape_str($foreign_key); 

		$ci = &get_instance();
		$data = $ci->db->select('A.*, B.*')
			->from("$table_name AS A")
			->join("$tableA AS B", "A.$foreignKey = B.id", 'left')
		
			->where('A.deleted_at', null)
			->get()
			->row_array();


		return !empty($data) ? $data : null;
	}
}




// if (!function_exists('get_role')) {
// 	function get_role($user_id)
// 	{
// 		$ci = &get_instance();
// 		$data = $ci->db->select('A.*,B.*,C.*')
// 			->from('role_permissions A')
// 			->join('roles b'
// 			,'a.role_id = b.id
// 			AND b.deleted_at IS NULL'
// 			,'inner')
// 			->join('roles_permissions c','')
// 			->where('b.code', $reference_group_code)
// 			->where('a.name', $reference_group_value_name)
// 			->where('a.deleted_at', null)
// 			->get()
// 			->row_array();

// 		return $data ? $data : 0;
// 	}
// }

if (!function_exists('amount_to_words')) {
	function amount_to_words($amount)
	{
		$num = floatval($amount);
		$dollars = floor($num);
		$cents = round(($num - $dollars) * 100);

		$dollarsInWords = amount_to_words_helper($dollars);
		$centsInWords = amount_to_words_helper($cents);

		$result = '';

		if ($dollarsInWords !== '') {
			$result .= $dollarsInWords;
		}

		if ($centsInWords !== '') {
			$result .= ' and ';
			$result .= $cents . '/100 ';
		}

		$result .= ' pesos only';

		return trim($result);
	}
}

if (!function_exists('amount_to_words_helper')) {
	function amount_to_words_helper($num)
	{
		$numberWords = [
			'',
			'one',
			'two',
			'three',
			'four',
			'five',
			'six',
			'seven',
			'eight',
			'nine',
			'ten',
			'eleven',
			'twelve',
			'thirteen',
			'fourteen',
			'fifteen',
			'sixteen',
			'seventeen',
			'eighteen',
			'nineteen'
		];

		$tensWords = [
			'',
			'',
			'twenty',
			'thirty',
			'forty',
			'fifty',
			'sixty',
			'seventy',
			'eighty',
			'ninety'
		];

		if ($num === 0) {
			return '';
		} else if ($num < 20) {
			return $numberWords[$num];
		} else if ($num < 100) {
			return $tensWords[floor($num / 10)] . ' ' . amount_to_words_helper($num % 10);
		} else if ($num < 1000) {
			return $numberWords[floor($num / 100)] . ' hundred ' . amount_to_words_helper($num % 100);
		} else if ($num < 1000000) {
			return amount_to_words_helper(floor($num / 1000)) . ' thousand ' . amount_to_words_helper($num % 1000);
		} else if ($num < 1000000000) {
			return amount_to_words_helper(floor($num / 1000000)) . ' million ' . amount_to_words_helper($num % 1000000);
		} else {
			return amount_to_words_helper(floor($num / 1000000000)) . ' billion ' . amount_to_words_helper($num % 1000000000);
		}
	}
}

if (!function_exists('get_name_by_system_user_id')) {
	function get_name_by_system_user_id($id)
	{
		$ci = &get_instance();
		$query = $ci->db->select('first_name, middle_name, last_name')
			->from('system_users')
			->where('id', $id)
			->where('deleted_at', null)
			->get()
			->row_array();


		return ($query && !empty($query)) ? $query['first_name'] . ' ' . $query['last_name'] : null;
	}
}

if (!function_exists('get_img_by_system_user_id')) {
	function get_img_by_system_user_id($id)
	{
		$ci = &get_instance();
		$query = $ci->db->select('img_path_url')
			->from('system_users')
			->where('id', $id)
			->where('deleted_at', null)
			->get()
			->row_array();


		return ($query && !empty($query)) && isset($query['img_path_url']) && $query['img_path_url'] ? $query['img_path_url'] : null;
	}
}

if (!function_exists('encrypt_decrypt_text')) {
	function encrypt_decrypt_text($action, $text)
	{
		$ci = &get_instance();
		if ($action == 'encrypt') {
			return $ci->encryption->encrypt($text);
		} else {
			$decrypted_text = $ci->encryption->decrypt($text);
			return $decrypted_text;
		}
	}
}

if (!function_exists('get_user_activities')) {
	function get_user_activities($id)
	{
		$ci = &get_instance();
		$ci->load->model('System_user_activity_logs_model', 'M_system_user_activity_logs');
		return $ci->M_system_user_activity_logs->get_latest_by_system_user_id($id);
	}
}

if (!function_exists('insert_activity')) {
	function insert_activity($data)
	{
		$ci = &get_instance();
		$ci->load->model('System_user_activity_logs_model', 'M_system_user_activity_logs');
		$id = $ci->M_system_user_activity_logs->insert($data);

		return ($id ? $id : null);
	}
}

if (!function_exists('get_all_reference_values_by_reference_group_code')) {
	function get_all_reference_values_by_reference_group_code($reference_group_code)
	{
		$ci = &get_instance();
		$ci->load->model('System_reference_group_values_model', 'M_system_reference_group_values');
		return $ci->M_system_reference_group_values->get_all_by_reference_group_code($reference_group_code);
	}
}

if (!function_exists('get_all_payment_modes')) {
	function get_all_payment_modes()
	{
		$ci = &get_instance();
		$ci->load->model('Cashiering_payment_modes_model', 'M_payment_modes');
		return $ci->M_payment_modes->get_all();
	}
}

if (!function_exists('generate_referral_code')) {
	function generate_referral_code()
	{
		$permitted_chars = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($permitted_chars), 0, 12);
	}
}

if (!function_exists('generate_or_number')) {
	function generate_or_number()
	{
		$prefix = "OR-";
		$date = date("YmdHis");
		$randomNumber = mt_rand(1000, 9999);
		$referenceNumber = $prefix . $date . $randomNumber;
		return $referenceNumber;
	}
}

if (!function_exists('xss_clean_get')) {
	function xss_clean_get($str)
	{
		$CI = &get_instance();
		$str = $CI->security->xss_clean($str);
		return $str;
	}
}

if (!function_exists('number_to_roman_convert')) {
	function number_to_roman_convert($int)
	{
		$int = intval($int);
		$result = '';

		$roman_numerals = array(
			'M'  => 1000,
			'CM' => 900,
			'D'  => 500,
			'CD' => 400,
			'C'  => 100,
			'XC' => 90,
			'L'  => 50,
			'XL' => 40,
			'X'  => 10,
			'IX' => 9,
			'V'  => 5,
			'IV' => 4,
			'I'  => 1
		);

		foreach ($roman_numerals as $roman => $value) {
			$matches = intval($int / $value);
			$result .= str_repeat($roman, $matches);
			$int = $int % $value;
		}

		return $result;
	}
}
