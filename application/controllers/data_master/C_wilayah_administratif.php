<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_wilayah_administratif extends CI_Controller
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
      if ($this->session->userdata('tabel') != 'admin') {
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

  //////////
  // SHOW //
  //////////
  public function show_provinsi($alert_flag = NULL)
  {
    // init var - view data
    $view_data['provinsi'] = $this->M_provinsi->get_data();

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
      $this->alert_vars = $this->load->view("alert_template/data_master/wilayah_administratif/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/wilayah_administratif/show/provinsi', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $data_tabel['provinsi'],
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  public function show_kabupaten($alert_flag = NULL)
  {
    // init var - view data
    $view_data['kabupaten'] = $this->M_kabupaten->get_provinsi('a.id_kabupaten, a.nama as kabupaten, b.id_provinsi, b.nama as provinsi');

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
      $this->alert_vars = $this->load->view("alert_template/data_master/wilayah_administratif/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/wilayah_administratif/show/kabupaten', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $data_tabel['kabupaten'],
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  public function show_kecamatan($alert_flag = NULL)
  {
    // init var - view data
    $view_data['kecamatan'] = $this->M_kecamatan->get_kabupaten_provinsi('a.id_kecamatan, a.nama as kecamatan, b.id_kabupaten, b.nama as kabupaten, c.id_provinsi, c.nama as provinsi');

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
      $this->alert_vars = $this->load->view("alert_template/data_master/wilayah_administratif/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/wilayah_administratif/show/kecamatan', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $data_tabel['kecamatan'],
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  public function show_kelurahan($alert_flag = NULL)
  {
    // init var - view data
    $view_data['kelurahan'] = $this->M_kelurahan->get_kecamatan_kabupaten_provinsi('a.id_kelurahan, a.nama as kelurahan, b.id_kecamatan, b.nama as kecamatan, c.id_kabupaten, c.nama as kabupaten, d.id_provinsi, d.nama as provinsi');

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
      $this->alert_vars = $this->load->view("alert_template/data_master/wilayah_administratif/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/wilayah_administratif/show/kelurahan', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $data_tabel['kelurahan'],
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  ////////////
  // CREATE //
  ////////////
  public function create_provinsi($alert_flag = NULL)
  {
    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/data_master/wilayah_administratif/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/wilayah_administratif/add/provinsi', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  public function store_provinsi()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_provinsi('gagal_form_invalid');
    } else {
      // init var - local
      $provinsi = array();

      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($this->input->post('nama') as $key => $value) {
        $provinsi['id_provinsi'] = rand(10,99);
        $provinsi['nama'] = strtoupper($value);
        $this->M_provinsi->store($provinsi);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'create-provinsi/gagal_provinsi';
        header("Location: $url");
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $url = base_url() . 'provinsi/sukses_provinsi';
        header("Location: $url");
      }
    }
  }

  public function create_kabupaten($alert_flag = NULL)
  {
    // init var - view data
    $view_data['provinsi'] = $this->M_provinsi->get_data();
    
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
      $this->alert_vars = $this->load->view("alert_template/data_master/wilayah_administratif/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/wilayah_administratif/add/kabupaten', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'provinsi' => $this->replace_provinsi($data_tabel['provinsi']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  private function replace_provinsi($data = array())
  {
    // init var - local
    $ret_val = array();

    // replacing array
    foreach ($data as $key => $value) {
      $value['nama'] = strtoupper($value['nama']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  public function store_kabupaten()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_kabupaten('gagal_form_invalid');
    } else {
      // init var - local
      $kabupaten = array();

      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($this->input->post('nama') as $key => $value) {
        $kabupaten['id_provinsi'] = $this->input->post('id_provinsi');
        $kabupaten['id_kabupaten'] = $this->input->post('id_provinsi') . rand(10,99);
        $kabupaten['nama'] = strtoupper($value);
        $this->M_kabupaten->store($kabupaten);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'create-kabupaten/gagal_kabupaten';
        header("Location: $url");
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $url = base_url() . 'kabupaten/sukses_kabupaten';
        header("Location: $url");
      }
    }
  }

  public function create_kecamatan($alert_flag = NULL)
  {
    // init var - view data
    $view_data['provinsi'] = $this->M_provinsi->get_data();
    
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
      $this->alert_vars = $this->load->view("alert_template/data_master/wilayah_administratif/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/wilayah_administratif/add/kecamatan', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'provinsi' => $this->replace_provinsi($data_tabel['provinsi']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  public function store_kecamatan()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_kecamatan('gagal_form_invalid');
    } else {
      // init var - local
      $kecamatan = array();

      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($this->input->post('nama') as $key => $value) {
        $kecamatan['id_kecamatan'] = $this->input->post('id_kabupaten') . rand(100, 999);
        $kecamatan['id_provinsi'] = $this->input->post('id_provinsi');
        $kecamatan['id_kabupaten'] = $this->input->post('id_kabupaten');
        $kecamatan['nama'] = strtoupper($value);
        $this->M_kecamatan->store($kecamatan);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'create-kecamatan/gagal_kecamatan';
        header("Location: $url");
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $url = base_url() . 'kecamatan/sukses_kecamatan';
        header("Location: $url");
      }
    }
  }

  public function create_kelurahan($alert_flag = NULL)
  {
    // init var - view data
    $view_data['provinsi'] = $this->M_provinsi->get_data();
    
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
      $this->alert_vars = $this->load->view("alert_template/data_master/wilayah_administratif/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/wilayah_administratif/add/kelurahan', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'provinsi' => $this->replace_provinsi($data_tabel['provinsi']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  public function store_kelurahan()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_kelurahan('gagal_form_invalid');
    } else {
      // init var - local
      $kelurahan = array();

      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($this->input->post('nama') as $key => $value) {
        $kelurahan['id_kelurahan'] = $this->input->post('id_kecamatan') . rand(100, 999);
        $kelurahan['id_provinsi'] = $this->input->post('id_provinsi');
        $kelurahan['id_kabupaten'] = $this->input->post('id_kabupaten');
        $kelurahan['id_kecamatan'] = $this->input->post('id_kecamatan');
        $kelurahan['nama'] = strtoupper($value);
        $this->M_kelurahan->store($kelurahan);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'create-kelurahan/gagal_kelurahan';
        header("Location: $url");
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $url = base_url() . 'kelurahan/sukses_kelurahan';
        header("Location: $url");
      }
    }
  }

  ////////////
  // DELETE //
  ////////////
  public function destroy_provinsi($id_provinsi)
  {
    // storing data
    $this->db->trans_begin();
    $this->M_provinsi->destroy($id_provinsi);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'provinsi/gagal_hapus_provinsi';
      header("Location: $url");
    } else {
      $this->db->trans_rollback();
      // $this->db->trans_commit();
      $url = base_url() . 'provinsi/sukses_hapus_provinsi';
      header("Location: $url");
    }
  }

  public function destroy_kabupaten($id_kabupaten)
  {
    // storing data
    $this->db->trans_begin();
    $this->M_kabupaten->destroy($id_kabupaten);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'kabupaten/gagal_hapus_kabupaten';
      header("Location: $url");
    } else {
      $this->db->trans_rollback();
      // $this->db->trans_commit();
      $url = base_url() . 'kabupaten/sukses_hapus_kabupaten';
      header("Location: $url");
    }
  }

  public function destroy_kecamatan($id_kecamatan)
  {
    // storing data
    $this->db->trans_begin();
    $this->M_kecamatan->destroy($id_kecamatan);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'kecamatan/gagal_hapus_kecamatan';
      header("Location: $url");
    } else {
      $this->db->trans_rollback();
      // $this->db->trans_commit();
      $url = base_url() . 'kecamatan/sukses_hapus_kecamatan';
      header("Location: $url");
    }
  }

  public function destroy_kelurahan($id_kelurahan)
  {
    // storing data
    $this->db->trans_begin();
    $this->M_kelurahan->destroy($id_kelurahan);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'kelurahan/gagal_hapus_kelurahan';
      header("Location: $url");
    } else {
      $this->db->trans_rollback();
      // $this->db->trans_commit();
      $url = base_url() . 'kelurahan/sukses_hapus_kelurahan';
      header("Location: $url");
    }
  }
}