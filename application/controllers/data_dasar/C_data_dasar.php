<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_data_dasar extends CI_Controller
{
  // init var - template data
  private $template;
  private $template_data = array();
  private $vars = NULL;

  // init var - error template
  private $err_template;
  private $err_template_data = array();
  private $err_vars = NULL;

  // init var - alert template
  private $alert_template;
  private $alert_template_data = array();
  private $alert_vars = NULL;
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');

    // init var - local
    $urisegment = $this->uri->segments[1];

    // session
    if ($this->session->userdata('aktif') !== TRUE) {
      $url = base_url();
      header("Location: $url");
    } else { 
      if ($this->session->userdata('tabel') == 'kefarmasian') {
        $url = base_url();
        header("Location: $url");
      }
    }
  }

  private function parse_view($page_title, $css_framework, $page_content = NULL, $js_framework)
  {
    $data = array(
      'page_title' => $page_title,
      'css_framework' => $css_framework, 
      'page_header' => $this->load->view('headers/main_header', '', TRUE), 
      'page_sidebar' => $this->load->view('sidebars/main_sidebar', '', TRUE), 
      'page_content' => $page_content,
      'page_footer' => $this->load->view('footers/main_footer', '', TRUE), 
      'js_framework' => $js_framework, 
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

  private function date_formatter($date_string, $format)
  {
    $date_object = date_create($date_string);
    $formatted_date = date_format($date_object, $format);
    return $formatted_date;
  }

  public function filter_region()
  {
    $filter_data = $this->input->post('filter_data');
    $id = $this->input->post('id');
    switch ($filter_data) {
      case 'kabupaten':
        $result = $this->M_kabupaten->show_by_provinsi($id, array('id_kabupaten', 'nama'));
        break;

      case 'kecamatan':
        $result = $this->M_kecamatan->show_by_kabupaten($id, array('id_kecamatan', 'nama'));
        break;

      case 'kelurahan':
        $result = $this->M_kelurahan->show_by_kecamatan($id, array('id_kelurahan', 'nama'));
        break;
    }
    echo json_encode($result);
  }

  public function index()
  {
    // TEST YOUR CODE HERE
    $id_kk = 'KK-170915082719286';
    $id_riwayat_kes_kel = 'KSKL-170920080119679';

    $ak = $this->count_anggota_sakit($id_kk, $id_riwayat_kes_kel);
    echo '<br />';
    $as = $this->count_anggota_keluarga($id_kk);
    echo '<br />';
    $pk = $this->get_percentage_pk($id_kk, $id_riwayat_kes_kel);
    echo '<br />';
    $frk = $this->get_percentage_frk($id_kk, $id_riwayat_kes_kel);
    echo '<br />';
    $trp = $this->get_tingkat_risiko_penyakit($id_kk, $id_riwayat_kes_kel);

    echo '<br />';
    echo $ak;
    echo '<br />';
    echo $as;
    echo '<br />';
    echo $pk;
    echo '<br />';
    echo $frk;
    echo '<br />';
    echo 'tingkat risiko: ' . $trp;
    echo '<br />';
    echo (($ak/$as)*1*40) + $frk + $pk;
  }

  public function show_perkawinan_ke()
  {
    $result = $this->M_data_perkawinan->show($this->input->post('id_kk'), 'perkawinan_ke');
    echo json_encode($result);
  }

  public function show_perkawinan_terakhir()
  {
    $result = $this->M_data_perkawinan->get_perkawinan_terakhir($this->input->post('no_bpjs'));
    echo json_encode($result);
  }

  //////////////////////////////////
  // MODUL DATA DASAR - SHOW DATA //
  //////////////////////////////////
  public function show_data_dasar()
  {
    // init var - local var
    $data_tabel = array();
    $page_content = NULL;

    // init var - view data
    $view_data['kk'] = $this->M_kk->get_kk_pasien('a.id_kk, a.no_bpjs, b.nama, a.no_telp, tingkat_risiko_penyakit, tingkat_stres');

    if ($view_data['kk']['status'] == 'error') {
      $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
      $this->err_template_data = array(
        'alert_title' => 'Kegagalan Pemuatan Data',
        'alert_msg' => 'Mohon maaf, proses pemuatan <strong>data dasar kesehatan keluarga</strong> gagal dilakukan.',
        'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
        );
      $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
    } else {
      $data_tabel = $view_data['kk']['data'];
    }

    // parsing template
    $this->template = $this->load->view('data_dasar/daftar_data_dasar', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_show_data_dasar($data_tabel)
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Data Dasar Kesehatan Keluarga', $css_framework, $page_content, $js_framework);
  }

  private function replace_show_data_dasar($data = array())
  {
    // init var - return var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      if (empty($value['tingkat_risiko_penyakit'])) {
        $value['tingkat_risiko_penyakit'] = '<span class="badge bg-primary">N/A</span>';
      } elseif ($value['tingkat_risiko_penyakit'] >= 0 && $value['tingkat_risiko_penyakit'] <= 10) {
        $value['tingkat_risiko_penyakit'] = '<span class="badge bg-green">Rendah</span>';
      } elseif ($value['tingkat_risiko_penyakit'] >= 11 && $value['tingkat_risiko_penyakit'] <= 50) {
        $value['tingkat_risiko_penyakit'] = '<span class="badge bg-yellow">Sedang</span>';
      } elseif ($value['tingkat_risiko_penyakit'] > 50){
        $value['tingkat_risiko_penyakit'] = '<span class="badge bg-red">Tinggi</span>';
      }

      if (empty($value['tingkat_stres'])) {
        $value['tingkat_stres'] = '<span class="badge bg-blue">N/A</span>';
      } elseif ($value['tingkat_stres'] >= 0 && $value['tingkat_stres'] <= 15) {
        $value['tingkat_stres'] = '<span class="badge bg-green">Rendah</span>';
      } elseif ($value['tingkat_stres'] >= 16 && $value['tingkat_stres'] <= 50) {
        $value['tingkat_stres'] = '<span class="badge bg-yellow">Sedang</span>';
      } elseif ($value['tingkat_stres'] > 50){
        $value['tingkat_stres'] = '<span class="badge bg-red">Tinggi</span>';
      }

      $value['nama'] = ucwords($value['nama']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  ///////////////////////////////
  // MODUL DATA DASAR - DETAIL //
  ///////////////////////////////

  public function detail_data_dasar($alert_flag = NULL, $id_kk)
  {
    // init var - local var
    $data_detail = array();
    $id = NULL; // untuk add_ekonomi, add_kes_kel, add_perilaku
    $add_ekonomi = NULL; // untuk add_ekonomi
    $add_kes_kel = NULL; // untuk add_kes_kel
    $add_perilaku = NULL; // untuk add_perilaku

    // init var - view data
    $view_data['tingkat_risiko_penyakit'] = $this->M_kk->get_tingkat_risiko_penyakit($id_kk);
    $view_data['tingkat_stres'] = $this->M_kk->get_tingkat_stres($id_kk);
    $view_data['identitas'] = $this->M_kk->get_dd_identitas($id_kk, 'a.id_kk, a.no_bpjs, b.nama, YEAR(CURRENT_DATE()) - YEAR(tgl_lahir) as umur, b.jenis_kelamin, b.kelas_bpjs, b.status_tagihan_bpjs, c.pekerjaan as pekerjaan_utama, b.hidup, b.agama, b.alamat, d.nama as provinsi, e.nama as kabupaten, f.nama as kecamatan, g.nama as kelurahan');
    $view_data['ekonomi'] = $this->M_ekonomi->show($id_kk);
    $view_data['riwayat_kes_kel'] = $this->M_r_kes_keluarga->get_data_latest_by_kk($id_kk, 'id_kk, id_riwayat_kes_kel, batuk, asma, merokok, jamu, alkohol, kopi, obat, m_dingin, peliharaan, olahraga');
    $view_data['perilaku'] = $this->M_perilaku_kesehatan->get_data_kes($id_kk, 'a.id_kk, a.id_perilaku_kes, a.layanan_balita, a.pemeliharaan_kes_kel, a.layanan_pengobatan_diri, a.jamkes_pri_kel, a.sumber_air, a.sumber_air_lain, a.mck_km, a.mck_wc, a.mck_cuci, a.spal, a.kasur_busa, a.kosmetik_obat_luar, a.tgl_isi, b.id_perilaku_keselamatan, b.pengguna_sepeda_motor, b.manula_sendirian, c.id_riwayat_kes_kel');
    $view_data['maskes'] = $this->M_r_masalah_kes->get_data_kk_identitas($id_kk, 'a.id_kk, a.id_masalah_kes, c.nama, a.masalah_kes');
    $view_data['masket'] = $this->M_r_masalah_keturunan->get_data_kk_identitas($id_kk, 'a.id_kk, a.id_masalah_keturunan, c.nama, a.jenis_masalah_keturunan');
    $view_data['kecelakaan_kerja'] = $this->M_r_kecelakaan_kerja->get_data_by_kk($id_kk, 'id_kecelakaan_kerja, jenis_kecelakaan_kerja, tahun_kejadian, jenis_kelainan, durasi_perawatan');
    $view_data['sakit_keras'] = $this->M_r_sakit_keras->get_data_by_kk($id_kk, 'id_sakit_keras, jenis_sakit_keras, tahun_sakit');
    $view_data['satu_bulan'] = $this->M_r_satu_bulan->get_data_pasien_by_kk($id_kk, 'a.id_1bulan, b.nama, a.jenis_penyakit');
    $view_data['tiga_bulan'] = $this->M_r_tiga_bulan->get_data_pasien_by_kk($id_kk, 'a.id_3bulan, b.nama, a.jenis_penyakit');
    $view_data['satu_tahun'] = $this->M_r_satu_tahun->get_data_pasien_by_kk($id_kk, 'a.id_1tahun, b.nama, a.jenis_penyakit');
    $view_data['anggota_keluarga'] = $this->M_anggota_keluarga->get_data_identitas($id_kk, 'a.id_kk, a.no_bpjs, b.nama, b.jenis_kelamin, b.tgl_lahir, b.hidup, a.domisili_serumah, a.hubungan_keluarga');
    $view_data['perkawinan'] = $this->M_data_perkawinan->get_data_identitas_kk_perkawinan($id_kk, 
      'a.id_kk, a.no_bpjs, b.nama, a.domisili_serumah, a.hubungan_keluarga, COALESCE(d.perkawinan_ke, "-") as perkawinan_ke, COALESCE(a.perkawinan_ke, "-") AS anak_dari, b.hidup, 
      CASE a.hubungan_keluarga
        WHEN \'2\' THEN d.umur_pasangan
      END AS umur_pasangan,
      CASE  a.hubungan_keluarga
        WHEN \'2\' THEN d.status_kawin
        WHEN \'1\' THEN "-"
        ELSE COALESCE(d.status_kawin, "Belum Menikah")
      END AS status_kawin');

    // var_dump($view_data['perilaku']);

    // parsing error template
    foreach ($view_data as $key => $value) {
      if ($view_data[$key]['status'] == 'error') {
        $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
        $this->err_template_data = array(
          'alert_title' => 'Kegagalan Pemuatan Data',
          'alert_msg' => 'Mohon maaf, proses pemuatan <strong>' . $key . '</strong> gagal dilakukan.',
          'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
          );
        $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
      }
      $data_detail[$key] = $view_data[$key]['data'];
      if (empty($data_detail[$key])) {
        $data_detail[$key] = array();
        // set template data if riwayat_kes_kel is empty
        if ($key == 'ekonomi') {
          $add_ekonomi = '<button class="btn btn-primary" onclick="window.location=\'' . base_url('add-ekonomi/') . $id . '\'" style="width: 100%;"><i class="fa fa-plus"></i>&nbsp;Tambah Riwayat Kesehatan Keluarga</button>';
        }
        if ($key == 'riwayat_kes_kel') {
          $add_kes_kel = '<button class="btn btn-primary" onclick="window.location=\'' . base_url('add-riwayat-kes-kel/') . $id . '\'" style="width: 100%;"><i class="fa fa-plus"></i>&nbsp;Tambah Riwayat Kesehatan Keluarga</button>';
        }
        if ($key == 'perilaku') {
          $add_perilaku = '<button class="btn btn-primary" onclick="window.location=\'' . base_url('add-perilaku/') . $id . '\'" style="width: 100%;"><i class="fa fa-plus"></i>&nbsp;Tambah Data Perilaku Kesehatan</button>';
        } 
      }
      $id = $data_detail['identitas'][0]['id_kk'];
    }

    // checking passed arguments
    if ($alert_flag !== NULL) {
      if ($alert_flag != 'home') {
        $this->alert_vars = $this->load->view("alert_template/data_dasar/$alert_flag", '', TRUE);
      } else {
        if (strpos($id_kk, '-') === FALSE) {
          $this->alert_vars = $this->load->view("alert_template/data_dasar/$id_kk", '', TRUE);
        }
      }
    }

    // parsing template
    $this->template = $this->load->view('data_dasar/detail_data_dasar', '', TRUE);
    $this->template_data = array(
      'id_kk' => $data_detail['identitas'][0]['id_kk'],
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'tr_template' => $this->replace_tr($data_detail['tingkat_risiko_penyakit']),
      'ts_template' => $this->replace_ts($data_detail['tingkat_stres']),
      'tingkat_risiko_penyakit' => $data_detail['tingkat_risiko_penyakit'],
      'tingkat_stres' => $data_detail['tingkat_stres'],
      'dd_identitas' => $this->replace_dd_identitas($data_detail['identitas']),
      'dd_ekonomi' => $this->replace_dd_ekonomi($data_detail['ekonomi']),
      'dd_perilaku' => $this->replace_dd_perilaku($data_detail['perilaku']),
      'dd_kes_kel' => $this->replace_dd_kes_kel($data_detail['riwayat_kes_kel']),
      'dd_maskes' => $this->replace_dd_maskes($data_detail['maskes']),
      'dd_masket' => $this->replace_dd_masket($data_detail['masket']),
      'dd_kecelakaan_kerja' => $data_detail['kecelakaan_kerja'],
      'dd_sakit_keras' => $data_detail['sakit_keras'],
      'dd_satu_bulan' => $this->replace_dd_satu_bulan($data_detail['satu_bulan']),
      'dd_tiga_bulan' => $this->replace_dd_tiga_bulan($data_detail['tiga_bulan']),
      'dd_satu_tahun' => $this->replace_dd_satu_tahun($data_detail['satu_tahun']),
      'dd_anggota_keluarga' => $this->replace_dd_anggota_keluarga($data_detail['anggota_keluarga']),
      'dd_perkawinan' => $this->replace_dd_perkawinan($data_detail['perkawinan']),
      'add_ekonomi' => $add_ekonomi,
      'add_kes_kel' => $add_kes_kel,
      'add_perilaku' => $add_perilaku,
      );

    // parsing view
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);

    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);
    $this->parse_view('Detail Data Dasar Kesehatan Keluarga', $css_framework, $page_content, $js_framework);
  }

  private function replace_dd_identitas($data = array())
  {
    // init var - return var
    $ret_val = array();

    // init var
    $jenis_kelamin = array(
      'l' => 'Laki-Laki',
      'p' => 'Perempuan'
      );
    $kelas_bpjs = array(
      '1' => 'Kelas I',
      '2' => 'Kelas II',
      '3' => 'Kelas III',
      );
    $status_tagihan_bpjs = array(
      '0' => '<span class="badge bg-green">Tidak Ada</span>',
      '1' => '<span class="badge bg-red">Ada Tagihan</span>',
      );
    $hidup = array(
      '0' => '<span class="badge bg-red">Meninggal Dunia</span>',
      '1' => '<span class="badge bg-green">Hidup</span>',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      $value['jenis_kelamin'] = str_replace(array_keys($jenis_kelamin), $jenis_kelamin, $value['jenis_kelamin']);
      $value['kelas_bpjs'] = str_replace(array_keys($kelas_bpjs), $kelas_bpjs, $value['kelas_bpjs']);
      $value['status_tagihan_bpjs'] = str_replace(array_keys($status_tagihan_bpjs), $status_tagihan_bpjs, $value['status_tagihan_bpjs']);
      $value['pekerjaan_utama'] = ucwords($value['pekerjaan_utama']);
      $value['hidup'] = str_replace(array_keys($hidup), $hidup, $value['hidup']);
      $value['agama'] = ucwords($value['agama']);
      $value['alamat'] = ucwords($value['alamat']);
      $value['provinsi'] = ucwords($value['provinsi']);
      $value['kabupaten'] = ucwords($value['kabupaten']);
      $value['kecamatan'] = ucwords($value['kecamatan']);
      $value['kelurahan'] = ucwords($value['kelurahan']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_dd_ekonomi($data = array())
  {
    // init var - return
    $ret_val = array();

    // init var - array
    $kepemilikan_rumah = array(
      '1' => 'Kontrak',
      '2' => 'Kost',
      '3' => 'Pribadi',
      '4' => 'Orang tua',
      );
    $sumber_ekonomi = array(
      '0' => 'Usaha Lainnya',
      '1' => 'Gaji Pegawai',
      );
    $daya_listrik = array(
      '450' => 450,
      '900' => 900,
      '1300' => 1300,
      '2000' => 'Lebih dari 1300',
      );
    $penopang_ekonomi = array(
      '1' => 'Suami atau Istri Saja',
      '2' => 'Suami dan Istri',
      '3' => 'Suami, Istri, &amp; Anak',
      '4' => 'Suami, Istri, Anak, &amp; anggota keluarga lain',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['kepemilikan_rumah'] = str_replace(array_keys($kepemilikan_rumah), $kepemilikan_rumah, $value['kepemilikan_rumah']);
      $value['sumber_ekonomi'] = str_replace(array_keys($sumber_ekonomi), $sumber_ekonomi, $value['sumber_ekonomi']);
      $value['daya_listrik'] = str_replace(array_keys($daya_listrik), $daya_listrik, $value['daya_listrik']);
      $value['penopang_ekonomi'] = str_replace(array_keys($penopang_ekonomi), $penopang_ekonomi, $value['penopang_ekonomi']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_dd_perilaku($data= array())
  {
    // init var - local var
    $ret_val = array();

    // init var - array
    $layanan_balita = array(
      '1' => 'Dokter Praktek Umum',
      '2' => 'Puskesmas',
      '3' => 'Perawat/Bidan',
      '4' => 'Rumah Sakit/Spesialis',
      '5' => 'Lainnya',
      );
    $pemeliharaan_kes_kel = array(
      '1' => 'Dokter Praktek Umum',
      '2' => 'Puskesmas',
      '3' => 'Perawat/Bidan',
      '4' => 'Rumah Sakit/Spesialis',
      '5' => 'Lainnya',
      );
    $layanan_pengobatan_diri = array(
      '1' => 'Dokter Praktek Umum',
      '2' => 'Puskesmas',
      '3' => 'Perawat/Bidan',
      '4' => 'Rumah Sakit/Spesialis',
      '5' => 'Lainnya',
      );
    $jamkes_pri_kel = array(
      '0' => 'Tidak Punya',
      '1' => 'Asuransi Swasta',
      '2' => 'BPJS',
      '3' => 'Institusi',
      );
    $sumber_air = array(
      '1' => 'Air sumur gali',
      '2' => 'Air sumur pompa',
      '3' => 'PDAM',
      '4' => 'Sungai',
      '5' => 'Lainnya',
      );
    $mck_km = array(
      '0' => '<span class="badge bg-red">Tidak Ada</span>',
      '1' => '<span class="badge bg-green">Ada</span>',
      );
    $mck_wc = array(
      '0' => '<span class="badge bg-yellow">Lainnya</span>',
      '1' => '<span class="badge bg-green">Kloset</span>',
      );
    $mck_cuci = array(
      '0' => '<span class="badge bg-red">Tidak</span>',
      '1' => '<span class="badge bg-green">Ya</span>',
      );
    $spal = array(
      'terbuka' => '<span class="badge bg-yellow">Terbuka</span>',
      'tertutup' => '<span class="badge bg-green">Tertutup</span>',
      );
    $kasur_busa = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      '2' => '<span class="badge bg-yellow">Tidak Tahu</span>',
      );
    $kosmetik_obat_luar = array(
      '0' => '<span class="badge bg-green">Tidak Pernah</span>',
      '1' => '<span class="badge bg-yellow">Hand & Body Lotion</span>',
      '2' => '<span class="badge bg-yellow">Tidak Tahu</span>',
      '3' => '<span class="badge bg-yellow">Tidak Tahu</span>',
      '4' => '<span class="badge bg-yellow">Tidak Tahu</span>',
      );
    $pengguna_sepeda_motor = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      '2' => '<span class="badge bg-yellow">Kadang-Kadang</span>',
      );
    $manula_sendirian = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      '2' => '<span class="badge bg-yellow">Kadang-Kadang</span>',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['tgl_isi_formatted'] = $this->date_formatter($value['tgl_isi'], 'd-M-Y H:i');
      $value['layanan_balita'] = str_replace(array_keys($layanan_balita), $layanan_balita, $value['layanan_balita']);
      $value['pemeliharaan_kes_kel'] = str_replace(array_keys($pemeliharaan_kes_kel), $pemeliharaan_kes_kel, $value['pemeliharaan_kes_kel']);
      $value['layanan_pengobatan_diri'] = str_replace(array_keys($layanan_pengobatan_diri), $layanan_pengobatan_diri, $value['layanan_pengobatan_diri']);
      $value['jamkes_pri_kel'] = str_replace(array_keys($jamkes_pri_kel), $jamkes_pri_kel, $value['jamkes_pri_kel']);
      $value['sumber_air'] = str_replace(array_keys($sumber_air), $sumber_air, $value['sumber_air']);
      $value['sumber_air_lain'] = '(' . ucwords($value['sumber_air_lain']) . ')';
      $value['mck_km'] = str_replace(array_keys($mck_km), $mck_km, $value['mck_km']);
      $value['mck_wc'] = str_replace(array_keys($mck_wc), $mck_wc, $value['mck_wc']);
      $value['mck_cuci'] = str_replace(array_keys($mck_cuci), $mck_cuci, $value['mck_cuci']);
      $value['spal'] = str_replace(array_keys($spal), $spal, $value['spal']);
      $value['kasur_busa'] = str_replace(array_keys($kasur_busa), $kasur_busa, $value['kasur_busa']);
      $value['kosmetik_obat_luar'] = str_replace(array_keys($kosmetik_obat_luar), $kosmetik_obat_luar, $value['kosmetik_obat_luar']);
      $value['pengguna_sepeda_motor'] = str_replace(array_keys($pengguna_sepeda_motor), $pengguna_sepeda_motor, $value['pengguna_sepeda_motor']);
      $value['manula_sendirian'] = str_replace(array_keys($manula_sendirian), $manula_sendirian, $value['manula_sendirian']);
      
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_dd_kes_kel($data = array())
  {
    // init var - local var
    $ret_val = array();

    // init var - array
    $batuk = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      );
    $asma = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      );
    $merokok = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      '2' => '<span class="badge bg-yellow">Kadang-Kadang</span>',
      '3' => '<span class="badge bg-blue">Sudah Berhenti</span>',
      );
    $jamu = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      '2' => '<span class="badge bg-yellow">Kadang-Kadang</span>',
      );
    $alkohol = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      '2' => '<span class="badge bg-yellow">Kadang-Kadang</span>',
      );
    $kopi = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      '2' => '<span class="badge bg-yellow">Kadang-Kadang</span>',
      );
    $obat = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      );
    $m_dingin = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      '2' => '<span class="badge bg-yellow">Kadang-Kadang</span>',
      );
    $peliharaan = array(
      '0' => '<span class="badge bg-green">Tidak</span>',
      '1' => '<span class="badge bg-red">Ya</span>',
      );
    $olahraga = array(
      '0' => '<span class="badge bg-red">Tidak</span>',
      '1' => '<span class="badge bg-green">Ya</span>',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['batuk'] = str_replace(array_keys($batuk), $batuk, $value['batuk']);
      $value['asma'] = str_replace(array_keys($asma), $asma, $value['asma']);
      $value['merokok'] = str_replace(array_keys($merokok), $merokok, $value['merokok']);
      $value['jamu'] = str_replace(array_keys($jamu), $jamu, $value['jamu']);
      $value['alkohol'] = str_replace(array_keys($alkohol), $alkohol, $value['alkohol']);
      $value['kopi'] = str_replace(array_keys($kopi), $kopi, $value['kopi']);
      $value['obat'] = str_replace(array_keys($obat), $obat, $value['obat']);
      $value['m_dingin'] = str_replace(array_keys($m_dingin), $m_dingin, $value['m_dingin']);
      $value['peliharaan'] = str_replace(array_keys($peliharaan), $peliharaan, $value['peliharaan']);
      $value['olahraga'] = str_replace(array_keys($olahraga), $olahraga, $value['olahraga']);
      
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_dd_maskes($data = array())
  {
    // init var - local var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      $value['masalah_kes'] = ucwords($value['masalah_kes']);
      
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_dd_masket($data = array())
  {
    // init var - local var
    $ret_val = array();

    // init var - array
    $jenis_masalah_keturunan = array(
      '1' => 'Darah Tinggi',
      '2' => 'Kencing Manis',
      '3' => 'Kegemukan',
      '4' => 'Diabetes',
      '5' => 'Stroke',
      '6' => 'Sakit Jantung',
      '7' => 'Asam Urat',
      '8' => 'Tumor',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      $value['jenis_masalah_keturunan'] = str_replace(array_keys($jenis_masalah_keturunan), $jenis_masalah_keturunan, $value['jenis_masalah_keturunan']);
      
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_dd_satu_bulan($data = array())
  {
    // init var - local var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      $value['jenis_penyakit'] = ucwords($value['jenis_penyakit']);
      
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_dd_tiga_bulan($data = array())
  {
    // init var - local var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      $value['jenis_penyakit'] = ucwords($value['jenis_penyakit']);
      
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_dd_satu_tahun($data = array())
  {
    // init var - local var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      $value['jenis_penyakit'] = ucwords($value['jenis_penyakit']);
      
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_dd_anggota_keluarga($data = array())
  {
    // init var - local
    $ret_val = array();

    // init var - array
    $jenis_kelamin = array(
      'l' => 'Laki-Laki',
      'p' => 'Perempuan'
      );
    $hidup = array(
      '0' => '<span class="badge bg-red">Meninggal Dunia</span>',
      '1' => '<span class="badge bg-green">Hidup</span>',
      );
    $domisili_serumah = array(
      '0' => '<span class="badge bg-red">Tidak</span>',
      '1' => '<span class="badge bg-green">Ya</span>',
      '2' => '<span class="badge bg-yellow">Kadang-Kadang</span>',
      );
    $hubungan_keluarga = array(
      '1' => 'Suami',
      '2' => 'Istri',
      '3' => 'Anak',
      '4' => 'Anggota Keluarga Lain',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      $value['jenis_kelamin'] = str_replace(array_keys($jenis_kelamin), $jenis_kelamin, $value['jenis_kelamin']);
      $value['tgl_lahir'] = $this->date_formatter($value['tgl_lahir'], 'd-M-Y');
      $value['hidup'] = str_replace(array_keys($hidup), $hidup, $value['hidup']);
      $value['domisili_serumah'] = str_replace(array_keys($domisili_serumah), $domisili_serumah, $value['domisili_serumah']);
      $value['hubungan_keluarga'] = str_replace(array_keys($hubungan_keluarga), $hubungan_keluarga, $value['hubungan_keluarga']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_dd_perkawinan($data = array())
  {
    // init var - local
    $ret_val = array();

    // init var - array
    $jenis_kelamin = array(
      'l' => 'Laki-Laki',
      'p' => 'Perempuan'
      );
    $hidup = array(
      '0' => '<span class="badge bg-red">Meninggal Dunia</span>',
      '1' => '<span class="badge bg-green">Hidup</span>',
      );
    $domisili_serumah = array(
      '0' => '<span class="badge bg-red">Tidak</span>',
      '1' => '<span class="badge bg-green">Ya</span>',
      '2' => '<span class="badge bg-yellow">Kadang-Kadang</span>',
      );
    $hubungan_keluarga = array(
      '1' => 'Suami',
      '2' => 'Istri',
      '3' => 'Anak',
      '4' => 'Anggota Keluarga Lain',
      );
    $status_kawin = array(
      '0' => '<span class="badge bg-blue">Belum Menikah</span>',
      '1' => '<span class="badge bg-green">Menikah</span>',
      '2' => '<span class="badge bg-red">Cerai</span>',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $umur_pasangan = (empty($value['umur_pasangan'])) ? '' : '<br />(' . $value['umur_pasangan'] . ' tahun)';
      $value['nama'] = ucwords($value['nama']);
      $value['jenis_kelamin'] = str_replace(array_keys($jenis_kelamin), $jenis_kelamin, $value['jenis_kelamin']);
      $value['hubungan_keluarga'] = str_replace(array_keys($hubungan_keluarga), $hubungan_keluarga, $value['hubungan_keluarga']);
      $value['umur_pasangan'] = $umur_pasangan;
      $value['hidup'] = str_replace(array_keys($hidup), $hidup, $value['hidup']);
      $value['status_kawin'] = str_replace(array_keys($status_kawin), $status_kawin, $value['status_kawin']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  private function replace_tr($data = array())
  {
    // init var - local
    $ret_val = NULL;
    $tmp = NULL;
    $tingkat_risiko_penyakit = $data[0]['tingkat_risiko_penyakit'];

    if (empty($data)) {
      $tmp = $this->load->view('data_dasar/tr_template/tr_null', '', TRUE);
    } else {
      // classificating data
      if ($tingkat_risiko_penyakit >= 0 && $tingkat_risiko_penyakit <= 10) {
        $tmp = $this->load->view('data_dasar/tr_template/tr_rendah', '', TRUE);
      } elseif ($tingkat_risiko_penyakit >= 11 && $tingkat_risiko_penyakit <= 50) {
        $tmp = $this->load->view('data_dasar/tr_template/tr_sedang', '', TRUE);
      } elseif ($tingkat_risiko_penyakit > 50){
        $tmp = $this->load->view('data_dasar/tr_template/tr_tinggi', '', TRUE);
      } else {
        $tmp = $this->load->view('data_dasar/tr_template/tr_null', '', TRUE);
      }
    }

    return $tmp;
  }

  private function replace_ts($data = array())
  {
    // init var - local
    $ret_val = NULL;
    $tmp = NULL;
    $tingkat_stres = $data[0]['tingkat_stres'];

    if (empty($data)) {
      $tmp = $this->load->view('data_dasar/ts_template/ts_null', '', TRUE);
    } else {
      // classificating data
      if ($tingkat_stres >= 0 && $tingkat_stres <= 15) {
        $tmp = $this->load->view('data_dasar/ts_template/ts_rendah', '', TRUE);
      } elseif ($tingkat_stres >= 16 && $tingkat_stres <= 50) {
        $tmp = $this->load->view('data_dasar/ts_template/ts_sedang', '', TRUE);
      } elseif ($tingkat_stres > 50){
        $tmp = $this->load->view('data_dasar/ts_template/ts_tinggi', '', TRUE);
      } else {
        $tmp = $this->load->view('data_dasar/ts_template/ts_null', '', TRUE);
      }
    }

    return $tmp;
  }

  ////////////////////////////////////////////////////////////////////////////////
  // MODULE DATA DASAR - RIWAYAT DATA DASAR KESEHATAN KELUARGA DAN GEJALA STRES //
  ////////////////////////////////////////////////////////////////////////////////
  public function riwayat_kes_kel_stres($id_kk, $alert_flag = NULL)
  {
    // init var - local var
    $data_detail = array();

    // init var - view data
    $view_data['riwayat_kes_kel'] = $this->M_r_kes_keluarga->show($id_kk);
    $view_data['gejala_stres'] = $this->M_gejala_stres->show_by_status($id_kk);

    var_dump($view_data);

    // die();

    // parsing error template
    foreach ($view_data as $key => $value) {
      if ($view_data[$key]['status'] == 'error') {
        $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
        $this->err_template_data = array(
          'alert_title' => 'Kegagalan Pemuatan Data',
          'alert_msg' => 'Mohon maaf, proses pemuatan <strong>' . $key . '</strong> gagal dilakukan.',
          'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
          );
        $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
      }
      $data_tabel[$key] = $view_data[$key]['data'];
      if (empty($data_tabel[$key])) {
        $data_tabel[$key] = array();
      }
    }

    // checking passed arguments
    if ($alert_flag !== NULL) {
      $this->alert_vars = $this->load->view("alert_template/data_dasar/$alert_flag", '', TRUE);
    }

    // init var - view data - again
    $view_data['id_kk'] = $id_kk;

    // parsing template
    $this->template = $this->load->view('data_dasar/show/riwayat_data_dasar_gejala_stres', $view_data, TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'riwayat_kes_kel' => $this->replace_riwayat_kes_kel($data_tabel['riwayat_kes_kel']),
      'gejala_stres' => $this->replace_gejala_stres($data_tabel['gejala_stres']),
      );

    // parsing view
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);

    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);
    $this->parse_view('Detail Data Dasar Kesehatan Keluarga', $css_framework, $page_content, $js_framework);
  }

  private function replace_riwayat_kes_kel($data = array())
  {
    // init var - return var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      if (empty($value['tingkat_risiko_penyakit'])) {
        $value['tingkat_risiko_penyakit'] = '<span class="badge bg-primary">N/A</span>';
      } elseif ($value['tingkat_risiko_penyakit'] >= 0 && $value['tingkat_risiko_penyakit'] <= 10) {
        $value['tingkat_risiko_penyakit'] = '<span class="badge bg-green">Rendah</span>';
      } elseif ($value['tingkat_risiko_penyakit'] >= 11 && $value['tingkat_risiko_penyakit'] <= 50) {
        $value['tingkat_risiko_penyakit'] = '<span class="badge bg-yellow">Sedang</span>';
      } elseif ($value['tingkat_risiko_penyakit'] > 50){
        $value['tingkat_risiko_penyakit'] = '<span class="badge bg-red">Tinggi</span>';
      }

      $value['tgl_isi'] = $this->date_formatter($value['tgl_isi'], 'd-M-Y H:i');
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  public function replace_gejala_stres($data = array())
  {
    // init var - return var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      if (empty($value['tingkat_stres'])) {
        $value['tingkat_stres'] = '<span class="badge bg-blue">N/A</span>';
      } elseif ($value['tingkat_stres'] >= 0 && $value['tingkat_stres'] <= 15) {
        $value['tingkat_stres'] = '<span class="badge bg-green">Rendah</span>';
      } elseif ($value['tingkat_stres'] >= 16 && $value['tingkat_stres'] <= 50) {
        $value['tingkat_stres'] = '<span class="badge bg-yellow">Sedang</span>';
      } elseif ($value['tingkat_stres'] > 50){
        $value['tingkat_stres'] = '<span class="badge bg-red">Tinggi</span>';
      }

      $value['tgl_isi'] = $this->date_formatter($value['tgl_isi'], 'd-M-Y H:i');
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /////////////////////////////
  // MODUL DATA DASAR - EDIT //
  /////////////////////////////
  public function edit_identitas_pasien($alert_flag = NULL, $id_kk, $no_bpjs)
  {
    // int var - local
    $data_tabel = array();
    $view_data['id_kk']['status'] = 'success';
    $view_data['id_kk']['data']['id_kk'] = $id_kk;

    // init var - view data
    $view_data['identitas'] = $this->M_pasien_identitas->get_data_identitas($no_bpjs, 'a.no_bpjs, a.nama, a.jenis_kelamin, a.tgl_lahir, a.suku_bangsa, a.agama, a.pendidikan_terakhir, a.kelas_bpjs, a.status_tagihan_bpjs, a.alamat, a.id_provinsi, a.id_kabupaten, a.id_kecamatan, a.id_kelurahan, a.hidup');
    $view_data['provinsi'] = $this->M_provinsi->get_data();
    $view_data['kabupaten'] = $this->M_kabupaten->get_data();
    $view_data['kecamatan'] = $this->M_kecamatan->get_data();
    $view_data['kelurahan'] = $this->M_kelurahan->get_data();

    // check if view data is empty
    $check_view_data = $this->dc->empty_view_data($view_data);
    if ( ! empty($check_view_data)) {      
      $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
      $this->err_template_data = array(
        'alert_title' => 'Data Tidak Tersedia',
        'alert_msg' => 'Mohon maaf, data <strong>' . $check_view_data . '</strong> belum tersedia.',
        'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
        );
      $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
    }

    // check if view data is error
    foreach ($view_data as $key => $value) {
      if ($view_data[$key]['status'] == 'error') {
        $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
        $this->err_template_data = array(
          'alert_title' => 'Kegagalan Pemuatan Data',
          'alert_msg' => 'Mohon maaf, proses pemuatan <strong>' . $key . '</strong> gagal dilakukan.',
          'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
          );
        $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
      } else {
        if($key == 'identitas'){
           $data_tabel = $view_data['identitas']['data'];
        }
      }
    }

    // checking passed arguments
    if ($alert_flag !== NULL) {
      if ($alert_flag != 'home') {
        $this->alert_vars = $this->load->view("alert_template/data_dasar/$alert_flag", '', TRUE);
      } else {
        if (strpos($id_kk, '-') === FALSE) {
          $this->alert_vars = $this->load->view("alert_template/data_dasar/$id_kk", '', TRUE);
        }
      }
    }

    // parsing template
    $this->template = $this->load->view('data_dasar/edit/edit_identitas_pasien', $view_data, TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'identitas' => $data_tabel,
      );

    // parsing view
    $page_title = 'Ubah Data Identitas Pasien';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data,TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  public function update_identitas_pasien()
  {
    // init var - local
    $ar_input = $this->input->post();
    $id_kk = $this->input->post('id_kk');
    $no_bpjs = $this->input->post('no_bpjs');

    // validating form
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $this->edit_identitas_pasien('gagal_form_invalid', $id_kk, $no_bpjs);
    } else {
      // unsetting id_kk, no_bpjs
      unset($ar_input['id_kk']);
      unset($ar_input['no_bpjs']);
      print_r($ar_input);

      // storing data
      $this->db->trans_begin();
      $this->M_pasien_identitas->update($no_bpjs, $ar_input);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'detail-data-dasar/gagal_edit_pasien/' . $id_kk;
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'detail-data-dasar/sukses_edit_pasien/' . $id_kk;
        header("Location: $url");
      } 
    }
  }

  public function edit_ekonomi($alert_flag = NULL, $id_kk)
  {
    // int var - local
    $data_tabel = array();

    // init var - array
    $view_data['ekonomi'] = $this->M_ekonomi->show($id_kk);

    // check if view data is empty
    $check_view_data = $this->dc->empty_view_data($view_data);
    if ( ! empty($check_view_data)) {      
      $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
      $this->err_template_data = array(
        'alert_title' => 'Data Tidak Tersedia',
        'alert_msg' => 'Mohon maaf, data <strong>' . $check_view_data . '</strong> belum tersedia.',
        'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
        );
      $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
    }

    // check if view data is error
    foreach ($view_data as $key => $value) {
      if ($view_data[$key]['status'] == 'error') {
        $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
        $this->err_template_data = array(
          'alert_title' => 'Kegagalan Pemuatan Data',
          'alert_msg' => 'Mohon maaf, proses pemuatan <strong>' . $key . '</strong> gagal dilakukan.',
          'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
          );
        $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
      } else {
        $data_tabel = $view_data['ekonomi']['data'];
      }
    }

    // checking passed arguments
    if ($alert_flag !== NULL) {
      if ($alert_flag != 'home') {
        $this->alert_vars = $this->load->view("alert_template/data_dasar/$alert_flag", '', TRUE);
      } else {
        if (strpos($id_kk, '-') === FALSE) {
          $this->alert_vars = $this->load->view("alert_template/data_dasar/$id_kk", '', TRUE);
        }
      }
    }

    // parsing template
    $this->template = $this->load->view('data_dasar/edit/edit_ekonomi', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'ekonomi' => $data_tabel,
      );

    // parsing view
    $page_title = 'Ubah Data Ekonomi Keluarga';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data,TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  public function update_ekonomi()
  {
    // init var - local
    $ar_input = $this->input->post();
    $id_kk = $this->input->post('id_kk');

    // validating form
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $this->edit_ekonomi('gagal_form_invalid', $id_kk);
    } else {
      // unsetting id_kk, no_bpjs
      unset($ar_input['id_kk']);

      // storing data
      $this->db->trans_begin();
      $this->M_ekonomi->update($id_kk, $ar_input);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'detail-data-dasar/gagal_edit_ekonomi/' . $id_kk;
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'detail-data-dasar/sukses_edit_ekonomi/' . $id_kk;
        header("Location: $url");
      } 
    }
  }

  public function edit_perkawinan($alert_flag = NULL, $id_kk)
  {
    // int var - local
    $data_tabel = array();

    // init var - array
    $view_data['kk'] = $this->M_kk->get_data_kepala_keluarga($id_kk, 'a.id_kk, a.no_bpjs, b.nama, c.hubungan_keluarga, c.domisili_serumah, a.no_telp');
    $view_data['pasangan'] = $this->M_data_perkawinan->get_data_pasangan($id_kk, 'a.id_data_perkawinan, a.id_kk, a.no_bpjs, b.nama, c.hubungan_keluarga, c.domisili_serumah, a.status_kawin, a.perkawinan_ke, a.umur_pasangan');
    $view_data['anggota_keluarga'] = $this->M_anggota_keluarga->get_data_anggota_keluarga($id_kk, 'a.id_kk, a.no_bpjs, b.nama, a.hubungan_keluarga, a.domisili_serumah, a.perkawinan_ke');
    $view_data['perkawinan_ke'] = $this->M_data_perkawinan->show($id_kk, 'perkawinan_ke');
    $view_data['pasien'] = $this->M_pasien_identitas->get_data('no_bpjs, nama');

    print_r($view_data);

    // check if view data is empty
    $check_view_data = $this->dc->empty_view_data($view_data);
    if ( ! empty($check_view_data)) {      
      $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
      $this->err_template_data = array(
        'alert_title' => 'Data Tidak Tersedia',
        'alert_msg' => 'Mohon maaf, data <strong>' . $check_view_data . '</strong> belum tersedia.',
        'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
        );
      $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
    }

    // check if view data is error
    foreach ($view_data as $key => $value) {
      if ($view_data[$key]['status'] == 'error') {
        $data_tabel[$key] = array();
        $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
        $this->err_template_data = array(
          'alert_title' => 'Kegagalan Pemuatan Data',
          'alert_msg' => 'Mohon maaf, proses pemuatan <strong>' . $key . '</strong> gagal dilakukan.',
          'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
          );
        $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
      } else {
        $data_tabel[$key] = $view_data[$key]['data'];
      }
    }

    // checking passed arguments
    if ($alert_flag !== NULL) {
      if ($alert_flag != 'home') {
        $this->alert_vars = $this->load->view("alert_template/data_dasar/$alert_flag", '', TRUE);
      } else {
        if (strpos($id_kk, '-') === FALSE) {
          $this->alert_vars = $this->load->view("alert_template/data_dasar/$id_kk", '', TRUE);
        }
      }
    }

    // parsing template
    $this->template = $this->load->view('data_dasar/edit/edit_perkawinan', $view_data, TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'kk' => $data_tabel['kk'],
      'pasangan' => $data_tabel['pasangan'],
      'anggota_keluarga' => $data_tabel['anggota_keluarga'],
      );

    // parsing view
    $page_title = 'Ubah Data Ekonomi Keluarga';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data,TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  public function update_perkawinan()
  {
    // init var - local
    $ar_kk_ins = array();
    $ar_kk_upd = array();
    $ar_pasangan_ins = array();
    $ar_pasangan_upd = array();
    $ar_ak_ins = array();
    $ar_ak_upd = array();
    $id_kk = $this->input->post('id_kk[]')[0];

    // validating form
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->edit_perkawinan('gagal_form_invalid', $id_kk);
    } else {
      // init var - request param
      $ar_id_kk = $this->input->post('id_kk[]');
      $psg_no_bpjs = $this->input->post('psg_no_bpjs[]');
      $id_data_perkawinan = $this->input->post('id_data_perkawinan[]');
      $hubungan_keluarga = $this->input->post('psg_hubungan_keluarga[]');
      $domisili_serumah = $this->input->post('psg_domisili_serumah[]');
      $status_kawin = $this->input->post('psg_status_kawin[]');
      $perkawinan_ke = $this->input->post('psg_perkawinan_ke[]');
      $umur_pasangan = $this->input->post('psg_umur_pasangan[]');

      // storing data
      $this->db->trans_begin();
      foreach ($psg_no_bpjs as $key => $value) {
        if ($key == 0) {
          // data kk - ins
          $ar_kk_ins['id_kk'] = $id_kk;
          $ar_kk_ins['no_bpjs'] = $value;
          $ar_kk_ins['no_telp'] = $this->input->post('psg_no_telp');
          // data kk - upd
          $ar_kk_upd['no_telp'] = $this->input->post('psg_no_telp');
          $this->M_kk->update($ar_kk_ins, $ar_kk_upd);
        } else {
          // data pasangan - ins
          $ar_pasangan_ins['id_data_perkawinan'] = $id_data_perkawinan[$key - 1];
          if ( empty($id_data_perkawinan[$key - 1])) {
            $ar_pasangan_ins['id_data_perkawinan'] = $this->id_generator('KWN');
          }
          $ar_pasangan_ins['id_kk'] = $id_kk;
          $ar_pasangan_ins['no_bpjs'] = $value;
          $ar_pasangan_ins['perkawinan_ke'] = $perkawinan_ke[$key - 1];
          $ar_pasangan_ins['umur_pasangan'] = $umur_pasangan[$key - 1];
          $ar_pasangan_ins['status_kawin'] = $status_kawin[$key - 1];
          // data pasangan - upd
          $ar_pasangan_upd['perkawinan_ke'] = $perkawinan_ke[$key - 1];
          $ar_pasangan_upd['umur_pasangan'] = $umur_pasangan[$key - 1];
          $ar_pasangan_upd['status_kawin'] = $status_kawin[$key - 1];

          var_dump($ar_pasangan_ins);
          var_dump($ar_pasangan_upd);
          $this->M_data_perkawinan->update($ar_pasangan_ins, $ar_pasangan_upd);
        }

        // data kk dan pasangan sebagai anggota keluarga
        // data anggota keluarga - ins
        $ar_ak_ins['id_kk'] = $id_kk;
        $ar_ak_ins['no_bpjs'] = $psg_no_bpjs[$key];
        $ar_ak_ins['domisili_serumah'] = $domisili_serumah[$key];
        $ar_ak_ins['hubungan_keluarga'] = $hubungan_keluarga[$key];
        // data anggota keluarga - upd
        $ar_ak_upd['domisili_serumah'] = $domisili_serumah[$key];
        $ar_ak_upd['hubungan_keluarga'] = $hubungan_keluarga[$key];
        $this->M_anggota_keluarga->update($ar_ak_ins, $ar_ak_upd);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'edit-perkawinan/gagal_edit_perkawinan/' . $id_kk;
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'edit-perkawinan/sukses_edit_perkawinan/' . $id_kk;
        header("Location: $url");
      } 
    }
  }

  public function update_anggota_keluarga()
  {
    var_dump($this->input->post());
    // init var - local
    $id_kk = $this->input->post('id_kk');
    $data_insert = array();
    $data_update = array();

    // validating form
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->edit_perkawinan('gagal_form_invalid', $id_kk);
    } else {
      // init var - request param
      $no_bpjs = $this->input->post('ak_no_bpjs[]');
      $hubungan_keluarga = $this->input->post('ak_hubungan_keluarga[]');
      $domisili_serumah = $this->input->post('ak_domisili_serumah[]');
      $perkawinan_ke = $this->input->post('ak_perkawinan_ke[]');

      // storing data
      $this->db->trans_begin();
      foreach ($no_bpjs as $key => $value) {
        // data anggota keluarga - ins
        $data_insert['id_kk'] = $id_kk;
        $data_insert['no_bpjs'] = $value;
        $data_insert['domisili_serumah'] = $domisili_serumah[$key];
        $data_insert['hubungan_keluarga'] = $hubungan_keluarga[$key];
        $data_insert['perkawinan_ke'] = $perkawinan_ke[$key];
        // data anggota keluarga - upd
        $data_update['domisili_serumah'] = $domisili_serumah[$key];
        $data_update['hubungan_keluarga'] = $hubungan_keluarga[$key];
        $data_update['perkawinan_ke'] = $perkawinan_ke[$key];
        $this->M_anggota_keluarga->update($data_insert, $data_update);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'edit-perkawinan/gagal_edit_anggota_keluarga/' . $id_kk;
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'edit-perkawinan/sukses_edit_anggota_keluarga/' . $id_kk;
        header("Location: $url");
      }
    }
  }

  ///////////////////////////////
  // MODUL DATA DASAR - DELETE //
  ///////////////////////////////

  public function destroy_anggota_keluarga($id_kk, $no_bpjs)
  {
    // storing data
    $this->db->trans_begin();
    $this->M_anggota_keluarga->destroy($id_kk, $no_bpjs);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'detail-data-dasar/gagal_delete_anggota_keluarga/' . $id_kk;
      header("Location: $url");
    } else {
      $this->db->trans_commit();
      $url = base_url() . 'detail-data-dasar/sukses_delete_anggota_keluarga/' . $id_kk;
      header("Location: $url");
    }
  }

  public function destroy_perilaku_kes_kel($id_kk, $tgl_isi, $id_riwayat_kes_kel = NULL)
  {
    // init var - local
    $ar_trp = array();
    $tgl_isi_formatted = str_replace('%20', ' ', $tgl_isi);

    // storing data
    $this->db->trans_begin();
    $this->M_perilaku_kesehatan->destroy($id_kk, $tgl_isi_formatted);
    $this->M_perilaku_keselamatan->destroy($id_kk, $tgl_isi_formatted);

    if ( ! $id_riwayat_kes_kel) {
      // updating tingkat_risiko_penyakit
      $tingkat_risiko_penyakit = $this->get_tingkat_risiko_penyakit($id_kk, $id_riwayat_kes_kel);
      $ar_trp['tingkat_risiko_penyakit'] = $tingkat_risiko_penyakit;
      $this->update_tingkat_risiko_penyakit($id_kk, $id_riwayat_kes_kel, $ar_trp);
    }

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'detail-data-dasar/gagal_delete_perilaku_kesehatan/' . $id_kk;
      header("Location: $url");
    } else {
      $this->db->trans_commit();
      $url = base_url() . 'detail-data-dasar/sukses_delete_perilaku_kesehatan/' . $id_kk;
      header("Location: $url");
    } 
  }

  public function destroy_riwayat_kes_kel($id_kk, $id_riwayat_kes_kel)
  {
    // storing data
    $this->db->trans_begin();
    $this->M_r_kes_keluarga->destroy($id_kk, $id_riwayat_kes_kel);

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'detail-data-dasar/gagal_delete_data_dasar/' . $id_kk;
      header("Location: $url");
    } else {
      $this->db->trans_commit();
      $url = base_url() . 'detail-data-dasar/sukses_delete_data_dasar/' . $id_kk;
      header("Location: $url");
    } 
  }

  public function destroy_gejala_stres($id_kk, $id_gejala_stres)
  {
    // storing data
    $this->db->trans_begin();
    $this->M_gejala_stres->destroy_by_status($id_kk, $id_gejala_stres);

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'riwayat-data-dasar/' . $id_kk . '/gagal_delete_data_dasar';
      header("Location: $url");
    } else {
      $this->db->trans_commit();
      $url = base_url() . 'riwayat-data-dasar/' . $id_kk . '/sukses_delete_data_dasar';
      header("Location: $url");
    }
  }

  ///////////////////////////////////////////////
  // MODUL DATA DASAR - INDIVIDUAL INPUT / ADD //
  ///////////////////////////////////////////////
  public function add_ekonomi($alert_flag = NULL, $id_kk = NULL)
  {
    // init var - view data
    $view_data['id_kk'] = $id_kk;

    // checking passed arguments
    if ($alert_flag !== NULL) {
      if ($alert_flag != 'home') {
        $this->alert_vars = $this->load->view("alert_template/data_dasar/$alert_flag", '', TRUE);
      } else {
        if (strpos($id_kk, '-') === FALSE) {
          $this->alert_vars = $this->load->view("alert_template/data_dasar/$id_kk", '', TRUE);
        }
      }
    }

    // parsing template
    $this->template = $this->load->view('data_dasar/add/add_ekonomi', $view_data, TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      );

    // parsing view
    $page_title = 'Tambah Data Perilaku Kesehatan dan Keselamatan';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data,TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  public function add_perilaku($alert_flag = NULL, $id_kk = NULL)
  {
    // init var - view data
    $view_data['id_kk'] = $id_kk;

    // checking passed arguments
    if ($alert_flag !== NULL) {
      if ($alert_flag != 'home') {
        $this->alert_vars = $this->load->view("alert_template/data_dasar/$alert_flag", '', TRUE);
      } else {
        if (strpos($id_kk, '-') === FALSE) {
          $this->alert_vars = $this->load->view("alert_template/data_dasar/$id_kk", '', TRUE);
        }
      }
    }

    // parsing template
    $this->template = $this->load->view('data_dasar/add/add_perilaku', $view_data, TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      );

    // parsing view
    $page_title = 'Tambah Data Perilaku Kesehatan dan Keselamatan';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data,TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  public function add_riwayat_kes_kel($alert_flag = NULL, $id_kk = NULL)
  {
    // init var - view data
    $view_data['pasien'] = $this->M_pasien_identitas->get_data('no_bpjs, nama');

    $check_view_data = $this->dc->empty_view_data($view_data);
    if ( ! empty($check_view_data)) {
      $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
      $this->err_template_data = array(
        'alert_title' => 'Data Tidak Tersedia',
        'alert_msg' => 'Mohon maaf, data <strong>' . $check_view_data . '</strong> belum tersedia.',
        'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
        );
      $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
    }

    // check if view data is error
    foreach ($view_data as $key => $value) {
      if ($view_data[$key]['status'] == 'error') {
        $data_tabel[$key] = array();
        $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
        $this->err_template_data = array(
          'alert_title' => 'Kegagalan Pemuatan Data',
          'alert_msg' => 'Mohon maaf, proses pemuatan <strong>' . $key . '</strong> gagal dilakukan.',
          'alert_action' => '<strong>Mohon tunggu proses perbaikan</strong>'
          );
        $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
      } else {
        $data_tabel[$key] = $view_data[$key]['data'];
      }
    }

    // checking passed arguments
    if ($alert_flag !== NULL) {
      if ($alert_flag != 'home') {
        $this->alert_vars = $this->load->view("alert_template/data_dasar/$alert_flag", '', TRUE);
      } else {
        if (strpos($id_kk, '-') === FALSE) {
          $this->alert_vars = $this->load->view("alert_template/data_dasar/$id_kk", '', TRUE);
        }
      }
    }

    // init var - local
    $view_data['id_kk'] = $id_kk;

    // parsing template
    $this->template = $this->load->view('data_dasar/add/add_riwayat_kes_kel', $view_data, TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      );

    // parsing view
    $page_title = 'Tambah Data Dasar Kesehatan Keluarga';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data,TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  //////////////////////////////
  // MODUL DATA DASAR - INPUT //
  //////////////////////////////

  public function create($alert_flag = NULL, $id_kk = NULL)
  {
    // init - view data
    $view_data['provinsi'] = $this->M_provinsi->get_data();
    $view_data['kabupaten'] = $this->M_kabupaten->get_data();
    $view_data['kecamatan'] = $this->M_kecamatan->get_data();
    $view_data['kelurahan'] = $this->M_kelurahan->get_data();
    $view_data['pasien'] = $this->M_pasien_identitas->get_data();

    // check if view data is empty
    $check_view_data = $this->dc->empty_view_data($view_data);
    if ( ! empty($check_view_data)) {
      if ($check_view_data == 'pasien') {
        $alert_action = '<strong>Silahkan isi Data Identitas Pasien terlebih dahulu.</strong>';
      } else {
        $alert_action = '<strong>Mohon tunggu proses perbaikan</strong>';
      }
      
      $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
      $this->err_template_data = array(
        'alert_title' => 'Data Tidak Tersedia',
        'alert_msg' => 'Mohon maaf, data <strong>' . $check_view_data . '</strong> belum tersedia.',
        'alert_action' => $alert_action
        );
      $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
    }

    // checking passed arguments
    if ($alert_flag !== NULL) {
      if ($alert_flag != 'home') {
        $this->alert_vars = $this->load->view("alert_template/data_dasar/$alert_flag", '', TRUE);
      } else {
        if (strpos($id_kk, '-') === FALSE) {
          $this->alert_vars = $this->load->view("alert_template/data_dasar/$id_kk", '', TRUE);
        }
      }
    } 
    if ($id_kk !== NULL) {
      $view_data['id_kk'] = $this->M_kk->show($id_kk, 'id_kk');
      $view_data['perkawinan_ke'] = $this->M_data_perkawinan->show($id_kk, 'perkawinan_ke');
    } 

    // parsing template
    $this->template = $this->load->view('data_dasar/formulir_data_dasar', $view_data,TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars
      );
    
    // parsing view
    $page_title = 'Formulir Data Dasar Kesehatan Keluarga';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data,TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  public function store_identitas_pasien()
  {
    // validating form
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {      
      $this->create('gagal_form_invalid', NULL);
    } else {
      // init var - request param
      $data_pasien = $this->input->post();
      $data_pasien['tgl_lahir'] = $this->date_formatter($data_pasien['tgl_lahir'], 'Y-m-d');

      // storing data
      $this->db->trans_begin();
      $this->M_pasien_identitas->store($data_pasien);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-data-dasar/gagal_data_pasien';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'formulir-data-dasar/sukses_data_pasien';
        header("Location: $url");
      }
    }
  }

  public function store_riwayat_pekerjaan()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create('gagal_form_invalid', NULL);
    } else {
      // init var - request param
      $data_riwayat_pekerjaan = array();

      // storing data
      $this->db->trans_begin();
      foreach ($this->input->post('rp_no_bpjs[]') as $key => $value) {
        $data_riwayat_pekerjaan['id_riwayat_pekerjaan'] = $this->id_generator('RPK');
        $data_riwayat_pekerjaan['no_bpjs'] = $this->input->post('rp_no_bpjs[]')[$key];
        $data_riwayat_pekerjaan['pekerjaan'] = $this->input->post('rp_pekerjaan')[$key];
        $data_riwayat_pekerjaan['divisi'] = $this->input->post('rp_divisi[]')[$key];
        $data_riwayat_pekerjaan['sub_divisi'] = $this->input->post('rp_sub_divisi[]')[$key];
        $data_riwayat_pekerjaan['jenis_aktivitas'] = $this->input->post('rp_jenis_aktivitas[]')[$key];
        $data_riwayat_pekerjaan['dari_tahun'] = $this->input->post('rp_dari_tahun[]')[$key];
        $data_riwayat_pekerjaan['intensitas_aktivitas'] = $this->input->post('rp_intensitas_aktivitas[]')[$key];
        $data_riwayat_pekerjaan['sampai_tahun'] = $this->input->post('rp_sampai_tahun[]')[$key];
        $data_riwayat_pekerjaan['pekerjaan_utama'] = $this->input->post('rp_pekerjaan_utama[]')[$key];
        $this->M_riwayat_pekerjaan->store($data_riwayat_pekerjaan);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-data-dasar/gagal_data_riwayat_pekerjaan';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'formulir-data-dasar/sukses_data_riwayat_pekerjaan';
        header("Location: $url");
      }
    }
  }

  public function store_data_perkawinan()
  {
    // validating form
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create('gagal_form_invalid', NULL);
    } else {
      // init var - request param
      $ar_kk = array();
      $ar_pasangan = array();
      $ar_ak = array();
      $id_kk = $this->id_generator('KK');
      $psg_no_bpjs = $this->input->post('psg_no_bpjs[]');
      $hubungan_keluarga = $this->input->post('psg_hubungan_keluarga[]');
      $domisili_serumah = $this->input->post('psg_domisili_serumah[]');
      $status_kawin = $this->input->post('psg_status_kawin[]');
      $perkawinan_ke = $this->input->post('psg_perkawinan_ke[]');
      $umur_pasangan = $this->input->post('psg_umur_pasangan[]');

      // storing data
      $this->db->trans_begin();
      foreach ($psg_no_bpjs as $key => $value) {
        if ($key == 0) {
          // data kk
          $ar_kk['id_kk'] = $id_kk;
          $ar_kk['no_bpjs'] = $value;
          $ar_kk['no_telp'] = $this->input->post('psg_no_telp');
          $this->M_kk->store($ar_kk);
        } else {
          // data pasangan
          $ar_pasangan['id_data_perkawinan'] = $this->id_generator('KWN');
          $ar_pasangan['id_kk'] = $id_kk;
          $ar_pasangan['no_bpjs'] = $value;
          $ar_pasangan['perkawinan_ke'] = $perkawinan_ke[$key - 1];
          $ar_pasangan['umur_pasangan'] = $umur_pasangan[$key - 1];
          $ar_pasangan['status_kawin'] = $status_kawin[$key - 1];
          $this->M_data_perkawinan->store($ar_pasangan);
        }

        // data kk dan pasangan sebagai anggota keluarga
        $ar_ak['id_kk'] = $id_kk;
        $ar_ak['no_bpjs'] = $psg_no_bpjs[$key];
        $ar_ak['domisili_serumah'] = $domisili_serumah[$key];
        $ar_ak['hubungan_keluarga'] = $hubungan_keluarga[$key];
        $this->M_anggota_keluarga->store($ar_ak);
      }

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-data-dasar/gagal_data_perkawinan';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'formulir-data-dasar/sukses_data_perkawinan/' . $id_kk;
        header("Location: $url");
      }
    }
  }

  public function store_anggota_keluarga()
  {
    // validating form
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create('gagal_form_invalid', $this->input->post('id_kk'));
    } else {
      // init var - request param
      $ar_ak = array();
      $id_kk = $this->input->post('id_kk');
      $no_bpjs = $this->input->post('ak_no_bpjs[]');
      $domisili_serumah = $this->input->post('ak_domisili_serumah[]');
      $hubungan_keluarga = $this->input->post('ak_hubungan_keluarga[]');
      $perkawinan_ke = $this->input->post('ak_perkawinan_ke[]');

      // storing data
      $this->db->trans_begin();
      foreach ($no_bpjs as $key => $value) {
        $ar_ak['id_kk'] = $id_kk;
        $ar_ak['no_bpjs'] = $no_bpjs[$key];
        $ar_ak['domisili_serumah'] = $domisili_serumah[$key];
        $ar_ak['hubungan_keluarga'] = $hubungan_keluarga[$key];
        $ar_ak['perkawinan_ke'] = $perkawinan_ke[$key];
        $this->M_anggota_keluarga->store($ar_ak);
      }

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-data-dasar/gagal_data_anggota_keluarga/' . $id_kk;
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'formulir-data-dasar/sukses_data_anggota_keluarga/' . $id_kk;
        header("Location: $url");
      }
    }
  }

  public function store_ekonomi()
  {
    // init var - local
    $url = NULL;
    $url_gagal_input = NULL;
    $url_sukses_input = NULL;
    $url_gagal_add = NULL;
    $url_sukses_add = NULL;

    // validating form
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      if ( ! empty($this->input->post('is_add')) && $this->input->post('is_add') == 'yes') {
        $this->add_ekonomi('gagal_form_invalid', $this->input->post('id_kk'));
      } else {
        $this->create('gagal_form_invalid', $this->input->post('id_kk'));
      }
    } else {
      // init var - request param
      $id_kk = $this->input->post('id_kk');
      $input_var = $this->input->post();

      // set url
      $url_gagal_input = base_url() . 'formulir-data-dasar/gagal_data_ekonomi/' . $id_kk;
      $url_sukses_input = base_url() . 'formulir-data-dasar/sukses_data_ekonomi/' . $id_kk;
      $url_gagal_add = base_url() . 'add-ekonomi/gagal_data_ekonomi/' . $id_kk;
      $url_sukses_add = base_url() . 'add-ekonomi/sukses_data_ekonomi/' . $id_kk;

      // unsetting input_var that contains is_add key
      if ( ! empty($this->input->post('is_add'))) {
        unset($input_var['is_add']);
      }

      // storing data
      $this->db->trans_begin();
      $this->M_ekonomi->store($input_var);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        // set url based on form origin
        if ( ! empty($this->input->post('is_add'))) {
          $url = $url_gagal_add;
        } else {
          $url = $url_gagal_input;
        }
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        // set url based on form origin
        if ( ! empty($this->input->post('is_add'))) {
          $url = $url_sukses_add;
        } else {
          $url = $url_sukses_input;
        }
        header("Location: $url");
      }
    }
  }

  public function store_perilaku()
  {
    // init var - local
    $url = NULL;
    $url_gagal_input = NULL;
    $url_sukses_input = NULL;
    $url_gagal_add = NULL;
    $url_sukses_add = NULL;

    // validating form
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      if ( ! empty($this->input->post('is_add')) && $this->input->post('is_add') == 'yes') {
        $this->add_perilaku('gagal_form_invalid', $this->input->post('id_kk'));
      } else {
        $this->create('gagal_form_invalid', $this->input->post('id_kk'));
      }
    } else {
      // init var - request param
      $id_kk = $this->input->post('id_kk');
      $id_perilaku_kes = $this->id_generator('PKSH');
      $id_perilaku_keselamatan = $this->id_generator('PKSL');
      $input_var = $this->input->post();
      $tgl_isi = date('Y-m-d H:i:s');
      $ar_kesehatan = array();
      $ar_keselamatan = array();

      // set url
      $url_gagal_input = base_url() . 'formulir-data-dasar/gagal_data_perilaku_kesehatan/' . $id_kk;
      $url_sukses_input = base_url() . 'formulir-data-dasar/sukses_data_perilaku_kesehatan/' . $id_kk;
      $url_gagal_add = base_url() . 'add-perilaku/gagal_data_perilaku_kesehatan/' . $id_kk;
      $url_sukses_add = base_url() . 'add-perilaku/sukses_data_perilaku_kesehatan/' . $id_kk;

      // unsetting input_var that contains is_add key
      if ( ! empty($this->input->post('is_add'))) {
        unset($input_var['is_add']);
      }

      // populating variable
      $ar_kesehatan['id_perilaku_kes'] = $id_perilaku_kes;
      $ar_keselamatan['id_perilaku_keselamatan'] = $id_perilaku_keselamatan;
      $ar_kesehatan['tgl_isi'] = $tgl_isi;
      $ar_keselamatan['tgl_isi'] = $tgl_isi;
      foreach ($input_var as $key => $value) {
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

      // storing data
      $this->db->trans_begin();
      $this->M_perilaku_kesehatan->store($ar_kesehatan);
      $this->M_perilaku_keselamatan->store($ar_keselamatan);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        // set url based on form origin
        if ( ! empty($this->input->post('is_add'))) {
          $url = $url_gagal_add;
        } else {
          $url = $url_gagal_input;
        }
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        // set url based on form origin
        if ( ! empty($this->input->post('is_add'))) {
          $url = $url_sukses_add;
        } else {
          $url = $url_sukses_input;
        }
        header("Location: $url");
      }
    }
  }

  public function store_riwayat_kes()
  {
    // init var - local
    $tingkat_risiko_penyakit = 0;
    $ar_trp = array();
    $url = NULL;
    $url_gagal_input = NULL;
    $url_sukses_input = NULL;
    $url_gagal_add = NULL;
    $url_sukses_add = NULL;

    // validating form
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      if ( ! empty($this->input->post('is_add')) && $this->input->post('is_add') == 'yes') {
        $this->add_riwayat_kes_kel('gagal_form_invalid', $this->input->post('id_kk'));
      } else {
        $this->create('gagal_form_invalid', $this->input->post('id_kk'));
      }
    } else {
      // init var - request param
      $id_kk = $this->input->post('id_kk');
      $id_riwayat_kes_kel = $this->id_generator('KSKL');

      // set url
      $url_gagal_input = base_url() . 'formulir-data-dasar/gagal_data_perilaku_kesehatan/' . $id_kk;
      $url_sukses_input = base_url() . 'formulir-data-dasar/sukses_data_perilaku_kesehatan/' . $id_kk;
      $url_gagal_add = base_url() . 'add-riwayat-kes-kel/gagal_data_perilaku_kesehatan/' . $id_kk;
      $url_sukses_add = base_url() . 'add-riwayat-kes-kel/sukses_data_perilaku_kesehatan/' . $id_kk;

      // unsetting input_var that contains is_add key
      if ( ! empty($this->input->post('is_add'))) {
        unset($input_var['is_add']);
      }

      // storing data
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
          $id_riwayat_kes_kel,
          $this->input->post('sb_no_bpjs[]'),
          $this->input->post('sb_jenis_penyakit[]')
          );
      }
      // riwayat-3-bulan
      if ($this->input->post('tb_no_bpjs[]') !== NULL) {
        $this->riwayat_tiga_bulan(
          $this->input->post('id_kk'),
          $id_riwayat_kes_kel,
          $this->input->post('tb_no_bpjs[]'),
          $this->input->post('tb_jenis_penyakit[]')
          );
      }
      // riwayat-1-tahun
      if ($this->input->post('st_no_bpjs[]') !== NULL) {
        $this->riwayat_satu_tahun(
          $this->input->post('id_kk'),
          $id_riwayat_kes_kel,
          $this->input->post('st_no_bpjs[]'),
          $this->input->post('st_jenis_penyakit[]')
          );
      }

      // storing tingkat_risiko_penyakit
      $tingkat_risiko_penyakit = $this->get_tingkat_risiko_penyakit($id_kk, $id_riwayat_kes_kel);
      echo $tingkat_risiko_penyakit;
      // die();
      $ar_trp['tingkat_risiko_penyakit'] = $tingkat_risiko_penyakit;
      $this->update_tingkat_risiko_penyakit($id_kk, $id_riwayat_kes_kel, $ar_trp);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        // set url based on form origin
        if ( ! empty($this->input->post('is_add'))) {
          $url = $url_sukses_add;
        } else {
          $url = $url_sukses_input;
        }
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        // set url based on form origin
        if ( ! empty($this->input->post('is_add'))) {
          $url = $url_sukses_add;
        } else {
          $url = $url_sukses_input;
        }
        header("Location: $url");
      }
    }
  }

  public function store_gejala_stres()
  {
    // init var - local
    $tingkat_stres = 0;
    $ar_ts = array();
    $url_gagal_input = NULL;
    $url_sukses_input = NULL;
    $url_gagal_add = NULL;
    $url_sukses_add = NULL;

    // validating form
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      if ( ! empty($this->input->post('is_add')) && $this->input->post('is_add') == 'yes') {
        $this->add_riwayat_kes_kel('gagal_form_invalid', $this->input->post('id_kk'));
      } else {
        $this->create('gagal_form_invalid', $this->input->post('id_kk'));
      }
    } else {
      // init var - request param
      $id_kk = $this->input->post('id_kk');
      $id_gejala_stres = $this->id_generator('ST');
      $input_var = $this->input->post();
      $input_var['id_gejala_stres'] = $id_gejala_stres;
      $input_var['tgl_isi'] = date('Y-m-d H:i:s');

      // set url
      $url_gagal_input = base_url() . 'formulir-data-dasar/gagal_data_perilaku_kesehatan/' . $id_kk;
      $url_sukses_input = base_url() . 'formulir-data-dasar/sukses_data_perilaku_kesehatan/' . $id_kk;
      $url_gagal_add = base_url() . 'add-riwayat-kes-kel/gagal_data_perilaku_kesehatan/' . $id_kk;
      $url_sukses_add = base_url() . 'add-riwayat-kes-kel/sukses_data_perilaku_kesehatan/' . $id_kk;

      // unsetting input_var that contains is_add key
      if ( ! empty($this->input->post('is_add'))) {
        unset($input_var['is_add']);
      }

      // storing data
      $this->db->trans_begin();
      $this->M_gejala_stres->store($input_var);

      // storing tingkat_risiko_penyakit
      $tingkat_stres = $this->sum_skor_gejala_stres($id_kk, $id_gejala_stres);
      $ar_ts['tingkat_stres'] = $tingkat_stres;
      $this->update_tingkat_stres($id_kk, $id_gejala_stres, $ar_ts);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        // set url based on form origin
        if ( ! empty($this->input->post('is_add'))) {
          $url = $url_gagal_add;
        } else {
          $url = $url_gagal_input;
        }
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        // set url based on form origin
        if ( ! empty($this->input->post('is_add'))) {
          $url = $url_sukses_add;
        } else {
          $url = $url_sukses_input;
        }
        header("Location: $url");
      }
    }
  }

  ///////////////////////
  // RIWAYAT KESEHATAN //
  ///////////////////////

  public function riwayat_kes_kel($id_kk, $id_riwayat_kes_kel, $data = array())
  {
    // init var
    $no_bpjs = $this->M_kk->show($id_kk, 'no_bpjs');
    $tgl_isi = date('Y-m-d H:i:s');

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
        'olahraga' => $data['olahraga'],
        'tgl_isi' => $tgl_isi,
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
  private function riwayat_satu_bulan($id_kk, $id_riwayat_kes_kel, $no_bpjs = array(), $jenis_penyakit = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($no_bpjs as $key => $value) {
      $id_riwayat = $this->id_generator('SBLN');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
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
  private function riwayat_tiga_bulan($id_kk, $id_riwayat_kes_kel, $no_bpjs = array(), $jenis_penyakit = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($no_bpjs as $key => $value) {
      $id_riwayat = $this->id_generator('TBLN');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
      $data_riwayat['id_3bulan'] = $id_riwayat;
      $data_riwayat['no_bpjs'] = $no_bpjs[$key];
      $data_riwayat['jenis_penyakit'] = $jenis_penyakit[$key];
      $this->M_r_tiga_bulan->store($data_riwayat);
    }
  }

  private function riwayat_satu_tahun($id_kk, $id_riwayat_kes_kel, $no_bpjs = array(), $jenis_penyakit = array())
  {
    // INITIALIZE VAR
    $data_riwayat = array();

    foreach ($no_bpjs as $key => $value) {
      $id_riwayat = $this->id_generator('STHN');
      $data_riwayat['id_kk'] = $id_kk;
      $data_riwayat['id_riwayat_kes_kel'] = $id_riwayat_kes_kel;
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
      $data_riwayat['jenis_masalah_keturunan'] = $masalah_ket[$key];
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
    if ($durasi_berhenti !== NULL) {
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

  ////////////////////////////////////////////////
  // MODULE PERHITUNGAN TINGKAT RISIKO PENYAKIT //
  ////////////////////////////////////////////////
  
  public function count_anggota_sakit($id_kk, $id_riwayat_kes_kel)
  {
    // init var - local
    $satu_bulan = 0;
    $tiga_bulan = 0;
    $satu_tahun = 0;
    // init var - local
    $satu_bulan = $this->M_r_satu_bulan->count_distinct_by_kk($id_kk, $id_riwayat_kes_kel);
    $tiga_bulan = $this->M_r_tiga_bulan->count_distinct_by_kk($id_kk, $id_riwayat_kes_kel);
    $satu_tahun = $this->M_r_satu_tahun->count_distinct_by_kk($id_kk, $id_riwayat_kes_kel);

    return $satu_bulan + $tiga_bulan + $satu_tahun;
  }

  public function count_anggota_keluarga($id_kk)
  {
    // init var - local
    $anggota_keluarga = 0;
    // init var - view data
    $anggota_keluarga = $this->M_anggota_keluarga->count_by_kk($id_kk);

    return $anggota_keluarga;
  }

  public function get_percentage_pk($id_kk, $id_riwayat_kes_kel)
  {
    // init var - local
    $pk = 0;

    // init var - view data
    $pk = $this->M_r_masalah_keturunan->count_distinct_by_kk($id_kk, $id_riwayat_kes_kel);
    
    return $pk * 6;
  }

  public function get_percentage_frk($id_kk, $id_riwayat_kes_kel)
  {
    // init var - local
    $merokok = 0;
    $jamu = 0;
    $kasur_busa = 0;
    $sepeda_motor = 0;
    $kerja_pabrik = 0;

    // init var - view data
    $merokok = $this->M_r_kes_keluarga->count_merokok_by_kk($id_kk, $id_riwayat_kes_kel);
    $jamu = $this->M_r_kes_keluarga->count_jamu_by_kk($id_kk, $id_riwayat_kes_kel);
    $kasur_busa = $this->M_perilaku_kesehatan->count_distinct_kasur_busa_by_kk($id_kk);
    $sepeda_motor = $this->M_perilaku_keselamatan->count_distinct_sepeda_motor_by_kk($id_kk);
    $kerja_pabrik = $this->M_riwayat_pekerjaan->count_pabrik_by_kk($id_kk);

    return ($merokok + $jamu + $kasur_busa + $sepeda_motor + $kerja_pabrik) * 6;
  }

  public function get_tingkat_risiko_penyakit($id_kk, $id_riwayat_kes_kel)
  {
    // init var - local
    $anggota_sakit = 0;
    $anggota_keluarga = 0;
    $k = 0.00;
    $pk = 0.00;
    $frk = 0.00;
    $tingkat_risiko_penyakit = 0.00;

    $anggota_sakit = $this->count_anggota_sakit($id_kk, $id_riwayat_kes_kel);
    $anggota_keluarga = $this->count_anggota_keluarga($id_kk);
    $pk = $this->get_percentage_pk($id_kk, $id_riwayat_kes_kel);
    $frk = $this->get_percentage_frk($id_kk, $id_riwayat_kes_kel);

    $k = (($anggota_sakit / $anggota_keluarga) * 1) * 40;
    $tingkat_risiko_penyakit = $k + $pk + $frk;

    return $tingkat_risiko_penyakit;
  }

  public function update_tingkat_risiko_penyakit($id_kk, $id_riwayat_kes_kel, $trp = array())
  {
    $no_bpjs = $this->M_kk->show($id_kk, 'no_bpjs');
    $this->M_r_kes_keluarga->update($id_kk, $id_riwayat_kes_kel, $no_bpjs['data'][0]['no_bpjs'], $trp);
  }

  //////////////////////////////////////////////
  // MODULE PENGHITUNGAN TINGKAT STRES PASIEN //
  //////////////////////////////////////////////

  public function sum_skor_gejala_stres($id_kk, $id_gejala_stres)
  {
    // init var - local
    $skor = 0;

    $skor = $this->M_gejala_stres->sum_skor_kuesioner($id_kk, $id_gejala_stres);
    return $skor[0]['skor'];
  }

  public function update_tingkat_stres($id_kk, $id_gejala_stres, $ts = array())
  {
    $this->M_gejala_stres->update($id_kk, $id_gejala_stres, $ts);
  }
}