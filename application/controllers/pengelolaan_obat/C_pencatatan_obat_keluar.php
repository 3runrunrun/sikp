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
    $view_data['obat'] = $this->M_obat_keluar->get_data_obat('a.id_obat_keluar, a.id_resep_obat, a.id_obat, b.nama, a.jumlah_keluar, b.satuan, a.tgl_keluar');

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
    // $this->template = $this->load->view('pengelolaan_obat/export/obat_keluar', '', TRUE);
    $this->template = $this->load->view('pengelolaan_obat/data_obat_keluar', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_get_data($data_tabel['obat']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Laporan Obat Keluar', $css_framework, $page_content, $js_framework);
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
      $value['tgl_keluar'] = $this->date_formatter($value['tgl_keluar'], 'd-M-Y');
      array_push($ret_val, $value);
    }
    return $ret_val;
  }

  // return json array for ajax purpose
  public function show_sisa_obat()
  {
    // INITIALIZE VAR
    $id_obat = $this->input->post('id_obat');
    $result = $this->M_obat->show($id_obat, 'jumlah');
    echo json_encode($result);
  }

  public function create($alert_flag = NULL)
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
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '<p><small><strong>Silahkan ulangi pengisian data</strong></small></p></div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create('gagal_form_invalid');
    } else {
      // init var - local
      $data_obat_keluar = array();
      $input_var = $this->input->post();

      // var_dump($input_var);

      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($input_var['id_obat'] as $key => $value) {
        $data_obat_keluar['id_obat_keluar'] = $this->id_generator('OBK');
        $data_obat_keluar['id_resep_obat'] = $input_var['id_resep_obat'];
        $data_obat_keluar['id_obat'] = $value;
        $data_obat_keluar['jumlah_keluar'] = $input_var['jumlah_keluar'][$key];
        $data_obat_keluar['tgl_keluar'] = date('Y-m-d');

        $jumlah_keluar = $data_obat_keluar['jumlah_keluar'];
        
        $this->M_obat_keluar->store($data_obat_keluar);
        $this->M_obat->update_persediaan($value, 'kurang', $jumlah_keluar);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'formulir-pencatatan-obat-keluar/gagal_obat_keluar';
        header("Location: $url");
      } else {
        // $this->db->trans_rollback();
        $this->db->trans_commit();
        $url = base_url() . 'formulir-pencatatan-obat-keluar/sukses_obat_keluar';
        header("Location: $url");
      }
    }
  }

  public function cetak_laporan_obat_keluar()
  {
    // init var - local
    $from = $this->input->post('dari_tanggal');
    $to = $this->input->post('sampai_tanggal');
    $view_data['laporan'] = $this->M_obat_keluar->get_data_by_range($from, $to);

    // assign var - from and to
    $data_tabel['from'] = $this->date_formatter($from, 'd-M-Y');
    $data_tabel['to'] = $this->date_formatter($to, 'd-M-Y');

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

    // generating pdf file
    $this->load->library('pdf');
    $this->pdf->set_paper('a4', 'landscape');
    $this->pdf->load_view('pengelolaan_obat/export/obat_keluar', $data_tabel);
    $this->pdf->render();
    $this->pdf->get_canvas()->page_text(16, 570, "Halaman: {PAGE_NUM} dari {PAGE_COUNT}", 'Arial', 10, array(0,0,0));
    $this->pdf->stream("laporan_obat_keluar.pdf", array("Attachment" => 0));
  }

  public function destroy($id_obat_keluar)
  {
    // init var - view data
    $view_data = $this->M_obat_keluar->show($id_obat_keluar, 'a.id_obat, a.jumlah_keluar');

    // init var
    $id_obat = $view_data['data']['0']['id_obat'];
    $jumlah_keluar = $view_data['data']['0']['jumlah_keluar'];

    // deleting data
    $this->db->trans_begin();
    $this->M_obat_keluar->destroy($id_obat_keluar);
    $this->M_obat->update_persediaan($id_obat, strtolower('tambah'), $jumlah_keluar);
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
