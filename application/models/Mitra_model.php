<?php


class Mitra_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    //KTP di table info_user
    public function saveKTP($url, $userID){
      $this->db->where('userID', $userID);
      $cek = $this->db->get('info_user')->row();
      if(isset($cek)){
        $this->db->where('userID', $userID);
        $data = array(
          'userID' => $userID,
          'foto_ktp' => $url,
        );
        $this->db->update('info_user', $data);
      }else{
        $this->db->where('userID', $userID);
        $data = array(
          'userID' => $userID,
          'foto_ktp' => $url,
        );
        $this->db->insert('info_user', $data);
      }
    }

    public function saveFotoProfile($url, $userID){
      $this->db->where('userID', $userID);
      $cek = $this->db->get('info_user')->row();
      if(isset($cek)){
        $this->db->where('userID', $userID);
        $data = array(
          'userID' => $userID,
          'foto_profil' => $url,
        );
        $this->db->update('info_user', $data);
      }else{
        $this->db->where('userID', $userID);
        $data = array(
          'userID' => $userID,
          'foto_profil' => $url,
        );
        $this->db->insert('info_user', $data);
      }
    }

    public function saveMitraSelfie($url, $userID){
      $this->db->where('userID', $userID);
      $cek = $this->db->get('mitra_desa')->row();
      if(isset($cek)){
        $this->db->where('userID', $userID);
        $data = array(
          'userID' => $userID,
          'selfieKTP' => $url,
        );
        $this->db->update('mitra_desa', $data);
      }else{
        $this->db->where('userID', $userID);
        $data = array(
          'userID' => $userID,
          'selfieKTP' => $url,
        );
        $this->db->insert('mitra_desa', $data);
      }
    }

    public function saveMitraPengangkatan($url, $userID){
      $this->db->where('userID', $userID);
      $cek = $this->db->get('mitra_desa')->row();
      if(isset($cek)){
        $this->db->where('userID', $userID);
        $data = array(
          'userID' => $userID,
          'surat_pengangkatan' => $url,
        );
        $this->db->update('mitra_desa', $data);
      }else{
        $this->db->where('userID', $userID);
        $data = array(
          'userID' => $userID,
          'surat_pengangkatan' => $url,
        );
        $this->db->insert('mitra_desa', $data);
      }
    }

    public function saveMitraPasFoto($url, $userID){
      $this->db->where('userID', $userID);
      $cek = $this->db->get('mitra_desa')->row();
      if(isset($cek)){
        $this->db->where('userID', $userID);
        $data = array(
          'userID' => $userID,
          'pasfoto' => $url,
        );
        $this->db->update('mitra_desa', $data);
      }else{
        $this->db->where('userID', $userID);
        $data = array(
          'userID' => $userID,
          'pasfoto' => $url,
        );
        $this->db->insert('mitra_desa', $data);
      }
    }

    public function saveDataMitra($userID, $data){
      $this->db->where('userID', $userID);
      $cek2 = $this->db->get('mitra_desa')->row();
      if(isset($cek2)){
        return FALSE;
      }

      $this->db->where('userID', $userID);
      $cek = $this->db->get('mitra_desa')->row();
      if(isset($cek)){
        $this->db->where('userID', $userID);
        $data = array(
            'userID' => $data['userID'],
            'nama_kepala' => $data['nama_kepala'],
            'kontak' => $data['kontak'],
            'nik_kepala' => $data['nik_kepala'],
            'program' => $data['program'],
            'saldo' => 0,
        );
        $this->db->update('mitra_desa', $data);
      }else{
        $this->db->where('userID', $userID);
        $data = array(
            'userID' => $data['userID'],
            'nama_kepala' => $data['nama_kepala'],
            'kontak' => $data['kontak'],
            'nik_kepala' => $data['nik_kepala'],
            'program' => $data['program'],
            'saldo' => 0,
        );
        $this->db->insert('mitra_desa', $data);
      }
      return TRUE;

    }

}
