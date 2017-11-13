<section class="content-header">
  <h1>Pengobatan Holistik</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>pendaftaran-pasien"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
    <li><i class="fa fa-book"></i>&nbsp;Riwayat Pelayanan Harian</a></li>
    <li class="active">Pendaftaran Cek Darah</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Pasien Terdaftar</h3>
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
              <th>No Surat Cek Darah</th>
              <th>Nama Pasien</th>
              <th>Tanggal Cek Darah</th>
              <th>Layanan Cek Darah (Hasil)</th>
              <th>Status</th>
              <th>Opsi</th>
            </tr>
            </thead>
            <tbody>
            {data_tabel}
              <tr>
                <td>{new_no_surat_pengantar}</td>
                <td>{nama}</td>
                <td>{tgl_cek_darah}</td>
                <td>{gd_kolesterol}&nbsp;{new_h_kolesterol}{gd_puasa}&nbsp;{new_h_puasa}{gd_acak}&nbsp;{new_h_acak}{gd_asam_urat}&nbsp;{new_h_asam_urat}</td>
                <td>{status}</td>
                <td>
                  <div class="form-group btn-group" style="width: 100% !important;">
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