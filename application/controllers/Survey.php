<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {
	public $mLayout = 'customer/';
    public $sub_mLayout = 'survey/';

	function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'home';
        $this->mHeader['title'] = 'Home';
        $this->mContent['msg'] = "";
        $this->load->model(['Training_model','Sponsors_model']);
    }


	public function index(){
        $this->mHeader['sub_id'] = 'home';
		$current_user =  $this->session->userdata('user');
		$uid = $current_user['id'];
		$hash = $_GET['hash'];
		$user = $this->db->get_where('tbl_user',array('md5(email)'=>$hash))->row();

		$this->mContent['user'] = $user;

		$check = $this->db->get_where('tbl_survey_result',array('md5(email)'=>$hash))->row();
 
		$data = $this->input->post();
		if($data['submit']){
			if(!$check){

				$this->db->trans_start();
				$item = array(
					'email'=>$user->email,
					'name'=>$user->name,
					'user_id'=>$user->id,
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

				//send the cap-sta
				$email = $user->email;
				$subject = "";
				$email_content = "";
				$content = 'Hi, '.$user->name. "<br/>".$email_content;
				$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$user->name.'&t='.$user->phone_number.'&type='.$user->title.'&p=Email').'"/>';


				$this->db->select('sr.*,u.name as uname ,sr.created_at submited');
				$this->db->join('tbl_user as u','u.id = sr.user_id','left');
				$mContent['result'] = $this->db->get_where('tbl_survey_result as sr',array('sr.id'=>$result_id))->row();

				$this->db->select('s.*,d.detail');
				$this->db->join('tbl_survey_detail as d','s.id = d.question_id AND result_id="'.$result_id.'"','left');

				$mContent['survey'] = $this->db->get('tbl_survey as s')->result();
				$html = $this->load->view('admin/survey/capsta',$mContent,true);
				//echo $html;
				$this->load->library('pdf');
				$attachment = 'assets/capsta/capsta_'.$$result_id.'_'.date("Ymd-his").'.pdf';

				$this->pdf->savePDF($html, $attachment, false);

				$this->db->insert('tbl_email_queue',array('email'=>$email,
					'content'=>$content. $image_refer,
					'attachment'=>$attachment,
					'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));

			}
		}

		$check = $this->db->get_where('tbl_survey_result',array('md5(email)'=>$hash))->row();

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


	protected function render($view, $layout = '') {
        $flash = $this->session->flashdata('flash');
        if ($flash) {
            $this->mHeader['flash'] = $flash;
            $this->session->unset_userdata('flash');
        }

        $alert = $this->session->userdata('alert');
        if ($alert) {
            $this->mContent['alert'] = $alert;
            $this->session->unset_userdata('alert');
        }

        $this->load->view("layout/{$layout}header", $this->mHeader);
        $this->load->view($view, $this->mContent);
        $this->load->view("layout/{$layout}footer", $this->mFooter);
    }

    protected function redirect($url) {
        redirect(base_url($url));
    }

    protected function json($data) {
        $json = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json);
    }

    protected function success($result = NULL) {
        $data['success'] = true;
        if($result)
            $data['result'] = $result;
        $this->json($data);
    }

    protected function error($result = NULL) {
        $data['success'] = false;
        if($result)
            $data['result'] = $result;
        $this->json($data);
    }

}
