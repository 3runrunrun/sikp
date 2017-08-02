<?php 

/**
* 
*/
class M_resep_obat extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function tambah_resep_obat($data_resep_obat = array())
  {
    $nilai = array();
    $sql = 'INSERT INTO hol_resep_obat (id_resep_obat, id_registrasi, nik_tenaga_medis, no_bpjs) VALUES ?';
    foreach ($data_resep_obat as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function ubah_resep_obat($data_resep_obat_baru = array())
  {
    $this->tambah_resep_obat($data_resep_obat_baru);
  }
}