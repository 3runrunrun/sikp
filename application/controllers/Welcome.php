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

	public function pdf_generator()
	{
		$this->load->library('pdf');
  	$this->pdf->load_view('mypdf');
  	$this->pdf->render();
  	$this->pdf->stream("welcome.pdf");
	}
}
