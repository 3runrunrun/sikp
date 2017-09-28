<section class="content-header">
  <h1>
    Data Dasar Kesehatan Keluarga
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-book"></i>&nbsp;&nbsp;Data Dasar</li>
    <li class="active">Daftar Data Dasar Kesehatan Keluarga</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Daftar Data Dasar Kesehatan Keluarga</h3>
          <!-- /.box-title -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-block btn-default bg-green" onclick="window.location.href='<?php echo base_url(); ?>formulir-data-dasar'"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data Baru</button>
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
              <th>KK</th>
              <th>Nomor BPJS</th>
              <th>Nama</th>
              <th>Nomor Telepon</th>
              <th>Tingkat Risiko</th>
              <th>Tingkat Stres</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            {data_tabel}
              <tr>
                <td>{id_kk}</td>
                <td>{no_bpjs}</td>
                <td>{nama}</td>
                <td>{no_telp}</td>
                <td>{tingkat_risiko_penyakit}</td>
                <td>{tingkat_stres}</td>
                <td>
                  <div class="form-group btn-group">
                    <button type="button" class="btn btn-sm btn-success" onclick="window.location='<?php echo base_url();?>formulir-data-dasar/{id_kk}'"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="window.location='<?php echo base_url(); ?>detail-data-dasar/{id_kk}'"><i class="fa fa-eye"></i></button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="window.location='<?php echo base_url(); ?>formulir-data-dasar/{id_kk}'"><i class="fa fa-trash-o"></i></button>
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