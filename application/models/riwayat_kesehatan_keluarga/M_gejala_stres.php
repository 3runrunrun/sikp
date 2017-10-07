<?php 

/**
* 
*/
class M_gejala_stres extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function show_by_status($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_kk', $id_kk);
    $this->db->where('hapus', '0');
    $this->db->order_by('tgl_isi', 'DESC');
    $result = $this->db->get('kk_gejala_stres');
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
    $sql = $this->db->set($data)->get_compiled_insert('kk_gejala_stres');
    $this->db->query($sql);
  }

  public function update($id_kk, $id_gejala_stres, $data = array())
  {
    $this->db->where('id_kk', $id_kk);
    $this->db->where('id_gejala_stres', $id_gejala_stres);
    $sql = $this->db->set($data)->get_compiled_update('kk_gejala_stres');
    $this->db->query($sql);
  }

  public function destroy_by_status($id_kk, $id_gejala_stres)
  {
    $this->db->where('id_kk', $id_kk);
    $this->db->where('id_gejala_stres', $id_gejala_stres);
    $sql = $this->db->set(array('hapus' => '1'))->get_compiled_update('kk_gejala_stres');
    $this->db->query($sql);
  }

  public function sum_skor_kuesioner($id_kk, $id_gejala_stres)
  {
    $this->db->select('no_01+no_02+no_03+no_04+no_05+no_06+no_07+no_08+no_09+no_10+no_11+no_12+no_13+no_14+no_15 as skor', FALSE);
    $this->db->from('kk_gejala_stres');
    $this->db->where('id_kk', $id_kk);
    $this->db->where('id_gejala_stres', $id_gejala_stres);
    $this->db->where('hapus', '0');
    $this->db->limit(1);
    $result = $this->db->get();
    return $result->result_array();
  }
}