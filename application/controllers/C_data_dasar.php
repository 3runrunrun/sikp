<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_data_dasar extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  private function parse_view($page_content = NULL)
  {
    $data = array(
      'page_title' => 'Formulir Data Dasar Kesehatan Keluarga',
      'css_framework' => $this->load->view('css_framework/head_form', '', TRUE), 
      'page_header' => $this->load->view('headers/main_header', '', TRUE), 
      'page_sidebar' => $this->load->view('sidebars/main_sidebar', '', TRUE), 
      'page_content' => $page_content,
      'page_footer' => $this->load->view('footers/main_footer', '', TRUE), 
      'js_framework' => $this->load->view('js_framework/js_form', '', TRUE), 
      );
    $this->parser->parse('home', $data);
  }

  private function commit_trans($uri_param = NULL)
  {
    $this->db->trans_commit();
    $url = base_url() . 'formulir-data-dasar/' . $uri_param;
    header("Location: $url");
  }

  private function id_generator($prefix)
  {
    $micro_time = microtime();
    $ex_mt = explode(' ', $micro_time);
    $sbstr_mt = substr($ex_mt[0], 5, 3);
    $id = $prefix . '-' . date('ymdHis') . $sbstr_mt;
    return $id;
  }

  public function create($dt_kk = NULL)
  {
    $view_data['provinsi'] = $this->M_provinsi->get_data();
    $view_data['kabupaten'] = $this->M_kabupaten->get_data();
    $view_data['kecamatan'] = $this->M_kecamatan->get_data();
    $view_data['kelurahan'] = $this->M_kelurahan->get_data();
    $view_data['pasien'] = $this->M_pasien_identitas->get_data();
    if ($dt_kk !== NULL) {
      $view_data['id_kk'] = $this->M_kk->show_like('id_kk', $dt_kk);
    } 
    $page_content = $this->load->view('data_dasar/formulir_data_dasar', $view_data,TRUE);
    $this->parse_view($page_content);
  }

  public function store_identitas_pasien()
  {
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $view_data['provinsi'] = $this->M_provinsi->get_data();
      $view_data['kabupaten'] = $this->M_kabupaten->get_data();
      $view_data['kecamatan'] = $this->M_kecamatan->get_data();
      $view_data['kelurahan'] = $this->M_kelurahan->get_data();
      $view_data['pasien'] = $this->M_pasien_identitas->get_data();
      $page_content = $this->load->view('data_dasar/formulir_data_dasar', $view_data, TRUE);
    } else {
      $data_pasien = $this->input->post();
      $result = $this->M_pasien_identitas->store($data_pasien);
      if ($result['status'] == 'error') {
        $view_data = $this->eh->db_error($result['data']);
        $template = $this->load->view('errors/error_db', '', TRUE);
        $template_data = array('error_msg' => $view_data);
        $page_content = $this->parser->parse_string($template, $template_data, TRUE);
      } else {
        $url = base_url() . 'formulir-data-dasar';
        header("Location: $url");
      }
    }
    $this->parse_view($page_content);
  }

  public function store_data_perkawinan()
  {
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $view_data['provinsi'] = $this->M_provinsi->get_data();
      $view_data['kabupaten'] = $this->M_kabupaten->get_data();
      $view_data['kecamatan'] = $this->M_kecamatan->get_data();
      $view_data['kelurahan'] = $this->M_kelurahan->get_data();
      $view_data['pasien'] = $this->M_pasien_identitas->get_data();
      $page_content = $this->load->view('data_dasar/formulir_data_dasar', $view_data, TRUE);
    } else {
      $id_kk = $this->id_generator('KK');
      $psg_no_bpjs = $this->input->post('psg_no_bpjs[]');
      $hubungan_keluarga = $this->input->post('psg_hubungan_keluarga[]');
      $domisili_serumah = $this->input->post('psg_domisili_serumah[]');
      $status_kawin = $this->input->post('psg_status_kawin[]');
      $perkawinan_ke = $this->input->post('psg_perkawinan_ke[]');
      $umur_pasangan = $this->input->post('psg_umur_pasangan[]');

      // DATA KK
      $ar_kk['id_kk'] = $id_kk;
      $ar_kk['no_bpjs'] = $this->input->post('psg_no_bpjs[0]');
      $ar_kk['no_telp'] = $this->input->post('psg_no_telp');

      // DATA PASANGAN
      $ar_pasangan['id_data_perkawinan'] = $this->id_generator('KWN');
      $ar_pasangan['id_kk'] = $id_kk;
      $ar_pasangan['no_bpjs'] = $this->input->post('psg_no_bpjs[0]');
      $ar_pasangan['perkawinan_ke'] = $this->input->post('psg_perkawinan_ke[0]');
      $ar_pasangan['umur_pasangan'] = $this->input->post('psg_umur_pasangan[0]');
      $ar_pasangan['status_kawin'] = $this->input->post('psg_status_kawin[0]');
      
      // TRANSACTION
      $this->db->trans_begin();
      $this->M_kk->store($ar_kk);
      $this->M_data_perkawinan->store($ar_pasangan);
      // DATA KELUARGA
      $ar_kk = array();
      foreach ($psg_no_bpjs as $key => $value) {
        $ar_ak['id_kk'] = $id_kk;
        $ar_ak['no_bpjs'] = $psg_no_bpjs[$key];
        $ar_ak['domisili_serumah'] = $domisili_serumah[$key];
        $ar_ak['hubungan_keluarga'] = $hubungan_keluarga[$key];
        $this->M_anggota_keluarga->store($ar_ak);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $view_data = $this->eh->db_error($result['data']);
        $template = $this->load->view('errors/error_db', '', TRUE);
        $template_data = array('error_msg' => $view_data);
        $page_content = $this->parser->parse_string($template, $template_data, TRUE);
      } else {
        $this->commit_trans($id_kk);
      }
    }
    $this->parse_view($page_content);
  }

  public function store_anggota_keluarga()
  {
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $view_data['provinsi'] = $this->M_provinsi->get_data();
      $view_data['kabupaten'] = $this->M_kabupaten->get_data();
      $view_data['kecamatan'] = $this->M_kecamatan->get_data();
      $view_data['kelurahan'] = $this->M_kelurahan->get_data();
      $view_data['pasien'] = $this->M_pasien_identitas->get_data();
      $page_content = $this->load->view('data_dasar/formulir_data_dasar', $view_data, TRUE);
    } else {
      $ar_ak = array();
      // INITIALIZE VAR
      $id_kk = $this->input->post('id_kk');
      $no_bpjs = $this->input->post('ak_no_bpjs[]');
      $domisili_serumah = $this->input->post('ak_domisili_serumah[]');
      $hubungan_keluarga = $this->input->post('ak_hubungan_keluarga[]');

      // $dt_kk = explode('-', $id_kk);

      // TRANSACTION
      $this->db->trans_begin();
      foreach ($no_bpjs as $key => $value) {
        $ar_ak['id_kk'] = $id_kk;
        $ar_ak['no_bpjs'] = $no_bpjs[$key];
        $ar_ak['domisili_serumah'] = $domisili_serumah[$key];
        $ar_ak['hubungan_keluarga'] = $hubungan_keluarga[$key];
        $this->M_anggota_keluarga->store($ar_ak);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $view_data = $this->eh->db_error($result['data']);
        $template = $this->load->view('errors/error_db', '', TRUE);
        $template_data = array('error_msg' => $view_data);
        $page_content = $this->parser->parse_string($template, $template_data, TRUE);
      } else {
        $this->commit_trans($id_kk);
      }
    }
    $this->parse_view($page_content);
  }

  public function store_ekonomi()
  {
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $view_data['provinsi'] = $this->M_provinsi->get_data();
      $view_data['kabupaten'] = $this->M_kabupaten->get_data();
      $view_data['kecamatan'] = $this->M_kecamatan->get_data();
      $view_data['kelurahan'] = $this->M_kelurahan->get_data();
      $view_data['pasien'] = $this->M_pasien_identitas->get_data();
      $page_content = $this->load->view('data_dasar/formulir_data_dasar', $view_data, TRUE);
    } else {
      // INITIALIZE VAR
      $id_kk = $this->input->post('id_kk');
      // STORE DATA
      $result = $this->M_ekonomi->store($this->input->post());
      if ($result['status'] == 'error') {
        $view_data = $this->eh->db_error($result['data']);
        $template = $this->load->view('errors/error_db', '', TRUE);
        $template_data = array('error_msg' => $view_data);
        $page_content = $this->parser->parse_string($template, $template_data, TRUE);
      } else {
        $url = base_url() . 'formulir-data-dasar/' . $id_kk;
        header("Location: $url");
      }
      echo $result['status'];
    }
    $this->parse_view($page_content);
  }

  public function store_perilaku()
  {
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $view_data['provinsi'] = $this->M_provinsi->get_data();
      $view_data['kabupaten'] = $this->M_kabupaten->get_data();
      $view_data['kecamatan'] = $this->M_kecamatan->get_data();
      $view_data['kelurahan'] = $this->M_kelurahan->get_data();
      $view_data['pasien'] = $this->M_pasien_identitas->get_data();
      $page_content = $this->load->view('data_dasar/formulir_data_dasar', $view_data, TRUE);
    } else {
      // INITIALIZE LOCAL VAR
      $id_kk = $this->input->post('id_kk');
      $post_var = $this->input->post();
      $ar_kesehatan = array();
      $ar_keselamatan = array();

      // REPOPULATE VAR
      foreach ($post_var as $key => $value) {
        if ($key == 'id_kk') {
          $ar_kesehatan[$key] = $value;
          $ar_keselamatan[$key] = $value;
        }
        if ($key != 'pengguna_sepeda_motor' && $key != 'manula_sendirian') {
          $ar_kesehatan[$key] = $value;
        } else {
          $ar_keselamatan[$key] = $value;
        }      
      }

      // STORE DATA
      $this->db->trans_begin();
      $this->M_perilaku_kesehatan->store($ar_kesehatan);
      $this->M_perilaku_keselamatan->store($ar_keselamatan);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $view_data = $this->eh->db_error($result['data']);
        $template = $this->load->view('errors/error_db', '', TRUE);
        $template_data = array('error_msg' => $view_data);
        $page_content = $this->parser->parse_string($template, $template_data, TRUE);
      } else {
        $this->commit_trans($id_kk);
      }
    }
    $this->parse_view($page_view);
  }

  public function store_riwayat_kes()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</li></ul></div>');
    if ($this->form_validation->run() == FALSE) {
      $view_data['provinsi'] = $this->M_provinsi->get_data();
      $view_data['kabupaten'] = $this->M_kabupaten->get_data();
      $view_data['kecamatan'] = $this->M_kecamatan->get_data();
      $view_data['kelurahan'] = $this->M_kelurahan->get_data();
      $view_data['pasien'] = $this->M_pasien_identitas->get_data();
      $page_content = $this->load->view('data_dasar/formulir_data_dasar', $view_data, TRUE);
    } else {
      // INITIALIZE VAR
      $id_kk = $this->input->post('id_kk');
      $id_riwayat_kes_kel = $this->id_generator('KSKL');

      $this->db->trans_begin();
      $this->riwayat_kes_kel(
        $this->input->post('id_kk'),
        $id_riwayat_kes_kel,
        $this->input->post()
        );
      // riwayat-1-bulan
      if ($this->input->post('sb_no_bpjs[]') !== NULL) {
        $this->riwayat_satu_bulan(
          $this->input->post('id_kk'),
          $this->input->post('sb_no_bpjs[]'),
          $this->input->post('sb_jenis_penyakit[]')
          );
      }     
      if ($this->input->post('tb_no_bpjs[]') !== NULL) {
        $this->riwayat_tiga_bulan(
          $this->input->post('id_kk'),
          $this->input->post('tb_no_bpjs[]'),
          $this->input->post('tb_jenis_penyakit[]')
          );
      }
      if ($this->input->post('st_no_bpjs[]') !== NULL) {
        $this->riwayat_satu_tahun(
          $this->input->post('id_kk'),
          $this->input->post('st_no_bpjs[]'),
          $this->input->post('st_jenis_penyakit[]')
          );
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $view_data = $this->eh->db_error($result['data']);
        $template = $this->load->view('errors/error_db', '', TRUE);
        $template_data = array('error_msg' => $view_data);
        $page_content = $this->parser->parse_string($template, $template_data, TRUE);
      } else {
        $this->commit_trans($id_kk);
      }
    }
    $this->parse_view($page_content);
  }

  public function store_gejala_stres()
  {
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $view_data['provinsi'] = $this->M_provinsi->get_data();
      $view_data['kabupaten'] = $this->M_kabupaten->get_data();
      $view_data['kecamatan'] = $this->M_kecamatan->get_data();
      $view_data['kelurahan'] = $this->M_kelurahan->get_data();
      $view_data['pasien'] = $this->M_pasien_identitas->get_data();
      $page_content = $this->load->view('data_dasar/formulir_data_dasar', $view_data, TRUE);
    } else {
      // INITIALIZE LOCAL VAR
      $id_kk = $this->input->post('id_kk');
      $post_var = $this->input->post();
      $post_var['id_gejala_stres'] = $this->id_generator('ST');

      // STORE DATA
      $result = $this->M_gejala_stres->store($post_var);
      if ($result['status'] == 'error') {
        $view_data = $this->eh->db_error($result['data']);
        $template = $this->load->view('errors/error_db', '', TRUE);
        $template_data = array('error_msg' => $view_data);
        $page_content = $this->parser->parse_string($template, $template_data, TRUE);
      } else {
        $url = base_url() . 'formulir-data-dasar/' . $id_kk;
        header("Location: $url");
      }
    }
    $this->parse_view($page_content);
  }

  ///////////////////////
  // RIWAYAT KESEHATAN //
  ///////////////////////

  public function riwayat_kes_kel($id_kk, $id_riwayat_kes_kel, $data = array())
  {
    // INITIALIZE VAR
    $no_bpjs = $this->M_kk->show_like('no_bpjs', $id_kk);
    if ($no_bpjs['status'] == 'error') {
      $view_data = $this->eh->db_error($result['data']);
      $template = $this->load->view('errors/error_db', '', TRUE);
      $template_data = array('error_msg' => $view_data);
      return $page_content = $this->parser->parse_string($template, $template_data, TRUE);
    } else {
      $data_riwayat = array(
        'id_kk' => $id_kk,
        'id_riwayat_kes_kel' => $id_riwayat_kes_kel,
        'no_bpjs' => $no_bpjs['data'][0]['no_bpjs'],
        'batuk' => $data['batuk'],
        'asma' => $data['asma'],
        'masalah_kesehatan' => $data['masalah_kesehatan'],
        'masalah_keturunan' => $data['masalah_keturunan'],
        'sakit_keras' => $data['sakit_keras'],
        'kecelakaan_kerja' => $data['kecelakaan_kerja'],
        'merokok' => $data['merokok'],
        'jamu' => $data['jamu'],
        'alkohol' => $data['alkohol'],
        'kopi' => $data['kopi'],
        'obat' => $data['obat'],
        'm_dingin' => $data['m_dingin'],
        'peliharaan' => $data['peliharaan'],
        'olahraga' => $data['olahraga']
        );

      // STORE DATA
      $this->M_r_kes_keluarga->store($data_riwayat);

      if ($this->input->post('batuk') == '1') {
        $this->batuk($id_kk, $id_riwayat_kes_kel, $this->input->post('batuk_no_bpjs[]'));
      }
      if ($this->input->post('asma') == '1') {
        $this->asma($id_kk, $id_riwayat_kes_kel, $this->input->post('asma_no_bpjs[]'));
      }
      if ($this->input->post('masalah_kesehatan') == '1') {
        $this->masalah_kesehatan($id_kk, $id_riwayat_kes_kel, $this->input->post('maskes_no_bpjs[]'), $this->input->post('masalah_kes[]'));
      }
      if ($this->input->post('masalah_keturunan') == '1') {
        $this->masalah_keturunan($id_kk, $id_riwayat_kes_kel, $this->input->post('masket_no_bpjs[]'), $this->input->post('jenis_masalah_keturunan[]'));
      }
      if ($this->input->post('sakit_keras') == '1') {
        $this->sakit_keras($id_kk, $id_riwayat_kes_kel, $this->input->post('jenis_sakit_keras[]'), $this->input->post('tahun_sakit[]'));
      }
      if ($this->input->post('kecelakaan_kerja') == '1') {
        $this->sakit_keras($id_kk, $id_riwayat_kes_kel, $this->input->post('jenis_kecelakaan_kerja[]'), $this->input->post('tahun_kejadian[]'), $this->input->post('jenis_kelainan[]'), $this->input->post('durasi_perawatan[]'));
      }
      if ($this->input->post('merokok') == '1' || $this->input->post('merokok') == '2') {
        $this->merokok($id_kk, $id_riwayat_kes_kel, $this->input->post('durasi_merokok'), $this->input->post('batang_per_hari'), $this->input->post('kretek_filter'));
      } elseif ($this->input->post('merokok') == '3') {
        $this->merokok($id_kk, $id_riwayat_kes_kel, $this->input->post('durasi_merokok'), $this->input->post('batang_per_hari'), $this->input->post('kretek_filter'), $this->input->post('durasi_berhenti'));
      }
      if ($this->input->post('jamu') == '1' || $this->input->post('jamu') == '2') {
        $this->jamu($id_kk, $id_riwayat_kes_kel, $this->input->post('jenis_jamu[]'), $this->input->post('jamu_per_minggu[]'));
      }
      if ($this->input->post('alkohol') == '1' || $this->input->post('alkohol') == '2') {
        $this->alkohol($id_kk, $id_riwayat_kes_kel, $this->input->post('durasi'));
      }
      if ($this->input->post('kopi') == '1' || $this->input->post('kopi') == '2') {
        $this->kopi($id_kk, $id_riwayat_kes_kel, $this->input->post('gelas_per_hari'));
      }
      if ($this->input->post('obat') == '1') {
        $this->obat($id_kk, $id_riwayat_kes_kel, $this->input->post('jenis_obat[]'));
      }
      if ($this->input->post('olahraga') == '1') {
        $this->olahraga($id_kk, $id_riwayat_kes_kel, $this->input->post('jenis_olahraga[]'), $this->input->post('jumlah_per_minggu[]'), $this->input->post('olahraga_keluarga[]'));
      }
    }
  }

  /**
   * [riwayat_satu_bulan description]
   * @param  string $id_kk
   * @param  array  $no_bpjs
   * @param  array  $jenis_penyakit
   * @return void
   */
  private function riwayat_satu_bulan($id_kk, $no_bpjs = array(), $jenis_penyakit = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($no_bpjs as $key => $value) {
      $id_riwayat = $this->id_generator('SBLN');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_1bulan'] = $id_riwayat;
      $data_riwayat['no_bpjs'] = $no_bpjs[$key];
      $data_riwayat['jenis_penyakit'] = $jenis_penyakit[$key];
      $this->M_r_satu_bulan->store($data_riwayat);
    }
  }

  /**
   * [riwayat_tiga_bulan description]
   * @param  string $id_kk
   * @param  array  $no_bpjs
   * @param  array  $jenis_penyakit
   * @return void
   */
  private function riwayat_tiga_bulan($id_kk, $no_bpjs = array(), $jenis_penyakit = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($no_bpjs as $key => $value) {
      $id_riwayat = $this->id_generator('TBLN');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_3bulan'] = $id_riwayat;
      $data_riwayat['no_bpjs'] = $no_bpjs[$key];
      $data_riwayat['jenis_penyakit'] = $jenis_penyakit[$key];
      $this->M_r_tiga_bulan->store($data_riwayat);
    }
  }

  private function riwayat_satu_tahun($id_kk, $no_bpjs = array(), $jenis_penyakit = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($no_bpjs as $key => $value) {
      $id_riwayat = $this->id_generator('STHN');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_1tahun'] = $id_riwayat;
      $data_riwayat['no_bpjs'] = $no_bpjs[$key];
      $data_riwayat['jenis_penyakit'] = $jenis_penyakit[$key];
      $this->M_r_satu_tahun->store($data_riwayat);
    }
  }

  private function batuk($id_kk, $id_riwayat_kes_kel, $no_bpjs = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($no_bpjs as $key => $value) {
      $id_riwayat = $this->id_generator('BTK');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_batuk'] = $id_riwayat;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
      $data_riwayat['no_bpjs'] = $no_bpjs[$key];
      $this->M_r_batuk->store($data_riwayat);
    }
  }

  private function asma($id_kk, $id_riwayat_kes_kel, $no_bpjs = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($no_bpjs as $key => $value) {
      $id_riwayat = $this->id_generator('ASM');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_asma'] = $id_riwayat;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
      $data_riwayat['no_bpjs'] = $no_bpjs[$key];
      $this->M_r_asma->store($data_riwayat);
    }
  }

  private function masalah_kesehatan($id_kk, $id_riwayat_kes_kel, $no_bpjs = array(), $masalah_kes = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($no_bpjs as $key => $value) {
      $id_riwayat = $this->id_generator('MKES');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_masalah_kes'] = $id_riwayat;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
      $data_riwayat['no_bpjs'] = $no_bpjs[$key];
      $data_riwayat['masalah_kes'] = $masalah_kes[$key];
      $this->M_r_masalah_kes->store($data_riwayat);
    }
  }

  private function masalah_keturunan($id_kk, $id_riwayat_kes_kel, $no_bpjs = array(), $masalah_ket = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($no_bpjs as $key => $value) {
      $id_riwayat = $this->id_generator('MKET');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_masalah_keturunan'] = $id_riwayat;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
      $data_riwayat['no_bpjs'] = $no_bpjs[$key];
      $data_riwayat['jenis_masalah_keturunan'] = $masalah_kes[$key];
      $this->M_r_masalah_keturunan->store($data_riwayat);
    }
  }

  private function sakit_keras($id_kk, $id_riwayat_kes_kel, $jenis_sakit_keras = array(), $tahun_sakit = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($jenis_sakit_keras as $key => $value) {
      $id_riwayat = $this->id_generator('SKER');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_sakit_keras'] = $id_riwayat;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
      $data_riwayat['jenis_sakit_keras'] = $jenis_sakit_keras[$key];
      $data_riwayat['tahun_sakit'] = $tahun_sakit[$key];
      $this->M_r_sakit_keras->store($data_riwayat);
    }
  }

  private function kecelakaan_kerja($id_kk, $id_riwayat_kes_kel, $jenis_kecelakaan_kerja = array(), $tahun_kejadian = array(), $jenis_kelainan = array(), $durasi_perawatan = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($jenis_kecelakaan_kerja as $key => $value) {
      $id_riwayat = $this->id_generator('KKER');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_kecelakaan_kerja'] = $id_riwayat;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
      $data_riwayat['jenis_kecelakaan_kerja'] = $jenis_kecelakaan_kerja[$key];
      $data_riwayat['tahun_kejadian'] = $tahun_kejadian[$key];
      $data_riwayat['jenis_kelainan'] = $jenis_kelainan[$key];
      $data_riwayat['durasi_perawatan'] = $durasi_perawatan[$key];
      $this->M_r_kecelakaan_kerja->store($data_riwayat);
    }
  }

  private function merokok($id_kk, $id_riwayat_kes_kel, $durasi_merokok, $batang_per_hari, $kretek_filter, $durasi_berhenti = NULL)
  {
    // INITIALIZE VAR
    $data_riwayat = array();
    $id_riwayat = $this->id_generator('RKK');

    $data_riwayat['id_kk'] = $id_kk;
    $data_riwayat['id_merokok'] = $id_riwayat;
    $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
    $data_riwayat['durasi_merokok'] = $durasi_merokok;
    $data_riwayat['batang_per_hari'] = $batang_per_hari;
    $data_riwayat['kretek_filter'] = $kretek_filter;
    if ($durasi_berhenti === NULL) {
      $data_riwayat['durasi_berhenti'] = $durasi_berhenti;
    }
    $this->M_r_merokok->store($data_riwayat);
  }

  private function jamu($id_kk, $id_riwayat_kes_kel, $jenis_jamu = array(), $jamu_per_minggu = array())
  {
    // INITIALIZE DATA
    $data_riwayat = array();

    foreach ($jenis_jamu as $key => $value) {
      $id_riwayat = $this->id_generator('JAM');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
      $data_riwayat['id_jamu'] = $id_riwayat;
      $data_riwayat['jenis_jamu'] = $jenis_jamu[$key];
      $data_riwayat['jamu_per_minggu'] = $jamu_per_minggu[$key];
      $this->M_r_jamu->store($data_riwayat);
    }
  }

  private function alkohol($id_kk, $id_riwayat_kes_kel, $durasi)
  {
    // INITIALIZE DATA
    $data_riwayat = array();

    $id_riwayat = $this->id_generator('ALK');
    $data_riwayat['id_kk'] = $id_kk;
    $data_riwayat['id_alkohol'] = $id_riwayat;
    $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
    $data_riwayat['durasi'] = $durasi;
    $this->M_r_alkohol->store($data_riwayat);
  }

  private function kopi($id_kk, $id_riwayat_kes_kel, $gelas_per_hari)
  {
    // INITIALIZE DATA
    $data_riwayat = array();

    $id_riwayat = $this->id_generator('KOP');
    $data_riwayat['id_kk'] = $id_kk;
    $data_riwayat['id_kopi'] = $id_riwayat;
    $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
    $data_riwayat['gelas_per_hari'] = $gelas_per_hari;
    $this->M_r_kopi->store($data_riwayat);
  }

  private function obat($id_kk, $id_riwayat_kes_kel, $jenis_obat = array())
  {
    // INITIALIZE DATA
    $data_riwayat = array();

    foreach ($jenis_obat as $key => $value) {
      $id_riwayat = $this->id_generator('OBT');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_konsumsi_obat'] = $id_riwayat;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
      $data_riwayat['jenis_obat'] = $jenis_obat[$key];
      $this->M_r_obat->store($data_riwayat);
    }
  }

  private function olahraga($id_kk, $id_riwayat_kes_kel, $jenis_olahraga = array(), $jumlah_per_minggu = array(), $olahraga_keluarga = array())
  {
    // INITIALIZE DATA
    $data_riwayat = array();

    foreach ($jenis_olahraga as $key => $value) {
      $id_riwayat = $this->id_generator('OLR');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_olahraga'] = $id_riwayat;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
      $data_riwayat['jumlah_per_minggu'] = $jumlah_per_minggu[$key];
      $data_riwayat['jenis_olahraga'] = $jenis_olahraga[$key];
      $data_riwayat['olahraga_keluarga'] = $olahraga_keluarga[$key];
      $this->M_r_olahraga->store($data_riwayat);
    }
  }
}