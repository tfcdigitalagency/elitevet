<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/third_party/PHPExcel.php';


class Questionnair extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/questionnair/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'questionnair';
        $this->mHeader['title'] = 'Questionnair Log';
        $this->mContent['msg'] = "";
    }

    public function view(){
        $this->mHeader['sub_id'] = 'view';
        $this->render("{$this->sub_mLayout}index", $this->mLayout);
    }

	 public function get_Logs($page = 1){

		$max = 2000;
		$offset = 0;
		$this->db->order_by("id",'DESC');
		$this->db->limit($max);
		$this->db->select('qa.*,u.name');
		$this->db->join('tbl_user u','u.email= qa.email','left');
		$result = $this->db->get_where('ads_questions_answer qa',array())->result_array();
        $table_data['data'] = $result;

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
            $table_data['data'][$key]["answer_html"] = $this->buildAnser($row);

        }
        echo json_encode($table_data);
    } 
	
	private function buildAnser($row){
		$html = '<ol>';
		$aryAnswer = json_decode($row['answer'],true);
		//echo '<pre>';print_r($aryAnswer);die('xxx');
		foreach($aryAnswer as $q=>$v){
			$html .= '<li><div><strong>'.$v['question'].'</strong></div><div style="color:#999"><i class="fa fa-comment"></i>'.$v['answer'].'</div></li>';
		}
		$html .= '</ol>';
		return $html;
	}
 

}
