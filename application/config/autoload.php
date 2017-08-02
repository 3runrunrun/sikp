<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework as light-weight as possible only the
| absolute minimal resources are loaded by default. For example,
| the database is not connected to automatically since no assumption
| is made regarding whether you intend to use it.  This file lets
| you globally define which systems you would like loaded with every
| request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
| 1. Packages
| 2. Libraries
| 3. Drivers
| 4. Helper files
| 5. Custom config files
| 6. Language files
| 7. Models
|
*/

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
*/
$autoload['packages'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in system/libraries/ or your
| application/libraries/ directory, with the addition of the
| 'database' library, which is somewhat of a special case.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an alternative library name to be assigned
| in the controller:
|
|	$autoload['libraries'] = array('user_agent' => 'ua');
*/
$autoload['libraries'] = array(
  'sikp_error_handling' => 'eh', // sikp library
  'database',
  'form_validation',
  'parser',
  'session',
  'unit_test',
  'user_agent'
  );

/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These classes are located in system/libraries/ or in your
| application/libraries/ directory, but are also placed inside their
| own subdirectory and they extend the CI_Driver_Library class. They
| offer multiple interchangeable driver options.
|
| Prototype:
|
|	$autoload['drivers'] = array('cache');
|
| You can also supply an alternative property name to be assigned in
| the controller:
|
|	$autoload['drivers'] = array('cache' => 'cch');
|
*/
$autoload['drivers'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/
$autoload['helper'] = array(
  'url',
  'form'
  );

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('first_model', 'second_model');
|
| You can also supply an alternative model name to be assigned
| in the controller:
|
|	$autoload['model'] = array('first_model' => 'first');
*/
$autoload['model'] = array(
  // SYSTEM
  'M_provinsi',
  'M_kabupaten',
  'M_kecamatan',
  'M_kelurahan',
  // MODUL ANDAL
  'modul_andal/M_faktor_pemicu',
  'modul_andal/M_faktor_risiko',
  'modul_andal/M_penyakit',
  // OBAT
  'obat/M_obat',
  'obat/M_obat_keluar',
  // PASIEN
  'pasien/M_kk',
  'pasien/M_pasien_identitas',
  'pasien/M_riwayat_pekerjaan',
  // PEGAWAI
  'pegawai/M_pegawai',
  'pegawai/M_staf_administrasi',
  'pegawai/M_tenaga_kefarmasian',
  'pegawai/M_tenaga_medis',
  'pegawai/M_tenaga_paramedis',
  // PEMERIKSAAN HOLISTIK
  'pemeriksaan_holistik/M_cek_darah',
  'pemeriksaan_holistik/M_diagnosis_penyakit',
  'pemeriksaan_holistik/M_hol_faktor_pemicu',
  'pemeriksaan_holistik/M_hol_faktor_risiko',
  'pemeriksaan_holistik/M_keluhan',
  'pemeriksaan_holistik/M_resep_obat',
  'pemeriksaan_holistik/M_rujukan',
  'pemeriksaan_holistik/M_status',
  // RIWAYAT KESEHATAN KELUARGA
  'riwayat_kesehatan_keluarga/M_anggota_keluarga',
  'riwayat_kesehatan_keluarga/M_data_perkawinan',
  'riwayat_kesehatan_keluarga/M_ekonomi',
  'riwayat_kesehatan_keluarga/M_gejala_stres',
  'riwayat_kesehatan_keluarga/M_perilaku_kesehatan',
  'riwayat_kesehatan_keluarga/M_perilaku_keselamatan',
  'riwayat_kesehatan_keluarga/M_r_alkohol',
  'riwayat_kesehatan_keluarga/M_r_asma',
  'riwayat_kesehatan_keluarga/M_r_batuk',
  'riwayat_kesehatan_keluarga/M_r_jamu',
  'riwayat_kesehatan_keluarga/M_r_kecelakaan_kerja',
  'riwayat_kesehatan_keluarga/M_r_kes_keluarga',
  'riwayat_kesehatan_keluarga/M_r_kopi',
  'riwayat_kesehatan_keluarga/M_r_masalah_kes',
  'riwayat_kesehatan_keluarga/M_r_masalah_keturunan',
  'riwayat_kesehatan_keluarga/M_r_merokok',
  'riwayat_kesehatan_keluarga/M_r_obat',
  'riwayat_kesehatan_keluarga/M_r_olahraga',
  'riwayat_kesehatan_keluarga/M_r_sakit_keras',
  'riwayat_kesehatan_keluarga/M_r_satu_bulan',
  'riwayat_kesehatan_keluarga/M_r_satu_tahun',
  'riwayat_kesehatan_keluarga/M_r_tiga_bulan',
  );
