<?php 

/**
* 
*/
class M_cek_darah extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_cek_darah = array())
  {
    $sql = $this->db->set($data_cek_darah)->get_compiled_insert('hol_cek_darah');
    $this->db->query($sql);
    // echo $sql;
  }

  public function tambah_cek_darah($data_cek_darah = array())
  {
    $nilai = array();
    $sql = 'INSERT INTO hol_cek_darah (no_surat_pengantar, id_registrasi, nik_tenaga_medis, no_bpjs) VALUES ?';
    foreach ($data_cek_darah as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function ubah_cek_darah($data_cek_darah_baru = array())
  {
    $this->tambah_cek_darah($data_cek_darah_baru);
  }
}