<?php
/**
 * CodeIgniter
 *

 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('get_admin_level'))
{

	function get_admin_level()
	{
		$CI = &get_instance();
		$user = $CI->session->userdata('user');
		return  $user['is_admin'];
	}
}


function get_user($id){
	$CI = &get_instance();
	$user = $CI->db->get_where('tbl_user',array('id'=>$id))->row();
	$user->membership = $CI->db->get_where('tbl_membership',array('id'=>$user->membership_id))->row();
	return $user;
}
