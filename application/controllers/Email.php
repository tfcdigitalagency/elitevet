<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
	public $mLayout = 'customer/';
    public $sub_mLayout = 'survey/';

	function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'email';
        $this->mHeader['title'] = 'Email';
        $this->mContent['msg'] = "";
        $this->load->model(['Training_model','Sponsors_model']);
    }

	public function index(){

    }

	public function subscribe($email){
		if($email){
			$this->db->update('tbl_user',array('subscribe'=>1),array('email'=>$email));
			$this->session->set_flashdata('success','The '.$email.' has subscribed successfully.');
		}
		redirect('/');
	}

	public function unsubscribe($email){
		if($email){
			$this->db->update('tbl_user',array('subscribe'=>0),array('email'=>$email));
			$this->session->set_flashdata('success','The '.$email.' has unsubscribed successfully.');
		}

		redirect('/');
	}
}
