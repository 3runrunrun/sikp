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
		// echo base_url();
    date_default_timezone_set('Asia/Jakarta');
		$mc = microtime();
		$exmc = explode(' ', $mc);
		echo $exmc[0] . '<br />';
		echo substr($exmc[0], 5, 3);
	}

	public function tampil()
	{
		$this->M_keluhan->coba();
	}

	public function show_form_data_dasar()
	{
		$data = array(
			'page_title' => 'Formulir Data Dasar Kesehatan Keluarga',
			'css_framework' => $this->load->view('css_framework/head_form', '', TRUE), 
			'page_header' => $this->load->view('headers/main_header', '', TRUE), 
			'page_sidebar' => $this->load->view('sidebars/main_sidebar', '', TRUE), 
			'page_content' => $this->load->view('contents/formulir_data_dasar', '', TRUE), 
			'page_footer' => $this->load->view('footers/main_footer', '', TRUE), 
			'js_framework' => $this->load->view('js_framework/js_datatables', '', TRUE),
			);
		$this->parser->parse('try_parser', $data);
	}

	public function tambah_pasien_baru()
	{
		$this->form_validation->set_error_delimiters('<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>');
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'page_title' => 'Formulir Data Dasar Kesehatan Keluarga',
				'css_framework' => $this->load->view('css_framework/head_form', '', TRUE), 
				'page_header' => $this->load->view('headers/main_header', '', TRUE), 
				'page_sidebar' => $this->load->view('sidebars/main_sidebar', '', TRUE), 
				'page_content' => $this->load->view('contents/formulir_data_dasar', '', TRUE), 
				'page_footer' => $this->load->view('footers/main_footer', '', TRUE), 
				'js_framework' => $this->load->view('js_framework/js_datatables', '', TRUE),
				);
			$this->parser->parse('try_parser', $data);
		} else {
			var_dump($this->input->post());
		}
	}
}
