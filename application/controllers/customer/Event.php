<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/event/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'event';
        $this->mHeader['title'] = 'Event';
        $this->mContent['msg'] = "";
        $this->load->model(['Event_model','Reg_history_model','User_model','Webinar_model']);
    }

    /*
    * Event
    * */
    public function index(){
        $this->mHeader['sub_id'] = 'event';
        $this->mContent['event'] = $this->Event_model->get_Event(1);
        $this->mContent['cur_page']=1;
        $this->mContent['cur_count']=8;
        $this->mContent['all_count']=$this->Event_model->count();
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function display_Event(){
        $this->mHeader['sub_id'] = 'event';
        $page = $this->input->get('page');
        $this->mContent['event'] = $this->Event_model->get_Event($page);
        $this->mContent['cur_page']=$page;
        $this->mContent['cur_count']=$page * 8;
        $this->mContent['all_count']=$this->Event_model->count();//var_dump($this->mContent['cur_count']);die();
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

    public function display_detail(){
        $this->mHeader['sub_id'] = 'event';
        $id = $this->input->get('id');

        $this->mContent['data'] = $this->Event_model->find(array("id"=>$id), array(), array(), true);
        $this->mContent['registed_count'] = $this->Reg_history_model->count(array("event_id"=>$id));

        $this->render("{$this->sub_mLayout}detail", $this->mLayout);
    }

    public function insert_RegEvent(){

        $data = $this->input->post();

        $user = $this->User_model->find(array("email"=>$data['email']), array(), array(), true);
        $webinar = $this->Webinar_model->find(array("id" => $data['event_id']), array(), array(), true);

		$this->session->set_userdata('event_id',$data['event_id']);

        if(count($webinar) > 0){

            $webinar = $webinar[0];
            $temp_password = '';

            if(empty($user)){

                $temp_password=rand(100000,1000000);
                $username = $data['first_name']." ".$data['last_name'];

                $inserted_id=$this->User_model->insert(array("name"=>$username, "email"=>$data['email'], "phone_number"=>$data['phone'], "title"=>$data['title'], "company"=>$data['company'],"password"=>$temp_password));
                $this->Reg_history_model->insert(array("event_id"=>$data['event_id'], "user_id"=>$inserted_id));

            }else{

                $id=$user[0]['id'];
                $username = $user[0]['name'];
                $this->Reg_history_model->insert(array("event_id"=>$data['event_id'], "user_id"=>$id));

            }

            $html = '';
            $html .= '<h5>Hi '.$username.'  </h5>';
            $html .= '<h5> You have register for a webinar. </h5>';
            $html .= '<p>The webinar <strong>"'.$webinar['name'].'"</strong> will start at: '.$webinar['start_time'];

            if($temp_password != '')
            $html .= '<p>Your temp password: '.$temp_password.'</p>';

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $from = 'joneslj2@gmail.com';

            $subject = 'Register webinar';
            $message = $html;
            $headers .= "From:". $from;

            mail($data['email'],$subject,$message, $headers);
        }

		function google($id =''){
			if(!$id){
				$id = $this->session->userdata('event_id');
			}
			$webinar = $this->Webinar_model->find(array("id" => $id), array(), array(), true);
			if(count($webinar) > 0) {
				$webinar = $webinar[0];
			}
			if(isset($_GET['code'])) {
				try {
					$this->load->libary('Googlecalendarapi');

					// Get the access token
					$data = $this->Googlecalendarapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);

					// Save the access token as a session variable
					$_SESSION['access_token'] = $data['access_token'];

					// Redirect to the page where user can create event
					//header('Location: home.php');
					//$user_timezone = $this->Googlecalendarapi->GetUserCalendarTimezone($_SESSION['access_token']);

					// Create event on primary calendar
					//$event_id = $this->Googlecalendarapi->CreateCalendarEvent('primary', $webinar['title'], $webinar['all_day'], $webinar['event_time'], $user_timezone, $_SESSION['access_token']);

					print_r($webinar);
					die("OK");
				}
				catch(Exception $e) {
					echo $e->getMessage();
					exit();
				}
			}


		}
   }
}
