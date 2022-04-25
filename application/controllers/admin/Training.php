<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/third_party/PHPExcel.php';

class Training extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/training/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'training';
        $this->mHeader['title'] = 'Training';
        $this->mContent['msg'] = "";
        $this->load->model(array('Training_model','Training_type_model'));
    }

    public function view(){
        $this->mHeader['sub_id'] = 'view';
        $this->mContent['checked_user'] = count($this->Training_model->find(array("show_on_landing_page"=>'1'), array(), array(), true))+1;
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function add(){
       
        $this->mHeader['sub_id'] = 'add';
        $this->mContent['data'][0]['id']='0';
        $this->mContent['training_type'] = $this->Training_type_model->find(array(), array(), array(), true);
        $this->render("{$this->sub_mLayout}add", $this->mLayout);
    }

    public function edit(){
        
        $this->mHeader['sub_id'] = 'view';
        $id = $this->input->get('id');
        $this->mContent['data'] = $this->Training_model->find(array("id"=>$id), array(), array(), true);//var_dump($this->mContent['data']);die();
        $this->mContent['training_type'] = $this->Training_type_model->find(array(), array(), array(), true);
        $this->render("{$this->sub_mLayout}edit", $this->mLayout);
    }

    public function get_Training(){
        $table_data['data'] = $this->Training_model->get_Training();

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
        }
        echo json_encode($table_data);
    }

   public function insert_Training(){
       $data = $this->input->post();

       if ($data['id'] == "0"){
           $data['uploaded_at'] = date("Y-m-d H:i:s");
           $insert_ID = $this->Training_model->insert($data);
       }else{
           $this->Training_model->update(array("id"=>$data['id']), array("title"=>$data['title'],"training_type"=>$data['training_type'], "details"=>$data['details'], "video_link"=>$data['video_link']));
           $insert_ID = $data['id'];
       }
       
       // if (!empty($_FILES['image']['name'])) {
       //     if( !file_exists('./assets/uploads/training/') )
       //         mkdir('./assets/uploads/training/', 0777, true);
       //     $file_name = time().$_FILES['image']['name'];

       //     if (move_uploaded_file($_FILES['image']['tmp_name'],'assets/uploads/training/'.$file_name)) {
       //         $this->Training_model->update(array("id"=>$insert_ID), array("image"=>'assets/uploads/training/'.$file_name));
       //     }
       // }
   }

    public function del_Training(){
        $id = $this->input->post('id');
        $result['msg'] = $this->Training_model->delete(array("id"=>$id));
    }

     public function export_Training(){
        $result = $this->Training_model->find(array(), array(), array(), true);

        foreach ($result as $key => $row) {
            $result[$key]["no"] = $key + 1;
        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        $pCol = 0;
        $pRow = 1;

        $field_name = array('No', 'Title', 'Description', 'Video_link');

        for ($pCol = 0; $pCol < count($field_name); $pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$field_name[$pCol]);
        }

        $pCol = 0;
        $pRow = 2;

        foreach ($result as $row) {

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['no']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['title']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['details']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['video_link']);
            $pCol++;

            $pCol = 0;
            $pRow++;
        }

        $file_name = "Training Export " . date('Y-m-d H:i:s') . ".xls";
        header('Content-Encoding: utf-8');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: inline;filename='. $file_name.'');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    function update_Landing_Page(){

      $data = $this->input->post();
       
      $this->Training_model->update(array("id"=>$data['id']), array("show_on_landing_page"=>$data['state']));
    }

    function update_Webinar(){

      $data = $this->input->post();
       
      $this->Training_model->update(array("id"=>$data['id']), array("show_on_webinar"=>$data['state']));
    }
}