<section class="content-header">
  <h1>
    Formulir Pendaftaran Pengobatan Pasien
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>pendaftaran-pasien"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
    <li class="active">Formulir Pendaftaran Pengobatan Pasien</li>
  </ol>
</section>

<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Formulir Pendaftaran Pengobatan Pasien</h3>
    </div>
    <!-- ./box-header -->

    <form role="form" action="<?php echo base_url(); ?>simpan-pendaftaran-pasien" method="post">
      <div class="box-body">
        {err_vars}
        {alert_vars}
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="no-bpjs" class="col-sm-12">Nama Pasien</label>

              <div class="col-md-12">
                <select name="no_bpjs" id="no-bpjs" class="form-control select2" style="width: 100%" required>
                  <option value="" selected disabled>Pilih Pasien</option>
                  {data_pasien}
                  <option value="{no_bpjs}">{nama}</option>
                  {/data_pasien}
                </select>
                <?php echo form_error('no_bpjs'); ?>
              </div>
            </div>
            <!-- /no-bpjs -->
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="tenaga-medis" class="col-sm-12">Poli / Tenaga Medis</label>

              <div class="col-md-12">
                <select name="nik_tenaga_medis" id="tenaga-medis" class="form-control select2" style="width: 100%" required>
                  <option value="" selected disabled>Pilih Poli</option>
                  {data_dokter}
                  <option value="{nik_tenaga_medis}">Poli {poli}&nbsp;(dr. {nama})</option>
                  {/data_dokter}
                </select>
                <?php echo form_error('nik_tenaga_medis'); ?>
              </div>
            </div>
            <!-- /tenaga-medis -->
          </div>
        </div>
      </div>
      <!-- ./box-body -->
      <div class="box-footer">
        <button type="reset" class="btn btn-danger">Batal</button>
        <button type="submit" class="btn btn-primary pull-right">Daftar</button>
      </div>  
      <!-- ./box-footer -->
    </form>
  </div>
  <!-- /formulir-pendaftara-pasien -->
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Riwayat Pengobatan Harian</h3>
    </div>
    <div class="box-body">
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
              <div class="form-group btn-group" style="width: 100% !important;">
                {opsi}
              </div>
            </td>
          </tr>
        {/data_tabel}
        </tbody>
      </table>
    </div>
  </div>
  <!-- /riwayat-pengobatan-harian -->
</section>
