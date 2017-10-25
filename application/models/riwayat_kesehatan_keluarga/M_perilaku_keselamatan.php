<?php 

/**
* 
*/
class M_perilaku_keselamatan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function count_distinct_sepeda_motor_by_kk($id_kk)
  {
    $condition = array('1', '2');
    $this->db->where_in('pengguna_sepeda_motor', $condition);
    $this->db->where('id_kk', $id_kk);
    $this->db->where('hapus', '0');
    $this->db->group_by('id_kk');
    $this->db->order_by('tgl_isi', 'desc');
    $this->db->limit(1);
    $result = $this->db->get('kk_perilaku_keselamatan');
    return $result->num_rows();
  }

  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('kk_perilaku_keselamatan');
    $this->db->query($sql);
  }

  public function destroy($id_kk, $tgl_isi)
  {
    $this->db->where('id_kk', $id_kk);
    $this->db->where('tgl_isi', $tgl_isi);
    $sql = $this->db->set(array('hapus' => '1'))->get_compiled_update('kk_perilaku_keselamatan');
    $this->db->query($sql);
  }
}