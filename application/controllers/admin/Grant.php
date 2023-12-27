<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grant extends MY_Controller {
	public $mLayout = 'admin/';
	public $sub_mLayout = 'admin/grant/';

	function __construct() {
		parent::__construct();
		$this->mHeader['id'] = 'grant';
		$this->mHeader['title'] = 'Online grant application';
		$this->mContent['msg'] = "";
		$this->load->model(['grant_model']);
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
		$data = $this->db->get_where('tbl_online_grant',array())->result_array();

		foreach ($data as $k=>$v){

			$data[$k]['form'] = '<a href="'.$v['form'].'" target="_blank">'.$v['form'].'</a>' ;			 
			 
		}

		$table_data['data'] = $data;

		echo json_encode($table_data);
	}
	
	public function import(){
		$this->mHeader['sub_id'] = 'import';
		$this->render("{$this->sub_mLayout}import", $this->mLayout);
	}
	
	public function doimport(){
		$config['upload_path']   = './assets/uploads/import'; 
        $config['allowed_types'] = 'csv';  

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('csv_file')) { 
            $error = $this->upload->display_errors();
            echo $error;
        } else { 
            $data = $this->upload->data();

            $file_path = $data['full_path'];

            // Load the CSV helper
            $this->load->helper('csv');
 
            $csv_data = csv_to_array($file_path, ',');
			//echo '<pre>';print_r($csv_data);die('xxx');
             $imported = 0;
			 $dupliated = 0;
			 $total = 0;
            foreach ($csv_data as $row) { 
				$total++;
				$exit = $this->db->get_where('tbl_online_grant',array('form'=>$row[1]))->row_array();
				if(!$exit && $row[1]){
					$data = array(
						'company' => $row[0],
						'form' => $row[1],
						'created_at'=>date("Y-m-d H:i:s")
					);
					// Insert database 
					$this->db->insert('tbl_online_grant', $data);
					$imported++;
				}else{
					$dupliated++;
				}
            }

            // Delete CSV file
            unlink($file_path);

            
        }
		$this->session->set_flashdata('message','Imported ' . $imported . ' rows successfully. Skipped importing ' . $dupliated . ' duplicate rows.');
		redirect('admin/grant/import');
	}
	
	 public function delete(){
        $id = $this->input->post('id');
        $this->grant_model->setTable('tbl_online_grant');
        $result['msg'] = $this->grant_model->delete(array("id"=>$id));
    }

 
}
