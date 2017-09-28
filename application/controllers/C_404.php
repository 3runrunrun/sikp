<?php 

/**
* 
*/
class C_404 extends CI_Controller
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

  public function index()
  {
    $this->output->set_status_header('404');

    // parse view
    $page_content = $this->load->view('alert_template/halaman_tidak_ditemukan', '', TRUE);
    $css_framework = $this->load->view('css_framework/head_table', '', TRUE);
    $js_framework = $this->load->view('js_framework/js_datatables', '', TRUE);

    $this->parse_view('404 Not Found', $css_framework, $page_content, $js_framework);
  }

  
}