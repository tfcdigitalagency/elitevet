<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/user/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'user';
        $this->mHeader['title'] = 'User';
        $this->mContent['msg'] = "";
        $this->load->model(array('User_model'));
        $this->load->model(array('Reg_history_model'));
        $this->load->model(array('Membership_model'));
        $this->load->model(array('Attend_history_model'));
		if(get_admin_level() != 1){
			redirect('admin/dashboard');
		}

    }

     /*
     * User
     * */
    public function user(){

        $this->mHeader['sub_id'] = 'user_view';
        $this->mContent['membership'] = $this->Membership_model->find(array(), array(), array(), true);
        $this->mContent['company_type'] = $this->db->get_where('tbl_company_type',array())->result_array();
        $this->render("{$this->sub_mLayout}user", $this->mLayout);
    }

    public function get_User(){

        $this->User_model->setTable('tbl_user');
        $table_data['data'] = $this->User_model->get_User();

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
            $table_data['data'][$key]["real_register"] = $this->Reg_history_model->count(array("user_id"=>$row["id"]));
            $table_data['data'][$key]["real_attend"] = $this->Attend_history_model->count(array("user_id"=>$row["id"]));
        }
        echo json_encode($table_data);
    }

    public function insert_User(){

       $data = $this->input->post();
       $status = $this->db->update('tbl_user',
		   array("name"=>$data['name'],"email"=>$data['email'],
			   "phone_number"=>$data['phone_number'],
			   "postcode"=>$data['postcode'],
			   "title"=>$data['title'],
			   "company"=>$data['company'],
			   "membership_id"=>$data['membership_id'],
			   "company_type"=>$data['company_type'],
			   "is_admin"=>$data['is_admin']),
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
        $this->User_model->setTable('tbl_user');
        $result['msg'] = $this->User_model->delete(array("id"=>$id));
    }

    /*
     * Contact
     * */
    public function contact(){
        $this->mHeader['sub_id'] = 'contact';
        $this->User_model->setTable('tbl_user');
        $this->mContent['user'] = $this->User_model->find(array(), array(), array(), true);
        $this->User_model->setTable('tbl_contact');
        $this->mContent['contact'] = $this->User_model->find(array(), array(), array(), true);
        $this->mContent['sel_id']=-1;
        $this->render("{$this->sub_mLayout}contact", $this->mLayout);
    }

    public function get_Contact(){

    	$id = $this->input->get('id');

    	$this->mHeader['sub_id'] = 'contact';
        $this->User_model->setTable('tbl_user');
        $this->mContent['user'] = $this->User_model->find(array(), array(), array(), true);
        $this->User_model->setTable('tbl_contact');
        $this->mContent['contact'] = $this->User_model->get_Contact($id);
        $this->mContent['sel_id']=$id;
        $this->render("{$this->sub_mLayout}contact", $this->mLayout);

    }

    public function display_reg_History(){

        $this->mHeader['sub_id'] = 'view';
        $id = $this->input->get('id');
        $this->mContent['user_id'] = $id;
        $this->mContent['user'] = $this->User_model->find(array("id"=>$id), array(), array(), true);

        $this->render("{$this->sub_mLayout}reg_history_index", $this->mLayout);
    }

    public function get_reg_History(){
        $param = $this->input->post();
        $table_data['data'] = $this->Reg_history_model->get_reg_History(array('user_id'=>$param['user_id']));

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
        }
        echo json_encode($table_data);
    }

    public function display_attend_History(){

        $this->mHeader['sub_id'] = 'view';
        $id = $this->input->get('id');
        $this->mContent['user_id'] = $id;
        $this->mContent['user'] = $this->User_model->find(array("id"=>$id), array(), array(), true);

        $this->render("{$this->sub_mLayout}attend_history_index", $this->mLayout);
    }

    public function get_attend_History(){
        $param = $this->input->post();
        $table_data['data'] = $this->Attend_history_model->get_att_History(array('user_id'=>$param['user_id']));

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
        }
        echo json_encode($table_data);
    }

    public function update_Ischecked(){

        $data = $this->input->post();
        $this->User_model->update(array("id"=>$data['id']), array("is_checked"=>$data['state']));
    }

    public function check_user(){
        $data = $this->input->post();
        $result = array();

        if(isset($data['select'])){
            $select = $data['select'];
            $select = explode("-",$select);
            $check = $select[0];
            $value = $select[1];
            if($check == "check"){
                $this->User_model->update(array(), array("is_checked"=>0));
                if($value == 'all')                 $this->User_model->update(array(), array("is_checked"=>1));
                else if($value == 'coporate')       $this->User_model->update(array("title" => "Corporate"), array("is_checked"=>1));
                else if($value == 'veteran')        $this->User_model->update(array("title" => "Veteran"), array("is_checked"=>1));
                else if($value == 'disable')        $this->User_model->update(array("title" => "Disabled Vet"), array("is_checked"=>1));
                else if($value == 'other')          $this->User_model->update(array("title" => "Other"), array("is_checked"=>1));
                else if($value == 'membership')     $this->User_model->update(array('membership_id > 0' => null), array("is_checked"=>1));
            }else if($check == "uncheck"){
                $this->User_model->update(array(), array("is_checked"=>1));
                if($value == 'all')                 $this->User_model->update(array(), array("is_checked"=>0));
                else if($value == 'coporate')       $this->User_model->update(array("title" => "Corporate"), array("is_checked"=>0));
                else if($value == 'veteran')        $this->User_model->update(array("title" => "Veteran"), array("is_checked"=>0));
                else if($value == 'disable')        $this->User_model->update(array("title" => "Disabled Vet"), array("is_checked"=>0));
                else if($value == 'other')          $this->User_model->update(array("title" => "Other"), array("is_checked"=>0));
                else if($value == 'membership')     $this->User_model->update(array('membership_id > 0' => null), array("is_checked"=>0));
            }

            $result['status'] = 'success';
        }
        echo json_encode($result);
    }

    public function add_user(){
        $data = $this->input->post();

        $exist_user = $this->User_model->find(array("email"=>$data['email']), array(), array(), true);

        $result = array();

        if(count($exist_user) > 0){
            $result['status'] = 'error';
            $result['error'] = 'An account already exists for this email address';
            echo json_encode($result);

        }else{
            // Add new user
            $this->User_model->insert(array(
                'email' => $data['email'],
                'password' => md5($data['password']),
                'name' => $data['name'],
                'phone_number' => $data['phonenumber'],
                'postcode' => $data['postcode'],
                'title' => $data['title'],
                'company' => $data['company'],
                'is_admin' => $data['admin'],
                'company_type' => $data['company_type']
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
        $this->mContent['membership'] = $this->Membership_model->find(array(), array(), array(), true);
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

		$row = $this->db->get_where('tbl_user',array('email'=>$email))->row();
		return ($row)?true:false;
	}

	private function getMemberShip($member_ship){

		$row = $this->db->get_where('tbl_membership',array('name'=>$member_ship))->row();
		return $row->id;
	}

	private function insertMember($row){

		$email = $row[1];
		$password = ($row[2])? md5($row[2]): md5('123');
		$name = $row[0];
		$phone_number =$row[4];
		$title =$row[5];
		$company =$row[6];
		$postcode =$row[7];
		$membership_id = $this->getMemberShip($row[3]);
		$this->db->insert('tbl_user',
		array(
			'email'=>$email,
			'password'=>$password,
			'name'=>$name,
			'phone_number'=>$phone_number,
			'title'=>$title,
			'company'=>$company,
			'membership_id'=>$membership_id,
			'postcode'=>$postcode
		));
	}
}
