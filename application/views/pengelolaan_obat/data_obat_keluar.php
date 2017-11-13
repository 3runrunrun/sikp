<section class="content-header">
  <h1>Pengelolaan Obat</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-medkit"></i>&nbsp;Pengelolaan Obat</li>
    <li><i class="fa fa-book"></i>&nbsp;Laporan Obat</li>
    <li class="active">Laporan Obat Keluar</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">        
        <div class="box-header">
          <h3 class="box-title">Laporan Obat Keluar</h3>
        </div>
        <!-- ./box-header -->
        <form role="form" action="<?php echo base_url(); ?>cetak-laporan-obat-keluar" method="post">
          <div class="box-body">
            <div class="row">
              <div class="col-md-2 col-sm-12">
                <div class="form-group">
                  <label class="control-label">Opsi</label>
                  <select name="opsi" class="form-control" required>
                    <option value="" selected disabled>Pilih opsi</option>
                    <option value="1">Harian</option>
                    <option value="2">Bulanan</option>
                  </select>
                </div>
              </div>
              <!-- /opsi -->
              <div class="col-md-4 div-col-sm-12">
                <div class="form-group">
                  <label class="control-label">Dari Tanggal</label>
                  <input type="date" name="dari_tanggal" id="dari-tanggal" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask class="form-control" min="<?php $mintime =  strtotime("-10 year"); echo date('Y-m-d', $mintime); ?>" max="<?php echo date('Y-m-d'); ?>" onchange="set_min_tanggal(this)" required>
                </div>
              </div>
              <!-- /from -->
              <div class="col-md-4 div-col-sm-12">
                <div class="form-group">
                  <label class="control-label">Sampai Tanggal</label>
                  <input type="date" name="sampai_tanggal" id="sampai-tanggal" class="form-control" min="<?php $mintime =  strtotime("-10 year"); echo date('Y-m-d', $mintime); ?>" max="<?php echo date('Y-m-d'); ?>" required>
                </div>
              </div>
              <!-- /to -->
              <div class="col-md-2 col-sm-12">
                <div class="form-group">
                  <label class="control-label" style="color: white;">Sampai</label>
                  <button type="submit" class="btn btn-primary pull-right" style="width: 100% !important;">Cetak Laporan</button>
                </div>
              </div>
              <!-- /tombol-cetak -->
            </div>
          </div>
          <!-- ./box-body -->
        </form>
      </div>
      <!-- ./box -->
    </div>
  </div>
  <!-- /cetak-laporan-obat-keluar -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Obat Keluar Harian</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-block btn-default bg-green" onclick="window.location.href='<?php echo base_url(); ?>formulir-pencatatan-obat-keluar'"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data</button>
          </div>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {err_vars}
          {alert_vars}
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Resep</th>
              <th>Pasien Penerima Obat</th>
              <th>Nama Obat</th>
              <th>Jumlah Keluar</th>
              <th>Satuan</th>
              <th>Tanggal Keluar</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            {obat_harian}
              <tr>
                <td>{new_id_resep_obat}</td>
                <td>{nama_pasien}</td>
                <td>{nama}</td>
                <td>{jumlah_keluar}</td>
                <td>{satuan}</td>
                <td>{tgl_keluar}</td>
                <td>
                  <div class="form-group btn-group">
                    <a href="<?php echo base_url(); ?>delete-obat-keluar/{id_obat_keluar}" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
                  </div>
                </td>
              </tr>
            {/obat_harian}
            </tbody>
          </table>
        </div>
        <!-- ./box-body -->
      </div>
      <!-- ./box -->
    </div>
  </div>
  <!-- /data-obat-keluar-harian -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Laporan Obat Keluar Bulanan</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {err_vars}
          {alert_vars}
          <table id="obat-keluar-bulan" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Bulan</th>
              <th width="8%">Cetak</th>
            </tr>
            </thead>
            <tbody>
            {obat_bulanan}
              <tr>
                <td>Laporan Bulan <strong>{new_bulan}</strong></td>
                <td>
                  <div class="form-group btn-group">
                    <a href="<?php echo base_url(); ?>cetak-laporan-per-bulan/01-{bulan}-{tahun}/01-{bulan}-{tahun}" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
                  </div>
                </td>
              </tr>
            {/obat_bulanan}
            </tbody>
          </table>
        </div>
        <!-- ./box-body -->
      </div>
      <!-- ./box -->
    </div>
  </div>
  <!-- /data-obat-keluar -->
</section>
<script type="text/javascript">
  function set_min_tanggal(selector){
    var value = $(selector).val();
    $('#sampai-tanggal').attr('min', value);
  }
</script>