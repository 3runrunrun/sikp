<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data_tabel['data'] = array();
		// echo base_url();
    $this->load->view('pengelolaan_obat/export/obat_keluar', $data_tabel);
	}

	private function date_formatter($date_string, $format)
	{
	  $date_object = date_create($date_string);
	  $formatted_date = date_format($date_object, $format);
	  return $formatted_date;
	}

	public function pdf()
	{
	  $view_data['laporan'] = $this->M_obat_keluar->get_data_by_range('2017-09-01', '2017-09-30');

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

	  $this->load->view('pengelolaan_obat/export/obat_keluar', $data_tabel);
	}
}
