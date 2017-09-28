<section class="content-header">
  <h1>
    Data Dasar Kesehatan Keluarga
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-book"></i>&nbsp;&nbsp;Data Dasar</li>
    <li><i class="fa fa-database"></i>&nbsp;&nbsp;Data Dasar Keluarga</li>
    <li><a href="<?php echo base_url(); ?>detail-data-dasar/<?php echo $id_kk; ?>"><i class="fa fa-eye"></i>&nbsp;Detail Data Dasar Kesehatan Keluarga</a></li>
    <li class="active">Riwayat Data Dasar Kesehatan Keluarga dan Gejala Stres</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div id="riwayat-data-dasar" class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Riwayat Data Dasar Kesehatan Keluarga</h3>
          <!-- /.box-title -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-block btn-default bg-green" onclick="window.location.href='<?php echo base_url(); ?>add-riwayat-kes-kel/<?php echo $id_kk ?>'"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data Baru</button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          {err_vars}
          {alert_vars}
          <table id="tbl-riwayat-data-dasar" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Data Dasar</th>
              <th>Tanggal Isi</th>
              <th>Tingkat Risiko Penyakit</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            {riwayat_kes_kel}
              <tr>
                <td>{id_riwayat_kes_kel}</td>
                <td>{tgl_isi}</td>
                <td>{tingkat_risiko_penyakit}</td>
                <td>
                  <div class="form-group btn-group">
                    <button type="button" class="btn btn-sm btn-danger" onclick="window.location='<?php echo base_url(); ?>destroy-riwayat-kes-kel/{id_kk}/{id_riwayat_kes_kel}'"><i class="fa fa-trash-o"></i></button>
                  </div>
                </td>
              </tr>
            {/riwayat_kes_kel}
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- #/riwayat-data-dasar -->
  <div id="riwayat-gejala-stres" class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Riwayat Data Dasar Kesehatan Keluarga</h3>
          <!-- /.box-title -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="tbl-riwayat-gejala-stres" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Data Dasar</th>
              <th>Tanggal Isi</th>
              <th>Tingkat Risiko Penyakit</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            {gejala_stres}
              <tr>
                <td>{id_gejala_stres}</td>
                <td>{tgl_isi}</td>
                <td>{tingkat_stres}</td>
                <td>
                  <div class="form-group btn-group">
                    <button type="button" class="btn btn-sm btn-danger" onclick="window.location='<?php echo base_url(); ?>destroy-gejala-stres/{id_kk}/{id_gejala_stres}'"><i class="fa fa-trash-o"></i></button>
                  </div>
                </td>
              </tr>
            {/gejala_stres}
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- #/riwayat-data-dasar -->
</section>