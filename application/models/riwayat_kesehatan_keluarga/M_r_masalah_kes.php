<?php 

/**
* 
*/
class M_r_masalah_kes extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  /**
   * join with pas_kk, pas_identitas
   * @param  [type] $id_kk  [description]
   * @param  string $column [description]
   * @return [type]         [description]
   */
  public function get_data_kk_identitas($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('kk_r_masalah_kes a');
    $this->db->join('pas_kk b', 'a.id_kk = b.id_kk');
    $this->db->join('pas_identitas c', 'a.no_bpjs = c.no_bpjs');
    $this->db->where('a.id_kk', $id_kk);
    $this->db->where('a.hapus', '0');
    $this->db->where('b.hapus', '0');
    $this->db->where('c.hapus', '0');
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

  public function store($data_riwayat = array())
  {
    $sql = $this->db->set($data_riwayat)->get_compiled_insert('kk_r_masalah_kes');
    $this->db->query($sql);
  }

  public function ubah_riwayat($key = array(), $data_riwayat_baru = array())
  {
    $nilai = array();
    $sql = 'UPDATE kk_r_masalah_kes SET masalah_kes = ?, SET anggota_masalah_kes = ? WHERE id_kk = ? AND id_masalah_kes = ? AND id_riwayat_kes_kel = ? AND no_bpjs = ?';
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
    $sql = 'UPDATE kk_r_masalah_kes SET hapus = \'1\' WHERE id_kk = ? AND id_masalah_kes = ? AND id_riwayat_kes_kel = ? AND no_bpjs = ?';
    echo $sql;
    foreach ($data_riwayat as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, array($nilai));
  }
}