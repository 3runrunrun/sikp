<?php 

/**
* 
*/
class M_gejala_stres extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_kuesioner = array())
  {
    $result = $this->db->insert('kk_gejala_stres', $data_kuesioner);
    if ( ! $result) {
      $error = array(
        'status' => 'error', 
        'data' => $this->db->error()
        );
      return $error;
    } else {
      $data = array('status' => 'success');
      return $data;
    }
  }

  public function ubah_data_kuesioner($key = array(), $data_kuesioner_baru = array())
  {
    $this->db->where($key);
    $result = $this->db->update('kk_gejala_stres', $data_kuesioner_baru);
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

  public function hapus_data_kuesioner($data_kuesioner = array())
  {
    $result = $this->db->delete('kk_gejala_stres', $data_kuesioner);
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