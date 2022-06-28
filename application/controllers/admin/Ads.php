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
		$data['content'] = str_replace('src="../assets','src="https://ncdeliteveterans.org/assets',$data['content']);
		$data['content']= process_email_image($data['content']);
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
		$email_content = str_replace('src="../assets','src="https://ncdeliteveterans.org/assets',$email_content);

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

				$this->db->insert('tbl_email_queue',array('email'=>$email,
					'content'=>$content. $image_refer,
					'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));
			}

		}
		echo json_encode(array('status'=>1,'message'=>''.count($data).' emails has added to queue.'));
	}

	public function save_preview(){
		$data = $this->input->post();
		$data['content'] = str_replace('src="../assets','src="https://ncdeliteveterans.org/assets',$data['content']);
		$data['content']= process_email_image($data['content']);
		$config = $this->db->get_where('tbl_config',array('code'=>'SPONSOR'))->row();
		if(!$config){
			$this->db->insert('tbl_config' ,array('code'=>'SPONSOR','detail'=>json_encode($data)));
		}else{
			$this->db->update('tbl_config' ,array('detail'=>json_encode($data)),array('code'=>'SPONSOR'));
		}

		$ads_content = $data['content'];

		$config = $this->db->get_where('tbl_config',array('code'=>'MAILADS_PREVIEW'))->row();
		$config  = json_decode($config->detail);
		$email_content = $config->content;

		$email_content = '<div>Hi, [User]</div>
<table width=\'1000\'><tr><td width=\'70%\' valign="top">'.$email_content.'</td>
<td width=\'30%\' valign="top" style="padding-left: 20px">
<div style="text-align: right"><span style="display: inline-block;padding: 3px 10px;position: relative;top:-20px; background: #f1f1f1;border-radius: 5px;">Ads</span></div>
'.$ads_content.'</td></tr></table>';

		$preview_content = $this->load->view('email/template',array('email_content'=>$email_content),true);

		echo json_encode(array('ok'=>1,'preview'=>$preview_content));

	}

}
