<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Broadcasting extends CI_Controller { 
    public function index(){
		$this->load->model(array('User_model'));
		$hash = $_GET['host'];
		$check = $this->User_model->getUserLink($hash);
		 
		$data['hash'] = $hash;
		$data['data'] = $check;
		  
		
		$this->load->view("broadcasting/index",$data);
         
    }
	
	public function live($port){
		$data['port'] = $port;
		$this->load->view("broadcasting/live",$data);
	}
	
	public function view($port){
		$data['port'] = $port;
		$this->load->view("broadcasting/view",$data);
	}
	
	public function createLink(){
		$hash = md5(uniqid());
		$port = $this->input->post('port');
		$this->db->insert('tbl_broadcasting_share',array(
			'hash'=>$hash,
			'port'=>$port,
			'created'=>date("Y-m-d H:i:s")
		));
		$data["status"] = 1;
		$data["url"] = site_url("broadcasting?host=".$hash);
		echo json_encode($data);
		die();
	}
	
}
