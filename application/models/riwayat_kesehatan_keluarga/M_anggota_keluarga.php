<?php 

/**
* 
*/
class M_anggota_keluarga extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function count_by_kk($id_kk)
  {
    $this->db->where('id_kk', $id_kk);
    $this->db->where('hapus', '0');
    $result = $this->db->get('kk_anggota_keluarga');
    return $result->num_rows();
  }

  /**
   * dipanggil di edit_perkawinan
   * join with identitas
   * @param  [type] $id_kk  [description]
   * @param  string $column [description]
   * @return [type]         [description]
   */
  public function get_data_anggota_keluarga($id_kk, $column = '*')
  {
    $this->db->select($column);
    $this->db->from('kk_anggota_keluarga a');
    $this->db->join('pas_identitas b', 'a.no_bpjs = b.no_bpjs');
    $this->db->where('a.id_kk', $id_kk);
    $this->db->where('a.hubungan_keluarga', '3');
    $this->db->or_where('a.hubungan_keluarga', '4');
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
   * join with pas_identitas
   * @param  [type] $id_kk [description]
   * @param  [type] $col   [description]
   * @return [type]        [description]
   */
  public function get_data_identitas($id_kk)
  {
    $bind_param = array($id_kk, $id_kk, $id_kk);
    $sql = "select a.id_kk, b.no_bpjs, b.nama, b.jenis_kelamin, b.tgl_lahir, b.hidup, c.domisili_serumah, c.hubungan_keluarga
      from pas_kk a
      join pas_identitas b
        on a.no_bpjs = b.no_bpjs
      join kk_anggota_keluarga c
        on a.no_bpjs = c.no_bpjs
      where a.id_kk = ?
        and a.hapus = '0' union
      select a.id_kk, b.no_bpjs, b.nama, b.jenis_kelamin, b.tgl_lahir, b.hidup, c.domisili_serumah, c.hubungan_keluarga
      from kk_data_perkawinan a
      join pas_identitas b
        on a.no_bpjs = b.no_bpjs
      join kk_anggota_keluarga c
        on a.no_bpjs =  c.no_bpjs
      where a.id_kk = ?
        and a.status_kawin != '0'
        and a.hapus = '0' union
      select a.id_kk, b.no_bpjs, b.nama, b.jenis_kelamin, b.tgl_lahir, b.hidup, a.domisili_serumah, a.hubungan_keluarga
      from kk_anggota_keluarga a
      join pas_identitas b
        on a.no_bpjs = b.no_bpjs
      where a.id_kk = ?
        and a.hubungan_keluarga not in ('1','2')
        and a.hapus = '0'
        and b.hapus = '0'";
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

  public function store($data_anggota_keluarga = array())
  {
    $sql = $this->db->set($data_anggota_keluarga)->get_compiled_insert('kk_anggota_keluarga');
    $this->db->query($sql);
  }

  public function update($data_insert = array(), $data_update = array())
  {
    $str = $this->db->insert_string('kk_anggota_keluarga', $data_insert);
    $on_update = ' ON DUPLICATE KEY UPDATE domisili_serumah = ?, hubungan_keluarga = ?, perkawinan_ke = ?';
    $sql = $str . $on_update;
    $this->db->query($sql, array($data_update['domisili_serumah'], $data_update['hubungan_keluarga'], $data_update['perkawinan_ke']));
  }

  public function destroy($id_kk, $no_bpjs)
  {
    $this->db->where('id_kk', $id_kk);
    $this->db->where('no_bpjs', $no_bpjs);
    $sql = $this->db->set(array('hapus' => '1'))->get_compiled_update('kk_anggota_keluarga');
    $this->db->query($sql);
  }

  public function count_anggota_keluarga($id_kk)
  {
    $this->db->where('id_kk', $id_kk);
    $result = $this->db->get('kk_anggota_keluarga');
    if ( ! $result) {
      $ret_val = 'error';
    } else {
      $ret_val = $result->num_rows();
    }
    
    return $ret_val;
  }

  public function show_by_no_bpjs($no_bpjs, $column = '*')
  {
    $this->db->select($column);
    $this->db->where('no_bpjs', $no_bpjs);
    $result = $this->db->get('kk_anggota_keluarga');
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


}