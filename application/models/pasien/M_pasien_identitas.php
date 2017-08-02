<?php 

/**
* 
*/
class M_pasien_identitas extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data()
  {
    $this->db->where('hapus', '0');
    $result = $this->db->get('pas_identitas');
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

  public function show($column = '*', $no_bpjs)
  {
    $this->db->select($column);
    $this->db->where('no_bpjs', $no_bpjs);
    $result = $this->db->get('pas_identitas');
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

  public function store($data_pasien = array())
  {
    $result = $this->db->insert('pas_identitas', $data_pasien);
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

  public function coba($ar = array())
  {
    $nilai = array();
    $sql = 'INSERT INTO sys_user (password) VALUES ?';
    foreach ($ar as $key => $value) {
      array_push($nilai, $value);
    }
    print_r($nilai);
    $this->db->query($sql, $nilai);
    echo $this->db->last_query($sql, $nilai);
  }

  public function ubah_identitas_pasien($no_bpjs, $data_pasien_baru = array())
  {
    $this->db->where('no_bpjs', $no_bpjs);
    $result = $this->db->update('pas_identitas', $data_pasien_baru);
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

  public function hapus_identitas_pasien($data_pasien = array())
  {
    $result = $this->db->delete('pas_identitas', $data_pasien);
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