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

  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('kk_ekonomi');
    $this->db->query($sql);
  }

  public function update($id_kk, $data = array())
  {
    $this->db->where('id_kk', $id_kk);
    $sql = $this->db->set($data)->get_compiled_update('kk_ekonomi');
    $this->db->query($sql);
  }
}