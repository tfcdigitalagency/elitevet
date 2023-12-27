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

function get_compay_type($id)
{
	$CI = &get_instance();
	$type = $CI->db->get_where('tbl_company_type', array('id' => $id))->row_array();

	return ($type) ? $type['title'] : '';
}

function set_compay_type($name)
{
	$CI = &get_instance();
	$type = $CI->db->get_where('tbl_ai_category', array('name' => $name, 'status' => 1))->row_array();

	return ($type) ? $type['type'] : '';
}

function get_dig($id = '')
{
	$CI = &get_instance();
	if ($id) {
		$where = array('id' => $id);
	} else {
		$where = array();
	}
	$user = $CI->db->get_where('tbl_dig', $where)->row();

	$sql = 'UPDATE tbl_dig SET viewed = viewed + 1 WHERE id="' . $user->id . '"';
	$CI->db->query($sql);
	return $user;
}

function get_home_dig()
{
	$CI = &get_instance();
	$where = array('home' => 1);
	$user = $CI->db->get_where('tbl_dig', $where)->row();

	return $user;
}

function get_homepage_event()
{
	$CI = &get_instance();
	$where = array();
	$CI->db->order_by('id', 'desc');
	$event = $CI->db->get_where('tbl_landads', $where)->row();

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
	$content = str_replace('../../', base_url(), $content);
	$content = str_replace('../', base_url(), $content);
	return $content;
}


function get_event_inperson($event_id)
{
	$CI = &get_instance();
	$CI->db->select('COUNT(*) as total');
	$row = $CI->db->get_where('tbl_event_book_inperson', array('event_id' => $event_id))->row_array();
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

function article_log($id, $action, $value = 1, $uid = 0)
{
	$CI = &get_instance();
	$ip = getUserIP();
	$refer = $_SERVER['HTTP_REFERER'];
	if (!$uid) {
		$user = $CI->session->userdata('user');
		$uid = $user['id'];
	}
	$CI->db->insert('tbl_new_statistic',
		array('article_id' => $id,
			'action' => $action,
			'val' => $value,
			'ip' => $ip,
			'referer' => $refer,
			'uid' => $uid
		));
}

function article_get_log($id, $action, $where = '')
{
	$CI = &get_instance();
	$value = 0;
	switch ($action) {
		case 'sent':
			$row = $CI->db->get_where('tbl_new_statistic', array('action' => $action, 'article_id' => $id))->row();
			$value = intval($row->val);
			break;
		case 'clicked':
		case 'viewed':
		case 'opened':
			$CI->db->select('COUNT(*) as total');
			if (!empty($where)) {
				$CI->db->where($where);
			}
			$row = $CI->db->get_where('tbl_new_statistic', array('action' => $action, 'article_id' => $id))->row();
			$value = intval($row->total);
			break;
	}

	return $value;
}

function article_get_percent($id, $action, $sent = 0)
{
	$percent = 0;
	if (!$sent) {
		$sent = article_get_log($id, 'sent');
	}
	if ($sent) {
		$log = article_get_log($id, $action);
		$percent = round($log / $sent, 2) * 100;
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
	$client = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote = $_SERVER['REMOTE_ADDR'];

	if (filter_var($client, FILTER_VALIDATE_IP)) {
		$ip = $client;
	} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
		$ip = $forward;
	} else {
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

function get_config_content($code)
{
	$CI = &get_instance();
	$config = $CI->db->get_where('tbl_config', array('code' => $code))->row();

	$data = '';
	if ($config) {
		$data = json_decode($config->detail);
	}
	return $data;
}

function update_config_content($code, $data)
{
	$CI = &get_instance();
	$data_old = get_config_content($code);

	if (empty($data_old)) {
		$CI->db->insert('tbl_config', array('code' => $code, 'detail' => json_encode($data)));
	} else {
		foreach ($data as $key => $val) {
			$data_old->{$key} = $val;
		}

		$CI->db->update('tbl_config', array('detail' => json_encode($data_old)), array('code' => $code));
	}
}

function getSurveyOption($item)
{
	$choise = json_decode($item->content);
	$detail = json_decode($item->detail);

	switch ($item->type) {
		case 1:
			foreach ($choise as $c) {
				if (in_array($c, $detail->answer)) return $c;
			}
			break;
		case 2:
			$html = [];
			foreach ($choise as $c) {
				if (in_array($c, $detail->answer)) $html[] = $c;
			}
			return implode(', ', $html);
			break;
	}
}

function is_sponsor()
{
	$flag = false;
	$CI = &get_instance();

	$canDownload = array();
	$config_data = get_config_content('CAPSTA');

	$current_user = $CI->session->userdata('user');
	$sponsor = $CI->db->get_where('tbl_sponsor', array('email' => $current_user['email']))->row_array();
	if ($current_user['is_admin'] || ($sponsor && in_array($sponsor['type'], $config_data->candownload))) {
		$flag = true;
	}
	return $flag;
}

function check_sponsor()
{
	$flag = false;
	$CI = &get_instance();

	$current_user = $CI->session->userdata('user');
	$sponsor = $CI->db->get_where('tbl_sponsor', array('email' => @$current_user['email']))->row_array();
	if (@$current_user['is_admin'] || $sponsor) {
		$flag = true;
	}
	return $flag;
}

function sendMail($subject, $toEmail, $content, $attachment = '', $template = '', $from_email = '')
{
	try {
		$CI = &get_instance();
		$temp = ($template) ? 'email/' . $template : 'email/template';

		$email_content = $CI->load->view($temp, array('email_content' => $content, 'email' => $toEmail), true);

		// Create a new PHPMailer instance
		$config = $CI->config->item('smtp_account');
		if (!$from_email) {
			$from_email = $CI->config->item('system_email');
		}

		$from_name = $CI->config->item('system_name');
		$CI->load->library('email');
		$CI->email->initialize($config);
		$CI->email->from($from_email, $from_name);
		$CI->email->to($toEmail);
		$CI->email->subject($subject);
		$CI->email->message($email_content);

		if ($attachment) {
			$CI->email->attach($attachment);
		}

		$CI->email->debug = false;
		$send = $CI->email->send();
		if ($send) {
			return true;
		} else {
			//echo 'Email sending failed. Debug info: <br>';
			//echo $CI->email->print_debugger();
			echo json_encode(array('status' => $send, 'message' => $CI->email->print_debugger()));
			die();
			//return false;
		}
	} catch (Exception $e) {
		echo json_encode(array('status' => $send, 'message' => $CI->email->ErrorInfo));
		die();
		//return false;
	}
}

function sendMailFunction($subject, $toEmail, $content, $attachment = '', $template = '', $from_email = '')
{
	$CI = &get_instance();
	$temp = ($template) ? 'email/' . $template : 'email/template';
	$email_content = $CI->load->view($temp, array('email_content' => $content, 'email' => $toEmail), true);

	if (!$from_email) {
		$from_email = $CI->config->item('system_email');
	}

	$headers = "From: Elite Nor-Cal<$from_email>\n";
	$headers .= "X-Sender: $from_email\n";
	$headers .= 'X-Mailer: Elite/1.0';
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=iso-8859-1\n";

	$status = mail($toEmail, $subject, $email_content, $headers);
	return $status;
}

function cronEmail($limit = 0)
{
	$CI = &get_instance();
	if ($limit) $CI->db->limit($limit);
	$CI->db->order_by('id', 'DESC');
	$data = $CI->db->get_where('tbl_email_queue', array('status' => 0))->result();
	//var_dump($data);die();
	foreach ($data as $email) {
		$check = sendMail($email->subject, $email->email, $email->content, $email->attachment, $email->template);
		//var_dump($check);die();

		if ($check) {
			$CI->db->update('tbl_email_queue', array('status' => 1), array('id' => $email->id));
			//insert log
			if ($email->template == 'template_sponsor') {
				$log = array(
					'subject' => $email->subject,
					'content' => $email->content,
					'email' => $email->email,
					'template' => $email->template,
					'attachment' => $email->attachment,
					'schedule' => $email->schedule,
					'created' => date("Y-m-d H:i:s"),
				);
				$CI->db->insert('tbl_email_postbid_log', $log);
			}
		} else {
			$CI->db->update('tbl_email_queue', array('status' => -1), array('id' => $email->id));
		}
	}

	return count($data) . ' emails';

}
