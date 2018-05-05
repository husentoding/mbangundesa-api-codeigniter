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
        $data = array(
            'id_village' => $this->post('id_village'),
            'name' => $this->post('name'),
            'goal' => $this->post('goal'),
            'expire_date' => $this->post('expire_date'),
            'description' => $this->post('description')
        );
        $insert = $this->db->insert('csr', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //get All Product
    public function index_get(){
        if(isset($_GET['id'])){
            $this->response($this->CSR_model->get_csr_by_id($_GET['id']));  
        }
        $this->response($this->CSR_model->get_all_csr(), 200);
    }
}
