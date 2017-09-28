<section class="content-header">
  <h1>Data Master</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i>&nbsp;Data Master</li>
    <li><i class="fa fa-book"></i>&nbsp;Wilayah Administratif</li>
    <li><a href="<?php echo base_url(); ?>provinsi"><i class="fa fa-database"></i>&nbsp;Provinsi</a></li>
    <li class="active">Formulir Provinsi</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Provinsi</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {alert_vars}
          <?php echo form_error('nama[]'); ?>
          <section class="col-md-12">
            <div class="box box-primary">
              <form role="form" action="<?php echo base_url(); ?>store-provinsi" method="post">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Nama Provinsi</label>
                        <input type="text" name="nama[]" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <!-- /nama -->
                  <div id="provinsi-out"></div>
                  <!-- #/provinsi-out -->
                  <div id="tombol-tambah-provinsi" class="row">
                    <div class="col-md-12">
                      <button type="button" id="add-provinsi" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Provinsi</button>
                    </div>                  
                  </div>
                  <!-- #/provinsi-out -->
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
    $('#add-provinsi').click(function() {
      var element = '<div class="row">' +
          '<div class="col-md-11">' +
            '<div class="form-group">' +
              '<label class="control-label">Nama Provinsi</label>' +
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
      $('#provinsi-out').append(element);
    });
  });
</script>