<section class="content-header">
  <h1>Data Master</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i>&nbsp;Data Master</li>
    <li><i class="fa fa-book"></i>&nbsp;Modul Kesehatan</li>
    <li><a href="<?php echo base_url(); ?>modul-faktor-risiko"><i class="fa fa-database"></i>&nbsp;Modul Faktor Risiko</a></li>
    <li class="active">Formulir Modul Faktor Risiko</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Modul Faktor Risiko</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {alert_vars}
          <?php echo form_error('nama'); ?>
          <?php echo form_error('tgl_dibuat'); ?>
          <?php echo form_error('versi'); ?>
          <section class="col-md-12">
            <div class="box box-primary">
              <form role="form" action="<?php echo base_url(); ?>store-modul-faktor-risiko" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Nama Modul</label>
                        <input type="text" name="nama" class="form-control" onkeyup="get_latest('faktor_risiko', this)" required>
                      </div>
                    </div>
                  </div>
                  <!-- /nama -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Tanggal Dibuat</label>
                        <input type="date" name="tgl_dibuat" class="form-control" min="<?php $mintime =  strtotime("-10 year"); echo date('Y-m-d', $mintime); ?>" max="<?php echo date('Y-m-d'); ?>" required>
                      </div>
                    </div>
                  </div>
                  <!-- /tgl-dibuat -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Versi</label>
                        <input type="number" name="versi" id="versi" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <!-- /versi -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">File Modul</label>
                        <input type="file" name="file_modul" id="exampleInputFile" required>
                      </div>
                    </div>
                  </div>
                  <!-- /versi -->
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