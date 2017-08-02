<!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Data Dasar Kesehatan Keluarga
        </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-book"></i>&nbsp;&nbsp;Data Dasar Kesehatan Keluarga</li>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>KK</th>
                    <th>Nomor BPJS</th>
                    <th>Keterangan BPJS</th>
                    <th>Nomor Telepon</th>
                  </tr>
                  </thead>
                  <tbody>
                  {data_tabel}
                    <tr>
                      <td>{id_kk}</td>
                      <td>{no_bpjs}</td>
                      <td>{keterangan_bpjs}</td>
                      <td>{no_telp}</td>
                    </tr>
                  {/data_tabel}
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>KK</th>
                    <th>Nomor BPJS</th>
                    <th>Keterangan BPJS</th>
                    <th>Nomor Telepon</th>
                  </tr>
                  </tfoot>
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
      <!-- /.content -->