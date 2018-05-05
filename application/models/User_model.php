<?php

class User_model extends CI_Model
{
    //userID	name	email	gender	username	password	phone	last_login	address	city	district	province
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function editProfile($data, $username){
      $id = $this->getUserID($username);
      $id = $id->userID;
      $this->db->where('userID', $id);
      $result = $this->db->get('info_user')->row();
      if($result){
        $this->db->where('userID', $id);
        $this->db->update('info_user', $data);
        return true;
      }else{
        return false;
      }
      // $cek = $this->db->update('info_user', $data);
      // if($cek){
      //   return $cek;
      // }else{
      //   return false;
      // }
    }


    public function login($username, $password){
      // $data = array(
      //   'username' => $username,
      //   'password' => $password,
      // );
      // $this->db->where($data);
      $this->db->where('username',$username);
      $akun = $this->db->get('user')->row();
      if($akun){
          if($akun->password == $password){
            $data = array(
              'error' => FALSE,
              'msg' => $akun,
            );
              return $data;
          }else{
            $data = array(
              'error' => TRUE,
              'msg' => 'Wrong credentials',
            );
            return $data;
          }
      }
      else{
        $data = array(
          'error' => TRUE,
          'msg' => 'Wrong Credentials',
        );
        return $data;
      }
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

    public function getUserID($username){
      $this->db->where('username', $username);
      return $this->db->get('user')->row();
    }

    public function fillUserInfo($username, $data){
      $this->db->where('userID', $data['userID']);
      $info_user = $this->db->get('info_user')->row();
      if(isset($info_user)){
        $this->db->where('userID', $userID);
        $this->db->update('info_user', $data);
      }else{
        $this->db->insert('info_user', $data);
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
