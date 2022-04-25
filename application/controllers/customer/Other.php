<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/other/';

    function __construct() {
        parent::__construct();
        $this->mHeader['title'] = 'Other';
        $this->mContent['msg'] = "";
        $this->load->model(array('Webinar_model','User_model','Reg_history_model','Settings_model'));
    }

    /*
    * Other
    * */
    public function wedo(){
        $this->mHeader['id'] = 'wedo';
        $this->render("{$this->sub_mLayout}wedo", $this->mLayout);
    }

    public function membership(){
        $this->mHeader['id'] = 'membership';
        $this->render("{$this->sub_mLayout}membership", $this->mLayout);
    }

    public function find(){
        $this->mHeader['id'] = 'find';
        $this->render("{$this->sub_mLayout}find", $this->mLayout);
    }

    public function weare(){
        $this->mHeader['id'] = 'weare';
        $this->render("customer/home#who");
    }

    public function remind(){
        $this->mHeader['id'] = 'Remind';
        $this->load->view('customer/other/remind');
    }

    public function testemail(){
        $this->mHeader['id'] = 'TestEmail';
        $this->load->view('customer/other/testemail');
    }
}