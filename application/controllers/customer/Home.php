<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/home/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'home';
        $this->mHeader['title'] = 'Home';
        $this->mContent['msg'] = "";
        $this->load->model(['Training_model','Sponsors_model']);
    }

    /*
    * Home
    * */
    public function index(){
        $this->mHeader['sub_id'] = 'home';
        $this->mContent['training'] = $this->Training_model->find(array(), array(), array(), true);
        $this->mContent['sponsor'] = $this->Sponsors_model->find(array('status'=>1), array(), array(), true);
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

	public function survey(){
        $this->mHeader['sub_id'] = 'home';
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
}
