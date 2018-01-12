<?php


class Invest_model extends CI_Model
{
    //userID	name	email	gender	username	password	phone	last_login	address	city	district	province
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getProduct($productID){
      $this->db->where('investasiID', $productID);
      $produk = $this->db->get('investasi')->row();
      return $produk;
    }

    public function getAllProduct(){
      return $this->db->get('investasi')->result_array();
    }

    public function getProductTransaction(){

    }

}
