<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/news/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'news';
		$this->mHeader['title'] = 'News';
		$this->mContent['msg'] = "";
		$this->load->model(['News_model']);
	}

	public function list(){
		$this->mHeader['sub_id'] = 'view';
		$this->render("{$this->sub_mLayout}index", $this->mLayout);
	}

	public function statistic($article_id){
		$this->mHeader['sub_id'] = 'statistic';
		$this->mHeader['article'] = $this->db->get_where('tbl_news',array('id'=>$article_id))->row_array();

		$data = [];

		for($i=27;$i>0; $i--){
			$date = date('M d',strtotime("-$i days"));
			$opened = article_get_log($article_id,'opened','DATE_FORMAT(created,"%Y-%m-%d")="'.date('Y-m-d',strtotime("-$i days")).'"');
			$clicked = article_get_log($article_id,'clicked','DATE_FORMAT(created,"%Y-%m-%d")="'.date('Y-m-d',strtotime("-$i days")).'"');
			$viewed = article_get_log($article_id,'viewed','DATE_FORMAT(created,"%Y-%m-%d")="'.date('Y-m-d',strtotime("-$i days")).'"');
			$data[] = array($date,$opened,$clicked,$viewed);
		}
		for ($i=0;$i<3; $i++){
			$date = date('M d',strtotime("+$i days"));
			$opened = article_get_log($article_id,'opened','DATE_FORMAT(created,"%Y-%m-%d")="'.date('Y-m-d',strtotime("+$i days")).'"');
			$clicked = article_get_log($article_id,'clicked','DATE_FORMAT(created,"%Y-%m-%d")="'.date('Y-m-d',strtotime("+$i days")).'"');
			$viewed = article_get_log($article_id,'viewed','DATE_FORMAT(created,"%Y-%m-%d")="'.date('Y-m-d',strtotime("+$i days")).'"');
			$data[] = array($date,$opened,$clicked,$viewed);
		}

		$this->mContent['statistic'] = $data;

		$this->db->order_by('created','DESC');
		$this->db->limit(10);
		$this->db->select('*');
		$this->db->join('tbl_user','tbl_user.id = tbl_new_statistic.uid','left');
		$recents = $this->db->get_where('tbl_new_statistic',array('article_id'=>$article_id))->result_array();
//		echo '<pre>'; print_r($recents);die();
		$this->mContent['recents'] = $recents;

		$this->render("{$this->sub_mLayout}statistic", $this->mLayout);
	}

	public function get_data(){
		$this->db->select('*');
		$this->db->order_by('created_at','desc');
		$data = $this->db->get_where('tbl_news',array())->result_array();

		foreach ($data as $k=>$v){

			$data[$k]['article_title'] = '<a target="_blank" title="Statistic" href="'.site_url('news/article/'.$v['slug']).'">'.$v['article_title'].'</a>';
			$sent = article_get_log($v['id'],'sent');
			$data[$k]['sent'] = '<div><strong><a href="'.site_url('admin/news/statistic/'.$v['id']).'">'.$sent.'</a></strong></div><div><small>sent</small></div>';
			$data[$k]['clicked'] = '<div><strong>'.article_get_percent($v['id'],'clicked',$sent).'%</strong></div>'.'<div><small>clicked</small></div>';
			$data[$k]['opened'] = '<div><strong>'.article_get_percent($v['id'],'opened',$sent).'%</strong></div>'.'<div><small>opened</small></div>';
			$data[$k]['viewed'] = '<div><strong>'.article_get_percent($v['id'],'viewed',$sent).'%</strong></div>'.'<div><small>viewed</small></div>';
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
			$old = $this->db->get_where('tbl_news',array('id'=>$article_id))->row_array();
			if($old) {
				$detail = $this->input->post('detail');
				$title = $this->input->post('title');
				$photo = $this->input->post('photo');
				$data = array(
					'article_title' => $title,
					'photo' => $photo,
					'short' => $this->input->post('short'),
					'detail' => $detail,
					'status' => $this->input->post('status'),
					'created_at' => date("Y-m-d H:i:s")
				);
				$this->db->update('tbl_news', $data, array('id' => $article_id));
			}

		}else {
			$detail = $this->input->post('detail');
			$title = $this->input->post('title');
			$photo = $this->input->post('photo');
			$slug = get_article_slug($title);
			$data = array(
				'article_title' => $title,
				'photo' => $photo,
				'slug' => $slug,
				'short' => $this->input->post('short'),
				'detail' => $detail,
				'status' => $this->input->post('status'),
				'created_at' => date("Y-m-d H:i:s")
			);
			$this->db->insert('tbl_news', $data);
			$new_article_id = $this->db->insert_id();


		}
		//send email
		if(!$article_id && $status == 1){
			$article = $this->db->get_where('tbl_news',array('id'=>$new_article_id))->row_array();
			$this->sendNotify($article);
		}else if($article_id){
			if($status == 1 && $old['status'] == 0){
				//send email
				$article = $this->db->get_where('tbl_news',array('id'=>$article_id))->row_array();
				$this->sendNotify($article);
			}
		}

		if (!empty($_FILES['icon']['name'])) {
			if( !file_exists('./assets/uploads/news/') )
				mkdir('./assets/uploads/news/', 0777, true);
			$file_name = time().$_FILES['icon']['name'];
			if($new_article_id){
				$article_id = $new_article_id;
			}

			if (move_uploaded_file($_FILES['icon']['tmp_name'],'assets/uploads/news/'.$file_name)) {
				$this->News_model->update(array("id"=>$article_id), array("photo"=>'assets/uploads/news/'.$file_name));
			}
		}


		echo json_encode($data);

	}

	private function sendNotify($news){

		$subject = "THE ELITE SDVOB NET WORK - ".$news['article_title'] ;

		$email_content = $this->load->view('email/article',array('item'=>$news),true);

		$emails = $this->db->get_where('tbl_user',array('subscribe'=>1))->result_array();

		article_log($news['id'],'sent',count($emails));

		foreach($emails as $k=>$v){
			$email = $v['email'];

			$content = 'Hi, '.$v['name']. "<br/>".$email_content;
			$image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?act=article&e='.$email.'&aid='.$news['id']).'"/>';

			if($email){
				//$this->sendMail($email, $content. $image_refer, $subject);
				$this->db->insert('tbl_email_queue',array('email'=>$email,
					'content'=>$content. $image_refer,
					'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s")));
			}

		}
	}

	public function edit(){

		$this->mHeader['sub_id'] = 'view';
		$id = $this->input->get('id');
		$this->mContent['data'] = $this->db->get_where('tbl_news',array('id'=>$id))->row_array();
		$this->render("{$this->sub_mLayout}edit", $this->mLayout);
	}


	public function delete(){
		$id = $this->input->post('id');
		$this->db->delete('tbl_news',array('id'=>$id));
	}

}
