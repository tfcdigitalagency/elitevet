<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunities extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/opportunities/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'opportunities';
        $this->mHeader['title'] = 'Opportunities';
        $this->mContent['msg'] = "";
		$this->load->model(['Opportunities_model']);
    }

    /*
    * Training
    * */
    public function index(){
        $this->mHeader['sub_id'] = 'opportunities';
		$this->db->order_by('id','DESC');
        $this->mContent['opportunities'] = $this->db->get_where('tbl_contract',array('status'=>'available'))->result_array();
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

	public function detail($id){
		$this->mHeader['sub_id'] = 'opportunities';
		$this->mContent['opportunity'] = $this->db->get_where('tbl_contract',array('id'=>$id))->row_array();
		$this->render("{$this->sub_mLayout}detail", $this->mLayout);
	}
}
