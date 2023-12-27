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
		 
		switch($this->page_code){
			case 'REFERRALSHARE':
				$page = 'referralshare';
				break;
			case 'CAPSTA':
				$page = 'capsta';
				break;				
			default:
				$page = 'index';
		}
		
		$this->render("{$this->sub_mLayout}".$page, $this->mLayout);
	}

	public function save(){
		$data = $this->input->post();
		
		if (!empty($_FILES['image1']['name'])) {
			if( !file_exists('./assets/uploads/share') )
				mkdir('./assets/uploads/share', 0777, true);
			$file_name = time().$_FILES['image1']['name'];

			if (move_uploaded_file($_FILES['image1']['tmp_name'],'assets/uploads/share/'.$file_name)) {
				$data['image1'] = 'assets/uploads/share/'.$file_name;
			}
		}
		
		$config = $this->db->get_where('tbl_config',array('code'=>$this->page_code))->row();		
		if(!$config){
			$this->db->insert('tbl_config' ,array('code'=>$this->page_code,'detail'=>json_encode($data)));
		}else{
			$old_data = json_decode($config->detail);
			if(!isset($data['image1'])){
				$data['image1'] = $old_data->image1;
			}
			$this->db->update('tbl_config' ,array('detail'=>json_encode($data)),array('code'=>$this->page_code));
		}

		echo json_encode(array('message'=>'Success.'));

	}
}
