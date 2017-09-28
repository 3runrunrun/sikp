<?php 

/**
* 
*/
class M_kelurahan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data()
  {
    $result = $this->db->get('sys_kelurahan');
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

  public function get_kecamatan_kabupaten_provinsi($column = '*')
  {
    $this->db->select($column);
    $this->db->from('sys_kelurahan a');
    $this->db->join('sys_kecamatan b', 'a.id_kecamatan = b.id_kecamatan');
    $this->db->join('sys_kabupaten c', 'b.id_kabupaten = c.id_kabupaten');
    $this->db->join('sys_provinsi d', 'a.id_provinsi = d.id_provinsi');
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

  public function show_by_kecamatan($id_kecamatan, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_kecamatan', $id_kecamatan);
    $result = $this->db->get('sys_kelurahan');
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
    $sql = $this->db->set($data)->get_compiled_insert('sys_kelurahan');
    $this->db->query($sql);
  }

  public function destroy($id_kelurahan)
  {
    $this->db->where('id_kelurahan', $id_kelurahan);
    $sql = $this->db->get_compiled_delete('sys_kelurahan');
    $this->db->query($sql);
  }
}