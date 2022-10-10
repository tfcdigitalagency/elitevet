<?php
/**
 * CodeIgniter
 *

 */
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_admin_level')) {

	function get_admin_level()
	{
		$CI = &get_instance();
		$user = $CI->session->userdata('user');
		return $user['is_admin'];
	}
}


function get_user($id)
{
	$CI = &get_instance();
	$user = $CI->db->get_where('tbl_user', array('id' => $id))->row();
	$user->membership = $CI->db->get_where('tbl_membership', array('id' => $user->membership_id))->row();
	return $user;
}


function get_dig($id='')
{
	$CI = &get_instance();
	if($id){
		$where = array('id' => $id);
	}else{
		$where = array();
	}
	$user = $CI->db->get_where('tbl_dig',$where )->row();
	
	$sql = 'UPDATE tbl_dig SET viewed = viewed + 1 WHERE id="'.$user->id.'"';
		$CI->db->query($sql);
	return $user;
}

function get_homepage_event()
{
	$CI = &get_instance();
	$where = array();
	$CI->db->order_by('id','desc');
	$event = $CI->db->get_where('tbl_landads',$where )->row(); 
	 
	return $event;
}

function hit_counter()
{
	$CI = &get_instance();
	$CI->load->helper('cookie');

	$offset = $CI->uri->segment(1);
	if ($offset == 'admin') {
		return;
	}

	$name = md5(current_url());

	$visitor = $CI->session->userdata($name);
	$ipadrs = $CI->input->ip_address();

	if ($visitor == false) {
		$CI->session->set_userdata($name, $ipadrs);

		$sql = 'UPDATE tbl_counter SET counter = counter + 1';
		$CI->db->query($sql);
	}


}

function replace_url($content)
{
	$content = str_replace('../../',base_url(),$content);
	$content = str_replace('../',base_url(),$content);
	return $content;
}


function get_event_inperson($event_id)
{
	$CI = &get_instance();
	$CI->db->select('COUNT(*) as total');
	$row = $CI->db->get_where('tbl_event_book_inperson',array('event_id' =>$event_id))->row_array();
	return intval($row['total']);
}

function get_counter()
{
	$CI = &get_instance();
	$row = $CI->db->get('tbl_counter')->row_array();
	return $row['counter'];
}

function process_email_image($content)
{
	$images = array();
	preg_match_all('/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s', $content, $images);
	$replace = [];
	foreach ($images[0] as $k => $img) {
		$replace[] = '<img style="max-width:100%; margin:auto;" src="' . $images[3][$k] . '"/>';
	}
	$content = str_replace($images[0], $replace, $content);
	return $content;

}

function process_email_font($ads_content)
{
	$partten = "~font\-size: ?([\d]+)pt~";
	preg_match_all($partten, $ads_content, $match);
	$fontsize = array();
	foreach ($match[0] as $k => $v) {
		$fontsize[] = 'font-size:' . (intval($match[1][$k]) * 0.6) . 'pt';
	}
	$ads_content = str_replace($match[0], $fontsize, $ads_content);

	$partten = "~font\-size: ?([\d]+)px~";
	preg_match_all($partten, $ads_content, $match);
	$fontsize = array();
	foreach ($match[0] as $k => $v) {
		$fontsize[] = 'font-size:' . (intval($match[1][$k]) * 0.6) . 'px';
	}
	$ads_content = str_replace($match[0], $fontsize, $ads_content);
	return $ads_content;

}

function get_article_slug($title)
{
	$slug = slugify($title);
	$CI = &get_instance();
	$exit = $CI->db->get_where('tbl_news', array('slug' => $slug))->row();
	if (!empty($exit)) {
		$i = 0;
		while ($exit) {
			$i++;
			$exit = $CI->db->get_where('tbl_news', array('slug' => $slug . '-' . $i))->row();
		}
		$slug = $slug . '-' . $i;
	}
	return $slug;
}

function article_log($id,$action, $value = 1,$uid=0)
{
	$CI = &get_instance();
	$ip = getUserIP();
	$refer = $_SERVER['HTTP_REFERER'];
	if(!$uid){
		$user = $CI->session->userdata('user');
		$uid = $user['id'];
	}
	$CI->db->insert('tbl_new_statistic',
		array('article_id'=>$id,
		'action' => $action,
			'val' => $value,
			'ip'=>$ip,
			'referer'=>$refer,
			'uid'=>$uid
			));
}

function article_get_log($id, $action,$where = '')
{
	$CI = &get_instance();
	$value = 0;
	switch ($action) {
		case 'sent':
			$row = $CI->db->get_where('tbl_new_statistic',array('action'=>$action,'article_id'=>$id))->row();
			$value = intval($row->val);
			break;
		case 'clicked':
		case 'viewed':
		case 'opened':
			$CI->db->select('COUNT(*) as total');
			if(!empty($where)){
				$CI->db->where($where);
			}
			$row = $CI->db->get_where('tbl_new_statistic',array('action'=>$action,'article_id'=>$id))->row();
			$value = intval($row->total);
			break;
	}

	return $value;
}

function article_get_percent($id,$action,$sent =0){
	$percent = 0;
	if(!$sent) {
		$sent = article_get_log($id, 'sent');
	}
	if($sent){
		$log = article_get_log($id,$action);
		$percent = round($log/$sent,2)*100;
	}
	return $percent;
}

function getUserIP()
{
	// Get real visitor IP behind CloudFlare network
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if(filter_var($client, FILTER_VALIDATE_IP))
	{
		$ip = $client;
	}
	elseif(filter_var($forward, FILTER_VALIDATE_IP))
	{
		$ip = $forward;
	}
	else
	{
		$ip = $remote;
	}

	return $ip;
}


function slugify($text, $divider = '-')
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


