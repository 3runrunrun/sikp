<?php 

/**
* 
*/
class M_obat_keluar_bulan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function show_if_any($id_obat, $bulan, $tahun)
  {
    $this->db->where('id_obat', $id_obat);
    $this->db->where('bulan', $bulan);
    $this->db->where('tahun', $tahun);
    $this->db->where('hapus', '0');
    $result = $this->db->get('poli_obat_keluar_bulan');
    return $result->num_rows();
  }

  public function get_data_bulan($column = '*')
  {
    $this->db->select($column);
    $this->db->where('hapus', '0');
    $this->db->group_by('bulan');
    $this->db->group_by('tahun');
    $result = $this->db->get('poli_obat_keluar_bulan');
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

  public function get_data_by_range($from, $to, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('poli_obat_keluar_bulan a');
    $this->db->join('poli_obat b', 'a.id_obat = b.id_obat');
    $this->db->where('DATE_FORMAT(STR_TO_DATE(CONCAT(a.bulan,\'-\',a.tahun), \'%m-%Y\'), \'%Y-%m\')  >=', $from);
    $this->db->where('DATE_FORMAT(STR_TO_DATE(CONCAT(a.bulan,\'-\',a.tahun), \'%m-%Y\'), \'%Y-%m\')  <=', $to);
    $this->db->where('a.hapus', '0');
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

  public function store($data = array())
  {
    $sql = $this->db->set($data)->get_compiled_insert('poli_obat_keluar_bulan');
    $this->db->query($sql);
  }

  public function update_laporan($id_obat, $bulan, $tahun, $jumlah, $flag)
  {
    if ($flag == 'masuk') {
      $this->db->set('jml_masuk', "jml_masuk + $jumlah", FALSE);
      $this->db->set('sisa', "sisa + $jumlah", FALSE);
    } elseif ($flag == 'keluar') {
      $this->db->set('jml_keluar', "jml_keluar + $jumlah", FALSE);
      $this->db->set('sisa', "sisa - $jumlah", FALSE);
    }
    $this->db->where('id_obat', $id_obat);
    $this->db->where('bulan', $bulan);
    $this->db->where('tahun', $tahun);
    $sql = $this->db->get_compiled_update('poli_obat_keluar_bulan');
    $this->db->query($sql);
  }

  public function update_undo_laporan($id_obat, $bulan, $tahun, $jumlah, $flag)
  {
    if ($flag == 'masuk') {
      $this->db->set('jml_masuk', "jml_masuk - $jumlah", FALSE);
      $this->db->set('sisa', "sisa - $jumlah", FALSE);
    } elseif ($flag == 'keluar') {
      $this->db->set('jml_keluar', "jml_keluar - $jumlah", FALSE);
      $this->db->set('sisa', "sisa + $jumlah", FALSE);
    }
    $this->db->where('id_obat', $id_obat);
    $this->db->where('bulan', $bulan);
    $this->db->where('tahun', $tahun);
    $sql = $this->db->get_compiled_update('poli_obat_keluar_bulan');
    $this->db->query($sql);
  }

  public function destroy($id_obat, $bulan, $tahun)
  {
    $this->db->where('id_obat', $id_obat);
    $this->db->where('bulan', $bulan);
    $this->db->where('tahun', $tahun);
    $sql = $this->db->set('hapus', '1')->get_compiled_update('poli_obat_keluar_bulan');
    $this->db->query($sql);
  }
}