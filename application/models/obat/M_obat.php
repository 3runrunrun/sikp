<?php 

/**
* 
*/
class M_obat extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function show($id_obat, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_obat', $id_obat);
    $this->db->where('hapus', '0');
    $result = $this->db->get('poli_obat');
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
    $result = $this->db->get('poli_obat');
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
    $sql = $this->db->set($data)->get_compiled_insert('poli_obat');
    $this->db->query($sql);
  }

  public function update($id_obat, $data = array())
  {
    $this->db->where('id_obat', $id_obat);
    $sql = $this->db->set($data)->get_compiled_update('poli_obat');
    $this->db->query($sql);
  }

  public function update_persediaan($id_obat, $flag, $jumlah)
  {
    if ($flag == 'tambah') {
      $this->db->set('jumlah', "jumlah + $jumlah", FALSE);
    } elseif ($flag == 'kurang') {
      $this->db->set('jumlah', "jumlah - $jumlah", FALSE);
    }
    $this->db->where('id_obat', $id_obat);
    $sql = $this->db->get_compiled_update('poli_obat');
    $this->db->query($sql);
  }
  
  public function destroy($id_obat)
  {
    $this->db->where('id_obat', $id_obat);
    $sql = $this->db->set('hapus', '1')->get_compiled_update('poli_obat');
    $this->db->query($sql);
  }
}