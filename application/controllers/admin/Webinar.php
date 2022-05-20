<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'system/PHPMailer.php';

class Webinar extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/webinar/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'webinar';
        $this->mHeader['title'] = 'Webinar';
        $this->mContent['msg'] = "";
        $this->load->model(array('Webinar_model','Contact_model','User_model','Settings_model'));
    }

    /*
     * Gallery & Music
     * */
    public function gallery_music(){
        $this->mHeader['sub_id'] = 'gallery_music';

        $this->Webinar_model->setTable('tbl_gallery');
        $this->mContent['gallery'] = $this->Webinar_model->find(array("type"=>"image"), array("uploaded_at"=>'DESC'), array(), true);
        $this->mContent['video'] = $this->Webinar_model->find(array("type"=>"video"), array(), array(), true);

        $this->Webinar_model->setTable('tbl_asset');
        $music = $this->Webinar_model->find(array(), array(), array(), true);
        if (!empty($music))
            $this->mContent['music'] = $music[0]['music'];

        $this->Webinar_model->setTable('tbl_event');
        $this->mContent['event'] = $this->Webinar_model->find(array("status"=>"upcoming"), array(), array(), true);

        $this->Webinar_model->setTable('tbl_broadcast');
        $api_key = $this->Webinar_model->find(array("name"=>"api_key"), array(), array(), true);
        $api_secret = $this->Webinar_model->find(array("name"=>"api_secret"), array(), array(), true);
        $meeting_number = $this->Webinar_model->find(array("name"=>"meeting_number"), array(), array(), true);
        $meeting_passcode = $this->Webinar_model->find(array("name"=>"meeting_passcode"), array(), array(), true);

        $data = $this->Settings_model->find(array("skey"=>'display_zoom'), array(), array(), true);
        $this->mContent['display_zoom'] = $data[0]['svalue'];

        $this->mContent['webinar'] = [
            'api_key' => $api_key[0]['value'],
            'api_secret' => $api_secret[0]['value'],
            'meeting_number' => $meeting_number[0]['value'],
            'meeting_passcode' => $meeting_passcode[0]['value']
        ];

        $this->render("{$this->sub_mLayout}gallery_music", $this->mLayout);
    }

    public function save_Gallery(){
        $data = $this->input->post();

        $this->Webinar_model->setTable('tbl_gallery');
        $insert_ID = 0;

        if (!empty($_FILES['thumbnail']['name'])) {
            if( !file_exists('./assets/uploads/webinar/') )
            mkdir('./assets/uploads/webinar/', 0777, true);
            $file_name = time().$_FILES['thumbnail']['name'];

            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'],'assets/uploads/webinar/'.$file_name)) {
                $data['uploaded_at'] = date("Y-m-d H:i:s");
                $data['thumbnail'] = 'assets/uploads/webinar/'.$file_name;
                $insert_ID = $this->Webinar_model->insert($data);
            }
        }
    }

    public function save_Video(){
        try {
            if(isset($_FILES['file_data'])){
                $file_name = time().'_'.$_FILES['file_data']['name'];

                if (move_uploaded_file($_FILES['file_data']['tmp_name'],'assets/uploads/webinar/'.$file_name)) {
                    $this->Webinar_model->setTable('tbl_gallery');
                    $data = array(
                        'uploaded_at' => date("Y-m-d H:i:s"),
                        'type' => 'video',
                        'thumbnail' => 'assets/uploads/webinar/'.$file_name
                    );
                    $data['uploaded_at'] = date("Y-m-d H:i:s");
                    $insert_ID = $this->Webinar_model->insert($data);
                    echo json_encode(array(
                        'status' => 'success'
                    ));
                }else{
                    echo 'error';
                }
            }else{
                echo 'error';
            }
        } catch (Exception $e) {
            echo 'error';
        }

    }

    public function save_Music(){
        $this->Webinar_model->setTable('tbl_asset');
        $current_data = $this->Webinar_model->find(array(), array(), array(), true);

        if (!empty($current_data)){
            if (!empty($_FILES['music']['name'])) {
                if( !file_exists('./assets/uploads/music/') )
                    mkdir('./assets/uploads/music/', 0777, true);
                $file_name = time().$_FILES['music']['name'];

                if (move_uploaded_file($_FILES['music']['tmp_name'],'assets/uploads/music/'.$file_name)) {
                    $this->Webinar_model->update(array("music"=>$current_data[0]['music']), array("music"=>'assets/uploads/music/'.$file_name));
                }
            }
        }else{
            if (!empty($_FILES['music']['name'])) {
                if( !file_exists('./assets/uploads/music/') )
                    mkdir('./assets/uploads/music/', 0777, true);
                $file_name = time().$_FILES['music']['name'];

                if (move_uploaded_file($_FILES['music']['tmp_name'],'assets/uploads/music/'.$file_name)) {
                    $this->Webinar_model->insert(array("music"=>'assets/uploads/music/'.$file_name));
                }
            }
        }
    }

    public function del_Gallery(){
        $id = $this->input->post('id');
        $this->Webinar_model->setTable('tbl_gallery');
        $item = $this->Webinar_model->find(array("id" => $id), array(), array(), true);

        if(count($item) > 0){
            try {
                unlink($item[0]['thumbnail']);
            }catch (Exception $e){

            }
            $result['msg'] = $this->Webinar_model->delete(array("id"=>$id));
        }
    }

    /*
     * Ads Image & Handout
     * */
    public function image_handout(){
        $this->mHeader['sub_id'] = 'image_handout';

        $this->Webinar_model->setTable('tbl_adsimage');
        $this->mContent['images'] = $this->Webinar_model->find(array(), array(), array(), true);

        $this->Webinar_model->setTable('tbl_asset');
        $handout = $this->Webinar_model->find(array(), array(), array(), true);
        if (!empty($handout))
            $this->mContent['handout'] = $handout[0]['handout'];

        $this->render("{$this->sub_mLayout}image_handout", $this->mLayout);
    }

    public function save_Image(){
        $data = $this->input->post();

        $this->Webinar_model->setTable('tbl_adsimage');
        $insert_ID = 0;
        if ($data['id'] == "0"){
            $data['uploaded_at'] = date("Y-m-d H:i:s");
            $insert_ID = $this->Webinar_model->insert($data);
        }

        if (!empty($_FILES['thumbnail']['name'])) {
            if( !file_exists('./assets/uploads/images/') )
                mkdir('./assets/uploads/images/', 0777, true);
            $file_name = time().$_FILES['thumbnail']['name'];

            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'],'assets/uploads/images/'.$file_name)) {
                $this->Webinar_model->update(array("id"=>$insert_ID), array("thumbnail"=>'assets/uploads/images/'.$file_name));
            }
        }
    }

    public function save_Handout(){
        $this->Webinar_model->setTable('tbl_asset');
        $current_data = $this->Webinar_model->find(array(), array(), array(), true);

        if (!empty($current_data)){
            if (!empty($_FILES['handout']['name'])) {
                if( !file_exists('./assets/uploads/handout/') )
                    mkdir('./assets/uploads/handout/', 0777, true);
                $file_name = time().$_FILES['handout']['name'];

                if (move_uploaded_file($_FILES['handout']['tmp_name'],'assets/uploads/handout/'.$file_name)) {
                    $this->Webinar_model->update(array("handout"=>$current_data[0]['handout']), array("handout"=>'assets/uploads/handout/'.$file_name));
                }
            }
        }else{
            if (!empty($_FILES['handout']['name'])) {
                if( !file_exists('./assets/uploads/handout/') )
                    mkdir('./assets/uploads/handout/', 0777, true);
                $file_name = time().$_FILES['handout']['name'];

                if (move_uploaded_file($_FILES['handout']['tmp_name'],'assets/uploads/handout/'.$file_name)) {
                    $this->Webinar_model->insert(array("handout"=>'assets/uploads/handout/'.$file_name));
                }
            }
        }
    }

    public function del_Image(){
        $id = $this->input->post('id');
        $this->Webinar_model->setTable('tbl_adsimage');
        $result['msg'] = $this->Webinar_model->delete(array("id"=>$id));
    }

    /*
     * Control Webinar
     * */
    public function control(){
        $this->mHeader['sub_id'] = 'webinar_control';

        $data = $this->Settings_model->find(array("skey"=>'display_zoom'), array(), array(), true);
        $this->mContent['display_zoom'] = $data[0]['svalue'];

        $data = $this->Settings_model->find(array("skey"=>'logo_image'), array(), array(), true);
        $this->mContent['logo_image'] = $data[0]['svalue'];

        $data = $this->Settings_model->find(array("skey"=>'sponsor_image'), array(), array(), true);
        $this->mContent['sponsor_image'] = $data[0]['svalue'];

        $data = $this->Webinar_model->find(array("status"=>"upcoming"), array(), array(), true);
        $this->mContent['event'] = $data;

        $this->render("{$this->sub_mLayout}control", $this->mLayout);
    }

    public function update_display_zoom(){
        $data = $this->input->post();
        $display_zoom = $data['display_zoom'];

        $update = $this->Settings_model->update(array("skey" => "display_zoom"),array("svalue" => $display_zoom));
    }

    public function update_settings(){
        $data = $this->input->post();
        foreach ($data as $key => $value){
            $update = $this->Settings_model->update(array("skey" => $key),array("svalue" => $value));
        }
    }

    public function saveLogoImage(){
        if (!empty($_FILES['image']['name'])) {
            if( !file_exists('./assets/uploads/control/logo') ){
                mkdir('./assets/uploads/control/logo', 0777, true);
            }
            $file_name = $_FILES['image']['name'];

            if (move_uploaded_file($_FILES['image']['tmp_name'],'assets/uploads/control/logo/'.$file_name)) {
                $this->Settings_model->update(array("skey"=>"logo_image"), array("svalue"=>'assets/uploads/control/logo/'.$file_name));
            }
        }
    }

    public function deleteLogoImage(){
        $this->Settings_model->update(array("skey"=>"logo_image"), array("svalue"=>""));
    }

    public function saveSponsorImage(){
        if (!empty($_FILES['image']['name'])) {
            if( !file_exists('./assets/uploads/control/sponsor') ){
                mkdir('./assets/uploads/control/sponsor', 0777, true);
            }
            $file_name = $_FILES['image']['name'];

            if (move_uploaded_file($_FILES['image']['tmp_name'],'assets/uploads/control/sponsor/'.$file_name)) {
                $this->Settings_model->update(array("skey"=>"sponsor_image"), array("svalue"=>'assets/uploads/control/sponsor/'.$file_name));
            }
        }
    }

    public function deleteSponsorImage(){
        $this->Settings_model->update(array("skey"=>"sponsor_image"), array("svalue"=>""));
    }

    public function endWebinar(){
        $event = $this->Webinar_model->find(array("status"=>"upcoming"), array(), array(), true);
        if(count($event) > 0){
            $event = $event[0];
            $this->Webinar_model->update(array("status"=>"upcoming"), array("status"=>"completed"));

            $this->Webinar_model->setTable('tbl_broadcast');
            $this->Webinar_model->update(array("name"=>"meeting_number"), array("value"=>''));
            $this->Webinar_model->update(array("name"=>"meeting_passcode"), array("value"=>''));
        }

    }

    /*
     * Contract
     * */
    public function postbids(){
        $this->mHeader['sub_id'] = 'postbids';

        // $this->Webinar_model->setTable('tbl_contract');
        // $this->mContent['contract'] = $this->Webinar_model->find(array(), array(), array(), true);

        $this->render("{$this->sub_mLayout}contract_list", $this->mLayout);
    }

    public function get_Contract(){

        $this->Webinar_model->setTable('tbl_contract');
        $table_data['data'] = $this->Webinar_model->find(array(), array("created_at"=>'DESC'), array(), true);

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
        }
        echo json_encode($table_data);
    }

    // public function edit(){

    //     $this->mHeader['sub_id'] = 'postbids';
    //     $id = $this->input->get('id');
    //     $this->mContent['data'] = $this->Event_model->find(array("id"=>$id), array(), array(), true);

    //     $this->render("{$this->sub_mLayout}edit", $this->mLayout);
    // }

    public function add(){

        $this->mHeader['sub_id'] = 'postbids';
        $this->mContent['data'][0]['id']='0';
        $this->render("{$this->sub_mLayout}contract_add", $this->mLayout);
    }

    public function del_Contract(){
        $id = $this->input->post('id');
        $this->Webinar_model->setTable('tbl_contract');
        $result['msg'] = $this->Webinar_model->delete(array("id"=>$id));
    }

    public function contract_edit(){

        $this->mHeader['sub_id'] = 'postbids';
        $id = $this->input->get('id');
        $this->Webinar_model->setTable('tbl_contract');
        $this->mContent['data'] = $this->Webinar_model->find(array("id"=>$id), array(), array(), true);

        $this->render("{$this->sub_mLayout}contract_edit", $this->mLayout);
    }

    public function insert_contract(){
        $data = $this->input->post(); 
        $this->Webinar_model->setTable('tbl_contract');

        if ($data['id'] == "0"){
            $insert_ID = $this->Webinar_model->insert(array(
				"title"=>$data['title'],
				"details"=>$data['details'],
				"company"=>$data['company'],
				"name"=>$data['name'],
				"name"=>$data['name'],
				"email"=>$data['email'],
				"phone"=>$data['phone'],
				"start_date"=>date("Y-m-d",strtotime($data['start_date'])),
				"end_date"=>date("Y-m-d",strtotime($data['end_date'])),
				"details"=>$data['details'],
				"sponsor"=>$data['sponsor'],
				"status"=>$data['status'],
				"type"=>$data['type']
			));
        }else{
            $this->Webinar_model->update(array("id"=>$data['id']), array(
				"title"=>$data['title'],
				"details"=>$data['details'],
				"company"=>$data['company'],
				"name"=>$data['name'],
				"name"=>$data['name'],
				"email"=>$data['email'],
				"phone"=>$data['phone'],
				"start_date"=>date("Y-m-d",strtotime($data['start_date'])),
				"end_date"=>date("Y-m-d",strtotime($data['end_date'])),
				"details"=>$data['details'],
				"sponsor"=>$data['sponsor'],
				"status"=>$data['status'],
				"type"=>$data['type']
            ));
            $insert_ID = $data['id'];
        }

         if (!empty($_FILES['thumbnail']['name'])) {
             if( !file_exists('./assets/uploads/webinar/contract') )
                 mkdir('./assets/uploads/webinar/contract', 0777, true);
             $file_name = time().$_FILES['thumbnail']['name'];

             if (move_uploaded_file($_FILES['thumbnail']['tmp_name'],'assets/uploads/webinar/contract'.$file_name)) {
                 $this->Webinar_model->update(array("id"=>$insert_ID), array("thumbnail"=>'assets/uploads/webinar/contract'.$file_name));
             }
         }

        if (!empty($_FILES['second_thumbnail']['name'])) {
            if( !file_exists('./assets/uploads/webinar/contract') )
                 mkdir('./assets/uploads/webinar/contract', 0777, true);
            $second_file_name = time().$_FILES['second_thumbnail']['name'];

            if (move_uploaded_file($_FILES['second_thumbnail']['tmp_name'],'assets/uploads/webinar/contract'.$second_file_name))
                $this->Webinar_model->update(array("id"=>$insert_ID), array("second_thumbnail"=>'assets/uploads/webinar/contract'.$second_file_name));
       }
    }

    public function mailchimp(){
        $this->mHeader['sub_id'] = 'mailchimp';

        $this->mContent['owner_id'] = $this->mUser['id'];

        $this->mContent['contact'] = $this->User_model->find(array('is_checked' => 1,'subscribe'=>1), array(), array(), true);

        $data = $this->Settings_model->find(array("skey"=>'mailchimp'), array(), array(), true);

        $this->mContent['mailchimp'] = $data[0]['svalue'];
        $this->mContent['subject'] = "Upcoming Webinar";

        $this->render("{$this->sub_mLayout}mailchimp", $this->mLayout);
    }

    public function uploadImage() {
        $ds = DIRECTORY_SEPARATOR;

        $storeFolder = 'images';

        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $ext= explode(".", $_FILES['file']['name']);
            $file_name = time().".".$ext[count($ext)-1];
            //$targetFile = getcwd() . '\\images\\' . $file_name;
            $targetFile = './assets/uploads/' . $file_name;
            copy($tempFile, $targetFile);

            echo json_encode(array('location' => base_url() . "assets/uploads/$file_name"));
        }
    }

    public function send_Email(){

        $input = $this->input->post();


        $email_content = $input['description'];
        $emails = $input['address'];
        $subject = $input['subject'];

        foreach($emails as $email) {
            $user = $this->User_model->find(array('email' => $email), array(), array(), true);
            if(count($user) > 0) $user = $user[0];
			$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$user['name'].'&t='.$user['phone_number'].'&type='.$user['title'].'&p=Email').'"/>';
            //$email_content = 'Hi, '.$user['name']. "<br/>".$email_content;
        	//$this->sendMail($email, 'Hi, '.$user['name']. "<br/>".$email_content.$image_refer, $subject);

			$queue = array('email'=>$email,
				'content'=>'Hi, '.$user['name']. "<br/>".$email_content.$image_refer,
				'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s"));
			$this->db->insert('tbl_email_queue',$queue);

        }

        /*
        $data = $this->User_model->get_User();//var_dump($data);die();
        foreach($data as $email) {
            //echo $email['email'];
            $this->sendMail($email['email'] , $email_content , $email); // 2 = birthday_template
        }
        */
    }

    public function sendMail($toEmail='' , $content = '' , $subject = '')
    {
        $mail = new PHPMailer();

		$email_content = $this->load->view('email/template',array('email_content'=>$content,'email'=>$toEmail),true);

        $mail->IsSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->From = 'support@ncdeliteveterans.org';
        $mail->FromName = 'Elite Nor-Cal';

        $mail->AddAddress($toEmail);

        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->MsgHTML($email_content);

        if(!$mail->Send()) {
            echo "Error while sending Email.";
        } else {
            echo "Email sent successfully";
        }
    }

    public function live(){
        $this->load->view('admin/webinar/live');
    }
    public function live_close(){
        $this->load->view('admin/webinar/live_close');
    }

    public function remindemail(){
        $this->mHeader['sub_id'] = 'remindemail';

        $data = $this->Settings_model->find(array("skey"=>'remindemail'), array(), array(), true);
        $this->mContent['data'] = $data[0]['svalue'];

        $data = $this->Settings_model->find(array("skey"=>'remindsubject'), array(), array(), true);
        $this->mContent['subject'] = $data[0]['svalue'];

        $this->render("{$this->sub_mLayout}remindemail", $this->mLayout);
    }

    public function save_remind_email(){
        $data = $this->input->post();
        $subject = $data['subject'];
        $content = $data['content'];

        $update = $this->Settings_model->update(array("skey" => "remindsubject"),array("svalue" => $subject));
        $update = $this->Settings_model->update(array("skey" => "remindemail"),array("svalue" => $content));
        var_dump($update);

    }

    public function save_mailchimp(){
        $data = $this->input->post();
        $content = $data['content'];

        $update = $this->Settings_model->update(array("skey" => "mailchimp"),array("svalue" => $content));
    }

    public function createemail(){
        $this->mHeader['sub_id'] = 'createemail';

        $data = $this->Settings_model->find(array("skey"=>'createemail'), array(), array(), true);
        $this->mContent['data'] = $data[0]['svalue'];

        $data = $this->Settings_model->find(array("skey"=>'createsubject'), array(), array(), true);
        $this->mContent['subject'] = $data[0]['svalue'];

        $this->render("{$this->sub_mLayout}createemail", $this->mLayout);
    }

    public function save_create_email(){
        $data = $this->input->post();
        $subject = $data['subject'];
        $content = $data['content'];

        $update = $this->Settings_model->update(array("skey" => "createsubject"),array("svalue" => $subject));
        $update = $this->Settings_model->update(array("skey" => "createemail"),array("svalue" => $content));
        var_dump($update);

    }

    public function smtp_config(){
        $this->mHeader['sub_id'] = 'smtp_config';

        $data = $this->Settings_model->find(array("skey"=>'smtp_secure'), array(), array(), true);
        $this->mContent['smtp_secure'] = $data[0]['svalue'];

        $data = $this->Settings_model->find(array("skey"=>'smtp_port'), array(), array(), true);
        $this->mContent['smtp_port'] = $data[0]['svalue'];

        $data = $this->Settings_model->find(array("skey"=>'smtp_host'), array(), array(), true);
        $this->mContent['smtp_host'] = $data[0]['svalue'];

        $data = $this->Settings_model->find(array("skey"=>'smtp_username'), array(), array(), true);
        $this->mContent['smtp_username'] = $data[0]['svalue'];

        $data = $this->Settings_model->find(array("skey"=>'smtp_password'), array(), array(), true);
        $this->mContent['smtp_password'] = $data[0]['svalue'];

        $this->render("{$this->sub_mLayout}smtp_config", $this->mLayout);
    }

    public function save_smtp(){
        $data = $this->input->post();
        $smtp_secure = $data['smtp_secure'];
        $smtp_port = $data['smtp_port'];
        $smtp_host = $data['smtp_host'];
        $smtp_username = $data['smtp_username'];
        $smtp_password = $data['smtp_password'];

        $update = $this->Settings_model->update(array("skey" => "smtp_secure"),array("svalue" => $smtp_secure));
        $update = $this->Settings_model->update(array("skey" => "smtp_port"),array("svalue" => $smtp_port));
        $update = $this->Settings_model->update(array("skey" => "smtp_host"),array("svalue" => $smtp_host));
        $update = $this->Settings_model->update(array("skey" => "smtp_username"),array("svalue" => $smtp_username));
        $update = $this->Settings_model->update(array("skey" => "smtp_password"),array("svalue" => $smtp_password));
    }

	public function broadcast($port='8080'){
		$this->load->view('admin/webinar/broadcast.php',array('port'=>$port));
	}

	public function broadcast_status(){
		header('Content-Type: application/json; charset=utf-8');
		$data = array();

		$uid = $this->input->post('uid');
		$port = $this->input->post('port');
		$act = $this->input->post('act');

		$data['currentName'] = '';

		$data['request'] = $uid.":".$port;

		$current_user =  $this->session->userdata('user');

		//clear old
		$this->db->delete('tbl_broadcast_status',array('updated <'=>date("Y-m-d H:i:s",strtotime("-30 seconds"))));
		switch($act){
			case 'del':
				$this->db->delete('tbl_broadcast_status',array('uid'=>$uid,'channel'=>$port));
				$status = 1;
				break;
			case 'up':
				$row = $this->db->get_where('tbl_broadcast_status',array('uid'=>$uid,'channel'=>$port))->row();
				if(empty($row)){
					$this->db->insert('tbl_broadcast_status',array(
					'uid'=>$uid,'channel'=>$port,
					'updated'=>date("Y-m-d H:i:s")));
				}else{
					$this->db->update('tbl_broadcast_status',array(
					'updated'=>date("Y-m-d H:i:s")),
					array('id'=>$row->id)
					);
				}
				$status = 1;
				break;
			default:
				$row = $this->db->get_where('tbl_broadcast_status',array('channel'=>$port))->row();
				if(empty($row)){
					$status = 1;
				}else{
					if($row->uid == $current_user['id']){
						$status = 1;
					}else{
						$status = 0;
					}
					$u = $this->db->get_where('tbl_user',array('id'=>$row->uid))->row();
					$data['currentName'] = $u->name;
				}
				break;
		}
		$data['status'] = $status;
		echo json_encode($data);
		die();
	}

	function fix(){
		$infos = $this->db->get('user_information')->result();
		foreach($infos as $row){

			$user = $this->db->get_where('tbl_user',array('email'=>$row->email))->row();

			$this->db->update('user_information',array('type'=>$user->title),array('id'=>$row->id));
		}
		print_r($infos);
	}

}
