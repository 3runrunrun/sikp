<?php 

/**
* 
*/
class M_staf_administrasi extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function tampil_staf_administrasi($sort_by = NULL, $order = NULL)
  {
    $this->db->order_by($sort_by, $order);
    $result = $this->db->get('poli_staf_administrasi');
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

  public function tambah_staf_administrasi($data_staf_administrasi = array())
  {
    $result = $this->db->insert('poli_staf_administrasi', $data_staf_administrasi);
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

  public function ubah_staf_administrasi($key = array(), $data_staf_administrasi_baru = array())
  {
    $this->db->where($key);
    $result = $this->db->update('poli_staf_administrasi', $data_staf_administrasi_baru);
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

  public function hapus_staf_administrasi($data_staf_administrasi = array())
  {
    $this->db->where($data_staf_administrasi);
    $this->db->set('hapus', '1');
    $result = $this->db->update('poli_staf_administrasi');
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