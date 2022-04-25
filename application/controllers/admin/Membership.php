<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/membership/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'membership';
        $this->mHeader['title'] = 'Membership';
        $this->mContent['msg'] = "";
        $this->load->model(['Membership_model']);
    }

    public function index(){

        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function get_Membership(){
        $table_data['data'] = $this->Membership_model->find(array(), array(), array(), true);
        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
        }
        echo json_encode($table_data);
    }

    public function add(){
       
        //$this->mHeader['sub_id'] = 'add';
        $this->mContent['data'][0]['id']='0';
        $this->render("{$this->sub_mLayout}add", $this->mLayout);
    }

    public function edit(){
        
       // $this->mHeader['sub_id'] = 'view';
        $id = $this->input->get('id');
        $this->mContent['data'] = $this->Membership_model->find(array("id"=>$id), array(), array(), true);
       
        $this->render("{$this->sub_mLayout}edit", $this->mLayout);
    }


   public function insert_Membership(){

       $data = $this->input->post();
       
       if ($data['id'] == "0"){
          $data['created_at'] = date('Y-m-d H:i:s');
          $this->Membership_model->insert(array("name"=>$data['name'],"cost"=>$data['cost'],"details"=>$data['details'],"created_at"=>$data['created_at']));
       }else{
           $this->Membership_model->update(array("id"=>$data['id']),array("name"=>$data['name'],"cost"=>$data['cost'],"details"=>$data['details'],"created_at"=>$data['created_at']));
           
       }
       
   }

    public function del_Membership(){
        $id = $this->input->post('id');
        $result['msg'] = $this->Membership_model->delete(array("id"=>$id));
    }
   
}