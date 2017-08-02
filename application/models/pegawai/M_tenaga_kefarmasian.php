<?php 

/**
* 
*/
class M_tenaga_kefarmasian extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function tampil_tenaga_kefarmasian($sort_by = NULL, $order = NULL)
  {
    $this->db->order_by($sort_by, $order);
    $result = $this->db->get('poli_tenaga_kefarmasian');
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

  public function tambah_tenaga_kefarmasian($data_tenaga_kefarmasian = array())
  {
    $result = $this->db->insert('poli_tenaga_kefarmasian', $data_tenaga_kefarmasian);
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

  public function ubah_tenaga_kefarmasian($key = array(), $data_tenaga_kefarmasian_baru = array())
  {
    $this->db->where($key);
    $result = $this->db->update('poli_tenaga_kefarmasian', $data_tenaga_kefarmasian_baru);
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

  public function hapus_tenaga_kefarmasian($data_tenaga_kefarmasian = array())
  {
    $this->db->where($data_tenaga_kefarmasian);
    $this->db->set('hapus', '1');
    $result = $this->db->update('poli_tenaga_kefarmasian');
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