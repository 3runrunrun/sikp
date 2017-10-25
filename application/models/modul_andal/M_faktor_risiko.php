<?php 

/**
* 
*/
class M_faktor_risiko extends CI_Model
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
    $result = $this->db->get('adl_mod_faktor_risiko');
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
    $this->db->where_in('tgl_dibuat', 'select max(tgl_dibuat) from adl_mod_faktor_risiko group by id_mod_faktor_risiko', FALSE);
    $result = $this->db->get('adl_mod_faktor_risiko');
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

  public function get_data_all()
  {
    $result = $this->db->get('adl_mod_faktor_risiko');
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
    $sql = $this->db->set($data)->get_compiled_insert('adl_mod_faktor_risiko');
    $this->db->query($sql);
  }

  public function destroy($id_mod_faktor_risiko, $versi)
  {
    $this->db->where('id_mod_faktor_risiko', $id_mod_faktor_risiko);
    $this->db->where('versi', $versi);
    $sql = $this->db->get_compiled_delete('adl_mod_faktor_risiko');
    $this->db->query($sql);
  }
}