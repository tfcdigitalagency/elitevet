<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends MY_Controller {
	public $mLayout = 'marketing/';
	public $sub_mLayout = 'marketing/package/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'package';
		$this->mHeader['title'] = 'Land Ads';
		$this->mContent['msg'] = "";
	}
	public function test(){
		echo 'test';
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
		$data = $this->db->get_where('mark_package',array())->result_array();

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
		$article_id = $this->input->post('article_id');
		$pack_name = $this->input->post('pack_name');
		$description = $this->input->post('description');
		$price = $this->input->post('price');
		$unit = $this->input->post('unit');
		$popular = $this->input->post('popular');
		$status = $this->input->post('status');
		$details = array();

		$detailPost = $this->input->post('detail');
		foreach ($detailPost['options'] as $key => $value) {
			$details[] = array(
			'options' => $value,
			'price'=>$detailPost['price'][$key],
			'note'=>$detailPost['note'][$key],
			'require'=>$detailPost['require'][$key]
			);
		}
		//echo '<pre>';print_r($options);die();

		if($article_id){
			$old = $this->db->get_where('mark_package',array('id'=>$article_id))->row_array();
			if($old) {

				$data = array(
					'pack_name' => $pack_name,
					'description' => $description,
					'price' => $price,
					'unit' => $unit,
					'popular' => $popular,
				    'status' => $status,
				    'detail' => json_encode($details),
					'created_at' => date("Y-m-d H:i:s")
				);
				$this->db->update('mark_package', $data, array('id' => $article_id));
			}

		}else { 

			$data = array(
				'pack_name' => $pack_name,
				'description' => $description,
				'price' => $price,
				'unit' => $unit,
				'popular' => $popular,
				'status' => $status,
				'detail' => json_encode($details),
				'created_at' => date("Y-m-d H:i:s")
			);			 
			$this->db->insert('mark_package', $data);
			$new_article_id = $this->db->insert_id();

		}

		echo json_encode($data);

	} 

	public function edit(){

		$this->mHeader['sub_id'] = 'view';
		$id = $this->input->get('id');
		$this->mContent['data'] = $this->db->get_where('mark_package',array('id'=>$id))->row_array();
		$this->render("{$this->sub_mLayout}edit", $this->mLayout);
	}


	public function delete(){
		$id = $this->input->post('id');
		$this->db->delete('mark_package',array('id'=>$id));
	}

}
