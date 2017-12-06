<?php 

/**
* 
*/
class M_kk extends CI_Model
{
 
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function show($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_kk', $id_kk);
    $result = $this->db->get('pas_kk');
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

  public function show_by_no_bpjs($no_bpjs, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('no_bpjs', $no_bpjs);
    $this->db->where('hapus', '0');
    $result = $this->db->get('pas_kk');
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

  public function get_data()
  {
    $this->db->where('hapus', '0');
    $result = $this->db->get('pas_kk');
    if (! $result) {
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

  public function get_kk_pasien($column = '*')
  {
    $this->db->select($column);
    $this->db->from('pas_kk a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->join('(SELECT * FROM kk_riwayat_kes_kel WHERE tgl_isi IN (SELECT MAX(tgl_isi) as atglisi FROM kk_riwayat_kes_kel WHERE hapus = \'0\' GROUP BY id_kk)) c', 'a.no_bpjs = c.no_bpjs', 'left', FALSE);
    $this->db->join('(SELECT * FROM kk_gejala_stres WHERE tgl_isi IN (SELECT MAX(tgl_isi) as btglisi FROM kk_gejala_stres WHERE hapus = \'0\' GROUP BY id_kk)) d', 'c.id_kk = d.id_kk', 'left', FALSE);
    $this->db->where('a.hapus', '0');
    $this->db->where('b.hapus', '0');
    $result = $this->db->get();
    // echo $this->db->last_query();

    if (! $result) {
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

  /**
   * dipanggil di edit_perkawinan
   * join with pas_identitas, kk_anggota_keluarga
   * @param  string $value [description]
   * @return [type]        [description]
   */
  public function get_data_kepala_keluarga($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('pas_kk a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->join('kk_anggota_keluarga c', 'a.id_kk = c.id_kk');
    $this->db->where('a.id_kk', $id_kk);
    $this->db->where('c.hubungan_keluarga', '1');
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

  //////////////////////////////////////////
  // MODULE DATA DASAR KESEHATAN - DETAIL //
  //////////////////////////////////////////
  public function get_tingkat_risiko_penyakit($id_kk)
  {
    $this->db->select('a.tingkat_risiko_penyakit');
    $this->db->from('kk_riwayat_kes_kel a');
    $this->db->where('a.id_kk', $id_kk);
    $this->db->where('a.hapus', '0');
    $this->db->order_by('a.tgl_isi', 'DESC');
    $this->db->limit(1);
    $result = $this->db->get();
    if (! $result) {
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

  public function get_tingkat_stres($id_kk)
  {
    $this->db->select('a.tingkat_stres');
    $this->db->from('kk_gejala_stres a');
    $this->db->where('a.id_kk', $id_kk);
    $this->db->where('a.hapus', '0');
    $this->db->order_by('a.tgl_isi', 'DESC');
    $this->db->limit(1);
    $result = $this->db->get();
    if (! $result) {
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

  public function get_dd_identitas($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('pas_kk a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->join('sys_provinsi d', 'b.id_provinsi = d.id_provinsi');
    $this->db->join('sys_kabupaten e', 'b.id_kabupaten = e.id_kabupaten');
    $this->db->join('sys_kecamatan f', 'b.id_kecamatan = f.id_kecamatan');
    $this->db->join('sys_kelurahan g', 'b.id_kelurahan = g.id_kelurahan');
    $this->db->join('(select * from pas_riwayat_pekerjaan where pekerjaan_utama = \'1\') c', 'a.no_bpjs = c.no_bpjs', 'left');
    $this->db->where('a.id_kk', $id_kk);
    // $this->db->where('c.pekerjaan_utama', '1');
    $this->db->where('a.hapus', '0');
    $this->db->where('b.hapus', '0');
    $result = $this->db->get();
    if (! $result) {
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

  // RUD
  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('pas_kk');
    $this->db->query($sql);
  }

  public function update($data_insert = array(), $data_update = array())
  {
    $str = $this->db->insert_string('pas_kk', $data_insert);
    $on_update = ' ON DUPLICATE KEY UPDATE no_telp = ?';
    $sql = $str . $on_update;
    $this->db->query($sql, array($data_update['no_telp']));
  }
}