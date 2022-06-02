<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/third_party/PHPExcel.php';

require 'system/PHPMailer.php';

class Survey extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/survey/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'survey';
        $this->mHeader['title'] = 'Survey';
        $this->mContent['msg'] = "";
    }

    public function list(){
        $this->mHeader['sub_id'] = 'view';
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

	public function get_data(){
		$this->db->order_by('created_at','desc');
        $table_data['data'] = $this->db->get_where('tbl_survey',array())->result_array();

        echo json_encode($table_data);
    }

    public function add(){
		if($this->input->post('submit')){
			$data = array(
				'question'=>$this->input->post('question'),
				'type'=>$this->input->post('type'),
				'content'=>json_encode($this->input->post('choise')),
				'created_at'=>date("Y-m-d H:i:s")
			);
			$this->db->insert('tbl_survey',$data);

			$this->session->set_flashdata('message','Add Question Successfully.');
		}

        $this->mHeader['sub_id'] = 'add';
        $this->mContent['data'][0]['id']='0';
        $this->render("{$this->sub_mLayout}add", $this->mLayout);
    }

    public function edit(){
        if($this->input->post('submit')){
			$data = array(
				'question'=>$this->input->post('question'),
				'type'=>$this->input->post('type'),
				'content'=>json_encode($this->input->post('choise')),
				'updated_at'=>date("Y-m-d H:i:s")
			);
			$this->db->update('tbl_survey',$data,array('id'=>$this->input->post('survey_id')));

			$this->session->set_flashdata('message','Question updated Successfully.');
		}

        $this->mHeader['sub_id'] = 'view';
        $id = $this->input->get('id');
        $this->mContent['data'] = $this->db->get_where('tbl_survey',array('id'=>$id))->row();
        $this->render("{$this->sub_mLayout}edit", $this->mLayout);
    }


    public function delete(){
        $id = $this->input->post('id');
        $this->db->delete('tbl_survey',array('id'=>$id));
    }


	public function result(){
        $this->mHeader['sub_id'] = 'view';
        $this->render("{$this->sub_mLayout}result", $this->mLayout);
    }

	public function get_result(){
		$this->db->select('sr.*,u.name as uname');
		$this->db->from('tbl_survey_result sr');
		$this->db->join('tbl_user u','u.id = sr.user_id','left');
		$this->db->order_by('sr.created_at','desc');
        $table_data['data'] = $this->db->get()->result_array();

		foreach($table_data['data'] as $k=>$v){
			if(!$table_data['data'][$k]['name']){
				$table_data['data'][$k]['name'] = $table_data['data'][$k]['uname'];
			}
		}

        echo json_encode($table_data);
    }

	public function detail(){
		$this->mHeader['sub_id'] = 'view';
        $id = $this->input->get('id');
		$this->db->select('sr.*,u.name as uname ,sr.created_at submited');
		$this->db->join('tbl_user as u','u.id = sr.user_id','left');
        $this->mContent['result'] = $this->db->get_where('tbl_survey_result as sr',array('sr.id'=>$id))->row();

		$this->db->select('s.*,d.detail');
		$this->db->join('tbl_survey_detail as d','s.id = d.question_id AND result_id="'.$id.'"','left');
		$this->mContent['survey'] = $this->db->get('tbl_survey as s')->result();
        $this->render("{$this->sub_mLayout}detail", $this->mLayout);
    }

	public function capsta(){
		$this->mHeader['sub_id'] = 'view';
        $id = $this->input->get('id');
		$this->db->select('sr.*,u.name as uname ,sr.created_at submited');
		$this->db->join('tbl_user as u','u.id = sr.user_id','left');
        $this->mContent['result'] = $this->db->get_where('tbl_survey_result as sr',array('sr.id'=>$id))->row();

		$this->db->select('s.*,d.detail');
		$this->db->join('tbl_survey_detail as d','s.id = d.question_id AND result_id="'.$id.'"','left');

		$this->mContent['survey'] = $this->db->get('tbl_survey as s')->result();
        $html = $this->load->view('admin/survey/capsta',$this->mContent,true);
//		echo $html;
		$this->load->library('pdf');
		$this->pdf->createPDF($html, 'capsta', true);
    }



	public function delete_result(){
        $id = $this->input->post('id');
        $this->db->delete('tbl_survey_detail',array('result_id'=>$id));
        $this->db->delete('tbl_survey_result',array('id'=>$id));
    }

	public function export(){

		$this->db->select('sr.*,u.name as user_name');
		$this->db->from('tbl_survey_result sr');
		$this->db->join('tbl_user u','u.id = sr.user_id','left');
		$this->db->order_by('sr.created_at','desc');
        $data = $this->db->get()->result_array();

		foreach($data as $k=>$v){
			$this->db->select('s.*,d.detail');
			$this->db->join('tbl_survey_detail as d','s.id = d.question_id AND d.result_id="'.$v['id'].'"','left');
			$detail = $this->db->get('tbl_survey as s')->result_array();

			$data[$k]['detail'] = $detail;
		}

		$header = ['No','Name','Created'];
		foreach($data[0]['detail'] as $k=>$v){
			$header[] = $v['question'];
		}
		$rows = [];
		foreach($data as $k=>$v){
			$row = [];
			$row[] = ($k+1);
			$row[] = ($v['user_name'])?$v['user_name']:$v['name'];
			$row[] = $v['created_at'];
			foreach($v['detail'] as $m=>$n){
				$content = json_decode($n['content'],true);
				$detail = json_decode($n['detail'],true);
				switch($n['type']){
					case 1:
						$row[] = $detail['answer'][0];
						break;
					case 2:
						$row[] = implode("; ",$detail['answer']);
						break;
					case 3:
						$tmp = [];
						foreach($content as $x=>$y){
							$tmp[] = $y.':'.$detail['answer'][$x];
						}
						$row[] = implode('; ',$tmp);
						break;

				}

			}
			$rows[] = $row;
		}
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=\"survey".".csv\"");
		header("Pragma: no-cache");
		header("Expires: 0");

		$handle = fopen('php://output', 'w');

		fputcsv($handle, $header);
		foreach ($rows as $data_array) {
			fputcsv($handle, $data_array);
		}
			fclose($handle);
		exit;


	}

	public function save(){
		$data = $this->input->post();
		$config = $this->db->get_where('tbl_config',array('code'=>'SURVEY'))->row();
		if(!$config){
			$this->db->insert('tbl_config' ,array('code'=>'SURVEY','detail'=>json_encode($data)));
		}else{
			$this->db->update('tbl_config' ,array('detail'=>json_encode($data)),array('code'=>'SURVEY'));
		}

		echo json_encode(array('message'=>'Data was saved.'));

	}

	public function email(){
		$this->mHeader['sub_id'] = 'view';
		$this->mContent['users'] = $this->db->get_where('tbl_user')->result_array();
        $this->render("{$this->sub_mLayout}email", $this->mLayout);
	}

	public function sendemail(){
		 $subject = $this->input->post('subject');
		 $email_content = $this->input->post('content');

		 $type = $this->input->post('type');
		 if($type){
			$user_id = $this->input->post('user');
			$this->db->where_in('id',$user_id);
		 }

		 $data = $this->db->get_where('tbl_user',array('subscribe'=>1))->result_array();

		 foreach($data as $k=>$v){
			 $email = $v['email'];
			 $link = site_url('survey/?hash='.md5($email));
			 $survey = '<br><br>Please using access survey link bellow:<br><a href="'.$link.'">'.$link.'</a>';
			 $content = 'Hi, '.$v['name']. "<br/>".$email_content.$survey;
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
