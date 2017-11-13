<section class="content-header">
  <h1>Pengelolaan Obat</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-medkit"></i>&nbsp;Pengelolaan Obat</li>
    <li><i class="fa fa-book"></i>&nbsp;Laporan Obat</li>
    <li class="active">Laporan Obat Masuk</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Laporan Obat Masuk</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-block btn-default bg-green" onclick="window.location.href='<?php echo base_url(); ?>formulir-pencatatan-obat-masuk'"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data</button>
          </div>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {err_vars}
          {alert_vars}
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Obat Masuk</th>
              <th>ID Obat</th>
              <th>Nama Obat</th>
              <th>Jumlah Masuk</th>
              <th>Satuan</th>
              <th>Tanggal Masuk</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            {data_tabel}
              <tr>
                <td>{id_obat_masuk}</td>
                <td>{id_obat}</td>
                <td>{nama}</td>
                <td>{jumlah_masuk}</td>
                <td>{satuan}</td>
                <td>{tgl_masuk}</td>
                <td>
                  <div class="form-group btn-group">
                    <button type="button" class="btn btn-danger btn-sm" onclick="window.location='<?php echo base_url(); ?>delete-obat-masuk/{id_obat_masuk}'"><i class="fa fa-remove"></i></button>
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
</section>