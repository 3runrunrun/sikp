<?php 

/**
* 
*/
class M_tenaga_medis extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data()
  {
    $result = $this->db->get('poli_tenaga_medis');
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data' => $result->result_array()
        );
    }
    return $ret_val;
  }

  public function tambah_tenaga_medis($data_tenaga_medis = array())
  {
    $result = $this->db->insert('poli_tenaga_medis', $data_tenaga_medis);
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

  public function ubah_tenaga_medis($key = array(), $data_tenaga_medis_baru = array())
  {
    $this->db->where($key);
    $result = $this->db->update('poli_tenaga_medis', $data_tenaga_medis_baru);
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

  public function hapus_tenaga_medis($data_tenaga_medis = array())
  {
    $this->db->where($data_tenaga_medis);
    $this->db->set('hapus', '1');
    $result = $this->db->update('poli_tenaga_medis');
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