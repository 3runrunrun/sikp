<?php 

/**
* 
*/
class M_diagnosis_penyakit extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_diagnosis = array())
  {
    $sql = $this->db->set($data_diagnosis)->get_compiled_insert('hol_diagnosis_penyakit');
    $this->db->query($sql);
  }

  public function show_by_registrasi($id_registrasi, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('hapus', '0');
    $this->db->order_by('id_diagnosa', 'DESC');
    $result = $this->db->get('hol_diagnosis_penyakit');
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

  public function ubah_diagnosis_penyakit($data_diagnosis_baru = array())
  {
    $this->tambah_diagnosis_penyakit($data_diagnosis_baru);
  }
}