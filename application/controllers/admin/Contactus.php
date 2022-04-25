<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactus extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/contactus/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'contactus';
        $this->mHeader['title'] = 'Contactus';
        $this->mContent['msg'] = "";
        $this->load->model(['Contactus_model']);
    }

    public function index(){

        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function get_Contactus(){
        $table_data['data'] = $this->Contactus_model->find(array(), array("created_at"=>'ASC'), array(), true);
        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
        }
        echo json_encode($table_data);
    }

    public function insert_Contactus(){

       $data = $this->input->post();
       $data['created_at'] = date('Y-m-d H:i:s');
       $this->Contactus_model->insert(array("name"=>$data['name'], "email"=>$data['email'], "created_at"=>$data['created_at'], "phone"=>$data['phone'], "content"=>$data['content']));
       
       
   }

   public function update_Read(){

        $id = $this->input->post('id');
        $this->Contactus_model->update(array("id"=>$id),array("is_read"=>'1'));

    }

    public function del_Contactus(){
        $id = $this->input->post('id');
        $result['msg'] = $this->Contactus_model->delete(array("id"=>$id));
    }
   
}