<?php 
  $ar_perkawinan_ke = array('0' => '-');
 ?>
<section class="content-header">
        <h1>
          Data Dasar Kesehatan Keluarga
        </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-book"></i> Data Dasar</li>
          <li><a href="<?php echo base_url(); ?>lihat-data-dasar"><i class="fa fa-database"></i> Data Dasar Kesehatan Keluarga</a></li>
          <li><i class="fa fa-eye"></i>&nbsp;Detail Data Dasar Kesehatan Keluarga</li>
          <li class="active">Formulir Data Perkawinan</li>
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
                  <h3 class="box-title">Data Perkawinan</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <form action="<?php echo base_url(); ?>update-perkawinan" method="post">
                  <div class="box-body">
                    <?php echo form_error('id_data_perkawinan[]'); ?>
                    <?php echo form_error('id_kk[]'); ?>
                    <?php echo form_error('psg_no_bpjs[]'); ?>
                    <?php echo form_error('psg_hubungan_keluarga[]'); ?>
                    <?php echo form_error('psg_domisili_serumah[]'); ?>
                    <?php echo form_error('psg_status_kawin[]'); ?>
                    <?php echo form_error('psg_perkawinan_ke[]'); ?>
                    <?php echo form_error('psg_umur_pasangan[]'); ?>
                    {kk}
                    <div id="input-kepala-keluarga" class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Kepala Keluarga</label>
                          <input type="hidden" name="id_kk[]" id="" class="form-control" value="{id_kk}">
                          <input type="hidden" name="psg_no_bpjs[]" id="" class="form-control" value="{no_bpjs}">
                          <input type="text" class="form-control" value="{nama}" readonly>
                          <select id="psg-kepala-keluarga" class="form-control" style="width: 100%;">
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
                          <input type="hidden" name="psg_hubungan_keluarga[]"  value="{hubungan_keluarga}">
                          <input type="text" class="form-control" value="Suami" readonly>
                          <?php echo form_error('psg_hubungan_keluarga[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                        </div>
                      </div>
                      <!-- /pk-hubungan-keluarga -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Domisili Serumah</label>
                          <input type="hidden" class="jq-domisili-serumah" value="{domisili_serumah}">
                          <select name="psg_domisili_serumah[]" class="form-control domisili-serumah">
                            <option value="" disabled>Pilih Domisili</option>
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
                          <input type="text" name="psg_no_telp" class="form-control" minlength="10" maxlength="12" value="{no_telp}">
                          <span class="help-block"><small>Format: 08xxx</small></span>
                          <?php echo form_error('psg_no_telp', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;', '</span>'); ?>
                        </div>
                      </div>
                      <!-- /pk-domisili-serumah -->
                    </div>
                    {/kk}
                    <!-- #/input-kepala-keluarga -->
                    <div id="pasangan-out">
                      {pasangan}
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Pasangan</label>
                            <input type="hidden" name="id_data_perkawinan[]" value="{id_data_perkawinan}">
                            <input type="hidden" name="id_kk[]" value="{id_kk}">
                            <input type="hidden" name="psg_no_bpjs[]" value="{no_bpjs}">
                            <input type="text" class="form-control" value="{nama}" readonly required>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label class="control-label">Hubungan Keluarga</label>
                            <input type="hidden" name="psg_hubungan_keluarga[]" value="{hubungan_keluarga}">
                            <input type="text" class="form-control" value="Istri" readonly required>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label class="control-label">Domisili Serumah</label>
                            <input type="hidden" class="jq-domisili-serumah" value="{domisili_serumah}">
                            <select name="psg_domisili_serumah[]" class="form-control domisili-serumah" required>
                              <option value="" disabled>Pilih Opsi</option>
                              <option value="1">Ya</option>
                              <option value="2">Tidak</option>
                              <option value="3">Kadang-Kadang</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label class="control-label">Status Perkawinan</label>
                            <input type="hidden" class="jq-status-kawin" value="{status_kawin}" required>
                            <select name="psg_status_kawin[]" class="form-control status-kawin" required>
                              <option value="" disabled>Pilih Opsi</option>
                              <option value="1">Menikah</option>
                              <option value="0">Cerai</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label class="control-label">Perkawinan ke-</label>
                            <input type="number" name="psg_perkawinan_ke[]" class="form-control perkawinan-ke" min="1" value="{perkawinan_ke}" readonly required>
                          </div>
                        </div>
                        <div class="col-md-1">
                          <div class="form-group">
                            <label class="control-label">Umur</label>
                            <input type="number" name="psg_umur_pasangan[]" class="form-control" min="16" value="{umur_pasangan}" required>
                            <span class="help-block"><small>Ketika menikah</small></span>
                          </div>
                        </div>
                      </div>
                      {/pasangan}
                    </div>
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
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Anggota Keluarga</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <form role="form" action="<?php echo base_url(); ?>update-anggota-keluarga" method="post">
                  <input type="text" name="id_kk" value="<?php echo $kk['data'][0]['id_kk']; ?>" readonly>
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
                    <?php echo form_error('ak_hubungan_keluarga[]'); ?>
                    <!-- ./callout -->
                    {anggota_keluarga}
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Anggota Keluarga</label>
                          <input type="hidden" name="ak_no_bpjs[]" value="{no_bpjs}" readonly>
                          <input type="text" class="form-control" value="{nama}" required readonly>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="control-label">Hubungan Keluarga</label>
                          <input type="hidden" class="jq-hubungan-keluarga" value="{hubungan_keluarga}" readonly>
                          <select name="ak_hubungan_keluarga[]" class="form-control hubungan-keluarga" onchange="perkawinan_out(this, $(this).parent().parent().parent().parent().parent().children('[name=id_kk]').val())" required>
                            <option value="" disabled>Pilih Opsi</option>
                            <option value="3">Anak</option>
                            <option value="4">Anggota Keluarga Lain</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="control-label">Domisili Serumah</label>
                          <input type="hidden" class="jq-domisili-serumah" value="{domisili_serumah}" readonly>
                          <select name="ak_domisili_serumah[]" class="form-control domisili-serumah" required>
                            <option value="" disabled >Pilih Opsi</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                            <option value="2">Kadang-Kadang</option>
                          </select>
                        </div>
                      </div>
                      <div class="perkawinan-ke-out">
                        <div class="col-md-2">
                          <div class="form-group">
                            <label class="control-label">Dari Perkawinan ke-</label>
                            <input type="hidden" class="jq-perkawinan-ke" value="{perkawinan_ke}" readonly>
                            <select name="ak_perkawinan_ke[]" class="form-control perkawinan-ke">
                              <option value="" disabled>Pilih Opsi</option>
                              <option value="0">Keluarga Lain</option>
                              <?php foreach ($perkawinan_ke['data'] as $value): ?>
                              <option value="<?php echo $value['perkawinan_ke']; ?>" selected><?php echo str_replace(array_keys($ar_perkawinan_ke), $ar_perkawinan_ke, $value['perkawinan_ke']); ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!-- ./perkawinan-ke-out -->
                    </div>
                    {/anggota_keluarga}
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
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#psg-kepala-keluarga').hide();
          $.each($('.jq-domisili-serumah'), function(index, val) {
            $(this).next('.domisili-serumah').val($(this).val()).attr('selected', 'selected');
          });
          $.each($('.jq-status-kawin'), function(index, val) {
            $(this).next('.status-kawin').val($(this).val()).attr('selected', 'selected');
          });
          $.each($('.jq-hubungan-keluarga'), function(index, val) {
            $(this).next('.hubungan-keluarga').val($(this).val()).attr('selected', 'selected');
          });
          $.each($('.jq-perkawinan-ke'), function(index, val) {
            $(this).next('.perkawinan-ke').val($(this).val()).attr('selected', 'selected');
          });
        });
      </script>