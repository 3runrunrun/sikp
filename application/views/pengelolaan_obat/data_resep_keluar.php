<section class="content-header">
  <h1>Pengelolaan Obat</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-medkit"></i>&nbsp;Pengelolaan Obat</li>
    <li><i class="fa fa-book"></i>&nbsp;Laporan Obat</li>
    <li class="active">Resep Keluar</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Resep Keluar</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {err_vars}
          {alert_vars}
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Registrasi</th>
              <th>Nama Pasien</th>
              <th>Poli (Nama Dokter)</th>
              <th>Tanggal Keluar</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            {data_tabel}
              <tr>
                <td>{new_id_registrasi}</td>
                <td>{nama_pasien}</td>
                <td>{poli} ({nama_dokter})</td>
                <td>{tgl_keluar}</td>
                <td>
                  <div class="form-group btn-group">
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location='<?php echo base_url(); ?>cetak-resep-obat-keluar/{id_resep_obat}'"><i class="fa fa-print"></i></button>
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