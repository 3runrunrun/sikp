<?php 

/**
* 
*/
class M_tenaga_medis extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data()
  {
    $result = $this->db->get('poli_tenaga_medis');
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
    # code...
  }

  public function update($nik_tenaga_medis, $data = array())
  {
    # code...
  }

  public function destroy($nik_tenaga_medis)
  {
    # code...
  }
}