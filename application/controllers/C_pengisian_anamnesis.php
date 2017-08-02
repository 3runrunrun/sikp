<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_pengisian_anamnesis extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
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

  public function create_pengisian_anamnesis($id_registrasi = NULL)
  {
    // VIEW DATA
    $view_data['id_registrasi'] = $id_registrasi;
    $view_data['pasien_identitas'] = $this->M_status->show_detail_status_pasien('id_registrasi, hol_status.no_bpjs, hol_status.nik_tenaga_medis, pas_identitas.nama, pas_identitas.jenis_kelamin, YEAR(NOW()) - YEAR(pas_identitas.tgl_lahir) AS umur, pas_identitas.pekerjaan_utama, pas_identitas.alamat', $id_registrasi);

    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    $page_content = $this->load->view('pengobatan_holistik/formulir_pengisian_anamnesis', $view_data, TRUE);
    
    $this->parse_view('Formulir Pengisian Anamnesis', $css_framework, $page_content, $js_framework);
  }

  public function update_pengisian_anamnesis()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</li></ul></div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_pengisian_anamnesis($this->input->post('id_registrasi'));
    } else {
      // INITIALIZE VAR
      $input_var = $this->input->post();
      $id = array();
      $data_status = array();
      $data_keluhan = array();

      // REPOPULATING VAR & STORE DATA
      foreach ($input_var as $key => $value) {
        if ($key == 'id_registrasi') {
          $id[$key] = $value;
        }
        if ($key != 'id_registrasi' && $key != 'no_bpjs' && $key != 'nik_tenaga_medis' && $key != 'keluhan') {
          $data_status[$key] = $value;
        }
      }
      $data_status['status'] = 'anamnesis';

      // START TRANSACTION
      // $this->db->trans_begin();
      $this->M_status->update($id, $data_status);
      foreach ($input_var['keluhan'] as $key => $value) {
        $data_keluhan['id_keluhan'] = $this->id_generator('KLH');
        $data_keluhan['id_registrasi'] = $input_var['id_registrasi'];
        $data_keluhan['no_bpjs'] = $input_var['no_bpjs'];
        $data_keluhan['nik_tenaga_medis'] = $input_var['nik_tenaga_medis'];
        $data_keluhan['anamnesis'] = $value;
        $this->M_keluhan->store($data_keluhan);
      }
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $template = $this->load->view('errors/error_db', '', TRUE);
        $template_data = array('error_msg' => null);
        $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
        $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
        $page_content = $this->parser->parse_string($template, $template_data, TRUE);
        $this->parse_view('Sistem Informasi Kesehatan Andal', $css_framework, $page_content, $js_framework);
      } else {
        $this->db->trans_commit();
        $url = base_url() . 'daftar-pasien-terdaftar';
        header("Location: $url");
      }
    }
  }
}