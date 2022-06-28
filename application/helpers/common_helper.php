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


function hit_counter(){
	$CI = &get_instance();
	$CI->load->helper('cookie');

	$offset = $CI->uri->segment(1);
	if($offset == 'admin'){
		return;
	}

	$name = md5(current_url());

	$visitor = $CI->session->userdata($name);
	$ipadrs = $CI->input->ip_address();

	if ($visitor == false)
	{
		$CI->session->set_userdata($name,$ipadrs);

		$sql = 'UPDATE tbl_counter SET counter = counter + 1';
		$CI->db->query($sql);
	}


}

function get_counter(){
	$CI = &get_instance();
	$row = $CI->db->get('tbl_counter')->row_array();
	return $row['counter'];
}

function process_email_image($content){
	$images = array();
	preg_match_all('/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s', $content, $images);
	$replace = [];
	foreach ($images[0] as $k=>$img){
		$replace[] = '<img style="max-width:100%" src="'.$images[3][$k].'"/>';
	}
	$content = str_replace($images[0],$replace,$content);
	return $content;

}

