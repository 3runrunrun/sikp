<?php 

/**
* 
*/
class M_kabupaten extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data()
  {
    $result = $this->db->get('sys_kabupaten');
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

  /**
   * join with provinsi
   * @param  string $column [description]
   * @return [type]         [description]
   */
  public function get_provinsi($column = '*')
  {
    $this->db->select($column);
    $this->db->from('sys_kabupaten a');
    $this->db->join('sys_provinsi b', 'a.id_provinsi = b.id_provinsi');
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

  public function show_by_provinsi($id_provinsi, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_provinsi', $id_provinsi);
    $result = $this->db->get('sys_kabupaten');
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
    $sql = $this->db->set($data)->get_compiled_insert('sys_kabupaten');
    $this->db->query($sql);
  }

  public function destroy($id_kabupaten)
  {
    $this->db->where('id_kabupaten', $id_kabupaten);
    $sql = $this->db->get_compiled_delete('sys_kabupaten');
    $this->db->query($sql);
  }
}