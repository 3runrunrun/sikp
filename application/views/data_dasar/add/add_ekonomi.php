<section class="content-header">
  <h1>
    Data Dasar Kesehatan Keluarga
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-book"></i> Data Dasar</li>
    <li><a href="<?php echo base_url(); ?>lihat-data-dasar"><i class="fa fa-database"></i> Data Dasar Kesehatan Keluarga</a></li>
    <li><a href="<?php echo base_url(); ?>detail-data-dasar/<?php echo $id_kk; ?>"><i class="fa fa-eye"></i>&nbsp;Detail Data Dasar Kesehatan Keluarga</a></li>
    <li class="active">Formulir Data Ekonomi Keluarga</li>
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
            <h3 class="box-title">Ekonomi</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <form class="form-horizontal" action="<?php echo base_url(); ?>simpan-ekonomi" method="post">
            <input type="hidden" name="id_kk" value="<?php echo $id_kk; ?>">
            <input type="hidden" name="is_add" value="yes">
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
</script>