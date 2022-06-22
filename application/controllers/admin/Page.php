<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/page/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'page';
		$this->mHeader['title'] = 'Page Management';
		$this->mContent['msg'] = "";
		$this->page_code = strtoupper($_GET['page']);
	}

	public function index(){
		$this->mHeader['sub_id'] = $this->page_code;
		$page_content = $this->db->get_where('tbl_config',array('code'=>$this->page_code))->row();
		$this->mContent['page_code'] =  $this->page_code;
		if($page_content ){
			$page_content = json_decode($page_content->detail);
		}else{
			$page_content = new stdClass();
			$page_content->title ="";
			$page_content->content ="";
		}

		$this->mContent['page_content'] = $page_content;
		$this->render("{$this->sub_mLayout}index", $this->mLayout);
	}

	public function save(){
		$data = $this->input->post();
		$data['content'] = str_replace('src="../assets','src="https://ncdeliteveterans.org/assets',$data['content']);
		$config = $this->db->get_where('tbl_config',array('code'=>$this->page_code))->row();
		if(!$config){
			$this->db->insert('tbl_config' ,array('code'=>$this->page_code,'detail'=>json_encode($data)));
		}else{
			$this->db->update('tbl_config' ,array('detail'=>json_encode($data)),array('code'=>$this->page_code));
		}

		echo json_encode(array('message'=>'Success.'));

	}
}
