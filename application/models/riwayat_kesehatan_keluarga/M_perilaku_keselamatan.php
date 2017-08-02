<?php 

/**
* 
*/
class M_perilaku_keselamatan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_perilaku = array())
  {
    $sql = $this->db->set($data_perilaku)->get_compiled_insert('kk_perilaku_keselamatan');
    $this->db->query($sql);
  }

  public function ubah_perilaku_keselamatan($key = array(), $data_perilaku_baru = array())
  {
    $this->db->where($key);
    $result = $this->db->update('kk_perilaku_keselamatan', $data_perilaku_baru);
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

  public function hapus_perilaku_keselamatan($data_perilaku = array())
  {
    $result = $this->db->delete('kk_perilaku_keselamatan', $data_perilaku);
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