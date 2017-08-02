<?php 

/**
* 
*/
class M_r_tiga_bulan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_riwayat = array())
  {
    $sql = $this->db->set($data_riwayat)->get_compiled_insert('kk_riwayat_3bulan');
    $this->db->query($sql);
  }

  public function ubah_r_tiga_bulan($key = array(), $data_riwayat_baru = array())
  {
    $this->db->where($key);
    $result = $this->db->update('kk_riwayat_3bulan', $data_riwayat_baru);
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

  public function hapus_r_tiga_bulan($data_riwayat = array())
  {
    $result = $this->db->delete('kk_riwayat_3bulan', $data_riwayat);
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