<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/third_party/PHPExcel.php';

require 'system/PHPMailer.php';

class Postbids extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/postbids/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'postbids';
        $this->mHeader['title'] = 'Bid Email Sent Log';
        $this->mContent['msg'] = "";
        $this->load->model(array('Bidemailsent_model'));
        $this->load->model(array('Webinar_model'));
        $this->load->model(array('Settings_model'));
    }

    /*
	 * Contract
	 * */
	public function view(){
		$this->mHeader['sub_id'] = 'postbids'; 
		
		$row = $this->db->get_where('tbl_config',array('code'=>'TOKEN1'))->row_array();
		$this->mContent['token'] = $row;
		$this->render("{$this->sub_mLayout}contract_list", $this->mLayout);
	}
	
	public function get_Contract(){

		$this->Webinar_model->setTable('tbl_contract');
		$table_data['data'] = $this->Webinar_model->find(array(), array("created_at"=>'DESC'), array(), true);

		foreach ($table_data['data'] as $key => $row) {
			$table_data['data'][$key]["no"] = $key + 1;
			$table_data['data'][$key]['company_type_name'] = $this->get_company_type($row['company_type']);
		}
		echo json_encode($table_data);
	}
	
	public function get_company_type($id){
		if($id){
			$row = $this->db->get_where('tbl_company_type',array('id'=>$id))->row();
			return $row->title;
		}
		
	}
	
	public function download_bids(){
		 $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $query = $this->db->query("SELECT * FROM tbl_contract");
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('CSV_Report.csv', $data);
	}
	
	public function add(){

		$this->mHeader['sub_id'] = 'postbids';
		$this->mContent['data'][0]['id']='0';
		
		$company_type = $this->db->get_where('tbl_company_type',array())->result_array();
		$this->mContent['company_type'] = $company_type;
			 
		$this->render("{$this->sub_mLayout}contract_add", $this->mLayout);
	}

	public function del_Contract(){
		$id = $this->input->post('id');
		$this->Webinar_model->setTable('tbl_contract');
		$result['msg'] = $this->Webinar_model->delete(array("id"=>$id));
	}

	public function contract_edit(){

		$this->mHeader['sub_id'] = 'postbids';
		$id = $this->input->get('id');
		$this->Webinar_model->setTable('tbl_contract');
		$this->mContent['data'] = $this->Webinar_model->find(array("id"=>$id), array(), array(), true);

		$company_type = $this->db->get_where('tbl_company_type',array())->result_array();
		$this->mContent['company_type'] = $company_type;
			 
		$this->render("{$this->sub_mLayout}contract_edit", $this->mLayout);
	}

	public function insert_contract(){
		$data = $this->input->post();
		$this->Webinar_model->setTable('tbl_contract');

		if ($data['id'] == "0"){
			$data_insert = array(
				"title"=>$data['title'],
				"details"=>$data['details'],
				"company"=>$data['company'],
				"company_type"=>$data['company_type'],
				"name"=>$data['name'],
				"name"=>$data['name'],
				"email"=>$data['email'],
				"phone"=>$data['phone'],
				"start_date"=>date("Y-m-d",strtotime($data['start_date'])),
				"end_date"=>date("Y-m-d",strtotime($data['end_date'])),
				"details"=>$data['details'],
				"sponsor"=>$data['sponsor'],
				"status"=>$data['status'],
				"type"=>$data['type']
			);
			
			$insert_ID = $this->Webinar_model->insert($data_insert);
			
			if($data['status'] == 'available' && $data_insert['company_type']){
				$users = $this->db->get_where('tbl_user',
				array('company_type'=>$data_insert['company_type']))->result();
				 $data_insert['id'] = $insert_ID;
				if(!empty($users)){
					foreach($users as $user){
						$email = $user->email;			
						$email_content = $this->load->view('email/job',
						array('data'=>$data_insert),true);
						 
						$subject = 'New Opportunity - '.$data['title'];
						$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$user->name.'&t='.$user->phone.'&type='.$user->company.'&p=Email').'"/>';
						$pre_email = 'Hi '.$user->name.',<br> New opportunity has been submitted. Please check content bellow.<br>';
						$this->db->insert('tbl_email_queue',array('email'=>$email,
								'content'=>$pre_email.$email_content. $image_refer,
								'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));
					}
				}
			}
		}else{
			$data_update =  array(
				"title"=>$data['title'],
				"details"=>$data['details'],
				"company"=>$data['company'],
				"company_type"=>$data['company_type'],
				"name"=>$data['name'],
				"name"=>$data['name'],
				"email"=>$data['email'],
				"phone"=>$data['phone'],
				"start_date"=>date("Y-m-d",strtotime($data['start_date'])),
				"end_date"=>date("Y-m-d",strtotime($data['end_date'])),
				"details"=>$data['details'],
				"sponsor"=>$data['sponsor'],
				"status"=>$data['status'],
				"type"=>$data['type']
			);
			
			$this->Webinar_model->update(array("id"=>$data['id']), $data_update);
			$insert_ID = $data['id'];
			 
			if($data['status'] == 'available' && $data_update['company_type']){
				
				$users = $this->db->get_where('tbl_user',
				array('company_type'=>$data_update['company_type']))->result();
				 $data_update['id'] = $insert_ID;
				if(!empty($users)){
					foreach($users as $user){
						$email = $user->email;			
						$email_content = $this->load->view('email/job',
						array('data'=>$data_update),true);
						 
						$subject = 'New Opportunity - '.$data['title'];
						$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$user->name.'&t='.$user->phone.'&type='.$user->company.'&p=Email').'"/>';
						$pre_email = 'Hi '.$user->name.',<br> New opportunity has been submitted. Please check content bellow.<br>';
						$this->db->insert('tbl_email_queue',array('email'=>$email,
								'content'=>$pre_email.$email_content. $image_refer,
								'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));
					}
				}
			}
		}

		if (!empty($_FILES['thumbnail']['name'])) {
			if( !file_exists('./assets/uploads/webinar/contract') )
				mkdir('./assets/uploads/webinar/contract', 0777, true);
			$file_name = time().$_FILES['thumbnail']['name'];

			if (move_uploaded_file($_FILES['thumbnail']['tmp_name'],'assets/uploads/webinar/contract'.$file_name)) {
				$this->Webinar_model->update(array("id"=>$insert_ID), array("thumbnail"=>'assets/uploads/webinar/contract'.$file_name));
			}
		}

		if (!empty($_FILES['second_thumbnail']['name'])) {
			if( !file_exists('./assets/uploads/webinar/contract') )
				mkdir('./assets/uploads/webinar/contract', 0777, true);
			$second_file_name = time().$_FILES['second_thumbnail']['name'];

			if (move_uploaded_file($_FILES['second_thumbnail']['tmp_name'],'assets/uploads/webinar/contract'.$second_file_name))
				$this->Webinar_model->update(array("id"=>$insert_ID), array("second_thumbnail"=>'assets/uploads/webinar/contract'.$second_file_name));
		}
	}
	
	
	public function create_link(){

		 $hash = md5(uniqid("postbids"));
		 $data = array(
			'hash'=>$hash,
			'created'=>date("Y-m-d H:i:s")
		 );
		 $ok = $this->db->insert('tbl_contract_link',$data);
		 $link = site_url('postbid/create/'.$hash);
		 echo json_encode(array('ok'=>$ok,'url'=>$link));
	}

}
