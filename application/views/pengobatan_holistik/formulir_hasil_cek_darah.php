<section class="content-header">
  <h1>
    Formulir Hasil Cek Darah
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</li>
    <li class="active"><i class="fa fa-book"></i>&nbsp;Riwayat Pelayanan Harian</li>
    <li class="active">&nbsp;Cek Darah</li>
  </ol>
</section>

<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Formulir Pendaftaran Pengobatan Pasien</h3>
    </div>
    <!-- ./box-header -->

    <form role="form" action="<?php echo base_url(); ?>store-hasil-cek-darah" method="post">
      <div class="box-body">
        {err_vars}
        {alert_vars}
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Nama Pasien (No Surat Cek Darah)</label>

              <select name="no_surat_pengantar" id="no-surat-pengantar" class="form-control select2" style="width: 100%" onchange="show_cek_darah_by_no(this)" required>
                <option value="" selected disabled>Pilih Pasien</option>
                {data_pasien}
                <option value="{no_surat_pengantar}">{nama} ({new_no_surat_pengantar})</option>
                {/data_pasien}
              </select>
              <?php echo form_error('no_bpjs'); ?>
            </div>
          </div>
          <!-- /no-bpjs -->
          <div id="hasil-cek-darah-out"></div>
          <!-- #/hasil-cek-darah-out -->
        </div>
      </div>
      <!-- ./box-body -->
      <div class="box-footer">
        <button type="reset" class="btn btn-danger">Batal</button>
        <button type="submit" class="btn btn-primary pull-right" id="submit-btn">Simpan</button>
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
    check_if_any_form();
  });

  function check_if_any_form(){
    var formulir = $('#hasil-cek-darah-out').children();
    // console.log(formulir);

    if (formulir.length == 0) {
      $('#submit-btn').prop('disabled', 'disabled');
    } else {
      $('#submit-btn').prop('disabled', false);
    }
  }

  function show_cek_darah_by_no(selector) {
    // remove element
    $('#hasil-cek-darah-out').children().remove();

    // init var - local
    var no_surat_pengantar = $(selector).val();
    // console.log(no_surat_pengantar);
    var pathArray = window.location.pathname.split( '/' );
    var urlRequest = './pengobatan_holistik/C_pengobatan_holistik/show_cek_darah_by_no';
    // console.log(pathArray[3]);
    // console.log(pathArray[4]);
    if (pathArray[4] != undefined) {
      urlRequest = './../pengobatan_holistik/C_pengobatan_holistik/show_cek_darah_by_no';
    }

    // request data
    $.ajax({
      url: urlRequest,
      type: 'POST',
      dataType: 'json',
      data: {no_surat_pengantar: no_surat_pengantar},
      success: function(data){
        // console.log(data['data'][0]);
        // init var - local
        var form_cek_darah = '';
        var kolesterol = '<div class="col-md-6 col-sm-12">' +
            '<div class="form-group">' +
              '<input type="text" id="gd_kolesterol" class="form-control" value="Kolesterol" disabled>' +
            '</div>' +
          '</div>' +
          '<div class="col-md-6 col-sm-12">' +
            '<div class="form-group">' +
              '<input type="number" name="h_kolesterol" class="form-control" step="0.1" placeholder="0.0" required>' +
            '</div>' +
          '</div>';

        var puasa = '<div class="col-md-6 col-sm-12">' +
            '<div class="form-group">' +
              '<input type="text" id="gd_puasa" class="form-control" value="Gula Darah Puasa" disabled>' +
            '</div>' +
          '</div>' +
          '<div class="col-md-6 col-sm-12">' +
            '<div class="form-group">' +
              '<input type="number" name="h_puasa" class="form-control" step="0.1" placeholder="0.0" required>' +
            '</div>' +
          '</div>';

        var acak = '<div class="col-md-6 col-sm-12">' +
            '<div class="form-group">' +
              '<input type="text" id="gd_acak" class="form-control" value="Gula Darah Acak" disabled>' +
            '</div>' +
          '</div>' +
          '<div class="col-md-6 col-sm-12">' +
            '<div class="form-group">' +
              '<input type="number" name="h_acak" class="form-control" step="0.1" placeholder="0.0" required>' +
            '</div>' +
          '</div>';

        var asam_urat = '<div class="col-md-6 col-sm-12">' +
            '<div class="form-group">' +
              '<input type="text" id="gd_asam_urat" class="form-control" value="Asam Urat" disabled>' +
            '</div>' +
          '</div>' +
          '<div class="col-md-6 col-sm-12">' +
            '<div class="form-group">' +
              '<input type="number" name="h_asam_urat" class="form-control" step="0.1" placeholder="0.0" required>' +
            '</div>' +
          '</div>';

        var element = '<div class="col-md-12">' +
            '<div class="form-group" style="margin-bottom: 0px;">' +
              '<label class="control-label">Hasil Cek Darah</label>' +
            '</div>' +
          '</div>';

        var gd_kolesterol = data['data'][0]['gd_kolesterol'];
        var gd_puasa = data['data'][0]['gd_puasa'];
        var gd_acak = data['data'][0]['gd_acak'];
        var gd_asam_urat = data['data'][0]['gd_asam_urat'];

        // check which service
        if (gd_kolesterol == '1') {
          form_cek_darah += kolesterol;
        }

        if (gd_puasa == '1') {
          form_cek_darah += puasa;
        }

        if (gd_acak == '1') {
          form_cek_darah += acak;
        }

        if (gd_asam_urat == '1') {
          form_cek_darah += asam_urat;
        }

        // appending element
        $('#hasil-cek-darah-out').append(element+form_cek_darah);
      }
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
      check_if_any_form();
    });

    check_if_any_form();
  }
</script>