<section class="content-header">
  <h1>Pengelolaan Obat</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-medkit"></i>&nbsp;Pengelolaan Obat</li>
    <li><i class="fa fa-book"></i>&nbsp;Laporan Obat</li>
    <li class="active">Data Obat</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Obat</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-block btn-default bg-green" onclick="window.location.href='<?php echo base_url(); ?>formulir-obat-baru'"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data</button>
          </div>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {err_vars}
          {alert_vars}
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Obat</th>
              <th>Nama Obat</th>
              <th>Pembiayaan BPJS</th>
              <th>Jumlah Tersedia</th>
              <th>Jenis</th>
              <th>Satuan</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            {data_tabel}
              <tr>
                <td>{id_obat}</td>
                <td>{nama}</td>
                <td>{bpjs}</td>
                <td>{jumlah}</td>
                <td>{jenis}</td>
                <td>{satuan}</td>
                <td>
                  <div class="form-group btn-group" style="width: 100% !important;">
                    <button type="button" class="btn btn-danger btn-sm" onclick="window.location='<?php echo base_url(); ?>delete-obat/{id_obat}'" style="width: 100% !important;"><i class="fa fa-remove"></i></button>
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