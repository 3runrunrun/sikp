<?php
$config = array(
  // DATA DASAR -- IDENTITAS PASIEN
  'C_data_dasar/store_identitas_pasien' => array(
    array(
      'field' => 'no_bpjs',
      'label' => 'Nomor BPJS',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi sesuai dengan %s yang benar'
        ),
      ),
    array(
      'field' => 'nama',
      'label' => 'Nama Pasien',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'jenis_kelamin',
      'label' => 'Jenis Kelamin Pasien',
      'rules' => 'required|in_list[p,l]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang benar'
        ),
      ),
    array(
      'field' => 'tgl_lahir',
      'label' => 'Tanggal Lahir Pasien',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'pekerjaan_utama',
      'label' => 'Pekerjaan Utama',
      'rules' => 'required|alpha',
      'errors' => array(
        'required' => '%s harus diisi',
        'alpha' => 'Isi sesuai dengan %s yang benar'
        ),
      ),
    array(
      'field' => 'pekerjaan_sampingan',
      'label' => 'Pekerjaan Sampingan',
      'rules' => 'alpha',
      'errors' => array(
        'alpha' => 'Isi sesuai dengan %s yang benar'
        ),
      ),
    array(
      'field' => 'suku_bangsa',
      'label' => 'Suku Bangsa',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'pendidikan_terakhir',
      'label' => 'Pendidikan Terakhir',
      'rules' => 'required|in_list[sd,smp,sma,sarjana,magister,doktor,diploma]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan'
        ),
      ),
    array(
      'field' => 'kelas_bpjs',
      'label' => 'Kelas BPJS',
      'rules' => 'required|in_list[1,2,3]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan'
        ),
      ),
    array(
      'field' => 'status_tagihan_bpjs',
      'label' => 'Status Tagihan BPJS',
      'rules' => 'in_list[0,1]',
      'errors' => array(
        'in_list' => 'Isi %s sesuai dengan data yang disediakan'
        ),
      ),
    array(
      'field' => 'agama',
      'label' => 'Agama',
      'rules' => 'in_list[budha,hindu,islam,kristen,katolik]',
      'errors' => array(
        'in_list' => 'Isi %s sesuai dengan data yang disediakan'
        ),
      ),
    array(
      'field' => 'id_provinsi',
      'label' => 'Provinsi',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'id_kabupaten',
      'label' => 'Kabupaten',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'id_kecamatan',
      'label' => 'Kecamatan',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'id_kelurahan',
      'label' => 'Kelurahan',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'alamat',
      'label' => 'Alamat',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'hidup',
      'label' => 'Kondisi Pasien',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan'
        ),
      ),
    ),
  // DATA DASAR -- DATA PERKAWINAN
  'C_data_dasar/store_data_perkawinan' => array(
    array(
      'field' => 'psg_no_bpjs[]',
      'label' => 'Kepala Keluarga',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'psg_hubungan_keluarga[]',
      'label' => 'Hubungan Keluarga',
      'rules' => 'required|in_list[1,2,3,4]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'psg_domisili_serumah[]',
      'label' => 'Keterangan Domisili',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'psg_no_telp',
      'label' => 'Nomor Telepon',
      'rules' => 'required|numeric|min_length[10]|max_length[12]',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Masukkan %s dengan benar',
        'min_length' => '%s tidak kurang dari 10 digit',
        'max_length' => '%s tidak lebih dari 12 digit'
        ),
      ),
    array(
      'field' => 'psg_status_kawin[]',
      'label' => 'Status Perkawinan',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'psg_perkawinan_ke[]',
      'label' => 'Jumlah Perkawinan',
      'rules' => 'required|greater_than_equal_to[0]',
      'errors' => array(
        'required' => '%s harus diisi',
        'greater_than_equal_to' => 'Isi %s dengan angka dan tidak kurang dari 0',
        ),
      ),
    array(
      'field' => 'psg_umur_pasangan[]',
      'label' => 'Umur Pasangan Ketika menikah',
      'rules' => 'required|greater_than_equal_to[0]',
      'errors' => array(
        'required' => '%s harus diisi',
        'greater_than_equal_to' => 'Isi %s dengan angka dan tidak kurang dari 0',
        ),
      ),
    ),
  // DATA DASAR -- DATA ANGGOTA KELUARGA
  'C_data_dasar/store_anggota_keluarga' => array(
    array(
      'field' => 'id_kk',
      'label' => 'ID Kepala Keluarga',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s tidak tertera'
        ),
      ),
    array(
      'field' => 'ak_no_bpjs[]',
      'label' => 'Kepala Keluarga',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'ak_hubungan_keluarga[]',
      'label' => 'Hubungan Keluarga',
      'rules' => 'required|in_list[1,2,3,4]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'ak_domisili_serumah[]',
      'label' => 'Keterangan Domisili',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    ),
  // DATA DASAR -- DATA EKONOMI
  'C_data_dasar/store_ekonomi' => array(
    array(
      'field' => 'id_kk',
      'label' => 'ID Kepala Keluarga',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s tidak tertera'
        ),
      ),
    array(
      'field' => 'luas_bangunan',
      'label' => 'Luas Bangunan',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi %s dengan angka',
        ),
      ),
    array(
      'field' => 'luas_lahan',
      'label' => 'Luas Bangunan',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi %s dengan angka',
        ),
      ),
    array(
      'field' => 'kepemilikan_rumah',
      'label' => 'Luas Bangunan',
      'rules' => 'required|in_list[1,2,3,4]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'daya_listrik',
      'label' => 'Luas Bangunan',
      'rules' => 'required|in_list[450,900,1300,2000]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'sumber_ekonomi',
      'label' => 'Luas Bangunan',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'penopang_ekonomi',
      'label' => 'Luas Bangunan',
      'rules' => 'required|in_list[1,2,3,4]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    ),
  // DATA DASAR -- DATA PERILAKU KESEHATAN KELUARGA
  'C_data_dasar/store_perilaku' => array(
    array(
      'field' => 'id_kk',
      'label' => 'ID Kepala Keluarga',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s tidak tertera'
        ),
      ),
    array(
      'field' => 'layanan_balita',
      'rules' => 'required|in_list[1,2,3,4,5]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'pemeliharaan_kes_kel',
      'rules' => 'required|in_list[1,2,3,4,5]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'layanan_pengobatan_diri',
      'rules' => 'required|in_list[0,1,2,3]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'jamkes_pri_kel',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'sumber_air',
      'rules' => 'required|in_list[1,2,3,4,5]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'sumber_air_lain',
      'rules' => 'alpha',
      'errors' => array(
        'alpha' => 'Isi dengan data yang benar'
        )
      ),
    array(
      'field' => 'mck_km',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'mck_wc',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'mck_cuci',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'spal',
      'rules' => 'required|in_list[terbuka,tertutup]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'kasur_busa',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'kosmetik_obat_luar',
      'rules' => 'required|in_list[0,1,2,3,4]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'pengguna_sepeda_motor',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'manula_sendirian',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    ),
  // DATA DASAR -- DATA RIWAYAT KESEHATAN KELUARGA
  'C_data_dasar/store_riwayat_kes' => array(
    array(
      'field' => 'id_kk',
      'label' => 'ID Kepala Keluarga',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s tidak tertera'
        ),
      ),
    array(
      'field' => 'sb_no_bpjs[]',
      'label' => 'Anggota Keluarga',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'sb_jenis_penyakit[]',
      'label' => 'Jenis Penyakit',
      'rules' => 'regex_match[/([A-Z ,])/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'tb_no_bpjs[]',
      'label' => 'Anggota Keluarga',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'tb_jenis_penyakit[]',
      'label' => 'Jenis Penyakit',
      'rules' => 'regex_match[/([A-Z ,])/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'st_no_bpjs[]',
      'label' => 'Anggota Keluarga',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'st_jenis_penyakit[]',
      'label' => 'Jenis Penyakit',
      'rules' => 'regex_match[/([A-Z ,])/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'batuk',
      'label' => 'Riwayat Batuk',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'batuk_no_bpjs[]',
      'label' => 'Anggota Keluarga',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'asma',
      'label' => 'Riwayat Asma',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'asma_no_bpjs[]',
      'label' => 'Anggota Keluarga',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'masalah_kesehatan',
      'label' => 'Riwayat Masalah Kesehatan',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'maskes_no_bpjs[]',
      'label' => 'Anggota Keluarga',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'masalah_kes[]',
      'label' => 'Riwayat Masalah Kesehatan',
      'rules' => 'regex_match[/([A-Z ,])/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'masalah_keturunan',
      'label' => 'Riwayat Masalah Keturunan',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'masket_no_bpjs[]',
      'label' => 'Anggota Keluarga',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'jenis_masalah_keturunan[]',
      'label' => 'Riwayat Masalah Keturunan',
      'rules' => 'in_list[1,2,3,4]',
      'errors' => array(
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'sakit_keras',
      'label' => 'Riwayat Sakit Keras',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'jenis_sakit_keras[]',
      'label' => 'Riwayat Penyakit',
      'rules' => 'regex_match[/([A-Z ,])/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'tahun_sakit[]',
      'label' => 'Tahun Sakit',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'kecelakaan_kerja',
      'label' => 'Riwayat Kecelakaan Kerja',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'jenis_kecelakaan_kerja[]',
      'label' => 'Jenis Kecelakaan Kerja',
      'rules' => 'regex_match[/([A-Z ,])/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'tahun_kejadian[]',
      'label' => 'Tahun Terjadi Kecelakaan',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'jenis_kelainan[]',
      'label' => 'Riwayat Jenis Kelainan',
      'rules' => 'regex_match[/([A-Z ,])/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'durasi_perawatan[]',
      'label' => 'Durasi Perawatan Pasca Kecelakaan Kerja',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'merokok',
      'label' => 'Riwayat Merokok',
      'rules' => 'required|in_list[0,1,2,3]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'durasi_merokok',
      'label' => 'Durasi kebiasaan merokok',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'durasi_berhenti',
      'label' => 'Durasi berhenti merokok',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'batang_per_hari',
      'label' => 'Jumlah konsumsi rokok per hari',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'kretek_filter',
      'label' => 'Jenis rokok yang dikonsumsi',
      'rules' => 'in_list[kretek,filter]',
      'errors' => array(
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'jamu',
      'label' => 'Riwayat konsumsi jamu',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'jenis_jamu',
      'label' => 'Jenis jamu yang dikonsumsi',
      'rules' => 'regex_match[/([A-Z ,])/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'jamu_per_minggu',
      'label' => 'Jumlah konsumsi jamu setiap minggu',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'alkohol',
      'label' => 'Riwayat konsumsi alkohol',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'durasi',
      'label' => 'Lama konsumsi alkohol',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'kopi',
      'label' => 'Riwayat konsumsi alkohol',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'gelas_per_hari',
      'label' => 'Jumlah konsumsi kopi setiap hari',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'obat',
      'label' => 'Riwayat konsumsi obat-obatan',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'jenis_obat[]',
      'label' => 'Jenis obat yang dikonsumsi',
      'rules' => 'regex_match[/([A-Z ,])/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'm_dingin',
      'label' => 'Riwayat konsumsi minuman dingin',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'peliharaan',
      'label' => 'Kepemilikan hewan peliharaan',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'olahraga',
      'label' => 'Riwayat rutinitas olahraga',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'jenis_olahraga[]',
      'label' => 'Jenis olahraga',
      'rules' => 'alpha',
      'errors' => array(
        'alpha' => 'Isi %s dengan karakter alfabet, tanpa spasi',
        )
      ),
    array(
      'field' => 'jumlah_per_minggu[]',
      'label' => 'Jumlah olahraga yang dilakukan setiap minggu',
      'rules' => 'numeric',
      'errors' => array(
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'olahraga_keluarga[]',
      'label' => 'Olahraga keluarga',
      'rules' => 'in_list[0,1,2]',
      'errors' => array(
        'in_list' => 'Isi %s dengan data yang sudah disediakan',
        )
      ),
    ),
  // DATA DASAR -- DATA GEJALA STRESS
  'C_data_dasar/store_gejala_stres' => array(
    array(
      'field' => 'id_kk',
      'label' => 'ID Kepala Keluarga',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s tidak tertera'
        ),
      ),
    array(
      'field' => 'no_01',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_02',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_03',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_04',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_05',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_06',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_07',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_08',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_09',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_10',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_11',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_12',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_13',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_14',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_15',
      'rules' => 'in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    ),
  // PENGOBATAN HOLISTIK -- PENDAFTARAN PASIEN
  'C_pendaftaran_pengobatan/store' => array(
    array(
      'field' => 'no_bpjs',
      'label' => 'Data Pasien',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        )
      ),
    array(
      'field' => 'nik_tenaga_medis',
      'label' => 'Data Poli atau Dokter',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        )
      ),
    ),
  // PENGOBATAN HOLISTIK -- PENGISIAN ANAMNESIS
  'C_pengisian_anamnesis/update_pengisian_anamnesis' => array(
    array(
      'field' => 'id_registrasi',
      'label' => 'ID Registrasi',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Terdapat kesalahan dalam pengisian %s',
        )
      ),
    array(
      'field' => 'no_bpjs',
      'label' => 'Nomor BPJS',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Terdapat kesalahan dalam pengisian %s',
        )
      ),
    array(
      'field' => 'nik_tenaga_medis',
      'label' => 'Tenaga Medis',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Terdapat kesalahan dalam pengisian %s',
        )
      ),
    array(
      'field' => 'td',
      'label' => 'Tekanan Darah',
      'rules' => 'required|regex_match[/([0-9\/])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s harus diisi dengan angka dan "/" sebagai pemisah',
        )
      ),
    array(
      'field' => 'rr',
      'label' => 'RR',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        )
      ),
    array(
      'field' => 'nadi',
      'label' => 'Denyut Nadi',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => '%s harus diisi dengan angka',
        )
      ),
    array(
      'field' => 'suhu',
      'label' => 'Suhu Badan',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => '%s harus diisi dengan angka',
        )
      ),
    array(
      'field' => 'alergi_obat',
      'label' => 'Alergi Obat',
      'rules' => 'required|regex_match[/([A-Za-z -])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'alergi_makanan',
      'label' => 'Alergi Makanan',
      'rules' => 'required|regex_match[/([A-Za-z -])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => 'Isi %s dengan benar',
        )
      ),
    array(
      'field' => 'keluhan[]',
      'label' => 'Keluhan Pasien',
      'rules' => 'required|regex_match[/([A-Za-z -])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya bisa diisi dengan alfabet dan karakter "-"',
        )
      ),
    ),
  // PENGOBATAN HOLISTIK -- PENGISIAN DIAGNOSIS
  'C_pengisian_diagnosis/store' => array(
    array(
      'field' => 'penyakit[]',
      'label' => 'Penyakit',
      'rules' => 'required|regex_match[/([A-Za-z ])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan alfabet dan spasi'
        )
      ),
    array(
      'field' => 'id_mod_penyakit[]',
      'label' => 'Modul Penyakit',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        )
      ),
    array(
      'field' => 'terapi[]',
      'label' => 'Terapi',
      'rules' => 'required|regex_match[/([A-Za-z ])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan alfabet dan spasi'
        )
      ),
    array(
      'field' => 'lokasi_intervensi[]',
      'label' => 'Lokasi Intervensi atau Pengobatan',
      'rules' => 'required|in_list[1,2,3,4]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang sudah disediakan'
        )
      ),
    array(
      'field' => 'id_registrasi',
      'label' => 'ID Registrasi',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Terdapat kesalahan sistem dalam pengisian %s'
        )
      ),
    array(
      'field' => 'nik_tenaga_medis',
      'label' => 'Tenaga Medis',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Terdapat kesalahan sistem dalam pengisian %s'
        )
      ),
    array(
      'field' => 'no_bpjs',
      'label' => 'No. BPJS',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Terdapat kesalahan sistem dalam pengisian %s'
        )
      ),
    array(
      'field' => 'faktor_risiko[]',
      'label' => 'Faktor Risiko Penyakit',
      'rules' => 'required|regex_match[/([A-Za-z ])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan alfabet dan spasi'
        )
      ),
    array(
      'field' => 'faktor_pemicu[]',
      'label' => 'Faktor Pemicu Penyakit',
      'rules' => 'required|regex_match[/([A-Za-z ])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan alfabet dan spasi'
        )
      ),
    array(
      'field' => 'id_mod_faktor_risiko[]',
      'label' => 'Modul Risiko Penyakit',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        )
      ),
    array(
      'field' => 'id_mod_faktor_pemicu[]',
      'label' => 'Modul Pemicu Penyakit',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        )
      ),
    ),
  );















