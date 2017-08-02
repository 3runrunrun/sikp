<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_Menu extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function vlPengobatanHolistik()
  {
    $result = $this->M_DiagnosisHolistik->rl_status_pasien();

    if ($result['status'] == 'error') {
      $vars = $this->eh->db_error($result['data']);
      echo $vars;
    } else {
      if ($result['data'] == 'empty') {
        $vars = $this->eh->empty_result();
        echo $vars;
      } else {
        foreach ($result['data'] as $vars) {
          echo $vars[0];
        }
      }
    }
  }
}