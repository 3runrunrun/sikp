<section class="content-header">
  <h1>Data Master</h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-database"></i>&nbsp;Data Master</li>
    <li><i class="fa fa-book"></i>&nbsp;Modul Kesehatan</li>
    <li><a href="<?php echo base_url(); ?>modul-penyakit"><i class="fa fa-database"></i>&nbsp;Modul Penyakit</a></li>
    <li class="active">Formulir Modul Penyakit</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Formulir Modul Penyakit</h3>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {alert_vars}
          <?php echo form_error('nama'); ?>
          <?php echo form_error('tgl_dibuat'); ?>
          <?php echo form_error('versi'); ?>
          <section class="col-md-12">
            <div class="box box-primary">
              <form role="form" action="<?php echo base_url(); ?>store-modul-penyakit" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="row">
                    <div id="modul-penyakit-out"></div>
                    <!-- #/id-mod-penyakit -->
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label class="control-label" style="color: white;">modul</label>
                        <div class="checkbox">
                          <label class="control-label">
                            <input type="checkbox" name="perbarui" id="update-modul-penyakit" onchange="get_latest_modul('penyakit')" value="1">&nbsp;Perbarui Modul Penyakit
                          </label>
                        </div>
                      </div>
                    </div>
                    <!-- /check-box -->
                  </div>
                  <!-- /update -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Nama Modul</label>
                        <input type="text" name="nama" class="form-control" onkeyup="get_latest('penyakit', this)" required>
                      </div>
                    </div>
                  </div>
                  <!-- /nama -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Tanggal Dibuat</label>
                        <input type="date" name="tgl_dibuat" class="form-control" min="<?php $mintime =  strtotime("-10 year"); echo date('Y-m-d', $mintime); ?>" max="<?php echo date('Y-m-d'); ?>" required>
                      </div>
                    </div>
                  </div>
                  <!-- /tgl-dibuat -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Versi</label>
                        <input type="number" name="versi" id="versi" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <!-- /versi -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">File Modul</label>
                        <input type="file" name="file_modul" id="exampleInputFile" required>
                      </div>
                    </div>
                  </div>
                  <!-- /versi -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                  <button type="reset" class="btn btn-danger">Batal</button>
                  <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
                <!-- ./box-footer -->
              </form>
            </div>
          </section>
        </div>
        <!-- ./box-body -->
      </div>
      <!-- ./box -->
    </div>
  </div>
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

  function get_latest_modul(modul) {
    if ($('#update-modul-penyakit').prop('checked') === false) {
      $('#modul-penyakit-out').children().remove();
    } else {
      var curURL = document.URL.split('/');
      var reqURL = './data_master/C_modul_kesehatan/show_all_modul';
      if (curURL[6] !== undefined) {
        reqURL = './../data_master/C_modul_kesehatan/show_all_modul';
      }
      $.ajax({
        url: reqURL,
        type: 'post',
        data: {modul: modul},
        dataType: 'json',
        success: function(data) {
          var option = $.map(data['data'], function(index, value){
            return '<option value="' + index.id_mod_penyakit + '">' + titleCase(index.nama) + ' (Versi '+ index.versi + ')</option>'; 
          });
          var element = '<div class="col-md-8 col-sm-12">' +
            '<div class="form-group">' +
              '<label class="control-label">Modul Penyakit</label>' +
              '<select name="id_mod_penyakit" class="form-control select2-single">' +
                '<option value="" selected disabled>Pilih Modul</option>' +
                option +
              '</select>' +
            '</div>' +
          '</div>';
          $('#modul-penyakit-out').append(element);
          $(".select2-single").select2();
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    }
  }
</script>