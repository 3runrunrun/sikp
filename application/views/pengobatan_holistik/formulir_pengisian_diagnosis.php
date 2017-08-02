<section class="content-header">
        <h1>
          Formulir Pengisian Diagnosis
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>data-dasar-kesehatan"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
          <li>Daftar Pasien Terdaftar</li>
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
            <?php foreach ($pasien_identitas['data'] as $key => $value): ?>
            <div id="data-dasar" class="callout callout-info">
              <div class="row text-purple" style="margin-bottom: 10px !important">
                <h4>
                  <div class="col-md-2"><strong>No. Registrasi</strong></div>
                  <div class="col-md-10"><strong><?php echo $value['id_registrasi']; ?></strong></div style="margin-bottom: 10px !important">
                </h4>
              </div>
              <div class="row">
                <div class="col-md-2"><strong>Nama (No. BPJS):</strong></div>
                <div class="col-md-4"><?php echo $value['nama']; ?>&nbsp;<?php echo '(' . $value['no_bpjs'] . ')'; ?></div>
                <div class="col-md-2"><strong>Jenis Kelamin:</strong></div>
                <div class="col-md-4">
                <?php 
                  switch ($value['jenis_kelamin']) {
                    case 'L':
                    case 'l':
                      echo 'Laki-Laki';
                      break;
                    
                    case 'P':
                    case 'p':
                      echo 'Perempuan';
                      break;
                  }
                 ?>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2"><strong>Umur:</strong></div>
                <div class="col-md-4"><?php echo $value['umur'] . ' tahun/bulan'; ?></div>
              </div>
              <div class="row">
                <div class="col-md-2"><strong>Pekerjaan:</strong></div>
                <div class="col-md-4"><?php echo ucwords($value['pekerjaan_utama']); ?></div>
              </div>
              <div class="row">
                <div class="col-md-2"><strong>Alamat:</strong></div>
                <div class="col-md-4"><?php echo ucwords($value['alamat']); ?></div>
              </div>
            </div>
            <!-- #/data-dasar -->

            <div id="pemeriksaan-fisik" class="box box-primary">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="tekanan-darah" class="control-label">Tekanan Darah</label>
                      <input type="text" name="td" id="tekanan-darah" class="form-control" value="<?php echo $value['td']; ?>" disabled>
                    </div>
                  </div>
                  <!-- /tekanan-darah -->
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="rr" class="control-label">RR</label>
                      <input type="text" name="rr" id="rr" class="form-control" value="<?php echo $value['rr']; ?>" disabled>
                    </div>
                  </div>
                  <!-- /rr -->
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="nadi" class="control-label">Nadi</label>
                      <input type="text" name="nadi" id="nadi" class="form-control" value="<?php echo $value['nadi']; ?>" disabled>
                    </div>
                  </div>
                  <!-- /nadi -->
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="suhu-badan" class="control-label">Suhu Badan</label>
                      <input type="text" name="suhu" id="suhu-badan" class="form-control" value="<?php echo $value['suhu']; ?>" disabled>
                    </div>
                  </div>
                  <!-- /suhu-badan -->
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="alergi-obat" class="control-label">Alergi Obat</label>
                      <input type="text" name="alergi_obat" id="alergi-obat" class="form-control" value="<?php echo $value['alergi_obat']; ?>" disabled>
                    </div>
                  </div>
                  <!-- /alergi-obat -->
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="alergi-makanan" class="control-label">Tekanan Darah</label>
                      <input type="text" name="alergi_makanan" id="alergi-makanan" class="form-control" value="<?php echo $value['alergi_makanan']; ?>" disabled>
                    </div>
                  </div>
                  <!-- /alergi-makanan -->
                </div>
              </div>
            </div>
            <!-- #/pemeriksaan-fisik -->
            <?php endforeach; ?>

            <form role="form" action="<?php echo base_url() ?>simpan-pengisian-diagnosis" method="post">
              <div id="diagnosis" class="box box-solid box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Diagnosis Penyakit</h3>
                </div>
                <div class="box-body">
                  <?php echo form_error('id_registrasi'); ?>
                  <?php echo form_error('nik_tenaga_medis'); ?>
                  <?php echo form_error('no_bpjs'); ?>
                  <?php 
                    $id_registrasi = null;
                    $nik_tenaga_medis = null;
                    $no_bpjs = null;
                   ?>
                  <?php foreach ($keluhan['data'] as $key => $value): ?>
                  <?php if ($key == '1'): ?>
                  <input type="hidden" name="id_registrasi" value="<?php echo $value['id_registrasi']; echo set_value('id_registrasi'); ?>">
                  <input type="hidden" name="nik_tenaga_medis" value="<?php echo $value['nik_tenaga_medis']; echo set_value('nik_tenaga_medis'); ?>">
                  <input type="hidden" name="no_bpjs" value="<?php echo $value['no_bpjs']; echo set_value('no_bpjs'); ?>">
                  <?php endif; ?>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="anamnesis" class="control-label">Anamnesis</label>
                        <textarea name="anamnesis[]" id="anamnesis" class="form-control" disabled><?php echo ucfirst($value['anamnesis']); ?></textarea>
                      </div>
                    </div>
                    <!-- /anamnesis -->
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="penyakit" class="control-label">Penyakit</label>
                        <input type="text" name="penyakit[]" id="penyakit" class="form-control" value="<?php echo set_value('penyakit[]'); ?>">
                        <?php echo form_error('penyakit[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;<small>', '</small></span>'); ?>
                      </div>
                    </div>
                    <!-- /penyakit -->
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="modul-penyakit-<?php echo $key ?>" class="control-label">Modul Penyakit</label>
                        <select name="id_mod_penyakit[]" id="modul-penyakit-<?php echo $key ?>" class="form-control select2 modul-penyakit" style="width: 100% !important;">
                          <option value="" selected disabled>Pilih Modul</option>
                          <?php foreach ($modul_penyakit['data'] as $modul): ?>
                          <option value="<?php echo $modul['id_mod_penyakit']; ?>" <?php echo set_select('id_mod_penyakit[]', $modul['id_mod_penyakit']); ?>><?php echo ucwords($modul['nama']); ?>&nbsp;(Versi: <?php echo $modul['versi']; ?>)</option>
                          <?php endforeach; ?>
                        </select>
                        <span class="help-block"><small><a target="_blank" id="read-modul-penyakit-<?php echo $key ?>" href="">Baca Modul</a></small></span>
                        <?php echo form_error('id_mod_penyakit[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;<small>', '</small></span>'); ?>
                      </div>
                    </div>
                    <!-- /modul-penyakit -->
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="terapi" class="control-label">Terapi</label>
                        <input type="text" name="terapi[]" id="terapi" class="form-control" value="<?php echo set_value('terapi[]'); ?>">
                        <?php echo form_error('terapi[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;<small>', '</small></span>'); ?>
                      </div>
                    </div>
                    <!-- /terapi -->
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="lokasi-intervensi" class="control-label">Lokasi Intervensi</label>
                        <select name="lokasi_intervensi[]" id="lokasi-intervensi" class="form-control">
                          <option value="" selected disabled>Pilih Lokasi Intervensi</option>
                          <option value="1">Klinik</option>
                          <option value="2">Rumah Sakit</option>
                          <option value="3">Tempat Tinggal</option>
                          <option value="4">Tempat Kerja</option>
                        </select>
                        <?php echo form_error('lokasi_intervensi[]', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;<small>', '</small></span>'); ?>
                      </div>
                    </div>
                    <!-- /lokasi-intervensi -->
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <!-- #/diagnosis -->
              <div id="pemicu-risiko" class="box box-solid box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Faktor Risiko dan Faktor Pemicu Penyakit</h3>
                </div>
                <div class="box-body">
                  <?php echo form_error('faktor_risiko[]'); ?>
                  <?php echo form_error('faktor_pemicu[]'); ?>
                  <?php echo form_error('id_mod_faktor_risiko[]'); ?>
                  <?php echo form_error('id_mod_faktor_pemicu[]') ?>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="faktor-risiko" class="control-label">Faktor Risiko Penyakit</label>
                        <input type="text" name="faktor_risiko[]" id="faktor-risiko" class="form-control">
                        <span class="help-block"><small>&nbsp;</small></span>
                      </div>
                      <div class="form-group">
                        <label for="faktor-pemicu" class="control-label">Faktor Pemicu Penyakit</label>
                        <input type="text" name="faktor_pemicu[]" id="faktor-pemicu" class="form-control">
                        <span class="help-block"><small>&nbsp;</small></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="modul-faktor-risiko" class="control-label">Modul Faktor Risiko</label>
                        <select name="id_mod_faktor_risiko[]" id="modul-faktor-risiko" class="form-control select2 modul-faktor-risiko" style="width: 100% !important;">
                          <option value="" selected disabled>Pilih Modul</option>
                          <?php foreach ($modul_faktor_risiko['data'] as $value): ?>
                          <option value="<?php echo $value['id_mod_faktor_risiko']; ?>"><?php echo ucwords($value['nama']); ?>&nbsp;(Versi: <?php echo $value['versi']; ?>)</option>
                          <?php endforeach; ?>
                        </select>
                        <span class="help-block"><small><a target="_blank" href="">Baca Modul</a></small></span>
                      </div>
                      <div class="form-group">
                        <label for="modul-faktor-pemicu" class="control-label">Modul Faktor Pemicu</label>
                        <select name="id_mod_faktor_pemicu[]" id="modul-faktor-pemicu" class="form-control select2 modul-faktor-pemicu" style="width: 100% !important;">
                          <option value="" selected disabled>Pilih Modul</option>
                          <?php foreach ($modul_faktor_pemicu['data'] as $value): ?>
                          <option value="<?php echo $value['id_mod_faktor_pemicu']; ?>"><?php echo ucwords($value['nama']); ?>&nbsp;(Versi: <?php echo $value['versi']; ?>)</option>
                          <?php endforeach; ?>
                        </select>
                        <span class="help-block"><small><a target="_blank" href="">Baca Modul</a></small></span>
                      </div>
                    </div>
                  </div>
                  <div id="pemicu-risiko-out"></div>
                  <!-- #/pemicu-risiko-out -->
                  <div id="tombol-tambah-faktor" class="row">
                    <div class="col-md-12">
                      <button type="button" id="add-faktor" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Faktor Risiko dan Faktor Pemicu Penyakit</button>
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