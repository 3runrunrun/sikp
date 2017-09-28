<section class="content-header">
  <h1>
    Pengelolaan Obat
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-medkit"></i>&nbsp;Pengelolaan Obat</li>
    <li class="active">Formulir Penambahan Obat Baru</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Formulir Penambahan Obat Baru</h3>
    </div>
    <!-- ./box-header -->

    <form role="form" action="<?php echo base_url(); ?>simpan-pencatatan-obat-baru" method="post">
      <div class="box-body">
        {alert_template}
        <?php echo form_error('nama[]'); ?>
        <?php echo form_error('jumlah[]'); ?>
        <?php echo form_error('bpjs[]'); ?>
        <?php echo form_error('jenis[]'); ?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="obat-nama" class="control-label">Nama Obat</label>
              <input type="text" name="nama[]" id="obat-nama" class="form-control">
            </div>
            <!-- #/obat-nama -->
            <div class="form-group">
              <label for="obat-jumlah" class="control-label">Jumlah Obat</label>
              <input type="number" name="jumlah[]" id="obat-jumlah" class="form-control" min="1">
            </div>
            <!-- #/obat-jumlah -->
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="obat-bpjs" class="control-label">Status Pembiayaan BPJS</label>
              <select name="bpjs[]" id="obat-bpjs" class="form-control">
                <option value="" selected disabled>Pilih Opsi</option>
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
              </select>
            </div>
            <!-- #/obat-bpjs -->
            <div class="form-group">
              <label for="obat-jenis" class="control-label">Jenis Obat</label>
              <select name="jenis[]" id="obat-jenis" class="form-control">
                <option value="" selected disabled>Pilih Opsi</option>
                <option value="1">Kapsul</option>
                <option value="2">Tablet</option>
                <option value="3">Sirup</option>
              </select>
            </div>
            <!-- #/obat-jenis -->
          </div>
        </div>
        <!-- ./row -->
        <div id="obat-baru-out"></div>
        <!-- #/obat-baru-out -->
        <button type="button" id="add-obat-baru" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Obat</button>
        <!-- #/add-obat-baru -->
      </div>
      <!-- ./box-body -->
      <div class="box-footer">
        <button type="reset" class="btn btn-danger">Batal</button>
        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
      </div>
      <!-- ./box-footer -->
    </form>
  </div>
  <!-- ./box -->
</section>