<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class C_home extends CI_Controller
{
  // init var - template data
  private $template;
  private $template_data = array();
  private $vars = NULL;

  // init var - error template
  private $err_template;
  private $err_template_data = array();
  private $err_vars = NULL;

  // init var - alert template
  private $alert_template;
  private $alert_template_data = array();
  private $alert_vars = NULL;
  
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    if ($this->session->userdata('aktif') !== TRUE) {
      $this->login();
    } else {
      switch ($this->session->userdata('tabel')) {
        case 'keperawatan':
          $url = base_url() . 'pasien-anamnesis-harian';
          break;

        case 'medis':
          $url = base_url() . 'pasien-diagnosis-harian';
          break;

        case 'kefarmasian':
          $url = base_url() . 'formulir-pencatatan-obat-keluar';
          break;

        case 'administrasi':
          $url = base_url() . 'pendaftaran-pasien';
          break;

        case 'admin':
          $url = base_url() . 'kelurahan';
          break;
        
        default:
          $this->login();
          break;
      }
      header("Location: $url");
      print_r($this->session->userdata());
    }
  }

  public function login($alert_flag = NULL)
  {
    // init var - view data
    $view_data['pengguna'] = $this->M_staf_administrasi->get_user();

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

    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/login/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'pengguna' => $this->replace_login($data_tabel['pengguna']),
      );

    $this->parser->parse('login', $this->template_data);
  }

  public function replace_login($data = array())
  {
    $ret_val = array();

    foreach ($data as $key => $value) {
      $value['nama'] = ucwords($value['nama']);
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  public function do_login()
  {
    // init var - local
    $uname = $this->input->post('uname');
    $pwd = $this->input->post('pwd');
    $remember_me = $this->input->post('remember_me');
    $pengguna = array();

    // init var - view data
    $view_data['pengguna'] = $this->M_admin->get_user_by_pwd($uname, $pwd);

    // check if any system error
    if ($view_data['pengguna']['status'] == 'error') {
      $this->login('sistem_error');
    } else {
      $pengguna = $view_data['pengguna']['data'];
      if (empty($pengguna)) {
        $this->login('tidak_cocok');
      } else {
        if (count($pengguna) != 1) {
          $this->login('lebih_dari_satu');
        } else {
          $user_data = $this->replace_do_login($pengguna);
          print_r($user_data);
          $this->session->set_userdata($user_data);
          $url = base_url();
          header("Location: $url");
        }        
      }
    }
  }

  public function replace_do_login($data = array())
  {
    // init var - local
    $ret_val = array();

    // init var - array replacer
    $tabel = array(
      'poli_tenaga_paramedis' => 'keperawatan',
      'poli_tenaga_medis' => 'medis',
      'poli_tenaga_kefarmasian' => 'kefarmasian',
      'poli_staf_administrasi' => 'administrasi',
      'sys_admin' => 'admin',
      );

    foreach ($data as $key => $value) {
      // replacing value
      $value['nama'] = ucwords($value['nama']);
      $value['tabel'] = str_replace(array_keys($tabel), $tabel, $value['tabel']);
      $value['aktif'] = TRUE;

      // unsetting uname and password
      unset($value['uname']);
      unset($value['pwd']);
      
      array_push($ret_val, $value);
    }

    return $ret_val[0];
  }

  public function logout()
  {
    if ($this->session->userdata('aktif') === TRUE) {
      $this->session->sess_destroy();
    }    
    $this->index();
  }
}