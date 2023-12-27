<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postbid extends CI_Controller {
	public $mLayout = 'customer/';
    public $sub_mLayout = 'postbid/';

	function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'home';
        $this->mHeader['title'] = 'Home';
        $this->mContent['msg'] = ""; 
		$this->load->model(array('Webinar_model'));
    }


	public function sponsor($hash){
		$obj = $this->db->get_where('tbl_sponsor',array('MD5(id)'=>$hash))->row();
		if($obj){
			$data = $this->db->get_where('tbl_contract',array('hash'=>$hash))->result_array();
			 
			$this->mContent['data'] = $data;
			$this->mContent['sponsor'] = $obj;
			$this->mContent['hash'] = $hash;
			$this->render("{$this->sub_mLayout}postbid_list", $this->mLayout);
		}else{
			die("Sorry, Invalid request.");
		}
	}

	public function add($hash){
         $obj = $this->db->get_where('tbl_sponsor',array('MD5(id)'=>$hash))->row();
		 if($obj){
			 
			 $this->mContent['hash'] = $hash;
			 $this->mContent['data'] = $data;
			 $this->mContent['sponsor'] = $obj;
			 
			 $company_type = $this->db->get_where('tbl_company_type',array())->result_array();
			 $this->mContent['company_type'] = $company_type;
			 
			 $this->render("{$this->sub_mLayout}create_postbid", $this->mLayout);
		 }else{
			 die("Sorry, Invalid request.");
		 }
		 
    }
	
	public function edit($id,$hash){
         $obj = $this->db->get_where('tbl_sponsor',array('MD5(id)'=>$hash))->row();
		 if($obj){
			 $data = $this->db->get_where('tbl_contract',array('id'=>$id))->row_array();
			 $this->mContent['hash'] = $hash;
			 $this->mContent['data'] = $data;
			 
			 $company_type = $this->db->get_where('tbl_company_type',array())->result_array();
			 $this->mContent['company_type'] = $company_type;
			 
			 $this->render("{$this->sub_mLayout}edit_postbid", $this->mLayout);
		 }else{
			 die("Sorry, Invalid request.");
		 }
		 
    }
	
	public function insert($hash){
		
		$obj = $this->db->get_where('tbl_sponsor',array('MD5(id)'=>$hash))->row();
		$data = $this->input->post();
		$this->Webinar_model->setTable('tbl_contract');
		 
		if(!$data['start_date']){
			$start = date("Y-m-d",strtotime('now'));
		}else{
			$start = date("Y-m-d",strtotime($data['start_date']));
		}
		 
		if(!$data['end_date']){
			$end = date("Y-m-d",strtotime('+1 year'));
		}else{
			$end = date("Y-m-d",strtotime($data['end_date']));
		}

		if (!$data['contract_id']){
			$data_insert = array(
				"title"=>$data['title'],
				"hash"=>$data['hash'],
				"details"=>$data['details'],
				"company"=>$data['company'],
				"company_type"=>$data['company_type'],
				"name"=>$data['name'], 
				"email"=>$data['email'],
				"phone"=>$data['phone'],
				"start_date"=>$start,
				"end_date"=>$end,
				"details"=>$data['details'],
				"sponsor"=>$data['sponsor'],
				"status"=>'available',
				"type"=>1 //$data['type']
			);
			
			if(empty($_FILES['thumbnail']['name'])){
				$data_insert['thumbnail'] = $obj->icon;
			}
			
			$insert_ID = $this->Webinar_model->insert($data_insert);
			
			//send to author
			$email = $obj->email;
			 $data_insert['id'] = $insert_ID;
			$email_content = $this->load->view('email/job',
			array('data'=>$data_insert),true);
			 
			$subject = 'Your New Opportunity ['.$data['title'].'] has been submitted.';
			$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$user->name.'&t='.$user->phone.'&type='.$user->company.'&p=Email').'"/>';
			
			$pre_email = 'Hi '.$obj->name.',<br> Your Opportunity has been submitted. Please check content bellow.<br>';

			$this->db->insert('tbl_email_queue',array('email'=>$email,
					'content'=>$pre_email.$email_content. $image_refer,
					'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));
					
			//send to user			 
			$users = $this->db->get_where('tbl_user',array('company_type'=>$data['company_type']))->result();
			 
			if(!empty($users)){
				foreach($users as $user){
					$email = $user->email;			
					$email_content = $this->load->view('email/job',
					array('data'=>$data_insert),true);
					 
					$subject = 'New Opportunity - '.$data['title'];
					$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$user->name.'&t='.$user->phone.'&type='.$user->company.'&p=Email').'"/>';
					$pre_email = 'Hi '.$user->name.',<br> New opportunity has been submitted. Please check content bellow.<br>';
					$this->db->insert('tbl_email_queue',array('email'=>$email,
							'content'=>$pre_email.$email_content. $image_refer,
							'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));
				}
			}
			
		}else{
			$data_insert = array(
				"title"=>$data['title'],
				"details"=>$data['details'],
				"company"=>$data['company'],
				"company_type"=>$data['company_type'],
				"name"=>$data['name'], 
				"email"=>$data['email'],
				"phone"=>$data['phone'], 
				"start_date"=>$start,
				"end_date"=>$end,
				"details"=>$data['details'],
				"sponsor"=>$data['sponsor']				 
			);
			
			$this->Webinar_model->update(array("id"=>$data['contract_id']), $data_insert);
			$insert_ID = $data['contract_id'];
			$data_insert['id'] = $insert_ID;
			//send to author
			$email = $obj->email;			
			$email_content = $this->load->view('email/job',
			array('data'=>$data_insert),true); 
			
			$subject = 'Your Opportunity ['.$data['title'].'] has been updated.';
			$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$user->name.'&t='.$user->phone.'&type='.$user->company.'&p=Email').'"/>';
			
			$pre_email = 'Hi '.$obj->name.',<br> Your Opportunity has been updated. Please check content bellow.<br>';
			 
			$this->db->insert('tbl_email_queue',array('email'=>$email,
					'content'=>$pre_email.$email_content. $image_refer,
					'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));
					
			//send to user
			 
			$users = $this->db->get_where('tbl_user',array('company_type'=>$data['company_type']))->result();
			//print_r($users);die('xxx');
			if(!empty($users)){
				foreach($users as $user){
					$email = $user->email;			
					$email_content = $this->load->view('email/job',
					array('data'=>$data_insert),true);
					 
					$subject = 'New Opportunity - '.$data['title'];
					$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$user->name.'&t='.$user->phone.'&type='.$user->company.'&p=Email').'"/>';
					$pre_email = 'Hi '.$user->name.',<br> New opportunity has been submitted. Please check content bellow.<br>';
					$this->db->insert('tbl_email_queue',array('email'=>$email,
							'content'=>$pre_email.$email_content. $image_refer,
							'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));
				}
			}
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
		
		redirect('postbid/sponsor/'.$data['hash']);
	}
	
	public function create($hash){
         $obj = $this->db->get_where('tbl_contract_link',array('hash'=>$hash))->row();
		 if($obj){
			 $data = $this->db->get_where('tbl_contract',array('hash'=>$hash))->row_array();
			 if(!$data){
				 $data['hash'] = $hash;
			 }
			 //print_r($data );die();
			 $this->mContent['hash'] = $hash;
			 $this->mContent['data'] = $data;
			 
			 $company_type = $this->db->get_where('tbl_company_type',array())->result_array();
			 $this->mContent['company_type'] = $company_type;
			 
			 $this->render("{$this->sub_mLayout}create_postbid", $this->mLayout);
		 }else{
			 die("Sorry, Invalid request.");
		 }
		 
    }
	
	public function update(){
		$data = $this->input->post();
		$this->Webinar_model->setTable('tbl_contract');

		if (!$data['contract_id']){
			$data_insert = array(
				"title"=>$data['title'],
				"hash"=>$data['hash'],
				"details"=>$data['details'],
				"company"=>$data['company'],
				"company_type"=>$data['company_type'],
				"name"=>$data['name'], 
				"email"=>$data['email'],
				"phone"=>$data['phone'],
				"start_date"=>date("Y-m-d",strtotime('now')),
				"end_date"=>date("Y-m-d",strtotime('+1 year')),
				"details"=>$data['details'],
				"sponsor"=>$data['sponsor'],
				"status"=>'available',
				"type"=>1 //$data['type']
			);
			
			$insert_ID = $this->Webinar_model->insert($data_insert);
			
			

		}else{
			$this->Webinar_model->update(array("id"=>$data['contract_id']), array(
				"title"=>$data['title'],
				"details"=>$data['details'],
				"company"=>$data['company'],
				"company_type"=>$data['company_type'],
				"name"=>$data['name'], 
				"email"=>$data['email'],
				"phone"=>$data['phone'], 
				"details"=>$data['details'],
				"sponsor"=>$data['sponsor']				 
			));
			$insert_ID = $data['contract_id'];
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
		
		redirect('postbid/create/'.$data['hash']);
	}
	

	protected function render($view, $layout = '') {
        $flash = $this->session->flashdata('flash');
        if ($flash) {
            $this->mHeader['flash'] = $flash;
            $this->session->unset_userdata('flash');
        }

        $alert = $this->session->userdata('alert');
        if ($alert) {
            $this->mContent['alert'] = $alert;
            $this->session->unset_userdata('alert');
        }

        $this->load->view("layout/{$layout}header", $this->mHeader);
        $this->load->view($view, $this->mContent);
        $this->load->view("layout/{$layout}footer", $this->mFooter);
    }

    protected function redirect($url) {
        redirect(base_url($url));
    }

    protected function json($data) {
        $json = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($json);
    }

    protected function success($result = NULL) {
        $data['success'] = true;
        if($result)
            $data['result'] = $result;
        $this->json($data);
    }

    protected function error($result = NULL) {
        $data['success'] = false;
        if($result)
            $data['result'] = $result;
        $this->json($data);
    }

}
