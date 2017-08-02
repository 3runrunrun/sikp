<?php 

/**
* 
*/
class M_data_perkawinan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_perkawinan = array())
  {
    $nilai = array();
    $sql = 'INSERT INTO kk_data_perkawinan (id_data_perkawinan, id_kk, no_bpjs, perkawinan_ke, umur_pasangan, status_kawin) VALUES (?,?,?,?,?,?)';
    foreach ($data_perkawinan as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function ubah_data_perkawinan($id_data_perkawinan, $data_perkawinan_baru = array())
  {
    $this->db->where('id_data_perkawinan', $id_data_perkawinan);
    $result = $this->db->update('pas_data_perkawinan', $data_perkawinan_baru);
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

  public function hapus_data_perkawinan($data_perkawinan = array())
  {
    $result = $this->db->delete('pas_data_perkawinan', $data_perkawinan);
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