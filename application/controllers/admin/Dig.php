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
		$this->db->order_by('id','desc');
		$data = $this->db->get_where('tbl_dig',array())->result_array();

		foreach ($data as $k=>$v){

			$data[$k]['title'] = $v['title'] ;			 
			if($v['photo']) {
				$urlImg = $v['photo'];
				if(strpos($urlImg,'https://')=== false){
					$urlImg = base_url().$urlImg;
				}
				$data[$k]['photo'] = '<img src="' . $urlImg . '" width="100" height="100"/>';
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
				$type = $this->input->post('type');
				$pdf = $this->input->post('pdf_file');
				$pdf_view = $this->input->post('pdf_view');
				$home = $this->input->post('home')?1:0;
				$position = $this->input->post('position');
				if($position){
					$this->db->update('tbl_dig',array('position'=>0),array('position'=>$position));
				}
				
				if($home){
					$this->db->update('tbl_dig',array('home'=>0));
				}
				$data = array(
					'title' => $title,					 
					'type' => $type,					 
					'home' => $home,
					'position' => $position,					
					'pdf_view' => $pdf_view,					 
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
			$type = $this->input->post(type);
			$pdf = $this->input->post('pdf'); 
			$home = $this->input->post('home')?1:0;
			$position = $this->input->post('position');
			if($position){
				$this->db->update('tbl_dig',array('position'=>0),array('position'=>$position));
			}
			
			if($home){
				$this->db->update('tbl_dig',array('home'=>0));
			}
			$data = array(
				'title' => $title,
				'type' => $type,
				'photo' => $photo, 
				'home' => $home,
				'position' => $position,
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
		
		$urlImg = $dig['photo'];
		if(strpos($urlImg,'https://')=== false){
			$urlImg = base_url().$urlImg;
		}
		
		
		$email_content = '
					<table style="display:block;width:100%;border:1px solid #666; text-align:center;margin:auto;" cellspacing=0 cellpadding=0><tr>
					<td style="padding:0px; width:50%;">
					<img style="width:400px;" src="'.$urlImg.'"/>
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
	
	function scrape(){
		$key=$_GET['s'];
		$url = 'https://freemagazines.top/wp-json/wp/v2/posts?search='.urlencode($key).'&author=1&orderby=date&order=desc';
		$this->load->library('session');
		$data = $this->curl_get_content($url);
		 	
		$total = 0;
		if($data){
			$data = json_decode($data,true);
			
			//echo '<pre>';print_r($data);die();
			
			foreach($data as $item){
				
				$media = $this->curl_get_content($item['_links']['wp:featuredmedia'][0]['href']);
				$media = json_decode($media,true);
				  
				$pdf_urls = getUrlsFromEmbedTagsUsingRegex ($item['content']['rendered']);	
				//print_r($pdf_urls);die();
		
				if($pdf_urls[0]){
					$title = $item['title']['rendered'];
					$photo = $media['guid']['rendered'];
					$type = 0; 
					$pdf = $pdf_urls[0];
					$cid = $item['id'];
					
					$check = $this->db->get_where('tbl_dig',array('cid'=>$cid))->row();
					 	
					if(!$check){
						$ins = array(
							'title' => $title,
							'type' => $type,
							'photo' => $photo, 
							'pdf' => $pdf,
							'cid' => $cid,
							'created_at' => date("Y-m-d H:i:s")
						);			 
						$this->db->insert('tbl_dig', $ins);
						$new_article_id = $this->db->insert_id();
						$total++;
					}
				}
			}
			 
		}
		$this->session->set_flashdata("message","found total ".count($data)." items and Inserted ".$total." to database, other items already added or cannot get PDF file link.");
		redirect('admin/dig/');
		
	}
	
	function curl_get_content($url){
		$agent= 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		return $result;
	}

}


function getUrlsFromEmbedTagsUsingRegex($html) {
    $urls = [];

    // Regular expression pattern to match embed tags and extract src attribute
    $pattern = '/<embed[^>]+src="([^"]+)"/i';

    // Perform the regex match
    preg_match_all($pattern, $html, $matches);

    // Extract URLs from the matched src attributes
    if (!empty($matches[1])) {
        $urls = $matches[1];
    }else{
		// Regular expression pattern to match embed tags and extract src attribute
		$pattern = '/<a[^>]+href="([^"]+)"/i';

		// Perform the regex match
		preg_match_all($pattern, $html, $matches);
		if (!empty($matches[1])) {
			$urls = $matches[1];
		}
	}

    return $urls;
}