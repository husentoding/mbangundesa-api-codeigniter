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
class EditProfile extends REST_Controller {

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
        $user_name = $this->input->post('username');
        if(!$user_name){
          $data = array(
            'error' => TRUE,
            'msg' => 'Masukkan parameter yg dibutuhkan',
          );
          $this->response($data, 404);
        }
        $data = array(
          'nama' => $this->input->post('nama'),
          'alamat' => $this->input->post('asal'),
          'email' => $this->input->post('email'),
          'kontak' => $this->input->post('hp'),
          'no_ktp' => $this->input->post('noktp'),
          'atas_nama_bank' => $this->input->post('nama_bank'),
          'no_rekening' => $this->input->post('rekening'),
          'bank' => $this->input->post('nama_rekening'),
          #email_alternatif
          #no hp_alternatif
        );
        $status = $this->User_model->editProfile($data, $user_name);
        if($status){
          $data = array(
            'error' => $status,
            'msg' => 'Edit Profile Sukses'
          );
          $this->response($data, 200);
        }else{
          $data= array(
            'error' => TRUE,
            'msg' => 'Edit Profile gagal'
          );
          $this->response($data, 403);
        }
      }

    }
}
