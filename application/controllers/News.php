<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	public $mLayout = 'customer/';
    public $sub_mLayout = 'news/';

	function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'news';
        $this->mHeader['title'] = 'News';
        $this->mContent['msg'] = "";
        $this->load->model(['News_model']);
    }


	public function index(){
        $this->mHeader['sub_id'] = 'news';
		$current_user =  $this->session->userdata('user');
		$uid = $current_user['id'];

		$this->db->order_by('created_at','desc');
		$this->mContent['articles'] = $this->db->get_where('tbl_news',array('status'=>1))->result_array();

		$this->render("{$this->sub_mLayout}list", $this->mLayout);
    }

	public function article($slug){

		$article = $this->db->get_where('tbl_news',array('slug'=>$slug,'status'=>1))->row_array();

		$this->mContent['article'] = $article;

		$this->db->order_by('created_at','desc');
		$orthers = $this->db->get_where('tbl_news',array('slug<>'=>$slug,'status'=>1))->result_array();
		$this->mContent['orthers'] = $orthers;

		$this->render("{$this->sub_mLayout}page", $this->mLayout);
	}


	protected function render($view, $layout = '') {
		$flash = $this->session->flashdata('flash');
		if ($flash) {
			$this->mHeader['flash'] = $flash;
			$this->session->unset_userdata('flash');
		}

		$alert = $this->session->userdata('alert');
		if ($alert) {
			$this->mContent['alert'] = $alert;
			$this->session->unset_userdata('alert');
		}

		$this->load->view("layout/{$layout}header", $this->mHeader);
		$this->load->view($view, $this->mContent);
		$this->load->view("layout/{$layout}footer", $this->mFooter);
	}

	protected function redirect($url) {
		redirect(base_url($url));
	}

	protected function json($data) {
		$json = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($json);
	}

	protected function success($result = NULL) {
		$data['success'] = true;
		if($result)
			$data['result'] = $result;
		$this->json($data);
	}

	protected function error($result = NULL) {
		$data['success'] = false;
		if($result)
			$data['result'] = $result;
		$this->json($data);
	}

}
