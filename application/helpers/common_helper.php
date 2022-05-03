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

