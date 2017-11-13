<section class="content-header">
  <h1>Pengobatan Holistik</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i>&nbsp;Arsip Poliklinik</li>
    <li><i class="fa fa-book"></i>&nbsp;Riwayat Pelayanan</a></li>
    <li class="active">Pengobatan Holistik</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Riwayat Pengobatan</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {err_vars}
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
                <td>{new_id_registrasi}</td>
                <td>{no_bpjs}</td>
                <td>{nama}</td>
                <td>{tgl_periksa}</td>
                <td>{poli}</td>
                <td>{status}</td>
                <td>
                  <div class="form-group btn-group" style="width: 100% !important;">
                    <a href="<?php echo base_url(); ?>detail-pengobatan/{id_registrasi}/{no_bpjs}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    <?php if ($this->session->userdata('tabel') != 'keperawatan'): ?>
                    <a href="<?php echo base_url(); ?>destroy-riwayat-pengobatan/{id_registrasi}/{no_bpjs}" class="btn btn-danger"><i class="fa fa-remove"></i></a>
                    <?php endif; ?>
                  </form>
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