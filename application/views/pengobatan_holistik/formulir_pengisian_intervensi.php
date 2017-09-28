<section class="content-header">
  <h1>
    Formulir Pengisian Diagnosis
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>pendaftaran-pasien"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
    <li><i class="fa fa-pencil"></i>&nbsp;Pendaftaran Pengobatan</li>
    <li><i class="fa fa-pencil"></i>&nbsp;Formulir Pengisian Diagnosis</li>
    <li class="active">Formulir Pengisian Intervensi</li>
  </ol>
</section>

<section class="content">
  <div class="box box-solid box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">
        Formulir Pengisian Intervensi
      </h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>

    <div class="box-body">
      {err_vars}
      {alert_vars}
      {status}
      <div id="data-dasar" class="callout callout-info">
        <div class="row text-purple" style="margin-bottom: 10px !important">
          <h4>
            <div class="col-md-2"><strong>No. Registrasi</strong></div>
            <div class="col-md-10"><strong>{id_registrasi}</strong></div style="margin-bottom: 10px !important">
          </h4>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Nama (No. BPJS):</strong></div>
          <div class="col-md-4">{nama}&nbsp;({no_bpjs})</div>
          <div class="col-md-2"><strong>Jenis Kelamin:</strong></div>
          <div class="col-md-4">{jenis_kelamin}</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Umur:</strong></div>
          <div class="col-md-4">{umur} tahun</div>
        </div>
        <div class="row">
          <div class="col-md-2"><strong>Alamat:</strong></div>
          <div class="col-md-4">{alamat}</div>
        </div>
      </div>
      <!-- #/data-dasar -->
      <div id="pemeriksaan-fisik" class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="tekanan-darah" class="control-label">Tekanan Darah</label>
                <input type="text" name="td" id="tekanan-darah" class="form-control" value="{td}" readonly>
              </div>
            </div>
            <!-- /tekanan-darah -->
            <div class="col-md-2">
              <div class="form-group">
                <label for="rr" class="control-label">RR</label>
                <input type="text" name="rr" id="rr" class="form-control" value="{rr}" readonly>
              </div>
            </div>
            <!-- /rr -->
            <div class="col-md-2">
              <div class="form-group">
                <label for="nadi" class="control-label">Nadi</label>
                <input type="text" name="nadi" id="nadi" class="form-control" value="{nadi}" readonly>
              </div>
            </div>
            <!-- /nadi -->
            <div class="col-md-2">
              <div class="form-group">
                <label for="suhu-badan" class="control-label">Suhu Badan</label>
                <input type="text" name="suhu" id="suhu-badan" class="form-control" value="{suhu}" readonly>
              </div>
            </div>
            <!-- /suhu-badan -->
            <div class="col-md-2">
              <div class="form-group">
                <label for="alergi-obat" class="control-label">Alergi Obat</label>
                <input type="text" name="alergi_obat" id="alergi-obat" class="form-control" value="{alergi_obat}" readonly>
              </div>
            </div>
            <!-- /alergi-obat -->
            <div class="col-md-2">
              <div class="form-group">
                <label for="alergi-makanan" class="control-label">Alergi Makanan</label>
                <input type="text" name="alergi_makanan" id="alergi-makanan" class="form-control" value="{alergi_makanan}" readonly>
              </div>
            </div>
            <!-- /alergi-makanan -->
          </div>
        </div>
      </div>
      <!-- #/pemeriksaan-fisik -->
      {/status}

      <div id="anamnesis" class="box box-solid box-warning collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Anamnesis Pasien</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            {anamnesis}
            <div class="col-md-2">
              <div class="form-group">
                <label for="keluhan" class="control-label">Anamnesis</label>
                <textarea name="keluhan[]" id="keluhan" class="form-control" readonly>{keluhan}</textarea>
              </div>
            </div>
            {/anamnesis}
          </div>
        </div>
      </div>
      <!-- #/anamnesis -->
      <div id="diagnosis" class="box box-solid box-warning collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Diagnosis Penyakit</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          {status}
          <input type="hidden" name="id_registrasi" value="{id_registrasi}">
          <input type="hidden" name="nik_tenaga_medis" value="{nik_tenaga_medis}">
          <input type="hidden" name="no_bpjs" value="{no_bpjs}">
          {/status}
          {diagnosis}
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="penyakit" class="control-label">Penyakit</label>
                <input type="hidden" class="form-control" value="{id_diagnosa}" readonly>
                <input type="text" class="form-control" value="{penyakit}" readonly>
              </div>
            </div>
            <!-- /penyakit -->
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Modul Penyakit</label>
                <input type="hidden" class="form-control modul-penyakit" value="{id_mod_penyakit}" readonly>
                <input type="text" class="form-control" value="{nama}&nbsp;(Versi: {versi})" readonly>
                <span class="help-block pull-right"><a target="_blank" class="read-modul-penyakit" href="">Baca Modul</a></span>
              </div>
            </div>
            <!-- /modul-penyakit -->
            <div class="col-md-3">
              <div class="form-group">
                <label  class="control-label">Terapi</label>
                <input type="text" class="form-control" value="{terapi}" readonly>
              </div>
            </div>
            <!-- /terapi -->
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Lokasi Intervensi</label>
                <input type="text" class="form-control" value="{lokasi_intervensi}" readonly>
              </div>
            </div>
            <!-- /lokasi-intervensi -->
          </div>
          {/diagnosis}
        </div>
      </div>
      <!-- #/diagnosis -->
      <div id="pemicu-risiko" class="box box-solid box-warning collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Faktor Risiko dan Faktor Pemicu Penyakit</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          {faktor_risiko}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="faktor-risiko" class="control-label">Faktor Risiko Penyakit</label>
                <input type="hidden" class="form-control" value="{id_faktor_risiko}">
                <input type="text" class="form-control" value="{faktor_risiko}" readonly>
                <span class="help-block"><small>&nbsp;</small></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="modul-faktor-risiko" class="control-label">Modul Faktor Risiko</label>
                <input type="hidden" class="form-control modul-faktor-risiko" value="{id_mod_faktor_risiko}">
                <input type="text" class="form-control" value="{nama}&nbsp;(Versi: {versi})" readonly>
                <span class="help-block pull-right"><a target="_blank" href="" class="read-modul-faktor-risiko">Baca Modul</a></span>
              </div>
            </div>
          </div>
          {/faktor_risiko}
          <!-- /faktor-risiko-penyakit -->
          {faktor_pemicu}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="faktor-pemicu" class="control-label">Faktor Pemicu Penyakit</label>
                <input type="hidden" class="form-control" value="{id_faktor_pemicu}">
                <input type="text" class="form-control" value="{faktor_pemicu}" readonly>
                <span class="help-block"><small>&nbsp;</small></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="modul-faktor-pemicu" class="control-label">Modul Faktor Pemicu</label>
                <input type="hidden" class="form-control modul-faktor-pemicu" value="{id_mod_faktor_pemicu}">
                <input type="text" class="form-control" value="{nama}&nbsp;(Versi: {versi})" readonly>
                <span class="help-block pull-right"><a target="_blank" href="" class="read-modul-faktor-pemicu">Baca Modul</a></span>
              </div>
            </div>
          </div>
          {/faktor_pemicu}
        </div>
      </div>
      <!-- #/pemicu-risiko -->
    </div>
    <!-- ./box-body -->
  </div>
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Intervensi</h3>
      </div>
      <!-- ./box-header -->
      <form role="form" action="<?php echo base_url() ?>simpan-intervensi" method="post">
        <div class="box-body">
          <?php echo form_error('id_registrasi'); ?>
          <?php echo form_error('no_bpjs'); ?>
          <?php echo form_error('nik_tenaga_medis'); ?>
          <?php echo form_error('jenis_pasien'); ?>
          <?php echo form_error('rs'); ?>
          <?php echo form_error('jenis_rujukan'); ?>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                {status}
                <input type="text" name="id_registrasi" id="id-registrasi" value="{id_registrasi}">
                <input type="text" name="no_bpjs" id="no-bpjs" value="{no_bpjs}">
                <input type="text" name="nik_tenaga_medis" id="nik-tenaga-medis" value="{nik_tenaga_medis}">
                {/status}
                <label class="control-label">Pilih Intervensi yang akan diberikan</label>
                <select id="jenis-intervensi" name="jenis_intervensi" class="form-control" onchange="select_intervensi(this)">
                  <option value="" selected disabled>Pilih opsi</option>
                  <option value="1">Resep Obat</option>
                  <option value="2">Rujukan</option>
                  <option value="3">Anjuran Cek Darah</option>
                </select>
              </div>
            </div>
          </div>
          <div id="intervensi-out"></div>
          <!-- #/intervensi-out -->
        </div>
        <!-- ./box-body -->
        <div class="box-footer">
          <button type="reset" class="btn btn-danger">Batal</button>
          <button type="submit" class="btn btn-primary pull-right">Simpan</button>
        </div>
        <!-- ./box-footer -->
      </form>
    </div>
  <!-- /intervensi -->
</section>
<script type="text/javascript">
  $(document).ready(function(){
    // preparing url for modul penyakit
    $.each($('.modul-penyakit'), function(index, val){
      var uri = 'http://localhost/sikp/mod_files/modul_penyakit/';
      var mod_name = $(val).val() + '.pdf';
      var selector_target = $(val).siblings('.help-block').children('.read-modul-penyakit');
      $(selector_target).attr('href', uri + mod_name);
    });

    $.each($('.modul-faktor-risiko'), function(index, val){
      var uri = 'http://localhost/sikp/mod_files/modul_faktor_risiko/';
      var mod_name = $(val).val() + '.pdf';
      var selector_target = $(val).siblings('.help-block').children('.read-modul-faktor-risiko');
      $(selector_target).attr('href', uri + mod_name);
    });

    $.each($('.modul-faktor-pemicu'), function(index, val){
      var uri = 'http://localhost/sikp/mod_files/modul_faktor_pemicu/';
      var mod_name = $(val).val() + '.pdf';
      var selector_target = $(val).siblings('.help-block').children('.read-modul-faktor-pemicu');
      $(selector_target).attr('href', uri + mod_name);
    });
  });
</script>
<script type="text/javascript">
  function select_intervensi(selector){
    var jenis_intervensi = $(selector).find(':selected').val();
    var element;
    console.log(jenis_intervensi);

    if (jenis_intervensi == '1') {
      element = resep_obat();
    } else if (jenis_intervensi == '2') {
      element = rujukan();
    } else if (jenis_intervensi == '3') {
      element = cek_darah();
    }

    $('#intervensi-out').children().remove();
    $('#intervensi-out').append(element);
  }

  function resep_obat(){
    var element = '<div class="row">' +
      '<div class="col-md-12">' +
        '<div class="callout callout-warning">' +
          '<h4>Pemberian Resep</h4>' +
          '<p>Pastikan resep telah diberikan kepada pasien.</p>' +
        '</div>' +
        '<input type="hidden" name="jenis_pasien" value="1">' +
      '</div>' +
    '</div>';

    return element;
  }

  function rujukan(){
    var element = '<div class="row">' +
        '<div class="col-md-6 col-sm-12">' +
          '<div class="form-group">' +
            '<label class="control-label">Rumah Sakit atau Puskesmas Rujukan</label>' +
            '<input type="text" name="rs" class="form-control" required>' +
          '</div>' +
        '</div>' +
        '<div class="col-md-6 col-sm-12">' +
          '<div class="form-group">' +
            '<label class="control-label">Jenis Rujukan</label>' +
            '<select name="jenis_rujukan" class="form-control" required>' +
              '<option value="" selected disabled>Pilih Opsi</option>' +
              '<option value="1">Rawat Inap</option>' +
              '<option value="2">Rawat Jalan</option>' +
              '<option value="3">UGD</option>' +
            '</select>' +
          '</div>' +
        '</div>' +
      '</div>';
   
    return element;
  }

  function cek_darah(){
    var element = '<div class="row">' +
      '<div class="col-md-12">' +
        '<div class="callout callout-warning">' +
          '<h4>Pemberian Surat Pengantar Cek Darah</h4>' +
          '<p>Pastikan surat pengantar cek darah telah diberikan kepada pasien.</p>' +
        '</div>' +
      '</div>' +
    '</div>';

    return element;
  }
</script>