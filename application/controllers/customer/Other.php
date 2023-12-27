<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/other/';
    /**
	 * @var Membership_model
	 */
	var $Membership_model;
    function __construct() {
        parent::__construct(); 
        $this->mHeader['title'] = 'Other';
        $this->mContent['msg'] = "";
        $this->load->model(array('Webinar_model','User_model','Reg_history_model','Settings_model','Membership_model'));
		$this->load->library('stripe_lib');
    }

    /*
    * Other
    * */
	public function benefit (){
        $this->mHeader['id'] = 'benefit';
		$this->load->model(['Sponsors_model']);
		$this->mContent['sponsor'] = $this->Sponsors_model->find(array('status'=>1), array(), array(), true);
        $this->render("{$this->sub_mLayout}benefit", $this->mLayout);
    }
	
	public function donate (){
        $this->mHeader['id'] = 'donate';
		$page = $this->db->get_where('tbl_config',array('code'=>'DONATE'))->row();
		$this->mContent['page'] = $page;
		$this->render("{$this->sub_mLayout}donate", $this->mLayout);
    }
	
	public function make_donation(){
		$data = array();
		$postData = $this->input->post();
		$donate_amount = $this->input->post('donate_amount'); 
		// If payment form is submitted with token
		if($this->input->post('stripeToken')){
			// Retrieve stripe token and user info from the posted form data

			// Make payment
			$paymentID = $this->payment($postData);

			// If payment successful
			if($paymentID){

				 

				redirect('customer/other/payment_status/'.$paymentID);
			}else{
				$apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':'';
				$this->session->set_flashdata('error','Transaction has been failed!'.$apiError);
				redirect(site_url('customer/other/donate?amount='.$donate_amount));
			}
		}else{
			redirect(site_url('customer/other/donate?amount='.$donate_amount));
		}
	}
	
	function payment($postData){
		$donate_amount = $this->input->post('donate_amount');
		$email = $this->input->post('email');
		$name = $this->input->post('fullname'); 
		// If post data is not empty
		if(!empty($postData)){
			// Retrieve stripe token and user info from the submitted form data
			$token  = $postData['stripeToken'];
			$name = $this->input->post('fullname');
			$email = $postData['email'];

			// Add customer to stripe
			$customer = $this->stripe_lib->addCustomer($email, $token);
			

			if($customer){
				// Charge a credit or a debit card
				//$charge = $this->stripe_lib->createCharge($customer->id, $postData['product']->name, $postData['product']->cost);
				// Create a plan
				$planName = "Donate $".$donate_amount;
				$planPrice = $donate_amount;  

				// Charge a credit or a debit card
				$charge = $this->stripe_lib->createCharge($customer->id, $planName, $donate_amount); 
				if($charge){
					$paidAmount = $donate_amount;
					$paidCurrency = $this->config->item('stripe_currency');;
					$payment_status = $charge['status'];
					$orderData = array(
						'product_id' => '',
						'buyer_name' => $name,
						'buyer_email' => $email,
						'paid_amount' => $paidAmount,
						'paid_amount_currency' => $paidCurrency,
						'txn_id' => $charge['id'],
						'payment_status' => $payment_status
					);
					$orderID = $this->Membership_model->insertOrder($orderData);

					return $orderID;
				}else{
					return false;
				}
			}
		}
		return false;
	}

	function payment_status($id){
		$data = array();

		// Get order data from the database
		$order = $this->Membership_model->getOrder($id);
		$this->mHeader['id'] = 'donation';
		// Pass order data to the view
		$this->mContent['order'] = $order;
		$this->render('customer/other/payment-status', $this->mLayout);
	}

	public function insertSubscription($data){
		$insert = $this->db->insert('tbl_subscriptions',$data);
		return $insert?$this->db->insert_id():false;
	}

	public function about(){
        $this->mHeader['id'] = 'about';
        $this->render("{$this->sub_mLayout}about", $this->mLayout);
    }

    public function wedo(){
        $this->mHeader['id'] = 'wedo';
        $this->render("{$this->sub_mLayout}wedo", $this->mLayout);
    }

    public function membership(){
        $this->mHeader['id'] = 'membership';
        $this->render("{$this->sub_mLayout}membership", $this->mLayout);
    }

    public function find(){
        $this->mHeader['id'] = 'find';
        $this->render("{$this->sub_mLayout}find", $this->mLayout);
    }
	
	public function search_cap_sta(){
		$current_user =  $this->session->userdata('user');
		if(!$current_user){
			redirect('/');
		} 
		 
		$is_download = 0;
		if(is_sponsor()){
			$is_download = 1;
		}
		
        $this->mHeader['id'] = 'search_cap_sta';
		$q = trim($_GET['q']);
		if($q){
			$this->db->like('company_type_name',$q);
			$this->db->order_by('created_at','DESC');
			$results = $this->db->get_where('tbl_cap_sta',array())->result_array();
		}else{
			$results = array();
		}
		
		$company_type = $this->db->get_where('tbl_company_type')->result_array();
		
		//print_r($results);die();
		$this->mContent['results'] = $results;
		$this->mContent['is_download'] = $is_download;
		$this->mContent['q'] = $q;
		$this->mContent['company_type'] = $company_type;
        $this->render("{$this->sub_mLayout}search_cap_sta", $this->mLayout);
    }

    public function weare(){
        $this->mHeader['id'] = 'weare';
        $this->render("{$this->sub_mLayout}weare",$this->mLayout);
    }
	
	public function review(){
        $this->mHeader['id'] = 'review';
        $this->render("{$this->sub_mLayout}review", $this->mLayout);
    }
	
	public function statistic(){
        $this->mHeader['id'] = 'statistic';
		$total_user = $this->db->select('count(*) as total')->from('tbl_user')->get()->row();
		$total_1 = $this->db->select('count(*) as total')->where('title','Disable Veteran')->from('tbl_user')->get()->row();
		$total_2 = $this->db->select('count(*) as total')->where('title','Corporate')->from('tbl_user')->get()->row();
		$total_3 = $this->db->select('count(*) as total')->where('title','Veteran')->from('tbl_user')->get()->row();
		$total_cap = $this->db->select('count(*) as total')->from('tbl_survey_result')->get()->row();
		$total_email = $this->db->select('count(*) as total')->from('user_information')->get()->row();
		$total_bid = $this->db->select('count(*) as total')->from('tbl_contract')->get()->row();
		
		
		$this->mContent['total_user'] = $total_user->total;
		$this->mContent['total_dis_vet'] = $total_1->total;
		$this->mContent['total_corp'] = $total_2->total;
		$this->mContent['total_vet'] = $total_3->total;
		$this->mContent['total_cap'] = $total_cap->total;
		$this->mContent['total_email'] = $total_email->total;
		$this->mContent['total_bid'] = $total_bid->total;
		$this->mContent['statistic'] = get_config_content('WEBINAR_STATISTIC');
		
        $this->render("{$this->sub_mLayout}statistic", $this->mLayout);
    }
	
    public function remind(){
        $this->mHeader['id'] = 'Remind';
        $this->load->view('customer/other/remind');
    }

    public function testemail(){
        $this->mHeader['id'] = 'TestEmail';
        $this->load->view('customer/other/testemail');
    }
	

}
