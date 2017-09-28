<?php 

/**
* 
*/
class M_r_satu_bulan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function count_distinct_by_kk($id_kk, $id_riwayat_kes_kel)
  {
    $this->db->where('id_kk', $id_kk);
    $this->db->where('id_riwayat_kes_kel', $id_riwayat_kes_kel);
    $this->db->where('hapus', '0');
    $this->db->group_by('no_bpjs');
    $result = $this->db->get('kk_riwayat_1bulan');
    return $result->num_rows();
  }

  /**
   * join with pas_identitas
   * @param  [type] $id_kk [description]
   * @param  string $colum [description]
   * @return [type]        [description]
   */
  public function get_data_pasien_by_kk($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('kk_riwayat_1bulan a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->where('a.id_kk', $id_kk);
    $this->db->where('a.hapus', '0');
    $this->db->where('b.hapus', '0');
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
    $sql = $this->db->set($data_riwayat)->get_compiled_insert('kk_riwayat_1bulan');
    $this->db->query($sql);
  }

  // berisi riwayat 1 bulan, 3 bulan, 1 tahun, sakit keras, sakit batuk, dan masalah kesehatan lain
  public function show_union_riwayat_kesehatan($no_bpjs)
  {
    $sql = 'SELECT id_1bulan AS id, jenis_penyakit, \'1 bulan lalu\' AS waktu_kejadian FROM kk_riwayat_1bulan a WHERE a.no_bpjs = ?
      UNION
      SELECT id_3bulan AS id, jenis_penyakit, \'3 bulan lalu\' AS waktu_kejadian FROM kk_riwayat_3bulan b WHERE b.no_bpjs = ?
      UNION
      SELECT id_1tahun AS id, jenis_penyakit, \'1 tahun lalu\' AS waktu_kejadian FROM kk_riwayat_1tahun c WHERE c.no_bpjs = ?
      UNION
      SELECT id_batuk AS id, \'batuk\' AS jenis_penyakit, \'3 bulan terakhir\' AS waktu_kejadian  FROM kk_r_batuk d WHERE d.no_bpjs = ?
      UNION 
      SELECT id_sakit_keras AS id, jenis_sakit_keras AS jenis_penyakit, tahun_sakit AS waktu_kejadian FROM kk_r_sakit_keras e WHERE e.id_kk IN (SELECT id_kk FROM pas_kk f WHERE f.no_bpjs = ?)';
    $bind_param = array($no_bpjs,$no_bpjs,$no_bpjs,$no_bpjs,$no_bpjs);
    $result = $this->db->query($sql, $bind_param);
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
    $this->db->where($key);
    $result = $this->db->update('kk_riwayat_1bulan', $data_riwayat_baru);
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

  public function hapus_riwayat($data_riwayat = array())
  {
    $result = $this->db->delete('kk_riwayat_1bulan', $data_riwayat);
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
}