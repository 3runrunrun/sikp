<?php 

/**
* 
*/
class M_r_kecelakaan_kerja extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_riwayat = array())
  {
    $sql = $this->db->set($data_riwayat)->get_compiled_insert('kk_r_kecelakaan_kerja');
    $this->db->query($sql);
  }

  public function ubah_riwayat($key = array(), $data_riwayat_baru = array())
  {
    $nilai = array();
    $sql = 'UPDATE kk_r_kecelakaan_kerja SET jenis_kecelakaan_kerja = ?, SET tahun_kejadian = ?, SET jenis_kelainan = ?, SET durasi_perawatan = ? WHERE id_kk = ? AND id_kecelakaan_kerja = ? AND id_riwayat_kes_kel = ? AND no_bpjs = ?';
    foreach ($data_riwayat_baru as $key => $value) {
      array_push($nilai, $value);
    }
    foreach ($key as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, array($nilai));
  }

  public function hapus_riwayat($data_riwayat = array())
  {
    $nilai = array();
    $sql = 'UPDATE kk_r_kecelakaan_kerja SET hapus = \'1\' WHERE id_kk = ? AND id_kecelakaan_kerja = ? AND id_riwayat_kes_kel = ? AND no_bpjs = ?';
    echo $sql;
    foreach ($data_riwayat as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, array($nilai));
  }
}