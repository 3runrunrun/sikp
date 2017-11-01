<?php 

/**
* 
*/
class M_pegawai extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_user()
  {
    $sql = 'SELECT * FROM (select nik, nama, uname, pwd, CASE profesi 
      WHEN \'perawat\' THEN "poli_tenaga_paramedis"
      WHEN \'bidan\' THEN "poli_tenaga_paramedis"
      WHEN \'dokter\' THEN "poli_tenaga_medis"
      WHEN \'kefarmasian\' THEN "poli_tenaga_kefarmasian"
      WHEN \'administrasi\' THEN "poli_staf_administrasi"
      END as tabel from poli_pegawai
      UNION
      select "sys_admin" as nik, "sys_admin" as nama, uname, pwd, "sys_admin" as tabel from sys_admin) user';
    $result = $this->db->query($sql);
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
    // echo $this->db->last_query();
  }

  public function get_data_dokter()
  {
    $this->db->where('profesi', 'dokter');
    $result = $this->db->get('poli_pegawai');
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
}