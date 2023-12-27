<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'system/PHPMailer.php';

class Sponsorad extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/sponsorads/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'sponsorad';
		$this->mHeader['title'] = 'Sponsor Ads';
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
	
	private function get_config(){
		$config = $this->db->get_where('tbl_config',array('code'=>'SPONSORAD'))->row();
		$data = '';
		if($config) {
			$data = json_decode($config->detail);
		}		
		return $data;
	}
	
	private function save_config(){
		$data = $this->input->post();
		$data_old =$this->get_config();
		  
		$data_old->logo_style = $this->input->post('logo_style');
		$data_old->logo_width = $this->input->post('logo_width');
		
		$data_old->name_style = $this->input->post('name_style');
		$data_old->name_size = $this->input->post('name_size');
		$data_old->name_color = $this->input->post('name_color');
		
		$data_old->subject = $this->input->post('subject');
		$data_old->content = $this->input->post('content');
		$data_old->description = $this->input->post('description');
		$data_old->description_style = $this->input->post('description_style'); 
		 
		if (!empty($_FILES['image']['name'])) {
			if( !file_exists('./assets/uploads/sponsorad') )
				mkdir('./assets/uploads/sponsorad', 0777, true);
			$file_name = time().$_FILES['image']['name'];

			if (move_uploaded_file($_FILES['image']['tmp_name'],'assets/uploads/sponsorad/'.$file_name)) {
				$data_old->image = 'assets/uploads/sponsorad/'.$file_name;
			}
		} 

		if (!empty($_FILES['image2']['name'])) {
			if( !file_exists('./assets/uploads/sponsorad') )
				mkdir('./assets/uploads/sponsorad', 0777, true);
			$second_file_name = time().$_FILES['image2']['name'];

			if (move_uploaded_file($_FILES['image2']['tmp_name'],'assets/uploads/sponsorad/'.$second_file_name))
				$data_old->image2 = 'assets/uploads/sponsorad/'.$second_file_name;
		}
		
		if (!empty($_FILES['file']['name'])) {
			if( !file_exists('./assets/uploads/sponsorad') )
				mkdir('./assets/uploads/sponsorad', 0777, true);
			$second_file_name = time().$_FILES['file']['name'].'.png';

			if (move_uploaded_file($_FILES['file']['tmp_name'],'assets/uploads/sponsorad/'.$second_file_name))
				$data_old->file_url = 'assets/uploads/sponsorad/'.$second_file_name;
		} 
		if(!$data_old){
			$this->db->insert('tbl_config' ,array('code'=>'SPONSORAD','detail'=>json_encode($data_old)));
		}else{			
			$this->db->update('tbl_config' ,array('detail'=>json_encode($data_old)),array('code'=>'SPONSORAD'));
		}

		
	}

	public function save(){
		
		$this->save_config();

		echo json_encode(array('message'=>'Success.'));

	}
	 

	public function sendemail(){ 
 
		//$this->db->where('email <>',"");				
		//$data = $this->db->get('tbl_sponsor')->result_array();
		$this->db->where('title',"Corporate");
		$data = $this->db->get('tbl_user')->result_array();
		
		$config = $this->get_config(); 	 
		$subject = $config->subject;
		
		$ads = ($config->file_url)?$config->file_url:''; 
		$ads_content = '<img style="width:800px;" src="'.base_url().$ads.'"/>';
		
		
		$this->db->order_by('schedule','DESC');
		$this->db->limit(1);
		$last = $this->db->get_where('tbl_email_queue_day',array())->row();
		if($last){
			$day = date("Y-m-d",strtotime("+1 day",strtotime($last->schedule)));
		}else{
			$day = date("Y-m-d");
		}
 

		foreach($data as $k=>$v){
			$email = $v['email'];

			$email_content = '<div>Hi, '.$v['name'].'<br><br>'.$ads_content.'</div>';
			$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$v['name'].'&t='.$v['phone_number'].'&type='.$v['title'].'&p=Email').'"/>';
			
			 
			if($email){
				 
				$this->db->insert('tbl_email_queue_day',array('email'=>$email,
					'content'=>$email_content. $image_refer,
					'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s"),
					'template'=>'template_sponsor',
					'schedule'=>$day
					)); 
				
			}

		}
		echo json_encode(array('status'=>1,'message'=>''.count($data).' emails has added to queue.'));
	}
	
	public function sendtest(){
		
		 $email = $this->input->post('email');
		
		$config = $this->get_config(); 		
		 
		$ads = ($config->file_url)?$config->file_url:''; 
		$ads_content = '<img style="width:800px;" src="'.base_url().$ads.'"/>';
 
		$subject = $config->subject;
		 
		$email_content = '<div>Hi, Test<br/><br/>'.$ads_content.'</div>';
		$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.'test'.'&t=test&type=test&p=Email').'"/>';
		
		 
		if($email){

			$this->db->insert('tbl_email_queue',array('email'=>$email,
				'content'=>$email_content. $image_refer,
				'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s"),
				'template'=>'template_sponsor'
				));
		}
 
		echo json_encode(array('status'=>1,'message'=>'1 emails has sent.'));
	}
 

	public function changefont(){
		$partten = "~font\-size: ?([\d]+)pt~";

		$config = $this->db->get_where('tbl_config',array('code'=>'SPONSOR'))->row();
		$config  = json_decode($config->detail);
		$ads_content = $config->content;
		$ads_content = process_email_font($ads_content);
		die(htmlspecialchars($ads_content));

	}

}
