<?php 

/**
* 
*/
class M_ekonomi extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_ekonomi = array())
  {
    $result = $this->db->insert('kk_ekonomi', $data_ekonomi);
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

  public function ubah_data_ekonomi($key = array(), $data_ekonomi_baru = array())
  {
    $this->db->where($key);
    $result = $this->db->update('kk_ekonomi', $data_ekonomi_baru);
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

  public function hapus_data_ekonomi($data_ekonomi = array())
  {
    $result = $this->db->delete('kk_ekonomi', $data_ekonomi);
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