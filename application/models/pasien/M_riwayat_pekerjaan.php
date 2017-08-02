<?php 

/**
* 
*/
class M_riwayat_pekerjaan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function tambah_riwayat_pekerjaan($data_riw_pekerjaan = array())
  {
    $result = $this->db->insert('pas_riwayat_pekerjaan', $data_riw_pekerjaan);
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

  public function ubah_riwayat_pekerjaan($id_riwayat_pekerjaan, $data_riw_pekerjaan_baru = array())
  {
    $this->db->where('id_riwayat_pekerjaan', $id_riwayat_pekerjaan);
    $result = $this->db->update('pas_riwayat_pekerjaan', $data_riw_pekerjaan_baru);
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

  public function hapus_riwayat_pekerjaan($data_riw_pekerjaan = array())
  {
    $result = $this->db->delete('pas_riwayat_pekerjaan', $data_riw_pekerjaan);
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