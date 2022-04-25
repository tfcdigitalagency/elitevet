<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH."/core/MY_Model.php";

class Event_model extends MY_Model {
    var $_table = 'tbl_event';

     public function get_Event($page = null){
        
        $this->db->select("a.*");

        $this->db->order_by('a.created_at', "DESC");

        if (!empty($page))
            $this->db->limit(8, ($page - 1) * 8);

        $query = $this->db->get($this->_table." a");
        $query = $query->result_array();

        return $query;
        
    }
}