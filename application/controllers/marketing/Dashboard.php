<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/dashboard/';

    function __construct()
    {
        parent::__construct();
        $this->mHeader['id'] = 'dashboard';
        $this->mHeader['title'] = 'Dashboard';
        $this->mContent['msg'] = "";
    }

    public function index()
    {
        $this->mHeader['sub_id'] = 'view';
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }
}
