<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_pencatatan_obat_keluar extends CI_Controller
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

    if ($this->session->userdata('aktif') !== TRUE) {
      $url = base_url();
      header("Location: $url");
    } else { 
      if ($this->session->userdata('tabel') != 'kefarmasian') {
        $url = base_url();
        header("Location: $url");
      }
    }
  }

  /**
   * SIKP-PF-142
   * @param  [type] $page_title    [description]
   * @param  [type] $css_framework [description]
   * @param  [type] $page_content  [description]
   * @param  [type] $js_framework  [description]
   * @return [type]                [description]
   */
  private function parse_view($page_title, $css_framework, $page_content, $js_framework)
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

  /**
   * SIKP-PF-143
   * @param  [type] $date_string [description]
   * @param  [type] $format      [description]
   * @return [type]              [description]
   */
  private function date_formatter($date_string, $format)
  {
    $date_object = date_create($date_string);
    $formatted_date = date_format($date_object, $format);
    return $formatted_date;
  }

  /**
   * SIKP-PF-144
   * @param  [type] $prefix [description]
   * @return [type]         [description]
   */
  private function id_generator($prefix)
  {
    $micro_time = microtime();
    $ex_mt = explode(' ', $micro_time);
    $sbstr_mt = substr($ex_mt[0], 5, 3);
    $id = $prefix . '-' . date('ymdHis') . $sbstr_mt;
    return $id;
  }

  public function index()
  {
    $url = base_url();
    header("Location: $url");
  }

  /**
   * SIKP-PF-203
   * @return [type] [description]
   */
  public function show_status_by_resep()
  {
    $id_resep_obat = $this->input->post('id_resep_obat');
    $result = $this->M_status->show_pasien_by_resep($id_resep_obat, 'a.id_registrasi, b.nama, a.no_bpjs, YEAR(CURRENT_DATE()) - YEAR(b.tgl_lahir) as umur, b.jenis_kelamin, c.poli , c.nama as nama_dokter');
    echo json_encode($result);
  }

  /**
   * SIKP-PF-145
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function get_data($alert_flag = NULL)
  {
    // init var - view data
    $view_data['obat'] = $this->M_obat_keluar->get_data_obat('a.id_obat_keluar, c.id_resep_obat, d.nama as nama_pasien, a.id_obat, b.nama, a.jumlah_keluar, b.satuan, a.tgl_keluar');
    $view_data['laporan_bulan'] = $this->M_obat_keluar_bulan->get_data_bulan('bulan, tahun, DATE_FORMAT(STR_TO_DATE(CONCAT(bulan,\'-\',tahun), \'%m-%Y\'), \'%Y-%m\') as new_bulan');

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
      } else {
        // assign data tabel
        $data_tabel[$key] = $view_data[$key]['data'];
        if (empty($data_tabel[$key])) {
          $data_tabel[$key] = array();
        }
      }
    }

    // parsing error template for empty data tabel
    $check_data_tabel = $this->dc->empty_data_tabel($data_tabel);
    if ( ! empty($check_data_tabel)) {
      $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
      $this->err_template_data = array(
        'alert_title' => 'Data Tidak Tersedia',
        'alert_msg' => 'Mohon maaf, data <strong>' . $check_data_tabel . '</strong> belum tersedia.',
        'alert_action' => $alert_action
        );
      $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
    }

    if ($alert_flag !== NULL) {
      $this->alert_vars = $this->load->view("alert_template/pengelolaan_obat/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengelolaan_obat/data_obat_keluar', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'obat_harian' => $this->replace_get_data($data_tabel['obat']),
      'obat_bulanan' => $this->replace_get_data_obat_bulanan($data_tabel['laporan_bulan']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Laporan Obat Keluar', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-146
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_get_data($data = array())
  {
    // init var - local
    $ret_val = array();
    $id_resep_obat = NULL;

    // init var - array replace
    $satuan = array(
      '1' => 'Butir',
      '2' => 'Botol',
    );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      // init var - array for replacement
      $id_resep_obat = $value['id_resep_obat'];

      // replacing array
      $value['new_id_resep_obat'] = substr($id_resep_obat, 0, 4) . substr($id_resep_obat, 6, 4) . substr($id_resep_obat, 12, 2);;
      $value['nama_pasien'] = strtoupper($value['nama_pasien']);
      $value['nama'] = strtoupper($value['nama']);
      $value['satuan'] = str_replace(array_keys($satuan), $satuan, $value['satuan']);
      $value['tgl_keluar'] = $this->date_formatter($value['tgl_keluar'], 'd-M-Y');
      array_push($ret_val, $value);
    }
    return $ret_val;
  }

  /**
   * SIKP-PF-216
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  public function replace_get_data_obat_bulanan($data = array())
  {
    // init var - local
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      // replacing array
      $value['new_bulan'] = $this->date_formatter($value['new_bulan'], 'M-Y');
      array_push($ret_val, $value);
    }
    return $ret_val;
  }

  /**
   * SIKP-PF-147
   * return json array for ajax purpose
   * @return [type] [description]
   */
  public function show_sisa_obat()
  {
    // INITIALIZE VAR
    $id_obat = $this->input->post('id_obat');
    $result = $this->M_obat->show($id_obat, 'jumlah');
    echo json_encode($result);
  }

  /**
   * SIKP-PF-148
   * Sequence Diagram - Menambah Catatan Obat Keluar
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function create($alert_flag = NULL, $id_resep_obat = NULL)
  {
    // init var - view data
    $view_data['resep'] = $this->M_resep_obat->show_resep_baru_status();
    $view_data['obat'] = $this->M_obat->get_data();

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

    // parsing error template for empty data tabel
    $check_data_tabel = $this->dc->empty_data_tabel($data_tabel);
    if ( ! empty($check_data_tabel)) {
      $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
      $this->err_template_data = array(
        'alert_title' => 'Data Tidak Tersedia',
        'alert_msg' => 'Mohon maaf, data <strong>' . $check_data_tabel . '</strong> belum tersedia.',
        'alert_action' => $alert_action
        );
      $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
    }

    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/pengelolaan_obat/$alert_flag", '', TRUE);
      if ($alert_flag == 'sukses_obat_keluar') {
        if ( ! empty($id_resep_obat)) {
          $vd['id_resep_obat'] = $id_resep_obat;
          $this->alert_vars = $this->load->view("alert_template/pengelolaan_obat/$alert_flag", $vd, TRUE);
        }
      }
    }

    // parsing template
    $this->template = $this->load->view('pengelolaan_obat/pencatatan_obat_keluar', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'resep' => $this->replace_resep($data_tabel['resep']),
      'obat' => $this->replace_obat($data_tabel['obat']),
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);

    $this->parse_view('Formulir Pencatatan Obat Keluar', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-149
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  public function replace_resep($data = array())
  {
    // init var - local
    $ret_val = array();

    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /**
   * SIKP-PF-150
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  public function replace_obat($data = array())
  {
    // init var - local
    $ret_val = array();

    // init var - array replacer
    $satuan = array(
      '1' => 'Butir',
      '2' => 'Botol',
    );

    foreach ($data as $key => $value) {
      // replacing array
      $value['nama'] = ucwords($value['nama']);
      $value['satuan'] = str_replace(array_keys($satuan), $satuan, $value['satuan']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /**
   * SIKP-PF-151
   * Sequence Diagram - Menyimpan Catatan Obat Keluar
   * @return [type] [description]
   */
  public function store()
  {
    // init var - local
    $data_obat_keluar = array();
    $data_obat_bulan = array();

    $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '<p><small><strong>Silahkan ulangi pengisian data</strong></small></p></div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create('gagal_form_invalid');
    } else {
      $input_var = $this->input->post();

      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($input_var['id_obat'] as $key => $value) {
        // assign var - data_obat_keluar
        $data_obat_keluar['id_obat_keluar'] = $this->id_generator('OBK');
        $data_obat_keluar['id_resep_obat'] = $input_var['id_resep_obat'];
        $data_obat_keluar['id_obat'] = $value;
        $data_obat_keluar['a_signa'] = $input_var['a_signa'][$key];
        $data_obat_keluar['b_signa'] = $input_var['b_signa'][$key];
        $data_obat_keluar['jumlah_keluar'] = $input_var['jumlah_keluar'][$key];
        $data_obat_keluar['tgl_keluar'] = date('Y-m-d');

        $jumlah_keluar = $data_obat_keluar['jumlah_keluar'];

        // assign var - data_obat_bulan
        $data_obat_bulan['id_obat'] = $value;
        $data_obat_bulan['bulan'] = $this->date_formatter($data_obat_keluar['tgl_keluar'], 'm');
        $data_obat_bulan['tahun'] = $this->date_formatter($data_obat_keluar['tgl_keluar'], 'Y');
        $data_obat_bulan['jml_keluar'] = $jumlah_keluar;
        
        // exexuting query
        $this->M_obat_keluar->store($data_obat_keluar);
        $this->M_obat->update_persediaan($value, 'kurang', $jumlah_keluar);
        if ($this->check_if_any_catatan_bulan($data_obat_bulan['id_obat'], $data_obat_bulan['bulan'], $data_obat_bulan['tahun']) === TRUE) {
          $this->M_obat_keluar_bulan->update_laporan($data_obat_bulan['id_obat'], $data_obat_bulan['bulan'], $data_obat_bulan['tahun'], $data_obat_bulan['jml_keluar'], strtolower('keluar'));
        } else {
          $data_obat_bulan['sisa'] = $this->get_total_obat($data_obat_bulan['id_obat']); // sisa obat sudah ditambah dengan jumlah masuk karena query pertama (update_persediaan)
          $data_obat_bulan['jml_masuk'] = $this->get_total_obat($data_obat_bulan['id_obat']) + $data_obat_bulan['jml_keluar'];
          $this->M_obat_keluar_bulan->store($data_obat_bulan);
        }
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-pencatatan-obat-keluar/gagal_obat_keluar';
        header("Location: $url");
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $url = base_url() . 'formulir-pencatatan-obat-keluar/sukses_obat_keluar/' . $input_var['id_resep_obat'];
        header("Location: $url");
      }
    }
  }

  /**
   * SIKP-PF-201
   * @param  [type] $id_obat [description]
   * @param  [type] $bulan   [description]
   * @param  [type] $tahun   [description]
   * @return [type]          [description]
   */
  public function check_if_any_catatan_bulan($id_obat, $bulan, $tahun)
  {
    // init var - local
    $ret_val = FALSE;

    // init var - view data
    $view_data['catatan_bulanan'] = $this->M_obat_keluar_bulan->show_if_any($id_obat, $bulan, $tahun);

    // check if any catatan bulanan
    if ($view_data['catatan_bulanan'] > 0) {
      $ret_val = TRUE;
    }

    return $ret_val;   
  }

  /**
   * SIKP-PF-202
   * @param  [type] $id_obat [description]
   * @return [type]          [description]
   */
  public function get_total_obat($id_obat)
  {
    // init var - view_data
    $view_data['jumlah'] = $this->M_obat->show($id_obat, 'jumlah');

    return intval($view_data['jumlah']['data'][0]['jumlah']);
  }

  /**
   * SIKP-PF-204
   * Sequence Diagram - Melihat Riwayat Resep Obat
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function get_data_resep_keluar($alert_flag = NULL)
  {
    // init var - view data
    $view_data['resep_keluar'] = $this->M_obat_keluar->get_resep_keluar('c.id_registrasi, a.id_resep_obat, e.nama as nama_pasien, d.poli, d.nama as nama_dokter, a.tgl_keluar');

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
      } else {
        // assign data tabel
        $data_tabel[$key] = $view_data[$key]['data'];
        if (empty($data_tabel[$key])) {
          $data_tabel[$key] = array();
        }
      }
    }

    // parsing error template for empty data tabel
    $check_data_tabel = $this->dc->empty_data_tabel($data_tabel);
    if ( ! empty($check_data_tabel)) {
      $this->err_template = $this->load->view('alert_template/alert_data_tidak_tersedia', '', TRUE);
      $this->err_template_data = array(
        'alert_title' => 'Data Tidak Tersedia',
        'alert_msg' => 'Mohon maaf, data <strong>' . $check_data_tabel . '</strong> belum tersedia.',
        'alert_action' => $alert_action
        );
      $this->err_vars = $this->parser->parse_string($this->err_template, $this->err_template_data, TRUE);
    }

    if ($alert_flag !== NULL) {
      $this->alert_vars = $this->load->view("alert_template/pengelolaan_obat/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengelolaan_obat/data_resep_keluar', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_get_data_resep_keluar($data_tabel['resep_keluar']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Laporan Obat Keluar', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-205
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_get_data_resep_keluar($data = array())
  {
    // init var - local
    $ret_val = array();
    $id_registrasi = NULL;
    $id_resep_obat = NULL;

    foreach ($data as $key => $value) {
      // assign var - array replacement
      $id_registrasi = $value['id_registrasi'];
      $id_resep_obat = $value['id_resep_obat'];

      // replacing array
      $value['new_id_registrasi'] = substr($id_registrasi, 0, 4) . substr($id_registrasi, 6, 4) . substr($id_registrasi, 12, 2);
      $value['new_id_resep_obat'] = substr($id_resep_obat, 0, 4) . substr($id_resep_obat, 6, 4) . substr($id_resep_obat, 12, 2);
      $value['nama_pasien'] = ucwords($value['nama_pasien']);
      $value['poli'] = ucwords($value['poli']);
      $value['nama_dokter'] = ucwords($value['nama_dokter']);
      $value['tgl_keluar'] = $this->date_formatter($value['tgl_keluar'], 'd-M-Y');
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /////////////////////////////
  // CETAK RESEP DAN LAPORAN //
  /////////////////////////////
  /**
   * SIKP-PF-206
   * Sequence Diagram - Menerbitkan Resep Obat
   * @param  [type] $id_resep_obat [description]
   * @return [type]                [description]
   */
  public function cetak_resep_obat($id_resep_obat)
  {
    // init data - local
    $nama_file = NULL;

    // init var - view data
    $view_data['resep_obat'] = $this->M_resep_obat->get_data_cetak_resep($id_resep_obat, 'd.nama, e.nama as nama_dokter, e.poli, b.tgl_keluar, c.nama as nama_obat, b.a_signa, b.b_signa, b.jumlah_keluar, c.satuan');

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
      } else {
        // assign data tabel
        $data_tabel[$key] = $view_data[$key]['data'];
        if (empty($data_tabel[$key])) {
          $data_tabel[$key] = array();
        }
      }
    }

    // init nama file
    $nama_file_raw = array_unique($data_tabel['resep_obat']);
    $new_id_resep_obat = substr($id_resep_obat, 0, 4) . substr($id_resep_obat, 6, 4) . substr($id_resep_obat, 12, 2);
    foreach ($nama_file_raw as $value) {
      $nama_pasien_raw = explode(' ', $value['nama']);
      $nama_depan = $nama_pasien_raw[0];
      $nama_file = $new_id_resep_obat . '_' . $nama_depan;
    }

    // echo $nama_file;
    // die();
    
    // generating pdf file
    $this->load->library('pdf');
    $this->pdf->set_paper('a5', 'potrait');
    $this->pdf->load_view('pengelolaan_obat/export/resep_obat', $data_tabel);
    $this->pdf->render();
    $this->pdf->stream("$nama_file.pdf");
  }

  /**
   * SIKP-PF-152
   * @return [type] [description]
   */
  public function cetak_laporan_obat_keluar()
  {
    // init var - local
    $opsi = $this->input->post('opsi');
    $from = $this->input->post('dari_tanggal');
    $to = $this->input->post('sampai_tanggal');

    if ($opsi === '1') {
      $this->laporan_harian($from, $to);
    } else if ($opsi === '2') {
      $this->laporan_bulanan($this->date_formatter($from, 'Y-m'), $this->date_formatter($to, 'Y-m'));
    } else {
      $url = base_url() . 'data-obat-keluar/' . 'gagal_cetak_laporan';
      header("Location: $url");
    }
  }

  /**
   * SIKP-PF-207
   * @param  [type] $from [description]
   * @param  [type] $to   [description]
   * @return [type]       [description]
   */
  public function laporan_harian($from, $to)
  {
    // init var - view_data
    $view_data['laporan'] = $this->M_obat_keluar->get_data_by_range($from, $to, 'a.id_obat, b.nama, SUM(a.jumlah_keluar) as jumlah_keluar, b.satuan, a.tgl_keluar');

    foreach ($view_data as $key => $value) {
      if ($view_data[$key]['status'] == 'error') {
        $url = base_url() . 'data-obat-keluar/' . 'gagal_cetak_laporan';
        header("Location: $url");
        break;
      } else {
        $data_tabel[$key] = $view_data[$key]['data'];
        if (empty($data_tabel[$key])) {
          $data_tabel[$key] = array();
        }
      }
    }

    $data_tabel['from'] = $this->date_formatter($from, 'd-M-Y');
    $data_tabel['to'] = $this->date_formatter($to, 'd-M-Y');
    $data_tabel['filename'] = 'laporan_harian ' . $data_tabel['from'] . '-' . $data_tabel['to'];

    $this->load->view('pengelolaan_obat/export/obat_keluar_harian', $data_tabel);

    // generating pdf file
    // $this->load->library('pdf');
    // $this->pdf->set_paper('a4', 'portrait');
    // $this->pdf->load_view('pengelolaan_obat/export/obat_keluar_harian', $data_tabel);
    // $this->pdf->render();
    // $this->pdf->get_canvas()->page_text(16, 810, "Halaman: {PAGE_NUM} dari {PAGE_COUNT}", 'Arial', 7, array(0,0,0));
    // $this->pdf->stream("laporan_obat_keluar.pdf", array("Attachment" => 0));
  }

  /**
   * SIKP-PF-208
   * @param  [type] $from [description]
   * @param  [type] $to   [description]
   * @return [type]       [description]
   */
  public function laporan_bulanan($from, $to)
  {
    // init var - local
    $n_from = $this->date_formatter($from, 'Y-m');
    $n_to = $this->date_formatter($to, 'Y-m');

    // init var - view_data
    $view_data['laporan'] = $this->M_obat_keluar_bulan->get_data_by_range($n_from, $n_to, 'DATE_FORMAT(STR_TO_DATE(CONCAT(a.bulan,\'-\',a.tahun), \'%m-%Y\'), \'%Y-%m\') as bulan, b.nama, a.jml_masuk, a.jml_keluar, a.sisa, b.satuan');

    // var_dump($view_data);
    // die();

    foreach ($view_data as $key => $value) {
      if ($view_data[$key]['status'] == 'error') {
        $url = base_url() . 'data-obat-keluar/' . 'gagal_cetak_laporan';
        header("Location: $url");
        break;
      } else {
        $data_tabel[$key] = $view_data[$key]['data'];
        if (empty($data_tabel[$key])) {
          $data_tabel[$key] = array();
        }
      }
    }

    $data_tabel['from'] = $this->date_formatter($from, 'M-Y');
    $data_tabel['to'] = $this->date_formatter($to, 'M-Y');
    $data_tabel['filename'] = 'laporan_bulanan ' . $data_tabel['from'] . '-' . $data_tabel['to'];

    $this->load->view('pengelolaan_obat/export/obat_keluar_bulanan', $data_tabel);
  }

  /**
   * SIKP-PF-153
   * @param  [type] $id_obat_keluar [description]
   * @return [type]                 [description]
   */
  public function destroy($id_obat_keluar)
  {
    // init var - view data
    $view_data = $this->M_obat_keluar->show($id_obat_keluar, 'a.id_obat, a.jumlah_keluar, a.tgl_keluar');

    // init var
    $id_obat = $view_data['data']['0']['id_obat'];
    $jumlah_keluar = $view_data['data']['0']['jumlah_keluar'];
    $tgl_keluar = $view_data['data']['0']['tgl_keluar'];

    // deleting data
    $this->db->trans_begin();
    $this->M_obat_keluar->destroy($id_obat_keluar);
    $this->M_obat->update_persediaan($id_obat, strtolower('tambah'), $jumlah_keluar);
    $this->M_obat_keluar_bulan->update_undo_laporan($id_obat, $this->date_formatter($tgl_keluar, 'm'), $this->date_formatter($tgl_keluar, 'Y'), $jumlah_keluar, strtolower('keluar'));
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'data-obat-keluar/' . 'gagal_hapus_obat_keluar';
      header("Location: $url");
    } else {
      // $this->db->trans_rollback();
      $this->db->trans_commit();
      $url = base_url() . 'data-obat-keluar/' . 'sukses_hapus_obat_keluar';
      header("Location: $url");
    }
  }
}
