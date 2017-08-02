<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_daftar_pasien extends CI_Controller
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
    $view_data['pasien_identitas'] = $this->M_status->show_detail_status_pasien($id_registrasi, 'id_registrasi, hol_status.no_bpjs, hol_status.nik_tenaga_medis, pas_identitas.nama, pas_identitas.jenis_kelamin, YEAR(NOW()) - YEAR(pas_identitas.tgl_lahir) AS umur, pas_identitas.pekerjaan_utama, pas_identitas.alamat');

    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    $page_content = $this->load->view('pengobatan_holistik/formulir_pengisian_anamnesis', $view_data, TRUE);
    
    $this->parse_view('Formulir Pengisian Anamnesis', $css_framework, $page_content, $js_framework);
  }

  public function create_pengisian_diagnosis($id_registrasi = NULL)
  {
    // VIEW DATA
    $view_data['id_registrasi'] = $id_registrasi;
    $view_data['pasien_identitas'] = $this->M_status->show_detail_status_pasien($id_registrasi, 'hol_status.id_registrasi, hol_status.nik_tenaga_medis, hol_status.no_bpjs, hol_status.tgl_periksa, hol_status.alergi_obat, hol_status.alergi_makanan, hol_status.td, hol_status.rr, hol_status.nadi, hol_status.suhu, pas_identitas.nama, pas_identitas.jenis_kelamin, YEAR(NOW()) - YEAR(pas_identitas.tgl_lahir) AS umur, pas_identitas.pekerjaan_utama, pas_identitas.alamat');
    $view_data['keluhan'] = $this->M_keluhan->show($id_registrasi);
    $view_data['modul_penyakit'] = $this->M_penyakit->get_data();
    $view_data['modul_faktor_risiko'] = $this->M_faktor_risiko->get_data();
    $view_data['modul_faktor_pemicu'] = $this->M_faktor_pemicu->get_data();
    $status = $this->M_status->show($id_registrasi, 'status');
    
    if ($status['data'][0]['status'] == 'diagnosis') {
      $url = base_url() . 'pengubahan-diagnosis/' . $id_registrasi;
      header("Location: $url");
      exit();
    }

    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    $page_content = $this->load->view('pengobatan_holistik/formulir_pengisian_diagnosis', $view_data, TRUE);

    $this->parse_view('Formulir Pengisian Diagnosis', $css_framework, $page_content, $js_framework);
  }

  public function edit_pengisian_diagnosis($id_registrasi = NULL)
  {
    $view_data['id_registrasi'] = $id_registrasi;
    $view_data['pasien_identitas'] = $this->M_status->show_detail_status_pasien($id_registrasi, 'hol_status.id_registrasi, hol_status.nik_tenaga_medis, hol_status.no_bpjs, hol_status.tgl_periksa, hol_status.alergi_obat, hol_status.alergi_makanan, hol_status.td, hol_status.rr, hol_status.nadi, hol_status.suhu, pas_identitas.nama, pas_identitas.jenis_kelamin, YEAR(NOW()) - YEAR(pas_identitas.tgl_lahir) AS umur, pas_identitas.pekerjaan_utama, pas_identitas.alamat');
    $view_data['keluhan'] = $this->M_keluhan->show($id_registrasi);
    $view_data['modul_penyakit'] = $this->M_penyakit->get_data();
    $view_data['modul_faktor_risiko'] = $this->M_faktor_risiko->get_data();
    $view_data['modul_faktor_pemicu'] = $this->M_faktor_pemicu->get_data();
    $view_data['diagnosis_penyakit'] = $this->M_diagnosis_penyakit->show_by_registrasi($id_registrasi);
    $view_data['faktor_risiko'] = $this->M_hol_faktor_risiko->show_by_registrasi($id_registrasi);
    $view_data['faktor_pemicu'] = $this->M_hol_faktor_pemicu->show_by_registrasi($id_registrasi);

    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    $page_content = $this->load->view('pengobatan_holistik/edit_pengisian_diagnosis', $view_data, TRUE);

    $this->parse_view('Formulir Pengisian Diagnosis', $css_framework, $page_content, $js_framework);
  }
}