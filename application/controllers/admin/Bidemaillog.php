<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/third_party/PHPExcel.php';

require 'system/PHPMailer.php';

class Bidemaillog extends MY_Controller {
    public $mLayout = 'admin/';
    public $sub_mLayout = 'admin/bidemail_log/';

    function __construct() {
        parent::__construct();
        $this->mHeader['id'] = 'bids_open_log';
        $this->mHeader['title'] = 'Bid Email Log';
        $this->mContent['msg'] = "";
        $this->load->model(array('Bidemaillog_model'));
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
		$result = $this->db->get_where('tbl_bid_posting_emails',array())->result_array();
        $table_data['data'] = $result;

        foreach ($table_data['data'] as $key => $row) {
            $table_data['data'][$key]["no"] = $key + 1;
            $table_data['data'][$key]["email_open"] = ($row["email_open"])?"Yes":"No";

        }
        echo json_encode($table_data);
    }

public function export_Logs($page = 1){
		$max = 200;
		$offset = 0;
		$this->db->order_by("id",'DESC');
		$this->db->limit($max);
		$result = $this->db->get_where('tbl_bid_posting_emails',array())->result_array();

        foreach ($result as $key => $row) {
            $result[$key]["no"] = $key + 1;
        }

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();

        $pCol = 0;
        $pRow = 1;

        $field_name = array('No', 'Page Name', 'IP', 'Total Time', 'Date', 'Name', 'Phone','Title'
        , 'Email', 'To Email', 'Email Subject', 'Counter', 'Email Open', 'Special Activity');

        for ($pCol = 0; $pCol < count($field_name); $pCol++){
            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$field_name[$pCol]);
        }

        $pCol = 0;
        $pRow = 2;

        foreach ($result as $row) {

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['no']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['page_name']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['ip_address']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['total_time_sec']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['date']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['name']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['phone']);
            $pCol++;

			$sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['type']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['email']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['to_email']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['email_subject']);
            $pCol++;

            $sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['counter']);
            $pCol++;

			$sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['email_open']);
            $pCol++;

			$sheet->setCellValueByColumnAndRow($pCol, $pRow,$row['special_activity']);
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
