<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public $mLayout = 'marketing/';
    public $sub_mLayout = 'marketing/user/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'user';
        $this->mHeader['title'] = 'User';
        $this->mContent['msg'] = "";
        $this->load->model(array('User_model'));
		if(get_admin_level() != 1){
			redirect('marketing/dashboard');
		}

    }

     /*
     * User
     * */
    public function index(){

        $this->mHeader['sub_id'] = 'user_view';
        $this->render("{$this->sub_mLayout}user", $this->mLayout);
    }

    public function get_User(){

        $table_data['data'] = $this->db->get_where('mark_user')->result_array();

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
           
        }
        echo json_encode($table_data);
    }

    public function insert_User(){

       $data = $this->input->post();
       $status = $this->db->update('mark_user',
		   array("name"=>$data['name'],
			   "email"=>$data['email'],
			   "phone_number"=>$data['phone_number'],
			   "postcode"=>$data['postcode'],
			   "title"=>$data['title'],
			   "company"=>$data['company']
		   ),
		   array("id"=>$data['id'])
	   );

	   $result = array('status'=>$status,'data'=>$data);
	   if(!$status){
		   $result['debug'] = $this->db->last_query();
	   }
	   echo json_encode($result);

   }

    public function del_User(){
        $id = $this->input->post('id');
        $this->User_model->setTable('mark_user');
        $result['msg'] = $this->User_model->delete(array("id"=>$id));
    }

    public function add_user(){
        $data = $this->input->post();

        $exist_user = $this->db->get_where('mark_user',array("email"=>$data['email']))->result_array();

        $result = array();

        if(count($exist_user) > 0){
            $result['status'] = 'error';
            $result['error'] = 'An account already exists for this email address';
            echo json_encode($result);

        }else{
            // Add new user
            $this->db->insert('mark_user',array(
                'email' => $data['email'],
                'password' => md5($data['password']),
                'name' => $data['name'],
                'phone_number' => $data['phonenumber'],
                'postcode' => $data['postcode'],
                'title' => $data['title'],
                'company' => $data['company']
            ));
            $result['status'] = 'success';
            echo json_encode($result);
        }


    }

	public function import(){
		if($this->input->post('submit')){
			$this->do_import();
		}
		$this->mHeader['sub_id'] = 'Import';
		$this->render("{$this->sub_mLayout}import", $this->mLayout);
	}

	private function do_import(){
		set_time_limit(0);

		$this->load->library('excel');

		$config['upload_path'] = './assets/uploads/import';
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '10000';
		$file_import ='';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', $error );
		}
		else
		{
			$upload = $this->upload->data();
			$file_import = $upload['full_path'];

		}
		if(!$error){

			$aryData = $this->excel->load($file_import,2);//Input file path,Rows Start

			$imported = 0;
			$dupliated = [];
			foreach($aryData['data'] as $row){
				$email = $row[1];
				if(!$this->checkExisted($email)){
					$this->insertMember($row);
					$imported++;
				}else{
					$dupliated[] = $email;
				}
			}

			$this->session->set_flashdata('message','Import '.$imported .' users ('.count($dupliated).' duplicated) successfully.');
		}else{
			$this->session->set_flashdata('error',implode('<br>',$error));
		}
	}

	private function checkExisted($email){

		$row = $this->db->get_where('mark_user',array('email'=>$email))->row();
		return ($row)?true:false;
	}


	private function insertMember($row){

		$email = $row[1];
		$password = ($row[2])? md5($row[2]): md5('123');
		$name = $row[0];
		$phone_number =$row[3];
		$title =$row[4];
		$company =$row[5];
		$postcode =$row[6];
		$this->db->insert('mark_user',
		array(
			'email'=>$email,
			'password'=>$password,
			'name'=>$name,
			'phone_number'=>$phone_number,
			'title'=>$title,
			'company'=>$company,
			'postcode'=>$postcode
		));
	}
}
