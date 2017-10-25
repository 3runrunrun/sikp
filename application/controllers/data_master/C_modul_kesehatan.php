<?php 

/**
* 
*/
class C_modul_kesehatan extends CI_Controller
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
    date_default_timezone_set('Asia/Jakarta');

    if ($this->session->userdata('aktif') !== TRUE) {
      $url = base_url();
      header("Location: $url");
    } else { 
      if ($this->session->userdata('tabel') != 'admin') {
        $url = base_url();
        header("Location: $url");
      }
    }
  }

  /**
   * SIKP-PF-174
   * @param  [type] $page_title    [description]
   * @param  [type] $css_framework [description]
   * @param  [type] $page_content  [description]
   * @param  [type] $js_framework  [description]
   * @return [type]                [description]
   */
  private function parse_view($page_title, $css_framework, $page_content = NULL, $js_framework)
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

  /**
   * SIKP-PF-175
   * @param  [type] $prefix [description]
   * @return [type]         [description]
   */
  private function id_generator($prefix)
  {
    $micro_time = microtime();
    $ex_mt = explode(' ', $micro_time);
    $sbstr_mt = substr($ex_mt[0], 5, 3);
    $id = $prefix . '-' . date('ymdHis') . $sbstr_mt;
    return $id;
  }

  /**
   * SIKP-PF-176
   * @param  [type] $date_string [description]
   * @param  [type] $format      [description]
   * @return [type]              [description]
   */
  private function date_formatter($date_string, $format)
  {
    $date_object = date_create($date_string);
    $formatted_date = date_format($date_object, $format);
    return $formatted_date;
  }

  public function index()
  {
    // TEST YOUR CODE HERE
    var_dump($this->M_faktor_risiko->get_data());
  }

  /**
   * SIKP-PF-192
   * @return [type] [description]
   */
  public function show_all_modul()
  {
    $modul = $this->input->post('modul');
    if ($modul == 'penyakit') {
      $view_data = $this->M_penyakit->get_data();
    } elseif ($modul == 'faktor_risiko') {
      $view_data = $this->M_faktor_risiko->get_data();
    } elseif ($modul == 'faktor_pemicu') {
      $view_data = $this->M_faktor_pemicu->get_data();
    }
    echo json_encode($view_data);
  }

  /**
   * SIKP-PF-177
   * @return [type] [description]
   */
  public function show_latest()
  {
    $nama = $this->input->post('nama');
    $modul = $this->input->post('modul');
    if ($modul == 'penyakit') {
      $view_data = $this->M_penyakit->show_latest_by_nama($nama, 'versi');
    } elseif ($modul == 'faktor_risiko') {
      $view_data = $this->M_faktor_risiko->show_latest_by_nama($nama, 'versi');
    } elseif ($modul == 'faktor_pemicu') {
      $view_data = $this->M_faktor_pemicu->show_latest_by_nama($nama, 'versi');
    }
    echo json_encode($view_data);
  }

  //////////
  // SHOW //
  //////////
  /**
   * SIKP-PF-178
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function show_modul_penyakit($alert_flag = NULL)
  {
    // init var - view data
    $view_data['modul_penyakit'] = $this->M_penyakit->get_data_all();

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
      $this->alert_vars = $this->load->view("alert_template/data_master/modul_kesehatan/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/modul_kesehatan/show/modul_penyakit', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_modul($data_tabel['modul_penyakit']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Data Modul Kesehatan', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-179
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function show_modul_faktor_risiko($alert_flag = NULL)
  {
    // init var - view data
    $view_data['modul_faktor_risiko'] = $this->M_faktor_risiko->get_data_all();

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
      $this->alert_vars = $this->load->view("alert_template/data_master/modul_kesehatan/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/modul_kesehatan/show/modul_faktor_risiko', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_modul($data_tabel['modul_faktor_risiko']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Data Modul Kesehatan', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-180
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function show_modul_faktor_pemicu($alert_flag = NULL)
  {
    // init var - view data
    $view_data['modul_faktor_pemicu'] = $this->M_faktor_pemicu->get_data_all();

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
      $this->alert_vars = $this->load->view("alert_template/data_master/modul_kesehatan/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/modul_kesehatan/show/modul_faktor_pemicu', '', TRUE);
    $this->template_data = array(
      'err_vars' => $this->err_vars,
      'alert_vars' => $this->alert_vars,
      'data_tabel' => $this->replace_modul($data_tabel['modul_faktor_pemicu']),
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('Data Modul Kesehatan', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-181
   * @param  array  $data [description]
   * @return [type]       [description]
   */
  private function replace_modul($data = array())
  {
    // init var - local
    $ret_val = array();

    // replacing array
    foreach ($data as $key => $value) {
      $value['nama'] = strtoupper($value['nama']);
      $value['tgl_dibuat'] = $this->date_formatter($value['tgl_dibuat'], 'd-M-Y');
      array_push($ret_val, $value);
    }

    return $ret_val;
  }

  ////////////
  // CREATE //
  ////////////
  /**
   * SIKP-PF-182
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function create_modul_penyakit($alert_flag = NULL)
  {
    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/data_master/modul_kesehatan/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/modul_kesehatan/add/modul_penyakit', '', TRUE);
    $this->template_data = array(
      'alert_vars' => $this->alert_vars,
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-183
   * @return [type] [description]
   */
  public function store_modul_penyakit()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_modul_penyakit('gagal_form_invalid');
    } else {
      // init var - local
      $modul_penyakit = array();

      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($this->input->post() as $key => $value) {
        if ($this->input->post('perbarui') !== '1') {
          $modul_penyakit['id_mod_penyakit'] = $this->id_generator('MPNY');
        }
        $modul_penyakit[$key] = $value;
      }
      // unset perbarui flag
      unset($modul_penyakit['perbarui']);
      $this->M_penyakit->store($modul_penyakit);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'create-modul-penyakit/gagal_modul_penyakit';
        header("Location: $url");
      } else {
        // upload file
        if ( ! $this->do_upload('penyakit', $modul_penyakit['id_mod_penyakit'].$this->input->post('versi'), 'file_modul')) {
          $this->db->trans_rollback();
          $url = base_url() . 'create-modul-penyakit/gagal_modul_penyakit';
          header("Location: $url");
        } else {
          $this->db->trans_commit();
          $url = base_url() . 'modul-penyakit/sukses_modul_penyakit';
          header("Location: $url");
        }
      }
    }
  }

  /**
   * SIKP-PF-184
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function create_modul_faktor_risiko($alert_flag = NULL)
  {
    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/data_master/modul_kesehatan/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/modul_kesehatan/add/modul_faktor_risiko', '', TRUE);
    $this->template_data = array(
      'alert_vars' => $this->alert_vars,
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-185
   * @return [type] [description]
   */
  public function store_modul_faktor_risiko()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_modul_faktor_risiko('gagal_form_invalid');
    } else {
      // init var - local
      $modul_faktor_risiko = array();

      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($this->input->post() as $key => $value) {
        if ($this->input->post('perbarui') !== '1') {
          $modul_faktor_risiko['id_mod_faktor_risiko'] = $this->id_generator('MFR');
        }
        $modul_faktor_risiko[$key] = $value;
      }
      // unset perbarui flag
      unset($modul_faktor_risiko['perbarui']);
      $this->M_faktor_risiko->store($modul_faktor_risiko);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'create-modul-faktor-risiko/gagal_modul_faktor_risiko';
        header("Location: $url");
      } else {
        // upload file
        if ( ! $this->do_upload('faktor_risiko', $modul_faktor_risiko['id_mod_faktor_risiko'].$this->input->post('versi'), 'file_modul')) {
          $this->db->trans_rollback();
          $url = base_url() . 'create-modul-faktor-risiko/gagal_modul_faktor_risiko';
          header("Location: $url");
        } else {
          $this->db->trans_commit();
          $url = base_url() . 'modul-faktor-risiko/sukses_modul_faktor_risiko';
          header("Location: $url");
        }
      }
    }
  }

  /**
   * SIKP-PF-186
   * @param  [type] $alert_flag [description]
   * @return [type]             [description]
   */
  public function create_modul_faktor_pemicu($alert_flag = NULL)
  {
    // checking passed arguments
    if ( ! empty($alert_flag)) {
      $this->alert_vars = $this->load->view("alert_template/data_master/modul_kesehatan/$alert_flag", '', TRUE);
    }

    // parsing template
    $this->template = $this->load->view('data_master/modul_kesehatan/add/modul_faktor_pemicu', '', TRUE);
    $this->template_data = array(
      'alert_vars' => $this->alert_vars,
      );
      
    // parsing view
    $css_framework = $this->load->view('css_framework/head_form', '', TRUE);
    $page_content = $this->parser->parse_string($this->template, $this->template_data, TRUE);
    $js_framework = $this->load->view('js_framework/js_form', '', TRUE);

    $this->parse_view('Data Wilayah Adminstratif', $css_framework, $page_content, $js_framework);
  }

  /**
   * SIKP-PF-187
   * @return [type] [description]
   */
  public function store_modul_faktor_pemicu()
  {
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>');
    if ($this->form_validation->run() == FALSE) {
      $this->create_modul_faktor_pemicu('gagal_form_invalid');
    } else {
      // init var - local
      $modul_faktor_pemicu = array();

      // repopulating and storing data
      $this->db->trans_begin();
      foreach ($this->input->post() as $key => $value) {
        if ($this->input->post('perbarui') !== '1') {
          $modul_faktor_pemicu['id_mod_faktor_pemicu'] = $this->id_generator('MFP');
        }
        $modul_faktor_pemicu[$key] = $value;
      }
      // unset update flag
      unset($modul_faktor_pemicu['perbarui']);
      $this->M_faktor_pemicu->store($modul_faktor_pemicu);
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $url = base_url() . 'create-modul-faktor-pemicu/gagal_modul_faktor_pemicu';
        header("Location: $url");
      } else {
        // upload file
        if ( ! $this->do_upload('faktor_pemicu', $modul_faktor_pemicu['id_mod_faktor_pemicu'].$this->input->post('versi'), 'file_modul')) {
          $this->db->trans_rollback();
          $url = base_url() . 'create-modul-faktor-pemicu/gagal_modul_faktor_pemicu';
          header("Location: $url");
        } else {
          $this->db->trans_commit();
          $url = base_url() . 'modul-faktor-pemicu/sukses_modul_faktor_pemicu';
          header("Location: $url");
        }
      }
    }
  }

  /**
   * SIKP-PF-188
   * @param  [type] $tipe_modul [description]
   * @param  [type] $file_name  [description]
   * @param  [type] $input_name [description]
   * @return [type]             [description]
   */
  public function do_upload($tipe_modul, $file_name, $input_name)
  {
    // init var - local
    $ret_val = NULL;

    // initializing directory
    if ($tipe_modul == 'penyakit') {
      $config['upload_path'] = './mod_files/modul_penyakit/';
    } elseif ($tipe_modul == 'faktor_risiko') {
      $config['upload_path'] = './mod_files/modul_faktor_risiko/';
    } elseif ($tipe_modul == 'faktor_pemicu') {
      $config['upload_path'] = './mod_files/modul_faktor_pemicu/';
    }
    
    // config
    $config['overwrite'] = TRUE;
    $config['allowed_types'] = 'pdf';
    $config['max_size'] = 3072000000000;
    $config['file_name'] = $file_name;
    $config['max_filename'] = 0;

    $this->upload->initialize($config);

    // uploading file
    if ( ! $this->upload->do_upload($input_name)) {
      $error = array('error' => $this->upload->display_errors());
      $ret_val = FALSE;
    } else {
      $data = array('upload_data' => $this->upload->data());
      $ret_val = TRUE;
    }

    return $ret_val;
  }

  /////////////
  // DESTROY //
  /////////////
  /**
   * SIKP-PF-189
   * @param  [type] $id_mod_penyakit [description]
   * @return [type]                  [description]
   */
  public function destroy_modul_penyakit($id_mod_penyakit)
  {
    // init var - local
    $pieces = explode('z', $id_mod_penyakit);
    $filepath = FCPATH . 'mod_files\\' . 'modul_penyakit\\' . $pieces[0] . $pieces[1] . '.pdf';

    // storing data
    $this->db->trans_begin();
    $this->M_penyakit->destroy($pieces[0], $pieces[1]);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'modul-penyakit/gagal_hapus_modul_penyakit';
      header("Location: $url");
    } else {
      // $this->db->trans_rollback();
      $this->db->trans_commit();
      unlink($filepath);
      $url = base_url() . 'modul-penyakit/sukses_hapus_modul_penyakit';
      header("Location: $url");
    }
  }

  /**
   * SIKP-PF-190
   * @param  [type] $id_mod_faktor_risiko [description]
   * @return [type]                       [description]
   */
  public function destroy_modul_faktor_risiko($id_mod_faktor_risiko)
  {
    // init var - local
    $pieces = explode('z', $id_mod_faktor_risiko);
    $filepath = FCPATH . 'mod_files\\' . 'modul_faktor_risiko\\' . $pieces[0] . $pieces[1] . '.pdf';

    // storing data
    $this->db->trans_begin();
    $this->M_faktor_risiko->destroy($pieces[0], $pieces[1]);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'modul-faktor-risiko/gagal_hapus_modul_faktor_risiko';
      header("Location: $url");
    } else {
      // $this->db->trans_rollback();
      $this->db->trans_commit();
      unlink($filepath);
      $url = base_url() . 'modul-faktor-risiko/sukses_hapus_modul_faktor_risiko';
      header("Location: $url");
    }
  }

  /**
   * SIKP-PF-191
   * @param  [type] $id_mod_faktor_pemicu [description]
   * @return [type]                       [description]
   */
  public function destroy_modul_faktor_pemicu($id_mod_faktor_pemicu)
  {
    // init var - local
    $pieces = explode('z', $id_mod_faktor_pemicu);
    $filepath = FCPATH . 'mod_files\\' . 'modul_faktor_pemicu\\' . $pieces[0] . $pieces[1] . '.pdf';

    // storing data
    $this->db->trans_begin();
    $this->M_faktor_pemicu->destroy($pieces[0], $pieces[1]);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $url = base_url() . 'modul-faktor-pemicu/gagal_hapus_modul_faktor_pemicu';
      header("Location: $url");
    } else {
      // $this->db->trans_rollback();
      $this->db->trans_commit();
      unlink($filepath);
      $url = base_url() . 'modul-faktor-pemicu/sukses_hapus_modul_faktor_pemicu';
      header("Location: $url");
    }
  }

}