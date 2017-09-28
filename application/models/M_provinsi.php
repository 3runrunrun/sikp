<?php 

/**
* 
*/
class M_provinsi extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data()
  {
    $result = $this->db->get('sys_provinsi');
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

  public function show($id_provinsi, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_provinsi', $id_provinsi);
    $result = $this->db->get('sys_provinsi');
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
    $sql = $this->db->set($data)->get_compiled_insert('sys_provinsi');
    $this->db->query($sql);
  }

  public function destroy($id_provinsi)
  {
    $this->db->where('id_provinsi', $id_provinsi);
    $sql = $this->db->get_compiled_delete('sys_provinsi');
    $this->db->query($sql);
  }
}