<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
    public $mLayout = 'customer/';
    public $sub_mLayout = 'auth/';
    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'logout';
        $this->load->helper(array('cookie'));
        $this->load->model(array('User_model'));
    }

    function login() {
        $result = array();
        $result['type'] = 0;
        $result['redirect'] = 0;
        $param = $this->input->post();

        if (empty($param)) {
            $data = array();
            if (get_cookie('email') || get_cookie('password')){
                $this->mContent['email'] = get_cookie('email');
                $this->mContent['password'] = get_cookie('password');
            }
            $this->mContent['msg']=null;
            $this->render("{$this->sub_mLayout}login", $this->mLayout);
        } else {
            $user = $this->User_model->login($param['email'], $param['password']);

            if(!empty($user) && ($user['is_admin']==1 || $user['is_admin']==3)){
                //TODO: ==
                $this->session->set_userdata('user', $user);
				if($user['is_admin']== 1){
					redirect('admin/user/user');
				}else{
					redirect('admin/dashboard');
				}

            }else if(!empty($user) && ($user['is_admin']==0 || $user['is_admin']==2)){
                $this->session->set_userdata('user', $user);
                redirect('customer/home');
            }else{
                $this->session->set_userdata('errMsg', "This account is not correct.");
                redirect("auth/login");
            }
        }
    }

    function register() {
        $param = $this->input->post();
        if (empty($param)) {
            $this->mContent['msg']=null;
            $this->render("{$this->sub_mLayout}register", $this->mLayout);
            // $this->load->view("auth/register");
        } else {
            $param['created_at'] = date('Y-m-d H:i:s');
            $param['password'] = md5($param['password']);
            $param['name'] = $param['first_name'] . ' ' . $param['last_name'];
            unset($param['first_name']);
            unset($param['last_name']);
            $count=$this->User_model->count(array('email'=>$param['email']));

            if($count>0){
                $this->session->set_flashdata('error','count_error');
                $this->redirect('auth/register');
            }else{
                $this->User_model->insert($param);
                $this->session->set_flashdata('success','success');
                $this->redirect('auth/login');
            }

        }
    }

    function forgot() {
		$email = $this->input->post('email');
		$user = $this->db->get_where('tbl_user',array('email'=>$email))->row();
		if($user){
			$token = md5(uniqid());
			$expired = date("Y-m-d H:i:s",strtotime("+1 hours"));
			$this->db->update('tbl_user',array('token'=>$token,'token_expired'=>$expired),array('email'=>$email));

			$link = site_url('auth/reset/'.$token);

			$subject = "New request to reset password in Ncdeliteveterans.org";
			$content = "Hello ".$user->name."<br><br>";
			$content.= "An Request has been received to change the password for your Ncdeliteveterans.org account.<br><br>";
			$content.= "<p><a href='".$link."'>Reset Passsword</a></p>";
			$content.= "Thank you, <br>";
			$content.= "Ncdeliteveterans Team<br>";

			$this->db->insert('tbl_email_queue',array('email'=>$email,
				'content'=>$content,
				'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));


			$this->mContent['message'] = "An request change password has sent your email.";
		}else{
			$this->mContent['error'] = "Sorry. Email does not existed";
		}
		$this->render("{$this->sub_mLayout}login", $this->mLayout);
    }

	function reset($token){
		$user = $this->db->get_where('tbl_user',array('token'=>$token))->row();

		if($user && $user->token_expired >= date("Y-m-d H:i:s")){
			$pass_plain= uniqid();
			$pass = md5($pass_plain);

			$this->db->update('tbl_user',
				array('token'=>null,'token_expired'=>null,'password'=>$pass),
				array('email'=>$user->email));


			$subject = "New request to reset password in Ncdeliteveterans.org";
			$content = "Hello ".$user->name."<br><br>";
			$content.= "Your account:<br><br>";
			$content.= "<p>
				Username: ".$user->email."<br>
				Password: ".$pass_plain."<br>
			</p>";
			$content.= "Thank you, <br>";
			$content.= "Ncdeliteveterans Team<br>";

			$this->db->insert('tbl_email_queue',array('email'=>$user->email,
				'content'=>$content,
				'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));

			$this->mContent['message'] = "New password has sent your email.";
		}else{
			$this->mContent['error'] = "Sorry. Invalid request or Token is expired.";
		}
		$this->render("{$this->sub_mLayout}login", $this->mLayout);
	}

    function logout() {
        $this->session->sess_destroy();
        redirect("auth/login");
//        $this->redirect('auth/login');
    }

    function del_cookie(){
        if (get_cookie('email'))
            delete_cookie('email');
        if (get_cookie('password'))
            delete_cookie('password');
    }
}
