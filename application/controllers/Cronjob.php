<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'system/PHPMailer.php';
class Cronjob extends CI_Controller {
	public $token = '';
	
	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'home';
		$this->mHeader['title'] = 'Home';
		$this->mContent['msg'] = "";
	}
	
	public $keywords = array(
		'construction'=>1,
		'building'=>1,
		'establishment'=>1,
		'distribution'=>2,
		'delivery'=>2,
		'energy'=>3,
		'power'=>3,
		'shopping'=>4,
		'commercial'=>4,
		'commodities'=>4,
		'consulting'=>4,
		'banking'=>4,
		'accountant'=>4,
		'accounting'=>4,
		'financial'=>4,
		'medical care'=>5,
		'health'=>5,
		'health care'=>5,
		'health services'=>5,
		'healthcare services'=>5,
		'industrial'=>6,
		'industrialized'=>6,
		'factory-related'=>6,
		'information technology'=>7,
		'software'=>7,
		'computer'=>7,
		'networking'=>7,
		'manufacturing'=>8,
		'materials'=>9,
		'resources'=>9,
		'ingredients'=>9,
		'real estate'=>10,
		'property'=>10,
		'properties'=>10,
		'realty'=>10,
		'land'=>10,
		'estate'=>10,
		'housing'=>10,
		'service'=>11,
		'career'=>11,
		'repair'=>11,
		'travel'=>11,
		'rentals'=>11,
		'business'=>11,
		'insurance'=>11,
		'entertainment'=>11,
		'marketing'=>11,
		'advertising'=>11,
		'management'=>11,
		'telecommunicate '=>12,
		'transmit '=>12,		
		'network '=>12,
		'transmit '=>12,
		'utilities '=>13,
		'security '=>17,
		'safety '=>17,
		'protection '=>17,
		'guarding '=>17,
	);
	public $other_id = 18;
	
	public function test(){
		/*$url = 'https://www.ibm.com/demos/live/natural-language-understanding/api/nlu';		 
		$payload = json_encode(array(
			'is_custom' => false,
			'sentiment_targets' => [],
			'text' => '[005-540-00]	LUMBER, SIDING, AND RELATED PRODUCTS
			[022-909-76]	Site Work
			[022-912-23]	Construction, General: Backfill Services, Digging, Ditching, Road Grading, Rock Stabilization, etc.
			[022-913-13]	Construction, Bridge and Drawbridge, Including Reconstruction and Rehabilitation
			[022-913-27]	Construction, Highway and Road
			[022-913-50]	Construction, Streets, Major and Residential, Including Reconstruction
			[022-914-84]	Trade Services, Construction, (Not Otherwise Classified)' 
		   )
		);
		
		$data = $this->post($url,$payload);
		echo '<pre>';print_r($data->default->keywords[0]->text);
		die();*/
		//$this->autosignCompanyType();
		
	}
	
	public function once_a_day(){
		//send 5 postbids
		$this->sendPostbidEmail();
	}

	private function get_token($site="demandstar"){
		/*$token = '';
		$row = $this->db->get_where('tbl_config',array('code'=>'TOKEN1'))->row_array();
		if($row){
			$detail = json_decode($row['detail'],true);
			switch($site){
				case 'bidsync':
					$token = $detail['value2'];
					break;
				default:
					$token = $detail['value'];
			}
			
		}*/
			switch($site){
				case 'bidsync':
					$data = $this->get_token_bidsync();
					$token = $data->access_token;
					break;
				default:
					$data = $this->get_token_demandstar();
					$token = $data->token;
			}
		
		return $token;
	}
	
	private function get_token_demandstar(){
		$url = 'https://api.demandstar.com/auth/access/v1/auth/gettoken';		 
		$payload = json_encode(array(
			'Expiration' => 24,
			'IsAnonymous' => false,
			'Password' => 'Hello-1234',
			'UserName' => 'jjsdesigngroup@acninc.net'
		   )
		);
		
		$data = $this->post($url,$payload);
		
		return $data;
	}
	
	private function get_token_bidsync(){
		$url = 'https://suppliergateway.phi-production.cloud/oauth/token';		 
		$payload = json_encode(array( 
			'grantType' => 'password',
			'password' => 'Hello-1234',
			'username' => 'jjsdesigngroup@acninc.net'
		   )
		);
		
		$data = $this->post($url,$payload);
		
		return $data;
	}
	
	public function queue_day(){
		global $log_email;
		$this->db->limit(10);
		$this->db->order_by('id','DESC');
		$data = $this->db->get_where('tbl_email_queue_day',array('status'=>0,'DATE_FORMAT(schedule,\'%Y-%m-%d\') <='=>date("Y-m-d")))->result();
		//print_r($data); die($this->db->last_query());
		foreach ($data as $email){
			try{
				$check = $this->sendMail($email->email, $email->content, $email->subject,$email->attachment,$email->template);

				if($check){
					$this->db->update('tbl_email_queue_day',array('status'=>1,'log'=>$log_email),array('id'=>$email->id));
					//insert log
					if($email->template=='template_sponsor'){
						$log = array(
							'subject'=>$email->subject,
							'content'=>$email->content,
							'email'=>$email->email,
							'template'=>$email->template,
							'attachment'=>$email->attachment,
							'schedule'=>$email->schedule,
							'created'=>date("Y-m-d H:i:s"),
						);
						$this->db->insert('tbl_email_postbid_log',$log);
					}
				}else{
					$this->db->update('tbl_email_queue_day',array('status'=>-1,'log'=>$log_email),array('id'=>$email->id));
				}
			}catch(Exception $e){
				$this->db->update('tbl_email_queue_day',array('status'=>-1,'log'=>$e->getMessage()),array('id'=>$email->id));
			}
		}
		
		echo count($data).' emails';

	}
	
	public function queue_bid_user(){
		
		$this->autoPublish5Bids(); 
		 		
	}
	

	public function queue(){
		$this->db->limit(5);
		$this->db->order_by('id','DESC');
		$data = $this->db->get_where('tbl_email_queue',array('status'=>0))->result();

		foreach ($data as $email){

			$check = $this->sendMail($email->email, $email->content, $email->subject,$email->attachment,$email->template);

			if($check){
				$this->db->update('tbl_email_queue',array('status'=>1),array('id'=>$email->id));
			}else{
				$this->db->update('tbl_email_queue',array('status'=>-1),array('id'=>$email->id));
			}
		}
		//$this->initAICategory();
		$this->autosignCompanyType();
		echo count($data).' emails';

	}

	public function sendMail($toEmail='' , $content = '' , $subject = '',$attach='',$template='')
	{
		return sendMail($subject,$toEmail,$content,$attach,$template);
	}
	
	public function get_document($bidId){
		$url = 'https://api.demandstar.com/contents/content/v1/bids/documents';		 
		$payload = json_encode(array(
			'bidId' => $bidId,
			'otherapis' => true
		   )
		);
		
		$data = $this->crawl($url,$payload);
		
		return $data;
	}
	
	public function get_summary($bidId){
		$url = 'https://api.demandstar.com/contents/content/v1/bids/summary';		 
		$payload = json_encode(array(
			'bidId' => $bidId,
			'otherapis' => true
		   )
		);
		
		$data = $this->crawl($url,$payload);
		
		return $data;
	}
	
	public function get_summary_bidsync($bidId){
		$url = 'https://suppliergateway.phi-production.cloud/api/survivor/v1/getBid/'.$bidId;		 
		$payload = '';		
		$data = $this->crawl_GET($url,$payload,'bidsync');
		
		return $data;
	}
	
	public function get_commodity($bidId){
		$url = 'https://api.demandstar.com/contents/content/v1/common/commodityByType';		 
		$payload = json_encode(array(
			'bidId' => $bidId,
			'type' => 'bid'
		   )
		);
		
		$data = $this->crawl($url,$payload);
		
		return $data;
	}
	public function get_commodity_bidsync($bidId){
		$url = "https://suppliergateway.phi-production.cloud/api/userProfile/v1/".$bidId."/commoditycodes";		 
		$payload = "";
		 
		$data = $this->crawl_GET($url,$payload,'bidsync');
		
		return $data;
	}
	
	public function scrap(){
		$url = 'https://api.demandstar.com/contents/content/v1/bids/search'; 
		$payload = json_encode(array(
			'states' => 6,
			'bidStatus' => null,
			'preserveFilters' => false,
			'showBids' => "",
			'sortBy' => "broadCastDate",
			'sortOrder' => "DESC",
			'commodityExists' => false
		   )
		);
		
		$data = $this->crawl($url,$payload);
		if($data == 'error'){
			$status = 0;
			echo json_encode(array('status'=>$status,'total'=>0,'found'=>0,'data'=>''));
			die();	
		}else{
			$status = 1;
			$total = 0;
			foreach($data->result as $item){
					$key = 'DS-'.$item->bidId;
					if(!$this->checkItem($key)){
						$documents = $this->get_document($item->bidId);
						$summary = $this->get_summary($item->bidId);
						$commodity = $this->get_commodity($item->bidId);
						$total ++;
						//echo '<pre>'; print_r($documents);  print_r($summary); die();
						
						$detail = $summary->result->scopeOfWork;
						$documents_json = json_encode($documents->result);
						$commodity_json = json_encode($commodity->result);
						
						//get company type
						$text= ''; 
						if(!empty($v['commodity'])){							
							foreach($commodity->result as $c){
								$text .='['.$c['formattedCode'].'] '.$c['commodityDescription']."\r\n";
							}
						}						
						if(!$text){
							$text = $item->bidName."\r\n".$detail;
						}
						$company_type = $this->getCategory($text);
						
						
						$data_insert = array(
							"scrap_key"=>$key,
							"title"=>$item->bidName,
							"hash"=>"",
							"details"=>$detail,
							"company"=>$item->agency,
							"company_type"=> $company_type,
							"name"=>$item->agency, 
							"email"=>'',
							"phone"=>'',
							"start_date"=>date("Y-m-d H:i:s",strtotime($item->broadCastDate)),
							"end_date"=>date("Y-m-d H:i:s",strtotime($item->dueDate)),
							"commodity"=>$commodity_json,
							"documents"=>$documents_json,
							"status"=>'not available',
							"type"=>1
						);
					
						$this->db->insert('tbl_contract',
						$data_insert);
					}
			}
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode(array('status'=>$status,'total'=>$total,'found'=>$data->total,'data'=>$data));
			die();	
		}
					
	}
	
	public function scrap_bidsync(){
		$url = 'https://suppliergateway.phi-production.cloud/api/homepage/search/v1/searchSolicitations'; 
		
		$positive = explode(',',$_GET['positive']);
		$positive_array = array_map('trim', $positive);
		$filter_exp = ($GET['filter_exp'])?true:false;
		
		$payload = json_encode(array(
			"userId" =>"9847865f-5515-4897-ae73-53496b5c1343",
			'positive' => $positive_array,
			'negative' => [],
			'region' => ["CA"],
			"offset"=>0,
			'limit' => 150,
			'advancedProfileSearch' =>false,
			'filterOutExpiredBids' => false,
			'sortField' => "_score",
			'sortOrder' => "DESC"
		   )
		);
		
		$data = $this->crawl($url,$payload,'bidsync');
		//echo '<pre>';print_r($data);die('xxx');
		if($data == 'error'){
			$status = 0;
			echo json_encode(array('status'=>$status,'total'=>0,'found'=>0,'data'=>''));
			die();	
		}else{
			$status = 1;
			$total = 0;
			foreach($data->bids as $item){
					$key = 'BS-'.$item->bidId;
					if(!$this->checkItem($key)){
						
						$summary = $this->get_summary_bidsync($item->bidId);
						$commodity = [];//$this->get_commodity_bidsync($summary->detail->agencyId);
						$documents_data = $summary->detail->bidDocuments;
						$documents = array();
						if($documents_data){
							foreach($documents_data as $doc){
								$path = parse_url($doc, PHP_URL_PATH);
								$name = basename($path);
								$documents[] = array(
									'fileName'=>$name,
									'path'=>$doc
								);
							}
						}
						$total ++;
						//echo '<pre>';print_r($documents);print_r($summary); print_r($commodity); die();
						
						//$detail = $summary->result->scopeOfWork;
						//$documents_json = json_encode($documents->result);
						$commodity_json = json_encode(array());
						
						//get company type
						$text= '';  			
						if(!$text){
							$detail = ($summary->detail->longDescription)?$summary->detail->longDescription:$item->bidDescription;
							$text = $item->bidTitle."\r\n".$detail;
						}
						$company_type = $this->getCategory($text);
						
						
						$data_insert = array(
							"scrap_key"=>$key,
							"title"=>$item->bidTitle,
							"hash"=>"",
							"details"=>($summary->detail->longDescription)?$summary->detail->longDescription:$item->bidDescription,
							"company"=>$summary->detail->bidAgency,
							"company_type"=>$company_type,
							"name"=>($summary->detail->contactPerson)?$summary->detail->contactPerson:$summary->detail->bidAgency, 
							"email"=>($summary->detail->contactEmail)?$summary->detail->contactEmail:"",
							"phone"=>($summary->detail->contactPhone)?$summary->detail->contactPhone->number:"",
							"start_date"=>date("Y-m-d H:i:s"),
							"end_date"=>date("Y-m-d H:i:s",strtotime($item->endDate)),
							"commodity"=>$commodity_json,
							"documents"=>'',
							"thumbnail"=>'assets/State.jpg',
							"status"=>'not available',
							"type"=>1
						);
						//echo '<pre>';print_r($summary);print_r($data_insert);die();
						$this->db->insert('tbl_contract',
						$data_insert);
					}
			}
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode(array('status'=>$status,'total'=>$total,'found'=>$data->total,'data'=>$data));
			die();	
		}
					
	}
	
	private function checkItem($key){
		$data = $this->db->get_where('tbl_contract',array('scrap_key'=>$key))->row();
		return ($data)?true:false;
	}
	
	private function post($url,$payload){
		 
		$ch = curl_init($url); 
		
		$header = array( 
			'Accept: application/json',
			'Content-Type: application/json'
			);
		 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, 
			$header
		);
 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($ch); 
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		 
		if($status == 200){			 
			$data = json_decode($result);
		}else{
			$data = 'error'; 
		}
		
		return $data;
	}
	
	private function crawl($url,$payload,$site='demandstar'){
		 
		$ch = curl_init($url); 
		
		$header = array(
			'Authorization:Bearer '.$this->get_token($site), 
			'Accept: application/json, text/plain, */*',
			'Content-Type: application/json'
			);
			
			//print_r($header);die();
		 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, 
			$header
		);
 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($ch); 
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		 
		if($status == 200){ 
			$data = json_decode($result);			
		}else{
			$data = 'error';
			//echo '<pre>';print_r($url);print_r($header);print_r($payload);print_r($result);;die();
		}
		
		return $data;
	}
	
	private function crawl_GET($url,$payload,$site='demandstar'){
		 
		$ch = curl_init($url); 
		
		$header = array(
			'Authorization:Bearer '.$this->get_token($site), 
			'Accept: application/json, text/plain, */*',
			'Content-Type: application/json'
			);
		 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, 
			$header
		);
 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($ch); 
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($status == 200){ 
			$data = json_decode($result);			
		}else{
			$data = 'error';
			//echo '<pre>';print_r($url);print_r($header);print_r($payload);print_r($result);;die();
		}
		
		return $data;
	}
	
	private function limit_text($text, $limit=30) {
		if (str_word_count($text, 0) > $limit) {
			$words = str_word_count($text, 2);
			$pos   = array_keys($words);
			$text  = substr($text, 0, $pos[$limit]) . '...';
		}
		return $text;
	}
	
	private function autosignCompanyType(){
		$this->db->select('*');
		$this->db->where('flag',0);
		$this->db->order_by('id','desc');
		$this->db->limit(10);
		$data = $this->db->get_where('tbl_contract',array())->result_array();
		foreach ($data as $k=>$v){
			if(!empty($v['commodity'])){
				$text= '';
				$commodity = json_decode($v['commodity'],true);
				foreach($commodity as $c){
					$text .='['.$c['formattedCode'].'] '.$c['commodityDescription']."\r\n";
				}
			}else{
				$text = $v['title']."\r\n".$v['details'];
			}
			$url = 'https://www.ibm.com/demos/live/natural-language-understanding/api/nlu';		 
			$payload = json_encode(array(
				'is_custom' => false,
				'sentiment_targets' => [],
				'text' => $text
			   )
			);
			
			$data = $this->post($url,$payload);
			$category = $data->default->categories;
			//print_r($data->default->keywords);echo "<br/>";
			if(!empty($category)){
				/*foreach($category as $cat){
					$exited = $this->db->get_where('tbl_ai_category',array('name',$cat->label))->row_array();
					if(!$exited){
						$this->db->insert('tbl_ai_category',array('name'=>$cat->label,'score'=>$cat->score,'status'=>0,'created_at'=>date("Y-m-d H:i:s")));
					}
				}*/
				$cat = $category[0];
				$company_type = $this->get_company_type_from_keyword($cat);	
				if($company_type == $this->other_id){
					$company_type = $this->get_company_type_from_keyword($data->default->keywords[0]->text);
				}
				
			}else{
				$company_type = $this->get_company_type_from_keyword($data->default->keywords[0]->text);
			}
			
			//update flag
			$this->db->update('tbl_contract',array('flag'=>1,'company_type'=>$company_type),array('id'=>$v['id']));
			//die($this->db->last_query());
		}
		echo 'Done';
		die();
	}
	
	private function getCategory($text=''){
			$company_type = '';
			$url = 'https://www.ibm.com/demos/live/natural-language-understanding/api/nlu';		 
			$payload = json_encode(array(
				'is_custom' => false,
				'sentiment_targets' => [],
				'text' => $text
			   )
			);
			
			$data = $this->post($url,$payload);
			$category = $data->default->categories;			
			if(!empty($category)){
				$cat = $category[0];
				$company_type = $this->get_company_type_from_keyword($cat);	
				if($company_type == $this->other_id){
					$company_type = $this->get_company_type_from_keyword($data->default->keywords[0]->text);
				}
				
				/*$exited = $this->db->get_where('tbl_ai_category',array('name',$cat->label))->row_array();
					if(!$exited){
						$this->db->insert('tbl_ai_category',array('name'=>$cat->label,'score'=>$cat->score,'status'=>0,'created_at'=>date("Y-m-d H:i:s")));
					}else{
						if(!$company_type){
							if($exited['type']){
								$company_type = $exited['type'];
							}
						}
					}*/
				
			}else{
				$company_type = $this->get_company_type_from_keyword($data->default->keywords[0]->text);
			}
			
			
			
			return $company_type;
	}
	
	private function initAICategory(){
		$this->db->select('*');
		$this->db->where('flag',0);
		$this->db->order_by('id','desc');
		$this->db->limit(10);
		$data = $this->db->get_where('tbl_contract',array())->result_array();
		foreach ($data as $k=>$v){
			if(!empty($v['commodity'])){
				$text= '';
				$commodity = json_decode($v['commodity'],true);
				foreach($commodity as $c){
					$text .='['.$c['formattedCode'].'] '.$c['commodityDescription']."\r\n";
				}
			}else{
				$text = $v['title']."\r\n".$v['details'];
			}
			$url = 'https://www.ibm.com/demos/live/natural-language-understanding/api/nlu';		 
			$payload = json_encode(array(
				'is_custom' => false,
				'sentiment_targets' => [],
				'text' => $text
			   )
			);
			
			$data = $this->post($url,$payload);
			$category = $data->default->categories;
			if(!empty($category)){
				$cat = $category[0];
				$exited = $this->db->get_where('tbl_ai_category',array('name',$cat->label))->row_array();
				if(!$exited){
					$this->db->insert('tbl_ai_category',array('name'=>$cat->label,'score'=>$cat->score,'status'=>0,'created_at'=>date("Y-m-d H:i:s")));
				}else{
					if(!$company_type){
						if($exited['type']){
							$company_type = $exited['type'];
						}
					}
				}
			}
			
			//update flag
			$this->db->update('tbl_contract',array('flag'=>1),array('id'=>$v['id']));
			//die($this->db->last_query());
		}
		echo 'Done';
	}
	
	private function get_company_type_from_keyword($string){
		 
		$type = $this->other_id;
		if(empty($string)) return $type;
		$string = strtolower($string);
		foreach($this->keywords as $key=>$id){
			if(strpos($string,'/')!== false){
				$tmp = explode('/',$string);
				$string = end($tmp);
			}
			 
			if(strpos($string,$key)!== false){
				$type = $id;
				break;
			}
		}
		
		return $type;
	}
	
	private function autoPublish5Bids(){
		
		$company_types = $this->db->get('tbl_company_type')->result_array();
		foreach($company_types as $type){
			$this->db->select('*');
			$this->db->where('company_type',$type['id']);
			$this->db->order_by('id','desc');
			$this->db->limit(5);
			$data = $this->db->get_where('tbl_contract',array())->result_array();
			foreach($data as $item){
				$this->db->update('tbl_contract',array('status'=>'available'),array('id'=>$item['id']));
				//die($this->db->last_query());
			}
		}
	}
	
	private function sendPostbidEmail()
	{
		$company_types = $this->db->get('tbl_company_type')->result_array();
		foreach ($company_types as $type) {
			//get user by type
			$this->db->where('company_type', $type['id']);
			$users = $this->db->get_where('tbl_user', array('title' => 'Disabled Vet'))->result_array();
			foreach ($users as $k => $v) {

				$this->db->select('c.*,us.user_id,us.bid_id');
				$this->db->limit(5);
				//$this->db->where('send_flag', 0);
				$this->db->where('company_type', $type['id']);
				$this->db->order_by('rand()');
				$this->db->join('tbl_bids_user_sent as us','us.user_id = '.$v['id'].' AND c.id = us.bid_id','left');
				$data = $this->db->get_where('tbl_contract as c', array('end_date >=' => date("Y-m-d"), 'status' => 'available','us.bid_id'=>null))->result_array();
				$ads_content = '';
				if (!empty($data)) {
					$ads_content = '<table style="width:100%" border=0>';
					foreach ($data as $item) {
						
						if(!$item['thumbnail']) $item['thumbnail'] = 'assets/no_image.jpg'; 
						$this->db->insert('tbl_bids_user_sent',array('user_id'=>$v['id'],'bid_id'=>$item['id'],'created_at'=>date("Y-m-d H:i:s")));

						$link = site_url('/customer/opportunities/detail/' . $item['id']);
						$ads_content .= '<tr><td style="width:35%;margin-bottom:20px;">
				<a href="' . $link . '"><img style="width:90%;margin:10px;border:1px solid #ccc;" src="' . site_url() . $item['thumbnail'] . '"/></a></td>
				<td style="margin-bottom:20px;vertical-align: top;">
				<h2><a style="color:#000;text-decoration:none;" href="' . $link . '">' . $item['title'] . '</a></h2>
				<div>' . $this->limit_text($item['details']) . '</div>
				</td></tr>';
					}
					$ads_content .= '</table>';
				}

				if ($ads_content) {
					$subject = "The Nor-Cal Elite Network - New Opportunity";
					$day = date("Y-m-d");
					$email = $v['email'];
					$email_content = '<div>Hi, ' . $v['name'] . '<br><br>' . $ads_content . '</div>';
					$image_refer = '<img alt="check" width="15" height="15" src="' . site_url('refered?e=' . $email . '&s=' . $subject . '&n=' . $v['name'] . '&t=' . $v['phone_number'] . '&type=' . $v['title'] . '&p=Email&act=postbid') . '"/>';

					if ($email) {

						$this->db->insert('tbl_email_queue_day', array('email' => $email,
							'content' => $email_content . $image_refer,
							'subject' => $subject, 'status' => 0, 'created' => date("Y-m-d H:i:s"),
							'template' => 'template_sponsor',
							'schedule' => $day
						));

					}
				}
			}
			echo count($users) . ' with type=' . $type['title'] . ' emails added on queue<br>';
		}
	}

}
