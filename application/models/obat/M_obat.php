<?php 

/**
* 
*/
class M_obat extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function tampil_obat($sort_by = NULL, $order = NULL)
  {
    $this->db->order_by($sort_by, $order);
    $result = $this->db->get('poli_obat');
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

  public function tambah_obat($data_obat = array())
  {
    $result = $this->db->insert('poli_obat', $data_obat);
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

  public function ubah_obat($key = array(), $data_obat_baru = array())
  {
    $this->db->where($key);
    $result = $this->db->update('poli_obat', $data_obat_baru);
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

  public function hapus_obat($data_obat = array())
  {
    $this->db->where($data_obat);
    $this->db->set('hapus', '1');
    $result = $this->db->update('poli_obat');
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