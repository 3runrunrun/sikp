<?php 

/**
* 
*/
class C_pasien_poliklinik extends CI_Controller
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
        case 'formulir-pasien-bpjs':
        case 'simpan-pasien-bpjs':
        case 'simpan-pekerjaan-pasien-bpjs':
          if ($this->session->userdata('tabel') == 'keperawatan') {
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

  public function index()
  {
    // TEST YOUR CODE HERE
  }

  ///////////////////////////////////////////////////////////
  // MODULE PENDAFTARAN PASIEN BPJS POLIKLINIK - SHOW DATA //
  ///////////////////////////////////////////////////////////
  public function replace_data_pasien_bpjs($data = array())
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
      $value['agama'] = ucwords($value['agama']);
      $value['jenis_kelamin'] = str_replace(array_keys($jenis_kelamin), $jenis_kelamin, $value['jenis_kelamin']);
      $value['kelas_bpjs'] = str_replace(array_keys($kelas_bpjs), $kelas_bpjs, $value['kelas_bpjs']);
      $value['status_tagihan_bpjs'] = str_replace(array_keys($status_tagihan_bpjs), $status_tagihan_bpjs, $value['status_tagihan_bpjs']);
      $value['hidup'] = str_replace(array_keys($hidup), $hidup, $value['hidup']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  public function show_data_pasien_bpjs()
  {
    // init var - local
    $data_tabel = array();
    $page_content = NULL;

    // init var - view data
    $view_data['pasien'] = $this->M_pasien_identitas->get_data();

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

    // parsing template
    $this->template = $this->load->view('data_pasien_poliklinik/daftar_pasien_bpjs', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_data_pasien_bpjs($data_tabel['pasien'])
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Arsip Poliklinik', $css_framework, $page_content, $js_framework);
  }

  public function detail_pasien_bpjs($no_bpjs)
  {
    // init var - view data
    $view_data['identitas'] = $this->M_pasien_identitas->show($no_bpjs, 'a.no_bpjs, a.nama, YEAR(CURRENT_DATE()) - YEAR(tgl_lahir) as umur, a.jenis_kelamin, a.kelas_bpjs, a.status_tagihan_bpjs, a.hidup, a.agama, a.alamat, b.nama as provinsi, c.nama as kabupaten, d.nama as kecamatan, e.nama as kelurahan');
    $view_data['riwayat_pengobatan'] = $this->M_status->get_data_pasien($no_bpjs, 'a.id_registrasi, a.nik_tenaga_medis, a.no_bpjs, c.nama, a.tgl_periksa, b.poli, a.status');

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

    // parsing template
    $this->template = $this->load->view('data_pasien_poliklinik/detail_pasien_bpjs', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'identitas' => $this->replace_data_pasien_bpjs($data_tabel['identitas']),
      'riwayat_pengobatan' => $this->replace_riwayat_pengobatan($data_tabel['riwayat_pengobatan']),
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Arsip Poliklinik', $css_framework, $page_content, $js_framework);
  }

  private function replace_riwayat_pengobatan($data = array())
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

      $btn_detail = "<button type='button' class='btn btn-primary' onclick=\"window.location='" . base_url() . "detail-pengobatan/$id_registrasi/$no_bpjs'\"><i class='fa fa-eye'></i>&nbsp;Lihat Detail</button>";
      $btn_delete = "<button type='button' class='btn btn-danger' onclick=\"window.location='" . base_url() . "destroy-riwayat-pengobatan/$id_registrasi/$no_bpjs'\"><i class='fa fa-plus'></i>&nbsp;Hapus Data</button>";

      $value['opsi'] = $btn_detail.$btn_delete;

      $value['nama'] = ucwords($value['nama']);
      $value['tgl_periksa'] = $this->date_formatter($value['tgl_periksa'], 'd-M-Y H:i');
      $value['poli'] = 'Poli ' . ucwords($value['poli']);
      $value['status'] = str_replace(array_keys($status), $status, $value['status']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }
  
  ///////////////////////////////////////////////////////
  // MODULE PENDAFTARAN PASIEN BPJS POLIKLINIK - INPUT //
  ///////////////////////////////////////////////////////

  public function create($alert_flag = NULL)
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
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/data_pasien_poliklinik/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_pasien_poliklinik/formulir_pasien_bpjs', $view_data, TRUE);
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
      $this->create('gagal_form_invalid');
    } else {
      // init var - request param
      $data_pasien = $this->input->post();
      $data_pasien['tgl_lahir'] = $this->date_formatter($data_pasien['tgl_lahir'], 'Y-m-d');

      // storing data
      $this->db->trans_begin();
      $this->M_pasien_identitas->store($data_pasien);

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-pasien-bpjs/gagal_data_pasien';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'formulir-pasien-bpjs/sukses_data_pasien';
        header("Location: $url");
      }
    }
  }

  public function store_riwayat_pekerjaan()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create('gagal_form_invalid');
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
        $url = base_url() . 'formulir-pasien-bpjs/gagal_data_riwayat_pekerjaan';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'formulir-pasien-bpjs/sukses_data_riwayat_pekerjaan';
        header("Location: $url");
      }
    }
  }
}