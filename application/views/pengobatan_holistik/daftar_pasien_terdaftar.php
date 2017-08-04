<section class="content-header">
        <h1>Pasien Terdaftar</h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>daftar-pasien-terdaftar"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
          <li class="active">Daftar Pasien Terdaftar</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Daftar Pasien Terdaftar</h3>
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
                  {data_tabel}
                    <tr>
                      <td>{id_registrasi}</td>
                      <td>{no_bpjs}</td>
                      <td>{nama}</td>
                      <td>{tgl_periksa}</td>
                      <td>{poli}</td>
                      <td><span class="label label-primary">{status}</span></td>
                      <td>
                        <div class="form-group btn-group-vertical" style="width: 100% !important;">
                          <button type="button" class="btn btn-primary" onclick="window.location='http://localhost/sikp/index.php/pengisian-anamnesis/{id_registrasi}'"><i class="fa fa-plus"></i>&nbsp;Tambah Anamnesis</button>
                          <button type="button" class="btn btn-primary" onclick="window.location='http://localhost/sikp/index.php/pengisian-diagnosis/{id_registrasi}'"><i class="fa fa-plus"></i>&nbsp;Tambah Diagnosis</button>
                          <button type="button" class="btn btn-danger" onclick="window.location='http://localhost/sikp/index.php/'"><i class="fa fa-remove"></i>&nbsp;Hapus</button>
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