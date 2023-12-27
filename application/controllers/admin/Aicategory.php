<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aicategory extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/category_type/';
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

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'category_type';
		$this->mHeader['title'] = 'AI Category';
		$this->mContent['msg'] = "";
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
		$data = $this->db->get_where('tbl_ai_category',array())->result_array();

		foreach ($data as $k=>$v){

			$data[$k]['title'] = $v['title'] ;			 
			 		 
			if($v['type']) {
				$data[$k]['type'] =  get_compay_type($data[$k]['type']);
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
		
		$article_id = $this->input->post('article_id');
		if($article_id){
			$name = $this->input->post('name');
			$score = $this->input->post('score');
			$type = $this->input->post('type'); 
			$status = ($type)?1:0;
			$data = array(
				'name' => $name, 
				'score' => $score,
				'type' => $type,
				'status' => $status,
			);			
				
			$this->db->update('tbl_ai_category', $data, array('id' => $article_id)); 
			 

		}else { 
			$name = $this->input->post('name');
			$score = $this->input->post('score');
			$type = $this->input->post('type'); 
			$data = array(
				'name' => $name, 
				'score' => $score,
				'type' => $type,
				'created' => date("Y-m-d H:i:s")
			);			 
			$this->db->insert('tbl_ai_category', $data);			 
			$new_article_id = $this->db->insert_id(); 
		} 
		  

		echo json_encode($data);

	} 

	public function edit(){

		$this->mHeader['sub_id'] = 'view';
		$id = $this->input->get('id');
		$this->mContent['data'] = $this->db->get_where('tbl_ai_category',array('id'=>$id))->row_array();
		
		$company_type = $this->db->get_where('tbl_company_type',array())->result_array();
		$this->mContent['company_type'] = $company_type;
		
		$this->render("{$this->sub_mLayout}edit", $this->mLayout);
	}


	public function delete(){
		$id = $this->input->post('id');
		$this->db->delete('tbl_ai_category',array('id'=>$id));
	}
	
	public function getCategory(){
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
	
	public function autosign(){
		$this->db->select('*');
		$this->db->where('status',0);
		$this->db->order_by('id','desc');
		$this->db->limit(130);
		$data = $this->db->get_where('tbl_ai_category',array())->result_array();
		foreach($data as $cate){
			$type = $this->get_company_type_from_keyword($cate['name']);
			$this->db->update('tbl_ai_category',array('status'=>1,'type'=>$type),array('id'=>$cate['id']));
		}
		echo "Done";
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
	
	private function get_company_type_from_keyword($string){
		$string = strtolower($string);
		$type = $this->other_id;
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

}
