<section class="content-header">
  <h1>Data Master</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i>&nbsp;Data Master</li>
    <li><i class="fa fa-book"></i>&nbsp;Modul Kesehatan</li>
    <li class="active">Modul Faktor Risiko</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Modul Faktor Risiko Penyakit</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-block btn-default bg-green" onclick="window.location.href='<?php echo base_url(); ?>create-modul-faktor-risiko'"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data</button>
          </div>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {err_vars}
          {alert_vars}
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Modul</th>
              <th>Nama</th>
              <th>Versi</th>
              <th>Tanggal Dibuat</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            {data_tabel}
              <tr>
                <td>{id_mod_faktor_risiko}</td>
                <td>{nama}</td>
                <td>{versi}</td>
                <td>{tgl_dibuat}</td>
                <td>
                  <div class="form-group btn-group" style="width: 100% !important;">
                    <button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?php echo base_url(); ?>../mod_files/modul_faktor_risiko/{id_mod_faktor_risiko}{versi}.pdf'"><i class="fa fa-eye"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="window.location='<?php echo base_url(); ?>destroy-modul-faktor-risiko/{id_mod_faktor_risiko}z{versi}'"><i class="fa fa-remove"></i></button>
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