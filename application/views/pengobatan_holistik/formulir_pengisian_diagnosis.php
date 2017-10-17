<section class="content-header">
  <h1>
    Formulir Pengisian Diagnosis
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>pendaftaran-pasien"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
    <li><i class="fa fa-pencil"></i>&nbsp;Pendaftaran Pengobatan</li>
    <li class="active">Formulir Pengisian Diagnosis</li>
  </ol>
</section>

<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">
        Formulir Pengisian Diagnosis
      </h3>
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

      <div id="anamnesis" class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Anamnesis Pasien</h3>
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

      <form role="form" action="<?php echo base_url() ?>simpan-diagnosis" method="post">
        <div id="diagnosis" class="box box-solid box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Diagnosis Penyakit</h3>
          </div>
          <div class="box-body">
            <?php echo form_error('id_registrasi'); ?>
            <?php echo form_error('nik_tenaga_medis'); ?>
            <?php echo form_error('no_bpjs'); ?>
            <?php echo form_error('penyakit[]'); ?>
            <?php echo form_error('terapi[]'); ?>
            {status}
            <input type="hidden" name="id_registrasi" value="{id_registrasi}">
            <input type="hidden" name="nik_tenaga_medis" value="{nik_tenaga_medis}">
            <input type="hidden" name="no_bpjs" value="{no_bpjs}">
            {/status}
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="penyakit" class="control-label">Penyakit</label>
                  <input type="text" name="penyakit[]" id="penyakit" class="form-control" required>
                </div>
              </div>
              <!-- /penyakit -->
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label">Modul Penyakit</label>
                  <select name="id_mod_penyakit[]" class="form-control select2 modul-penyakit" style="width: 100% !important;" onchange="get_modul_penyakit(this)" required>
                    <option value="" selected disabled>Pilih Modul</option>
                    {modul_penyakit}
                    <option value="{id_mod_penyakit}">{nama}&nbsp;(Versi: {versi})</option>
                    {/modul_penyakit}
                  </select>
                  <span class="help-block pull-right"><a target="_blank" class="read-modul-penyakit" id="read-modul-penyakit-<?php echo $key ?>" href="">Baca Modul</a></span>
                </div>
              </div>
              <!-- /modul-penyakit -->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="terapi" class="control-label">Terapi</label>
                  <input type="text" name="terapi[]" id="terapi" class="form-control" required>
                </div>
              </div>
              <!-- /terapi -->
              <div class="col-md-3">
                <div class="form-group">
                  <label for="lokasi-intervensi" class="control-label">Lokasi Intervensi</label>
                  <select name="lokasi_intervensi[]" id="lokasi-intervensi" class="form-control" required>
                    <option value="" selected disabled>Pilih Lokasi Intervensi</option>
                    <option value="1">Klinik</option>
                    <option value="2">Rumah Sakit</option>
                    <option value="3">Tempat Tinggal</option>
                    <option value="4">Tempat Kerja</option>
                  </select>
                </div>
              </div>
              <!-- /lokasi-intervensi -->
            </div>
            <div id="diagnosis-out"></div>
            <!-- #/diagnosis-out -->
            <div id="tombol-tambah-diagnosis" class="row">
              <div class="form-group">
                <div class="col-md-4">
                  <button type="button" id="add-diagnosis" class="btn btn-block btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Diagnosis</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- #/diagnosis -->
        <div id="pemicu-risiko" class="box box-solid box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Faktor Risiko dan Faktor Pemicu Penyakit</h3>
          </div>
          <div class="box-body">
            <?php echo form_error('faktor_risiko[]'); ?>
            <?php echo form_error('id_mod_faktor_risiko[]'); ?>
            <?php echo form_error('faktor_pemicu[]'); ?>
            <?php echo form_error('id_mod_faktor_pemicu[]'); ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="faktor-risiko" class="control-label">Faktor Risiko Penyakit</label>
                  <input type="text" name="faktor_risiko[]" id="faktor-risiko" class="form-control" required>
                  <span class="help-block"><small>&nbsp;</small></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="modul-faktor-risiko" class="control-label">Modul Faktor Risiko</label>
                  <select name="id_mod_faktor_risiko[]" id="modul-faktor-risiko" class="form-control select2 modul-faktor-risiko" style="width: 100% !important;" onchange="get_modul_faktor_risiko(this)" required>
                    <option value="" selected disabled>Pilih Modul</option>
                    {modul_faktor_risiko}
                    <option value="{id_mod_faktor_risiko}">{nama}&nbsp;(Versi: {versi})</option>
                    {/modul_faktor_risiko}
                  </select>
                  <span class="help-block pull-right"><a target="_blank" href="" class="read-modul-faktor-risiko">Baca Modul</a></span>
                </div>
              </div>
            </div>
            <!-- /faktor-risiko-penyakit -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="faktor-pemicu" class="control-label">Faktor Pemicu Penyakit</label>
                  <input type="text" name="faktor_pemicu[]" id="faktor-pemicu" class="form-control" required>
                  <span class="help-block"><small>&nbsp;</small></span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="modul-faktor-pemicu" class="control-label">Modul Faktor Pemicu</label>
                  <select name="id_mod_faktor_pemicu[]" id="modul-faktor-pemicu" class="form-control select2 modul-faktor-pemicu" style="width: 100% !important;" onchange="get_modul_faktor_pemicu(this)" required>
                    <option value="" selected disabled>Pilih Modul</option>
                    {modul_faktor_pemicu}
                    <option value="{id_mod_faktor_pemicu}">{nama}&nbsp;(Versi: {versi})</option>
                    {/modul_faktor_pemicu}
                  </select>
                  <span class="help-block pull-right"><a target="_blank" href="" class="read-modul-faktor-pemicu">Baca Modul</a></span>
                </div>
              </div>
            </div>
            <!-- /faktor-pemicu-penyakit -->
            <div id="pemicu-risiko-out"></div>
            <!-- #/pemicu-risiko-out -->
            <div id="tombol-tambah-faktor" class="row">
              <div class="col-md-6">
                <button type="button" id="add-faktor-risiko" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Faktor Risiko</button>
                <button type="button" id="add-faktor-pemicu" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Faktor Pemicu Penyakit</button>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="reset" class="btn btn-danger">Batal</button>
            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
          </div>
        </div>
        <!-- #/pemicu-risiko -->
      </form>
    </div>
    <!-- ./box-body -->
    <div class="box-footer"></div>
    <!-- ./box-footer -->
  </div>
</section>