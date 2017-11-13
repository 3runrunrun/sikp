<?php 

/**
* 
*/
class M_obat_keluar extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function show($id_obat_keluar, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('poli_obat_keluar a');
    $this->db->join('poli_obat b', 'a.id_obat = b.id_obat');
    $this->db->where('a.id_obat_keluar', $id_obat_keluar);
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

  public function get_data_obat($column = '*')
  {
    $this->db->select($column);
    $this->db->from('poli_obat_keluar a');
    $this->db->join('poli_obat b', 'a.id_obat = b.id_obat');
    $this->db->join('hol_resep_obat c', 'a.id_resep_obat = c.id_resep_obat');
    $this->db->join('pas_identitas d', 'c.no_bpjs = d.no_bpjs');
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
    $result = $this->db->get('poli_obat_keluar');
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
   * data obat keluar harian
   * @param  [type] $from [description]
   * @param  [type] $to   [description]
   * @return [type]       [description]
   */
  public function get_data_by_range($from, $to, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('poli_obat_keluar a');
    $this->db->join('poli_obat b', 'a.id_obat = b.id_obat');
    $this->db->join('hol_resep_obat c', 'a.id_resep_obat = c.id_resep_obat');
    $this->db->where('a.hapus', '0');
    $this->db->where('a.tgl_keluar >=', $from);
    $this->db->where('a.tgl_keluar <=', $to);
    $this->db->group_by('a.id_obat');
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

  public function get_resep_keluar($column = '*')
  {
    $this->db->select($column);
    $this->db->from('poli_obat_keluar a');
    $this->db->join('hol_resep_obat b', 'a.id_resep_obat = b.id_resep_obat');
    $this->db->join('hol_status c', 'b.id_registrasi = c.id_registrasi');
    $this->db->join('poli_pegawai d', 'c.nik_tenaga_medis = d.nik');
    $this->db->join('pas_identitas e', 'b.no_bpjs = e.no_bpjs');
    $this->db->where('a.hapus', '0');
    $this->db->group_by('a.id_resep_obat');
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

  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('poli_obat_keluar');
    $this->db->query($sql);
  }

  public function destroy($id_obat_keluar)
  {
    $this->db->where('id_obat_keluar', $id_obat_keluar);
    $sql = $this->db->set('hapus', '1')->get_compiled_update('poli_obat_keluar');
    $this->db->query($sql);
  }
}