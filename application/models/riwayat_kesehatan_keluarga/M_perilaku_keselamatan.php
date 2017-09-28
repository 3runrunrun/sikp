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
    $this->db->order_by('tgl_isi', 'desc');
    $this->db->group_by('id_kk');
    $this->db->limit(1);
    $result = $this->db->get('kk_perilaku_keselamatan');
    return $result->num_rows();
  }

  public function store($data_perilaku = array())
  {
    $sql = $this->db->set($data_perilaku)->get_compiled_insert('kk_perilaku_keselamatan');
    $this->db->query($sql);
  }

  public function destroy($id_kk, $tgl_isi)
  {
    $this->db->where('id_kk', $id_kk);
    $this->db->where('tgl_isi', $tgl_isi);
    $sql = $this->db->set(array('hapus' => '1'))->get_compiled_update('kk_perilaku_keselamatan');
    $this->db->query($sql);
  }

  public function ubah_perilaku_keselamatan($key = array(), $data_perilaku_baru = array())
  {
    $this->db->where($key);
    $result = $this->db->update('kk_perilaku_keselamatan', $data_perilaku_baru);
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error', 
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array('status' => 'success');
    }
    return $ret_val;
  }

  public function hapus_perilaku_keselamatan($data_perilaku = array())
  {
    $result = $this->db->delete('kk_perilaku_keselamatan', $data_perilaku);
    if ( ! $result) {
      $ret_val = array(
        'status' => 'error', 
        'data' => $this->db->error()
        );
    } else {
      $ret_val = array('status' => 'success');
    }
    return $ret_val;
  }
}