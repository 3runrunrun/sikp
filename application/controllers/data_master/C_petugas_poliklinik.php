<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_petugas_poliklinik extends CI_Controller
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
}