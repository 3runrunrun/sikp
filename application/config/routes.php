<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['pendaftaran-pasien'] = 'C_sidebar/create_pendaftaran_pengobatan';
$route['simpan-pendaftaran-pasien'] = 'C_pendaftaran_pengobatan/store';

$route['daftar-pasien-terdaftar'] = 'C_sidebar/show_pasien_terdaftar';
$route['pengisian-anamnesis/(:any)'] = 'C_daftar_pasien/create_pengisian_anamnesis/$1';
$route['simpan-pengisian-anamnesis'] = 'C_pengisian_anamnesis/update_pengisian_anamnesis';

$route['pengisian-diagnosis/(:any)'] = 'C_daftar_pasien/create_pengisian_diagnosis/$1';
$route['simpan-pengisian-diagnosis'] = 'C_pengisian_diagnosis/store';
$route['pengubahan-diagnosis/(:any)'] = 'C_daftar_pasien/edit_pengisian_diagnosis/$1';
$route['simpan-pengisian-rujukan'] = 'C_pengisian_diagnosis/store_rujukan';
$route['simpan-pengantar-cek-darah'] = 'C_pengisian_diagnosis/store_cek_darah';

$route['lihat-data-dasar'] = 'C_sidebar/show_data_dasar';
$route['formulir-data-dasar'] = 'C_data_dasar/create';
$route['formulir-data-dasar/(:any)'] = 'C_data_dasar/create/';
$route['simpan-pasien-baru'] = 'C_data_dasar/store_identitas_pasien';
$route['simpan-data-perkawinan'] = 'C_data_dasar/store_data_perkawinan';
$route['simpan-anggota-keluarga'] = 'C_data_dasar/store_anggota_keluarga';
$route['simpan-ekonomi'] = 'C_data_dasar/store_ekonomi';
$route['simpan-perilaku'] = 'C_data_dasar/store_perilaku';
$route['simpan-riwayat-kes'] = 'C_data_dasar/store_riwayat_kes';
$route['simpan-gejala-stres'] = 'C_data_dasar/store_gejala_stres';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
