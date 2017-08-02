<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_sidebar extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
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

  public function show_data_dasar()
  {
    // INITIALIZE VAR
    $vars = NULL;
    $data_tabel = NULL;
    $page_content = NULL;
    $result = $this->M_kk->get_data();

    if ($result['status'] == 'error') {
      $vars = $this->eh->db_error($result['payload']);
      $template = $this->load->view('errors/error_db', '', TRUE);
      $template_data = array('error_msg' => $vars);

      $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
      $page_content = $this->parser->parse_string($template, $template_data, TRUE);
      $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);
    } else {
      $template = $this->load->view('data_dasar/daftar_data_dasar', '', TRUE);
      $template_data = array('data_tabel' => $result['payload']);

      $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
      $page_content = $this->parser->parse_string($template, $template_data, TRUE);
      $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);
    }

    $this->parse_view('Data Dasar Kesehatan Keluarga', $css_framework, $page_content, $js_framework);
  }

  public function create_pendaftaran_pengobatan()
  {
    // VIEW DATA
    $vars = NULL;
    $view_data['pasien'] = $this->M_pasien_identitas->get_data();
    $view_data['tenaga_medis'] = $this->M_tenaga_medis->get_data();

    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    $template = $this->load->view('pengobatan_holistik/formulir_pendaftaran_pengobatan', $view_data, TRUE);
    $template_data = array('success_alert' => $vars);
    $page_content = $this->parser->parse_string($template, $template_data, TRUE);
    
    $this->parse_view('Formulir Pendaftaran Pengobatan Holistik', $css_framework, $page_content, $js_framework);
  }

  public function show_pasien_terdaftar()
  {
    // VIEW DATA
    $vars = NULL;
    $view_data = $this->M_status->get_data_pasien_terdaftar();

    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);
    $template = $this->load->view('pengobatan_holistik/daftar_pasien_terdaftar', '', TRUE);
    $template_data = array('data_tabel' => $view_data['data']);
    $page_content = $this->parser->parse_string($template, $template_data, TRUE);

    $this->parse_view('Daftar Pasien Pengobatan Holistik', $css_framework, $page_content, $js_framework);
  }
}