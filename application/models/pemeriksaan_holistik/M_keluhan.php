<?php 

/**
* 
*/
class M_keluhan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function show_by_status_pasien($id_registrasi, $no_bpjs, $column = '*')
  {
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $this->db->where('hapus', '0');
    $result = $this->db->get('hol_keluhan');
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

  public function store($data_keluhan = array())
  {
    $sql = $this->db->set($data_keluhan)->get_compiled_insert('hol_keluhan');
    $this->db->query($sql);
  }

  public function destroy_by_status_pasien($id_registrasi, $no_bpjs)
  {
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $sql = $this->db->set(array('hapus' => '1'))->get_compiled_update('hol_keluhan');
    $this->db->query($sql);
  }
  
  public function count_by_status_pasien($id_registrasi, $no_bpjs)
  {
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $result = $this->db->get('hol_keluhan');
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error', 
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success', 
        'data' => array($result->num_rows())
        );
    }
    return $ret_val;
  }
}