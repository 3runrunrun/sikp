<?php
$config = array(
  // ARSIP POLIKLINIK -- IDENTITAS PASIEN
  'pasien_poliklinik/C_pasien_poliklinik/store_identitas_pasien' => array(
    array(
      'field' => 'no_bpjs',
      'label' => 'Nomor BPJS',
      'rules' => 'required|numeric|min_length[13]|max_length[13]',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi sesuai dengan %s yang benar',
        'min_length' => '%s harus diisi dengan 13 digit nomor BPJS',
        'max_length' => '%s harus diisi dengan 13 digit nomor BPJS',
        ),
      ),
    array(
      'field' => 'nama',
      'label' => 'Nama Pasien',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya boleh berisi karakter alfabet dan spasi',
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
      'field' => 'suku_bangsa',
      'label' => 'Suku Bangsa',
      'rules' => 'required|alpha',
      'errors' => array(
        'required' => '%s harus diisi',
        'alpha' => '%s hanya boleh berisi karakter alfabet',
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
      'rules' => 'required|regex_match[/([\w\s.,])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => 'Isi %s dengan benar'
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
  // ARSIP POLIKLINIK -- DATA RIWAYAT PEKERJAAN
  'pasien_poliklinik/C_pasien_poliklinik/store_riwayat_pekerjaan' => array(
    array(
      'field' => 'rp_no_bpjs[]',
      'label' => 'Nama Pasien',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'rp_pekerjaan[]',
      'label' => 'Pekerjaan',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya boleh diisi karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'rp_divisi[]',
      'label' => 'Divisi',
      'rules' => 'regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'regex_match' => '%s hanya boleh diisi karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'rp_sub_divisi[]',
      'label' => 'Sub Divisi',
      'rules' => 'regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'regex_match' => '%s hanya boleh diisi karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'rp_jenis_aktivitas[]',
      'label' => 'Jenis Aktivitas',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya boleh diisi karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'rp_intensitas_aktivitas[]',
      'label' => 'Intensitas Aktivitas',
      'rules' => 'required|in_list[1,2,3]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan nilai yang tersedia',
        ),
      ),
    array(
      'field' => 'rp_dari_tahun[]',
      'label' => 'Tahun Mulai Kerja',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi dengan angka',
        ),
      ),
    array(
      'field' => 'rp_pekerjaan_utama[]',
      'label' => 'Pekerjaan Utama',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'rp_sampai_tahun[]',
      'label' => 'Tahun Akhir Kerja',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi dengan angka',
        ),
      ),
    array(
      'field' => 'rp_pekerjaan_utama[]',
      'label' => 'Kategori pekerjaan',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan nilai yang disediakan',
        ),
      ),
    ),
  
  // DATA DASAR -- IDENTITAS PASIEN
  'data_dasar/C_data_dasar/store_identitas_pasien' => array(
    array(
      'field' => 'no_bpjs',
      'label' => 'Nomor BPJS',
      'rules' => 'required|numeric|min_length[13]|max_length[13]',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi sesuai dengan %s yang benar',
        'min_length' => '%s harus diisi dengan 13 digit nomor BPJS',
        'max_length' => '%s harus diisi dengan 13 digit nomor BPJS',
        ),
      ),
    array(
      'field' => 'nama',
      'label' => 'Nama Pasien',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya boleh berisi karakter alfabet dan spasi',
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
      'field' => 'suku_bangsa',
      'label' => 'Suku Bangsa',
      'rules' => 'required|alpha',
      'errors' => array(
        'required' => '%s harus diisi',
        'alpha' => '%s hanya boleh berisi karakter alfabet',
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
      'rules' => 'required|regex_match[/([\w\s.,])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => 'Isi %s dengan benar'
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
  // DATA DASAR -- DATA RIWAYAT PEKERJAAN
  'data_dasar/C_data_dasar/store_riwayat_pekerjaan' => array(
    array(
      'field' => 'rp_no_bpjs[]',
      'label' => 'Nama Pasien',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'rp_pekerjaan[]',
      'label' => 'Pekerjaan',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya boleh diisi karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'rp_divisi[]',
      'label' => 'Divisi',
      'rules' => 'regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'regex_match' => '%s hanya boleh diisi karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'rp_sub_divisi[]',
      'label' => 'Sub Divisi',
      'rules' => 'regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'regex_match' => '%s hanya boleh diisi karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'rp_jenis_aktivitas[]',
      'label' => 'Jenis Aktivitas',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya boleh diisi karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'rp_intensitas_aktivitas[]',
      'label' => 'Intensitas Aktivitas',
      'rules' => 'required|in_list[1,2,3]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan nilai yang tersedia',
        ),
      ),
    array(
      'field' => 'rp_dari_tahun[]',
      'label' => 'Tahun Mulai Kerja',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi dengan angka',
        ),
      ),
    array(
      'field' => 'rp_pekerjaan_utama[]',
      'label' => 'Pekerjaan Utama',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'rp_sampai_tahun[]',
      'label' => 'Tahun Akhir Kerja',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi dengan angka',
        ),
      ),
    array(
      'field' => 'rp_pekerjaan_utama[]',
      'label' => 'Kategori pekerjaan',
      'rules' => 'required|in_list[0,1,2]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan nilai yang disediakan',
        ),
      ),
    ),
  // DATA DASAR -- DATA PERKAWINAN
  'data_dasar/C_data_dasar/store_data_perkawinan' => array(
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
      'rules' => 'required|in_list[1,2]',
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
      'rules' => 'required|greater_than_equal_to[1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'greater_than_equal_to' => 'Isi %s dengan angka dan tidak kurang dari 1',
        ),
      ),
    array(
      'field' => 'psg_umur_pasangan[]',
      'label' => 'Umur Pasangan Ketika menikah',
      'rules' => 'required|greater_than_equal_to[16]',
      'errors' => array(
        'required' => '%s harus diisi',
        'greater_than_equal_to' => 'Isi %s tidak boleh kurang dari 16 tahun',
        ),
      ),
    ),
  // DATA DASAR -- DATA ANGGOTA KELUARGA
  'data_dasar/C_data_dasar/store_anggota_keluarga' => array(
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
      'label' => 'Anggota keluarga',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'ak_hubungan_keluarga[]',
      'label' => 'Hubungan Keluarga',
      'rules' => 'required|in_list[3,4]',
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
    array(
      'field' => 'ak_perkawinan_ke[]',
      'label' => 'Keturunan dari perkawinan',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    ),
  // DATA DASAR -- DATA EKONOMI
  'data_dasar/C_data_dasar/store_ekonomi' => array(
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
      'label' => 'Luas bangunan',
      'rules' => 'required|regex_match[/([0-9.])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => 'Isi %s dengan angka',
        ),
      ),
    array(
      'field' => 'luas_lahan',
      'label' => 'Luas lahan',
      'rules' => 'required|regex_match[/([0-9.])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => 'Isi %s dengan angka',
        ),
      ),
    array(
      'field' => 'kepemilikan_rumah',
      'label' => 'Kepemilikan rumah',
      'rules' => 'required|in_list[1,2,3,4]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'daya_listrik',
      'label' => 'Daya listrik',
      'rules' => 'required|in_list[450,900,1300,2000]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'sumber_ekonomi',
      'label' => 'Sumber ekonomi',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'penopang_ekonomi',
      'label' => 'Penopang ekonomi',
      'rules' => 'required|in_list[1,2,3,4]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    ),
  // DATA DASAR -- DATA PERILAKU KESEHATAN KELUARGA
  'data_dasar/C_data_dasar/store_perilaku' => array(
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
      'rules' => 'required|in_list[1,2,3,4,5]',
      'errors' => array(
        'required' => 'Harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        )
      ),
    array(
      'field' => 'jamkes_pri_kel',
      'rules' => 'required|in_list[0,1,2,3]',
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
      'label' => 'Jenis sumber air lain',
      'rules' => 'regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan data yang benar'
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
  'data_dasar/C_data_dasar/store_riwayat_kes' => array(
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
      'rules' => 'regex_match[/((?:\b[^\d\W]+\b))/]',
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
      'rules' => 'regex_match[/((?:\b[^\d\W]+\b))/]',
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
      'rules' => 'regex_match[/((?:\b[^\d\W]+\b))/]',
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
      'rules' => 'regex_match[/((?:\b[^\d\W]+\b))/]',
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
      'rules' => 'in_list[1,2,3,4,5,6,7,8]',
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
      'rules' => 'regex_match[/([A-Za-z ]])/]',
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
      'rules' => 'regex_match[/([A-Za-z ]])/]',
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
      'rules' => 'regex_match[/([A-Za-z ]])/]',
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
      'rules' => 'regex_match[/([A-Za-z ]])/]',
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
      'rules' => 'regex_match[/((?:\b[^\d\W]+\b))/]',
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
  'data_dasar/C_data_dasar/store_gejala_stres' => array(
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
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_02',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_03',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_04',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_05',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_06',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_07',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_08',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_09',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_10',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_11',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_12',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_13',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_14',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    array(
      'field' => 'no_15',
      'rules' => 'required|in_list[0,1,2,3,4]|numeric',
      'errors' => array(
        'required' => 'Data harus diisi',
        'in_list' => 'Isi dengan data yang sudah disediakan',
        'numeric' => 'Isi dengan angka'
        )
      ),
    ),
  
  // DATA DASAR -- IDENTITAS PASIEN -- EDIT
  'data_dasar/C_data_dasar/update_identitas_pasien' => array(
    array(
      'field' => 'no_bpjs',
      'label' => 'Nomor BPJS',
      'rules' => 'required|numeric|min_length[13]|max_length[13]',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi sesuai dengan %s yang benar',
        'min_length' => '%s harus diisi dengan 13 digit nomor BPJS',
        'max_length' => '%s harus diisi dengan 13 digit nomor BPJS',
        ),
      ),
    array(
      'field' => 'nama',
      'label' => 'Nama Pasien',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya boleh berisi karakter alfabet dan spasi',
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
      'field' => 'suku_bangsa',
      'label' => 'Suku Bangsa',
      'rules' => 'required|alpha',
      'errors' => array(
        'required' => '%s harus diisi',
        'alpha' => '%s hanya boleh berisi karakter alfabet',
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
      'rules' => 'required|regex_match[/([\w\s.,])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => 'Isi %s dengan benar'
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
  // DATA DASAR -- DATA EKONOMI -- EDIT
  'data_dasar/C_data_dasar/update_ekonomi' => array(
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
      'label' => 'Luas bangunan',
      'rules' => 'required|regex_match[/([0-9.])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => 'Isi %s dengan angka',
        ),
      ),
    array(
      'field' => 'luas_lahan',
      'label' => 'Luas lahan',
      'rules' => 'required|regex_match[/([0-9.])/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => 'Isi %s dengan angka',
        ),
      ),
    array(
      'field' => 'kepemilikan_rumah',
      'label' => 'Kepemilikan rumah',
      'rules' => 'required|in_list[1,2,3,4]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'daya_listrik',
      'label' => 'Daya listrik',
      'rules' => 'required|in_list[450,900,1300,2000]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'sumber_ekonomi',
      'label' => 'Sumber ekonomi',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    array(
      'field' => 'penopang_ekonomi',
      'label' => 'Penopang ekonomi',
      'rules' => 'required|in_list[1,2,3,4]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s sesuai dengan data yang disediakan',
        ),
      ),
    ),
  // DATA DASAR -- DATA PERKAWINAN -- EDIT
  'data_dasar/C_data_dasar/update_perkawinan' => array(
    array(
      'field' => 'id_kk[]',
      'label' => 'ID Kartu Keluarga',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'id_data_perkawinan[]',
      'label' => 'ID Perkawinan',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
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
      'rules' => 'required|in_list[1,2]',
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
      'rules' => 'required|greater_than_equal_to[1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'greater_than_equal_to' => 'Isi %s dengan angka dan tidak kurang dari 1',
        ),
      ),
    array(
      'field' => 'psg_umur_pasangan[]',
      'label' => 'Umur Pasangan Ketika menikah',
      'rules' => 'required|greater_than_equal_to[16]',
      'errors' => array(
        'required' => '%s harus diisi',
        'greater_than_equal_to' => 'Isi %s tidak boleh kurang dari 16 tahun',
        ),
      ),
    ),
  // DATA DASAR -- DATA ANGGOTA KELUARGA -- EDIT
  'data_dasar/C_data_dasar/store_anggota_keluarga' => array(
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
      'label' => 'Anggota keluarga',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'ak_hubungan_keluarga[]',
      'label' => 'Hubungan Keluarga',
      'rules' => 'required|in_list[3,4]',
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
    array(
      'field' => 'ak_perkawinan_ke[]',
      'label' => 'Keturunan dari perkawinan',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    ),
  
  // PENGOBATAN HOLISTIK -- PENDAFTARAN PASIEN
  'pengobatan_holistik/C_pengobatan_holistik/store_pendaftaran_pengobatan' => array(
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
  'pengobatan_holistik/C_pengobatan_holistik/store_anamnesis' => array(
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
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi %s dengan angka',
        )
      ),
    array(
      'field' => 'nadi',
      'label' => 'Denyut Nadi',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi %s diisi dengan angka',
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
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya bisa diisi dengan alfabet dan karakter "-"',
        )
      ),
    ),
  // PENGOBATAN HOLISTIK -- PENGISIAN DIAGNOSIS
  'pengobatan_holistik/C_pengobatan_holistik/store_diagnosis' => array(
    array(
      'field' => 'penyakit[]',
      'label' => 'Penyakit',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
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
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
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
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan alfabet dan spasi'
        )
      ),
    array(
      'field' => 'faktor_pemicu[]',
      'label' => 'Faktor Pemicu Penyakit',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
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
  // PENGOBATAN HOLISTIK -- PENGISIAN INTERVENSI
  'pengobatan_holistik/C_pengobatan_holistik/store_intervensi' => array(
    array(
      'field' => 'id_registrasi',
      'label' => 'ID Registrasi',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Terdapat kesalahan dalam pengisian %s'
        )
      ),
    array(
      'field' => 'nik_tenaga_medis',
      'label' => 'Tenaga Medis',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Terdapat kesalahan dalam pengisian %s'
        )
      ),
    array(
      'field' => 'no_bpjs',
      'label' => 'Nomor BPJS',
      'rules' => 'required',
      'errors' => array(
        'required' => 'Terdapat kesalahan dalam pengisian %s'
        )
      ),
    array(
      'field' => 'jenis_rujukan',
      'label' => 'Jenis Rujukan',
      'rules' => 'in_list[1,2,3]',
      'errors' => array(
        'in_list' => 'Isi %s dengan data yang sudah disediakan'
        )
      ),
    array(
      'field' => 'rs',
      'label' => 'Rumah Sakit atau Puskesmas Rujukan',
      'rules' => 'regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'regex_match' => 'Isi %s dengan data yang benar'
        )
      ),
    ),
  
  // PENGELOLAAN OBAT -- PENCATATAN OBAT BARU
  'pengelolaan_obat/C_pencatatan_obat_baru/store' => array(
    array(
      'field' => 'nama[]',
      'label' => 'Nama obat',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'bpjs[]',
      'label' => 'Status pembiayaan',
      'rules' => 'required|in_list[0,1]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang tersedia',
        ),
      ),
    array(
      'field' => 'jumlah[]',
      'label' => 'Jumlah obat',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi %s dengan angka',
        ),
      ),
    array(
      'field' => 'jenis[]',
      'label' => 'Jenis Obat',
      'rules' => 'required|in_list[1,2,3]',
      'errors' => array(
        'required' => '%s harus diisi',
        'in_list' => 'Isi %s dengan data yang tersedia',
        ),
      ),
    ),
  // PENGELOLAAN OBAT -- PENCATATAN OBAT MASUK
  'pengelolaan_obat/C_pencatatan_obat_masuk/store' => array(
    array(
      'field' => 'id_obat[]',
      'label' => 'Nama obat',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'jumlah_masuk[]',
      'label' => 'Jumlah obat masuk',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi %s dengan angka',
        ),
      ),
    ),
  // PENGELOLAAN OBAT -- PENCATATAN OBAT KELUAR
  'pengelolaan_obat/C_pencatatan_obat_keluar/store' => array(
    array(
      'field' => 'id_resep_obat',
      'label' => 'Resep Obat Pasien',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'id_obat[]',
      'label' => 'Obat',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi'
        ),
      ),
    array(
      'field' => 'jumlah_keluar[]',
      'label' => 'Jumlah Obat Keluar',
      'rules' => 'required|greater_than[0]',
      'errors' => array(
        'required' => '%s harus diisi',
        'greater_than' => '%s harus diisi dengan angka bernilai lebih dari 0',
        ),
      ),
    ),
  
  // DATA MASTER - WILAYAH ADMINISTRATIF - PROVINSI
  'data_master/C_wilayah_administratif/store_provinsi' => array(
    array(
      'field' => 'nama[]',
      'label' => 'Nama Provinsi',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan karakter alfabet dan spasi',
        ),
      ),
    ),
  // DATA MASTER - WILAYAH ADMINISTRATIF - KABUPATEN
  'data_master/C_wilayah_administratif/store_kabupaten' => array(
    array(
      'field' => 'id_provinsi',
      'label' => 'Provinsi',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'nama[]',
      'label' => 'Nama Kabupaten',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan karakter alfabet dan spasi',
        ),
      ),
    ),
  // DATA MASTER - WILAYAH ADMINISTRATIF - KECAMATAN
  'data_master/C_wilayah_administratif/store_kecamatan' => array(
    array(
      'field' => 'id_provinsi',
      'label' => 'Provinsi',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'id_kabupaten',
      'label' => 'Kabupaten',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'nama[]',
      'label' => 'Nama Kecamatan',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan karakter alfabet dan spasi',
        ),
      ),
    ),
  // DATA MASTER - WILAYAH ADMINISTRATIF - KELURAHAN
  'data_master/C_wilayah_administratif/store_kelurahan' => array(
    array(
      'field' => 'id_provinsi',
      'label' => 'Provinsi',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'id_kabupaten',
      'label' => 'Kabupaten',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'id_kecamatan',
      'label' => 'Kecamatan',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'nama[]',
      'label' => 'Nama Kelurahan',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan karakter alfabet dan spasi',
        ),
      ),
    ),

  // DATA MASTER - MODUL KESEHATAN - MODUL PENYAKIT
  'data_master/C_modul_kesehatan/store_modul_penyakit' => array(
    array(
      'field' => 'nama',
      'label' => 'Nama modul',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'tgl_dibuat',
      'label' => 'Tanggal modul dibuat',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'versi',
      'label' => 'Versi modul',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi %s dengan angka',
        ),
      ),
    ),
  // DATA MASTER - MODUL KESEHATAN - MODUL FAKTOR RISIKO
  'data_master/C_modul_kesehatan/store_modul_faktor_risiko' => array(
    array(
      'field' => 'nama',
      'label' => 'Nama modul',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'tgl_dibuat',
      'label' => 'Tanggal modul dibuat',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'versi',
      'label' => 'Versi modul',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi %s dengan angka',
        ),
      ),
    ),
  // DATA MASTER - MODUL KESEHATAN - MODUL FAKTOR PEMICU
  'data_master/C_modul_kesehatan/store_modul_faktor_pemicu' => array(
    array(
      'field' => 'nama',
      'label' => 'Nama modul',
      'rules' => 'required|regex_match[/(?:\b[^\d\W]+\b)/]',
      'errors' => array(
        'required' => '%s harus diisi',
        'regex_match' => '%s hanya dapat diisi dengan karakter alfabet dan spasi',
        ),
      ),
    array(
      'field' => 'tgl_dibuat',
      'label' => 'Tanggal modul dibuat',
      'rules' => 'required',
      'errors' => array(
        'required' => '%s harus diisi',
        ),
      ),
    array(
      'field' => 'versi',
      'label' => 'Versi modul',
      'rules' => 'required|numeric',
      'errors' => array(
        'required' => '%s harus diisi',
        'numeric' => 'Isi %s dengan angka',
        ),
      ),
    ),
  );