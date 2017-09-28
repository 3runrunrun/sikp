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
// PENGOBATAN HOLISTIK
$route['pasien-terdaftar-harian'] = 'pengobatan_holistik/C_pengobatan_holistik/show_terdaftar_harian';
$route['pasien-terdaftar-harian/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/show_terdaftar_harian/$1';
$route['pasien-anamnesis-harian'] = 'pengobatan_holistik/C_pengobatan_holistik/show_anamnesis_harian';
$route['pasien-anamnesis-harian/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/show_anamnesis_harian/$1';
$route['pasien-diagnosis-harian'] = 'pengobatan_holistik/C_pengobatan_holistik/show_diagnosis_harian';
$route['pasien-diagnosis-harian/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/show_diagnosis_harian/$1';
$route['riwayat-pengobatan'] = 'pengobatan_holistik/C_pengobatan_holistik/show_riwayat_pengobatan';
$route['riwayat-pengobatan/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/show_riwayat_pengobatan/$1';
$route['detail-pengobatan/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/detail_riwayat_pengobatan/$1/$2';
$route['destroy-riwayat-pengobatan/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/destroy_riwayat_pengobatan/$1/$2';

$route['pendaftaran-pasien'] = 'pengobatan_holistik/C_pengobatan_holistik/create';
$route['pendaftaran-pasien/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/create/$1';
$route['pendaftaran-pasien/(:any)/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/create/$1/$2/$3';
$route['simpan-pendaftaran-pasien'] = 'pengobatan_holistik/C_pengobatan_holistik/store_pendaftaran_pengobatan';

$route['formulir-anamnesis/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/create_anamnesis/$1/$2';
$route['formulir-anamnesis/(:any)/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/create_anamnesis/$1/$2/$3';
$route['simpan-anamnesis'] = 'pengobatan_holistik/C_pengobatan_holistik/store_anamnesis';
$route['destroy-anamnesis/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/destroy_anamnesis/$1/$2';

$route['formulir-diagnosis/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/create_diagnosis/$1/$2';
$route['formulir-diagnosis/(:any)/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/create_diagnosis/$1/$2/$3';
$route['simpan-diagnosis'] = 'pengobatan_holistik/C_pengobatan_holistik/store_diagnosis';
$route['destroy-diagnosis/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/destroy_diagnosis/$1/$2';

$route['formulir-intervensi/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/create_intervensi/$1/$2';
$route['formulir-intervensi/(:any)/(:any)/(:any)'] = 'pengobatan_holistik/C_pengobatan_holistik/create_intervensi/$1/$2/$3';
$route['simpan-intervensi'] = 'pengobatan_holistik/C_pengobatan_holistik/store_intervensi';

// PENGELOLAAN OBAT
$route['formulir-obat-baru'] = 'pengelolaan_obat/C_pencatatan_obat_baru/create';
$route['formulir-obat-baru/(:any)'] = 'pengelolaan_obat/C_pencatatan_obat_baru/create/$1';
$route['simpan-pencatatan-obat-baru'] = 'pengelolaan_obat/C_pencatatan_obat_baru/store';
$route['data-obat'] = 'pengelolaan_obat/C_pencatatan_obat_baru/get_data';
$route['data-obat/(:any)'] = 'pengelolaan_obat/C_pencatatan_obat_baru/get_data/$1';
$route['delete-obat/(:any)'] = 'pengelolaan_obat/C_pencatatan_obat_baru/destroy/$1';

$route['formulir-pencatatan-obat-masuk'] = 'pengelolaan_obat/C_pencatatan_obat_masuk/create';
$route['formulir-pencatatan-obat-masuk/(:any)'] = 'pengelolaan_obat/C_pencatatan_obat_masuk/create/$1';
$route['simpan-pencatatan-obat-masuk'] = 'pengelolaan_obat/C_pencatatan_obat_masuk/store';
$route['data-obat-masuk'] = 'pengelolaan_obat/C_pencatatan_obat_masuk/get_data';
$route['data-obat-masuk/(:any)'] = 'pengelolaan_obat/C_pencatatan_obat_masuk/get_data/$1';
$route['delete-obat-masuk/(:any)'] = 'pengelolaan_obat/C_pencatatan_obat_masuk/destroy/$1';

$route['formulir-pencatatan-obat-keluar'] = 'pengelolaan_obat/C_pencatatan_obat_keluar/create';
$route['formulir-pencatatan-obat-keluar/(:any)'] = 'pengelolaan_obat/C_pencatatan_obat_keluar/create/$1';
$route['simpan-pencatatan-obat-keluar'] = 'pengelolaan_obat/C_pencatatan_obat_keluar/store';
$route['data-obat-keluar'] = 'pengelolaan_obat/C_pencatatan_obat_keluar/get_data';
$route['data-obat-keluar/(:any)'] = 'pengelolaan_obat/C_pencatatan_obat_keluar/get_data/$1';

$route['cetak-laporan-obat-keluar'] = 'pengelolaan_obat/C_pencatatan_obat_keluar/cetak_laporan_obat_keluar';

// DATA PASIEN
$route['lihat-data-pasien-bpjs'] = 'pasien_poliklinik/C_pasien_poliklinik/show_data_pasien_bpjs';
$route['detail-pasien-bpjs/(:any)'] = 'pasien_poliklinik/C_pasien_poliklinik/detail_pasien_bpjs/$1';

$route['formulir-pasien-bpjs'] = 'pasien_poliklinik/C_pasien_poliklinik/create';
$route['formulir-pasien-bpjs/(:any)'] = 'pasien_poliklinik/C_pasien_poliklinik/create/$1';
$route['simpan-pasien-bpjs'] = 'pasien_poliklinik/C_pasien_poliklinik/store_identitas_pasien';
$route['simpan-pekerjaan-pasien-bpjs'] = 'pasien_poliklinik/C_pasien_poliklinik/store_riwayat_pekerjaan';

// DATA DASAR
$route['lihat-data-dasar'] = 'data_dasar/C_data_dasar/show_data_dasar';
$route['detail-data-dasar/(:any)'] = 'data_dasar/C_data_dasar/detail_data_dasar/home/$1';
$route['detail-data-dasar/(:any)/(:any)'] = 'data_dasar/C_data_dasar/detail_data_dasar/$1/$2';
$route['riwayat-data-dasar/(:any)'] = 'data_dasar/C_data_dasar/riwayat_kes_kel_stres/$1';
$route['riwayat-data-dasar/(:any)/(:any)'] = 'data_dasar/C_data_dasar/riwayat_kes_kel_stres/$1/$2';

$route['edit-identitas-pasien/(:any)/(:any)'] = 'data_dasar/C_data_dasar/edit_identitas_pasien/home/$1/$2';
$route['edit-identitas-pasien/(:any)/(:any)/(:any)'] = 'data_dasar/C_data_dasar/edit_identitas_pasien/$1/$2/$3';
$route['update-identitas-pasien'] = 'data_dasar/C_data_dasar/update_identitas_pasien';

$route['edit-ekonomi/(:any)'] = 'data_dasar/C_data_dasar/edit_ekonomi/home/$1/';
$route['edit-ekonomi/(:any)/(:any)'] = 'data_dasar/C_data_dasar/edit_ekonomi/$1/$2';
$route['update-ekonomi'] = 'data_dasar/C_data_dasar/update_ekonomi';

$route['add-ekonomi/(:any)'] = 'data_dasar/C_data_dasar/add_ekonomi/home/$1/';
$route['add-ekonomi/(:any)/(:any)'] = 'data_dasar/C_data_dasar/add_ekonomi/$1/$2';

$route['add-perilaku/(:any)'] = 'data_dasar/C_data_dasar/add_perilaku/home/$1/';
$route['add-perilaku/(:any)/(:any)'] = 'data_dasar/C_data_dasar/add_perilaku/$1/$2';

$route['add-riwayat-kes-kel/(:any)'] = 'data_dasar/C_data_dasar/add_riwayat_kes_kel/home/$1/';
$route['add-riwayat-kes-kel/(:any)/(:any)'] = 'data_dasar/C_data_dasar/add_riwayat_kes_kel/$1/$2';

$route['edit-perkawinan/(:any)'] = 'data_dasar/C_data_dasar/edit_perkawinan/home/$1/';
$route['edit-perkawinan/(:any)/(:any)'] = 'data_dasar/C_data_dasar/edit_perkawinan/$1/$2';
$route['update-perkawinan'] = 'data_dasar/C_data_dasar/update_perkawinan';
$route['update-anggota-keluarga'] = 'data_dasar/C_data_dasar/update_anggota_keluarga';
$route['destroy-anggota-keluarga/(:any)/(:any)'] = 'data_dasar/C_data_dasar/destroy_anggota_keluarga/$1/$2';

$route['destroy-perilaku/(:any)/(:any)'] = 'data_dasar/C_data_dasar/destroy_perilaku_kes_kel/$1/$2';
$route['destroy-perilaku/(:any)/(:any)/(:any)'] = 'data_dasar/C_data_dasar/destroy_perilaku_kes_kel/$1/$2/$3';

$route['destroy-riwayat-kes-kel/(:any)/(:any)'] = 'data_dasar/C_data_dasar/destroy_riwayat_kes_kel/$1/$2';
$route['destroy-gejala-stres/(:any)/(:any)'] = 'data_dasar/C_data_dasar/destroy_gejala_stres/$1/$2';

$route['formulir-data-dasar'] = 'data_dasar/C_data_dasar/create';
$route['formulir-data-dasar/(:any)'] = 'data_dasar/C_data_dasar/create/home/$1';
$route['formulir-data-dasar/(:any)/(:any)'] = 'data_dasar/C_data_dasar/create/$1/$2';
$route['simpan-pasien-baru'] = 'data_dasar/C_data_dasar/store_identitas_pasien';
$route['simpan-riwayat-pekerjaan'] = 'data_dasar/C_data_dasar/store_riwayat_pekerjaan';
$route['simpan-data-perkawinan'] = 'data_dasar/C_data_dasar/store_data_perkawinan';
$route['simpan-anggota-keluarga'] = 'data_dasar/C_data_dasar/store_anggota_keluarga';
$route['simpan-ekonomi'] = 'data_dasar/C_data_dasar/store_ekonomi';
$route['simpan-perilaku'] = 'data_dasar/C_data_dasar/store_perilaku';
$route['simpan-riwayat-kes'] = 'data_dasar/C_data_dasar/store_riwayat_kes';
$route['simpan-gejala-stres'] = 'data_dasar/C_data_dasar/store_gejala_stres';

// DATA MASTER -- WILAYAH ADMINISTRATIF
$route['provinsi'] = 'data_master/C_wilayah_administratif/show_provinsi';
$route['provinsi/(:any)'] = 'data_master/C_wilayah_administratif/show_provinsi/$1';
$route['kabupaten'] = 'data_master/C_wilayah_administratif/show_kabupaten';
$route['kabupaten/(:any)'] = 'data_master/C_wilayah_administratif/show_kabupaten/$1';
$route['kecamatan'] = 'data_master/C_wilayah_administratif/show_kecamatan';
$route['kecamatan/(:any)'] = 'data_master/C_wilayah_administratif/show_kecamatan/$1';
$route['kelurahan'] = 'data_master/C_wilayah_administratif/show_kelurahan';
$route['kelurahan/(:any)'] = 'data_master/C_wilayah_administratif/show_kelurahan/$1';

$route['create-provinsi'] = 'data_master/C_wilayah_administratif/create_provinsi';
$route['create-provinsi/(:any)'] = 'data_master/C_wilayah_administratif/create_provinsi/$1';
$route['store-provinsi'] = 'data_master/C_wilayah_administratif/store_provinsi';
$route['destroy-provinsi/(:any)'] = 'data_master/C_wilayah_administratif/destroy_provinsi/$1';

$route['create-kabupaten'] = 'data_master/C_wilayah_administratif/create_kabupaten';
$route['create-kabupaten/(:any)'] = 'data_master/C_wilayah_administratif/create_kabupaten/$1';
$route['store-kabupaten'] = 'data_master/C_wilayah_administratif/store_kabupaten';
$route['destroy-kabupaten/(:any)'] = 'data_master/C_wilayah_administratif/destroy_kabupaten/$1';

$route['create-kecamatan'] = 'data_master/C_wilayah_administratif/create_kecamatan';
$route['create-kecamatan/(:any)'] = 'data_master/C_wilayah_administratif/create_kecamatan/$1';
$route['store-kecamatan'] = 'data_master/C_wilayah_administratif/store_kecamatan';
$route['destroy-kecamatan/(:any)'] = 'data_master/C_wilayah_administratif/destroy_kecamatan/$1';

$route['create-kelurahan'] = 'data_master/C_wilayah_administratif/create_kelurahan';
$route['create-kelurahan/(:any)'] = 'data_master/C_wilayah_administratif/create_kelurahan/$1';
$route['store-kelurahan'] = 'data_master/C_wilayah_administratif/store_kelurahan';
$route['destroy-kelurahan/(:any)'] = 'data_master/C_wilayah_administratif/destroy_kelurahan/$1';

// DATA MASTER - DATA MODUL
$route['modul-penyakit'] = 'data_master/C_modul_kesehatan/show_modul_penyakit';
$route['modul-penyakit/(:any)'] = 'data_master/C_modul_kesehatan/show_modul_penyakit/$1';
$route['modul-faktor-risiko'] = 'data_master/C_modul_kesehatan/show_modul_faktor_risiko';
$route['modul-faktor-risiko/(:any)'] = 'data_master/C_modul_kesehatan/show_modul_faktor_risiko/$1';
$route['modul-faktor-pemicu'] = 'data_master/C_modul_kesehatan/show_modul_faktor_pemicu';
$route['modul-faktor-pemicu/(:any)'] = 'data_master/C_modul_kesehatan/show_modul_faktor_pemicu/$1';

$route['create-modul-penyakit'] = 'data_master/C_modul_kesehatan/create_modul_penyakit';
$route['create-modul-penyakit/(:any)'] = 'data_master/C_modul_kesehatan/create_modul_penyakit/$1';
$route['store-modul-penyakit'] = 'data_master/C_modul_kesehatan/store_modul_penyakit';
$route['destroy-modul-penyakit/(:any)'] = 'data_master/C_modul_kesehatan/destroy_modul_penyakit/$1';

$route['create-modul-faktor-risiko'] = 'data_master/C_modul_kesehatan/create_modul_faktor_risiko';
$route['create-modul-faktor-risiko/(:any)'] = 'data_master/C_modul_kesehatan/create_modul_faktor_risiko/$1';
$route['store-modul-faktor-risiko'] = 'data_master/C_modul_kesehatan/store_modul_faktor_risiko';
$route['destroy-modul-faktor-risiko/(:any)'] = 'data_master/C_modul_kesehatan/destroy_modul_faktor_risiko/$1';

$route['create-modul-faktor-pemicu'] = 'data_master/C_modul_kesehatan/create_modul_faktor_pemicu';
$route['create-modul-faktor-pemicu/(:any)'] = 'data_master/C_modul_kesehatan/create_modul_faktor_pemicu/$1';
$route['store-modul-faktor-pemicu'] = 'data_master/C_modul_kesehatan/store_modul_faktor_pemicu';
$route['destroy-modul-faktor-pemicu/(:any)'] = 'data_master/C_modul_kesehatan/destroy_modul_faktor_pemicu/$1';

// LOGIN
$route['logout'] = 'C_home/logout';
$route['login'] = 'C_home';
$route['login/(:any)'] = 'C_home/login/$1';
$route['auth'] = 'C_home/do_login';

$route['default_controller'] = 'C_home';
$route['404_override'] = 'C_404';
$route['mypdf'] = 'Welcome/pdf_generator';
$route['translate_uri_dashes'] = FALSE;