<?php 

/**
* 
*/
class M_staf_administrasi extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_user()
  {
    $sql = 'SELECT * FROM (select nik_tenaga_paramedis as nik, nama, uname, pwd, "poli_tenaga_paramedis" as tabel from poli_tenaga_paramedis
      UNION
      select nik_tenaga_medis as nik, nama, uname, pwd, "poli_tenaga_medis" as tabel from poli_tenaga_medis
      UNION
      select nik_tenaga_kefarmasian as nik, nama, uname, pwd, "poli_tenaga_kefarmasian" as tabel from poli_tenaga_kefarmasian
      UNION
      select nik_staf_administrasi as nik, nama, uname, pwd, "poli_staf_administrasi" as tabel from poli_staf_administrasi
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

  public function get_user_by_pwd($uname, $pwd)
  {
    $sql = 'SELECT * FROM (select nik_tenaga_paramedis as nik, nama, uname, pwd, "poli_tenaga_paramedis" as tabel from poli_tenaga_paramedis
      UNION
      select nik_tenaga_medis as nik, nama, uname, pwd, "poli_tenaga_medis" as tabel from poli_tenaga_medis
      UNION
      select nik_tenaga_kefarmasian as nik, nama, uname, pwd, "poli_tenaga_kefarmasian" as tabel from poli_tenaga_kefarmasian
      UNION
      select nik_staf_administrasi as nik, nama, uname, pwd, "poli_staf_administrasi" as tabel from poli_staf_administrasi
      UNION
      select "sys_admin" as nik, "sys_admin" as nama, uname, pwd, "sys_admin" as tabel from sys_admin) user
      WHERE uname = ?
        AND pwd = ?';
    $bind_param = array(
      $uname,
      $pwd
      );
    $result = $this->db->query($sql, $bind_param);
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
}