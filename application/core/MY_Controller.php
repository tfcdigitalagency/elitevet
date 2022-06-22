<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected $mHeader = array();
    protected $mContent = array();
    protected $mFooter = array();
    protected $mUser;
    protected $mLang;
    protected $mNotification;

    function __construct() {
        parent::__construct();

		hit_counter();

        $this->mUser = $this->session->userdata('user');
        $this->is_admin = $this->session->userdata('user')['is_admin'];
        $this->membership = 0;
        $this->isadmin = 0;
        if($this->session->userdata('user')['membership_id'] != null | $this->session->userdata('user')['membership_id'] != 0){
            $this->membership = $this->session->userdata('user')['membership_id'];
        }
        if($this->session->userdata('user')['is_admin'] != null | $this->session->userdata('user')['is_admin'] != 0){
            $this->isadmin = $this->session->userdata('user')['is_admin'];
        }


        $seg1 = $this->uri->segment(1);
        $seg2 = $this->uri->segment(2);

        if (empty($this->mUser)) {
            if ($seg1 == "") {
                $this->redirect('customer/home');
            } else if ($seg1 == 'customer') {
                // if ($seg2 != 'home')
                    // $this->redirect('customer/home');
            } else {
                if ($seg1 != 'auth')
                    $this->redirect('auth/login');
            }
        // Redirect to customer page if is not admin
        }else{
            if ($seg1 == 'admin') {
                if($this->mUser['is_admin'] == 0){
                    $this->redirect('customer/home');
                }
            }
        }
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
