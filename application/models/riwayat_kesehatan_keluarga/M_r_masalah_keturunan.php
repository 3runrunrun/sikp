<?php 

/**
* 
*/
class M_r_masalah_keturunan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }


  public function count_distinct_by_kk($id_kk, $id_riwayat_kes_kel)
  {
    $condition = array('1', '4', '5', '6', '7');
    $this->db->where_in('jenis_masalah_keturunan', $condition);
    $this->db->where('id_kk', $id_kk);
    $this->db->where('id_riwayat_kes_kel', $id_riwayat_kes_kel);
    $this->db->where('hapus', '0');
    $this->db->group_by('jenis_masalah_keturunan');
    $result = $this->db->get('kk_r_masalah_keturunan');
    return $result->num_rows();
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
    $this->db->from('kk_r_masalah_keturunan a');
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
    $sql = $this->db->set($data_riwayat)->get_compiled_insert('kk_r_masalah_keturunan');
    $this->db->query($sql);
  }

  public function show_by_no_bpjs($no_bpjs, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('no_bpjs', $no_bpjs);
    $this->db->where('hapus', '0');
    $result = $this->db->get('kk_r_masalah_keturunan');
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

  public function ubah_riwayat($key = array(), $data_riwayat_baru = array())
  {
    $nilai = array();
    $sql = 'UPDATE kk_r_masalah_keturunan SET masalah_keturunan = ?, SET anggota_masalah_keturunan = ? WHERE id_kk = ? AND id_masalah_keturunan = ? AND id_riwayat_kes_kel = ? AND no_bpjs = ?';
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
    $sql = 'UPDATE kk_r_masalah_keturunan SET hapus = \'1\' WHERE id_kk = ? AND id_masalah_keturunan = ? AND id_riwayat_kes_kel = ? AND no_bpjs = ?';
    echo $sql;
    foreach ($data_riwayat as $key => $value) {
      array_push($nilai, $value);
    }
    $this->db->query($sql, array($nilai));
  }
}