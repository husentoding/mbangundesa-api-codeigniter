<?php

class User_model extends CI_Model
{
    //userID	name	email	gender	username	password	phone	last_login	address	city	district	province
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function login($username, $password){
      $data = array(
        'username' => $username,
        'password' => $password,
      );
      $this->db->where($data);
      $akun = $this->db->get('user')->result_array();
      return $akun;
    }

    public function register($username, $password, $email){
      $this->db->where('username', $username);
      $statusUsername = $this->db->get('user')->result_array();

      $this->db->where('email', $email);
      $statusEmail = $this->db->get('user')->result_array();
      if($statusUsername){
        return false;
      }else{
        if ($statusEmail){
          return false;
        }
        $data = array(
          'username' => $username,
          'password' => $password,
          'email' => $email,
        );
        $this->db->insert('user', $data);
        return true;
      }
    }

    public function getProfile($username){
      $this->db->where('username', $username);
      $account = $this->db->get('user')->row();
      if ($account){
        $this->db->where('userID', $account->userID );
        $info_user = $this->db->get('info_user')->row();
        if($info_user){
            return $info_user;
        }else{
          return false;
        }

      }else{
        return false;
      }
    }

}
