<?php


class CSR_model extends CI_Model
{
    //userID	name	email	gender	username	password	phone	last_login	address	city	district	province
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_csr_by_id($id){
      $this->db->where('id', $id);
      $csr = $this->db->get('csr')->row();
      return $csr;
    }

    public function get_all_csr(){
      return $this->db->get('csr')->result_array();
    }
    
    public function get_csr_with_limit($offset){
        $this->db->select('*');
        $this->db->from('csr');
        $this->db->limit(5, $offset);
        $this->db->order_by("id","desc");
        $query = $this->db->get();
        return $query->result();
    }

}
