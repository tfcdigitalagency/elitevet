<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refered extends CI_Controller { 
    public function index(){
		$this->load->model(array('User_model'));
		
        $email = $_GET['e'];
        $name = $_GET['n'];
        $phone = $_GET['t'];
        $type = $_GET['type'];
        $email_subject = $_GET['s'];
		$user = $this->User_model->find(array('email' => $email), array(), array(), true);
		if(count($user) > 0) $user = $user[0];
		
		$ip = $this->get_client_ip();
		$page = isset($_GET['p'])?$_GET['p']:'Email';
		$data = array(
			'page_name'=>$page,
			'ip_address'=>$ip,
			'date'=>date("Y-m-d H:m A"),
			'name'=>$name,
			'phone'=>$phone,
			'email'=>$email,
			'type'=>$type,
			'email_subject'=>$email_subject,
			'email_open'=>1,
		);
		$this->db->insert('user_information',$data);

		//Full URI to the image
		$graphic_http = site_url('tick.png');
		 
		//Get the filesize of the image for headers
		$filesize = filesize( 'tick.png' );

		//Now actually output the image requested (intentionally disregarding if the database was affected)
		header( 'Pragma: public' );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
		header( 'Cache-Control: private',false );
		header( 'Content-Disposition: attachment; filename="tick.png"' );
		header( 'Content-Transfer-Encoding: binary' );
		header( 'Content-Length: '.$filesize );
		readfile( $graphic_http );	
    }
	
	private function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
}
