<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sponsor extends MY_Controller {
	public $mLayout = 'customer/';
	public $sub_mLayout = 'customer/sponsor/';

	/**
	 * @var Membership_model
	 */
	var $Membership_model;
	/**
	 * @var User_model
	 * */
	var $User_model;

	public function index(){
		$package_id = @$_GET['package_id'];
		if(!$package_id) $package_id = 4;
		$this->mContent['package_id'] = $package_id;
		$this->mContent['sponsors_package'] = $this->db->get_where('tbl_membership',array('type'=>1))->result();

		$package = $this->Membership_model->one(array('id'=>$package_id));
		$this->mContent['package'] = $package;

		$this->mHeader['id'] = 'membership';
		$this->render("{$this->sub_mLayout}register", $this->mLayout);
	}


	function __construct() {
		parent::__construct();
		$this->load->model('Membership_model');
		$this->load->model('User_model');

		// Load Stripe library
		$this->load->library('stripe_lib');

	}

	function ads($id){
		$current_user =  $this->session->userdata('user');
		$uid = $current_user['id'];
		$ads = $this->db->get_where('tbl_sponsor',array('id'=>$id,'uid'=>$uid))->row();
		$order_id = $ads->order_id;
		$order = $this->Membership_model->getOrder($order_id);
		$this->mHeader['id'] = 'membership';
		// Pass order data to the view
		$this->mContent['order'] = $order;
		$this->mContent['ads'] = $ads;
		$this->render('customer/sponsor/ads', $this->mLayout);
	}

	function purchase(){
		$data = array();
		$postData = $this->input->post();
		$package_id = $this->input->post('package_id');
		$package = $this->Membership_model->one(array('id'=>$package_id));
		// If payment form is submitted with token
		if($this->input->post('stripeToken')){
			// Retrieve stripe token and user info from the posted form data

			$postData['product'] = $package;

			// Make payment
			$paymentID = $this->payment($postData);

			// If payment successful
			if($paymentID){

				$user = $this->Membership_model->getUserByEmail($postData['email']);

				if($user){
					$this->User_model->update(array("id"=>$user['id']), array("name"=>$postData['name'],"email"=>$postData['email']));
				}else{
					$this->User_model->insert(array("name"=>$postData['name'],"email"=>$postData['email'],'password'=>md5($postData['password'])));
				}

				$this->sponsor($postData['email'],$paymentID);

				redirect('customer/sponsor/payment_status/'.$paymentID);
			}else{
				$apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':'';
				$this->session->set_flashdata('error','Transaction has been failed!'.$apiError);
				redirect(site_url('customer/sponsor?package_id='.$package_id));
			}
		}else{
			redirect(site_url('customer/sponsor?package_id='.$package_id));
		}
	}

	public function sponsor($email,$order_id){
		$image_path = realpath(APPPATH . '../assets');

		$config['upload_path']          = $image_path.'/uploads/sponsors';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']	= 0;
		$error = '';
		$data = array();


		$new_name = uniqid();
		$config['file_name'] = $new_name;

		$company = $this->input->post('company');
		$email = $this->input->post('email');
		$name = $this->input->post('fullname');
		$phone = $this->input->post('phone');
		$url = $this->input->post('url');

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			$status = 0;
		}
		else
		{
			$status = 1;
			$data = array('upload_data' => $this->upload->data());

			//
			$user = $this->Membership_model->getUserByEmail($email);
			$id = $user['id'];
			$sponsor = array(
				'uid'=>$id,
				'order_id'=>$order_id,
				'company'=>$company,
				'name'=>$name,
				'email'=>$email,
				'phone'=>$phone,
				'url'=>$url,
				'status'=>1,
				'icon'=>'assets/uploads/sponsors/'.$data['upload_data']['file_name']);

			$this->db->insert('tbl_sponsor',$sponsor );

			$data['sponsor'] = $sponsor;


		}
		$return = array('status'=>$status,'data'=>$data,'error'=>$error );

		return $return;
	}

	function payment($postData){
		$package_id = $this->input->post('package');
		$package = $this->Membership_model->one(array('id'=>$package_id));
		$company = $this->input->post('company');
		$email = $this->input->post('email');
		$name = $this->input->post('fullname');
		$phone = $this->input->post('phone');
		$url = $this->input->post('url');
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
				$planName = "Sponsor ".$package->name;
				$planPrice = $package->cost;
				$planInterval = 'year';

				$user = $this->Membership_model->getUserByEmail($email);
				if(!$user){
					$pass_plain = uniqid();
					$name = $this->input->post('fullname');
					$this->User_model->insert(
						array(
							"title"=>'Corporate',
							"name"=>$name,
							'company'=>$company,
							'phone'=>$phone,
							"email"=>$email,
							'password'=>md5($pass_plain),
							"membership_id"=>$package->id));
					$subject = "New account from Ncdeliteveterans.org";
					$content = "Hello ".$name."<br><br>";
					$content.= "Your new account :";
					$content.= "<p>
						Username: ".$email."<br>
						Password: ".$pass_plain."<br>
					</p>";
							$content.= "Thank you, <br>";
							$content.= "Ncdeliteveterans Team<br>";

					$this->db->insert('tbl_email_queue',array('email'=>$user->email,
						'content'=>$content,
						'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));


				}

				$plan = $this->stripe_lib->createPlan($planName, $planPrice, $planInterval);
				if($plan){
					// Creates a new subscription
					$subscription = $this->stripe_lib->createSubscription($customer->id, $plan->id);

					if($subscription){
						// Check whether the subscription activation is successful
						if($subscription['status'] == 'active'){
							// Subscription info
							$subscrID = $subscription['id'];
							$custID = $subscription['customer'];
							$planID = $subscription['plan']['id'];
							$planAmount = ($subscription['plan']['amount']/100);
							$planCurrency = $subscription['plan']['currency'];
							$planInterval = $subscription['plan']['interval'];
							$planIntervalCount = $subscription['plan']['interval_count'];
							$created = date("Y-m-d H:i:s", $subscription['created']);
							$current_period_start = date("Y-m-d H:i:s", $subscription['current_period_start']);
							$current_period_end = date("Y-m-d H:i:s", $subscription['current_period_end']);
							$status = $subscription['status'];
							$user = $this->Membership_model->getUserByEmail($email);
							$uid = $user['id'];
							// Insert tansaction data into the database
							$subscripData = array(
								'user_id' => $uid,
								'plan_id' => $package->id,
								'stripe_subscription_id' => $subscrID,
								'stripe_customer_id' => $custID,
								'stripe_plan_id' => $planID,
								'plan_amount' => $planAmount,
								'plan_amount_currency' => $planCurrency,
								'plan_interval' => $planInterval,
								'plan_interval_count' => $planIntervalCount,
								'plan_period_start' => $current_period_start,
								'plan_period_end' => $current_period_end,
								'payer_email' => $email,
								'created' => $created,
								'status' => $status
							);
							$subscription_id = $this->insertSubscription($subscripData);

							$paidAmount = $package->cost;
							$paidCurrency = $planCurrency;
							$payment_status = $status;
							$orderData = array(
								'product_id' => $postData['product']->id,
								'buyer_name' => $name,
								'buyer_email' => $email,
								'paid_amount' => $paidAmount,
								'paid_amount_currency' => $paidCurrency,
								'txn_id' => $subscrID,
								'payment_status' => $payment_status
							);
							$orderID = $this->Membership_model->insertOrder($orderData);

							// If the order is successful
							return $orderID;
						}
					}
				}

			}
		}
		return false;
	}

	function payment_status($id){
		$data = array();

		// Get order data from the database
		$order = $this->Membership_model->getOrder($id);
		$this->mHeader['id'] = 'membership';
		// Pass order data to the view
		$this->mContent['order'] = $order;
		$this->render('customer/sponsor/payment-status', $this->mLayout);
	}

	public function insertSubscription($data){
		$insert = $this->db->insert('tbl_subscriptions',$data);
		return $insert?$this->db->insert_id():false;
	}
	
	function invoice($package_id){
		$package = $this->db->get_where('tbl_membership',array('md5(id)'=>$package_id))->row();
		$this->mContent['package'] = $package;
		$this->render("{$this->sub_mLayout}invoice", $this->mLayout);
		
	}
	function invoice_status($id){
		$data = array();

		// Get order data from the database
		$order = $this->Membership_model->getOrder($id);
		$this->mHeader['id'] = 'membership';
		// Pass order data to the view
		$this->mContent['order'] = $order;
		$this->render('customer/sponsor/invoice-status', $this->mLayout);
	}
	function pay_invoice(){
		$data = array();
		$postData = $this->input->post();
		$total_amount = $this->input->post('total_amount'); 
		// If payment form is submitted with token		
		if($this->input->post('stripeToken')){
			// Retrieve stripe token and user info from the posted form data

			// Make payment
			$paymentID = $this->paymentInvoice($postData);

			// If payment successful
			if($paymentID){

				 

				redirect('customer/sponsor/invoice_status/'.$paymentID);
			}else{
				$apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':'';
				$this->session->set_flashdata('error','Transaction has been failed!'.$apiError);
				redirect(site_url('customer/sponsor/invoice/'.$postData['package']));
			}
		}else{
			redirect(site_url('customer/sponsor/invoice/'.$postData['package']));
		}
	}
	
	function paymentInvoice($postData){
		$total_amount = $this->input->post('total_amount');
		$package_id = $this->input->post('package');
		$email = $this->input->post('email');
		$name = $this->input->post('fullname');
		$package = $this->Membership_model->one(array('id'=>$package_id));		
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
				$planName = "INVOICE - ".$package->name." -$".$total_amount;
				$planPrice = $total_amount;  

				// Charge a credit or a debit card
				$charge = $this->stripe_lib->createCharge($customer->id, $planName, $total_amount); 
				if($charge){
					$paidAmount = $total_amount;
					$paidCurrency = $this->config->item('stripe_currency');;
					$payment_status = $charge['status'];
					$orderData = array(
						'product_id' => $package_id,
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
}
