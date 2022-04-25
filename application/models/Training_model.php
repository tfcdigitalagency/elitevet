<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH."/core/MY_Model.php";

class Training_model extends MY_Model {
    var $_table = 'tbl_training';

    public function get_Training(){
        $this->db->select("a.*, b.type as training_type");
        $this->db->join("tbl_training_type b", "a.training_type = b.id", "LEFT");

        $this->db->order_by('a.uploaded_at', "DESC");
        
        $query = $this->db->get($this->_table." a");
        $query = $query->result_array();

        return $query;
    }
}