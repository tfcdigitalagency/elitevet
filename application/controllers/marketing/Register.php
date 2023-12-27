<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'/core/MY_Marketing.php';
class Register extends MY_Marketing {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'marketing/register/';
    /**
	 * @var Membership_model
	 */
	var $Membership_model;
    function __construct() {
        parent::__construct(); 
        $this->mHeader['title'] = 'Marketing';
        $this->mContent['msg'] = "";
		$this->load->model(array('Webinar_model','User_model','Reg_history_model','Settings_model','Membership_model'));
        $this->load->library('stripe_lib');
    }

    
	
	public function index (){
        $this->mHeader['id'] = 'register';
		$packages = $this->db->get_where('mark_package',array('status'=>'1'))->result_array();
		$this->mContent['packages'] = $packages;
		$this->render("{$this->sub_mLayout}register", $this->mLayout);
    }

	public function process(){
		$postData = $this->input->post();

		if(!$postData){
			$data = $_GET["data"];
			if($data){
				$data = json_decode(base64_decode($data), true);
				$postData = $data;
			}
		}

		$packages = $this->db->get_where('mark_package',array('id'=>$postData['pack_id']))->row_array();
		$this->mContent['packages'] = $packages;
		$this->mContent['postData'] = $postData;
		$this->render("{$this->sub_mLayout}process", $this->mLayout);
	}
	public function registerPack(){
		$data = array();
		$postData = $this->input->post();


//		print_r($postData);
//		die();
		$cost = $this->input->post('cost'); 
		// If payment form is submitted with token
		if($this->input->post('stripeToken')){
			// Retrieve stripe token and user info from the posted form data

			// Make payment
			$paymentID = $this->payment($postData);

			// If payment successful
			if($paymentID){

				 

				redirect('marketing/register/payment_status/'.$paymentID);
			}else{
				$apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':'';
				$this->session->set_flashdata('error','Transaction has been failed!'.$apiError);
				redirect(site_url('marketing/register/process?data='.$postData['data']));
			}
		}else{
			redirect(site_url('marketing/register/process?data='.$postData['data']));
		}
	}
	
	function payment($postData){
		$cost = $this->input->post('cost');
		$email = $this->input->post('email');
		$name = $this->input->post('fullname');

		$registered = json_decode(base64_decode($postData['data']),true);
		$packages = $this->db->get_where('mark_package',array('id'=>$registered['pack_id']))->row_array();
//		print_r($registered);die();
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
				$planName = "Register marketing package  [".$packages['pack_name']."] - $".$cost;
				$planPrice = $cost;  

				// Charge a credit or a debit card
				$charge = $this->stripe_lib->createCharge($customer->id, $planName, $cost); 
				if($charge){
					$paidAmount = $cost;
					$paidCurrency = $this->config->item('stripe_currency');;
					$payment_status = $charge['status'];
					$orderData = array(
						'product_id' => $registered['pack_id'],
						'product_name' => $planName,
						'type' => 'marketing',
						'buyer_name' => $name,
						'buyer_email' => $email,
						'paid_amount' => $paidAmount,
						'paid_amount_currency' => $paidCurrency,
						'txn_id' => $charge['id'],
						'detail' => $postData['data'],
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
		$this->mHeader['id'] = 'register';
		// Pass order data to the view
		$this->mContent['order'] = $order;
		$this->render('marketing/register/payment-status', $this->mLayout);
	}

}
