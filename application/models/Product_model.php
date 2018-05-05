<?php


class Product_model extends CI_Model
{
    //userID	name	email	gender	username	password	phone	last_login	address	city	district	province
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function get_product_by_id($id){
      $this->db->where('id', $id);
      $produk = $this->db->get('produk')->row();
      return $produk;
    }

    public function get_all_product(){
        $this->db->order_by("id","desc");
        $query = $this->db->get('produk');
        return $query->result();
    }
    
    public function get_product_with_limit($offset){
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->limit(5, $offset);
        $this->db->order_by("id","desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getProductTransaction(){

    }

}
