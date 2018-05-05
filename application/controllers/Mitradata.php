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
class Mitradata extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Mitra_model');
      }

    public function index_post(){
      // echo 'tes';
      $id = $this->input->post('id');
      $nama = $this->input->post('nama_kepala');
      $kontak = $this->input->post('kontak');
      $nik = $this->input->post('nik');
      $program = $this->input->post('program');

      if(!$id || !$nama || !$kontak || !$nik || !$program){
        $data= array(
          'error' => TRUE,
          'msg' => 'Input parameter incomplete'
        );
        $this->response($data, 404);
      }
      $data = array(
          'userID' => $id,
          'nama_kepala' => $nama,
          'kontak' => $kontak,
          'nik_kepala' => $nik,
          'program' => $program,
      );
      $cek = $this->Mitra_model->saveDataMitra($id, $data);
      if(!$cek){
        $data = array(
          'error' => TRUE,
          'msg' => 'Desa udah ada',
        );
        $this->response($data, 404);
      }else{
        $data = array(
          'error' => FALSE,
          'msg' => 'Pendaftaran Berhasil',
        );
        $this->response($data, 200);
      }
    }

}
