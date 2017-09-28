<?php 

/**
* 
*/
class M_obat_keluar extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function get_data_obat($column)
  {
    $this->db->select($column);
    $this->db->from('poli_obat_keluar a');
    $this->db->join('poli_obat b', 'a.id_obat = b.id_obat');
    $this->db->where('a.hapus', '0');
    $this->db->where('b.hapus', '0');
    $result = $this->db->get();
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

  public function get_data($column = '*')
  {
    $this->db->select($column);
    $this->db->where('hapus', '0');
    $result = $this->db->get('poli_obat_keluar');
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

  public function get_data_by_range($from, $to)
  {
    $sql = 'select a.id_obat_keluar, a.id_resep_obat, a.id_obat, b.nama, a.jumlah_keluar, b.satuan, a.tgl_keluar
      from poli_obat_keluar a
      join poli_obat b
        on a.id_obat = b.id_obat
      where a.hapus = \'0\'
        and a.tgl_keluar between ? and ?';
    $bind_param = array($from, $to);
    $result = $this->db->query($sql, $bind_param);
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
    $sql = $this->db->set($data)->get_compiled_insert('poli_obat_keluar');
    $this->db->query($sql);
  }
}