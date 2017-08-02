<?php 

/**
* 
*/
class M_rujukan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function tambah_rujukan($data_rujukan = array())
  {
    $nilai = array();
    $sql = 'INSERT INTO hol_rujukan (id_rujukan, id_registrasi, nik_tenaga_medis, no_bpjs, jenis_rujukan, rs) VALUES ?';
    foreach ($data_rujukan as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, $nilai);
  }

  public function ubah_rujukan($data_rujukan_baru = array())
  {
    $this->tambah_rujukan($data_rujukan_baru);
  }
}