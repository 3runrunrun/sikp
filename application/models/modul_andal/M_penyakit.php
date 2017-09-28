<?php 

/**
* 
*/
class M_penyakit extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function show_latest_by_nama($nama, $column = '*')
  {
    $this->db->select($column);
    $this->db->like('nama', $nama, 'after');
    $this->db->order_by('versi', 'DESC');
    $this->db->limit(1);
    $result = $this->db->get('adl_mod_penyakit');
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data'  => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'  => $result->result_array()
        );
    }
    return $ret_val;
  }

  public function get_data()
  {
    $this->db->order_by('versi', 'DESC');
    $result = $this->db->get('adl_mod_penyakit');
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data'  => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'  => $result->result_array()
        );
    }
    return $ret_val;
  }

  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('adl_mod_penyakit');
    $this->db->query($sql);
  }

  public function destroy($id_mod_penyakit)
  {
    $this->db->where('id_mod_penyakit', $id_mod_penyakit);
    $sql = $this->db->get_compiled_delete('adl_mod_penyakit');
    $this->db->query($sql);
  }
}