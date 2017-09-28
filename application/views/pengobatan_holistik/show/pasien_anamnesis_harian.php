<section class="content-header">
  <h1>Pengobatan Holistik</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>pendaftaran-pasien"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
    <li><i class="fa fa-book"></i>&nbsp;Data Pengobatan Harian</a></li>
    <li class="active">Data Anamnesis Pasien</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Anamnesis Pasien</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <div class="col-md-12">
            {err_vars}
          </div>
          {alert_vars}
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID Registrasi</th>
              <th>No. BPJS</th>
              <th>Nama Pasien</th>
              <th>Tanggal Periksa</th>
              <th>Poli</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            {data_tabel}
              <tr>
                <td>{id_registrasi}</td>
                <td>{no_bpjs}</td>
                <td>{nama}</td>
                <td>{tgl_periksa}</td>
                <td>{poli}</td>
                <td>{status}</td>
                <td>
                  <div class="form-group btn-group-vertical" style="width: 100% !important;">
                    {opsi}
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