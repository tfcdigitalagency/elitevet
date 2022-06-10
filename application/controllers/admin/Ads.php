<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'system/PHPMailer.php';

class Ads extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/ads/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'ads';
		$this->mHeader['title'] = 'Ads';
		$this->mContent['msg'] = "";
	}

	public function index(){
		$this->mHeader['sub_id'] = 'view';
		$this->db->where('title',"Corporate");
		$this->db->or_where('title',"Other");
		$this->mContent['users'] = $this->db->get('tbl_user')->result_array();
		//die($this->db->last_query());
		$this->render("{$this->sub_mLayout}email", $this->mLayout);
	}

	public function save(){
		$data = $this->input->post();
		$config = $this->db->get_where('tbl_config',array('code'=>'SPONSOR'))->row();
		if(!$config){
			$this->db->insert('tbl_config' ,array('code'=>'SPONSOR','detail'=>json_encode($data)));
		}else{
			$this->db->update('tbl_config' ,array('detail'=>json_encode($data)),array('code'=>'SPONSOR'));
		}

		echo json_encode(array('message'=>'Success.'));

	}

	public function sendemail(){

		$subject = $this->input->post('subject');
		$email_content = $this->input->post('content');

		$type = $this->input->post('type');
		if($type){
			$user_id = explode(',',$this->input->post('users'));
			$this->db->where_in('id',$user_id);
		}else{
			$this->db->where('title',"Corporate");
			$this->db->or_where('title',"Other");
		}
		$data = $this->db->get('tbl_user')->result_array();

		foreach($data as $k=>$v){
			$email = $v['email'];

			$content = 'Hi, '.$v['name']. "<br/><p>".$email_content."</p>";
			$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$v['name'].'&t='.$v['phone_number'].'&type='.$v['title'].'&p=Email').'"/>';

			if($email){
				//$this->sendMail($email, $content. $image_refer, $subject);
				$this->db->insert('tbl_email_queue',array('email'=>$email,
					'content'=>$content. $image_refer,
					'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));
			}

		}
		echo json_encode(array('status'=>1,'message'=>''.count($data).' emails has added to queue.'));
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
