<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landads extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/landads/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'landads';
		$this->mHeader['title'] = 'Land Ads';
		$this->mContent['msg'] = "";
	}
	
	public function index(){
		$this->list();
	}

	public function list(){
		$this->mHeader['sub_id'] = 'view';
		$this->render("{$this->sub_mLayout}index", $this->mLayout);
	}

	 
	public function get_data(){
		$this->db->select('*');
		$this->db->order_by('created_at','desc');
		$data = $this->db->get_where('tbl_landads',array())->result_array();

		foreach ($data as $k=>$v){

			$data[$k]['title'] = $v['title'] ;			 
			$data[$k]['status'] = $v['status']?'Active':'Normal' ;			 
			$data[$k]['link'] = $v['status']?$v['link_active']:$v['link_normal'] ;			 
			if($v['photo']) {
				$data[$k]['photo'] = '<img src="' . base_url() . $v['photo'] . '" width="100" height="100"/>';
			}
		}

		$table_data['data'] = $data;

		echo json_encode($table_data);
	}

	public function add(){

		$this->mHeader['sub_id'] = 'add';
		$this->mContent['data'][0]['id']='0';
		$this->render("{$this->sub_mLayout}add", $this->mLayout);
	}

	public function save_article(){
		$status = $this->input->post('status');
		$article_id = $this->input->post('article_id');
		if($article_id){
			$old = $this->db->get_where('tbl_landads',array('id'=>$article_id))->row_array();
			if($old) {				 
				$title = $this->input->post('title');
				$status = $this->input->post('status');
				$link_active = $this->input->post('link_active');
				$link_normal = $this->input->post('link_active');
				$photo = $this->input->post('image'); 
				$data = array(
					'title' => $title,
					'link_active' => $link_active,
				    'link_normal' => $link_normal,
				    'status' => $status,
					'created_at' => date("Y-m-d H:i:s")
				);
				
				if($photo){
					$data['photo'] = $photo; 
				} 
				
				$this->db->update('tbl_landads', $data, array('id' => $article_id));
			}

		}else { 
			$title = $this->input->post('title');
			$photo = $this->input->post('photo');
			$status = $this->input->post('status');
			$link_active = $this->input->post('link_active');
			$link_normal = $this->input->post('link_active');
			$data = array(
				'title' => $title,
				'photo' => $photo, 
				'link_active' => $link_active,
				'link_normal' => $link_normal,
				'status' => $status,
				'created_at' => date("Y-m-d H:i:s")
			);			 
			$this->db->insert('tbl_landads', $data);
			$new_article_id = $this->db->insert_id();


		} 
		 

		if (!empty($_FILES['icon']['name'])) {
			if( !file_exists('./assets/uploads/landads/') )
				mkdir('./assets/uploads/landads/', 0777, true);
			$file_name = time().$_FILES['icon']['name'];
			if($new_article_id){
				$article_id = $new_article_id;
			}
			

			if (move_uploaded_file($_FILES['icon']['tmp_name'],'assets/uploads/landads/'.$file_name)) {
				$this->db->update('tbl_landads', array("photo"=>'assets/uploads/landads/'.$file_name), array('id' => $article_id));
				 
			}
		} 

		echo json_encode($data);

	} 

	public function edit(){

		$this->mHeader['sub_id'] = 'view';
		$id = $this->input->get('id');
		$this->mContent['data'] = $this->db->get_where('tbl_landads',array('id'=>$id))->row_array();
		$this->render("{$this->sub_mLayout}edit", $this->mLayout);
	}


	public function delete(){
		$id = $this->input->post('id');
		$this->db->delete('tbl_landads',array('id'=>$id));
	}

}
