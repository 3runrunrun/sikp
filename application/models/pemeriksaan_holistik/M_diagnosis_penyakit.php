<?php 

/**
* 
*/
class M_diagnosis_penyakit extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  /**
   * join with adl_modul_penyakit
   * @param  [type] $id_registrasi [description]
   * @param  [type] $no_bpjs       [description]
   * @param  string $column        [description]
   * @return [type]                [description]
   */
  public function show_modul_by_status_pasien($id_registrasi, $no_bpjs, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('hol_diagnosis_penyakit a');
    $this->db->join('adl_mod_penyakit b', 'a.id_mod_penyakit = b.id_mod_penyakit');
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $this->db->where('hapus', '0');
    $this->db->group_by('a.id_diagnosa');
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
    $sql = $this->db->set($data)->get_compiled_insert('hol_diagnosis_penyakit');
    $this->db->query($sql);
  }

  public function destroy_by_status_pasien($id_registrasi, $no_bpjs)
  {
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $sql = $this->db->set(array('hapus' => '1'))->get_compiled_update('hol_diagnosis_penyakit');
    $this->db->query($sql);
  }
  
  public function count_by_status_pasien($id_registrasi, $no_bpjs)
  {
    $this->db->where('id_registrasi', $id_registrasi);
    $this->db->where('no_bpjs', $no_bpjs);
    $result = $this->db->get('hol_diagnosis_penyakit');
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