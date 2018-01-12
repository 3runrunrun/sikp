<?php 

/**
* 
*/
class C_pengobatan_holistik extends CI_Controller
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
      switch ($urisegment) {
        case 'riwayat-pengobatan':
        case 'riwayat-cek-darah':
        case 'pendaftaran-pasien':
        case 'pasien-terdaftar-harian':
        case 'simpan-pendaftaran-pasien':
        case 'pendaftaran-cek-darah':
        case 'simpan-cek-darah':
        case 'hapus-cek-darah':
          if ($this->session->userdata('tabel') != 'administrasi') {
            $url = base_url();
            header("Location: $url");
          }
          break;

        case 'pasien-anamnesis-harian':
        case 'formulir-anamnesis':
        case 'simpan-anamnesis':
        case 'destroy-anamnesis':
        case 'hasil-cek-darah':
        case 'store-hasil-cek-darah':
          if ($this->session->userdata('tabel') != 'keperawatan') {
            $url = base_url();
            header("Location: $url");
          }
          break;
          
        /*case 'destroy-riwayat-pengobatan':
          if ($this->session->userdata('tabel') == 'keperawatan') {
            $url = base_url();
            header("Location: $url");
          }
          break;*/

        case 'pasien-diagnosis-harian':
        case 'formulir-diagnosis':
        case 'simpan-diagnosis':
        case 'destroy-diagnosis':
        case 'formulir-intervensi':
        case 'simpan-intervensi':
          if ($this->session->userdata('tabel') != 'medis') {
            $url = base_url();
            header("Location: $url");
          }
          break;

        case 'destroy-riwayat-pengobatan':
          if ($this->session->userdata('tabel') != 'administrasi' || $this->session->userdata('tabel') != 'medis') {
            $url = base_url();
            header("Location: $url");
          }
          break;
        
        default:
          if ($this->session->userdata('tabel') == 'kefarmasian') {
            $url = base_url();
            header("Location: $url");
          }
          break;
      }
    }
  }

  /**
   * SIKP-PF-80
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
   * SIKP-PF-81
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

  /**
   * SIKP-PF-82
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

  public function index()
  {
    # TEST YOUR CODE HERE
  }

  /////////////////////////////////////
  // PENDAFTARAN PENGOBATAN HOLISTIK //
  /////////////////////////////////////
  /**
   * SIKP-PF-83
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_pasien($data = array())
  {
    // init var - return var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /**
   * SIKP-PF-84
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_dokter($data = array())
  {
    // init var - return var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['poli'] = ucwords($value['poli']);
      $value['nama'] = ucwords($value['nama']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /**
   * SIKP-PF-85
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_pasien_harian($data = array())
  {
    // init var - return var
    $ret_val = array();
    $id_registrasi = NULL;
    $no_bpjs = NULL;
    $btn_anamnesis = NULL;

    // init var
    $status = array(
      'terdaftar' => '<span class="badge bg-blue">Terdaftar</span>',
      'anamnesis' => '<span class="badge bg-yellow">Tahap Anamnesis</span>',
      'diagnosis' => '<span class="badge bg-red">Tahap Diagnosis</span>',
      'intervensi' => '<span class="badge bg-green">Tahap Intervensi</span>',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      // init var - local
      $id_registrasi = $value['id_registrasi'];
      $no_bpjs = $value['no_bpjs'];
      
      // init var - array for replacement
      $btn_detail = "<button type='button' class='btn btn-sm btn-primary' onclick=\"window.location='" . base_url() . "detail-pengobatan/$id_registrasi/$no_bpjs'\"><i class='fa fa-eye'></i></button>";
      $btn_delete = "<button type='button' class='btn btn-sm btn-danger' onclick=\"window.location='" . base_url() . "destroy-riwayat-pengobatan/$id_registrasi/$no_bpjs'\"><i class='fa fa-remove'></i></button>";

      // replacing array
      $value['new_id_registrasi'] = substr($id_registrasi, 0, 4) . substr($id_registrasi, 6, 4) . substr($id_registrasi, 12, 2);
      $value['opsi'] = $btn_detail.$btn_delete;

      $value['nama'] = ucwords($value['nama']);
      $value['tgl_periksa'] = $this->date_formatter($value['tgl_periksa'], 'd-M-Y H:i');
      $value['poli'] = 'Poli ' . ucwords($value['poli']);
      $value['status'] = str_replace(array_keys($status), $status, $value['status']);

      array_push($ret_val, $value);
    }
    return $ret_val;
  }

  /**
   * SIKP-PF-86
   * @param  [type] $alert_flag    [description]
   * @param  [type] $id_registrasi [description]
   * @param  [type] $no_bpjs       [description]
   * @return [type]                [description]
   */
  public function create($alert_flag = NULL, $id_registrasi = NULL, $no_bpjs = NULL)
  {
    // init var - local
    $page_content = NULL;
    $data_tabel = array();

    // init - view data
    $view_data['pasien'] = $this->M_pasien_identitas->get_data('no_bpjs, nama');
    $view_data['dokter'] = $this->M_pegawai->get_data_dokter();
    $view_data['pasien_harian'] = $this->M_status->get_data_harian('a.id_registrasi, a.no_bpjs, c.nama, a.tgl_periksa, b.poli, a.status', array('terdaftar', 'anamnesis', 'diagnosis', 'intervensi'));

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
    
    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
      if ( ! empty($id_registrasi) && ! empty($no_bpjs)) {
        $new_id_registrasi = substr($id_registrasi, 0, 4) . substr($id_registrasi, 6, 4) . substr($id_registrasi, 12, 2);
        $this->alert_template = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
        $this->alert_template_data = array(
          'no_bpjs' => $no_bpjs,
          'new_id_registrasi' => $new_id_registrasi,
          );
        $this->alert_vars = $this->parser->parse_string($this->alert_template, $this->alert_template_data, TRUE);
      }
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/formulir_pengobatan_holistik', '',TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_pasien' => $this->replace_create_pasien($data_tabel['pasien']),
      'data_dokter' => $this->replace_create_dokter($data_tabel['dokter']),
      'data_tabel' => $this->replace_create_pasien_harian($data_tabel['pasien_harian']),
      );
    
    // parsing view
    $page_title = 'Formulir Pengobatan Holistik';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE) . $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data,TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE) . $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-87
   * @return [type] [description]
   */
  public function store_pendaftaran_pengobatan()
  {
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $this->create('gagal_form_invalid');
    } else {
      // init var - local
      $ar_pendaftaran = array();
      $id_registrasi = $this->id_generator('STS');
      $tgl_periksa = date('Y-m-d H:i:s');

      // init var - request param
      $ar_pendaftaran = $this->input->post();
      $ar_pendaftaran['id_registrasi'] = $id_registrasi;
      $ar_pendaftaran['tgl_periksa'] = $tgl_periksa;
      $no_bpjs = $ar_pendaftaran['no_bpjs'];

      // var_dump($this->input->post());
      // var_dump($ar_pendaftaran);

      // storing data
      $this->db->trans_begin();
      $this->M_status->store($ar_pendaftaran);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'pendaftaran-pasien/gagal_pendaftaran_pasien';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'pendaftaran-pasien/sukses_pendaftaran_pasien/' . $id_registrasi . '/' . $no_bpjs;
        header("Location: $url");
      }
    }
  }

  ///////////////
  // CEK DARAH //
  ///////////////
  /**
   * SIKP-PF-193
   * @param  [type] $alert_flag         [description]
   * @param  [type] $no_surat_pengantar [description]
   * @return [type]                     [description]
   */
  public function create_cek_darah($alert_flag = NULL, $no_surat_pengantar = NULL)
  {
    // init var - local
    $page_content = NULL;
    $data_tabel = array();

    // init var - view data
    $view_data['pasien'] = $this->M_pasien_identitas->get_data('no_bpjs, nama');
    $view_data['cek_darah_harian'] = $this->M_cek_darah->get_data_harian('a.no_surat_pengantar, a.no_bpjs, b.nama, a.tgl_cek_darah, a.gd_kolesterol, COALESCE(a.h_kolesterol, \'-\') as h_kolesterol, a.gd_puasa, COALESCE(a.h_puasa, \'-\') as h_puasa, a.gd_acak, COALESCE(a.h_acak, \'-\') as h_acak, a.gd_asam_urat, COALESCE(a.h_asam_urat, \'-\') as h_asam_urat, a.status');

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

    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
      if ( ! empty($no_surat_pengantar)) {
        $this->alert_template = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
        $this->alert_template_data = array(
          'new_no_surat_pengantar' => $no_surat_pengantar,
          );
        $this->alert_vars = $this->parser->parse_string($this->alert_template, $this->alert_template_data, TRUE);
      }
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/formulir_cek_darah', '',TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_pasien' => $this->replace_create_pasien($data_tabel['pasien']),
      'data_tabel' => $this->replace_create_cek_darah($data_tabel['cek_darah_harian']),
      );
    
    // parsing view
    $page_title = 'Formulir Pendaftaran Cek Darah';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE) . $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE) . $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-194
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_cek_darah($data = array())
  {
    // init var - return var
    $ret_val = array();
    $btn_delete = NULL;
    $no_surat_pengantar = NULL;

    // init var
    $status = array(
      '1' => '<span class="badge bg-blue">Terdaftar</span>',
      '2' => '<span class="badge bg-green">Selesai</span>',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      // init var - array for replacement
      $no_surat_pengantar = $value['no_surat_pengantar'];
      $btn_delete = "<button type='button' class='btn btn-sm btn-danger' onclick=\"window.location='" . base_url() . "hapus-cek-darah/$no_surat_pengantar'\"><i class='fa fa-remove'></i></button>";

      // replacing array
      $value['new_no_surat_pengantar'] = substr($no_surat_pengantar, 0, 4) . substr($no_surat_pengantar, 6, 4) . substr($no_surat_pengantar, 12, 2);
      $value['opsi'] = $btn_delete;
      $value['gd_kolesterol'] = ( ! empty($value['gd_kolesterol'])) ? '<span class="badge bg-blue">Kolesterol</span>' : NULL;
      $value['new_h_kolesterol'] = ($value['h_kolesterol'] != '-') ? '(' . $value['h_kolesterol'] . ' mg/dl)<br />' : '<br />';
      $value['gd_puasa'] = ( ! empty($value['gd_puasa'])) ? '<span class="badge bg-blue">Gula Darah Puasa</span>' : NULL;
      $value['new_h_puasa'] = ($value['h_puasa'] != '-') ? '(' . $value['h_puasa'] . ' mg/dl)<br />' : '<br />';
      $value['gd_acak'] = ( ! empty($value['gd_acak'])) ? '<span class="badge bg-blue">Gula Darah Acak</span>' : NULL;
      $value['new_h_acak'] = ($value['h_acak'] != '-') ? '(' . $value['h_acak'] . ' mg/dl)<br />' : '<br />';
      $value['gd_asam_urat'] = ( ! empty($value['gd_asam_urat'])) ? '<span class="badge bg-blue">Asam Urat</span>' : NULL;
      $value['new_h_asam_urat'] = ($value['h_asam_urat'] != '-') ? '(' . $value['h_asam_urat'] . ' mg/dl)' : NULL;
      $value['opsi'] = $btn_delete;

      $value['nama'] = ucwords($value['nama']);
      $value['tgl_cek_darah'] = $this->date_formatter($value['tgl_cek_darah'], 'd-M-Y H:i');
      $value['status'] = str_replace(array_keys($status), $status, $value['status']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /**
   * SIKP-PF-108
   * @return [type]       [description]
   */
  public function store_cek_darah()
  {
    if ($this->form_validation->run() == FALSE) {
      $this->create_cek_darah('gagal_form_invalid');
    } else {
      // init var - local
      $data = array();
      foreach ($this->input->post() as $key => $value) {
        $data[$key] = $value;
      }

      $data['no_surat_pengantar'] = $this->id_generator('DRH');
      $data['tgl_cek_darah'] = date('Y-m-d H:i:s');
      $data['status'] = "1";
      $new_no_surat_pengantar = substr($data['no_surat_pengantar'], 0, 4) . substr($data['no_surat_pengantar'], 6, 4) . substr($data['no_surat_pengantar'], 12, 2);

      // var_dump($data);
      // die();

      // execute query
      $this->db->trans_begin();
      $this->M_cek_darah->store($data);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'pendaftaran-cek-darah/gagal_cek_darah';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'pendaftaran-cek-darah/sukses_cek_darah/' . $new_no_surat_pengantar;
        header("Location: $url");
      }
    }
  }

  /**
   * SIKP-PF-195
   * @param  [type] $no_surat_pengantar [description]
   * @return [type]                     [description]
   */
  public function destroy_cek_darah($no_surat_pengantar)
  {
    // execute query
    $this->db->trans_begin();
    $this->M_cek_darah->destroy($no_surat_pengantar);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'pendaftaran-cek-darah/gagal_hapus_cek_darah';
      header("Location: $url");
    } else {
      // $this->db->trans_rollback();
      $this->db->trans_commit();
      $url = base_url() . 'pendaftaran-cek-darah/sukses_hapus_cek_darah';
      header("Location: $url");
    }
  }

  /**
   * SIKP-PF-196
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function show_riwayat_cek_darah($alert_flag = NULL)
  {
    // init var - local
    $data_tabel = array();
    $page_content = NULL;

    // init var - view data
    $view_data['riwayat_cek_darah'] = $this->M_cek_darah->get_data_riwayat('a.no_surat_pengantar, a.no_bpjs, b.nama, a.tgl_cek_darah, a.gd_kolesterol, COALESCE(a.h_kolesterol, \'-\') as h_kolesterol, a.gd_puasa, COALESCE(a.h_puasa, \'-\') as h_puasa, a.gd_acak, COALESCE(a.h_acak, \'-\') as h_acak, a.gd_asam_urat, COALESCE(a.h_asam_urat, \'-\') as h_asam_urat, a.status');

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

    if ($alert_flag !== NULL) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/show/riwayat_cek_darah', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_create_cek_darah($data_tabel['riwayat_cek_darah'])
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Pengobatan Holistik', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-197
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function create_hasil_cek_darah($alert_flag = NULL)
  {
    // init var - local
    $page_content = NULL;
    $data_tabel = array();

    // init var - view data
    $view_data['cek_darah_baru'] = $this->M_cek_darah->get_data_harian('a.no_surat_pengantar, b.nama', array('1'));
    $view_data['cek_darah_harian'] = $this->M_cek_darah->get_data_harian('a.no_surat_pengantar, a.no_bpjs, b.nama, a.tgl_cek_darah, a.gd_kolesterol, COALESCE(a.h_kolesterol, \'-\') as h_kolesterol, a.gd_puasa, COALESCE(a.h_puasa, \'-\') as h_puasa, a.gd_acak, COALESCE(a.h_acak, \'-\') as h_acak, a.gd_asam_urat, COALESCE(a.h_asam_urat, \'-\') as h_asam_urat, a.status');

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

    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
      if ( ! empty($no_surat_pengantar)) {
        $this->alert_template = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
        $this->alert_template_data = array(
          'new_no_surat_pengantar' => $no_surat_pengantar,
          );
        $this->alert_vars = $this->parser->parse_string($this->alert_template, $this->alert_template_data, TRUE);
      }
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/formulir_hasil_cek_darah', '',TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_pasien' => $this->replace_create_cek_darah($data_tabel['cek_darah_baru']),
      'data_tabel' => $this->replace_create_cek_darah($data_tabel['cek_darah_harian']),
      );
    
    // parsing view
    $page_title = 'Formulir Pendaftaran Cek Darah';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE) . $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE) . $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-198
   * @return [type] [description]
   */
  public function show_cek_darah_by_no()
  {
    // init var - local
    $no_surat_pengantar = $this->input->post('no_surat_pengantar');

    // init var - view_data
    $view_data['cek_darah'] = $this->M_cek_darah->show($no_surat_pengantar, 'b.nama, a.gd_kolesterol, a.h_kolesterol, a.gd_puasa, a.h_puasa, a.gd_acak, a.h_acak, a.gd_asam_urat, a.h_asam_urat');

    echo json_encode($view_data['cek_darah']);
  }

  /**
   * SIKP-PF-199
   * @return [type] [description]
   */
  public function store_hasil_cek_darah()
  {
    if ($this->form_validation->run() == FALSE) {
      $this->create_hasil_cek_darah('gagal_form_invalid');
    } else {
      // init var - local
      $data = array();

      // repopulating data
      foreach ($this->input->post() as $key => $value) {
        $data[$key] = $value;
      }

      $data['status'] = '2';
      unset($data['no_surat_pengantar']);

      // var_dump($data);
      // die();

      // executing query
      $this->db->trans_begin();
      $this->M_cek_darah->update($this->input->post('no_surat_pengantar'), $data);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'hasil-cek-darah/gagal_hasil_cek_darah';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'hasil-cek-darah/sukses_hasil_cek_darah';
        header("Location: $url");
      }
    }
  }

  /////////////////////////
  // PENGISIAN ANAMNESIS //
  /////////////////////////
  /**
   * SIKP-PF-88
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_anamnesis($data = array())
  {
    // init var - return var
    $ret_val = array();
    $id_registrasi = NULL;

    // init var - array replacement
    $jenis_kelamin = array(
      'l' => 'Laki-Laki',
      'p' => 'Perempuan',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $id_registrasi = $value['id_registrasi'];
      $value['new_id_registrasi'] = substr($id_registrasi, 0, 4) . substr($id_registrasi, 6, 4) . substr($id_registrasi, 12, 2);
      $value['nama'] = ucwords($value['nama']);
      $value['jenis_kelamin'] = str_replace(array_keys($jenis_kelamin), $jenis_kelamin, $value['jenis_kelamin']);
      $value['alamat'] = ucwords($value['alamat']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }
  
  /**
   * SIKP-PF-89
   * @param  [type] $id_registrasi [description]
   * @param  [type] $no_bpjs       [description]
   * @param  [type] $alert_flag    [description]
   * @return [type]                [description]
   */
  public function create_anamnesis($id_registrasi = NULL, $no_bpjs = NULL, $alert_flag = NULL)
  {
    // init var - local
    $page_content = NULL;
    $data_tabel = array();

    // init var - view data
    $view_data['pasien'] = $this->M_status->show_pasien($id_registrasi, $no_bpjs, 'a.id_registrasi, a.no_bpjs, a.nik_tenaga_medis, b.nama, b.jenis_kelamin, YEAR(CURRENT_DATE()) - YEAR(b.tgl_lahir) as umur, b.alamat');

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

    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/formulir_pengisian_anamnesis', '',TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'pasien' => $this->replace_create_anamnesis($data_tabel['pasien']),
      );

    // parsing view
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    
    $this->parse_view('Formulir Pengisian Anamnesis', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-90
   * @return [type] [description]
   */
  public function store_anamnesis()
  {
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_anamnesis($this->input->post('id_registrasi'), $this->input->post('no_bpjs'), 'gagal_form_invalid');
    } else {
      // init var - local
      $id_keluhan = $this->id_generator('KLH');
      $id_registrasi = $this->input->post('id_registrasi');
      $no_bpjs = $this->input->post('no_bpjs');
      $nik_tenaga_medis = $this->input->post('nik_tenaga_medis');
      $anamnesis = array();

      // init var - array to be repopulated
      $status = $this->input->post();
      $status['status'] = 'anamnesis';

      // unsetting some keys in status
      unset($status['id_registrasi']);
      unset($status['no_bpjs']);
      unset($status['keluhan']);
      unset($status['nik_tenaga_medis']);

      // repopulating and storing data
      $this->db->trans_begin();
      $this->M_status->update($id_registrasi, $no_bpjs, $status);
      foreach ($this->input->post('keluhan') as $key => $value) {
        $anamnesis['id_keluhan'] = $id_keluhan;
        $anamnesis['id_registrasi'] = $id_registrasi;
        $anamnesis['nik_tenaga_medis'] = $nik_tenaga_medis;
        $anamnesis['no_bpjs'] = $no_bpjs;
        $anamnesis['keluhan'] = $value;
        $this->M_keluhan->store($anamnesis);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-anamnesis/' . $id_registrasi . '/' . $no_bpjs . '/gagal_pengisian_anamnesis/';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'pasien-anamnesis-harian/sukses_pengisian_anamnesis/';
        header("Location: $url");
      }
    }
  }

  /**
   * SIKP-PF-91
   * @param  [type] $id_registrasi [description]
   * @param  [type] $no_bpjs       [description]
   * @return [type]                [description]
   */
  public function destroy_anamnesis($id_registrasi, $no_bpjs)
  {
    // init var - local
    $data = array(
      'alergi_obat' => NULL,
      'alergi_makanan' => NULL,
      'td' => NULL,
      'rr' => NULL,
      'nadi' => NULL,
      'suhu' => NULL,
      'status' => 'terdaftar'
      );

    // repopulating and storing data
    $this->db->trans_begin();
    $this->M_keluhan->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    $this->M_status->update($id_registrasi, $no_bpjs, $data);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'pasien-anamnesis-harian/gagal_hapus_anamnesis/';
      header("Location: $url");
    } else {
      // $this->db->trans_rollback();
      $this->db->trans_commit();
      $url = base_url() . 'pasien-anamnesis-harian/sukses_hapus_anamnesis/';
      header("Location: $url");
    }
  }

  /////////////////////////
  // PENGISIAN DIAGNOSIS //
  /////////////////////////
  /**
   * SIKP-PF-92
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_diagnosis_status($data = array())
  {
    // init var - return var
    $ret_val = array();
    $id_registrasi = NULL;

    // init var - array replacement
    $jenis_kelamin = array(
      'l' => 'Laki-Laki',
      'p' => 'Perempuan',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      // assign var - for array replacement
      $id_registrasi = $value['id_registrasi'];

      // replacing array
      $value['new_id_registrasi'] = substr($id_registrasi, 0, 4) . substr($id_registrasi, 6, 4) . substr($id_registrasi, 12, 2);

      $value['nama'] = ucwords($value['nama']);
      $value['alamat'] = ucwords($value['alamat']);
      $value['jenis_kelamin'] = str_replace(array_keys($jenis_kelamin), $jenis_kelamin, $value['jenis_kelamin']);
      $value['alergi_obat'] = ucwords($value['alergi_obat']);
      $value['alergi_makanan'] = ucwords($value['alergi_makanan']);
      array_push($ret_val, $value);
    }
    return $ret_val;
  }

  /**
   * SIKP-PF-93
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_diagnosis_anamnesis($data = array())
  {
    // init var - return var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['keluhan'] = ucwords($value['keluhan']);
      array_push($ret_val, $value);
    }
    return $ret_val;
  }

  /**
   * SIKP-PF-94
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_diagnosis_modul($data = array())
  {
    // init var - return var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      array_push($ret_val, $value);
    }
    return $ret_val;
  }

  /**
   * SIKP-PF-95
   * SIKP-PF-122
   * @param  [type] $id_registrasi [description]
   * @param  [type] $no_bpjs       [description]
   * @param  [type] $alert_flag    [description]
   * @return [type]                [description]
   */
  public function create_diagnosis($id_registrasi = NULL, $no_bpjs = NULL, $alert_flag = NULL)
  {
    // init var - local
    $page_content = NULL;
    $data_tabel = array();

    // init var - view data
    $view_data['status'] = $this->M_status->show_pasien($id_registrasi, $no_bpjs, 'a.id_registrasi, a.no_bpjs, a.nik_tenaga_medis, b.nama, b.jenis_kelamin, YEAR(CURRENT_DATE()) - YEAR(b.tgl_lahir) as umur, b.alamat, a.td, a.rr, a.nadi, a.suhu, a.alergi_obat, a.alergi_makanan');
    $view_data['anamnesis'] = $this->M_keluhan->show_by_status_pasien($id_registrasi, $no_bpjs, 'keluhan');
    $view_data['modul_penyakit'] = $this->M_penyakit->get_data();
    $view_data['modul_faktor_risiko'] = $this->M_faktor_risiko->get_data();
    $view_data['modul_faktor_pemicu'] = $this->M_faktor_pemicu->get_data();

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

    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
    }

    // var_dump($data_tabel['modul_penyakit']);

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/formulir_pengisian_diagnosis', '',TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'status' => $this->replace_create_diagnosis_status($data_tabel['status']),
      'anamnesis' => $this->replace_create_diagnosis_anamnesis($data_tabel['anamnesis']),
      'modul_penyakit' => $this->replace_create_diagnosis_modul($data_tabel['modul_penyakit']),
      'modul_faktor_risiko' => $this->replace_create_diagnosis_modul($data_tabel['modul_faktor_risiko']),
      'modul_faktor_pemicu' => $this->replace_create_diagnosis_modul($data_tabel['modul_faktor_pemicu']),
      );

    // parsing view
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    
    $this->parse_view('Formulir Pengisian Diagnosis', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-96
   * Sequence Diagram - Menyimpan Data Diagnosis
   * @return [type] [description]
   */
  public function store_diagnosis()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_diagnosis($this->input->post('id_registrasi'), $this->input->post('no_bpjs'), 'gagal_form_invalid');
    } else {
      // init var - local
      $id_registrasi = $this->input->post('id_registrasi');
      $nik_tenaga_medis = $this->input->post('nik_tenaga_medis');
      $no_bpjs = $this->input->post('no_bpjs');

      // storing data
      $this->db->trans_begin();
      $this->save_diagnosis($this->input->post());
      $this->save_faktor_risiko($this->input->post());
      $this->save_faktor_pemicu($this->input->post());
      $this->M_status->update($id_registrasi, $no_bpjs, array('status' => 'diagnosis'));
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-diagnosis/' . $id_registrasi . '/' . $no_bpjs . '/gagal_pengisian_diagnosis/';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'pasien-diagnosis-harian/sukses_pengisian_diagnosis/';
        header("Location: $url");
      }
    }
  }

  /**
   * SIKP-PF-97
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function save_diagnosis($data = array())
  {
    // init var - local
    $id_registrasi = $data['id_registrasi'];
    $nik_tenaga_medis = $data['nik_tenaga_medis'];
    $no_bpjs = $data['no_bpjs'];

    // init var - array
    $diagnosis = NULL;

    // echo "diagnosis";
    // repopulating and storing data -- diagnosis
    foreach ($data['penyakit'] as $key => $value) {
      $id_diagnosa = $this->id_generator('DIA');
      $diagnosis['id_diagnosa'] = $id_diagnosa;
      $diagnosis['id_registrasi'] = $id_registrasi;
      $diagnosis['nik_tenaga_medis'] = $nik_tenaga_medis;
      $diagnosis['no_bpjs'] = $no_bpjs;
      $diagnosis['penyakit'] = $value;
      $diagnosis['id_mod_penyakit'] = $data['id_mod_penyakit'][$key];
      $diagnosis['terapi'] = $data['terapi'][$key];
      // $diagnosis['lokasi_intervensi'] = $data['lokasi_intervensi'][$key];
      $diagnosis['lokasi_intervensi'] = '1';
      $this->M_diagnosis_penyakit->store($diagnosis);
    }
  }

  /**
   * SIKP-PF-98
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function save_faktor_risiko($data = array())
  {
    // init var - local
    $id_registrasi = $data['id_registrasi'];
    $nik_tenaga_medis = $data['nik_tenaga_medis'];
    $no_bpjs = $data['no_bpjs'];

    // init var - array
    $faktor_risiko = NULL;

    // repopulating and storing data -- faktor risiko penyakit
    foreach ($data['faktor_risiko'] as $key => $value) {
      $id_faktor_risiko = $this->id_generator('RSK');
      $faktor_risiko['id_faktor_risiko'] = $id_faktor_risiko;
      $faktor_risiko['id_registrasi'] = $id_registrasi;
      $faktor_risiko['nik_tenaga_medis'] = $nik_tenaga_medis;
      $faktor_risiko['no_bpjs'] = $no_bpjs;
      $faktor_risiko['faktor_risiko'] = $value;
      $faktor_risiko['id_mod_faktor_risiko'] = $data['id_mod_faktor_risiko'][$key];
      $this->M_hol_faktor_risiko->store($faktor_risiko);
    }
  }

  /**
   * SIKP-PF-99
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function save_faktor_pemicu($data = array())
  {
    // init var - local
    $id_registrasi = $data['id_registrasi'];
    $nik_tenaga_medis = $data['nik_tenaga_medis'];
    $no_bpjs = $data['no_bpjs'];

    // init var - array
    $faktor_pemicu = NULL;

    // repopulating and storing data -- faktor risiko penyakit
    foreach ($data['faktor_pemicu'] as $key => $value) {
      $id_faktor_pemicu = $this->id_generator('PMC');
      $faktor_pemicu['id_faktor_pemicu'] = $id_faktor_pemicu;
      $faktor_pemicu['id_registrasi'] = $id_registrasi;
      $faktor_pemicu['nik_tenaga_medis'] = $nik_tenaga_medis;
      $faktor_pemicu['no_bpjs'] = $no_bpjs;
      $faktor_pemicu['faktor_pemicu'] = $value;
      $faktor_pemicu['id_mod_faktor_pemicu'] = $data['id_mod_faktor_pemicu'][$key];
      $this->M_hol_faktor_pemicu->store($faktor_pemicu);
    }
  }

  /**
   * SIKP-PF-100
   * Sequence Diagram - Menghapus Data Pengobatan Holistik
   * @param  [type] $id_registrasi [description]
   * @param  [type] $no_bpjs       [description]
   * @return [type]                [description]
   */
  public function destroy_diagnosis($id_registrasi, $no_bpjs)
  {
    // init var - local
    $data = array(
      'status' => 'anamnesis'
      );

    // init var - view data
    $view_data['resep_obat'] = $this->M_resep_obat->count_by_status_pasien($id_registrasi, $no_bpjs);
    $view_data['rujukan'] = $this->M_rujukan->count_by_status_pasien($id_registrasi, $no_bpjs);

    // parsing error template
    foreach ($view_data as $key => $value) {
      if ($view_data[$key]['status'] == 'error') {
        goto end;
      }
      $data_tabel[$key] = $view_data[$key]['data'];
      if (empty($data_tabel[$key])) {
        $data_tabel[$key] = array();
      }
    }

    // resep obat
    if ($data_tabel['resep_obat'][0] > 0 ) {
      $this->M_resep_obat->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    }
    // rujukan
    if ($data_tabel['rujukan'][0] > 0 ) {
      $this->M_rujukan->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    }

    // repopulating and storing data
    $this->db->trans_begin();
    $this->M_diagnosis_penyakit->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    $this->M_hol_faktor_risiko->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    $this->M_hol_faktor_pemicu->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    $this->M_status->update($id_registrasi, $no_bpjs, $data);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      end:
      $url = base_url() . 'pasien-diagnosis-harian/gagal_hapus_diagnosis/';
      header("Location: $url");
    } else {
      // $this->db->trans_rollback();
      $this->db->trans_commit();
      $url = base_url() . 'pasien-diagnosis-harian/sukses_hapus_diagnosis/';
      header("Location: $url");
    }
  }

  //////////////////////////
  // PENGISIAN INTERVENSI //
  //////////////////////////
  /**
   * SIKP-PF-101
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_intervensi_diagnosis($data = array())
  {
    // init var - return var
    $ret_val = array();

    // init var - array replacement
    $lokasi_intervensi = array(
      '1' => 'Klinik',
      '2' => 'Rumah Sakit',
      '3' => 'Tempat Tinggal',
      '4' => 'Tempat Kerja',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['penyakit'] = ucwords($value['penyakit']);
      $value['terapi'] = ucwords($value['terapi']);
      $value['nama'] = ucwords($value['nama']);
      $value['lokasi_intervensi'] = str_replace(array_keys($lokasi_intervensi), $lokasi_intervensi, $value['lokasi_intervensi']);
      array_push($ret_val, $value);
    }
    return $ret_val;
  }

  /**
   * SIKP-PF-102
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_intervensi_faktor_risiko($data = array())
  {
    // init var - return var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      $value['faktor_risiko'] = ucwords($value['faktor_risiko']);
      array_push($ret_val, $value);
    }
    return $ret_val;
  }

  /**
   * SIKP-PF-103
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_create_intervensi_faktor_pemicu($data = array())
  {
    // init var - return var
    $ret_val = array();

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      $value['faktor_pemicu'] = ucwords($value['faktor_pemicu']);
      array_push($ret_val, $value);
    }
    return $ret_val;
  }

  /**
   * SIKP-PF-104
   * @param  [type] $id_registrasi [description]
   * @param  [type] $no_bpjs       [description]
   * @param  [type] $alert_flag    [description]
   * @return [type]                [description]
   */
  public function create_intervensi($id_registrasi = NULL, $no_bpjs = NULL, $alert_flag = NULL)
  {
    // init var - local
    $page_content = NULL;
    $data_tabel = array();

    // init var - view data
    $view_data['status'] = $this->M_status->show_pasien($id_registrasi, $no_bpjs, 'a.id_registrasi, a.no_bpjs, a.nik_tenaga_medis, b.nama, b.jenis_kelamin, YEAR(CURRENT_DATE()) - YEAR(b.tgl_lahir) as umur, b.alamat, a.td, a.rr, a.nadi, a.suhu, a.alergi_obat, a.alergi_makanan');
    $view_data['anamnesis'] = $this->M_keluhan->show_by_status_pasien($id_registrasi, $no_bpjs, 'keluhan');
    $view_data['diagnosis'] = $this->M_diagnosis_penyakit->show_modul_by_status_pasien($id_registrasi, $no_bpjs, 'a.id_diagnosa, a.penyakit, a.id_mod_penyakit, b.nama, b.versi, a.terapi, a.lokasi_intervensi');
    $view_data['faktor_risiko'] = $this->M_hol_faktor_risiko->show_modul_by_status_pasien($id_registrasi, $no_bpjs);
    $view_data['faktor_pemicu'] = $this->M_hol_faktor_pemicu->show_modul_by_status_pasien($id_registrasi, $no_bpjs);

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

    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
    }

    // var_dump($data_tabel['faktor_risiko']);

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/formulir_pengisian_intervensi', '',TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'status' => $this->replace_create_diagnosis_status($data_tabel['status']),
      'anamnesis' => $this->replace_create_diagnosis_anamnesis($data_tabel['anamnesis']),
      'diagnosis' => $this->replace_create_intervensi_diagnosis($data_tabel['diagnosis']),
      'faktor_risiko' => $this->replace_create_intervensi_faktor_risiko($data_tabel['faktor_risiko']),
      'faktor_pemicu' => $this->replace_create_intervensi_faktor_pemicu($data_tabel['faktor_pemicu']),
      );

    // parsing view
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    
    $this->parse_view('Formulir Pengisian Diagnosis', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-105
   * Sequence Diagram - Menyimpan Data Intervensi Kesehatan
   * @return [type] [description]
   */
  public function store_intervensi()
  {
    // var_dump($this->input->post());
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_intervensi($this->input->post('id_registrasi'), $this->input->post('no_bpjs'), 'gagal_form_invalid');
    } else {
      // init var - local
      $id_registrasi = $this->input->post('id_registrasi');
      $nik_tenaga_medis = $this->input->post('nik_tenaga_medis');
      $no_bpjs = $this->input->post('no_bpjs');

      // storing data
      $this->db->trans_begin();
      if ($this->input->post('jenis_intervensi') == '1') {
        $this->save_resep_obat($this->input->post());
      } elseif ($this->input->post('jenis_intervensi') == '2') {
        $this->save_rujukan($this->input->post());
      } 
      $this->M_status->update($id_registrasi, $no_bpjs, array('status' => 'intervensi'));
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-diagnosis/' . $id_registrasi . '/' . $no_bpjs . '/gagal_tindakan_medis/';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'pasien-diagnosis-harian/sukses_pengisian_diagnosis/';
        header("Location: $url");
      }
    }
  }

  /**
   * SIKP-PF-106
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function save_resep_obat($data = array())
  {
    // init var - local
    $data['id_resep_obat'] = $this->id_generator('RSP');

    // unsetting jenis_intervensi
    unset($data['jenis_intervensi']);

    // execute query
    $this->M_resep_obat->store($data);
  }

  /**
   * SIKP-PF-107
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function save_rujukan($data = array())
  {
    // init var - local
    $data['id_rujukan'] = $this->id_generator('RJK');

    // unsetting jenis_intervensi
    unset($data['jenis_intervensi']);

    // execute query
    $this->M_rujukan->store($data);
  }

  ////////////////////////////
  // DATA PENGOBATAN HARIAN //
  ////////////////////////////
  /**
   * SIKP-PF-109
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_terdaftar_harian($data = array())
  {
    // init var - return var
    $ret_val = array();
    $id_registrasi = NULL;
    $no_bpjs = NULL;

    // init var
    $status = array(
      'terdaftar' => '<span class="badge bg-blue">Terdaftar</span>',
      'anamnesis' => '<span class="badge bg-yellow">Tahap Anamnesis</span>',
      'diagnosis' => '<span class="badge bg-red">Tahap Diagnosis</span>',
      'intervensi' => '<span class="badge bg-green">Tahap Intervensi</span>',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      // init var - for replacement
      $id_registrasi = $value['id_registrasi'];
      $no_bpjs = $value['no_bpjs'];

      $btn_detail = "<button type='button' class='btn btn-sm btn-primary' onclick=\"window.location='" . base_url() . "detail-pengobatan/$id_registrasi/$no_bpjs'\"><i class='fa fa-eye'></i>&nbsp;Lihat Detail</button>";
      $btn_delete = "<button type='button' class='btn btn-sm btn-danger' onclick=\"window.location='" . base_url() . "destroy-riwayat-pengobatan/$id_registrasi/$no_bpjs'\"><i class='fa fa-remove'></i>&nbsp;Hapus Data</button>";

      // replacing array
      $value['new_id_registrasi'] = substr($id_registrasi, 0, 4) . substr($id_registrasi, 6, 4) . substr($id_registrasi, 12, 2);
      $value['opsi'] = $btn_detail.$btn_delete;

      $value['nama'] = ucwords($value['nama']);
      $value['tgl_periksa'] = $this->date_formatter($value['tgl_periksa'], 'd-M-Y H:i');
      $value['poli'] = 'Poli ' . ucwords($value['poli']);
      $value['status'] = str_replace(array_keys($status), $status, $value['status']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /**
   * SIKP-PF-110
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function show_terdaftar_harian($alert_flag = NULL)
  {
    // init var - local
    $data_tabel = array();
    $page_content = NULL;

    // init var - view data
    $view_data['terdaftar_harian'] = $this->M_status->get_data_harian('a.id_registrasi, a.nik_tenaga_medis, a.no_bpjs, c.nama, a.tgl_periksa, b.poli, a.status', array('terdaftar', 'anamnesis', 'diagnosis', 'intervensi'));

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

    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/show/pasien_terdaftar_harian', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_terdaftar_harian($data_tabel['terdaftar_harian'])
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Pengobatan Holistik', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-200
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function show_cek_darah_harian($alert_flag = NULL)
  {
    $view_data['cek_darah_harian'] = $this->M_cek_darah->get_data_harian('a.no_surat_pengantar, a.no_bpjs, b.nama, a.tgl_cek_darah, a.gd_kolesterol, COALESCE(a.h_kolesterol, \'-\') as h_kolesterol, a.gd_puasa, COALESCE(a.h_puasa, \'-\') as h_puasa, a.gd_acak, COALESCE(a.h_acak, \'-\') as h_acak, a.gd_asam_urat, COALESCE(a.h_asam_urat, \'-\') as h_asam_urat, a.status');

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

    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
      if ( ! empty($no_surat_pengantar)) {
        $this->alert_template = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
        $this->alert_template_data = array(
          'new_no_surat_pengantar' => $no_surat_pengantar,
          );
        $this->alert_vars = $this->parser->parse_string($this->alert_template, $this->alert_template_data, TRUE);
      }
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/show/pasien_cek_darah_harian', '',TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_create_cek_darah($data_tabel['cek_darah_harian']),
      );
    
    // parsing view
    $page_title = 'Formulir Pendaftaran Cek Darah';
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE) . $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view($page_title, $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-111
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_anamnesis_harian($data = array())
  {
    // init var - return var
    $ret_val = array();
    $id_registrasi = NULL;
    $no_bpjs = NULL;

    // init var
    $status = array(
      'terdaftar' => '<span class="badge bg-blue">Terdaftar</span>',
      'anamnesis' => '<span class="badge bg-yellow">Tahap Anamnesis</span>',
      'diagnosis' => '<span class="badge bg-red">Tahap Diagnosis</span>',
      'intervensi' => '<span class="badge bg-green">Tahap Intervensi</span>',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      // assign var - local
      $id_registrasi = $value['id_registrasi'];
      $no_bpjs = $value['no_bpjs'];

      $btn_anamnesis = "<button type='button' class='btn btn-sm btn-warning' onclick=\"window.location='" . base_url() . "formulir-anamnesis/$id_registrasi/$no_bpjs'\"><i class='fa fa-plus'></i>&nbsp;Tambah Anamnesis</button>";
      $btn_detail = "<button type='button' class='btn btn-sm btn-primary' onclick=\"window.location='" . base_url() . "detail-pengobatan/$id_registrasi/$no_bpjs'\"><i class='fa fa-eye'></i>&nbsp;Lihat Detail</button>";
      $btn_delete_anamnesis = "<button type='button' class='btn btn-sm btn-danger' onclick=\"window.location='" . base_url() . "destroy-anamnesis/$id_registrasi/$no_bpjs'\"><i class='fa fa-remove'></i>&nbsp;Hapus Data</button>";
      
      // init var - opsi array
      if ($value['status'] == 'terdaftar') {
        $value['opsi'] = $btn_anamnesis.$btn_detail;
      } elseif ($value['status'] == 'anamnesis')  {
        $value['opsi'] = $btn_detail.$btn_delete_anamnesis;
      } else {
        $value['opsi'] = $btn_detail;
      }

      $value['new_id_registrasi'] = substr($id_registrasi, 0, 4) . substr($id_registrasi, 6, 4) . substr($id_registrasi, 12, 2);
      $value['nama'] = ucwords($value['nama']);
      $value['tgl_periksa'] = $this->date_formatter($value['tgl_periksa'], 'd-M-Y H:i');
      $value['poli'] = 'Poli ' . ucwords($value['poli']);
      $value['status'] = str_replace(array_keys($status), $status, $value['status']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /**
   * SIKP-PF-112
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function show_anamnesis_harian($alert_flag = NULL)
  {
    // init var - local
    $data_tabel = array();
    $page_content = NULL;

    // init var - view data
    $view_data['anamnesis_harian'] = $this->M_status->get_data_harian('a.id_registrasi, a.nik_tenaga_medis, a.no_bpjs, c.nama, a.tgl_periksa, b.poli, a.status', array('terdaftar', 'anamnesis', 'diagnosis', 'intervensi'));

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

    if ($alert_flag !== NULL) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/show/pasien_anamnesis_harian', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_anamnesis_harian($data_tabel['anamnesis_harian'])
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Pengobatan Holistik', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-113
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_diagnosis_harian($data = array())
  {
    // init var - return var
    $ret_val = array();
    $id_registrasi = NULL;
    $no_bpjs = NULL;

    // init var
    $status = array(
      'terdaftar' => '<span class="badge bg-blue">Terdaftar</span>',
      'anamnesis' => '<span class="badge bg-yellow">Tahap Anamnesis</span>',
      'diagnosis' => '<span class="badge bg-red">Tahap Diagnosis</span>',
      'intervensi' => '<span class="badge bg-green">Tahap Intervensi</span>',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      // assign var - local
      $id_registrasi = $value['id_registrasi'];
      $no_bpjs = $value['no_bpjs'];

      $btn_diagnosis = "<button type='button' class='btn btn-sm btn-warning' onclick=\"window.location='" . base_url() . "formulir-diagnosis/$id_registrasi/$no_bpjs'\"><i class='fa fa-plus'></i>&nbsp;Tambah Diagnosis</button>";
      $btn_intervensi = "<button type='button' class='btn btn-sm btn-warning' onclick=\"window.location='" . base_url() . "formulir-intervensi/$id_registrasi/$no_bpjs'\"><i class='fa fa-plus'></i>&nbsp;Tambah Intervensi</button>";
      $btn_detail = "<button type='button' class='btn btn-sm btn-primary' onclick=\"window.location='" . base_url() . "detail-pengobatan/$id_registrasi/$no_bpjs'\"><i class='fa fa-eye'></i>&nbsp;Lihat Detail</button>";
      $btn_delete_diagnosis = "<button type='button' class='btn btn-sm btn-danger' onclick=\"window.location='" . base_url() . "destroy-diagnosis/$id_registrasi/$no_bpjs'\"><i class='fa fa-remove'></i>&nbsp;Hapus Data</button>";
      $btn_delete_intervensi = "<button type='button' class='btn btn-sm btn-danger' onclick=\"window.location='" . base_url() . "destroy-diagnosis/$id_registrasi/$no_bpjs'\"><i class='fa fa-remove'></i>&nbsp;Hapus Data</button>";
      
      // init var - opsi array
      if ($value['status'] == 'anamnesis') {
        $value['opsi'] = $btn_diagnosis.$btn_detail;
      } elseif ($value['status'] == 'diagnosis') {
        $value['opsi'] = $btn_intervensi.$btn_detail.$btn_delete_diagnosis;
      } elseif ($value['status'] == 'intervensi') {
        $value['opsi'] = $btn_detail.$btn_delete_diagnosis;
      } else {
        $value['opsi'] = $btn_detail;
      }

      $value['new_id_registrasi'] = substr($id_registrasi, 0, 4) . substr($id_registrasi, 6, 4) . substr($id_registrasi, 12, 2);
      $value['nama'] = ucwords($value['nama']);
      $value['tgl_periksa'] = $this->date_formatter($value['tgl_periksa'], 'd-M-Y H:i');
      $value['poli'] = 'Poli ' . ucwords($value['poli']);
      $value['status'] = str_replace(array_keys($status), $status, $value['status']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /**
   * SIKP-PF-114
   * Sequence Diagram - Menampilkan Diagnosis Harian
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function show_diagnosis_harian($alert_flag = NULL)
  {
    // init var - local
    $data_tabel = array();
    $page_content = NULL;

    // init var - view data
    $view_data['diagnosis_harian'] = $this->M_status->get_data_harian('a.id_registrasi, a.nik_tenaga_medis, a.no_bpjs, c.nama, a.tgl_periksa, b.poli, a.status', array('terdaftar', 'anamnesis', 'diagnosis', 'intervensi'), $this->session->userdata('nik'));

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

    if ($alert_flag !== NULL) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/show/pasien_diagnosis_harian', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_diagnosis_harian($data_tabel['diagnosis_harian'])
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Pengobatan Holistik', $css_framework, $page_content, $js_framework);
  }

  ///////////////////////////////
  // DATA PENGOBATAN - RIWAYAT //
  ///////////////////////////////
  /**
   * SIKP-PF-115
   * Sequence Diagram - Menampilkan Riwayat Pengobatah Holistik
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function show_riwayat_pengobatan($alert_flag = NULL)
  {
    // init var - local
    $data_tabel = array();
    $page_content = NULL;

    // init var - view data
    $view_data['riwayat_pengobatan'] = $this->M_status->get_data('a.id_registrasi, a.nik_tenaga_medis, a.no_bpjs, c.nama, a.tgl_periksa, b.poli, a.status');

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

    if ($alert_flag !== NULL) {
      $this->alert_vars = $this->load->view("alert_template/pengobatan_holistik/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/show/riwayat_pengobatan', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_terdaftar_harian($data_tabel['riwayat_pengobatan'])
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Pengobatan Holistik', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-116
   * Sequence Diagram - Menampilkan Detail Riwayat Pengobatan
   * Sequence Diagram - Menampilkan Detail 
   * @param  [type] $id_registrasi [description]
   * @param  [type] $no_bpjs       [description]
   * @return [type]                [description]
   */
  public function detail_riwayat_pengobatan($id_registrasi, $no_bpjs)
  {
    // init var - local
    $resep_obat_vars = NULL;
    $rujukan_vars = NULL;
    $data_tabel = array();

    // init var - view data
    $view_data['status'] = $this->M_status->show_pasien($id_registrasi, $no_bpjs, 'a.id_registrasi, a.no_bpjs, a.nik_tenaga_medis, b.nama, b.jenis_kelamin, YEAR(CURRENT_DATE()) - YEAR(b.tgl_lahir) as umur, b.alamat, a.td, a.rr, a.nadi, a.suhu, a.alergi_obat, a.alergi_makanan');
    $view_data['anamnesis'] = $this->M_keluhan->show_by_status_pasien($id_registrasi, $no_bpjs, 'keluhan');
    $view_data['diagnosis'] = $this->M_diagnosis_penyakit->show_modul_by_status_pasien($id_registrasi, $no_bpjs, 'a.id_diagnosa, a.penyakit, a.id_mod_penyakit, b.nama, b.versi, a.terapi, a.lokasi_intervensi');
    $view_data['faktor_risiko'] = $this->M_hol_faktor_risiko->show_modul_by_status_pasien($id_registrasi, $no_bpjs);
    $view_data['faktor_pemicu'] = $this->M_hol_faktor_pemicu->show_modul_by_status_pasien($id_registrasi, $no_bpjs);
    $view_data['resep_obat'] = $this->M_resep_obat->show_by_status_pasien($id_registrasi, $no_bpjs, 'id_resep_obat, CONCAT(SUBSTR(id_resep_obat, 1,4), SUBSTR(id_resep_obat, 7,4), SUBSTR(id_resep_obat, 13,2)) as new_id_resep_obat');
    $view_data['rujukan'] = $this->M_rujukan->show_by_status_pasien($id_registrasi, $no_bpjs);

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

    // parsing detail template
    if ( ! empty($data_tabel['resep_obat'])) {
      $resep_obat_template = $this->load->view('pengobatan_holistik/show/detail_template/detail_resep_obat', '', TRUE);
      $resep_obat_template_data = array('resep_obat' => $data_tabel['resep_obat']);
      $resep_obat_vars = $this->parser->parse_string($resep_obat_template, $resep_obat_template_data, TRUE);
    }
    if ( ! empty($data_tabel['rujukan'])) {
      $rujukan_template = $this->load->view('pengobatan_holistik/show/detail_template/detail_rujukan', '', TRUE);
      $rujukan_template_data = array('rujukan' => $this->replace_detail_riwayat_pengobatan($data_tabel['rujukan']));
      $rujukan_vars = $this->parser->parse_string($rujukan_template, $rujukan_template_data, TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengobatan_holistik/show/detail_pengobatan', '',TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'status' => $this->replace_create_diagnosis_status($data_tabel['status']),
      'anamnesis' => $this->replace_create_diagnosis_anamnesis($data_tabel['anamnesis']),
      'diagnosis' => $this->replace_create_intervensi_diagnosis($data_tabel['diagnosis']),
      'faktor_risiko' => $this->replace_create_intervensi_faktor_risiko($data_tabel['faktor_risiko']),
      'faktor_pemicu' => $this->replace_create_intervensi_faktor_pemicu($data_tabel['faktor_pemicu']),
      'resep_obat' => $resep_obat_vars,
      'rujukan' => $rujukan_vars,
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Pengobatan Holistik', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-117
   * Sequence Diagram - Menghapus Riwayat Pengobatan Holistik
   * @param  [type] $id_registrasi [description]
   * @param  [type] $no_bpjs       [description]
   * @return [type]                [description]
   */
  public function destroy_riwayat_pengobatan($id_registrasi, $no_bpjs)
  {
    // init var - view data
    $view_data['status_pasien'] = $this->M_status->count_by_status_pasien($id_registrasi, $no_bpjs);
    $view_data['keluhan'] = $this->M_keluhan->count_by_status_pasien($id_registrasi, $no_bpjs);
    $view_data['diagnosis'] = $this->M_diagnosis_penyakit->count_by_status_pasien($id_registrasi, $no_bpjs);
    $view_data['faktor_risiko'] = $this->M_hol_faktor_risiko->count_by_status_pasien($id_registrasi, $no_bpjs);
    $view_data['faktor_pemicu'] = $this->M_hol_faktor_pemicu->count_by_status_pasien($id_registrasi, $no_bpjs);
    $view_data['resep_obat'] = $this->M_resep_obat->count_by_status_pasien($id_registrasi, $no_bpjs);
    $view_data['rujukan'] = $this->M_rujukan->count_by_status_pasien($id_registrasi, $no_bpjs);

    // var_dump($view_data);
    
    // parsing error template
    foreach ($view_data as $key => $value) {
      if ($view_data[$key]['status'] == 'error') {
        goto end;
      }
      $data_tabel[$key] = $view_data[$key]['data'];
    }

    // storing data
    $this->db->trans_begin();
    // status
    if ($data_tabel['status_pasien'][0] > 0 ) {
      $this->M_status->destroy($id_registrasi, $no_bpjs);
    }
    // keluhan
    if ($data_tabel['keluhan'][0] > 0 ) {
      $this->M_keluhan->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    }
    // diagnosis
    if ($data_tabel['diagnosis'][0] > 0 ) {
      $this->M_diagnosis_penyakit->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    }
    // faktor risiko
    if ($data_tabel['faktor_risiko'][0] > 0 ) {
      $this->M_hol_faktor_risiko->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    }
    // faktor pemicu
    if ($data_tabel['faktor_pemicu'][0] > 0 ) {
      $this->M_hol_faktor_pemicu->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    }
    // resep obat
    if ($data_tabel['resep_obat'][0] > 0 ) {
      $this->M_resep_obat->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    }
    // rujukan
    if ($data_tabel['rujukan'][0] > 0 ) {
      $this->M_rujukan->destroy_by_status_pasien($id_registrasi, $no_bpjs);
    }
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      end:
      $url = base_url() . 'riwayat-pengobatan/gagal_hapus_riwayat_pengobatan';
      header("Location: $url");
    } else {
      // $this->db->trans_rollback();
      $this->db->trans_commit();
      $url = base_url() . 'riwayat-pengobatan/sukses_hapus_riwayat_pengobatan';
      header("Location: $url");
    }
  }

  /**
   * SIKP-PF-118
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_detail_riwayat_pengobatan($data = array())
  {
    // init var - return var
    $ret_val = array();

    // init var
    $jenis_rujukan = array(
      '1' => 'Rawat Inap',
      '2' => 'Rawat Jalan',
      '3' => 'UGD',
      );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      // init var - array for replacement
      $id_rujukan = $value['id_rujukan'];

      // replacing array
      $value['new_id_rujukan'] = substr($id_rujukan, 0, 4) . substr($id_rujukan, 6, 4) . substr($id_rujukan, 12, 2);
      $value['rs'] = strtoupper($value['rs']);
      $value['jenis_rujukan'] = str_replace(array_keys($jenis_rujukan), $jenis_rujukan, $value['jenis_rujukan']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }
}
