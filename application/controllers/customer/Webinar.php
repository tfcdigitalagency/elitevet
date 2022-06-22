<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webinar extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/webinar/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'webinar';
        $this->mHeader['title'] = 'Webinar';
        $this->mContent['msg'] = "";
        $this->load->model(['Webinar_model','Settings_model','Reg_history_model','Attend_history_model']);
    }

    /*
    * Webinar
    * */
    public function index(){
        // if(!$this->membership){
        //     echo "You don't have permission to access this page!";
        //     die();
        // }

        $this->mHeader['sub_id'] = 'webinar';
        $this->Webinar_model->setTable("tbl_gallery");
        $this->mContent['webinar'] = $this->Webinar_model->find(array("type"=>"image"), array(), array(), true);
        $this->mContent['video'] = $this->Webinar_model->find(array("type"=>"video"), array(), array(), true);

        $this->Webinar_model->setTable("tbl_asset");
        $this->mContent['music'] = $this->Webinar_model->find(array(), array(), array(), true);

        $this->Webinar_model->setTable("tbl_event");
        $this->mContent['event'] = $this->Webinar_model->find(array("status"=>"upcoming"), array(), array(), true);

		$this->mContent["real_register"] = $this->Reg_history_model->count(array("event_id"=>$this->mContent['event'][0]["id"]));
        $this->mContent["real_attend"] = $this->Attend_history_model->count(array("event_id"=>$this->mContent['event'][0]["id"]));


        $this->Webinar_model->setTable("tbl_training");
        $this->mContent['trainingvideo'] = $this->Webinar_model->find(array("show_on_webinar" => 1), array(), array(), true);

        $this->Webinar_model->setTable("tbl_adsimage");
        $this->mContent['adsimage'] = $this->Webinar_model->find(array(), array(), array(), true);

        $this->Webinar_model->setTable("tbl_sponsor");
        $this->mContent['sponsors'] = $this->Webinar_model->find(array(), array(), array(), true);

        $this->Webinar_model->setTable("tbl_sponsor_image");
        $this->mContent['sponsors_image'] = $this->Webinar_model->find(array(), array("date_inserted" => "ASC"), array(), true);

        $this->Webinar_model->setTable("tbl_contract");
        $this->mContent['contract'] = $this->Webinar_model->find(array('type'=>0), array("created_at" => "DESC"), array(), true);

        $this->Webinar_model->setTable('tbl_asset');
        $handout = $this->Webinar_model->find(array(), array(), array(), true);
        if (!empty($handout))
            $this->mContent['handout'] = $handout[0]['handout'];

        $logo_image = $this->Settings_model->find(array("skey"=>'logo_image'), array(), array(), true);
        $this->mContent['logo_image_url'] = $logo_image[0]['svalue'];

        $sponsor_image = $this->Settings_model->find(array("skey"=>'sponsor_image'), array(), array(), true);
        $this->mContent['sponsor_image_url'] = $sponsor_image[0]['svalue'];

		//link
		$current_user =  $this->session->userdata('user');
		$id = $current_user['id'];
		$user = $this->db->get_where('tbl_user',array('id'=>$id))->row();
		$pdf_link = $user->capability_statement_pdf;
		$this->mContent['pdf_link'] = $pdf_link;

        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function register(){

        $this->mHeader['sub_id'] = 'register';
        $this->render("{$this->sub_mLayout}register", $this->mLayout);
    }

    public function live(){
        $this->Webinar_model->setTable('tbl_broadcast');
        $api_key = $this->Webinar_model->find(array("name"=>"api_key"), array(), array(), true);
        $api_secret = $this->Webinar_model->find(array("name"=>"api_secret"), array(), array(), true);
        $meeting_number = $this->Webinar_model->find(array("name"=>"meeting_number"), array(), array(), true);
        $meeting_passcode = $this->Webinar_model->find(array("name"=>"meeting_passcode"), array(), array(), true);

        $this->mContent['webinar'] = array(
            'api_key' => $api_key[0]['value'],
            'api_secret' => $api_secret[0]['value'],
            'meeting_number' => $meeting_number[0]['value'],
            'meeting_passcode' => $meeting_passcode[0]['value']
		);
        $this->load->view('customer/webinar/live');
    }
    public function live_close(){
        $this->load->view('customer/webinar/live_close');
    }

    public function getData(){
        $data = array();
        $data['live'] = 0;

        $this->Webinar_model->setTable('tbl_event');
        $event = $this->Webinar_model->find(array("status"=>"upcoming"), array("start_time" => "ASC"), array(), true);
        if(count($event) > 0){

			$register = $this->Reg_history_model->count(array("event_id"=>$event[0]["id"]));
			$attended = $this->Attend_history_model->count(array("event_id"=>$event[0]["id"]));

            $display_sponsor = $event[0]['display_sponsor'];
            $data['status'] = 'ok';
            $data['display_sponsor'] = $display_sponsor;
            $data['data'] = $attended;
        }else{
            $data['status'] = 'end';
        }

        $display_zoom = $this->Settings_model->find(array("skey"=>'display_zoom'), array(), array(), true);
        $data['display_zoom'] = $display_zoom[0]['svalue'];

        $close_broadcasting = $this->Settings_model->find(array("skey"=>'close_broadcasting'), array(), array(), true);
        $data['close_broadcasting'] = $close_broadcasting[0]['svalue'];

        $this->Webinar_model->setTable('tbl_broadcast');
        $api_key = $this->Webinar_model->find(array("name"=>"api_key"), array(), array(), true)[0]['value'];
        $api_secret = $this->Webinar_model->find(array("name"=>"api_secret"), array(), array(), true)[0]['value'];
        $meeting_number = $this->Webinar_model->find(array("name"=>"meeting_number"), array(), array(), true)[0]['value'];
        $meeting_passcode = $this->Webinar_model->find(array("name"=>"meeting_passcode"), array(), array(), true)[0]['value'];

        if($api_key != '' && $api_secret != '' && $meeting_number != ''){
            $data['live'] = 1;
        }

        echo json_encode($data);
    }
}
