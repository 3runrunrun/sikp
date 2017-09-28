<section class="content-header">
  <h1>Data Master</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i>&nbsp;Data Master</li>
    <li><i class="fa fa-book"></i>&nbsp;Wilayah Administratif</li>
    <li><a href="<?php echo base_url(); ?>kelurahan"><i class="fa fa-database"></i>&nbsp;Kelurahan</a></li>
    <li class="active">Formulir Kelurahan</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Kelurahan</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {err_vars}
          {alert_vars}
          <?php echo form_error('id_provinsi'); ?>
          <?php echo form_error('id_kabupaten'); ?>
          <?php echo form_error('id_kecamatan'); ?>
          <?php echo form_error('nama[]'); ?>
          <section class="col-md-12">
            <div class="box box-primary">
              <form role="form" action="<?php echo base_url(); ?>store-kelurahan" method="post">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Provinsi</label>
                        <select name="id_provinsi" class="form-control select2" onchange="filter_region('kabupaten', this)" required>
                          <option value="" selected disabled>Pilih Provinsi</option>
                          {provinsi}
                          <option value="{id_provinsi}">{nama}</option>
                          {/provinsi}
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- /id-provinsi -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Kabupaten</label>
                        <select id="input-kk-kabupaten" name="id_kabupaten" class="form-control select2" onchange="filter_region('kecamatan', this)" required>
                          <!-- option-kabupaten -->
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- /id-kabupaten -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Kecamatan</label>
                        <select id="input-kk-kecamatan" name="id_kecamatan" class="form-control select2" required>
                          <!-- option-kecamatan -->
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- /id-kecamatan -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Kelurahan</label>
                        <input type="text" name="nama[]" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <!-- /nama -->
                  <div id="kelurahan-out"></div>
                  <!-- #/kelurahan-out -->
                  <div id="tombol-tambah-kelurahan" class="row">
                    <div class="col-md-12">
                      <button type="button" id="add-kelurahan" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Kelurahan</button>
                    </div>                  
                  </div>
                  <!-- #/kelurahan-out -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                  <button type="reset" class="btn btn-danger">Batal</button>
                  <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
                <!-- ./box-footer -->
              </form>
            </div>
          </section>
        </div>
        <!-- ./box-body -->
      </div>
      <!-- ./box -->
    </div>
  </div>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    $('#add-kelurahan').click(function() {
      var element = '<div class="row">' +
          '<div class="col-md-11">' +
            '<div class="form-group">' +
              '<label class="control-label">Kelurahan</label>' +
              '<input type="text" name="nama[]" class="form-control" required>' +
            '</div>' +
          '</div>' +
          '<div class="col-md-1">' +
            '<div class="form-group">' +
              '<label class="control-label" style="color: white;">hap</label>' +
              '<button type="button" class="btn btn-danger" onclick="$(this).parent().parent().parent().remove()"><i class="fa fa-remove"></i></button>' +
            '</div>' +
          '</div>' +
        '</div>';
      $('#kelurahan-out').append(element);
    });
  });
</script>