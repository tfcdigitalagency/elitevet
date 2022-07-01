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
		$replace[] = '<img style="max-width:100%; margin:auto;" src="'.$images[3][$k].'"/>';
	}
	$content = str_replace($images[0],$replace,$content);
	return $content;

}

function process_email_font($ads_content){
	$partten = "~font\-size: ?([\d]+)pt~";
	preg_match_all($partten,$ads_content,$match);
	$fontsize = array();
	foreach ($match[0] as $k=>$v){
		$fontsize[] = 'font-size:'.(intval($match[1][$k])*0.6).'pt';
	}
	$ads_content = str_replace($match[0],$fontsize,$ads_content);

	$partten = "~font\-size: ?([\d]+)px~";
	preg_match_all($partten,$ads_content,$match);
	$fontsize = array();
	foreach ($match[0] as $k=>$v){
		$fontsize[] = 'font-size:'.(intval($match[1][$k])*0.6).'px';
	}
	$ads_content = str_replace($match[0],$fontsize,$ads_content);
	return $ads_content;

}

function get_article_slug($title){
	$slug = slugify($title);
	$CI = &get_instance();
	$exit = $CI->db->get_where('tbl_news',array('slug'=>$slug))->row();
	if(!empty($exit)) {
		$i = 0;
		while ($exit) {
			$i++;
			$exit = $CI->db->get_where('tbl_news', array('slug' => $slug . '-' . $i))->row();
		}
		$slug = $slug . '-' . $i;
	}
	return $slug;
}

function slugify($text,  $divider = '-')
{
	// replace non letter or digits by divider
	$text = preg_replace('~[^\pL\d]+~u', $divider, $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, $divider);

	// remove duplicate divider
	$text = preg_replace('~-+~', $divider, $text);

	// lowercase
	$text = strtolower($text);

	if (empty($text)) {
		return 'n-a';
	}

	return $text;
}


