<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/third_party/PHPExcel.php';

require 'system/PHPMailer.php';

class Bidemailsent extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/bidemail_sent/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'bids_sent_log';
        $this->mHeader['title'] = 'Bid Email Sent Log';
        $this->mContent['msg'] = "";
        $this->load->model(array('Bidemailsent_model'));
        $this->load->model(array('Settings_model'));
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
		$result = $this->db->get_where('tbl_email_postbid_log',array())->result_array();
        $table_data['data'] = $result;

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1; 
        }
        echo json_encode($table_data);
    }

public function export_Logs($page = 1){
		$max = 200;
		$offset = 0;
		$this->db->order_by("id",'DESC');
		$this->db->limit($max);
		$result = $this->db->get_where('tbl_email_postbid_log',array())->result_array();

        foreach ($result as $key => $row) {
            $result[$key]["no"] = $key + 1;
        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        $pCol = 0;
        $pRow = 1;

        $field_name = array('No', 'Subject', 'Email', 'Schedule', 'Sent');

        for ($pCol = 0; $pCol < count($field_name); $pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$field_name[$pCol]);
        }

        $pCol = 0;
        $pRow = 2;

        foreach ($result as $row) {

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['no']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['subject']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['email']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['schedule']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['created']);
            $pCol++; 

            $pCol = 0;
            $pRow++;
        }

        $file_name = "Event Export " . date('Y-m-d H:i:s') . ".xls";
        header('Content-Encoding: utf-8');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: inline;filename='. $file_name.'');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

}
