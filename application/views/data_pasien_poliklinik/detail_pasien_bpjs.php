<section class="content-header">
  <h1>
    Data Pasien BPJS
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-book"></i>&nbsp;&nbsp;Pasien</li>
    <li><a href="<?php echo base_url(); ?>lihat-data-pasien-bpjs"><i class="fa fa-database"></i>&nbsp;Daftar Pasien BPJS</a></li>
    <li class="active">Detail Daftar Pasien BPJS</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <section class="col-md-12">
      <div class="col-md-12">
        {err_vars}
      </div>
      {alert_vars}
    </section>
  </div>
  <div class="row">
    <section class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Identitas Pasien</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          <table class="table">
            <tbody>
              {identitas}
              <tr>
                <th style="width: 40%">No. BPJS</th>
                <td>{no_bpjs}</td>
              </tr>
              <tr>
                <th>Nama (Umur)</th>
                <td>{nama} ({umur} tahun)</td>
              </tr>
              <tr>
                <th>Jenis Kelamin</th>
                <td>{jenis_kelamin}</td>
              </tr>
              <tr>
                <th>Kelas BPJS<br />(Status Tagihan)</th>
                <td>{kelas_bpjs}<br />{status_tagihan_bpjs}</td>
              </tr>
              <tr>
                <th>Keterangan Hidup</th>
                <td>{hidup}</td>
              </tr>
              <tr>
                <th>Agama</th>
                <td>{agama}</td>
              </tr>
              <tr>
                <th>Alamat</th>
                <td>
                  {alamat}<br />
                  {provinsi}, {kabupaten}, {kecamatan}, {kelurahan}
                </td>
              </tr>
              {/identitas}
            </tbody>
          </table>
        </div>
        <!-- ./box-body -->
      </div>
      <!-- /identitas-pasien -->
    </section>
  </div>
  <div class="row">
    <section class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Riwayat Pengobatan</h3>
        </div>
        <!-- ./box-header -->
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
            {riwayat_pengobatan}
              <tr>
                <td>{id_registrasi}</td>
                <td>{no_bpjs}</td>
                <td>{nama}</td>
                <td>{tgl_periksa}</td>
                <td>{poli}</td>
                <td>{status}</td>
                <td>
                  <div class="form-group btn-group" style="width: 100% !important;">
                    <button type="button" class="btn btn-xs btn-primary" onclick="window.location='<?php echo base_url(); ?>detail-pengobatan/{id_registrasi}/{no_bpjs}'" style="width: 100% !important;"><i class="fa fa-eye"></i></button>
                  </form>
                  </div>
                </td>
              </tr>
            {/riwayat_pengobatan}
            </tbody>
          </table>
        </div>
      </div>  
    </section>
    <!-- /anggota-keluarga -->
  </div>
  <!-- /masalah-keturunan /riwayat-penyakit-kecelakaan -->
</section>