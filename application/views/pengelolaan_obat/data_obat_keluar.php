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
              <div class="col-md-5 div-col-sm-12">
                <div class="form-group">
                  <label class="control-label">Dari Tanggal</label>
                  <input type="date" name="dari_tanggal" id="dari-tanggal" class="form-control" min="<?php $mintime =  strtotime("-10 year"); echo date('Y-m-d', $mintime); ?>" max="<?php echo date('Y-m-d'); ?>" onchange="set_min_tanggal(this)" required>
                </div>
              </div>
              <div class="col-md-5 div-col-sm-12">
                <div class="form-group">
                  <label class="control-label">Sampai Tanggal</label>
                  <input type="date" name="sampai_tanggal" id="sampai-tanggal" class="form-control" min="<?php $mintime =  strtotime("-10 year"); echo date('Y-m-d', $mintime); ?>" max="<?php echo date('Y-m-d'); ?>" required>
                </div>
              </div>
              <div class="col-md-2 col-sm-12">
                <div class="form-group">
                  <label class="control-label" style="color: white;">Sampai</label>
                  <button type="submit" class="btn btn-primary pull-right" style="width: 100% !important;">Cetak Laporan</button>
                </div>
              </div>
            </div>
          </div>
          <!-- ./box-body -->
        </form>
      </div>
      <!-- ./box -->
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Obat Keluar</h3>
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
              <th>ID Obat Keluar</th>
              <th>ID Resep</th>
              <th>ID Obat</th>
              <th>Nama Obat</th>
              <th>Jumlah Keluar</th>
              <th>Satuan</th>
              <th>Tanggal Keluar</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            {data_tabel}
              <tr>
                <td>{id_obat_keluar}</td>
                <td>{id_resep_obat}</td>
                <td>{id_obat}</td>
                <td>{nama}</td>
                <td>{jumlah_keluar}</td>
                <td>{satuan}</td>
                <td>{tgl_keluar}</td>
                <td>
                  <div class="form-group btn-group" style="width: 100% !important;">
                    <button type="button" class="btn btn-danger btn-sm" onclick="window.location='<?php echo base_url(); ?>delete-obat-keluar/{id_obat_keluar}'" style="width: 100% !important;"><i class="fa fa-remove"></i></button>
                  </div>
                </td>
              </tr>
            {/data_tabel}
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