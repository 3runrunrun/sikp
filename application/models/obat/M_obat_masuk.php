<?php 

/**
* 
*/
class M_obat_masuk extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function show($id_obat_masuk, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('poli_obat_masuk a');
    $this->db->join('poli_obat b', 'a.id_obat = b.id_obat');
    $this->db->where('a.id_obat_masuk', $id_obat_masuk);
    $this->db->where('a.hapus', '0');
    $this->db->where('b.hapus', '0');
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

  public function get_data_obat($column = '*')
  {
    $this->db->select($column);
    $this->db->from('poli_obat_masuk a');
    $this->db->join('poli_obat b', 'a.id_obat = b.id_obat');
    $this->db->where('a.hapus', '0');
    $this->db->where('b.hapus', '0');
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
    $sql = $this->db->set($data)->get_compiled_insert('poli_obat_masuk');
    $this->db->query($sql);
  }

  public function destroy($id_obat_masuk)
  {
    $this->db->where('id_obat_masuk', $id_obat_masuk);
    $sql = $this->db->set('hapus', '1')->get_compiled_update('poli_obat_masuk');
    $this->db->query($sql);
  }
}