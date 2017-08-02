<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class AdminLTE extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function index ($page = NULL)
  {
    if ($page === NULL) {
      $this->load->view('adminlte/index');
    } else {
      $this->load->view('adminlte/index2');
    }
  }

  public function calendar ()
  {
    // echo base_url();
    $this->load->view('adminlte/calendar');
  }

}