<section class="content-header">
  <h1>
    Detail Pengobatan
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>pendaftaran-pasien"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
    <li class="active">Detail Pengobatan</li>
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
            <div class="col-md-10"><strong>{new_id_registrasi}</strong></div style="margin-bottom: 10px !important">
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
      <div id="intervensi" class="box box-solid box-warning">
        <div class="box-header">
          <h3 class="box-title">Intervensi</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- ./box-header -->
        <div class="box-body">
          {resep_obat}
          {rujukan}
        </div>
        <!-- ./box-body -->
      </div>
      <!-- #/intervensi -->
    </div>
    <!-- ./box-body -->
  </div>
</section>