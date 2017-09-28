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

  public function show($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_kk', $id_kk);
    $result = $this->db->get('kk_ekonomi');
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

  public function store($data_ekonomi = array())
  {
    $sql = $this->db->set($data_ekonomi)->get_compiled_insert('kk_ekonomi');
    $this->db->query($sql);
  }

  public function update($id_kk, $data_baru = array())
  {
    $this->db->where('id_kk', $id_kk);
    $sql = $this->db->set($data_baru)->get_compiled_update('kk_ekonomi');
    $this->db->query($sql);
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