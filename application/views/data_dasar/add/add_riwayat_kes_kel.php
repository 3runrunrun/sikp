<section class="content-header">
  <h1>
    Data Dasar Kesehatan Keluarga
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-book"></i> Data Dasar</li>
    <li><a href="<?php echo base_url(); ?>lihat-data-dasar"><i class="fa fa-database"></i> Data Dasar Kesehatan Keluarga</a></li>
    <li><a href="<?php echo base_url(); ?>detail-data-dasar/<?php echo $id_kk; ?>"><i class="fa fa-eye"></i>&nbsp;Detail Data Dasar Kesehatan Keluarga</a></li>
    <li class="active">Formulir Data Riwayat Kesehatan Keluarga</li>
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
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Riwayat Kesehatan</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <form role="form" action="<?php echo base_url(); ?>simpan-riwayat-kes" method="post">
            <input type="hidden" name="id_kk" value="<?php echo $id_kk; ?>">
            <input type="hidden" name="is_add" value="yes">
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
                    <select id="psg-kepala-keluarga" class="form-control" style="width: 100%;">
                      <option value="" selected disabled>Pilih Pasien</option>
                      <?php foreach($pasien['data'] as $ar_pasien): ?>
                      <option value="<?php echo $ar_pasien['no_bpjs']; ?>"><?php echo ucwords($ar_pasien['nama']);  ?></option>
                      <?php endforeach; ?>
                    </select>
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
                    <input type="radio" name="jamu" value="0" <?php echo set_radio('jamu', '0'); ?>>&nbsp;Tidak
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
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Kuesioner Perhitungan Tingkat Stres</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>

          <form role="form" action="<?php echo base_url(); ?>simpan-gejala-stres" method="post">
            <input type="hidden" name="id_kk" value="<?php echo $id_kk; ?>">
            <input type="hidden" name="is_add" value="yes">
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
  $(document).ready(function(){
    $('#psg-kepala-keluarga').hide();
  });
</script>