<?php 

/**
* 
*/
class M_hol_faktor_risiko extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_risiko = array())
  {
    $sql = $this->db->set($data_risiko)->get_compiled_insert('hol_faktor_risiko');
    $this->db->query($sql);
  }

  public function show_by_registrasi($id_registrasi, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('hapus', '0');
    $result = $this->db->get('hol_faktor_risiko');
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

  public function ubah_faktor_risiko($data_faktor_risiko_baru = array())
  {
    $this->tambah_faktor_risiko($data_faktor_risiko_baru);
  }
}