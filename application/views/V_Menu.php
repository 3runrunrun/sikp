<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$tp = NULL;
switch ($tipe_pengguna) {
  case 'tm':
    $tp = "Tenaga Medis";
    break;

  case 'tp':
    $tp = "Tenaga Paramedis";
    break;

  case 'tk':
    $tp = "Tenaga Kefarmasian";
    break;

  case 'sa':
    $tp = "Staf Administrasi";
    break;
  
  default:
    # code...
    break;
}

echo "<h2>login $tp berhasil</h2>";
