<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whilewebinar extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/whilewebinar/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'whilewebinar';
        $this->mHeader['title'] = 'Webinar';
        $this->mContent['msg'] = "";
        $this->load->model(['While_webinar_model','Reg_history_model','Attend_history_model']);
    }

    /*
    * While Webinar
    * */
    public function index(){

        if(!$this->isadmin && !$this->ishost){
            echo "You don't have permission to access this page!";
            die();
        }

        $this->mHeader['sub_id'] = 'whilewebinar';

        $this->While_webinar_model->setTable("tbl_training");
        $this->mContent['trainingvideo'] = $this->While_webinar_model->find(array("show_on_webinar" => 1), array(), array(), true);

        $this->While_webinar_model->setTable("tbl_adsimage");
        $this->mContent['adsimage'] = $this->While_webinar_model->find(array(), array(), array(), true);

        $this->While_webinar_model->setTable("tbl_contract");
        $this->mContent['contract'] = $this->While_webinar_model->find(array('type'=>0), array("created_at" => "DESC"), array(), true);

        $this->While_webinar_model->setTable('tbl_asset');
        $handout = $this->While_webinar_model->find(array(), array(), array(), true);
        if (!empty($handout))
            $this->mContent['handout'] = $handout[0]['handout'];

        $this->While_webinar_model->setTable("tbl_sponsor_image");
        $this->mContent['sponsors_image'] = $this->While_webinar_model->find(array(), array("date_inserted" => "ASC"), array(), true);

		$this->db->select("count(*) as total");
		$row = $this->db->get('tbl_whilewebinar_question')->row();
		$this->mContent['total_question'] = $row->total;

        $this->While_webinar_model->setTable("tbl_event");
        $this->mContent['event'] = $this->While_webinar_model->find(array("status"=>"upcoming"), array(), array(), true);

		$this->mContent["real_register"] = $this->Reg_history_model->count(array("event_id"=>$this->mContent['event'][0]["id"]));
        $this->mContent["real_attend"] = $this->Attend_history_model->count(array("event_id"=>$this->mContent['event'][0]["id"]));

		//link
		$current_user =  $this->session->userdata('user');
		$id = $current_user['id'];
		$user = $this->db->get_where('tbl_user',array('id'=>$id))->row();
		$pdf_link = $user->capability_statement_pdf;
		$this->mContent['pdf_link'] = $pdf_link;

        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function getAttended(){
        $data = array();

        $this->While_webinar_model->setTable('tbl_event');
        $event = $this->While_webinar_model->find(array("status"=>"upcoming"), array("start_time" => "ASC"), array(), true);
        if(count($event) > 0){
            $register = $this->Reg_history_model->count(array("event_id"=>$event[0]["id"]));
			$attended = $this->Attend_history_model->count(array("event_id"=>$event[0]["id"]));
            $data['status'] = 'ok';
            $data['data'] = $attended;
        }

        echo json_encode($data);
    }

	public function live($port='8080'){
		$this->load->view('customer/whilewebinar/live.php',array('port'=>$port));
	}

	public function host($port='4000'){
		$this->load->view('customer/whilewebinar/host.php',array('port'=>$port));
	}

	public function addQuestion(){
		$question = $this->input->post('question');
		$current_user =  $this->session->userdata('user');

		$name = $current_user['name'];
		$email = $current_user['email'];
		$this->db->insert('tbl_contactus',array('content'=>$question,'name'=>$name,'email'=>$email,'created_at'=>date("Y-m-d H:i:s")));

		$this->db->select("count(*) as total");
		$row = $this->db->get('tbl_contactus')->row();

		echo json_encode(array('total'=>$row->total));
	}

	public function totalRefresh(){
		$this->db->select("count(*) as total");
		$row = $this->db->get('tbl_contactus')->row();
		echo json_encode(array('total'=>$row->total));
	}

	public function upload(){
		$config['upload_path']          = './assets/uploads/pdf';
		$config['allowed_types']        = 'pdf';
		$config['max_size']	= 0;
		$error = '';
		$data = array();


		$new_name = uniqid();
		$config['file_name'] = $new_name;

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
			 $this->db->update('tbl_user',array('capability_statement_pdf'=>$data['upload_data']['file_name']),array('id'=>$id));


		}

		echo json_encode(array('status'=>$status,'data'=>$data,'error'=>$error ));
	}

}
