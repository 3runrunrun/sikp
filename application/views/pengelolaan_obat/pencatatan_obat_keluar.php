<section class="content-header">
  <h1>
    Pengelolaan Obat
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-medkit"></i>&nbsp;Pengelolaan Obat</li>
    <li class="active">Formulir Pencatatan Obat Keluar</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Formulir Pencatatan Obat Keluar</h3>
    </div>
    <!-- ./box-header -->

    <form role="form" action="<?php echo base_url(); ?>simpan-pencatatan-obat-keluar" method="post">
      <div class="box-body">
        {err_vars}
        {alert_vars}
        <?php echo form_error('id_resep_obat'); ?>
        <?php echo form_error('id_obat[]'); ?>
        <?php echo form_error('jumlah_keluar[]'); ?>
        <!-- /alert-template -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="resep-obat" class="control-label">Resep Terdaftar</label>
              <select name="id_resep_obat" id="resep-obat" class="form-control select2" style="width: 100% !important;" required>
                <option value="" selected disabled>Pilih Resep Terdaftar</option>
                {resep}
                <option value="{id_resep_obat}">{nama}</option>
                {/resep}
              </select>
            </div>
          </div>
        </div>
        <!-- /resep-obat -->
        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <label for="obat" class="control-label">Pilih Obat</label>
              <select name="id_obat[]" id="obat" class="form-control select2" style="width: 100% !important;" onchange="get_harga(this)" required>
                <option value="" selected disabled>Pilih Obat</option>
                {obat}
                <option value="{id_obat}">{nama}&nbsp;(Persediaan: {jumlah}&nbsp;{satuan})</option>
                {/obat}
              </select>
            </div>
          </div>
          <!-- /obat -->
          <div class="col-md-3">
            <div class="form-group">
              <label for="jumlah-keluar" class="control-label">Jumlah Obat Keluar</label>
              <input type="number" min="1" name="jumlah_keluar[]" class="form-control jumlah" step="1" placeholder="0">
              <span class="help-block"><small>Dalam butir atau botol</small></span>
            </div>
          </div>
          <!-- /jumlah-keluar -->
        </div>
        <!-- /obat -->
        <div id="obat-keluar-out"></div>
        <!-- /obat-out -->
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <button type="button" id="add-obat-keluar" class="btn btn-success" style="width: 100% !important;"><i class="fa fa-plus"></i>&nbsp;Tambah Obat</button>
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