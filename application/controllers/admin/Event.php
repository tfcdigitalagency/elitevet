<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/third_party/PHPExcel.php';

require 'system/PHPMailer.php';

class Event extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/event/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'event';
        $this->mHeader['title'] = 'Event';
        $this->mContent['msg'] = "";
        $this->load->model(array('Event_model'));
        $this->load->model(array('Reg_history_model'));
        $this->load->model(array('Attend_history_model'));
        $this->load->model(array('Settings_model'));
    }

    public function view(){
        $this->mHeader['sub_id'] = 'view';
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }
	
	public function inperson($id){
        $this->mHeader['sub_id'] = 'view'; 
		$this->mContent['event'] = $this->Event_model->find(array("id"=>$id), array(), array(), true);
        $this->render("{$this->sub_mLayout}inperson", $this->mLayout);
    }

    public function add(){
       
        $this->mHeader['sub_id'] = 'add';
        $this->mContent['data'][0]['id']='0';
        $this->render("{$this->sub_mLayout}add", $this->mLayout);
    }

    public function edit(){
        
        $this->mHeader['sub_id'] = 'view';
        $id = $this->input->get('id');
        $this->mContent['data'] = $this->Event_model->find(array("id"=>$id), array(), array(), true);
       
        $this->render("{$this->sub_mLayout}edit", $this->mLayout);
    }


    public function get_Event(){
        $table_data['data'] = $this->Event_model->find(array(), array("created_at"=>'DESC'), array(), true);

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
			if($row['homepage']){
				$table_data['data'][$key]['name'].= ' <span style="color:red">(*)</span>';
			}
            $table_data['data'][$key]["real_register"] = $this->Reg_history_model->count(array("event_id"=>$row["id"]));
            $table_data['data'][$key]["real_attend"] = $this->Attend_history_model->count(array("event_id"=>$row["id"]));
			if($row["seats"]){
				$count = get_event_inperson($row["id"]);
				$table_data['data'][$key]["seats_registered"] = '<a href="'.site_url('admin/event/inperson/'.$row["id"]).'">'.$count.'/'.$row["seats"].'</a>';
			}else{
				$table_data['data'][$key]["seats_registered"] = $row["seats"];
			}
        }
        echo json_encode($table_data);
    }
	
	public function get_Event_local($id){
        $table_data['data'] = $this->db->get_where('tbl_event_book_inperson',array('event_id'=>$id))->result_array();
		  foreach ($table_data['data'] as $key => $row) {
					$table_data['data'][$key]["no"] = $key + 1;
		  }
        echo json_encode($table_data);
    }

   public function insert_Event(){
       $data = $this->input->post();
       
       if ($data['id'] == "0"){
           $data['uploaded_at'] = date("Y-m-d H:i:s");
           $this->Event_model->update(array("status" => "upcoming"),array("status" => "completed"));
           $insert_ID = $this->Event_model->insert(array("name"=>$data['title'], "description"=>$data['description'], "location"=>$data['location'], "seats"=>$data['seats'], "link"=>$data['link'], "start_time"=>$data['start_time'], "end_time"=>$data['end_time'], "remind_to"=>$data['remind_to']));
           $this->Event_model->update(array("id"=>$insert_ID),array("link"=>base_url().'customer/event/display_Detail?id='.$insert_ID));

           $datax = $this->Settings_model->find(array("skey"=>'createemail'), array(), array(), true);
           $html = $datax[0]['svalue'];
       
           $datax = $this->Settings_model->find(array("skey"=>'createsubject'), array(), array(), true);
           $subject = $datax[0]['svalue'];

            
           // Send mail
            $this->Event_model->setTable('tbl_user');

            if($data['remind_to'] == 'all'){
                $users = $this->Event_model->find(array());
            }else if($data['remind_to'] == 'admin_only'){
                $users = $this->Event_model->find(array('is_admin' => 1));
            }else if($data['remind_to'] == 'membership_only'){
                $users = $this->Event_model->find(array('membership_id > 0 OR is_admin = 1' => null));
            }

            if($data['remind_to'] != 'none'){

                foreach($users as $user){

                    $salt = md5($user->id.$insert_ID."elite2021@salt");

                    $link = base_url().'customer/webinar/register?uid='.$user->id.'&eid='.$insert_ID.'&salt='.$salt;

                    $email_body = 'Hi, '.$user->name. "<br/>".$html;
                    
                    $email_body .= '<br><br><p>Click here to register: <a href="'.$link.'" target="_blank">'.$link.'</a></p>';

                    $mail = new PHPMailer();
                    
                    $mail->IsSMTP();
                    $mail->Host = 'localhost';
                    $mail->SMTPAuth = false;
                    $mail->From = 'support@ncdeliteveterans.org';
                    $mail->FromName = 'Elite Nor-Cal';
                    
                    $mail->AddAddress($user->email);

                    $mail->IsHTML(true);
                    $mail->Subject = $subject;
                    $content = $email_body;
                    $mail->MsgHTML($content); 
                    
                    if(!$mail->Send()) {
                        echo "Error while sending Email.";
                    } else {
                        echo "Email sent successfully";
                    }
                    
                }

            }

       }else{
           $this->Event_model->update(array("id"=>$data['id']),array(
		   "name"=>$data['title'], 
		   "description"=>$data['description'], 
		   "location"=>$data['location'],
		   "seats"=>$data['seats'], 
		   "homepage"=>$data['homepage'], 
		   "link"=>$data['link'], 
		   "start_time"=>$data['start_time'], 
		   "end_time"=>$data['end_time'], 
		   "status"=>$data['status'], 
		   "remind_to"=>$data['remind_to']));
           $insert_ID = $data['id'];

            if($data['status'] == 'upcoming'){
                $this->Event_model->update(array("status" => "upcoming"),array("status" => "completed"));
                $this->Event_model->update(array("id"=>$data['id']),array("status"=>$data['status']));
            }
       }

       $this->Event_model->setTable('tbl_event');
     
       if (!empty($_FILES['image']['name'])) {
           if( !file_exists('./assets/uploads/event/') )
               mkdir('./assets/uploads/event/', 0777, true);
           $file_name = time().$_FILES['image']['name'];

           if (move_uploaded_file($_FILES['image']['tmp_name'],'assets/uploads/event/'.$file_name)) {
               $this->Event_model->update(array("id"=>$insert_ID), array("thumbnail"=>'assets/uploads/event/'.$file_name));
           }
       }

       if (!empty($_FILES['second_image']['name'])) {
           if( !file_exists('./assets/uploads/event/') )
               mkdir('./assets/uploads/event/', 0777, true);
           $second_file_name = time().$_FILES['second_image']['name'];

           if (move_uploaded_file($_FILES['second_image']['tmp_name'],'assets/uploads/event/'.$second_file_name)) {
               $this->Event_model->update(array("id"=>$insert_ID), array("second_thumbnail"=>'assets/uploads/event/'.$second_file_name));
           }
       }
   }

    public function del_Event(){
        $id = $this->input->post('id');
        $result['msg'] = $this->Event_model->delete(array("id"=>$id));
    }

    public function export_Event(){
        $result = $this->Event_model->find(array(), array(), array(), true);

        foreach ($result as $key => $row) {
            $result[$key]["no"] = $key + 1;
        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        $pCol = 0;
        $pRow = 1;

        $field_name = array('No', 'Name', 'Location', 'Thumbnail', 'Second thumbnail', 'Start time', 'End time'
        , 'Link', 'Registered', 'Attended', 'Status');

        for ($pCol = 0; $pCol < count($field_name); $pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$field_name[$pCol]);
        }

        $pCol = 0;
        $pRow = 2;

        foreach ($result as $row) {

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['no']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['name']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['location']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['thumbnail']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['second_thumbnail']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['start_time']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['end_time']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['link']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['registered']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['attended']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['status']);
            $pCol++;

            $pCol = 0;
            $pRow++;
        }

        $file_name = "Event Export " . date('Y-m-d H:i:s') . ".xls";
        header('Content-Encoding: utf-8');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: inline;filename='. $file_name.'');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
	
	public function export_Event_local($id){
        $result = $this->db->get_where('tbl_event_book_inperson',array('event_id'=>$id))->result_array();

        foreach ($result as $key => $row) {
            $result[$key]["no"] = $key + 1;
        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        $pCol = 0;
        $pRow = 1;

        $field_name = array('No', 'Name', 'Email', 'Phone', 'Title', 'Company', 'Registered');

        for ($pCol = 0; $pCol < count($field_name); $pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$field_name[$pCol]);
        }

        $pCol = 0;
        $pRow = 2;

        foreach ($result as $row) {

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['no']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['name']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['email']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['phone']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['title']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['company']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['created']);
            $pCol++; 
            $pCol = 0;
            $pRow++;
        }

        $file_name = "Event In-Person Export " . date('Y-m-d H:i:s') . ".xls";
        header('Content-Encoding: utf-8');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: inline;filename='. $file_name.'');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function display_reg_History(){
        $this->mHeader['sub_id'] = 'view';
        $id = $this->input->get('id');
        $this->mContent['event_id'] = $id;
        $this->mContent['event'] = $this->Event_model->find(array("id"=>$id), array(), array(), true);
       
        $this->render("{$this->sub_mLayout}reg_history_index", $this->mLayout);
    }

    public function get_reg_History(){
        $param = $this->input->post();
        $table_data['data'] = $this->Reg_history_model->get_reg_History(array('event_id'=>$param['event_id']));

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
        }
        echo json_encode($table_data);
    }

    public function display_attend_History(){
        
        $this->mHeader['sub_id'] = 'view';
        $id = $this->input->get('id');
        $this->mContent['event_id'] = $id;        
        $this->mContent['event'] = $this->Event_model->find(array("id"=>$id), array(), array(), true);
        
        $this->render("{$this->sub_mLayout}attend_history_index", $this->mLayout);
    }

    public function get_attend_History(){
        $param = $this->input->post();
        $table_data['data'] = $this->Attend_history_model->get_att_History(array('event_id'=>$param['event_id']));

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
        }
        echo json_encode($table_data);
    }

    public function update_display_Sponsor(){
        $data = $this->input->post();
        $this->Event_model->update(array("id"=>$data['id']), array("display_sponsor"=>$data['state']));
    }
}