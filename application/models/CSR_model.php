<?php


class CSR_model extends CI_Model
{
    //userID	name	email	gender	username	password	phone	last_login	address	city	district	province
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getProduct($productID){
      $this->db->where('csrID', $productID);
      $produk = $this->db->get('csr')->row();
      return $produk;
    }

    public function getAllProduct(){
      return $this->db->get('csr')->result_array();
    }

    public function getProductTransaction(){

    }

}
