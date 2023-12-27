<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Webinar_statistic extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/page/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'page';
		$this->mHeader['title'] = 'Webinar statistic';
		$this->mContent['msg'] = "";	
		$this->page_code = 'WEBINAR_STATISTIC';	
	}

	public function index(){
		$this->mHeader['sub_id'] = 'statistic';
		$page_content = get_config_content($this->page_code);
		$this->mContent['page_code'] =  $this->page_code;
		if(!$page_content ){			 
			$page_content = new stdClass();
			$page_content->title ="";
			$page_content->content ="";
		}

		$this->mContent['page_content'] = $page_content;
		$this->render("{$this->sub_mLayout}statistic", $this->mLayout);
	}

	public function save(){
		$data = $this->input->post(); 
		
		if (!empty($_FILES['pdf']['name'])) {
			if( !file_exists('./assets/uploads/sponsorad') )
				mkdir('./assets/uploads/sponsorad', 0777, true);
			$file_name = time().$_FILES['pdf']['name'];

			if (move_uploaded_file($_FILES['pdf']['tmp_name'],'assets/uploads/sponsorad/'.$file_name)) {
				$data['pdf'] = 'assets/uploads/sponsorad/'.$file_name;
			}
		}
		
		if (!empty($_FILES['image1']['name'])) {
			if( !file_exists('./assets/uploads/sponsorad') )
				mkdir('./assets/uploads/sponsorad', 0777, true);
			$file_name = time().$_FILES['image1']['name'];

			if (move_uploaded_file($_FILES['image1']['tmp_name'],'assets/uploads/sponsorad/'.$file_name)) {
				$data['image1'] = 'assets/uploads/sponsorad/'.$file_name;
			}
		}
		if (!empty($_FILES['image2']['name'])) {
			if( !file_exists('./assets/uploads/sponsorad') )
				mkdir('./assets/uploads/sponsorad', 0777, true);
			$file_name = time().$_FILES['image2']['name'];

			if (move_uploaded_file($_FILES['image2']['tmp_name'],'assets/uploads/sponsorad/'.$file_name)) {
				$data['image2'] = 'assets/uploads/sponsorad/'.$file_name;
			}
		}
		if (!empty($_FILES['image3']['name'])) {
			if( !file_exists('./assets/uploads/sponsorad') )
				mkdir('./assets/uploads/sponsorad', 0777, true);
			$file_name = time().$_FILES['image3']['name'];

			if (move_uploaded_file($_FILES['image3']['tmp_name'],'assets/uploads/sponsorad/'.$file_name)) {
				$data['image3'] = 'assets/uploads/sponsorad/'.$file_name;
			}
		}
		if (!empty($_FILES['image4']['name'])) {
			if( !file_exists('./assets/uploads/sponsorad') )
				mkdir('./assets/uploads/sponsorad', 0777, true);
			$file_name = time().$_FILES['image4']['name'];

			if (move_uploaded_file($_FILES['image4']['tmp_name'],'assets/uploads/sponsorad/'.$file_name)) {
				$data['image4'] = 'assets/uploads/sponsorad/'.$file_name;
			}
		}
		 
		update_config_content($this->page_code,$data);
		echo json_encode(array('message'=>'Success.'));

	}
}
