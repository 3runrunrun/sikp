<?php 

/**
* 
*/
class M_riwayat_pekerjaan extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function if_pekerjaan_utama_exist($no_bpjs)
  {
    $exist = FALSE;
    $this->db->select('id_riwayat_pekerjaan');
    $this->db->from('pas_riwayat_pekerjaan');
    $this->db->where('no_bpjs', $no_bpjs);
    $this->db->where('pekerjaan_utama', '1');
    $this->db->where('hapus', '0');
    $result = $this->db->get();
    if (! $result) {
      $ret_val = array(
        'status' => 'error',
        'data' => $this->db->error()
        );
    } else {
      if ($result->num_rows() != 0) {
        $exist = TRUE;
      }
      $ret_val = array(
        'status' => 'success',
        'exist' => $exist,
        'data' => $result->result_array()
        );
    }

    return $ret_val;
  }

  public function count_pabrik_by_kk($id_kk)
  {
    $this->db->from('pas_riwayat_pekerjaan a');
    $this->db->join('pas_kk b', 'a.no_bpjs = b.no_bpjs');
    $this->db->where('b.id_kk', $id_kk);
    $this->db->like('a.pekerjaan', 'pabrik', 'both');
    $this->db->where('a.sampai_tahun', date('Y'));
    $this->db->where('a.hapus', '0');
    $this->db->where('b.hapus', '0');
    $this->db->group_by('a.no_bpjs');
    $result = $this->db->get();
    return $result->num_rows();
  }

  public function get_data()
  {
    # code...
  }

  public function show_by_identitas($no_bpjs)
  {
    # code...
  }

  public function store($data = array())
  {
    // print_r($data);
    $id_riwayat_pekerjaan = NULL;
    if ($data['pekerjaan_utama'] == '1') {
      $if_pekerjaan_utama_exist = $this->if_pekerjaan_utama_exist($data['no_bpjs']);
      // print_r($if_pekerjaan_utama_exist);
      if ($if_pekerjaan_utama_exist['status'] == 'success') {
        $id_riwayat_pekerjaan = $if_pekerjaan_utama_exist['data'][0]['id_riwayat_pekerjaan'];
        $this->update($id_riwayat_pekerjaan, array('pekerjaan_utama' => '0'));
      } 
    }     
    $sql = $this->db->set($data)->get_compiled_insert('pas_riwayat_pekerjaan');
    $this->db->query($sql);
  }

  public function update($id_riwayat_pekerjaan, $data = array())
  {
    $this->db->where('id_riwayat_pekerjaan', $id_riwayat_pekerjaan);
    $sql = $this->db->set($data)->get_compiled_update('pas_riwayat_pekerjaan');
    // echo $sql;
    $this->db->query($sql);
  }
}