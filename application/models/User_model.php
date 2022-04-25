<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH."/core/MY_Model.php";

class User_model extends MY_Model {
    var $_table = 'tbl_user';

    public function login($email, $password) {
        $this->db->where('a.password', md5($password));
        $this->db->where('a.email', $email);
        $query = $this->db->get($this->_table." a");
        $query = $query->row_array();
        if (!empty($query)) {
            return $query;
        } else {
            return false;
        }
    }

    public function get_User(){
        $this->db->select("a.*, b.name as membership");
        $this->db->join("tbl_membership b", "a.membership_id = b.id", "LEFT");
        //$this->db->where('a.is_checked', 1);
        $this->db->order_by('a.created_at', "DESC");
       
        $query = $this->db->get($this->_table." a");
        $query = $query->result_array();

        return $query;
    }

    public function get_Mailchimp_User(){
        $this->db->select("a.*, b.name as membership");
        $this->db->join("tbl_membership b", "a.membership_id = b.id", "LEFT");
        $this->db->where('a.is_checked', 1);
        $this->db->order_by('a.created_at', "DESC");

        $query = $this->db->get($this->_table." a");
        $query = $query->result_array();

        return $query;
    }

    public function get_Contact($sel_id = null){
        $this->db->select("a.*");

        if (!empty($sel_id) && ($sel_id != -1))
            $this->db->where('a.owner_id', $sel_id);

        $this->db->order_by('a.created_at', "DESC");
       
        $query = $this->db->get($this->_table." a");
        $query = $query->result_array();

        return $query;
    }
	
	public function getUserLink($hash){
		$row = $this->db->get_where('tbl_broadcasting_share',array('hash'=>$hash))->row();
		return $row;
	}

}