<?php 

/**
* 
*/
class M_kk extends CI_Model
{
 
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data()
  {
    $this->db->where('hapus', '0');
    $this->db->order_by($sort_by, $order);
    $query = $this->db->get('pas_kk');
    
    if (! $query) {
      $error = array(
        'status' => 'error', 
        'payload' => $this->db->error()
        );
      return $error;
    } else {
      $data = array(
        'status' => 'success',
        'payload' => $query->result_array()
        );
      return $data;
    }
  }

  public function store($data_kk = array())
  {
    $nilai = array();
    $sql = 'INSERT INTO pas_kk (id_kk, no_bpjs, no_telp) VALUES (?,?,?)';
    foreach ($data_kk as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function ubah_kk($id_kk, $data_kk_baru = array())
  {
    $this->db->where('id_kk', $id_kk);
    $result = $this->db->update('pas_kk', $data_kk_baru);
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

  public function hapus_kk($data_kk = array())
  {
    $result = $this->db->delete('pas_kk', $data_pasien);
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

  public function show_like($col_name = array(), $dt_kk)
  {
    $this->db->select($col_name);
    $this->db->like('id_kk', $dt_kk);
    $result = $this->db->get('pas_kk');
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
}