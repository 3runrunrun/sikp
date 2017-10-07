<?php 

/**
* 
*/
class M_r_kes_keluarga extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function show($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_kk', $id_kk);
    $this->db->where('hapus', '0');
    $this->db->order_by('tgl_isi', 'DESC');
    $result = $this->db->get('kk_riwayat_kes_kel');
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

  public function get_data_by_kk_id_riwayat($id_kk, $id_riwayat_kes_kel, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_kk', $id_kk);
    $this->db->where('id_riwayat_kes_kel', $id_riwayat_kes_kel);
    $result = $this->db->get('kk_riwayat_kes_kel');
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

  public function get_data_latest_by_kk($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_kk', $id_kk);
    $this->db->where('hapus', '0');
    $this->db->order_by('tgl_isi', 'DESC');
    $this->db->limit(1);
    $result = $this->db->get('kk_riwayat_kes_kel');
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

  public function count_merokok_by_kk($id_kk, $id_riwayat_kes_kel)
  {
    $condition = array('1', '2', '3');
    $this->db->where('id_kk', $id_kk);
    $this->db->where('id_riwayat_kes_kel', $id_riwayat_kes_kel);
    $this->db->where('hapus', '0');
    $this->db->where_in('merokok', $condition);
    $this->db->group_by('id_kk');
    $this->db->group_by('id_riwayat_kes_kel');
    $result = $this->db->get('kk_riwayat_kes_kel');
    return $result->num_rows();
  }

  public function count_jamu_by_kk($id_kk, $id_riwayat_kes_kel)
  {
    $condition = array('1', '2');
    $this->db->where('id_kk', $id_kk);
    $this->db->where('id_riwayat_kes_kel', $id_riwayat_kes_kel);
    $this->db->where('hapus', '0');
    $this->db->where_in('jamu', $condition);
    $this->db->group_by('id_kk');
    $this->db->group_by('id_riwayat_kes_kel');
    $result = $this->db->get('kk_riwayat_kes_kel');
    return $result->num_rows();
  }

  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('kk_riwayat_kes_kel');
    $this->db->query($sql);
  }

  public function update($id_kk, $id_riwayat_kes_kel, $no_bpjs, $data = array())
  {
    $this->db->where('id_kk', $id_kk);
    $this->db->where('id_riwayat_kes_kel', $id_riwayat_kes_kel);
    $this->db->where('no_bpjs', $no_bpjs);
    $sql = $this->db->set($data)->get_compiled_update('kk_riwayat_kes_kel');
    $this->db->query($sql);
  }

  public function destroy($id_kk, $id_riwayat_kes_kel)
  {
    $this->db->where('id_kk', $id_kk);
    $this->db->where('id_riwayat_kes_kel', $id_riwayat_kes_kel);
    $sql = $this->db->set(array('hapus' => '1'))->get_compiled_update('kk_riwayat_kes_kel');
    $this->db->query($sql);
  }
}