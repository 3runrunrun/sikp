<?php 

/**
* 
*/
class M_kecamatan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data()
  {
    $result = $this->db->get('sys_kecamatan');
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

  public function get_kabupaten_provinsi($column = '*')
  {
    $this->db->select($column);
    $this->db->from('sys_kecamatan a');
    $this->db->join('sys_kabupaten b', 'a.id_kabupaten = b.id_kabupaten');
    $this->db->join('sys_provinsi c', 'a.id_provinsi = c.id_provinsi');
    $result = $this->db->get();
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

  public function show_by_kabupaten($id_kabupaten, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_kabupaten', $id_kabupaten);
    $result = $this->db->get('sys_kecamatan');
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

  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('sys_kecamatan');
    $this->db->query($sql);
  }

  public function destroy($id_kecamatan)
  {
    $this->db->where('id_kecamatan', $id_kecamatan);
    $sql = $this->db->get_compiled_delete('sys_kecamatan');
    $this->db->query($sql);
  }
}