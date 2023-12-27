<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/company_type/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'company_type';
		$this->mHeader['title'] = 'Company Type';
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
		$this->db->order_by('id','desc');
		$data = $this->db->get_where('tbl_company_type',array())->result_array();

		foreach ($data as $k=>$v){

			$data[$k]['title'] = $v['title'] ;			 
			 		 
			if($v['image1']) {
				$data[$k]['image1'] = '<img src="' . base_url() . $v['image1'] . '" width="100" height="100"/>';
			}
			if($v['image2']) {
				$data[$k]['image2'] = '<img src="' . base_url() . $v['image2'] . '" width="100" height="100"/>';
			}
			if($v['image3']) {
				$data[$k]['image3'] = '<img src="' . base_url() . $v['image3'] . '" width="100" height="100"/>';
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
			$old = $this->db->get_where('tbl_company_type',array('id'=>$article_id))->row_array();
			if($old) {				 
				$title = $this->input->post('title');
				$photo1 = $this->input->post('image1'); 
				$photo2 = $this->input->post('image2'); 
				$photo3 = $this->input->post('image3'); 
				$data = array(
					'title' => $title 
				);
				
				if($photo1){
					$data['image1'] = $photo1; 
				}
				if($photo2){
					$data['image1'] = $photo2; 
				}
				if($photo3){
					$data['image1'] = $photo3; 
				}				
				
				$this->db->update('tbl_company_type', $data, array('id' => $article_id));
				 
			}

		}else { 
			$title = $this->input->post('title');
			$photo1 = $this->input->post('image1');
			$photo2 = $this->input->post('image2');
			$photo3 = $this->input->post('image3');
			$data = array(
				'title' => $title,
				'image1' => $photo1,
				'image2' => $photo2,
				'image3' => $photo3,
				'created' => date("Y-m-d H:i:s")
			);			 
			$this->db->insert('tbl_company_type', $data);			 
			$new_article_id = $this->db->insert_id(); 
		} 
		 

		if (!empty($_FILES['image1']['name'])) {
			if( !file_exists('./assets/uploads/company_type/') )
				mkdir('./assets/uploads/company_type/', 0777, true);
			$file_name = time().$_FILES['image1']['name'];
			if($new_article_id){
				$article_id = $new_article_id;
			}
			

			if (move_uploaded_file($_FILES['image1']['tmp_name'],'assets/uploads/company_type/'.$file_name)) {
				$this->db->update('tbl_company_type', array("image1"=>'assets/uploads/company_type/'.$file_name), array('id' => $article_id));
				 
			}
		} 
		
		if (!empty($_FILES['image2']['name'])) {
			if( !file_exists('./assets/uploads/company_type/') )
				mkdir('./assets/uploads/company_type/', 0777, true);
			$file_name = time().$_FILES['image2']['name'];
			if($new_article_id){
				$article_id = $new_article_id;
			}
			

			if (move_uploaded_file($_FILES['image2']['tmp_name'],'assets/uploads/company_type/'.$file_name)) {
				$this->db->update('tbl_company_type', array("image2"=>'assets/uploads/company_type/'.$file_name), array('id' => $article_id));
				 
			}
		} 
		
		if (!empty($_FILES['image3']['name'])) {
			if( !file_exists('./assets/uploads/company_type/') )
				mkdir('./assets/uploads/company_type/', 0777, true);
			$file_name = time().$_FILES['image3']['name'];
			if($new_article_id){
				$article_id = $new_article_id;
			}
			

			if (move_uploaded_file($_FILES['image3']['tmp_name'],'assets/uploads/company_type/'.$file_name)) {
				$this->db->update('tbl_company_type', array("image3"=>'assets/uploads/company_type/'.$file_name), array('id' => $article_id));
				 
			}
		} 

		echo json_encode($data);

	} 

	public function edit(){

		$this->mHeader['sub_id'] = 'view';
		$id = $this->input->get('id');
		$this->mContent['data'] = $this->db->get_where('tbl_company_type',array('id'=>$id))->row_array();
		$this->render("{$this->sub_mLayout}edit", $this->mLayout);
	}


	public function delete(){
		$id = $this->input->post('id');
		$this->db->delete('tbl_company_type',array('id'=>$id));
	}

}
