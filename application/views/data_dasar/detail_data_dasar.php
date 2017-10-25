<section class="content-header">
  <h1>
    Detail Data Dasar Kesehatan Keluarga
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-book"></i> Data Dasar</li>
    <li><a href="<?php echo base_url(); ?>lihat-data-dasar"><i class="fa fa-database"></i> Data Dasar Kesehatan</a></li>
    <li class="active">Detail Data Dasar Kesehatan Keluarga</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <section class="col-md-12">
      <div class="col-md-12">
        {err_vars}
      </div>
      {alert_vars}
    </section>
  </div>
  <div class="row">
    <section class="col-md-6">
      {tr_template}
      <!-- /tingkat-risiko-penyakit -->
      {ts_template}
      <!-- /tingkat-stres -->
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Identitas Pasien</h3>
            <div class="box-tools pull-right">
              {dd_identitas}
              <?php if ($this->session->userdata('tabel') != 'keperawatan'): ?>
              <button type="button" onclick="window.location='<?php echo base_url(); ?>edit-identitas-pasien/{id_kk}/{no_bpjs}'" class="btn btn-box-tool bg-yellow"><i class="fa fa-pencil"></i>&nbsp;Ubah Identitas Pasien</button>
              <?php endif; ?>
              {/dd_identitas}
            </div>
          </div>
          <!-- ./box-header -->
          <div class="box-body">
            <table class="table">
              <tbody>
                {dd_identitas}
                <tr>
                  <th style="width: 40%">No. BPJS</th>
                  <td>{no_bpjs}</td>
                </tr>
                <tr>
                  <th>Nama (Umur)</th>
                  <td>{nama} ({umur} tahun)</td>
                </tr>
                <tr>
                  <th>Jenis Kelamin</th>
                  <td>{jenis_kelamin}</td>
                </tr>
                <tr>
                  <th>Kelas BPJS<br />(Status Tagihan)</th>
                  <td>{kelas_bpjs}<br />{status_tagihan_bpjs}</td>
                </tr>
                <tr>
                  <th>Pekerjaan</th>
                  <td>{pekerjaan_utama}</td>
                </tr>
                <tr>
                  <th>Keterangan Hidup</th>
                  <td>{hidup}</td>
                </tr>
                <tr>
                  <th>Agama</th>
                  <td>{agama}</td>
                </tr>
                <tr>
                  <th>Alamat</th>
                  <td>
                    {alamat}<br />
                    {provinsi}, {kabupaten}, {kecamatan}, {kelurahan}
                  </td>
                </tr>
                {/dd_identitas}
              </tbody>
            </table>
          </div>
          <!-- ./box-body -->
        </div>
      </div>
      <!-- /identitas-pasien -->
    </section>
    <!-- /left-column -->
    <section class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Ekonomi Keluarga</h3>
          <div class="box-tools pull-right">
            {dd_ekonomi}
            <?php if ($this->session->userdata('tabel') != 'keperawatan'): ?>
            <button type="button" onclick="window.location='<?php echo base_url(); ?>edit-ekonomi/{id_kk}'" class="btn btn-box-tool bg-yellow"><i class="fa fa-pencil"></i>&nbsp;Ubah Data Ekonomi</button>
            <?php endif; ?>
            {/dd_ekonomi}
          </div>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {add_ekonomi}
          <table class="table">
            <tbody>
              {dd_ekonomi}
              <tr>
                <th>Kepemilikan Rumah</th>
                <td>{kepemilikan_rumah}</td>
              </tr>
              <tr>
                <th>Luas Bangunan</th>
                <td>{luas_bangunan} m<sup>2</sup></td>
              </tr>
              <tr>
                <th>Luas Lahan</th>
                <td>{luas_lahan} m<sup>2</sup></td>
              </tr>
              <tr>
                <th>Sumber Ekonomi</th>
                <td>{sumber_ekonomi}</td>
              </tr>
              <tr>
                <th>Penopang Ekonomi</th>
                <td>{penopang_ekonomi}</td>
              </tr>
              <tr>
                <th>Daya Listrik</th>
                <td>{daya_listrik} Watt</td>
              </tr>
              {/dd_ekonomi}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /data-ekonomi -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Kesehatan Kepala Keluarga</h3>
          <div class="box-tools pull-right">
            {dd_kes_kel}
            <button type="button" onclick="window.location='<?php echo base_url(); ?>riwayat-data-dasar/{id_kk}'" class="btn btn-box-tool bg-blue"><i class="fa fa-eye"></i>&nbsp;Lihat Riwayat</button>
            <?php if ($this->session->userdata('tabel') != 'keperawatan'): ?>
            <button type="button" onclick="window.location='<?php echo base_url(); ?>add-riwayat-kes-kel/{id_kk}'" class="btn btn-box-tool bg-yellow"><i class="fa fa-pencil"></i>&nbsp;Perbarui</button>
            <button type="button" onclick="window.location='<?php echo base_url(); ?>destroy-riwayat-kes-kel/{id_kk}/{id_riwayat_kes_kel}'" class="btn btn-box-tool bg-red"><i class="fa fa-remove"></i>&nbsp;Hapus</button>
            <?php endif; ?>
            {/dd_kes_kel}
          </div>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {add_kes_kel}
          <table class="table">
            <tbody>
              {dd_kes_kel}
              <tr>
                <th>Batuk</th>
                <td>{batuk}</td>
                <th>Konsumsi Obat</th>
                <td>{obat}</td>
              </tr>
              <tr>
                <th>Asma</th>
                <td>{asma}</td>
                <th>Konsumsi Minuman Dingin</th>
                <td>{m_dingin}</td>
              </tr>
              <tr>
                <th>Merokok</th>
                <td>{merokok}</td>
                <th>Memiliki Peliharaan</th>
                <td>{peliharaan}</td>
              </tr>
              <tr>
                <th>Konsumsi Jamu</th>
                <td>{jamu}</td>
                <th>Olahraga Keluarga</th>
                <td>{olahraga}</td>
              </tr>
              <tr>
                <th>Konsumsi Alkohol</th>
                <td>{alkohol}</td>
                <td colspan="2">
                  <button type="button" onclick="window.location='<?php echo base_url(); ?>hitung-tingkat-risiko-penyakit/{id_kk}/{id_riwayat_kes_kel}'" class="btn btn-box-tool bg-blue" style="width: 100%"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Perbarui Tingkat Risiko Penyakit</button>
                </td>
              </tr>
              <tr>
                <th>Konsumsi Kopi</th>
                <td>{kopi}</td>
              </tr>
              {/dd_kes_kel}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /data-kesehatan-kk -->
    </section>
    <!-- /right-column -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Perilaku Kesehatan</h3>
          <div class="box-tools pull-right">
            {dd_perilaku}
            <?php if ($this->session->userdata('tabel') != 'keperawatan'): ?>
            <button type="button" onclick="window.location='<?php echo base_url(); ?>destroy-perilaku/{id_kk}/{tgl_isi}/{id_riwayat_kes_kel}'" class="btn btn-box-tool bg-red"><i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus Perilaku Kesehatan</button>
            <?php endif; ?>
            {/dd_perilaku}
          </div>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {add_perilaku}
          <table id="dd-perilaku" class="table table-bordered table-striped">
            <tbody>
              {dd_perilaku}
              <tr>
                <th>Tanggal Isi</th>
                <td colspan="3">{tgl_isi_formatted}</td>
              </tr>
              <tr>
                <th>Pelayanan promotif atau<br />preventif bayi dan balita</th>
                <td>{layanan_balita}</td>
                <th>Fasilitas MCK<br />Cuci Tersendiri</th>
                <td>{mck_cuci}</td>
              </tr>
              <tr>
                <th>Pemeliharaan Kesehatan<br />Anggota Keluarga</th>
                <td>{pemeliharaan_kes_kel}</td>
                <th>SPAL</th>
                <td>{spal}</td>
              </tr>
              <tr>
                <th>Pelayanan Pengobatan<br />Diri Sendiri</th>
                <td>{layanan_pengobatan_diri}</td>
                <th>Penggunaan Kasur Busa</th>
                <td>{kasur_busa}</td>
              </tr>
              <tr>
                <th>Jaminan Pemeliharaan Kesehatan<br />untuk Diri Sendiri & Keluarga</th>
                <td>{jamkes_pri_kel}</td>
                <th>Penggunaan Kosmetik atau<br />Obat Luar</th>
                <td>{kosmetik_obat_luar}</td>
              </tr>
              <tr>
                <th>Sumber Air Minum<br />Dirumah Tinggal</th>
                <td>{sumber_air}&nbsp;{sumber_air_lain}</td>
                <th>Penggunaan Sepeda atau<br />Sepeda Motor</th>
                <td>{pengguna_sepeda_motor}</td>
              </tr>
              <tr>
                <th>Fasilitas MCK Kamar Mandi</th>
                <td>{mck_km}</td>
                <th>Manula sendirian di rumah</th>
                <td>{manula_sendirian}</td>
              </tr>
              <tr>
                <th>Fasilitas MC WC</th>
                <td>{mck_wc}</td>
              </tr>
              {/dd_perilaku}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /perilaku-kesehatan -->
    </div>
  </div>
  <div class="row">
    <section class="col-md-6 col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Riwayat Masalah Kesehatan</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <table id="dd-riwayat-maskes" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Masalah Kesehatan</th>
              </tr>
            </thead>
            <tbody>
              {dd_maskes}
              <tr>
                <td>{nama}</td>
                <td>{masalah_kes}</td>
              </tr>
              {/dd_maskes}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /riwayat-masalah-kesehatan -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Riwayat Masalah Keturunan</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <table id="dd-riwayat-masket" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Masalah Keturunan</th>
              </tr>
            </thead>
            <tbody>
              {dd_masket}
              <tr>
                <td>{nama}</td>
                <td>{jenis_masalah_keturunan}</td>
              </tr>
              {/dd_masket}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /riwayat-masalah-keturunan -->
    </section>
    <!-- /left-column -->
    <section class="col-md-6 col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Riwayat Kecelakaan Kerja</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <table id="dd-riwayat-kecelakaan-kerja" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Kecelakaan</th>
                <th>Tahun</th>
                <th>Kelainan</th>
                <th>Durasi<br />Perawatan</th>
              </tr>
            </thead>
            <tbody>
              {dd_kecelakaan_kerja}
              <tr>
                <td>{jenis_kecelakaan_kerja}</td>
                <td>{tahun_kejadian}</td>
                <td>{jenis_kelainan}</td>
                <td>{durasi_perawatan}</td>
              </tr>
              {/dd_kecelakaan_kerja}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /riwayat-kecelakaan -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Riwayat Sakit Keras</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <table id="dd-riwayat-sakit-keras" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Jenis Sakit Keras</th>
                <th>Tahun</th>
              </tr>
            </thead>
            <tbody>
              {dd_sakit_keras}
              <tr>
                <td>{jenis_sakit_keras}</td>
                <td>{tahun_sakit}</td>
              </tr>
              {/dd_sakit_keras}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /riwayat-sakit-keras -->
    </section>
    <!-- /right-column -->
  </div>
  <div class="row">
    <section class="col-md-4 col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Riwayat Kesehatan 1 Bulan</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <table id="dd-riwayat-1-bulan" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Jenis Penyakit</th>
              </tr>
            </thead>
            <tbody>
              {dd_satu_bulan}
              <tr>
                <td>{nama}</td>
                <td>{jenis_penyakit}</td>
              </tr>
              {/dd_satu_bulan}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /riwayat-1-bulan -->
    </section>
    <section class="col-md-4 col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Riwayat Kesehatan 3 Bulan</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <table id="dd-riwayat-3-bulan" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Jenis Penyakit</th>
              </tr>
            </thead>
            <tbody>
             {dd_tiga_bulan}
              <tr>
                <td>{nama}</td>
                <td>{jenis_penyakit}</td>
              </tr>
              {/dd_tiga_bulan}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /riwayat-3-bulan -->
    </section>
    <section class="col-md-4 col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Riwayat Kesehatan 1 Tahun</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <table id="dd-riwayat-1-tahun" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Jenis Penyakit</th>
              </tr>
            </thead>
            <tbody>
              {dd_satu_tahun}
              <tr>
                <td>{nama}</td>
                <td>{jenis_penyakit}</td>
              </tr>
              {/dd_satu_tahun}
            </tbody>
          </table>
        </div>
      </div>
      <!-- /riwayat-1-tahun -->
    </section>
  </div>
  <!-- /riwayat-1-bulan /riwayat-3-bulan /riwayat-1-tahun -->
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Riwayat Perkawinan</h3>
          <div class="box-tools pull-right">
            <?php if ($this->session->userdata('tabel') != 'keperawatan'): ?>
            <button type="button" onclick="window.location='<?php echo base_url(); ?>edit-perkawinan/{id_kk}'" class="btn btn-box-tool bg-yellow"><i class="fa fa-pencil"></i>&nbsp;Ubah Data Perkawinan dan Anggota Keluarga</button>
            <?php endif; ?>
          </div>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <table id="dd-perkawinan" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No. BPJS</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Hubungan Keluarga</th>
                <th>Perkawinan Ke<br />(Umur Ketika Menikah)</th>
                <th>Status Perkawinan</th>
                <th>Anak Dari Perkawinan Ke</th>
                <th>Keterangan Hidup</th>
              </tr>
            </thead>
            <tbody>
              {dd_perkawinan}
              <tr>
                <td>{no_bpjs}</td>
                <td>{nama}</td>
                <td>{jenis_kelamin}</td>
                <td>{hubungan_keluarga}</td>
                <td>{perkawinan_ke}&nbsp;{umur_pasangan}</td>
                <td>{status_kawin}</td>
                <td>{anak_dari}</td>
                <td>{hidup}</td>
              </tr>
              {/dd_perkawinan}
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /perkawinan -->
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Data Anggota Keluarga</h3>
          <div class="box-tools pull-right">
            <?php if ($this->session->userdata('tabel') != 'keperawatan'): ?>
            <button type="button" onclick="window.location='<?php echo base_url(); ?>edit-perkawinan/{id_kk}'" class="btn btn-box-tool bg-yellow"><i class="fa fa-pencil"></i>&nbsp;Ubah Data Perkawinan dan Anggota Keluarga</button>
            <?php endif; ?>
          </div>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <table id="dd-anggota-keluarga" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No. BPJS</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Keterangan Hidup</th>
                <th>Domisili Serumah</th>
                <th>Hubungan Keluarga</th>
                <?php if ($this->session->userdata('tabel') != 'keperawatan'): ?>
                <th>Opsi</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              {dd_anggota_keluarga}
              <tr>
                <td>{no_bpjs}</td>
                <td>{nama}</td>
                <td>{jenis_kelamin}</td>
                <td>{tgl_lahir}</td>
                <td>{hidup}</td>
                <td>{domisili_serumah}</td>
                <td>{hubungan_keluarga}</td>
                <?php if ($this->session->userdata('tabel') != 'keperawatan'): ?>
                <td>
                  <div class="form-group btn-group">
                    <button type="button" class="btn btn-xs btn-warning" onclick="window.location='<?php echo base_url(); ?>edit-identitas-pasien/{id_kk}/{no_bpjs}'"><i class="fa fa-pencil"></i></button>
                    <button type="button" class="btn btn-xs btn-danger" onclick="window.location='<?php echo base_url(); ?>destroy-anggota-keluarga/{id_kk}/{no_bpjs}'"><i class="fa fa-trash-o"></i></button>
                  </div>
                </td>
                <?php endif; ?>
              </tr>
              {/dd_anggota_keluarga}
            </tbody>
          </table>
        </div>
      </div>  
    </div>
    <!-- /anggota-keluarga -->
  </div>
  <!-- /masalah-keturunan /riwayat-penyakit-kecelakaan -->
</section>