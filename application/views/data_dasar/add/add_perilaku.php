<section class="content-header">
  <h1>
    Data Dasar Kesehatan Keluarga
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-book"></i> Data Dasar</li>
    <li><a href="<?php echo base_url(); ?>lihat-data-dasar"><i class="fa fa-database"></i> Data Dasar Kesehatan Keluarga</a></li>
    <li><a href="<?php echo base_url(); ?>detail-data-dasar/<?php echo $id_kk; ?>"><i class="fa fa-eye"></i>&nbsp;Detail Data Dasar Kesehatan Keluarga</a></li>
    <li class="active">Formulir Data Perilaku Kesehatan dan Keselamatan</li>
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
      {alert_vars}
      <div class="col-md-12">
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Perilaku Kesehatan &amp; Keselamatan</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>

          <form action="<?php echo base_url(); ?>simpan-perilaku" method="post" class="form-horizontal">
            <input type="hidden" name="id_kk" value="<?php echo $id_kk; ?>">
            <input type="hidden" name="is_add" value="yes">
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
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>