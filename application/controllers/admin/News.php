<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/news/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'news';
		$this->mHeader['title'] = 'News';
		$this->mContent['msg'] = "";
		$this->load->model(['News_model']);
	}

	public function list(){
		$this->mHeader['sub_id'] = 'view';
		$this->render("{$this->sub_mLayout}index", $this->mLayout);
	}

	public function get_data(){
		$this->db->select('*');
		$this->db->order_by('created_at','desc');
		$data = $this->db->get_where('tbl_news',array())->result_array();

		foreach ($data as $k=>$v){
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
		if($article_id){
			$detail = $this->input->post('detail');
			$title = $this->input->post('title');
			$photo = $this->input->post('photo');
			$data = array(
				'article_title'=>$title,
				'photo'=>$photo,
				'short'=>$this->input->post('short'),
				'detail'=>$detail,
				'status'=>$this->input->post('status'),
				'created_at'=>date("Y-m-d H:i:s")
			);
			$this->db->update('tbl_news',$data,array('id'=>$article_id));
		}else {
			$detail = $this->input->post('detail');
			$title = $this->input->post('title');
			$photo = $this->input->post('photo');
			$slug = get_article_slug($title);
			$data = array(
				'article_title' => $title,
				'photo' => $photo,
				'slug' => $slug,
				'short' => $this->input->post('short'),
				'detail' => $detail,
				'status' => $this->input->post('status'),
				'created_at' => date("Y-m-d H:i:s")
			);
			$this->db->insert('tbl_news', $data);
			$article_id = $this->db->insert_id();
		}

		if (!empty($_FILES['icon']['name'])) {
			if( !file_exists('./assets/uploads/news/') )
				mkdir('./assets/uploads/news/', 0777, true);
			$file_name = time().$_FILES['icon']['name'];

			if (move_uploaded_file($_FILES['icon']['tmp_name'],'assets/uploads/news/'.$file_name)) {
				$this->News_model->update(array("id"=>$article_id), array("photo"=>'assets/uploads/news/'.$file_name));
			}
		}

		echo json_encode($data);

	}

	public function edit(){

		$this->mHeader['sub_id'] = 'view';
		$id = $this->input->get('id');
		$this->mContent['data'] = $this->db->get_where('tbl_news',array('id'=>$id))->row_array();
		$this->render("{$this->sub_mLayout}edit", $this->mLayout);
	}


	public function delete(){
		$id = $this->input->post('id');
		$this->db->delete('tbl_news',array('id'=>$id));
	}

}
