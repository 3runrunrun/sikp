<?php 

/**
* 
*/
class C_pencatatan_obat_baru extends CI_Controller
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
   * SIKP-PF-126
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
      'js_framework' =>  $js_framework, 
      );
    $this->parser->parse('home', $data);
  }

  /**
   * SIKP-PF-127
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
   * SIKP-PF-128
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function get_data($alert_flag = NULL)
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
    $this->template = $this->load->view('pengelolaan_obat/data_obat', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_get_data($data_tabel['obat']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Data Obat', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-129
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_get_data($data = array())
  {
    // init var - local
    $ret_val = array();

    // init var - array replace
    $bpjs = array(
      '1' => '<span class="badge bg-green">Ya</span>',
      '0' => '<span class="badge bg-red">Tidak</span>', 
      );
    $jenis = array(
      '1' => 'Kapsul',
      '2' => 'Tablet',
      '3' => 'Sirup',
      );
    $satuan = array(
      '1' => 'Butir',
      '2' => 'Botol',
    );

    // replacing and repopulating view data
    foreach ($data as $key => $value) {
      if (empty($value['jumlah'])) {
        $value['jumlah'] = '<span class="badge bg-red">Habis</span>';
      }

      $value['nama'] = strtoupper($value['nama']);
      $value['bpjs'] = str_replace(array_keys($bpjs), $bpjs, $value['bpjs']);
      $value['jenis'] = str_replace(array_keys($jenis), $jenis, $value['jenis']);
      $value['satuan'] = str_replace(array_keys($satuan), $satuan, $value['satuan']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  /**
   * SIKP-PF-130
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function create($alert_flag = NULL)
  {
    // parsing alert template
    if ($alert_flag !== NULL) {
      $this->vars = $this->load->view("alert_template/pengelolaan_obat/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('pengelolaan_obat/pencatatan_obat_baru', $view_data, TRUE);
    $this->template_data = array('alert_template' => $this->vars);

    // parsing view
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view('Formulir Penambahan Obat Baru', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-131
   * @return [type] [description]
   */
  public function store()
  {
    // init var - local var
    $data_obat = array();
    $data_masuk = array();

    // validating form
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '<p><strong>Silahkan ulangi pengisian data</strong></p></div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create('gagal_form_invalid');
    } else {
      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($this->input->post('nama[]') as $key => $value) {
        $data_obat['id_obat'] = $this->id_generator('OBT');
        $data_obat['nama'] = $this->input->post('nama[]')[$key];
        $data_obat['bpjs'] = $this->input->post('bpjs[]')[$key];
        $data_obat['jumlah'] = $this->input->post('jumlah[]')[$key];
        $data_obat['jenis'] = $this->input->post('jenis[]')[$key];
        if ($this->input->post('jenis[]')[$key] == '1' || $this->input->post('jenis[]')[$key] == '2') {
          $data_obat['satuan'] = '1';
        } else {
          $data_obat['satuan'] = '2';
        }

        $data_obat_masuk['id_obat_masuk'] = $this->id_generator('OMSK');
        $data_obat_masuk['jumlah_masuk'] = $this->input->post('jumlah[]')[$key];
        $data_obat_masuk['id_obat'] = $data_obat['id_obat'];
        $data_obat_masuk['tgl_masuk'] = date('Y-m-d H:i:s');

        $this->M_obat->store($data_obat);
        $this->M_obat_masuk->store($data_obat_masuk);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-obat-baru/gagal_obat_baru';
        header("Location: $url");
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'formulir-obat-baru/sukses_obat_baru';
        header("Location: $url");
      }
    }
  }

  /**
   * SIKP-PF-132
   * @param  [type] $id_obat [description]
   * @return [type]          [description]
   */
  public function destroy($id_obat)
  {
    // deleting data
    $this->db->trans_begin();
    $this->M_obat->destroy($id_obat);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'data-obat/' . 'gagal_hapus_obat_baru';
      header("Location: $url");
    } else {
      $this->db->trans_commit();
      $url = base_url() . 'data-obat/' . 'sukses_hapus_obat_baru';
      header("Location: $url");
    }
  }
}