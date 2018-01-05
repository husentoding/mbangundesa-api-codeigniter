<?php


class Product_model extends CI_Model
{
    //userID	name	email	gender	username	password	phone	last_login	address	city	district	province
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getProduct($productID){
      $this->db->where('produkID', $productID);
      $produk = $this->db->get('produk')->row();
      return $produk;
    }

    public function getAllProduct(){
      return $this->db->get('produk')->result_array();
    }

    public function getProductTransaction(){

    }

}
