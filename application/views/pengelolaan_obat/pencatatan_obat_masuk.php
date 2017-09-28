<?php 
$satuan_obat = array(
'1' => 'Butir',
'2' => 'Botol',
);
?>
<section class="content-header">
  <h1>
    Pengelolaan Obat
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-medkit"></i>&nbsp;Pengelolaan Obat</li>
    <li class="active">Formulir Pencatatan Obat Masuk</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Formulir Pencatatan Obat Masuk</h3>
    </div>
    <!-- ./box-header -->

    <form role="form" action="<?php echo base_url(); ?>simpan-pencatatan-obat-masuk" method="post">
      <div class="box-body">
        {err_vars}
        {alert_vars}
        <?php echo form_error('id_resep_obat'); ?>
        <?php echo form_error('id_obat[]'); ?>
        <?php echo form_error('jumlah_masuk[]'); ?>
        <!-- /alert-template -->
        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <label for="obat" class="control-label">Pilih Obat</label>
              <select name="id_obat[]" id="obat" class="form-control select2" style="width: 100% !important;" onchange="get_harga(this)" required>
                <option value="" selected disabled>Pilih Obat</option>
                {obat}
                <option value="{id_obat}"><?php echo ucwords($value['nama']); ?>&nbsp;(Persediaan: {jumlah}&nbsp;{satuan})</option>
                {/obat}
              </select>
            </div>
          </div>
          <!-- /obat -->
          <div class="col-md-3">
            <div class="form-group">
              <label for="jumlah-masuk" class="control-label">Jumlah Obat Masuk</label>
              <input type="number" name="jumlah_masuk[]" class="form-control jumlah" min="0" step="1" placeholder="0" required>
              <span class="help-block"><small>Dalam butir atau botol</small></span>
            </div>
          </div>
          <!-- /jumlah-masuk -->
        </div>
        <!-- /obat -->
        <div id="obat-masuk-out"></div>
        <!-- /obat-out -->
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <button type="button" id="add-obat-masuk" class="btn btn-success" style="width: 100% !important;"><i class="fa fa-plus"></i>&nbsp;Tambah Obat</button>
            </div>
          </div>
        </div>
        <!-- /tombol-tambah-obat -->
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