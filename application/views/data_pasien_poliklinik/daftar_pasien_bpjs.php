<section class="content-header">
  <h1>
    Data Pasien BPJS
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i>&nbsp;Arsip Poliklinik</li>
    <li><i class="fa fa-book"></i>&nbsp;&nbsp;Pasien</li>
    <li class="active">Daftar Pasien BPJS</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Daftar Pasien BPJS</h3>
          <!-- /.box-title -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-block btn-default bg-green" onclick="window.location.href='<?php echo base_url(); ?>formulir-pasien-bpjs'"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Pasien Baru</button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          {err_vars}
          {alert_vars}
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nomor BPJS</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Kelas BPJS</th>
                <th>Tagihan BPJS</th>
                <th>Meninggal atau Hidup</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              {data_tabel}
              <tr>
                <td>{no_bpjs}</td>
                <td>{nama}</td>
                <td>{jenis_kelamin}</td>
                <td>{kelas_bpjs}</td>
                <td>{status_tagihan_bpjs}</td>
                <td>{hidup}</td>
                <td>
                  <div class="form-group btn-group">
                    <button type="button" class="btn btn-sm btn-primary" onclick="window.location='<?php echo base_url(); ?>detail-pasien-bpjs/{no_bpjs}'"><i class="fa fa-eye"></i></button>
                  </div>
                </td>
              </tr>
              {/data_tabel}
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>