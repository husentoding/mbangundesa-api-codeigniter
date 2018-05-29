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
class Laporan extends REST_Controller {

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

    public function index_post(){
      // echo 'tes';
      if(!isset($_POST['aksi'])){
        $this->responseError("Insufficient Parameter");
        return;
      }

      $aksi = $this->input->post('aksi');

      if ($aksi == "data"){
        $judul = $this->input->post('judul');
        $konten = $this->input->post('konten');
        $mitra_id = $this->input->post('mitra_id');
        $desa_id = $this->input->post('desa_id');
        if(!isset($judul)){
          $this->response(array('error'=>TRUE,'msg'=>'Insufficient Parameter'), 403);
        }
        $action = array(
              'mitraID' => $mitra_id,
              'desaID' => $desa_id,
              // 'laporanimageID' => $this->Laporan_model->getImageID($url),
              'judul' => $judul,
              'konten_laporan' => $konten,
        );
        $id = $this->Laporan_model->saveLaporan($action);
        $this->response($data = array('error' => FALSE, 'msg' => $id), 200);

      }else if($aksi == "gambar"){
        if(!isset($_FILES["pic"])){
          $data = array(
            'error' => TRUE,
            'msg' => 'File not found',
          );
          $this->response($data, 404);
        }
        if(!isset($_POST['mitra_id']) || !isset($_POST['laporan_id'])){
          $this->responseError("Insufficient Parameter");
        }
        $id = $this->input->post('laporan_id');
        $mitra_id = $this->input->post('mitra_id');
        $type = explode('.', $_FILES["pic"]["name"]);
        $type = $type[count($type)-1];
        $dir = "./images/laporan/".$mitra_id;
        if(!file_exists($dir)){
          mkdir($dir, 0777, true);
        } 
        $url ="./images/laporan/".$mitra_id."/".uniqid(rand()).".".$type;
        

        $url_final = $this->do_upload($url, $type);
        
        $this->Laporan_model->insertImageLink($id, $url_final);
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
