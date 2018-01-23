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
class Mitra extends REST_Controller {

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
      $action = $this->input->post('action');
      if(!isset($action)){
        $this->response(array('error'=>TRUE,'msg'=>'no action'), 403);
      }
      $url = $this->do_upload($action);
      $data = array(
        'error' => FALSE,
        'msg' => base_url().substr($url,1),
      );
      $this->response($data,200);
    }

    private function do_upload($action){
      if(!isset($_FILES["pic"])){
        $data = array(
          'error' => TRUE,
          'msg' => 'File not found',
        );
        $this->response($data, 404);
      }
      $type = explode('.', $_FILES["pic"]["name"]);
      $type = $type[count($type)-1];
      $url ="./images/".uniqid(rand()).".".$type;
      if(in_array($type, array("jpg", "png", "jpeg", "pdf"))){
        if(is_uploaded_file($_FILES["pic"]["tmp_name"])){
          if(move_uploaded_file($_FILES["pic"]["tmp_name"], $url)){
            $id = 6; // blm diganti
            if($action == 'ktp'){
              $this->Mitra_model->saveKTP($url, $id);
            }else if($action == 'foto_profile'){
              $this->Mitra_model->saveFotoProfile($url, $id);
            }else if($action == 'mitra_selfie'){
              $this->Mitra_model->saveMitraSelfie($url, $id);
            }else if($action == 'mitra_pengangkatan'){
              $this->Mitra_model->saveMitraPengangkatan($url, $id);
            }else if($action == 'pasfoto'){
              $this->Mitra_model->saveMitraPasFoto($url, $id);
            }

            return $url;
          }
        }
      }
      return "";
    }
}
