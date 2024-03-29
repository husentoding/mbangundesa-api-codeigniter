<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Register extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('User_model');
      }

    public function index_post(){
      if($this->input->server('REQUEST_METHOD') == 'POST'){
          $email = $this->post('email');
          $username = $this->post('username');
          $password = $this->post('password');

          if($email != NULL && $username != NULL && $password != NULL){

            $status = $this->User_model->register($username, $password, $email);
            if($status){
              $id = $this->User_model->getUserID($username);
              $data = array(
                'userID' => $id->userID,
                'nama' => 'Silahkan edit data',
                'kontak' => ' ',
                'email' => ' ',
                'alamat' => 'Silahkan edit data',
                'no_ktp' => ' ',
                'foto_ktp' => ' ',
                'saldo' => '0',
                'bank' => ' ',
                'atas_nama_bank' => ' ',
                'foto_profil' => 'https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/user-male-circle-blue-512.png',
                'no_rekening' => ' ',
              );
              $this->User_model->fillUserInfo($id, $data);
              $data= array(
                  'error' => FALSE,
                  'error_msg' => 'Registered',
                  );
              $this->response($data, 200);
            }else{
                $data= array(
                    'error' => TRUE,
                    'error_msg' => 'Failed',
                    );
              $this->response($data, 404);
            }

          }else{
            $this->response('salah', 403);
          }

      }
    }
}
