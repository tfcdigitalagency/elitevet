<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH."/core/MY_Model.php";

class Attend_history_model extends MY_Model {
    var $_table = 'tbl_attend_webinar';

    public function get_att_History($where){
        $this->db->select("a.*, b.name as user_name, c.name as event_name");
        $this->db->join("tbl_user b", "a.user_id = b.id", "LEFT");
        $this->db->join("tbl_event c", "a.event_id = c.id", "LEFT");

        if($where!=NULL) {
            foreach($where as $name=>$value) {
                if($name=="start" || $name=="limit" || $name=="search")
                    continue;
                if (is_array($value)) {
                    $this->db->where_in('a.' . $name, $value);
                } else {
                    $this->db->where('a.' . $name, $value);
                }
            }
        }

        $this->db->order_by('a.attended_at', "DESC");
        
        $query = $this->db->get($this->_table." a");
        $query = $query->result_array();

        return $query;
    }

}