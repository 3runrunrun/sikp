<section class="content-header">
  <h1>
    Pasien
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i>&nbsp;Arsip Poliklinik</li>
    <li><i class="fa fa-book"></i> Pasien</li>
    <li><a href="<?php echo base_url(); ?>lihat-data-pasien-bpjs"><i class="fa fa-database"></i> Daftar Pasien BPJS</a></li>
    <li class="active">Formulir Pasien BPJS</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- SELECT2 EXAMPLE -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Formulir Pasien BPJS</h3>
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
            <h3 class="box-title">I. Data Pasien</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
          </div>

          <form action="<?php echo base_url(); ?>simpan-pasien-bpjs" method="post" class="form-horizontal">
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
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>