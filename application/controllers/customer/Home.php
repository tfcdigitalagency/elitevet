<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'system/PHPMailer.php';
class Home extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/home/';

    function __construct() {
        parent::__construct();
//        $this->mHeader['id'] = 'home';
        $this->mHeader['title'] = 'Home';
        $this->mContent['msg'] = "";
        $this->load->model(['Training_model','Sponsors_model']);

		$this->load->library('stripe_lib');
    }

    /*
    * Home
    * */
    public function index(){
		$current_user =  $this->session->userdata('user');
		$uid = $current_user['id'];

        $this->mHeader['sub_id'] = 'home';
		$this->mContent['sponsors_package'] = $this->db->get_where('tbl_membership',array('type'=>1))->result();

		if($uid) {
			$this->db->order_by('created','DESC');
			$this->mContent['check_sponsor'] = $this->db->get_where('tbl_sponsor', array('uid' => $uid))->row();
		}
        $this->mContent['training'] = $this->Training_model->find(array(), array(), array(), true);
        $this->mContent['sponsor'] = $this->Sponsors_model->find(array('status'=>1), array(), array(), true);
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

	public function page($code){
		$current_user =  $this->session->userdata('user');
		$uid = $current_user['id'];
		$this->mHeader['id'] = 'page';
		$this->mHeader['sub_id'] = $code;
		$page = $this->db->get_where('tbl_config',array('code'=>$code))->row();
		$page_content = json_decode($page->detail);
		$this->mContent['page_content'] = $page_content;

		$this->render("{$this->sub_mLayout}page", $this->mLayout);
	}

	public function survey(){
        $this->mHeader['sub_id'] = 'survey';
		$current_user =  $this->session->userdata('user');
		$uid = $current_user['id'];
		$check = $this->db->get_where('tbl_survey_result',array('user_id'=>$uid))->row();

		$data = $this->input->post();
		if($data['submit'] && empty($check)){
			if($uid){
			$this->db->trans_start();
			$item = array(
				'user_id'=>$uid,
				'created_at'=>date("Y-m-d H:i:s")
			);
			$this->db->insert('tbl_survey_result',$item);
			$result_id = $this->db->insert_id();

			foreach($data['question'] as $qid =>$val){
				$item = array(
					'result_id'=>$result_id,
					'question_id'=>$qid,
					'detail'=>json_encode($val)
				);
				$this->db->insert('tbl_survey_detail',$item);
			}
			$this->db->trans_complete();
			}else{
				$this->session->set_flashdata('error','You must be login.');
			}
		}

		$check = $this->db->get_where('tbl_survey_result',array('user_id'=>$uid))->row();
        $this->mContent['didSurvey'] = !empty($check);
		if($check){
			$this->db->select('s.*,d.detail');
			$this->db->join('tbl_survey_detail as d','s.id = d.question_id AND result_id="'.$check->id.'"','left');
			$this->mContent['survey'] = $this->db->get('tbl_survey as s')->result();
		}else{
			$this->mContent['survey'] = $this->db->get('tbl_survey')->result();
		}
        $this->render("{$this->sub_mLayout}survey", $this->mLayout);
    }

	public function sponsor(){
		$config['upload_path']          = './assets/uploads/sponsors';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']	= 0;
		$error = '';
		$data = array();


		$new_name = uniqid();
		$config['file_name'] = $new_name;

		$company = $this->input->post('company');
		$email = $this->input->post('email');
		$name = $this->input->post('fullname');
		$phone = $this->input->post('phone');
		$url = $this->input->post('url');

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			 $error = array('error' => $this->upload->display_errors());
			 $status = 0;
		}
		else
		{
			 $status = 1;
			 $data = array('upload_data' => $this->upload->data());

			 //
			 $current_user =  $this->session->userdata('user');
			 $id = $current_user['id'];
			 $sponsor = array(
			 'uid'=>$id,
			 'company'=>$company,
			 'name'=>$name,
			 'email'=>$email,
			 'phone'=>$phone,
			 'url'=>$url,
			 'status'=>0,
			 'icon'=>'assets/uploads/sponsors/'.$data['upload_data']['file_name']);

			 $this->db->insert('tbl_sponsor',$sponsor );

			 $data['sponsor'] = $sponsor;


		}

		echo json_encode(array('status'=>$status,'data'=>$data,'error'=>$error ));
	}
	
	public function hit_dig(){
		$id= $_POST['id'];
		$sql = 'UPDATE tbl_dig SET clicked = clicked + 1 WHERE id="'.$id.'"';
		$this->db->query($sql);
		echo json_encode(array('status'=>1,'data'=>$id));
	}
	
	public function document(){
		//return $this->load->view('customer/home/pdf');
		$this->render("{$this->sub_mLayout}pdf", $this->mLayout);
	}
	public function search_pdf(){
		$key = $_GET['s'];
		if($key){
			$this->db->like('title',$key);
		}
		$items = $this->db->get_where('tbl_dig')->result_array();
		$this->mContent['key'] = $key;
		$this->mContent['items'] = $items;
		$this->render("{$this->sub_mLayout}search_pdf", $this->mLayout);
	}
	public function digital(){
		$this->db->order_by('position','ASC');
		$items = $this->db->get_where('tbl_dig',array('position >'=>0))->result_array();		
		$this->mContent['items'] = $items;
		$this->render("{$this->sub_mLayout}digital", $this->mLayout);
	}
	
	public function referral(){
		$this->add_referal();
		$user = $this->session->userdata('user');
		$this->mContent['user'] = $user;
		$this->render("{$this->sub_mLayout}referral", $this->mLayout);
	}
	
	public function send_referral(){
		$from= $_POST['from'];
		$name= $_POST['name'];
		$email= $_POST['email']; 
		$error = "";
		
		if($name && $email){
			$this->db->insert('tbl_referral',array('from'=>$from,'name'=>$name,'email'=>$email,'created'=>date("Y-m-d H:i:s")));			
			$data['ok'] = $this->email($from, $name , $email);
		}else{
			$ok = 0;
			$error = "Invalid information.";
		}
		echo json_encode(array('ok'=>$ok,'error'=>$error));
	}
	
	public function answer($hash=''){
		$email = $_GET['email'];
		$questions = $this->db->get_where('ads_questions',array('hash'=>$hash))->row_array();
		$user = $this->db->get_where('tbl_user',array('email'=>$email))->row_array();
		$this->mContent['email'] = $email;
		$this->mContent['user'] = $user;
		$this->mContent['hash'] = $hash;
		
		$this->mContent['questions'] = $questions;
		$this->render("{$this->sub_mLayout}answer", $this->mLayout);
	}
	
	public function save_answer(){
		$email= $_POST['email'];
		$answer= $_POST['answer'];
		$questions= $_POST['questions']; 
		$hash= $_POST['hash']; 
		$error = "";
		
		$answers = [];
		foreach($questions as $k=>$q){
			$answers[] = array('question'=>$q,'answer'=>$answer[$k]);
		}
		
		if($email && !empty($answers)){
			$this->db->insert('ads_questions_answer',array('answer'=>json_encode($answers),'hash'=>$hash,'email'=>$email));			
			$ok = 1;
		}else{
			$ok = 0;
			$error = "Invalid infomation.";
		}
		echo json_encode(array('ok'=>$ok,'error'=>$error));
	}

	public function test(){
		$send = $this->email('Luc','XXX','lucdt@ideavietnam.com');
		var_dump($send);
	}

	
	protected function email($from,$name,$toEmail){
		 
		$subject = "ELite NCD Veterans Group Webinar System";
		$ads_content = "Hi,".$name."<br/><br/>";
		$ads_content .= "<h3>ELite NCD Veterans Group Webinar System</h3><br><br>";
		
		if($from){
			$ads_content .= "From: ".$from."<br/><br/>";
		}
		
		$ads_content .= "<h4>Networking so important!</h4>";
		
		$ads_content .= "The Northern California Chapter of Elite Service-Disabled Veteran Network is a nonprofit tax-deductible 501(c)19 organization.<br/><br/>";				 
		$ads_content .= "<a style=\"display:inline-block; background:#1E62EB; color:#fff;text-decoration: none; padding:3px 15px; border:1px solid #ccc; border-radius:3px;\" href='".site_url('customer/home/referral?ref_name='.$name.'&ref_email='.$email)."'>Check it out View Now</a><br><br>"; 
		$content = $ads_content;

		return $this->sendMail($subject,$toEmail,$content);

	}

	
	
}

