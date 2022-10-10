<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dig extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/dig/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'dig';
		$this->mHeader['title'] = 'Digs';
		$this->mContent['msg'] = "";
		$this->load->model(['Dig_model']);
	}
	
	public function index(){
		$this->list();
	}

	public function list(){
		$this->mHeader['sub_id'] = 'view';
		$this->render("{$this->sub_mLayout}index", $this->mLayout);
	}

	 
	public function get_data(){
		$this->db->select('*');
		$this->db->order_by('created_at','desc');
		$data = $this->db->get_where('tbl_dig',array())->result_array();

		foreach ($data as $k=>$v){

			$data[$k]['title'] = $v['title'] ;			 
			if($v['photo']) {
				$data[$k]['photo'] = '<img src="' . base_url() . $v['photo'] . '" width="100" height="100"/>';
			}
		}

		$table_data['data'] = $data;

		echo json_encode($table_data);
	}

	public function add(){

		$this->mHeader['sub_id'] = 'add';
		$this->mContent['data'][0]['id']='0';
		$this->render("{$this->sub_mLayout}add", $this->mLayout);
	}

	public function save_article(){
		$status = $this->input->post('status');
		$article_id = $this->input->post('article_id');
		if($article_id){
			$old = $this->db->get_where('tbl_dig',array('id'=>$article_id))->row_array();
			if($old) {				 
				$title = $this->input->post('title');
				$photo = $this->input->post('image');
				$pdf = $this->input->post('pdf_file');
				$data = array(
					'title' => $title,					 
					'created_at' => date("Y-m-d H:i:s")
				);
				
				if($photo){
					$data['photo'] = $photo; 
				}
				if($pdf){ 
					$data['pdf'] = $pdf;
				}
				
				$this->db->update('tbl_dig', $data, array('id' => $article_id));
			}

		}else { 
			$title = $this->input->post('title');
			$photo = $this->input->post('photo');
			$pdf = $this->input->post('pdf'); 
			$data = array(
				'title' => $title,
				'photo' => $photo, 
				'pdf' => $pdf,
				'created_at' => date("Y-m-d H:i:s")
			);			 
			$this->db->insert('tbl_dig', $data);
			$new_article_id = $this->db->insert_id();


		} 
		 

		if (!empty($_FILES['icon']['name'])) {
			if( !file_exists('./assets/uploads/dig/') )
				mkdir('./assets/uploads/dig/', 0777, true);
			$file_name = time().$_FILES['icon']['name'];
			if($new_article_id){
				$article_id = $new_article_id;
			}
			

			if (move_uploaded_file($_FILES['icon']['tmp_name'],'assets/uploads/dig/'.$file_name)) {
				$this->Dig_model->update(array("id"=>$article_id), array("photo"=>'assets/uploads/dig/'.$file_name));
			}
		}
		
		if (!empty($_FILES['pdf']['name'])) {
			if( !file_exists('./assets/uploads/dig/') )
				mkdir('./assets/uploads/dig/', 0777, true);
			$file_name = time().$_FILES['pdf']['name'];
			if($new_article_id){
				$article_id = $new_article_id;
			}

			if (move_uploaded_file($_FILES['pdf']['tmp_name'],'assets/uploads/dig/'.$file_name)) {
				$this->Dig_model->update(array("id"=>$article_id), array("pdf"=>'assets/uploads/dig/'.$file_name));
			}
		}


		echo json_encode($data);

	} 

	public function edit(){

		$this->mHeader['sub_id'] = 'view';
		$id = $this->input->get('id');
		$this->mContent['data'] = $this->db->get_where('tbl_dig',array('id'=>$id))->row_array();
		$this->render("{$this->sub_mLayout}edit", $this->mLayout);
	}


	public function delete(){
		$id = $this->input->post('id');
		$this->db->delete('tbl_dig',array('id'=>$id));
	}
	
	public function sendemail(){
		$article_id = $this->input->post('article_id');
		$dig = $this->db->get_where('tbl_dig',array('id'=>$article_id))->row_array();
		
		$subject = 'THE ELITE SDVOB NET WORK - Digital Magazzine';
		
		$email_content = '
					<table style="display:block;width:100%;border:1px solid #666; text-align:center;margin:auto;" cellspacing=0 cellpadding=0><tr>
					<td style="padding:0px; width:50%;">
					<img style="width:400px;" src="'.base_url().$dig['photo'].'"/>
					</td><td style="padding:10px; width:50%; text-align:center; vertical-align:middle;color:#fff">
					'.($dig['title']?'':'<h1>'.$dig['title'].'</h1>').'
					<h2><a target="_blank" style="display:inline-block;width:100%;" title="Dig Mag" href="'.base_url().$dig['pdf'].'">View Digital Magazine</a></h2>
					</td>
					</tr></table>'; 
		 
		 
		$data = $this->db->get('tbl_user')->result_array();

		foreach($data as $k=>$v){
			$email = $v['email'];

			$content = 'Hi, '.$v['name']. "<br/><p>".$email_content."</p>";
			$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$v['name'].'&t='.$v['phone_number'].'&type='.$v['title'].'&p=DM').'"/>';
			
			if($email){

				$this->db->insert('tbl_email_queue',array('email'=>$email,
					'content'=>$content. $image_refer,
					'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));
			}
			 

		}
		echo json_encode(array('status'=>1,'message'=>''.count($data).' emails has added to queue.'));
	}

}
