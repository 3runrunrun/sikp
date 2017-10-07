<?php 

/**
* 
*/
class C_pencatatan_obat_masuk extends CI_Controller
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

  private function parse_view($page_title, $css_framework, $page_content, $js_framework)
  {
    $data = array(
      'page_title' => $page_title,
      'css_framework' => $css_framework, 
      'page_header' => $this->load->view('headers/main_header', '', TRUE), 
      'page_sidebar' => $this->load->view('sidebars/main_sidebar', '', TRUE), 
      'page_content' => $page_content,
      'page_footer' => $this->load->view('footers/main_footer', '', TRUE), 
      'js_framework' =>  $js_framework, 
      );
    $this->parser->parse('home', $data);
  }

  private function date_formatter($date_string, $format)
  {
    $date_object = date_create($date_string);
    $formatted_date = date_format($date_object, $format);
    return $formatted_date;
  }

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

  public function get_data($alert_flag = NULL)
  {
    // init var - view data
    $view_data['obat'] = $this->M_obat_masuk->get_data_obat('a.id_obat_masuk, a.id_obat, b.nama, a.jumlah_masuk, b.satuan, a.tgl_masuk');

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
    $this->template = $this->load->view('pengelolaan_obat/data_obat_masuk', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_get_data($data_tabel['obat']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Laporan Obat Masuk', $css_framework, $page_content, $js_framework);
  }

  private function replace_get_data($data = array())
  {
    // init var - local
    $ret_val = array();

    // init var - array replace
    $satuan = array(
      '1' => 'Butir',
      '2' => 'Botol',
    );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      $value['nama'] = strtoupper($value['nama']);
      $value['satuan'] = str_replace(array_keys($satuan), $satuan, $value['satuan']);
      $value['tgl_masuk'] = $this->date_formatter($value['tgl_masuk'], 'd-M-Y H:i');
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  public function create($alert_flag = NULL)
  {
    // init var - view data
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

    if ($alert_flag !== NULL) {
      $this->alert_vars = $this->load->view("alert_template/pengelolaan_obat/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengelolaan_obat/pencatatan_obat_masuk', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'obat' => $this->replace_obat($data_tabel['obat']),
      );

    // parsing view
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);

    $this->parse_view('Formulir Pencatatan Obat Keluar', $css_framework, $page_content, $js_framework);
  }

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
      $value['nama'] = ucwords($value['nama']);
      $value['satuan'] = str_replace(array_keys($satuan), $satuan, $value['satuan']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  public function store()
  {
    // init var - local var
    $data_obat = array();
    $data_masuk = array();
    // var_dump($this->input->post());

    // validating form
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '<p><strong>Silahkan ulangi pengisian data</strong></p></div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create('gagal_form_invalid');
    } else {

      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($this->input->post('id_obat[]') as $key => $value) {
        // data masuk
        $data_masuk['id_obat_masuk'] = $this->id_generator('OMSK');
        $data_masuk['jumlah_masuk'] = $this->input->post('jumlah_masuk[]')[$key];
        $data_masuk['id_obat'] = $value;
        $data_masuk['tgl_masuk'] = date('Y-m-d H:i:s');

        // data obat
        $this->M_obat->update_persediaan($value, strtolower('tambah'), $data_masuk['jumlah_masuk']);
        $this->M_obat_masuk->store($data_masuk);
      }

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-pencatatan-obat-masuk/gagal_obat_masuk';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'formulir-pencatatan-obat-masuk/sukses_obat_masuk';
        header("Location: $url");
      }
    }
  }

  public function destroy($id_obat_masuk)
  {
    // init var - view data
    $view_data = $this->M_obat_masuk->show($id_obat_masuk, 'a.id_obat, a.jumlah_masuk');

    // init var
    $id_obat = $view_data['data']['0']['id_obat'];
    $jumlah_masuk = $view_data['data']['0']['jumlah_masuk'];

    // deleting data
    $this->db->trans_begin();
    $this->M_obat_masuk->destroy($id_obat_masuk);
    $this->M_obat->update_persediaan($id_obat, strtolower('kurang'), $jumlah_masuk);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'data-obat-masuk/' . 'gagal_hapus_obat_masuk';
      header("Location: $url");
    } else {
      $this->db->trans_commit();
      $url = base_url() . 'data-obat-masuk/' . 'sukses_hapus_obat_masuk';
      header("Location: $url");
    }
  }
}