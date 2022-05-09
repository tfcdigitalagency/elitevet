<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'system/PHPMailer.php';
class Cronjob extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'home';
		$this->mHeader['title'] = 'Home';
		$this->mContent['msg'] = "";
	}


	public function queue(){
		$this->db->limit(50);
		$data = $this->db->get_where('tbl_email_queue',array('status'=>0))->result();

		foreach ($data as $email){

			$check = $this->sendMail($email->email, $email->content, $email->subject);

			if($check){
				$this->db->update('tbl_email_queue',array('status'=>1),array('id'=>$email->id));
			}
		}

	}

	public function sendMail($toEmail='' , $content = '' , $subject = '')
	{
		$mail = new PHPMailer();

		$email_content = $this->load->view('email/template',array('email_content'=>$content,'email'=>$toEmail),true);

		$mail->IsSMTP();
		$mail->Host = 'localhost';
		$mail->SMTPAuth = false;
		$mail->From = 'support@ncdeliteveterans.org';
		$mail->FromName = 'Elite Nor-Cal';

		$mail->AddAddress($toEmail);

		$mail->IsHTML(true);
		$mail->Subject = $subject;
		$mail->MsgHTML($email_content);

		return $mail->Send();
	}
}
