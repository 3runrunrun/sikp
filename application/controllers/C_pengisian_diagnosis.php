<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_pengisian_diagnosis extends CI_Controller
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

  public function create($id_registrasi = NULL)
  {
    // VIEW DATA
    $view_data['id_registrasi'] = $id_registrasi;
    $view_data['pasien_identitas'] = $this->M_status->show_detail_status_pasien($id_registrasi, 'hol_status.id_registrasi, hol_status.nik_tenaga_medis, hol_status.no_bpjs, hol_status.tgl_periksa, hol_status.alergi_obat, hol_status.alergi_makanan, hol_status.td, hol_status.rr, hol_status.nadi, hol_status.suhu, pas_identitas.nama, pas_identitas.jenis_kelamin, YEAR(NOW()) - YEAR(pas_identitas.tgl_lahir) AS umur, pas_identitas.pekerjaan_utama, pas_identitas.alamat');
    $view_data['keluhan'] = $this->M_keluhan->show($id_registrasi);
    $view_data['modul_penyakit'] = $this->M_penyakit->get_data();
    $view_data['modul_faktor_risiko'] = $this->M_faktor_risiko->get_data();
    $view_data['modul_faktor_pemicu'] = $this->M_faktor_pemicu->get_data();

    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);
    $page_content = $this->load->view('pengobatan_holistik/formulir_pengisian_diagnosis', $view_data, TRUE);

    $this->parse_view('Formulir Pengisian Diagnosis', $css_framework, $page_content, $js_framework);
  }

  public function store()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</li></ul></div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create($this->input->post('id_registrasi'));
    } else {
      // INITIALIZE VAR
      $input_var = $this->input->post();
      $data_diagnosis = array();
      $id = array();
      $data_status = array();
      $data_risiko = array();
      $data_pemicu = array();

      // REPOPULATING & STORING DATA
      $this->db->trans_begin();    

      // data diagnosis
      foreach ($input_var['penyakit'] as $key => $value) {
        $data_diagnosis['id_diagnosa'] = $this->id_generator('DIA');
        $data_diagnosis['id_registrasi'] = $input_var['id_registrasi'];
        $data_diagnosis['nik_tenaga_medis'] = $input_var['nik_tenaga_medis'];
        $data_diagnosis['no_bpjs'] = $input_var['no_bpjs'];
        $data_diagnosis['penyakit'] = $input_var['penyakit'][$key];
        $data_diagnosis['id_mod_penyakit'] = $input_var['id_mod_penyakit'][$key];
        $data_diagnosis['terapi'] = $input_var['terapi'][$key];
        $data_diagnosis['lokasi_intervensi'] = $input_var['lokasi_intervensi'][$key];
        $this->M_diagnosis_penyakit->store($data_diagnosis);
      }

      // data status
      $id['id_registrasi'] = $data_diagnosis['id_registrasi'];
      $data_status['status'] = 'diagnosis';
      $this->M_status->update($id, $data_status);

      // data faktor risiko dan faktor pemicu
      foreach ($input_var['faktor_risiko'] as $key => $value) {
        // data faktor risiko
        $data_risiko['id_faktor_risiko'] = $this->id_generator('FR');
        $data_risiko['id_registrasi'] = $data_diagnosis['id_registrasi'];
        $data_risiko['nik_tenaga_medis'] = $data_diagnosis['nik_tenaga_medis'];
        $data_risiko['no_bpjs'] = $data_diagnosis['no_bpjs'];
        $data_risiko['faktor_risiko'] = $input_var['faktor_risiko'][$key];
        $data_risiko['id_mod_faktor_risiko'] = $input_var['id_mod_faktor_risiko'][$key];

        // data faktor risiko
        $data_pemicu['id_faktor_pemicu'] = $this->id_generator('FP');
        $data_pemicu['id_registrasi'] = $data_diagnosis['id_registrasi'];
        $data_pemicu['nik_tenaga_medis'] = $data_diagnosis['nik_tenaga_medis'];
        $data_pemicu['no_bpjs'] = $data_diagnosis['no_bpjs'];
        $data_pemicu['faktor_pemicu'] = $input_var['faktor_pemicu'][$key];
        $data_pemicu['id_mod_faktor_pemicu'] = $input_var['id_mod_faktor_pemicu'][$key];

        $this->M_hol_faktor_risiko->store($data_risiko);
        $this->M_hol_faktor_pemicu->store($data_pemicu);
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