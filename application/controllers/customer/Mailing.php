<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailing extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/mailing/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'mailing';
        $this->mHeader['title'] = 'Mailing';
        $this->mContent['msg'] = "";
        $this->load->model(array('Contact_model'));

    }

    /*
    * Mailing
    * */
    public function index(){
        $this->mHeader['sub_id'] = 'mailing';
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function get_Mailing(){
        $table_data['data'] = $this->Contact_model->find(array(), array(), array(), true);

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
        }
        echo json_encode($table_data);
    }
}