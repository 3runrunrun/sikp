<?php 

/**
* 
*/
class M_status extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_status = array())
  {
    $result = $this->db->insert('hol_status', $data_status);
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array('status' => 'success');
    }
    return $ret_val;
  }

  public function show($id_registrasi, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('hapus', '0');
    $result = $this->db->get('hol_status');
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

  public function show_detail_status_pasien($id_registrasi, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('hol_status');
    $this->db->join('pas_identitas', 'hol_status.no_bpjs = pas_identitas.no_bpjs');
    $this->db->where('id_registrasi', $id_registrasi);
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

  public function get_data_pasien_terdaftar()
  {
    $this->db->select('id_registrasi, hol_status.no_bpjs, pas_identitas.nama, tgl_periksa, poli, status');
    $this->db->from('hol_status');
    $this->db->join('pas_identitas', 'hol_status.no_bpjs = pas_identitas.no_bpjs');
    $this->db->join('poli_tenaga_medis', 'hol_status.nik_tenaga_medis = poli_tenaga_medis.nik_tenaga_medis');
    $this->db->where('hol_status.hapus', '0');
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

  public function update($id = array(), $data_status = array())
  {
    $sql = $this->db->set($data_status)->where($id)->get_compiled_update('hol_status');
    $this->db->query($sql);
  }

  public function tambah_pemeriksaan_fisik($key = array(), $data_pemeriksaan_fisik = array())
  {
    $nilai = array();
    $sql = 'UPDATE hol_status SET alergi_obat = ?, SET alergi_makanan = ?, SET td = ?, SET rr = ?, SET nadi = ?, SET suhu = ?  WHERE id_registrasi = ? AND nik_tenaga_medis = ? AND no_bpjs = ?';
    foreach ($data_pemeriksaan_fisik as $key => $value) {
      array_push($nilai, $value);
    }
    foreach ($key as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function ubah_pemeriksaan_fisik($key = array(), $data_pemeriksaan_fisik = array())
  {
    $this->ubah_pemeriksaan_fisik($key, $data_pemeriksaan_fisik);
  }

  public function ubah_kepemilikan_anamnese($key = array(), $data_kepemilikan = array())
  {
    $nilai = array();
    $sql = 'UPDATE hol_status SET no_bpjs = ?  WHERE id_keluhan = ? AND id_registrasi = ? AND nik_tenaga_medis = ?';
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
    $sql = 'UPDATE hol_status SET nik_tenaga_medis = ?  WHERE id_keluhan = ? AND id_registrasi = ? AND no_bpjs = ?';
    foreach ($data_dokter as $key => $value) {
      array_push($nilai, $value);
    }
    foreach ($key as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function hapus_data_status($data_status = array())
  {
    $nilai = array();
    $sql = 'UPDATE hol_status SET hapus \'1\' WHERE id_registrasi = ? AND nik_tenaga_medis = ? AND no_bpjs = ?';
    foreach ($data_status as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }
}