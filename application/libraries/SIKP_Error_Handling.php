<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class SIKP_Error_Handling
{

  private $error_code = NULL;
  private $msg = NULL;
  
  function __construct()
  {
  }

  public function empty_post ()
  {
    $msg = 'POST parameter(s) is empty.';
    return $msg;
  }

  public function empty_result()
  {
    $msg = 'Data yang anda cari belum tersedia.';
    return $msg;
  }

  public function db_error($error = NULL)
  {
    // $msg = $error['code'];
    $msg = $error['message'];
    return $msg;
  }

  public function db_msg($error = NULL)
  {
    switch ($error['code']) {
      case '1452':
        # code...
        break;
      
      default:
        # code...
        break;
    }
  }
}