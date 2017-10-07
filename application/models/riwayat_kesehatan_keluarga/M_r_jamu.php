<?php 

/**
* 
*/
class M_r_jamu extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_riwayat = array())
  {
    $sql = $this->db->set($data_riwayat)->get_compiled_insert(kk_r_jamu);
    $this->db->query($sql);
  }
}