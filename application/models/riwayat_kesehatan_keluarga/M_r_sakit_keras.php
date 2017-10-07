<?php 

/**
* 
*/
class M_r_sakit_keras extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data_by_kk($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('kk_r_sakit_keras');
    $this->db->where('id_kk', $id_kk);
    $this->db->where('hapus', '0');
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

  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('kk_r_sakit_keras');
    $this->db->query($sql);
  }
}