<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH."/core/MY_Model.php";

class Membership_model extends MY_Model {

    var $_table = 'tbl_membership';
    var $_table_order = 'tbl_orders';
    var $_tbl_user = 'tbl_user';

    /*
    * Fetch order data from the database
    * @param id returns a single record
    */
    public function getOrder($id){
        $this->db->select('*');
        $this->db->from($this->_table_order.' as r');
        $this->db->join($this->_table.' as p', 'p.id = r.product_id', 'left');
        $this->db->where('r.id', $id);
        $query  = $this->db->get();
        return ($query->num_rows() > 0)?$query->row_array():false;
    }

    /*
     * Insert transaction data in the database
     * @param data array
     */
    public function insertOrder($data){
        $insert = $this->db->insert($this->_table_order,$data);
        return $insert?$this->db->insert_id():false;
    }

    public function getUserByEmail($email){
        $this->db->select('*');
        $this->db->from($this->_tbl_user.' as r');
        $this->db->where('r.email', $email);
        $query  = $this->db->get();
        return ($query->num_rows() > 0)?$query->row_array():false;
    }


}