<?php


class Laporan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function getImageID($url){
      $data = array(
          'image_link' => $url,
        );

      $this->db->insert('laporan_image', $data);

      $this->db->where('image_link', $url);
      $id_image = $this->db->get('laporan_image')->row()->laporanimageID;
      return $id_image;
    }

    //KTP di table info_user
    public function saveLaporan($data){

        $this->db->insert('laporan', $data);
      
    }

}
