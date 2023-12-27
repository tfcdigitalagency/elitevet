<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
	public $mLayout = 'customer/';
    public $sub_mLayout = 'gallery/';

	function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'gallery';
        $this->mHeader['title'] = 'Gallery';
        $this->mContent['msg'] = "";
        $this->load->model(['Gallery_model']);
    }


	public function index(){
        $this->mHeader['sub_id'] = 'gallery';
		$current_user =  $this->session->userdata('user');
		$uid = $current_user['id'];

		$this->db->order_by('created','asc');
		$this->mContent['gallery'] = $this->db->get_where('tbl_event_gallery',array())->result_array();

		$this->render("{$this->sub_mLayout}list", $this->mLayout);
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


}
