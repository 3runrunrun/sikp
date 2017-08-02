<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_home extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    # code...
  }

  public function coba()
  {
    $view_data['pasien'] = $this->M_pasien_identitas->get_data();
    echo json_encode($view_data);
  }
}