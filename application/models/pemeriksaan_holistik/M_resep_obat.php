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

  public function show_resep_baru_status($column = '*')
  {
    $this->db->select($column);
    $this->db->from('hol_resep_obat a');
    $this->db->join('hol_status b', 'a.id_registrasi = b.id_registrasi');
    $this->db->join('pas_identitas c', 'a.no_bpjs = c.no_bpjs');
    $this->db->where_not_in('a.id_resep_obat', "select id_resep_obat from poli_obat_keluar where hapus = '0'", FALSE);
    $this->db->like('DATE_FORMAT(b.tgl_periksa, \'%d\')', date('d'));
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

  public function show_by_status_pasien($id_registrasi, $no_bpjs, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $this->db->where('hapus', '0');
    $result = $this->db->get('hol_resep_obat');
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

  /**
   * fungsi untuk resep cetak
   * @param  string $value [description]
   * @return [type]        [description]
   */
  public function get_data_cetak_resep($id_resep_obat, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('hol_resep_obat a');
    $this->db->join('poli_obat_keluar b', 'a.id_resep_obat = b.id_resep_obat');
    $this->db->join('poli_obat c', 'b.id_obat = c.id_obat');
    $this->db->join('pas_identitas d', 'a.no_bpjs = d.no_bpjs');
    $this->db->join('poli_pegawai e', 'a.nik_tenaga_medis = e.nik');
    $this->db->where('a.id_resep_obat', $id_resep_obat);
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

  public function get_data($column = '*')
  {
    $this->db->select($column);
    $this->db->where('hapus', '0');
    $result = $this->db->get('hol_resep_obat');
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

  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('hol_resep_obat');
    $this->db->query($sql);
  }

  public function destroy_by_status_pasien($id_registrasi, $no_bpjs)
  {
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $sql = $this->db->set(array('hapus' => '1'))->get_compiled_update('hol_resep_obat');
    $this->db->query($sql);
  }
  
  public function count_by_status_pasien($id_registrasi, $no_bpjs)
  {
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $result = $this->db->get('hol_resep_obat');
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error', 
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success', 
        'data' => array($result->num_rows())
        );
    }
    return $ret_val;
  }
}