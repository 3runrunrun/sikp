<?php 

/**
* 
*/
class M_data_perkawinan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  /**
   * join with pas_identitas, pas_kk, kk_data_perkawinan
   * @param  string $value [description]
   * @return [type]        [description]
   */
  public function get_data_identitas_kk_perkawinan($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('kk_anggota_keluarga a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->join('pas_kk c', 'a.no_bpjs = c.no_bpjs', 'left');
    $this->db->join('kk_data_perkawinan d', 'a.no_bpjs = d.no_bpjs', 'left');
    $this->db->where('a.id_kk', $id_kk);
    $this->db->where_not_in('a.hubungan_keluarga', array('4'));
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

  /**
   * dipanggil di edit_perkawinan
   * join with pas_identitas, kk_anggota_keluarga
   * @param  [type] $id_kk  [description]
   * @param  string $column [description]
   * @return [type]         [description]
   */
  public function get_data_pasangan($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('kk_data_perkawinan a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->join('kk_anggota_keluarga c', 'a.no_bpjs = c.no_bpjs');
    $this->db->where('a.id_kk', $id_kk);
    $this->db->where('c.hubungan_keluarga', '2');
    $this->db->where('a.hapus', '0');
    $this->db->where('b.hapus', '0');
    $this->db->where('c.hapus', '0');
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

  public function get_perkawinan_terakhir($no_bpjs)
  {
    $this->db->select('perkawinan_ke');
    $this->db->from('pas_kk a');
    $this->db->join('kk_data_perkawinan b', 'a.id_kk = b.id_kk');
    $this->db->where('a.no_bpjs', $no_bpjs);
    $this->db->order_by('b.perkawinan_ke', 'desc');
    $this->db->limit(1);
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

  public function show($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('id_kk', $id_kk);
    $result = $this->db->get('kk_data_perkawinan');
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

  public function store($data_perkawinan = array())
  {
    $sql = $this->db->set($data_perkawinan)->get_compiled_insert('kk_data_perkawinan');
    $this->db->query($sql);
  }

  public function update($data_insert = array(), $data_update = array())
  {
    $str = $this->db->insert_string('kk_data_perkawinan', $data_insert);
    $on_update = ' ON DUPLICATE KEY UPDATE perkawinan_ke = ?, umur_pasangan = ?, status_kawin = ?';
    $sql = $str . $on_update;
    $this->db->query($sql, array($data_update['perkawinan_ke'], $data_update['umur_pasangan'], $data_update['status_kawin']));
  }

  public function ubah_data_perkawinan($id_data_perkawinan, $data_perkawinan_baru = array())
  {
    $this->db->where('id_data_perkawinan', $id_data_perkawinan);
    $result = $this->db->update('pas_data_perkawinan', $data_perkawinan_baru);
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

  public function hapus_data_perkawinan($data_perkawinan = array())
  {
    $result = $this->db->delete('pas_data_perkawinan', $data_perkawinan);
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