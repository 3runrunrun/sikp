<?php 

/**
* 
*/
class M_r_kopi extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('kk_r_kopi');
    $this->db->query($sql);
  }
}