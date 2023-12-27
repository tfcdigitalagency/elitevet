<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunities extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/opportunities/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'opportunities';
        $this->mHeader['title'] = 'Opportunities';
        $this->mContent['msg'] = "";
		$this->load->model(['Opportunities_model']);
		$this->load->model(['Webinar_model']);
    }

    /*
    * Training
    * */
    public function index($record=0){
		$this->load->library('pagination');
        $this->mHeader['sub_id'] = 'opportunities';
		$per_page = 50;
		
		$total = $this->db->select('count(*) as total')->get_where('tbl_contract',array('status'=>'available','type'=>1))->row();
		
		$this->db->order_by('id','DESC');
		$current_user =  $this->session->userdata('user');
		
		$config['base_url'] = site_url('/customer/opportunities/index');
		$config['total_rows'] = $total->total;
		$config['per_page'] = $per_page;
		
		$offset = $record;

		if(!$current_user){
			$this->db->limit(2);
		}else{
			$this->db->limit($per_page,$offset);
		}
		
		$list = $this->db->get_where('tbl_contract',array('status'=>'available','type'=>1))->result_array();
		$this->pagination->initialize($config);
		
		
        $this->mContent['current_user']  = $current_user;
        $this->mContent['checkPostBid']  = $this->checkPostBid();
		$this->mContent['opportunities'] = $list;
		$this->mContent['paging'] = $this->pagination->create_links();
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

	public function detail($id){
		$this->mHeader['sub_id'] = 'opportunities';
		$this->mContent['opportunity'] = $this->db->get_where('tbl_contract',array('id'=>$id))->row_array();
		$this->render("{$this->sub_mLayout}detail", $this->mLayout);
	}

	public function checkPostBid(){
		$current_user =  $this->session->userdata('user');
		return $current_user['title'] == 'Corporate' || $current_user['title'] == 'Other';
	}

	public function mybids(){
		if(!$this->checkPostBid()){
			$this->redirect('customer/opportunities/denied');
		}

		$this->mHeader['sub_id'] = 'opportunities';

		$this->db->order_by('id','DESC');
		$current_user =  $this->session->userdata('user');

		$this->db->where('created_id',$current_user['id']);
		$this->mContent['current_user']  = $current_user;
		$this->mContent['opportunities'] = $this->db->get_where('tbl_contract',array('status'=>'available','type'=>1))->result_array();

		$this->render("{$this->sub_mLayout}mybids", $this->mLayout);
	}

	public function add(){
		if(!$this->checkPostBid()){
			$this->redirect('customer/opportunities/denied');
		}

		$this->mHeader['sub_id'] = 'postbids';
		$this->mContent['data'][0]['id']='0';
		$this->render("{$this->sub_mLayout}contract_add", $this->mLayout);
	}

	public function delete($id){
		if(!$this->checkPostBid()){
			$this->redirect('customer/opportunities/denied');
		}
		$current_user =  $this->session->userdata('user');
		$this->db->where('created_id',$current_user['id']);
		$this->db->where('id',$id);
		$this->db->delete('tbl_contract');
		$this->redirect('customer/opportunities/mybids');
	}

	public function edit($id){
		if(!$this->checkPostBid()){
			$this->redirect('customer/opportunities/denied');
		}
		$this->mHeader['sub_id'] = 'postbids';

		$this->Webinar_model->setTable('tbl_contract');
		$this->mContent['data'] = $this->Webinar_model->find(array("id"=>$id), array(), array(), true);

		$this->render("{$this->sub_mLayout}contract_edit", $this->mLayout);
	}

	public function insert_contract(){
		if(!$this->checkPostBid()){
			$this->redirect('customer/opportunities/denied');
		}
		$data = $this->input->post();
		$this->Webinar_model->setTable('tbl_contract');
		$current_user =  $this->session->userdata('user');

		if ($data['id'] == "0"){
			$insert_ID = $this->Webinar_model->insert(array(
				"title"=>$data['title'],
				"details"=>$data['details'],
				"company"=>$data['company'],
				"name"=>$data['name'],
				"name"=>$data['name'],
				"email"=>$data['email'],
				"phone"=>$data['phone'],
				"start_date"=>date("Y-m-d",strtotime($data['start_date'])),
				"end_date"=>date("Y-m-d",strtotime($data['end_date'])),
				"details"=>$data['details'],
				"sponsor"=>$data['sponsor'],
				"status"=>'available',
				"type"=>1,
				"created_id"=>$current_user['id']
			));
		}else{
			$this->Webinar_model->update(array("id"=>$data['id']), array(
				"title"=>$data['title'],
				"details"=>$data['details'],
				"company"=>$data['company'],
				"name"=>$data['name'],
				"name"=>$data['name'],
				"email"=>$data['email'],
				"phone"=>$data['phone'],
				"start_date"=>date("Y-m-d",strtotime($data['start_date'])),
				"end_date"=>date("Y-m-d",strtotime($data['end_date'])),
				"details"=>$data['details'],
				"sponsor"=>$data['sponsor']
			));
			$insert_ID = $data['id'];
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

	public function denied(){

		$this->mHeader['sub_id'] = 'postbids';
		$this->mContent['data'][0]['id']='0';
		$this->render("{$this->sub_mLayout}denied", $this->mLayout);
	}
}
