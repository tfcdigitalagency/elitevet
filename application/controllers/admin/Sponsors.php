<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsors extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/sponsors/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'sponsors';
        $this->mHeader['title'] = 'Sponsors';
        $this->mContent['msg'] = "";
        $this->load->model(['Sponsors_model']);
    }

    public function index(){
        $this->Sponsors_model->setTable('tbl_sponsor_image');
        $this->mContent['sponsor_image'] = $this->Sponsors_model->find(array(), array("date_inserted"=>'DESC'), array(), true);

        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function getSponsors(){
        $table_data['data'] = $this->Sponsors_model->find(array(), array(), array(), true);
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
        $this->mContent['data'] = $this->Sponsors_model->find(array("id"=>$id), array(), array(), true);

        $this->render("{$this->sub_mLayout}edit", $this->mLayout);
    }


   public function insert_Sponsors(){
       $data = $this->input->post();

	   $company = $this->input->post('company');
	   $email = $this->input->post('email');
	   $name = $this->input->post('name');
	   $phone = $this->input->post('phone');
	   $url = $this->input->post('url');
	   $status = $this->input->post('status');
	   $sponsors_id = $this->input->post('sponsors_id');

	   $return['status'] = 1;

	   $sponsor = array(
			 'uid'=>$id,
			 'company'=>$company,
			 'name'=>$name,
			 'email'=>$email,
			 'phone'=>$phone,
			 'url'=>$url,
			 'status'=>$status);

       if (!$sponsors_id){
           $insert_ID = $this->Sponsors_model->insert($sponsor);
		   $return['message'] = 'Insert successfully';
       }else{
           $this->Sponsors_model->update(array("id"=>$sponsors_id),$sponsor);
           $insert_ID = $data['id'];
		   $return['message'] = 'Update successfully';
       }

       if (!empty($_FILES['icon']['name'])) {
           if( !file_exists('./assets/uploads/sponsors/') )
               mkdir('./assets/uploads/sponsors/', 0777, true);
           $file_name = time().$_FILES['icon']['name'];

           if (move_uploaded_file($_FILES['icon']['tmp_name'],'assets/uploads/sponsors/'.$file_name)) {
               $this->Sponsors_model->update(array("id"=>$insert_ID), array("icon"=>'assets/uploads/sponsors/'.$file_name));
           }
       }

	   echo json_encode($return);
   }

    public function del_Sponsors(){
        $id = $this->input->post('id');
        $result['msg'] = $this->Sponsors_model->delete(array("id"=>$id));
    }

    public function save_Gallery(){
        $data = $this->input->post();

        $this->Sponsors_model->setTable('tbl_sponsor_image');
        $insert_ID = 0;

        if (!empty($_FILES['input_sponsor']['name'])) {
            if( !file_exists('./assets/uploads/sponsors_image/') )
            mkdir('./assets/uploads/sponsors_image/', 0777, true);
            $file_name = time().$_FILES['input_sponsor']['name'];

            if (move_uploaded_file($_FILES['input_sponsor']['tmp_name'],'assets/uploads/sponsors_image/'.$file_name)) {
                $data['date_inserted'] = date("Y-m-d H:i:s");
                $data['link'] = 'assets/uploads/sponsors_image/'.$file_name;
                $insert_ID = $this->Sponsors_model->insert($data);
            }
        }
    }

    public function del_Gallery(){
        $id = $this->input->post('id');
        $this->Sponsors_model->setTable('tbl_sponsor_image');
        $item = $this->Sponsors_model->find(array("id" => $id), array(), array(), true);

        if(count($item) > 0){
            try {
                unlink($item[0]['link']);
            }catch (Exception $e){

            }
            $result['msg'] = $this->Sponsors_model->delete(array("id"=>$id));
        }
    }

}
