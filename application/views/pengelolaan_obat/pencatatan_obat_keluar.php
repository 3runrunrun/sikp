<section class="content-header">
  <h1>
    Pengelolaan Obat
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-medkit"></i>&nbsp;Pengelolaan Obat</li>
    <li class="active">Formulir Pencatatan Obat Keluar</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Formulir Pencatatan Obat Keluar</h3>
    </div>
    <!-- ./box-header -->

    <form role="form" action="<?php echo base_url(); ?>simpan-pencatatan-obat-keluar" method="post">
      <div class="box-body">
        {err_vars}
        {alert_vars}
        <?php echo form_error('id_resep_obat'); ?>
        <?php echo form_error('id_obat[]'); ?>
        <?php echo form_error('jumlah_keluar[]'); ?>
        <!-- /alert-template -->
        <div class="row">
          <div id="status-out" class="col-md-12"></div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="resep-obat" class="control-label">Resep Terdaftar</label>
              <select name="id_resep_obat" id="resep-obat" class="form-control select2" style="width: 100% !important;" onchange="show_status_by_resep(this)" required>
                <option value="" selected disabled>Pilih Resep Terdaftar</option>
                {resep}
                <option value="{id_resep_obat}">{nama}</option>
                {/resep}
              </select>
            </div>
          </div>
        </div>
        <!-- /resep-obat -->
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="obat" class="control-label">Pilih Obat</label>
              <select name="id_obat[]" id="obat" class="form-control select2" style="width: 100% !important;" onchange="get_harga(this)" required>
                <option value="" selected disabled>Pilih Obat</option>
                {obat}
                <option value="{id_obat}">{nama}&nbsp;(Persediaan: {jumlah}&nbsp;{satuan})</option>
                {/obat}
              </select>
            </div>
          </div>
          <!-- /obat -->
          <div class="col-md-1 col-sm-5 col-xs-5">
            <div class="form-group">
              <label class="control-label">Signa</label>
              <input type="number" name="a_signa[]" step="1" min="1" class="form-control" placeholder="0" required>
            </div>
          </div>
          <!-- /a-signa -->
          <div class="col-md-1 col-sm-2 col-xs-2" style="width: 10px">
            <div class="form-group">
              <label class="control-label" style="color: white">Signa</label><br />
              <label class="control-label">&times;</label>
            </div>
          </div>
          <!-- /times -->
          <div class="col-md-1 col-sm-5 col-xs-5">
            <div class="form-group">
              <label class="control-label" style="color: white">Signa</label>
              <input type="number" name="b_signa[]" step="1" min="1" class="form-control" placeholder="0" required>
            </div>
          </div>
          <!-- /b-signa -->
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <label for="jumlah-keluar" class="control-label">Jumlah Obat Keluar</label>
              <input type="number" min="1" name="jumlah_keluar[]" class="form-control jumlah" step="1" placeholder="0">
              <span class="help-block"><small>Dalam butir atau botol</small></span>
            </div>
          </div>
          <!-- /jumlah-keluar -->
        </div>
        <!-- /obat -->
        <div id="obat-keluar-out"></div>
        <!-- /obat-out -->
        <div class="row">
          <div class="col-md-2 col-sm-12">
            <div class="form-group">
              <button type="button" id="add-obat-keluar" class="btn btn-success" style="width: 100% !important;"><i class="fa fa-plus"></i>&nbsp;Tambah Obat</button>
            </div>
          </div>
        </div>
        <!-- /tombol-tambah-obat -->
      </div>
      <!-- ./box-body -->
      <div class="box-footer">
        <button type="reset" class="btn btn-danger">Batal</button>
        <button type="submit" class="btn btn-primary pull-right">Simpan</button>
      </div>
      <!-- ./box-footer -->
    </form>
  </div>
  <!-- ./box -->
</section>
<script type="text/javascript">
  function titleCase(str) {
    str = str.toLowerCase().split(' ');                // will split the string delimited by space into an array of words

    for(var i = 0; i < str.length; i++){               // str.length holds the number of occurrences of the array...
        str[i] = str[i].split('');                    // splits the array occurrence into an array of letters
        str[i][0] = str[i][0].toUpperCase();          // converts the first occurrence of the array to uppercase
        str[i] = str[i].join('');                     // converts the array of letters back into a word.
    }
    return str.join(' ');                              //  converts the array of words back to a sentence.
  }

  function show_status_by_resep(selector){
    var id_resep_obat = $(selector).val();
    console.log(id_resep_obat);

    $('#status-out').children().remove();
    $.ajax({
      url: './pengelolaan_obat/C_pencatatan_obat_keluar/show_status_by_resep',
      type: 'post',
      dataType: 'json',
      data: {id_resep_obat: id_resep_obat},
      success: function(data){
        console.log(data['data']);
        var nama = data['data'][0]['nama'];
        var id_registrasi = data['data'][0]['id_registrasi'];
        var umur = data['data'][0]['umur'];
        var jenis_kelamin = data['data'][0]['jenis_kelamin'];
        var nama_dokter = data['data'][0]['nama_dokter'];
        var poli = data['data'][0]['poli'];

        if (jenis_kelamin === 'l') {
          jenis_kelamin = jenis_kelamin.replace('l', 'Laki-laki');
        } else if (jenis_kelamin === 'p') {
          jenis_kelamin = jenis_kelamin.replace('p', 'Perempuan');
        }

        var first = id_registrasi.substring(0,4);
        var second = id_registrasi.substring(6,10);
        var third = id_registrasi.substring(12,14);
        var new_id = first + second + third;

        var element = '<div class="form-group">' +
            '<div class="callout callout-info">' +
              '<div class="row">' +
                '<div class="col-md-2"><strong>Nama (ID Registrasi):</strong></div>' +
                '<div class="col-md-4">' + titleCase(nama) + '&nbsp;(' + new_id + ')</div>' +
                '<div class="col-md-2"><strong>Poli (Dokter):</strong></div>' +
                '<div class="col-md-4">' + titleCase(poli) + ' (' + titleCase(nama_dokter) + ')</div>' +
              '</div>' +
              '<div class="row">' +
                '<div class="col-md-2"><strong>Umur:</strong></div>' +
                '<div class="col-md-4">' + umur + ' tahun</div>' +
              '</div>' +
              '<div class="row">' +
                '<div class="col-md-2"><strong>Jenis Kelamin:</strong></div>' +
                '<div class="col-md-4">' + jenis_kelamin + '</div>' +
              '</div>' +
            '</div>' +
          '</div>';

        $('#status-out').append(element);
      }
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  }
</script>