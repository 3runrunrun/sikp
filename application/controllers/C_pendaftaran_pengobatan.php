<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_pendaftaran_pengobatan extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  private function parse_view($css_framework, $page_content, $js_framework)
  {
    $data = array(
      'page_title' => 'Data Dasar Kesehatan Keluarga',
      'css_framework' => $css_framework, 
      'page_header' => $this->load->view('headers/main_header', '', TRUE), 
      'page_sidebar' => $this->load->view('sidebars/main_sidebar', '', TRUE), 
      'page_content' => $page_content,
      'page_footer' => $this->load->view('footers/main_footer', '', TRUE), 
      'js_framework' => $js_framework, 
      );
    $this->parser->parse('home', $data);
  }

  private function id_generator()
  {
    $micro_time = microtime();
    $ex_mt = explode(' ', $micro_time);
    $sbstr_mt = substr($ex_mt[0], 5, 3);
    $id = 'REG' . '-' . date('ymdHis') . $sbstr_mt;
    return $id;
  }

  public function store()
  {
    $this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
    if ($this->form_validation->run() == FALSE) {
      $vars = NULL;
      $view_data['pasien'] = $this->M_pasien_identitas->get_data();
      $view_data['tenaga_medis'] = $this->M_tenaga_medis->get_data();      
      $template = $this->load->view('pengobatan_holistik/formulir_pendaftaran_pengobatan', $view_data, TRUE);
      $template_data = array('success_alert' => $vars);
    } else {
      // INITIALIZE VAR
      $input_var = $this->input->post();
      $input_var['id_registrasi'] = $this->id_generator();
      $input_var['tgl_periksa'] = date('Y-m-d H:i:s');

      // STORE DATA
      $result = $this->M_status->store($input_var);

      if ($result['status'] == 'error') {
        $view_data = $this->eh->db_error($result['data']);
        $template = $this->load->view('errors/error_db', '', TRUE);
        $template_data = array('error_msg' => $view_data);
      } else {
        // GET DATA
        $view_data['pasien'] = $this->M_pasien_identitas->get_data();
        $view_data['tenaga_medis'] = $this->M_tenaga_medis->get_data();    

        // ALERT TEMPLATE PARSER
        $alert_template = $this->load->view('pengobatan_holistik/alert_pendaftaran_pengobatan', '', TRUE);
        $alert_template_data = array(
          'no_bpjs' => $input_var['no_bpjs'], 
          'id_registrasi' => $input_var['id_registrasi']
          );
        $vars = $this->parser->parse_string($alert_template, $alert_template_data, TRUE);

        // PAGE TEMPLATE PARSER
        $template = $this->load->view('pengobatan_holistik/formulir_pendaftaran_pengobatan', $view_data, TRUE);
        $template_data = array('success_alert' => $vars);
      }
    }
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    $page_content = $this->parser->parse_string($template, $template_data, TRUE);
    $this->parse_view($css_framework, $page_content, $js_framework);
  }
}