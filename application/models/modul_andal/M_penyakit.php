<?php 

/**
* 
*/
class M_penyakit extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data()
  {
    $this->db->order_by('versi', 'DESC');
    $result = $this->db->get('adl_mod_penyakit');
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error',
        'data'  => $this->db->error()
        );
    } else {
      $ret_val = array(
        'status' => 'success',
        'data'  => $result->result_array()
        );
    }
    return $ret_val;
  }
}