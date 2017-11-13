<section class="content-header">
  <h1>
    Formulir Pendaftaran Cek Darah
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>pendaftaran-pasien"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
    <li class="active">&nbsp;Pendaftaran Cek Darah</li>
  </ol>
</section>

<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Formulir Pendaftaran Pengobatan Pasien</h3>
    </div>
    <!-- ./box-header -->

    <form role="form" action="<?php echo base_url(); ?>simpan-cek-darah" method="post">
      <div class="box-body">
        {err_vars}
        {alert_vars}
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="no-bpjs" class="control-label">Nama Pasien</label>

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
          <div class="col-md-12">
            <div class="form-group" style="margin-bottom: 0px;">
              <label class="control-label">Layanan Cek Darah</label>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="gd_kolesterol" value="1">Kolesterol
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="gd_puasa" value="1">Gula Darah Puasa
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="gd_acak" value="1">Gula Darah Acak
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="gd_asam_urat" value="1">Asam Urat
                </label>
              </div>
            </div>
          </div>
          <!-- /layanan-cek-darah -->
        </div>
      </div>
      <!-- ./box-body -->
      <div class="box-footer">
        <button type="reset" class="btn btn-danger">Batal</button>
        <button type="submit" class="btn btn-primary pull-right" id="submit-btn">Daftar</button>
      </div>  
      <!-- ./box-footer -->
    </form>
  </div>
  <!-- /formulir-pendaftara-pasien -->
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Riwayat Cek Darah Harian</h3>
    </div>
    <div class="box-body">
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
  </div>
  <!-- /riwayat-pengobatan-harian -->
</section>
<script type="text/javascript">
  $(document).ready(function(){
    check_if_cek_darah_empty();

    $('[name=gd_kolesterol]').on('change', function(){
      check_if_cek_darah_empty();
    });
    $('[name=gd_puasa]').on('change', function(){
      check_if_cek_darah_empty();
    });
    $('[name=gd_acak]').on('change', function(){
      check_if_cek_darah_empty();
    });
    $('[name=gd_asam_urat]').on('change', function(){
      check_if_cek_darah_empty();
    });
  });

  function check_if_cek_darah_empty(){
    if ($('[name=gd_kolesterol]').prop('checked') === false 
      && $('[name=gd_puasa]').prop('checked') === false 
      && $('[name=gd_acak]').prop('checked') === false 
      && $('[name=gd_asam_urat]').prop('checked') === false ) {
      $('#submit-btn').prop('disabled', 'disabled');
    } else {
      $('#submit-btn').prop('disabled', false);
    }
  }
</script>