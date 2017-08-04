<?php 

/**
* 
*/
class M_rujukan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function store($data_rujukan = array())
  {
    $sql = $this->db->set($data_rujukan)->get_compiled_insert('hol_rujukan');
    $this->db->query($sql);
  }

  public function ubah_rujukan($data_rujukan_baru = array())
  {
    $this->tambah_rujukan($data_rujukan_baru);
  }
}