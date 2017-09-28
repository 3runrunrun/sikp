<?php 

/**
* 
*/
class M_sys_user extends CI_Model
{
  
  function __construct()
  {
    # code...
  }

  public function insert()
  {
    $sql = $this->db->set(array('username' => '3runrunrun', 'password' => 'parkour3run'))->get_compiled_insert('sys_user');
    $this->db->query($sql);
  }

  public function update()
  {
    $this->db->where('username', '3runrunrun');
    $sql = $this->db->set(array('password' => 'password_baru'))->get_compiled_update('sys_user');
    $this->db->query($sql);
  }

  public function show()
  {
    $result = $this->db->get('sys_user');
    return $result->result_array();
  }
}