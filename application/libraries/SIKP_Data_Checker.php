<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class SIKP_Data_Checker
{
  private $list_view_data = array();
  
  function __construct()
  {
    $CI =& get_instance();
  }

  /**
   * check if view_data is empty
   * @param  array  $data $view_data
   * @return string       empty element name
   */
  public function empty_view_data($data = array())
  {
    foreach (array_keys($data) as $key => $value) {
      if (empty($data[$value]['data'])) {
        array_push($this->list_view_data, $value);
      }
    }
    
    return implode(", ", $this->list_view_data);
  }

  /**
   * check if data_tabel is empty
   * @param  array  $data $data_tabel
   * @return string       empty element name
   */
  public function empty_data_tabel($data = array())
  {
    foreach (array_keys($data) as $key => $value) {
      if (empty($data[$value])) {
        array_push($this->list_view_data, $value);
      }
    }
    
    return implode(", ", $this->list_view_data);
  }
}