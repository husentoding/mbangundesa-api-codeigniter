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
class Saldo extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Laporan_model');
      }

// tambah saldo
    public function index_post(){
      if(!isset($_POST['aksi'])){
        $this->responseError('Insufficient Parameter');
        return;
      }
      $aksi = $this->input->post('aksi');

      if($aksi == "data"){
        if(!isset($_POST['userid']) || !isset($_POST['jumlah'])){
          $this->responseError('Insufficient Data');
        }
        $data = array(
            'jumlah' => $this->input->post('jumlah'),
            'userID' => $this->input->post('userid'),
            'bukti_pembayaran_url' => '',
          );
        $this->db->insert('tambah_saldo', $data);
        $msg = array('id_insert' => $this->db->insert_id());
        $output = array('error' => FALSE, 'msg' => $msg);
        $this->response($output, 200);
      }
      else if($aksi == "bukti"){
        if(!isset($_FILES["pic"])){
          $this->responseError("File not Found");
        }
        if(!isset($_POST['idsaldo'])){
          $this->responseError("Insufficient Parameter");
        }

        $idsaldo = $this->input->post('idsaldo');

        $type = explode('.', $_FILES["pic"]["name"]);
        $type = $type[count($type)-1];
        $dir = "./images/bukti_pembayaran/";
        if(!file_exists($dir)){
          mkdir($dir, 0777, true);
        } 
        $url ="./images/bukti_pembayaran/".uniqid(rand()).".".$type;
        $url_final = $this->do_upload($url, $type);
        
        $data = array(
            'bukti_pembayaran_url' => $url_final
          );

        $this->db->where('tambahsaldoID', $idsaldo);
        $success = $this->db->update('tambah_saldo', $data);

        if(!$success){
          $this->responseError("Upload Image Failed");
          return;
        }

        $data = array(
          'error' => FALSE,
          'msg' => base_url().substr($url_final,1),
        );
        $this->response($data,200);
      }
    }

    private function responseError($msg){
      $data = array('error' => TRUE, 'msg' => $msg);
      $this->response($data, 404);
    }

    private function do_upload($url, $type){

      if(in_array($type, array("jpg", "png", "jpeg", "pdf"))){
        if(is_uploaded_file($_FILES["pic"]["tmp_name"])){
          if(move_uploaded_file($_FILES["pic"]["tmp_name"], $url)){
            return $url;
          }
        }
      }
      return "";
    }

}
