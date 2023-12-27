<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/activity/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'activity';
        $this->mHeader['title'] = 'Activity';
        $this->mContent['msg'] = "";
        $this->load->model(['Gallery_model']);
		$this->load->helper('url');
    }

    public function index(){
        $this->Gallery_model->setTable('tbl_event_gallery');
        $this->mContent['sponsor_image'] = $this->Gallery_model->find(array(), array("created"=>'DESC'), array(), true);

        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function getActivity(){
        $table_data['data'] = $this->Gallery_model->find(array(), array(), array(), true);
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
        $this->mContent['data'] = $this->Gallery_model->find(array("id"=>$id), array(), array(), true);

        $this->render("{$this->sub_mLayout}edit", $this->mLayout);
    }


   public function insert_activity(){
       $data = $this->input->post();

	   $data_update = array(
		'title'=>$data['title'],
		'year'=>$data['year'],
		'content'=>$data['content'],
		'created'=>date("Y-m-d H:i:s"));
		
		//print_r($_FILES['file']);die();
		if(!empty($_POST['old_images'])){
			$image_data = $_POST['old_images'];
		}else{
			$image_data = array();
		}
		

        if (!empty($_FILES['file']['name'])) {
            if( !file_exists('./assets/uploads/activity_image/') )
            mkdir('./assets/uploads/activity_image/', 0777, true);
		
			foreach($_FILES['file']['name'] as $k=>$name ){
				$file_name = time().$name;

				if (move_uploaded_file($_FILES['file']['tmp_name'][$k],'assets/uploads/activity_image/'.$file_name)) {					 
					$image_data[] = 'assets/uploads/activity_image/'.$file_name;					
				}
			}			
        }
		
		$data_update['images'] = json_encode($image_data);

	    $insert_ID = $this->Gallery_model->insert($data_update);
		
	    redirect('admin/activity', 'refresh');
   }

    public function del_activity(){
        $id = $this->input->post('id');
        $result['msg'] = $this->Gallery_model->delete(array("id"=>$id));
    }

    public function save_Gallery(){
        $data = $this->input->post();

        $this->Gallery_model->setTable('tbl_event_gallery');
        $insert_ID = 0;
		
		//echo '<pre>'; print_r($data); die();
		$id = $data['id'];
		
		$data_update = array(
		'title'=>$data['title'],
		'year'=>$data['year'],
		'content'=>$data['content']);
		
		//print_r($_FILES['file']);die();
		if(!empty($_POST['old_images'])){
			$image_data = $_POST['old_images'];
		}else{
			$image_data = array();
		}
		

        if (!empty($_FILES['file']['name'])) {
            if( !file_exists('./assets/uploads/activity_image/') )
            mkdir('./assets/uploads/activity_image/', 0777, true);
		
			foreach($_FILES['file']['name'] as $k=>$name ){
				$file_name = time().$name;

				if (move_uploaded_file($_FILES['file']['tmp_name'][$k],'assets/uploads/activity_image/'.$file_name)) {					 
					$image_data[] = 'assets/uploads/activity_image/'.$file_name;					
				}
			}			
        }
		
		$data_update['images'] = json_encode($image_data);
		
		$this->Gallery_model->update(array('id'=>$id),$data_update);
		
		redirect('admin/activity', 'refresh');
    }

    public function del_Gallery(){
        $id = $this->input->post('id');
        $this->Gallery_model->setTable('tbl_event_gallery');
        $item = $this->Gallery_model->find(array("id" => $id), array(), array(), true);

        if(count($item) > 0){
            try {
                unlink($item[0]['link']);
            }catch (Exception $e){

            }
            $result['msg'] = $this->Gallery_model->delete(array("id"=>$id));
        }
    }

}
