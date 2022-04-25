<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'customer/membership/';

    /**
     * @var Membership_model
     */
    var $Membership_model;
    /**
     * @var User_model
     * */
    var $User_model;

    function __construct() {
        parent::__construct();
        $this->load->model('Membership_model');
        $this->load->model('User_model');

        // Load Stripe library
        $this->load->library('stripe_lib');

    }

    public function index(){
        $package_id = @$_GET['package_id'];
        if(!$package_id) $package_id = 1;

        $package = $this->Membership_model->one(array('id'=>$package_id));
        $this->mContent['package'] = $package;

        $this->mHeader['id'] = 'membership';
        $this->render("{$this->sub_mLayout}register", $this->mLayout);
    }

    function purchase($id){
        $data = array();
        $postData = $this->input->post();

        $package = $this->Membership_model->one(array('id'=>$id));
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
                    $this->User_model->update(array("id"=>$user['id']), array("name"=>$postData['name'],"email"=>$postData['email'],"membership_id"=>$package->id));
                }else{
                    $this->User_model->insert(array("name"=>$postData['name'],"email"=>$postData['email'],'password'=>md5($postData['password']),"membership_id"=>$package->id));
                }

                redirect('customer/membership/payment_status/'.$paymentID);
            }else{
                $apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':'';
                $this->session->set_flashdata('error','Transaction has been failed!'.$apiError);
                redirect(site_url('customer/membership?package_id='.$id));
            }
        }else{
            redirect(site_url('customer/membership?package_id='.$id));
        }
    }

    function payment($postData){

        // If post data is not empty
        if(!empty($postData)){
            // Retrieve stripe token and user info from the submitted form data
            $token  = $postData['stripeToken'];
            $name = $postData['name'];
            $email = $postData['email'];

            // Add customer to stripe
            $customer = $this->stripe_lib->addCustomer($email, $token);

            if($customer){
                // Charge a credit or a debit card
                $charge = $this->stripe_lib->createCharge($customer->id, $postData['product']->name, $postData['product']->cost);

                if($charge){
                    // Check whether the charge is successful
                    if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){
                        // Transaction details
                        $transactionID = $charge['balance_transaction'];
                        $paidAmount = $charge['amount'];
                        $paidAmount = ($paidAmount/100);
                        $paidCurrency = $charge['currency'];
                        $payment_status = $charge['status'];

                        // Insert tansaction data into the database
                        $orderData = array(
                            'product_id' => $postData['product']->id,
                            'buyer_name' => $name,
                            'buyer_email' => $email,
                            'paid_amount' => $paidAmount,
                            'paid_amount_currency' => $paidCurrency,
                            'txn_id' => $transactionID,
                            'payment_status' => $payment_status
                        );
                        $orderID = $this->Membership_model->insertOrder($orderData);

                        // If the order is successful
                        if($payment_status == 'succeeded'){
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
        $this->render('customer/membership/payment-status', $this->mLayout);
    }
}