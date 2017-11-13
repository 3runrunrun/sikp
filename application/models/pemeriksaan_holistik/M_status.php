<?php 

/**
* 
*/
class M_status extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data($column)
  {
    $this->db->select($column);
    $this->db->from('hol_status a');
    $this->db->join('poli_pegawai b', 'a.nik_tenaga_medis = b.nik');
    $this->db->join('pas_identitas c', 'a.no_bpjs = c.no_bpjs');
    $this->db->not_like('DATE_FORMAT(a.tgl_periksa, \'%d\')', date('d'));
    $this->db->where('a.hapus', '0');
    $this->db->order_by('a.tgl_periksa', 'desc');
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

  public function get_data_harian($column = '*', $status = array('terdaftar'), $nik = NULL)
  {
    $this->db->select($column);
    $this->db->from('hol_status a');
    $this->db->join('poli_pegawai b', 'a.nik_tenaga_medis = b.nik');
    $this->db->join('pas_identitas c', 'a.no_bpjs = c.no_bpjs');
    $this->db->like('DATE_FORMAT(a.tgl_periksa, \'%d\')', date('d'));
    $this->db->where_in('a.status', $status);
    $this->db->where('a.hapus', '0');
    if ($nik !== NULL) {
      $this->db->where('a.nik_tenaga_medis', $nik);
    }
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
    // var_dump($view_data);
    // die()
    return $ret_val;
  }

  /**
   * join with pas_identitas
   * @param  [type] $no_bpjs [description]
   * @param  [type] $column  [description]
   * @return [type]          [description]
   */
  public function get_data_pasien($no_bpjs, $column)
  {
    $this->db->select($column);
    $this->db->from('hol_status a');
    $this->db->join('poli_pegawai b', 'a.nik_tenaga_medis = b.nik');
    $this->db->join('pas_identitas c', 'a.no_bpjs = c.no_bpjs');
    $this->db->where('a.no_bpjs', $no_bpjs);
    $this->db->where('a.hapus', '0');
    $this->db->order_by('a.tgl_periksa', 'desc');
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

  public function show($id_registrasi, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('hapus', '0');
    $result = $this->db->get('hol_status');
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

  public function show_pasien($id_registrasi, $no_bpjs, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('hol_status a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->where('a.id_registrasi', $id_registrasi);
    $this->db->where('a.no_bpjs', $no_bpjs);
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

  public function show_pasien_by_resep($id_resep_obat, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('hol_status a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->join('poli_pegawai c', 'a.nik_tenaga_medis = c.nik');
    $this->db->where_in('a.id_registrasi', "select id_registrasi from hol_resep_obat where id_resep_obat = '$id_resep_obat'", FALSE);
    $this->db->where('a.hapus', '0');
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
    $sql = $this->db->set($data)->get_compiled_insert('hol_status');
    $this->db->query($sql);
  }

  public function update($id_registrasi, $no_bpjs, $data = array())
  {
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $sql = $this->db->set($data)->get_compiled_update('hol_status');
    $this->db->query($sql);
  }

  public function destroy($id_registrasi, $no_bpjs)
  {
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $sql = $this->db->set(array('hapus' => '1'))->get_compiled_update('hol_status');
    $this->db->query($sql);
  }

  public function count_by_status_pasien($id_registrasi, $no_bpjs)
  {
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $result = $this->db->get('hol_status');
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