<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/contact/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'contact';
        $this->mHeader['title'] = 'Contact';
        $this->mContent['msg'] = "";
        $this->load->model(array('Contact_model'));
    }

    /*
    * Contact
    * */
    public function index(){
        $this->mHeader['sub_id'] = 'contact';
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function insert_Contact(){
        $data = $this->input->post();
        $data['created_at'] = date("Y-m-d H:i:s");
        $this->Contact_model->setTable('tbl_contactus');
        $this->Contact_model->insert($data);
    }
}