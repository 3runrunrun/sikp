<?php 

/**
* 
*/
class M_cek_darah extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data_harian($column = '*', $status = array('1', '2'))
  {
    $this->db->select($column);
    $this->db->from('hol_cek_darah a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->like('DATE_FORMAT(a.tgl_cek_darah, \'%d\')', date('d'));
    $this->db->where_in('a.status', $status);
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

  public function get_data_riwayat($column = '*')
  {
    $this->db->select($column);
    $this->db->from('hol_cek_darah a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->not_like('DATE_FORMAT(a.tgl_cek_darah, \'%d\')', date('d'));
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

  public function get_data($column = '*')
  {
    $this->db->select($column);
    $this->db->from('hol_cek_darah a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
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

  public function show($no_surat_pengantar, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('hol_cek_darah a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->where('a.no_surat_pengantar', $no_surat_pengantar);
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
    $sql = $this->db->set($data)->get_compiled_insert('hol_cek_darah');
    $this->db->query($sql);
  }

  public function update($no_surat_pengantar, $data = array())
  {
    $this->db->where('no_surat_pengantar', $no_surat_pengantar);
    $sql = $this->db->set($data)->get_compiled_update('hol_cek_darah');
    $this->db->query($sql);
  }

  public function destroy($no_surat_pengantar)
  {
    $this->db->where('no_surat_pengantar', $no_surat_pengantar);
    $sql = $this->db->set(array('hapus' => '1'))->get_compiled_update('hol_cek_darah');
    $this->db->query($sql);
  }
}