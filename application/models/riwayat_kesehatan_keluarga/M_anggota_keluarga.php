<?php 

/**
* 
*/
class M_anggota_keluarga extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_anggota_keluarga = array())
  {
    $nilai = array();
    $sql = 'INSERT INTO kk_anggota_keluarga (id_kk, no_bpjs, domisili_serumah, hubungan_keluarga) VALUES (?,?,?,?)';
    foreach ($data_anggota_keluarga as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function ubah_anggota_keluarga($key = array(), $data_anggota_keluarga_baru = array())
  {
    $this->db->where($key);
    $result = $this->db->update('kk_anggota_keluarga', $data_anggota_keluarga_baru);
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error', 
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array('status' => 'success');
    }
    return $ret_val;
  }

  public function hapus_anggota_keluarga($data_anggota_keluarga = array())
  {
    $result = $this->db->delete('kk_anggota_keluarga', $data_anggota_keluarga);
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error', 
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array('status' => 'success');
    }
    return $ret_val;
  }
}