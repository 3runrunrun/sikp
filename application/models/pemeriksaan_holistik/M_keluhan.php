<?php 

/**
* 
*/
class M_keluhan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_keluhan = array())
  {
    $sql = $this->db->set($data_keluhan)->get_compiled_insert('hol_keluhan');
    $this->db->query($sql);
  }

  public function show($id_registrasi, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_registrasi', $id_registrasi);
    $result = $this->db->get('hol_keluhan');
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

  public function ubah_anamnesis($key = array(), $data_anamnesis_baru = array())
  {
    $nilai = array();
    $sql = 'UPDATE hol_keluhan SET anamnesis = ?  WHERE id_keluhan = ? AND id_registrasi = ? AND nik_tenaga_medis = ? AND no_bpjs = ?';
    foreach ($data_anamnesis_baru as $key => $value) {
      array_push($nilai, $value);
    }
    foreach ($key as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function ubah_kepemilikan_anamnesis($key = array(), $data_kepemilikan = array())
  {
    $nilai = array();
    $sql = 'UPDATE hol_keluhan SET no_bpjs = ?  WHERE id_keluhan = ? AND id_registrasi = ? AND nik_tenaga_medis = ?';
    foreach ($data_kepemilikan as $key => $value) {
      array_push($nilai, $value);
    }
    foreach ($key as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function ubah_dokter($key = array(), $data_dokter = array())
  {
    $nilai = array();
    $sql = 'UPDATE hol_keluhan SET nik_tenaga_medis = ?  WHERE id_keluhan = ? AND id_registrasi = ? AND no_bpjs = ?';
    foreach ($data_dokter as $key => $value) {
      array_push($nilai, $value);
    }
    foreach ($key as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function hapus_anamnesis($data_anamnesis = array())
  {
    $nilai = array();
    $sql = 'UPDATE hol_keluhan SET hapus \'1\' WHERE id_keluhan = ? AND id_registrasi = ? AND nik_tenaga_medis = ? AND no_bpjs = ?';
    foreach ($data_anamnesis as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }
}