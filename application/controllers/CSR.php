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
class CSR extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('CSR_model');
      }

    //get specific Product
    public function index_post(){
      if($this->input->server('REQUEST_METHOD') == 'POST'){
        $productID = $this->post('productID');
        if(!isset($productID)){
          $this->response('Something wrong', 404);
        }else{
          $produk = $this->CSR_model->getProduct($productID);
          $this->response($produk, 200);
        }
      }
    }

    //get All Product
    public function index_get(){
      $this->response($this->CSR_model->getAllProduct(), 200);

    }
}
