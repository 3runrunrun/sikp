<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_Login extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function login()
  {
    $tipe_pengguna = $this->input->post('tipe_pengguna');
    $uname = $this->input->post('uname');
    $pwd = $this->input->post('pwd');

    $result = NULL;
    switch ($tipe_pengguna) {
      case 'tm':
        $result = $this->M_TenagaMedis->isAny($uname, $pwd);
        break;

      case 'tp':
        $result = $this->M_TenagaParamedis->isAny($uname, $pwd);
        break;

      case 'tk':
        $result = $this->M_TenagaKefarmasian->isAny($uname, $pwd);
        break;

      case 'sa':
        $result = $this->M_StafAdministrasi->isAny($uname, $pwd);
        break;
      
      default:
        # code...
        break;
    }

    if ($result === '0') {
      echo "<script>window.alert('login gagal.')</script>";
      echo "<script>window.location = 'http://localhost/sikp/index.php' </script>";
    } else {
      $data['jumlah'] = $result;
      $data['tipe_pengguna'] = $tipe_pengguna;
      $this->load->view('V_Menu', $data);
    }
  }
}