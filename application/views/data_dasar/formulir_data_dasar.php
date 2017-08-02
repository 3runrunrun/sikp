<section class="content-header">
        <h1>
          Data Dasar Kesehatan Keluarga
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>data-dasar-kesehatan"><i class="fa fa-book"></i> Data Dasar Kesehatan Keluarga</a></li>
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
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">I. Data Pasien</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>

                <form action="http://localhost/sikp/index.php/simpan-pasien-baru" method="POST" class="form-horizontal">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="input-kk-no-bpjs" class="col-sm-3 control-label">No. BPJS</label>

                      <div class="col-md-3">
                        <input type="text" class="form-control" name="no_bpjs" value="<?php echo set_value('no_bpjs'); ?>" id="input-kk-no-bpjs">
                        <?php echo form_error('no_bpjs'); ?>
                      </div>
                    </div>
                    <!-- /no-bpjs -->
                    <div class="form-group">
                      <label for="input-kk-nama" class="col-sm-3 control-label">Nama Lengkap</label>

                      <div class="col-md-5">
                        <input type="text" class="form-control" name="nama" value="<?php echo set_value('nama'); ?>" id="input-kk-nama">
                        <?php echo form_error('nama'); ?>
                      </div>
                    </div>
                    <!-- /nama -->
                    <div class="form-group">
                      <label for="input-kk-jenis-kelamin" class="col-sm-3 control-label">Jenis Kelamin</label>
                      
                      <div class="col-md-2">
                        <select type="text" name="jenis_kelamin" class="form-control" id="input-kk-jenis-kelamin">
                          <option value="" selected="selected">Jenis Kelamin</option>
                          <option value="p">Perempuan</option>
                          <option value="l">Laki-Laki</option>
                        </select>
                        <?php echo form_error('jenis_kelamin'); ?>
                      </div>
                    </div>
                    <!-- /jenis-kelamin -->
                    <div class="form-group">
                      <label for="datepicker" class="col-sm-3 control-label">Tanggal Lahir</label>

                      <div class="col-md-3 date">
                        <input type="text" name="tgl_lahir" value="<?php echo set_value('tgl_lahir'); ?>" class="form-control" id="datepicker">
                        <span class="help-block"><small>Format Tanggal: Bulan/Tanggal/Tahun</small></span>
                        <?php echo form_error('tgl_lahir'); ?>
                      </div>
                    </div>
                    <!-- /tgl-lahir -->
                    <div class="form-group">
                      <label for="input-kk-pekerjaan-utama" class="col-sm-3 control-label">Pekerjaan Utama</label>

                      <div class="col-md-5">
                        <input type="text" class="form-control" name="pekerjaan_utama" value="<?php echo set_value('pekerjaan_utama'); ?>" id="input-kk-pekerjaan-utama">
                        <?php echo form_error('pekerjaan_utama'); ?>
                      </div>
                    </div>
                    <!-- /pekerjaan-utama -->
                    <div class="form-group">
                      <label for="input-kk-pekerjaan-sampingan" class="col-sm-3 control-label">Pekerjaan Sampingan</label>

                      <div class="col-md-5">
                        <input type="text" class="form-control" name="pekerjaan_sampingan" value="<?php echo set_value('pekerjaan_sampingan'); ?>" id="input-kk-pekerjaan-sampingan">
                        <?php echo form_error('pekerjaan_sampingan'); ?>
                      </div>
                    </div>
                    <!-- /pekerjaan-sampingan -->
                    <div class="form-group">
                      <label for="input-kk-suku-bangsa" class="col-sm-3 control-label">Suku Bangsa</label>

                      <div class="col-md-3">
                        <input type="text" class="form-control" name="suku_bangsa" value="<?php echo set_value('suku_bangsa'); ?>" id="input-kk-suku-bangsa">
                        <?php echo form_error('suku_bangsa'); ?>
                      </div>
                    </div>
                    <!-- /suku-bangsa -->
                    <div class="form-group">
                      <label for="input-kk-agama" class="col-sm-3 control-label">Agama</label>

                      <div class="col-md-2">
                        <select name="agama" id="input-kk-agama" class="form-control">
                          <option value="" selected="selected">Agama</option>
                          <option value="budha">Budha</option>
                          <option value="hindu">Hindu</option>
                          <option value="islam">Islam</option>
                          <option value="katolik">Katolik</option>
                          <option value="kristen">Kristen</option>
                        </select>
                        <?php echo form_error('agama'); ?>
                      </div>
                    </div>
                    <!-- /agama -->
                    <div class="form-group">
                      <label for="input-kk-pendidikan-terakhir" class="col-sm-3 control-label">Pendidikan Terakhir</label>

                      <div class="col-md-3">
                        <select name="pendidikan_terakhir" id="input-kk-pendidikan-terakhir" class="form-control">
                          <option value="" selected="selected">Pendidikan Terakhir</option>
                          <option value="sd">SD/MI</option>
                          <option value="smp">SMP/MTs</option>
                          <option value="sma">SMA/MA/SMK</option>
                          <option value="diploma">Diploma</option>
                          <option value="sarjana">Sarjana</option>
                          <option value="magister">Magister</option>
                          <option value="doktor">Doktor</option>
                        </select>
                        <?php echo form_error('pendidikan_terakhir'); ?>
                      </div>
                    </div>
                    <!-- /pendidikan-terakhir -->
                    <div class="form-group">
                      <label for="input-kk-kelas-bpjs" class="col-sm-3 control-label">Kelas BPJS</label>

                      <div class="col-md-2">
                        <select name="kelas_bpjs" id="input-kk-kelas-bpjs" class="form-control">
                          <option value="" selected="selected">Kelas BPJS</option>
                          <option value="1">Kelas I</option>
                          <option value="2">Kelas II</option>
                          <option value="3">Kelas III</option>
                        </select>
                        <?php echo form_error('kelas_bpjs'); ?>
                      </div>
                    </div>
                    <!-- /kelas-bpjs -->
                    <div class="form-group">
                      <label for="input-kk-status-tagihan-bpjs" class="col-sm-3 control-label">Status Tagihan BPJS</label>

                      <div class="col-md-2">
                        <select name="status_tagihan_bpjs" id="input-kk-status-tagihan-bpjs" class="form-control">
                          <option value="" selected="selected">Status Tagihan</option>
                          <option value="0">Lunas</option>
                          <option value="1">Ada Tagihan</option>
                        </select>
                        <?php echo form_error('status_tagihan_bpjs'); ?>
                      </div>
                    </div>
                    <!-- /status-tagihan-bpjs -->
                    <div class="form-group">
                      <label for="input-kk-alamat" class="col-sm-3 control-label">Alamat</label>

                      <div class="col-md-5">
                        <textarea class="form-control" name="alamat" value="<?php echo set_value('alamat'); ?>" rows="3" ></textarea>
                        <?php echo form_error('alamat'); ?>
                      </div>
                    </div>
                    <!-- /alamat -->
                    <div class="form-group">
                      <label for="input-kk-provinsi" class="col-sm-3 control-label">Provinsi</label>

                      <div class="col-md-5">
                        <select name="id_provinsi" id="input-kk-provinsi" class="form-control select2" style="width: 100%">
                          <option value="" selected="selected">Provinsi</option>
                          <?php foreach($provinsi['data'] as $value): ?>
                          <option value="<?php echo $value['id_provinsi'] ?>"><?php echo $value['nama'] ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('id_provinsi'); ?>
                      </div>
                    </div>
                    <!-- /provinsi -->
                    <div class="form-group">
                      <label for="input-kk-kabupaten" class="col-sm-3 control-label">Kabupaten / Kota</label>

                      <div class="col-md-5">
                        <select name="id_kabupaten" id="input-kk-kabupaten" class="form-control select2" style="width: 100%">
                          <option value="" selected="selected">Kabupaten / Kota</option>
                          <?php foreach($kabupaten['data'] as $value): ?>
                          <option value="<?php echo $value['id_kabupaten'] ?>"><?php echo $value['nama'] ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('id_kabupaten'); ?>
                      </div>
                    </div>
                    <!-- /kabupaten -->
                    <div class="form-group">
                      <label for="input-kk-kecamatan" class="col-sm-3 control-label">Kecamatan</label>

                      <div class="col-md-5">
                        <select name="id_kecamatan" id="input-kk-kecamatan" class="form-control select2" style="width: 100%">
                          <option value="" selected="selected">Kecamatan</option>
                          <?php foreach($kecamatan['data'] as $value): ?>
                          <option value="<?php echo $value['id_kecamatan'] ?>"><?php echo $value['nama'] ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('id_kecamatan'); ?>
                      </div>
                    </div>
                    <!-- /kecamatan -->
                    <div class="form-group">
                      <label for="input-kk-kelurahan" class="col-sm-3 control-label">Kelurahan</label>

                      <div class="col-md-5">
                        <select name="id_kelurahan" id="input-kk-kelurahan" class="form-control select2" style="width: 100%">
                          <option value="" selected="selected">Kelurahan</option>
                          <?php foreach($kelurahan['data'] as $value): ?>
                          <option value="<?php echo $value['id_kelurahan'] ?>"><?php echo $value['nama'] ?></option>
                          <?php endforeach; ?>
                        </select>
                        <?php echo form_error('id_kelurahan'); ?>
                      </div>
                    </div>
                    <!-- /kelurahan -->
                    <div class="form-group">
                      <label for="input-kk-keterangan-hidup" class="col-sm-3 control-label">Keterangan Hidup</label>

                      <div class="col-md-2">
                        <select name="hidup" id="input-kk-keterangan-hidup" class="form-control">
                          <option value="" selected="selected">Keterangan Hidup</option>
                          <option value="1">Hidup</option>
                          <option value="0">Meninggal Dunia</option>
                        </select>
                        <?php echo form_error('hidup'); ?>
                      </div>
                    </div>
                    <!-- /keterangan-hidup -->
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger">Batal</button>
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
                  <h3 class="box-title">II. Data Perkawinan</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
                <form action="http://localhost/sikp/index.php/simpan-data-perkawinan" method="POST">
                  <div class="box-body">
                    <div id="input-kepala-keluarga" class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Kepala Keluarga</label>
                          <select name="psg_no_bpjs[]" id="psg-kepala-keluarga" class="form-control select2" style="width: 100%;">
                            <option value="" selected>Pilih Pasien</option>
                            <?php foreach($pasien['data'] as $ar_pasien): ?>
                            <option value="<?php echo $ar_pasien['no_bpjs'] ?>"><?php echo $ar_pasien['nama'] ?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php echo form_error('psg_no_bpjs[]'); ?>
                        </div>
                      </div>
                      <!-- /pk-kepala-keluarga -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Hubungan Keluarga</label>
                          <select name="psg_hubungan_keluarga[]" class="form-control">
                            <option value="" selected>Pilih Hubungan Keluarga</option>
                            <option value="1">Suami</option>
                            <option value="2">Istri</option>
                            <option value="3">Anak</option>
                            <option value="4">Anggota Keluarga Lain</option>
                          </select>
                          <?php echo form_error('psg_hubungan_keluarga[]'); ?>
                        </div>
                      </div>
                      <!-- /pk-hubungan-keluarga -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Domisili Serumah</label>
                          <select name="psg_domisili_serumah[]" class="form-control">
                            <option value="" selected>Pilih Domisili</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                            <option value="3">Kadang-Kadang</option>
                          </select>
                          <?php echo form_error('psg_domisili_serumah[]'); ?>
                        </div>
                      </div>
                      <!-- /pk-domisili-serumah -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Nomor Telepon/HP</label>
                          <input type="text" name="psg_no_telp" class="form-control">
                          <span class="help-block"><small>Format: 08xxx</small></span>
                          <?php echo form_error('psg_no_telp'); ?>
                        </div>
                      </div>
                      <!-- /pk-domisili-serumah -->
                    </div>
                    <!-- #/input-kepala-keluarga -->
                    <div id="input-pasangan" class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="control-label">Pasangan</label>
                          <select name="psg_no_bpjs[]" class="form-control select2" style="width: 100%;">
                            <option value="" selected>Pilih Pasien</option>
                            <?php foreach($pasien['data'] as $ar_pasien): ?>
                            <option value="<?php echo $ar_pasien['no_bpjs'] ?>"><?php echo $ar_pasien['nama'] ?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php echo form_error('psg_no_bpjs[]'); ?>
                        </div>
                      </div>
                      <!-- /pk-pasangan -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="control-label">Hubungan Keluarga</label>
                          <select name="psg_hubungan_keluarga[]" class="form-control">
                            <option value="" selected>Pilih Hubungan Keluarga</option>
                            <option value="1">Suami</option>
                            <option value="2">Istri</option>
                            <option value="3">Anak</option>
                            <option value="4">Anggota Keluarga Lain</option>
                          </select>
                          <?php echo form_error('psg_hubungan_keluarga[]'); ?>
                        </div>
                      </div>
                      <!-- /pk-hubungan-keluarga -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="control-label">Domisili Serumah</label>
                          <select name="psg_domisili_serumah[]" class="form-control">
                            <option value="" selected>Pilih Domisili</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                            <option value="2">Kadang-Kadang</option>
                          </select>
                          <?php echo form_error('psg_domisili_serumah[]'); ?>
                        </div>
                      </div>
                      <!-- /pk-domisili-serumah -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="control-label">Status Perkawinan</label>
                          <select name="psg_status_kawin[]" class="form-control">
                            <option value="" selected>Pilih Status</option>
                            <option value="1">Menikah</option>
                            <option value="0">Cerai</option>
                          </select>
                          <?php echo form_error('psg_status_kawin[]'); ?>
                        </div>
                      </div>
                      <!-- /pk-domisili-serumah -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="control-label">Perkawinan ke-</label>
                          <input type="number" name="psg_perkawinan_ke[]" class="form-control" min="0">
                          <?php echo form_error('psg_perkawinan_ke[]'); ?>
                        </div>
                      </div>
                      <!-- /pk-perkawinan-ke -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="control-label">Umur</label>
                          <input type="number" name="psg_umur_pasangan[]" class="form-control" min="0">
                          <span class="help-block"><small>Ketika menikah</small></span>
                          <?php echo form_error('psg_umur_pasangan[]'); ?>
                        </div>
                      </div>
                      <!-- /pk-umur-pasangan -->
                    </div>
                    <!-- #/input-pasangan -->
                    <div id="pasangan"></div>
                    <!-- #/pasangan FORM dinamis -->
                    <div id="tombol-tambah-pasangan" class="row">
                      <div class="form-group">
                        <div class="col-md-4">
                          <button type="button" id="add-spouse" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data Pasangan</button>
                        </div>
                      </div>
                    </div>
                    <!-- #/tombol-tambah-pasangan -->
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger">Batal</button>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /data-perkawinan -->
            <div class="col-md-12">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">III. Anggota Keluarga</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
                <form role="form" action="http://localhost/sikp/index.php/simpan-anggota-keluarga" method="post">
                <input type="text" name="id_kk" value="<?php echo $id_kk['data'][0]['id_kk']; echo set_value('id_kk'); ?>">
                  <div class="box-body">
                    <div class="callout callout-warning">
                      <h4>Perhatian</h4>
                      <p>Cukup masukkan data anggota keluarga <strong>selain</strong> kepala keluarga dan pasangan</p>
                    </div>
                    <!-- ./callout -->
                    <div id="input-anggota-keluarga-01" class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Anggota Keluarga</label>
                          <select name="ak_no_bpjs[]" class="form-control select2" style="width: 100%;">
                            <option value="" selected>Pilih Pasien</option>
                            <?php foreach($pasien['data'] as $ar_pasien): ?>
                            <option value="<?php echo $ar_pasien['no_bpjs'] ?>"><?php echo $ar_pasien['nama'] ?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php echo form_error('ak_no_bpjs[]'); ?>
                        </div>
                      </div>
                      <!-- /ak-pasangan -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Hubungan Keluarga</label>
                          <select name="ak_hubungan_keluarga[]" class="form-control">
                            <option value="" selected>Pilih Hubungan Keluarga</option>
                            <option value="1">Suami</option>
                            <option value="2">Istri</option>
                            <option value="3">Anak</option>
                            <option value="4">Anggota Keluarga Lain</option>
                          </select>
                          <?php echo form_error('ak_hubungan_keluarga[]'); ?>
                        </div>
                      </div>
                      <!-- /ak-hubungan-keluarga -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Domisili Serumah</label>
                          <select name="ak_domisili_serumah[]" class="form-control">
                            <option value="" selected>Pilih Domisili</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                            <option value="3">Kadang-Kadang</option>
                          </select>
                          <?php echo form_error('ak_domisili_serumah[]'); ?>
                        </div>
                      </div>
                      <!-- /ak-domisili-serumah -->
                    </div>
                    <!-- #/input-anggota-keluarga -->
                    <div id="input-anggota-keluarga-02" class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Anggota Keluarga</label>
                          <select name="ak_no_bpjs[]" class="form-control select2" style="width: 100%;">
                            <option value="" selected>Pilih Pasien</option>
                            <?php foreach($pasien['data'] as $ar_pasien): ?>
                            <option value="<?php echo $ar_pasien['no_bpjs'] ?>"><?php echo $ar_pasien['nama'] ?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php echo form_error('ak_no_bpjs[]'); ?>
                        </div>
                      </div>
                      <!-- /ak-pasangan -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Hubungan Keluarga</label>
                          <select name="ak_hubungan_keluarga[]" class="form-control">
                            <option value="" selected>Pilih Hubungan Keluarga</option>
                            <option value="1">Suami</option>
                            <option value="2">Istri</option>
                            <option value="3">Anak</option>
                            <option value="4">Anggota Keluarga Lain</option>
                          </select>
                          <?php echo form_error('ak_hubungan_keluarga[]'); ?>
                        </div>
                      </div>
                      <!-- /ak-hubungan-keluarga -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Domisili Serumah</label>
                          <select name="ak_domisili_serumah[]" class="form-control">
                            <option value="" selected>Pilih Domisili</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                            <option value="3">Kadang-Kadang</option>
                          </select>
                          <?php echo form_error('ak_domisili_serumah[]'); ?>
                        </div>
                      </div>
                      <!-- /ak-domisili-serumah -->
                    </div>
                    <!-- #/input-anggota-keluarga -->
                    <div id="input-anggota-keluarga-03" class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Anggota Keluarga</label>
                          <select name="ak_no_bpjs[]" class="form-control select2" style="width: 100%;">
                            <option value="" selected>Pilih Pasien</option>
                            <?php foreach($pasien['data'] as $ar_pasien): ?>
                            <option value="<?php echo $ar_pasien['no_bpjs'] ?>"><?php echo $ar_pasien['nama'] ?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php echo form_error('ak_no_bpjs[]'); ?>
                        </div>
                      </div>
                      <!-- /ak-pasangan -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Hubungan Keluarga</label>
                          <select name="ak_hubungan_keluarga[]" class="form-control">
                            <option value="" selected>Pilih Hubungan Keluarga</option>
                            <option value="1">Suami</option>
                            <option value="2">Istri</option>
                            <option value="3">Anak</option>
                            <option value="4">Anggota Keluarga Lain</option>
                          </select>
                          <?php echo form_error('ak_hubungan_keluarga[]'); ?>
                        </div>
                      </div>
                      <!-- /ak-hubungan-keluarga -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Domisili Serumah</label>
                          <select name="ak_domisili_serumah[]" class="form-control">
                            <option value="" selected>Pilih Domisili</option>
                            <option value="1">Ya</option>
                            <option value="2">Tidak</option>
                            <option value="3">Kadang-Kadang</option>
                          </select>
                          <?php echo form_error('ak_domisili_serumah[]'); ?>
                        </div>
                      </div>
                      <!-- /ak-domisili-serumah -->
                    </div>
                    <!-- #/input-anggota-keluarga -->
                    <!--div id="anggota-keluarga"></div-->
                    <!-- #/ak-anggota-keluarga -->
                    <div id="tombol-tambah-keluarga" class="row">
                      <div class="form-group">
                        <div class="col-md-4">
                          <button type="button" id="add-family" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data Anggota Keluarga</button>
                        </div>
                      </div>
                    </div>
                    <!-- #/tombol-tambah-keluarga -->
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger">Batal</button>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /anggota keluarga -->
            <div class="col-md-12">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">IV. Ekonomi</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
                <form class="form-horizontal" action="http://localhost/sikp/index.php/simpan-ekonomi" method="post">
                  <input type="text" name="id_kk" value="<?php echo $id_kk['data'][0]['id_kk']; echo set_value('id_kk'); ?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="input-eko-luas-bangunan" class="col-sm-3 control-label">Luas Bangunan</label>

                      <div class="col-md-2">
                        <input type="number" name="luas_bangunan" step="0.1" class="form-control" id="input-eko-luas-bangunan" min="1" value="<?php echo set_value('luas_bangunan'); ?>">
                        <span class="help-block"><small>dalam m<sup>2</sup></small></span>
                        <?php echo form_error('luas_bangunan'); ?>
                      </div>
                    </div>
                    <!-- /luas-bangunan -->
                    <div class="form-group">
                      <label for="input-eko-luas-lahan" class="col-sm-3 control-label">Luas Lahan</label>

                      <div class="col-md-2">
                        <input type="number" name="luas_lahan" step="0.1" min="1" class="form-control" id="input-eko-luas-lahan" value="<?php echo set_value('luas_lahan'); ?>">
                        <span class="help-block"><small>dalam m<sup>2</sup></small></span>
                        <?php echo form_error('luas_lahan'); ?>
                      </div>
                    </div>
                    <!-- /luas-lahan -->
                    <div class="form-group">
                      <label for="input-eko-kepemilikan-rumah" class="col-sm-3 control-label">Kepemilikan Rumah</label>

                      <div class="col-md-2">
                        <select name="kepemilikan_rumah" id="" class="form-control">
                          <option value="" selected>Pilih Kepemilikan</option>
                          <option value="1">Kontrak</option>
                          <option value="2">Kost</option>
                          <option value="3">Pribadi</option>
                          <option value="4">Orang Tua</option>
                        </select>
                        <?php echo form_error('kepemilikan_rumah'); ?>
                      </div>
                    </div>
                    <!-- /kepemilikan-rumah -->
                    <div class="form-group">
                      <label for="input-eko-daya-listrik" class="col-sm-3 control-label">Daya Listrik</label>

                      <div class="col-md-2">
                        <select name="daya_listrik" id="input-eko-daya-listrik" class="form-control">
                          <option value="" selected>Pilih Daya Listrik</option>
                          <option value="450">450 W</option>
                          <option value="900">900 W</option>
                          <option value="1300">1.300 W</option>
                          <option value="2000">Lebih dari 1.300 W</option>
                        </select>
                        <?php echo form_error('daya_listrik'); ?>
                      </div>
                    </div>
                    <!-- /daya-listrik -->
                    <div class="form-group">
                      <label for="input-eko-sumber-ekonomi" class="col-sm-3 control-label">Sumber Ekonomi</label>

                      <div class="col-md-5">
                        <label style="margin-right: 20px !important;"><input type="radio" name="sumber_ekonomi" value="1">&nbsp;Gaji Pegawai</label>
                        <label><input type="radio" name="sumber_ekonomi" value="0">&nbsp;Usaha Lainnya</label>
                        <?php echo form_error('sumber_ekonomi'); ?>
                      </div>
                    </div>
                    <!-- /sumber-ekonomi -->
                    <div class="form-group">
                      <label for="input-eko-penopang-ekonomi" class="col-sm-3 control-label">Penopang Ekonomi</label>

                      <div class="col-md-4">
                        <select name="penopang_ekonomi" id="input-eko-penopang-ekonomi" class="form-control">
                          <option value="" selected>Pilih Penopang Ekonomi</option>
                          <option value="1">Suami atau Istri saja</option>
                          <option value="2">Suami dan Istri</option>
                          <option value="3">Suami, Istri &amp; Anak</option>
                          <option value="4">Suami, Istri, Anak &amp; anggota keluarga lain</option>
                        </select>
                        <?php echo form_error('penopang_ekonomi'); ?>
                      </div>
                    </div>
                    <!-- /penopang-ekonomi --> 
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger">Batal</button>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /ekonomi -->
            <div class="col-md-12">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">V. Perilaku Kesehatan &amp; Keselamatan</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>

                <form action="http://localhost/sikp/index.php/simpan-perilaku" method="post" class="form-horizontal">
                  <input type="text" name="id_kk" value="<?php echo $id_kk['data'][0]['id_kk']; echo set_value('id_kk');?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="input-pkes-layanan-balita" class="col-sm-3 control-label">Pelayanan promotif/preventif bayi dan balita</label>

                      <div class="col-md-5">
                        <select name="layanan_balita" id="input-pkes-layanan-balita" class="form-control">
                          <option value="" selected>Pilih pelayanan promotif</option>
                          <option value="1">Dokter Praktek Umum</option>
                          <option value="2">Puskesmas</option>
                          <option value="3">Perawat/Bidan</option>
                          <option value="4">Rumah Sakit/Spesialis</option>
                          <option value="5">Lain</option>
                        </select>
                        <?php echo form_error('layanan_balita'); ?>
                      </div>
                    </div>
                    <!-- /layanan-balita -->
                    <div class="form-group">
                      <label for="input-pkes-pemeliharaan_kes_kel" class="col-sm-3 control-label">Pemeliharaan Kesehatan Anggota Keluarga</label>

                      <div class="col-md-5">
                        <select name="pemeliharaan_kes_kel" id="input-pkes-pemeliharaan-kes-kel" class="form-control">
                          <option value="" selected>Pilih pemeliharaan kesehatan</option>
                          <option value="1">Dokter Praktek Umum</option>
                          <option value="2">Puskesmas</option>
                          <option value="3">Perawat/Bidan</option>
                          <option value="4">Rumah Sakit/Spesialis</option>
                          <option value="5">Lain</option>
                        </select>
                        <?php echo form_error('pemeliharaan_kes_kel'); ?>
                      </div>
                    </div>
                    <!-- /pemeliharaan_kes_kel -->
                    <div class="form-group">
                      <label for="input-pkes-layanan-pengobatan-diri" class="col-sm-3 control-label">Pelayanan Pengobatan Diri Sendiri</label>

                      <div class="col-md-5">
                        <select name="layanan_pengobatan_diri" id="input-pkes-layanan-pengobatan-diri" class="form-control">
                          <option value="" selected>Pilih pelayanan pengobatan</option>
                          <option value="1">Dokter Praktek Umum</option>
                          <option value="2">Puskesmas</option>
                          <option value="3">Perawat/Bidan</option>
                          <option value="4">Rumah Sakit/Spesialis</option>
                          <option value="5">Lain</option>
                        </select>
                        <?php echo form_error('layanan_pengobatan_diri'); ?>
                      </div>
                    </div>
                    <!-- /layanan-pengobatan-diri -->
                    <div class="form-group">
                      <label for="input-pkes-jamkes-pri-kel" class="col-sm-3 control-label">Jaminan Pemeliharaan Kesehatan untuk Diri Sendiri &amp; Keluarga</label>

                      <div class="col-md-5">
                        <select name="jamkes_pri_kel" id="input-pkes-jamkes-pri-kel" class="form-control">
                          <option value="" selected>Pilih jaminan kesehatan</option>
                          <option value="1">Asuransi Swasta</option>
                          <option value="2">BPJS</option>
                          <option value="3">Institusi</option>
                          <option value="0">Tidak Punya</option>
                        </select>
                        <?php echo form_error('jamkes_pri_kel'); ?>
                      </div>
                    </div>
                    <!-- /jamkes-pri-kel -->
                    <div class="form-group">
                      <label for="input-pkes-sumber-air" class="col-sm-3 control-label">Sumber Air Minum Dirumah Tinggal</label>

                      <div class="col-md-5">
                        <select name="sumber_air" id="input-pkes-sumber-air" class="form-control">
                          <option value="" selected>Pilih sumber air</option>
                          <option value="1">Air sumur gali</option>
                          <option value="2">Air sumur pompa</option>
                          <option value="3">PDAM</option>
                          <option value="4">Sungai</option>
                          <option value="5">Lain</option>
                        </select>
                        <?php echo form_error('sumber_air'); ?>
                        <?php echo form_error('sumber_air_lain'); ?>
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
                            <input type="radio" name="mck_km" value="1"> Ada
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="mck_km" value="0"> Tidak Ada
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
                            <input type="radio" name="mck_wc" value="1"> Kloset
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="mck_wc" value="0"> Lain
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
                            <input type="radio" name="mck_cuci" value="1"> Ya
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="mck_cuci" value="0"> Tidak
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
                            <input type="radio" name="spal" value="tertutup"> Saluran Limbah Tertutup
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="spal" value="terbuka"> Saluran Terbuka
                          </label>
                        </div>
                      </div>
                      <?php echo form_error('spal'); ?>
                    </div>
                    <!-- /spal -->
                    <div class="form-group">
                      <label for="input-pkes-kasur-busa" class="col-sm-3 control-label">Penggunaan Kasur Busa</label>

                      <div class="col-md-3">
                        <select name="kasur_busa" id="input-pkes-kasur-busa" class="form-control">
                          <option value="" selected>Pilih penggunaan kasur busa</option>
                          <option value="1">Ya</option>
                          <option value="0">Tidak</option>
                          <option value="2">Tidak Tahu</option>
                        </select>
                        <?php echo form_error('kasur_busa'); ?>
                      </div>
                    </div>
                    <!-- /kasur-busa -->
                    <div class="form-group">
                      <label for="input-pkes-kosmetik" class="col-sm-3 control-label">Penggunaan Kosmetik atau Obat Luar</label>

                      <div class="col-md-5">
                        <select name="kosmetik_obat_luar" id="input-pkes-kosmetik" class="form-control">
                          <option value="" selected>Pilih penggunaan kosmetik</option>
                          <option value="0">Tidak Pernah</option>
                          <option value="1">Hand &amp; Body Lotion</option>
                          <option value="2">Obat gosok</option>
                          <option value="3">Obat nyamuk oles</option>
                          <option value="4">Lainnya</option>
                        </select>
                        <?php echo form_error('kosmetik_obat_luar'); ?>
                      </div>
                    </div>
                    <!-- /kosmetik -->
                    <div class="form-group">
                      <label for="input-pkes-sepeda-motor" class="col-sm-3 control-label">Penggunaan Sepeda atau Sepeda Motor</label>

                      <div class="col-md-5">
                        <select name="pengguna_sepeda_motor" id="input-pkes-sepeda-motor" class="form-control">
                          <option value="" selected>Pilih penggunaan sepeda motor</option>
                          <option value="1">Ya</option>
                          <option value="0">Tidak</option>
                          <option value="2">Kadang-Kadang</option>
                        </select>
                        <span class="help-block"><small>Oleh salah satu atau seluruh anggota keluarga</small></span>
                        <?php echo form_error('pengguna_sepeda_motor'); ?>
                      </div>
                    </div>
                    <!-- /sepeda-motor -->
                    <div class="form-group">
                      <label for="input-pkes-manula-sendirian" class="col-sm-3 control-label">Apakah ada manula yang ditinggal sendirian di rumah?</label>

                      <div class="col-md-5">
                        <select name="manula_sendirian" id="input-pkes-manula-sendirian" class="form-control">
                          <option value="" selected>Pilih opsi</option>
                          <option value="1">Ya</option>
                          <option value="0">Tidak</option>
                          <option value="2">Kadang-Kadang</option>
                        </select>
                        <?php echo form_error('manula_sendirian'); ?>
                      </div>
                    </div>
                    <!-- /manula-sendirian -->
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger">Batal</button>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /perilaku kesehatan -->
            <div class="col-md-12">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">VI. Riwayat Kesehatan</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
                <form role="form" action="http://localhost/sikp/index.php/simpan-riwayat-kes" method="post">
                  <input type="text" name="id_kk" value="<?php echo $id_kk['data'][0]['id_kk']; echo set_value('id_kk');?>">
                  <div class="box-body">
                    <?php echo form_error('sb_no_bpjs[]'); ?>
                    <?php echo form_error('sb_jenis_penyakit[]'); ?>
                    <?php echo form_error('tb_no_bpjs[]'); ?>
                    <?php echo form_error('tb_jenis_penyakit[]'); ?>
                    <?php echo form_error('st_no_bpjs[]'); ?>
                    <?php echo form_error('st_jenis_penyakit[]'); ?>
                    <?php echo form_error('batuk'); ?>
                    <?php echo form_error('batuk_no_bpjs[]'); ?>
                    <?php echo form_error('asma'); ?>
                    <?php echo form_error('asma_no_bpjs[]'); ?>
                    <?php echo form_error('masalah_kesehatan'); ?>
                    <?php echo form_error('maskes_no_bpjs[]'); ?>
                    <?php echo form_error('masalah_kes[]'); ?>
                    <?php echo form_error('masalah_keturunan'); ?>
                    <?php echo form_error('masket_no_bpjs[]'); ?>
                    <?php echo form_error('jenis_masalah_keturunan[]'); ?>
                    <?php echo form_error('sakit_keras'); ?>
                    <?php echo form_error('jenis_sakit_keras[]'); ?>
                    <?php echo form_error('tahun_sakit[]'); ?>
                    <?php echo form_error('kecelakaan_kerja'); ?>
                    <?php echo form_error('jenis_kecelakaan_kerja[]'); ?>
                    <?php echo form_error('tahun_kejadian[]'); ?>
                    <?php echo form_error('jenis_kelainan[]'); ?>
                    <?php echo form_error('durasi_perawatan[]'); ?>
                    <?php echo form_error('merokok'); ?>
                    <?php echo form_error('durasi_merokok'); ?>
                    <?php echo form_error('durasi_berhenti'); ?>
                    <?php echo form_error('batang_per_hari'); ?>
                    <?php echo form_error('kretek_filter'); ?>
                    <?php echo form_error('jamu'); ?>
                    <?php echo form_error('jenis_jamu'); ?>
                    <?php echo form_error('jamu_per_minggu'); ?>
                    <?php echo form_error('alkohol'); ?>
                    <?php echo form_error('durasi'); ?>
                    <?php echo form_error('kopi'); ?>
                    <?php echo form_error('gelas_per_hari'); ?>
                    <?php echo form_error('obat'); ?>
                    <?php echo form_error('jenis_obat[]'); ?>
                    <?php echo form_error('m_dingin'); ?>
                    <?php echo form_error('peliharaan'); ?>
                    <?php echo form_error('olahraga'); ?>
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
                          <input type="radio" name="batuk" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="batuk" value="0">&nbsp;Tidak
                        </label>
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
                          <input type="radio" name="asma" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="asma" value="0">&nbsp;Tidak
                        </label>
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
                          <input type="radio" name="masalah_kesehatan" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="masalah_kesehatan" value="0">&nbsp;Tidak
                        </label>
                      </div>
                      <div id="maskes-out"></div>
                      <!-- #/maskes-out -->
                      <div id="tombol-add-maskes" style="display: none"></div>
                      <!-- #/tombol-add-masket -->
                    </div>
                    <!-- /riwayat-maskes -->
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Apakah ada anggota keluarga yang mengalami masalah kesehatan keturunan?
                        <span class="help-block">Seperti darah tinggi, kencing manis, kegemukan, atau tumor.</span>
                      </label>
                      <div class="col-md-12">
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="masalah_keturunan" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="masalah_keturunan" value="0">&nbsp;Tidak
                        </label>
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
                          <input type="radio" name="sakit_keras" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="sakit_keras" value="0">&nbsp;Tidak
                        </label>
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
                          <input type="radio" name="kecelakaan_kerja" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="kecelakaan_kerja" value="0">&nbsp;Tidak
                        </label>
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
                          <input type="radio" name="merokok" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="merokok" value="2">&nbsp;Kadang-Kadang
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="merokok" value="3">&nbsp;Sudah Berhenti
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="merokok" value="0">&nbsp;Tidak Pernah
                        </label>
                      </div>
                      <div id="merokok-out" style="display: none"></div>
                      <!-- #/merokok-out -->
                    </div>
                    <!-- /riwayat-merokok -->
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Apakah kepala keluarga mengonsumsi jamu?</label>
                      <div class="col-md-12">
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="jamu" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="jamu" value="2">&nbsp;Kadang-Kadang
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="jamu" value="0">&nbsp;Tidak
                        </label>
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
                          <input type="radio" name="alkohol" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="alkohol" value="2">&nbsp;Kadang-Kadang
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="alkohol" value="0">&nbsp;Tidak
                        </label>
                      </div>
                      <div id="alkohol-out" class="row" style="display: none"></div>
                      <!-- #/alkohol-out -->
                    </div>
                    <!-- /riwayat-alkohol -->
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Apakah kepala keluarga mengonsumsi kopi?</label>
                      <div class="col-md-12">
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="kopi" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="kopi" value="2">&nbsp;Kadang-Kadang
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="kopi" value="0">&nbsp;Tidak
                        </label>
                      </div>
                      <div id="kopi-out" class="row" style="display: none"></div>
                      <!-- #/kopi-out -->
                    </div>
                    <!-- /riwayat-kopi -->
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Apakah kepala keluarga saat ini mengonsumsi obat-obatan?</label>
                      <div class="col-md-12">
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="obat" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="obat" value="0">&nbsp;Tidak
                        </label>
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
                          <input type="radio" name="m_dingin" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="m_dingin" value="2">&nbsp;Kadang-Kadang
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="m_dingin" value="0">&nbsp;Tidak
                        </label>
                      </div>
                    </div>
                    <!-- /riwayat-minuman-dingin -->
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Apakah keluarga memelihara ayam atau burung atau kambing atau sapi di dekat rumah?</label>
                      <div class="col-md-12">
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="peliharaan" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="peliharaan" value="0">&nbsp;Tidak
                        </label>
                      </div>
                    </div>
                    <!-- /riwayat-peliharaan -->
                    <div class="form-group">
                      <label class="col-sm-12 control-label">Apakah kepala keluarga rutin olahraga?</label>
                      <div class="col-md-12">
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="olahraga" value="1">&nbsp;Ya
                        </label>
                        <label style="margin-right: 20px !important">
                          <input type="radio" name="olahraga" value="0">&nbsp;Tidak
                        </label>
                      </div>
                      <div id="olahraga-out"></div>
                      <!-- #/olahraga-out -->
                      <div id="tombol-add-olahraga" style="display: none"></div>
                      <!-- #/tombol-add-olahraga -->
                    </div>
                    <!-- /riwayat-olahraga -->
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger">Batal</button>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /riwayat kesehatan -->
            <div class="col-md-12">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">VII. Kuesioner Perhitungan Tingkat Stres</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div>
                </div>

                <form role="form" action="http://localhost/sikp/index.php/simpan-gejala-stres" method="post">
                  <input type="text" name="id_kk" value="<?php echo $id_kk['data'][0]['id_kk']; echo set_value('id_kk'); ?>">
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
                                <input type="radio" name="no_01" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_01" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_01" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_01" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_01" value="4"> 4
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
                                <input type="radio" name="no_02" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_02" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_02" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_02" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_02" value="4"> 4
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
                                <input type="radio" name="no_03" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_03" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_03" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_03" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_03" value="4"> 4
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
                                <input type="radio" name="no_04" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_04" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_04" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_04" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_04" value="4"> 4
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
                                <input type="radio" name="no_05" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_05" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_05" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_05" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_05" value="4"> 4
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
                                <input type="radio" name="no_06" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_06" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_06" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_06" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_06" value="4"> 4
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
                                <input type="radio" name="no_07" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_07" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_07" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_07" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_07" value="4"> 4
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
                                <input type="radio" name="no_08" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_08" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_08" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_08" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_08" value="4"> 4
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
                                <input type="radio" name="no_09" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_09" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_09" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_09" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_09" value="4"> 4
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
                                <input type="radio" name="no_10" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_10" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_10" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_10" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_10" value="4"> 4
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
                                <input type="radio" name="no_11" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_11" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_11" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_11" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_11" value="4"> 4
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
                                <input type="radio" name="no_12" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_12" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_12" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_12" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_12" value="4"> 4
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
                                <input type="radio" name="no_13" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_13" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_13" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_13" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_13" value="4"> 4
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
                                <input type="radio" name="no_14" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_14" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_14" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_14" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_14" value="4"> 4
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
                                <input type="radio" name="no_15" value="0"> 0
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_15" value="1"> 1
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_15" value="2"> 2
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_15" value="3"> 3
                              </label>
                              <label style="margin-right: 20px !important;">
                                <input type="radio" name="no_15" value="4"> 4
                              </label>
                            </div>
                            <?php echo form_error('no_15'); ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger">Batal</button>
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