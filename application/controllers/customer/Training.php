<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/training/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'training';
        $this->mHeader['title'] = 'Training';
        $this->mContent['msg'] = "";        
        $this->load->model(['Training_model']);
    }

    /*
    * Training
    * */
    public function index(){
        $this->mHeader['sub_id'] = 'training';
        $this->mContent['training'] = $this->Training_model->find(array(), array(), array(), true);
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }
}