<section class="content-header">
  <h1>
    Data Dasar Kesehatan Keluarga
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-book"></i> Data Dasar</li>
    <li><a href="<?php echo base_url(); ?>lihat-data-dasar"><i class="fa fa-database"></i> Data Dasar Kesehatan Keluarga</a></li>
    <li class="active">Formulir Data Dasar Kesehatan Keluarga</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- SELECT2 EXAMPLE -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Formulir Data Dasar Kesehatan Keluarga</h3>
    </div>
    <!-- /.box-header -->

    <div class="box-body">
      <div class="col-md-12">
        {err_vars}  
      </div>
      {alert_vars}
      <div class="col-md-12">
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-info"></i>&nbsp;Perhatian!</h4>
          <p>Jika pasien <strong>telah tercatat</strong> sebagai pasien BPJS Poliklinik Pabrik Gula Kebon Agung, maka pengisian Data Dasar Kesehatan Keluarga untuk pasien tersebut bisa dimulai pada <strong>Pengisian Data Riwayat Pekerjaan</strong></p>
          <p>Untuk memastikan apakah pasien telah terdaftar sebagai pasien BPJS Poliklinik Pabrik Gula Kebon Agung, cek pada <a href="<?php echo base_url() ?>lihat-data-pasien-bpjs">halaman ini</a>.</p>
        </div>
      </div>
      <div class="col-md-12">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">I. Data Pasien</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
          </div>

          <form action="<?php echo base_url(); ?>simpan-pasien-baru" method="post" class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="input-kk-no-bpjs" class="col-sm-3 control-label">No. BPJS</label>

                <div class="col-md-3">
                  <input type="text" class="form-control" minlength="13" maxlength="13" size="13" name="no_bpjs" value="<?php echo set_value('no_bpjs'); ?>" id="input-kk-no-bpjs" required>
                  <span class="help-block"><small>Masukkan 13 digit Nomor BPJS pasien</small></span>
                  <?php echo form_error('no_bpjs'); ?>
                </div>
              </div>
              <!-- /no-bpjs -->
              <div class="form-group">
                <label for="input-kk-nama" class="col-sm-3 control-label">Nama Lengkap</label>

                <div class="col-md-5">
                  <input type="text" class="form-control" name="nama" value="<?php echo set_value('nama'); ?>" id="input-kk-nama" required>
                  <?php echo form_error('nama'); ?>
                </div>
              </div>
              <!-- /nama -->
              <div class="form-group">
                <label for="input-kk-jenis-kelamin" class="col-sm-3 control-label">Jenis Kelamin</label>
                
                <div class="col-md-2">
                  <select name="jenis_kelamin" class="form-control" id="input-kk-jenis-kelamin" required>
                    <option value="" selected disabled <?php echo set_select('jenis_kelamin', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="p" <?php echo set_select('jenis_kelamin', 'p'); ?>>Perempuan</option>
                    <option value="l" <?php echo set_select('jenis_kelamin', 'l'); ?>>Laki-Laki</option>
                  </select>
                  <?php echo form_error('jenis_kelamin'); ?>
                </div>
              </div>
              <!-- /jenis-kelamin -->
              <div class="form-group">
                <label for="datepicker" class="col-sm-3 control-label">Tanggal Lahir</label>

                <div class="col-md-3 date">
                  <input type="date" name="tgl_lahir" value="<?php echo set_value('tgl_lahir'); ?>" class="form-control" min="<?php $mintime =  strtotime("-100 year"); echo date('Y-m-d', $mintime); ?>" max="<?php echo date('Y-m-d'); ?>" required>
                  <span class="help-block"><small>Format Tanggal: Bulan/Tanggal/Tahun</small></span>
                  <?php echo form_error('tgl_lahir'); ?>
                </div>
              </div>
              <!-- /tgl-lahir -->
              <div class="form-group">
                <label for="input-kk-suku-bangsa" class="col-sm-3 control-label">Suku Bangsa</label>

                <div class="col-md-3">
                  <input type="text" class="form-control" name="suku_bangsa" value="<?php echo set_value('suku_bangsa'); ?>" id="input-kk-suku-bangsa" required>
                  <?php echo form_error('suku_bangsa'); ?>
                </div>
              </div>
              <!-- /suku-bangsa -->
              <div class="form-group">
                <label for="input-kk-agama" class="col-sm-3 control-label">Agama</label>

                <div class="col-md-2">
                  <select name="agama" id="input-kk-agama" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('agama', '', TRUE); ?>>Pilih opsi</option>
                    <option value="budha" <?php echo set_select('agama', 'budha'); ?>>Budha</option>
                    <option value="hindu" <?php echo set_select('agama', 'hindu'); ?>>Hindu</option>
                    <option value="islam" <?php echo set_select('agama', 'islam'); ?>>Islam</option>
                    <option value="katolik" <?php echo set_select('agama', 'katolik'); ?>>Katolik</option>
                    <option value="kristen" <?php echo set_select('agama', 'kristen'); ?>>Kristen</option>
                  </select>
                  <?php echo form_error('agama'); ?>
                </div>
              </div>
              <!-- /agama -->
              <div class="form-group">
                <label for="input-kk-pendidikan-terakhir" class="col-sm-3 control-label">Pendidikan Terakhir</label>

                <div class="col-md-3">
                  <select name="pendidikan_terakhir" id="input-kk-pendidikan-terakhir" class="form-control">
                    <option value="" selected disabled <?php echo set_select('pendidikan_terakhir', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="sd" <?php echo set_select('pendidikan_terakhir', 'sd'); ?>>SD/MI</option>
                    <option value="smp" <?php echo set_select('pendidikan_terakhir', 'smp'); ?>>SMP/MTs</option>
                    <option value="sma" <?php echo set_select('pendidikan_terakhir', 'sma'); ?>>SMA/MA/SMK</option>
                    <option value="diploma" <?php echo set_select('pendidikan_terakhir', 'diploma'); ?>>Diploma</option>
                    <option value="sarjana" <?php echo set_select('pendidikan_terakhir', 'sarjana'); ?>>Sarjana</option>
                    <option value="magister" <?php echo set_select('pendidikan_terakhir', 'magister'); ?>>Magister</option>
                    <option value="doktor" <?php echo set_select('pendidikan_terakhir', 'doktor'); ?>>Doktor</option>
                  </select>
                  <?php echo form_error('pendidikan_terakhir'); ?>
                </div>
              </div>
              <!-- /pendidikan-terakhir -->
              <div class="form-group">
                <label for="input-kk-kelas-bpjs" class="col-sm-3 control-label">Kelas BPJS</label>

                <div class="col-md-2">
                  <select name="kelas_bpjs" id="input-kk-kelas-bpjs" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('kelas_bpjs', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('kelas_bpjs', '1'); ?>>Kelas I</option>
                    <option value="2" <?php echo set_select('kelas_bpjs', '2'); ?>>Kelas II</option>
                    <option value="3" <?php echo set_select('kelas_bpjs', '3'); ?>>Kelas III</option>
                  </select>
                  <?php echo form_error('kelas_bpjs'); ?>
                </div>
              </div>
              <!-- /kelas-bpjs -->
              <div class="form-group">
                <label for="input-kk-status-tagihan-bpjs" class="col-sm-3 control-label">Status Tagihan BPJS</label>

                <div class="col-md-2">
                  <select name="status_tagihan_bpjs" id="input-kk-status-tagihan-bpjs" class="form-control" required>
                    <option value="" selected disabled <?php echo set_value('status_tagihan_bpjs', '', TRUE); ?>>Status Tagihan</option>
                    <option value="0" <?php echo set_select('status_tagihan_bpjs', '0'); ?>>Lunas</option>
                    <option value="1" <?php echo set_select('status_tagihan_bpjs', '1'); ?>>Ada Tagihan</option>
                  </select>
                  <?php echo form_error('status_tagihan_bpjs'); ?>
                </div>
              </div>
              <!-- /status-tagihan-bpjs -->
              <div class="form-group">
                <label for="input-kk-alamat" class="col-sm-3 control-label">Alamat</label>

                <div class="col-md-5">
                  <textarea class="form-control" name="alamat" rows="3" required><?php echo set_value('alamat'); ?></textarea>
                  <?php echo form_error('alamat'); ?>
                </div>
              </div>
              <!-- /alamat -->
              <div class="form-group">
                <label for="input-kk-provinsi" class="col-sm-3 control-label">Provinsi</label>

                <div class="col-md-5">
                  <select name="id_provinsi" id="input-kk-provinsi" class="form-control select2" style="width: 100%" onchange="filter_region('kabupaten', this)" required>
                    <option value="" selected disabled <?php echo set_select('id_provinsi', '', TRUE); ?>>Provinsi</option>
                    <?php foreach($provinsi['data'] as $value): ?>
                    <option value="<?php echo $value['id_provinsi']; ?>"><?php echo $value['nama']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('id_provinsi'); ?>
                </div>
              </div>
              <!-- /provinsi -->
              <div class="form-group">
                <label for="input-kk-kabupaten" class="col-sm-3 control-label">Kabupaten / Kota</label>

                <div class="col-md-5">
                  <select name="id_kabupaten" id="input-kk-kabupaten" class="form-control select2" style="width: 100%" onchange="filter_region('kecamatan', this)" required>
                    <option value="" selected disabled <?php echo set_select('id_kabupaten', '', TRUE); ?>>Kabupaten / Kota</option>
                  </select>
                  <?php echo form_error('id_kabupaten'); ?>
                </div>
              </div>
              <!-- /kabupaten -->
              <div class="form-group">
                <label for="input-kk-kecamatan" class="col-sm-3 control-label">Kecamatan</label>

                <div class="col-md-5">
                  <select name="id_kecamatan" id="input-kk-kecamatan" class="form-control select2" style="width: 100%" onchange="filter_region('kelurahan', this)" required>
                    <option value="" selected disabled <?php echo set_select('id_kecamatan', '', TRUE); ?>>Kecamatan</option>
                  </select>
                  <?php echo form_error('id_kecamatan'); ?>
                </div>
              </div>
              <!-- /kecamatan -->
              <div class="form-group">
                <label for="input-kk-kelurahan" class="col-sm-3 control-label">Kelurahan</label>

                <div class="col-md-5">
                  <select name="id_kelurahan" id="input-kk-kelurahan" class="form-control select2" style="width: 100%" required>
                    <option value="" selected disabled <?php echo set_select('id_kelurahan', '', TRUE); ?>>Kelurahan</option>
                  </select>
                  <?php echo form_error('id_kelurahan'); ?>
                </div>
              </div>
              <!-- /kelurahan -->
              <div class="form-group">
                <label for="input-kk-keterangan-hidup" class="col-sm-3 control-label">Keterangan Hidup</label>

                <div class="col-md-2">
                  <select name="hidup" id="input-kk-keterangan-hidup" class="form-control" required>
                    <option value="" selected disabled <?php echo set_value('hidup', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('hidup', '1'); ?>>Hidup</option>
                    <option value="0" <?php echo set_select('hidup', '0'); ?>>Meninggal Dunia</option>
                  </select>
                  <?php echo form_error('hidup'); ?>
                </div>
              </div>
              <!-- /keterangan-hidup -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="reset" class="btn btn-danger">Batal</button>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
      <!-- /data-pasien -->
      <div class="col-md-12">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">II. Data Riwayat Pekerjaan</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
          </div>

          <form role="form" action="<?php echo base_url(); ?>simpan-riwayat-pekerjaan" method="post">
            <div class="box-body">
              <div class="box">
                <div class="box-header with-border">
                  <h4 class="box-title">Pekerjaan Utama</h4>
                </div>
                <div class="box-body">
                  <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> Info</h4>
                    Isi data di bawah ini dengan pekerjaan utama saat ini.
                  </div>
                  <?php echo form_error('rp_no_bpjs[]'); ?>
                  <?php echo form_error('rp_pekerjaan[]'); ?>
                  <?php echo form_error('rp_divisi[]'); ?>
                  <?php echo form_error('rp_sub_divisi[]'); ?>
                  <?php echo form_error('rp_jenis_aktivitas[]'); ?>
                  <?php echo form_error('rp_intensitas_aktivitas[]'); ?>
                  <?php echo form_error('rp_dari_tahun[]'); ?>
                  <?php echo form_error('rp_pekerjaan_utama[]'); ?>
                  <?php echo form_error('rp_sampai_tahun[]'); ?>
                  <!-- ./alert -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <select name="rp_no_bpjs[]" id="rp-kepala-keluarga" class="form-control select2" style="width: 100%;" required>
                          <option value="" selected disabled>Pilih Pasien</option>
                          <?php foreach($pasien['data'] as $ar_pasien): ?>
                          <option value="<?php echo $ar_pasien['no_bpjs']; ?>"><?php echo ucwords($ar_pasien['nama']);  ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('rp_no_bpjs[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                      </div>
                    </div>
                  </div>
                  <!-- /data-pasien -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="rp_pekerjaan[]" class="form-control" placeholder="Pekerjaan" required>
                        <?php echo form_error('rp_pekerjaan[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                      </div>
                      <div class="form-group">
                        <input type="text" name="rp_divisi[]" class="form-control" placeholder="Divisi">
                        <?php echo form_error('rp_divisi[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                      </div>
                      <div class="form-group">
                        <input type="text" name="rp_sub_divisi[]" class="form-control" placeholder="Sub-Divisi">
                        <span class="help-block"><small>Opsional</small></span>
                        <?php echo form_error('rp_sub_divisi[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                      </div>
                    </div>
                    <!-- /pekerjaan -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="rp_jenis_aktivitas[]" class="form-control" placeholder="Jenis Aktivitas" required>
                        <?php echo form_error('rp_jenis_aktivitas[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                      </div>
                      <div class="form-group">
                        <select name="rp_intensitas_aktivitas[]" class="form-control" required>
                          <option value="" selected disabled>Intensitas Kegiatan</option>
                          <option value="1">Ringan</option>
                          <option value="2">Sedang</option>
                          <option value="3">Berat</option>
                        </select>
                        <?php echo form_error('rp_intensitas_aktivitas[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                      </div>
                      <div class="form-group">
                        <input type="number" name="rp_dari_tahun[]" id="rp-dari-tahun" class="form-control" minlength="4" maxlength="4" min="<?php $rp_min = strtotime('-60 year'); echo date('Y', $rp_min); ?>" max="<?php echo date('Y'); ?>" placeholder="Dari Tahun" required>
                        <?php echo form_error('rp_dari_tahun[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                      </div>
                      <input type="hidden" name="rp_pekerjaan_utama[]" value="1">
                      <input type="hidden" name="rp_sampai_tahun[]" value="<?php echo date('Y') ?>">
                    </div>
                    <!-- /aktivitas /intensitas /tahun-kerja -->
                  </div>
                  <!-- ./row /pekerjaan-utama -->
                </div>
              </div>
              <!-- /pekerjaan-utama -->
              <div class="riwayat-pekerjaan-out"></div>
              <!-- ./riwayat-pekerjaan-out -->
              <button type="button" id="add-riwayat-pekerjaan" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data Pekerjaan</button>
              <!-- #/add-riwayat-pekerjaan -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="reset" class="btn btn-danger">Batal</button>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
      <!-- /data-riwayat-pekerjaan -->
      <div class="col-md-12">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">III. Data Perkawinan</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
          <form action="<?php echo base_url(); ?>simpan-data-perkawinan" method="post">
            <div class="box-body">
              <?php echo form_error('psg_no_bpjs[]'); ?>
              <?php echo form_error('psg_hubungan_keluarga[]'); ?>
              <?php echo form_error('psg_domisili_serumah[]'); ?>
              <?php echo form_error('psg_status_kawin[]'); ?>
              <?php echo form_error('psg_perkawinan_ke[]'); ?>
              <?php echo form_error('psg_umur_pasangan[]'); ?>
              <div id="input-kepala-keluarga" class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Kepala Keluarga</label>
                    <select name="psg_no_bpjs[]" id="psg-kepala-keluarga" class="form-control select2" style="width: 100%;" required onchange="get_perkawinan_terakhir(this)">
                      <option value="" selected disabled>Pilih Pasien</option>
                      <?php foreach($pasien['data'] as $ar_pasien): ?>
                      <option value="<?php echo $ar_pasien['no_bpjs']; ?>"><?php echo ucwords($ar_pasien['nama']);  ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('psg_no_bpjs[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                  </div>
                </div>
                <!-- /psg-kepala-keluarga -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Hubungan Keluarga</label>
                    <select id="hubkelkk" name="psg_hubungan_keluarga[]" class="form-control" onchange="set_kk_pasangan(this)" required>
                      <option value="" selected disabled>Pilih Hubungan Keluarga</option>
                      <option value="1">Suami</option>
                      <option value="2">Istri</option>
                    </select>
                    <?php echo form_error('psg_hubungan_keluarga[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                  </div>
                </div>
                <!-- /pk-hubungan-keluarga -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Domisili Serumah</label>
                    <select name="psg_domisili_serumah[]" class="form-control" required>
                      <option value="" selected>Pilih Domisili</option>
                      <option value="1">Ya</option>
                      <option value="2">Tidak</option>
                      <option value="3">Kadang-Kadang</option>
                    </select>
                    <?php echo form_error('psg_domisili_serumah[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                  </div>
                </div>
                <!-- /pk-domisili-serumah -->
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Nomor Telepon/HP</label>
                    <input type="text" name="psg_no_telp" class="form-control" minlength="10" maxlength="12" required>
                    <span class="help-block"><small>Format: 08xxx</small></span>
                    <?php echo form_error('psg_no_telp', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                  </div>
                </div>
                <!-- /pk-domisili-serumah -->
              </div>
              <!-- #/input-kepala-keluarga -->
              <div id="pasangan-out"></div>
              <!-- #/input-pasangan -->
              <div id="tombol-tambah-pasangan" class="row">
                <div class="form-group">
                  <div class="col-md-4">
                    <button type="button" id="add-pasangan" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data Pasangan</button>
                  </div>
                </div>
              </div>
              <!-- #/tombol-tambah-pasangan -->
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-danger">Batal</button>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /data-perkawinan -->
      <div class="col-md-12">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">IV. Anggota Keluarga</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
          <form role="form" action="<?php echo base_url(); ?>simpan-anggota-keluarga" method="post">
            <input type="hidden" name="id_kk" value="<?php echo $id_kk['data'][0]['id_kk']; ?>" required>
            <div class="box-body">
              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>Perhatian</h4>
                <p>Jika keluarga tidak memiliki anggota keluarga selain suami dan istri, pengisian data anggota keluarga dapat dilewati</p>
              </div>
              <div class="callout callout-warning">
                <h4>Perhatian</h4>
                <p>Cukup masukkan data anggota keluarga <strong>selain</strong> kepala keluarga dan pasangan</p>
              </div>
              <?php echo form_error('id_kk'); ?>
              <?php echo form_error('ak_no_bpjs[]'); ?>
              <?php echo form_error('ak_hubungan_keluarga[]'); ?>
              <?php echo form_error('ak_domisili_serumah[]'); ?>
              <!-- ./callout -->
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Anggota Keluarga</label>
                    <select name="ak_no_bpjs[]" class="form-control select2" style="width: 100%;" required>
                      <option value="" selected disabled>Pilih Opsi</option>
                      <?php foreach($pasien['data'] as $ar_pasien): ?>
                      <option value="<?php echo $ar_pasien['no_bpjs']; ?>"><?php echo ucwords($ar_pasien['nama']);  ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Hubungan Keluarga</label>
                    <select name="ak_hubungan_keluarga[]" class="form-control" onchange="perkawinan_out(this, $(this).parent().parent().parent().parent().parent().children('[name=id_kk]').val())" required>
                      <option value="" selected disabled>Pilih Opsi</option>
                      <option value="3">Anak</option>
                      <option value="4">Anggota Keluarga Lain</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="control-label">Domisili Serumah</label>
                    <select name="ak_domisili_serumah[]" class="form-control" required>
                      <option value="" selected disabled <?php echo set_select('ak_domisili_serumah[]', '', TRUE); ?>>Pilih Opsi</option>
                      <option value="1" <?php echo set_select('ak_domisili_serumah[]', '1'); ?>>Ya</option>
                      <option value="0" <?php echo set_select('ak_domisili_serumah[]', '0'); ?>>Tidak</option>
                      <option value="2" <?php echo set_select('ak_domisili_serumah[]', '2'); ?>>Kadang-Kadang</option>
                    </select>
                  </div>
                </div>
                <div class="perkawinan-ke-out"></div>
                <!-- ./perkawinan-ke-out -->
              </div>
              <!-- #/ak-anggota-keluarga -->
              <div id="anggota-keluarga-out"></div>
              <!-- #/anggota-keluarga-out -->
              <div id="tombol-tambah-keluarga" class="row">
                <div class="form-group">
                  <div class="col-md-4">
                    <button type="button" id="add-anggota-keluarga" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data Anggota Keluarga</button>
                  </div>
                </div>
              </div>
              <!-- #/tombol-tambah-keluarga -->
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-danger">Batal</button>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /anggota keluarga -->
      <div class="col-md-12">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">V. Ekonomi</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
          <form class="form-horizontal" action="<?php echo base_url(); ?>simpan-ekonomi" method="post">
            <input type="hidden" name="id_kk" value="<?php echo $id_kk['data'][0]['id_kk']; ?>" required>
            <div class="box-body">
              <?php echo form_error('id_kk', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>'); ?>
              <div class="form-group">
                <label for="input-eko-luas-bangunan" class="col-sm-3 control-label">Luas Bangunan</label>

                <div class="col-md-2">
                  <input type="number" name="luas_bangunan" step="0.1" class="form-control" id="input-eko-luas-bangunan" min="1" value="<?php echo set_value('luas_bangunan'); ?>" required>
                  <span class="help-block"><small>dalam m<sup>2</sup></small></span>
                  <?php echo form_error('luas_bangunan'); ?>
                </div>
              </div>
              <!-- /luas-bangunan -->
              <div class="form-group">
                <label for="input-eko-luas-lahan" class="col-sm-3 control-label">Luas Lahan</label>

                <div class="col-md-2">
                  <input type="number" name="luas_lahan" step="0.1" min="1" class="form-control" id="input-eko-luas-lahan" value="<?php echo set_value('luas_lahan'); ?>" onkeyup="set_min_luas_bangunan(this)" required>
                  <span class="help-block"><small>dalam m<sup>2</sup></small></span>
                  <?php echo form_error('luas_lahan'); ?>
                </div>
              </div>
              <!-- /luas-lahan -->
              <div class="form-group">
                <label for="input-eko-kepemilikan-rumah" class="col-sm-3 control-label">Kepemilikan Rumah</label>

                <div class="col-md-2">
                  <select name="kepemilikan_rumah" id="" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('kepemilikan_rumah', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('kepemilikan_rumah', '1'); ?>>Kontrak</option>
                    <option value="2" <?php echo set_select('kepemilikan_rumah', '2'); ?>>Kost</option>
                    <option value="3" <?php echo set_select('kepemilikan_rumah', '3'); ?>>Pribadi</option>
                    <option value="4" <?php echo set_select('kepemilikan_rumah', '4'); ?>>Orang Tua</option>
                  </select>
                  <?php echo form_error('kepemilikan_rumah'); ?>
                </div>
              </div>
              <!-- /kepemilikan-rumah -->
              <div class="form-group">
                <label for="input-eko-daya-listrik" class="col-sm-3 control-label">Daya Listrik</label>

                <div class="col-md-2">
                  <select name="daya_listrik" id="input-eko-daya-listrik" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('daya_listrik', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="450" <?php echo set_select('daya_listrik', '450'); ?>>450 W</option>
                    <option value="900" <?php echo set_select('daya_listrik', '900'); ?>>900 W</option>
                    <option value="1300" <?php echo set_select('daya_listrik', '1300'); ?>>1.300 W</option>
                    <option value="2000" <?php echo set_select('daya_listrik', '2000'); ?>>Lebih dari 1.300 W</option>
                  </select>
                  <?php echo form_error('daya_listrik'); ?>
                </div>
              </div>
              <!-- /daya-listrik -->
              <div class="form-group">
                <label for="input-eko-sumber-ekonomi" class="col-sm-3 control-label">Sumber Ekonomi</label>

                <div class="col-md-5">
                  <label style="margin-right: 20px !important;"><input type="radio" name="sumber_ekonomi" value="1" <?php echo set_radio('sumber_ekonomi', '1'); ?> required>&nbsp;Gaji Pegawai</label>
                  <label><input type="radio" name="sumber_ekonomi" value="0" <?php echo set_radio('sumber_ekonomi', '0'); ?> required>&nbsp;Usaha Lainnya</label>
                  <?php echo form_error('sumber_ekonomi'); ?>
                </div>
              </div>
              <!-- /sumber-ekonomi -->
              <div class="form-group">
                <label for="input-eko-penopang-ekonomi" class="col-sm-3 control-label">Penopang Ekonomi</label>

                <div class="col-md-4">
                  <select name="penopang_ekonomi" id="input-eko-penopang-ekonomi" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('penopang_ekonomi', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('penopang_ekonomi', '1'); ?>>Suami atau Istri saja</option>
                    <option value="2" <?php echo set_select('penopang_ekonomi', '2'); ?>>Suami dan Istri</option>
                    <option value="3" <?php echo set_select('penopang_ekonomi', '3'); ?>>Suami, Istri &amp; Anak</option>
                    <option value="4" <?php echo set_select('penopang_ekonomi', '4'); ?>>Suami, Istri, Anak &amp; anggota keluarga lain</option>
                  </select>
                  <?php echo form_error('penopang_ekonomi'); ?>
                </div>
              </div>
              <!-- /penopang-ekonomi --> 
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-danger">Batal</button>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /ekonomi -->
      <div class="col-md-12">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">VI. Perilaku Kesehatan &amp; Keselamatan</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
          </div>

          <form action="<?php echo base_url(); ?>simpan-perilaku" method="post" class="form-horizontal">
            <input type="hidden" name="id_kk" value="<?php echo $id_kk['data'][0]['id_kk']; ?>" required>
            <div class="box-body">
              <?php echo form_error('sumber_air_lain', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4>Kesalahan Pengisian Data</h4>', '</div>'); ?>
              <div class="form-group">
                <label for="input-pkes-layanan-balita" class="col-sm-3 control-label">Pelayanan promotif/preventif bayi dan balita</label>

                <div class="col-md-5">
                  <select name="layanan_balita" id="input-pkes-layanan-balita" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('layanan_balita', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('layanan_balita', '1'); ?>>Dokter Praktek Umum</option>
                    <option value="2" <?php echo set_select('layanan_balita', '2'); ?>>Puskesmas</option>
                    <option value="3" <?php echo set_select('layanan_balita', '3'); ?>>Perawat/Bidan</option>
                    <option value="4" <?php echo set_select('layanan_balita', '4'); ?>>Rumah Sakit/Spesialis</option>
                    <option value="5" <?php echo set_select('layanan_balita', '5'); ?>>Lain</option>
                  </select>
                  <?php echo form_error('layanan_balita'); ?>
                </div>
              </div>
              <!-- /layanan-balita -->
              <div class="form-group">
                <label for="input-pkes-pemeliharaan_kes_kel" class="col-sm-3 control-label">Pemeliharaan Kesehatan Anggota Keluarga</label>

                <div class="col-md-5">
                  <select name="pemeliharaan_kes_kel" id="input-pkes-pemeliharaan-kes-kel" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('pemeliharaan_kes_kel', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('pemeliharaan_kes_kel', '1'); ?>>Dokter Praktek Umum</option>
                    <option value="2" <?php echo set_select('pemeliharaan_kes_kel', '2'); ?>>Puskesmas</option>
                    <option value="3" <?php echo set_select('pemeliharaan_kes_kel', '3'); ?>>Perawat/Bidan</option>
                    <option value="4" <?php echo set_select('pemeliharaan_kes_kel', '4'); ?>>Rumah Sakit/Spesialis</option>
                    <option value="5" <?php echo set_select('pemeliharaan_kes_kel', '5'); ?>>Lain</option>
                  </select>
                  <?php echo form_error('pemeliharaan_kes_kel'); ?>
                </div>
              </div>
              <!-- /pemeliharaan_kes_kel -->
              <div class="form-group">
                <label for="input-pkes-layanan-pengobatan-diri" class="col-sm-3 control-label">Pelayanan Pengobatan Diri Sendiri</label>

                <div class="col-md-5">
                  <select name="layanan_pengobatan_diri" id="input-pkes-layanan-pengobatan-diri" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('layanan_pengobatan_diri', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('layanan_pengobatan_diri', '1'); ?>>Dokter Praktek Umum</option>
                    <option value="2" <?php echo set_select('layanan_pengobatan_diri', '2'); ?>>Puskesmas</option>
                    <option value="3" <?php echo set_select('layanan_pengobatan_diri', '3'); ?>>Perawat/Bidan</option>
                    <option value="4" <?php echo set_select('layanan_pengobatan_diri', '4'); ?>>Rumah Sakit/Spesialis</option>
                    <option value="5" <?php echo set_select('layanan_pengobatan_diri', '5'); ?>>Lain</option>
                  </select>
                  <?php echo form_error('layanan_pengobatan_diri'); ?>
                </div>
              </div>
              <!-- /layanan-pengobatan-diri -->
              <div class="form-group">
                <label for="input-pkes-jamkes-pri-kel" class="col-sm-3 control-label">Jaminan Pemeliharaan Kesehatan untuk Diri Sendiri &amp; Keluarga</label>

                <div class="col-md-5">
                  <select name="jamkes_pri_kel" id="input-pkes-jamkes-pri-kel" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('jamkes_pri_kel', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('jamkes_pri_kel', '1'); ?>>Asuransi Swasta</option>
                    <option value="2" <?php echo set_select('jamkes_pri_kel', '2'); ?>>BPJS</option>
                    <option value="3" <?php echo set_select('jamkes_pri_kel', '3'); ?>>Institusi</option>
                    <option value="0" <?php echo set_select('jamkes_pri_kel', '0'); ?>>Tidak Punya</option>
                  </select>
                  <?php echo form_error('jamkes_pri_kel'); ?>
                </div>
              </div>
              <!-- /jamkes-pri-kel -->
              <div class="form-group">
                <label for="input-pkes-sumber-air" class="col-sm-3 control-label">Sumber Air Minum Dirumah Tinggal</label>

                <div class="col-md-5">
                  <select name="sumber_air" id="input-pkes-sumber-air" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('sumber_air', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('sumber_air', '1'); ?>>Air sumur gali</option>
                    <option value="2" <?php echo set_select('sumber_air', '2'); ?>>Air sumur pompa</option>
                    <option value="3" <?php echo set_select('sumber_air', '3'); ?>>PDAM</option>
                    <option value="4" <?php echo set_select('sumber_air', '4'); ?>>Sungai</option>
                    <option value="5" <?php echo set_select('sumber_air', '5'); ?>>Lain</option>
                  </select>
                  <?php echo form_error('sumber_air'); ?>
                </div>
              </div>
              <div id="sumber-air-lain" style="display: none">
                <div class="form-group">
                  <label for="input-pkes-sebutkan" class="col-sm-3 control-label"></label>

                  <div class="col-md-3">
                    <input type="text" name="sumber_air_lain" class="form-control" id="input-pkes-sebutkan" placeholder="Sebutkan" value="<?php echo set_value('sumber_air_lain'); ?>">
                  </div>
                </div>
              </div>
              <!-- #/sumber-air-lain -->
              <!-- /sumber-air -->
              <div class="form-group">
                <label for="input-pkes-kamar-mandi" class="col-sm-3 control-label">Fasilitas MCK Kamar Mandi</label>

                <div class="col-md-5" id="input-pkes-kamar-mandi">
                  <div class="radio">
                    <label>
                      <input type="radio" name="mck_km" value="1" <?php echo set_radio('mck_km', '1'); ?> required> Ada
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="mck_km" value="0" <?php echo set_radio('mck_km', '0'); ?> required> Tidak Ada
                    </label>
                  </div>
                </div>
                <?php echo form_error('mck_km'); ?>
              </div>
              <!-- /kamar-mandi -->
              <div class="form-group">
                <label for="input-pkes-wc" class="col-sm-3 control-label">Fasilitas MC WC</label>

                <div class="col-md-5" id="input-pkes-wc">
                  <div class="radio">
                    <label>
                      <input type="radio" name="mck_wc" value="1" <?php echo set_radio('mck_wc', '1'); ?> required> Kloset
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="mck_wc" value="0" <?php echo set_radio('mck_wc', '0'); ?> required> Lain
                    </label>
                  </div>
                </div>
                <?php echo form_error('mck_wc'); ?>
              </div>
              <!-- /wc -->
              <div class="form-group">
                <label for="input-pkes-cuci" class="col-sm-3 control-label">Fasilitas MCK Cuci Tersendiri</label>

                <div class="col-md-5" id="input-pkes-cuci">
                  <div class="radio">
                    <label>
                      <input type="radio" name="mck_cuci" value="1" <?php echo set_radio('mck_cuci', '1'); ?> required> Ya
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="mck_cuci" value="0" <?php echo set_radio('mck_cuci', '0'); ?> required> Tidak
                    </label>
                  </div>
                </div>
                <?php echo form_error('mck_cuci'); ?>
              </div>
              <!-- /cuci -->
              <div class="form-group">
                <label for="input-pkes-spal" class="col-sm-3 control-label">SPAL</label>

                <div class="col-md-5" id="input-pkes-spal">
                  <div class="radio">
                    <label>
                      <input type="radio" name="spal" value="tertutup" <?php echo set_radio('spal', 'tertutup'); ?> required> Saluran Limbah Tertutup
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="spal" value="terbuka" <?php echo set_radio('spal', 'terbuka'); ?> required> Saluran Terbuka
                    </label>
                  </div>
                </div>
                <?php echo form_error('spal'); ?>
              </div>
              <!-- /spal -->
              <div class="form-group">
                <label for="input-pkes-kasur-busa" class="col-sm-3 control-label">Penggunaan Kasur Busa</label>

                <div class="col-md-3">
                  <select name="kasur_busa" id="input-pkes-kasur-busa" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('kasur_busa', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('kasur_busa', '1'); ?>>Ya</option>
                    <option value="0" <?php echo set_select('kasur_busa', '0'); ?>>Tidak</option>
                    <option value="2" <?php echo set_select('kasur_busa', '2'); ?>>Tidak Tahu</option>
                  </select>
                  <?php echo form_error('kasur_busa'); ?>
                </div>
              </div>
              <!-- /kasur-busa -->
              <div class="form-group">
                <label for="input-pkes-kosmetik" class="col-sm-3 control-label">Penggunaan Kosmetik atau Obat Luar</label>

                <div class="col-md-5">
                  <select name="kosmetik_obat_luar" id="input-pkes-kosmetik" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('kosmetik_obat_luar', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="0" <?php echo set_select('kosmetik_obat_luar', '0'); ?>>Tidak Pernah</option>
                    <option value="1" <?php echo set_select('kosmetik_obat_luar', '1'); ?>>Hand &amp; Body Lotion</option>
                    <option value="2" <?php echo set_select('kosmetik_obat_luar', '2'); ?>>Obat gosok</option>
                    <option value="3" <?php echo set_select('kosmetik_obat_luar', '3'); ?>>Obat nyamuk oles</option>
                    <option value="4" <?php echo set_select('kosmetik_obat_luar', '4'); ?>>Lainnya</option>
                  </select>
                  <?php echo form_error('kosmetik_obat_luar'); ?>
                </div>
              </div>
              <!-- /kosmetik -->
              <div class="form-group">
                <label for="input-pkes-sepeda-motor" class="col-sm-3 control-label">Penggunaan Sepeda atau Sepeda Motor</label>

                <div class="col-md-5">
                  <select name="pengguna_sepeda_motor" id="input-pkes-sepeda-motor" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('pengguna_sepeda_motor', '', TRUE); ?>>Pilih Opsi</option>
                    <option value="1" <?php echo set_select('pengguna_sepeda_motor', '1'); ?>>Ya</option>
                    <option value="0" <?php echo set_select('pengguna_sepeda_motor', '0'); ?>>Tidak</option>
                    <option value="2" <?php echo set_select('pengguna_sepeda_motor', '2'); ?>>Kadang-Kadang</option>
                  </select>
                  <span class="help-block"><small>Oleh salah satu atau seluruh anggota keluarga</small></span>
                  <?php echo form_error('pengguna_sepeda_motor'); ?>
                </div>
              </div>
              <!-- /sepeda-motor -->
              <div class="form-group">
                <label for="input-pkes-manula-sendirian" class="col-sm-3 control-label">Apakah ada manula yang ditinggal sendirian di rumah?</label>

                <div class="col-md-5">
                  <select name="manula_sendirian" id="input-pkes-manula-sendirian" class="form-control" required>
                    <option value="" selected disabled <?php echo set_select('manula_sendirian', '', TRUE); ?>>Pilih opsi</option>
                    <option value="1" <?php echo set_select('manula_sendirian', '1'); ?>>Ya</option>
                    <option value="0" <?php echo set_select('manula_sendirian', '0'); ?>>Tidak</option>
                    <option value="2" <?php echo set_select('manula_sendirian', '2'); ?>>Kadang-Kadang</option>
                  </select>
                  <?php echo form_error('manula_sendirian'); ?>
                </div>
              </div>
              <!-- /manula-sendirian -->
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-danger">Batal</button>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /perilaku kesehatan -->
      <div class="col-md-12">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">VII. Riwayat Kesehatan</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
          <form role="form" action="<?php echo base_url(); ?>simpan-riwayat-kes" method="post">
            <input type="hidden" name="id_kk" value="<?php echo $id_kk['data'][0]['id_kk']; ?>" required>
            <div class="box-body">
              <?php echo form_error('sb_no_bpjs[]'); ?>
              <?php echo form_error('sb_jenis_penyakit[]'); ?>
              <?php echo form_error('tb_no_bpjs[]'); ?>
              <?php echo form_error('tb_jenis_penyakit[]'); ?>
              <?php echo form_error('st_no_bpjs[]'); ?>
              <?php echo form_error('st_jenis_penyakit[]'); ?>
              <?php echo form_error('batuk_no_bpjs[]'); ?>
              <?php echo form_error('asma_no_bpjs[]'); ?>
              <?php echo form_error('maskes_no_bpjs[]'); ?>
              <?php echo form_error('masalah_kes[]'); ?>
              <?php echo form_error('masket_no_bpjs[]'); ?>
              <?php echo form_error('jenis_masalah_keturunan[]'); ?>
              <?php echo form_error('jenis_sakit_keras[]'); ?>
              <?php echo form_error('tahun_sakit[]'); ?>
              <?php echo form_error('jenis_kecelakaan_kerja[]'); ?>
              <?php echo form_error('tahun_kejadian[]'); ?>
              <?php echo form_error('jenis_kelainan[]'); ?>
              <?php echo form_error('durasi_perawatan[]'); ?>
              <?php echo form_error('durasi_merokok'); ?>
              <?php echo form_error('durasi_berhenti'); ?>
              <?php echo form_error('batang_per_hari'); ?>
              <?php echo form_error('kretek_filter'); ?>
              <?php echo form_error('jenis_jamu'); ?>
              <?php echo form_error('jamu_per_minggu'); ?>
              <?php echo form_error('durasi'); ?>
              <?php echo form_error('gelas_per_hari'); ?>
              <?php echo form_error('jenis_obat[]'); ?>
              <?php echo form_error('jenis_olahraga[]'); ?>
              <?php echo form_error('jumlah_per_minggu[]'); ?>
              <?php echo form_error('olahraga_keluarga[]'); ?>
              <div id="label-riw-1-bulan" class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Riwayat Penyakit, Kecelakaan, Kematian pada Anggota Keluarga 1 (Satu) Bulan yang Lalu</label>
                  </div>
                </div>
              </div>
              <!-- #/label-riw-1-bulan -->
              <div id="riw-1-bulan"></div>
              <!-- #/riw-1-bulan -->
              <div id="tombol-tambah-pasien-1-bulan" class="row">
                <div class="form-group">
                  <div class="col-md-4">
                    <button type="button" id="add-riw-1-bulan" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data Anggota Keluarga</button>
                  </div>
                </div>
              </div>
              <!-- RIWAYAT 1 BULAN -->

              <div id="label-riw-3-bulan" class="row" style="margin-top: 20px">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Riwayat Penyakit, Kecelakaan, Kematian pada Anggota Keluarga 3 (Tiga) Bulan yang Lalu</label>
                  </div>
                </div>
              </div>
              <!-- #/label-riw-3-bulan -->
              <div id="riw-3-bulan"></div>
              <!-- #/riw-3-bulan -->
              <div id="tombol-tambah-pasien-3-bulan" class="row">
                <div class="form-group">
                  <div class="col-md-4">
                    <button type="button" id="add-riw-3-bulan" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data Anggota Keluarga</button>
                  </div>
                </div>
              </div>
              <!-- RIWAYAT 3 BULAN -->

              <div id="label-riw-1-tahun" class="row" style="margin-top: 20px">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Riwayat Penyakit, Kecelakaan, Kematian pada Anggota Keluarga 1 (Satu) Tahun yang Lalu</label>
                  </div>
                </div>
              </div>
              <!-- #/label-riw-1-tahun -->
              <div id="riw-1-tahun"></div>
              <!-- #/riw-1-tahun -->
              <div id="tombol-tambah-pasien-1-tahun" class="row" style="margin-bottom: 20px !important">
                <div class="form-group">
                  <div class="col-md-4">
                    <button type="button" id="add-riw-1-tahun" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data Anggota Keluarga</button>
                  </div>
                </div>
              </div>
              <!-- RIWAYAT 1 TAHUN -->

              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah dalam keluarga yang tinggal serumah pernah sakit batuk lebih dari 2 minggu dalam 3 bulan terakhir?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="batuk" value="1" <?php echo set_radio('batuk', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="batuk" value="0" <?php echo set_radio('batuk', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('batuk', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="batuk-out"></div>
                <!-- #/batuk-out -->
                <div id="tombol-add-batuk" style="display: none"></div>
                <!-- #/tombol-add-batuk -->
              </div>
              <!-- /riwayat-batuk -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah ada anggota keluarga yang memiliki penyakit asma atau sesak nafas?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="asma" value="1" <?php echo set_radio('asma', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="asma" value="0" <?php echo set_radio('asma', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('asma', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="asma-out"></div>
                <!-- #/asma-out -->
                <div id="tombol-add-asma" style="display: none"></div>
                <!-- #/tombol-add-asma -->
              </div>
              <!-- /riwayat-asma -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah ada anggota keluarga yang mengalami masalah kesehatan?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="masalah_kesehatan" value="1" <?php echo set_radio('masalah_kesehatan', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="masalah_kesehatan" value="0" <?php echo set_radio('masalah_kesehatan', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('masalah_kesehatan', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="maskes-out"></div>
                <!-- #/maskes-out -->
                <div id="tombol-add-maskes" style="display: none"></div>
                <!-- #/tombol-add-masket -->
              </div>
              <!-- /riwayat-maskes -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah ada anggota keluarga yang mengalami masalah kesehatan keturunan atau penyakit khusus?
                  <span class="help-block">Seperti diabetes, stroke, sakit jantung, darah tinggi, asam urat, kencing manis, kegemukan, atau tumor.</span>
                </label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="masalah_keturunan" value="1" <?php echo set_radio('masalah_keturunan', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="masalah_keturunan" value="0" <?php echo set_radio('masalah_keturunan', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('masalah_keturunan', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="masket-out"></div>
                <!-- #/masket-out -->
                <div id="tombol-add-masket" style="display: none"></div>
                <!-- #/tombol-add-masket -->
              </div>
              <!-- /riwayat-masket -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah kepala keluarga pernah mengalami sakit keras?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="sakit_keras" value="1" <?php echo set_radio('sakit_keras', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="sakit_keras" value="0" <?php echo set_radio('sakit_keras', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('sakit_keras', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="sakit-keras-out"></div>
                <!-- #/sakit-keras-out -->
                <div id="tombol-add-sakit-keras" style="display: none"></div>
                <!-- #/tombol-add-sakit-keras -->
              </div>
              <!-- /riwayat-sakit-keras -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah kepala keluarga pernah mengalami kecelakaan kerja?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="kecelakaan_kerja" value="1" <?php echo set_radio('kecelakaan_kerja', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="kecelakaan_kerja" value="0" <?php echo set_radio('kecelakaan_kerja', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('kecelakaan_kerja', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="kecelakaan-kerja-out"></div>
                <!-- #/kecelakaan-kerja-out -->
                <div id="tombol-add-kecelakaan-kerja"></div>
                <!-- #/tombol-add-kecelakaan-kerja -->
              </div>
              <!-- /riwayat-kecelakaan-kerja -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah kepala keluarga adalah perokok?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="merokok" value="1" <?php echo set_radio('merokok', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="merokok" value="2" <?php echo set_radio('merokok', '2'); ?> required>&nbsp;Kadang-Kadang
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="merokok" value="3" <?php echo set_radio('merokok', '3'); ?> required>&nbsp;Sudah Berhenti
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="merokok" value="0" <?php echo set_radio('merokok', '0'); ?> required>&nbsp;Tidak Pernah
                  </label>
                  <?php echo form_error('merokok', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="merokok-out" style="display: none"></div>
                <!-- #/merokok-out -->
              </div>
              <!-- /riwayat-merokok -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah kepala keluarga mengonsumsi jamu?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="jamu" value="1" <?php echo set_radio('jamu', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="jamu" value="2" <?php echo set_radio('jamu', '2'); ?> required>&nbsp;Kadang-Kadang
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="jamu" value="0" <?php echo set_radio('jamu', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('jamu', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="jamu-out"></div>
                <!-- #/jamu-out -->
                <div id="tombol-add-jamu" style="display: none"></div>
                <!-- #/tombol-add-jamu -->
              </div>
              <!-- /riwayat-jamu -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah kepala keluarga mengonsumsi alkohol?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="alkohol" value="1" <?php echo set_radio('alkohol', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="alkohol" value="2" <?php echo set_radio('alkohol', '2'); ?> required>&nbsp;Kadang-Kadang
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="alkohol" value="0" <?php echo set_radio('alkohol', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('alkohol', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="alkohol-out" class="row" style="display: none"></div>
                <!-- #/alkohol-out -->
              </div>
              <!-- /riwayat-alkohol -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah kepala keluarga mengonsumsi kopi?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="kopi" value="1" <?php echo set_radio('kopi', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="kopi" value="2" <?php echo set_radio('kopi', '2'); ?> required>&nbsp;Kadang-Kadang
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="kopi" value="0" <?php echo set_radio('kopi', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('kopi', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="kopi-out" class="row" style="display: none"></div>
                <!-- #/kopi-out -->
              </div>
              <!-- /riwayat-kopi -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah kepala keluarga saat ini mengonsumsi obat-obatan?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="obat" value="1" <?php echo set_radio('obat', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="obat" value="0" <?php echo set_radio('obat', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('obat', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="obat-out"></div>
                <!-- #/obat-out -->
                <div id="tombol-add-obat" style="display: none"></div>
                <!-- #/tombol-add-obat -->
              </div>
              <!-- /riwayat-obat -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah kepala keluarga mengonsumsi minuman dingin?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="m_dingin" value="1" <?php echo set_radio('m_dingin', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="m_dingin" value="2" <?php echo set_radio('m_dingin', '2'); ?> required>&nbsp;Kadang-Kadang
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="m_dingin" value="0" <?php echo set_radio('m_dingin', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('m_dingin', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
              </div>
              <!-- /riwayat-minuman-dingin -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah keluarga memelihara ayam atau burung atau kambing atau sapi di dekat rumah?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="peliharaan" value="1" <?php echo set_radio('peliharaan', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="peliharaan" value="0" <?php echo set_radio('peliharaan', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('peliharaan', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
              </div>
              <!-- /riwayat-peliharaan -->
              <div class="form-group">
                <label class="col-sm-12 control-label">Apakah kepala keluarga rutin olahraga?</label>
                <div class="col-md-12">
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="olahraga" value="1" <?php echo set_radio('olahraga', '1'); ?> required>&nbsp;Ya
                  </label>
                  <label style="margin-right: 20px !important">
                    <input type="radio" name="olahraga" value="0" <?php echo set_radio('olahraga', '0'); ?> required>&nbsp;Tidak
                  </label>
                  <?php echo form_error('olahraga', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                </div>
                <div id="olahraga-out"></div>
                <!-- #/olahraga-out -->
                <div id="tombol-add-olahraga" style="display: none"></div>
                <!-- #/tombol-add-olahraga -->
              </div>
              <!-- /riwayat-olahraga -->
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-danger">Batal</button>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /riwayat kesehatan -->
      <div class="col-md-12">
        <div class="box box-primary box-solid collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">VIII. Kuesioner Perhitungan Tingkat Stres</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
          </div>

          <form role="form" action="<?php echo base_url(); ?>simpan-gejala-stres" method="post">
            <input type="hidden" name="id_kk" value="<?php echo $id_kk['data'][0]['id_kk']; ?>" required>
            <div class="box-body table-responsive">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>No.</th>
                    <th style="width: 70%">Komponen Pertanyaan</th>
                    <th>Skor</th>
                  </tr>
                  <!-- /head -->
                  <tr>
                    <td>1</td>
                    <td>Penurunan daya tangkap / konsentrasi / ingatan / penyampaian pikiran / banyak berpikir yang tidak perlu</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_01" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_01" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_01" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_01" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_01" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_01'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Sulit tidur, tidak nyenyak, mudah terbangun, bangun terlalu cepat, mimpi buruk, bingung</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_02" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_02" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_02" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_02" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_02" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_02'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Khawatir berlebihan akan diri sendiri dan orang lain, sempoyongan, pingsan</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_03" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_03" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_03" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_03" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_03" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_03'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Telinga berdenging, pandangan kabur atau buram, kulit terasa panas/dingin/ditusuk, pusing berputar</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_04" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_04" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_04" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_04" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_04" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_04'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Gangguan fungsi seksual</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_05" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_05" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_05" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_05" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_05" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_05'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Hilang semangat/gairah, malas, letih, lesu, lamban, menyendiri, putus asa, ingin mati</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_06" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_06" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_06" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_06" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_06" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_06'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>7</td>
                    <td>Mudah tersinggung/marah/membentak/curiga/dendam, ngotot, terlalu penasaran, kesal, benci</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_07" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_07" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_07" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_07" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_07" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_07'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td>Tegang, gelisah, gugup, gagap, gemetar, berdebar, mondar-mandir, resah, terlalu aktif</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_08" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_08" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_08" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_08" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_08" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_08'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td>Ingin melakukan sesuatu berulang kali, serba sangat teratur, cenderung mengatur dan menghindar</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_09" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_09" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_09" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_09" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_09" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_09'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>10</td>
                    <td>Nyeri kepala, kaku kuduk/bahu, kesemutan, kejang, gerakan beruang <i>(tic)</i>, goyang-goyang kaki/tangan, gigi gemeratak saat tidur <i>(bruxism)</i></td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_10" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_10" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_10" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_10" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_10" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_10'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>11</td>
                    <td>Sedih, menangis, murung, mengeluh, rasa bersalah, kecewa, terlalu gembira</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_11" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_11" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_11" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_11" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_11" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_11'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td>Cemas, takut terhadap gelap/sendiri/kendaraan/binatang/ketinggian/sesuatu yang asing</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_12" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_12" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_12" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_12" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_12" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_12'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>13</td>
                    <td>Dada terasa panas/tertekan/sesak, nafas dangkal/cepat/panjang, kering di mulut/tenggorokan, sulit menelan, perut nyeri/kembung/bunyi, mual, muntah, mencret, sulit buang air besar</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_13" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_13" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_13" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_13" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_13" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_13'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>14</td>
                    <td>Banyak kencing, sulit ditahan, datang bulan tidak teratur, keringat banyak/dingin/telapak berkeringat</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_14" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_14" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_14" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_14" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_14" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_14'); ?>
                    </td>
                  </tr>
                  <tr>
                    <td>15</td>
                    <td>Nafsu makan berkurang/berlebihan, perubahan berat badan yang cepat menjadi kurus/gemuk</td>
                    <td>
                      <div class="radio">
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_15" value="0" required> 0
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_15" value="1" required> 1
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_15" value="2" required> 2
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_15" value="3" required> 3
                        </label>
                        <label style="margin-right: 20px !important;">
                          <input type="radio" name="no_15" value="4" required> 4
                        </label>
                      </div>
                      <?php echo form_error('no_15'); ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="box-footer">
              <button type="reset" class="btn btn-danger">Batal</button>
              <button type="submit" class="btn btn-primary pull-right">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /kuesioner-stres -->
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<script type="text/javascript">
  function set_min_luas_bangunan(selector){
    var mlb = $(selector).val();
    if ( ! isNaN(mlb)) {
      var target = $('[name=luas_bangunan]').attr('max', mlb);
    }
  }

  function set_kk_pasangan(selector) {
    var hubkelkk = $(selector).find(':selected');
    if ( ! isNaN($('.kk-input-pasangan').val()) || $('.kk-input-pasangan').val() === '') {
      if (hubkelkk.val() === '1') {
        $('.kk-input-pasangan').val(2);
        $('.kk-pasangan').val('2').attr('selected', true);
      }
      if (hubkelkk.val() === '2') {
        $('.kk-input-pasangan').val(1);
        $('.kk-pasangan').val('1').attr('selected', true);
      }
    }
  }

  function titleCase(str) {
    str = str.toLowerCase().split(' ');                // will split the string delimited by space into an array of words

    for(var i = 0; i < str.length; i++){               // str.length holds the number of occurrences of the array...
        str[i] = str[i].split('');                    // splits the array occurrence into an array of letters
        str[i][0] = str[i][0].toUpperCase();          // converts the first occurrence of the array to uppercase
        str[i] = str[i].join('');                     // converts the array of letters back into a word.
    }
    return str.join(' ');                              //  converts the array of words back to a sentence.
  }

  function get_ak(id_kk, ret_data){
    var ak = $.ajax({
      url: './../../data_dasar/C_data_dasar/show_anggota_keluarga',
      type: 'POST',
      dataType: 'json',
      data: {id_kk: id_kk},
      success: function(data){
        var ret_val = $.map(data['data'], function(index, value){
          return '<option value="' + index.no_bpjs + '">' + titleCase(index.nama) + '</option>'; 
        });
        ret_data(ret_val);
      }
    });
  }

  function ret_data(ret_val){
    return ret_val;
  }
</script>