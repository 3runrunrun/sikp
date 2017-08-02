<section class="content-header">
        <h1>
          Formulir Pengisian Anamnesis
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>data-dasar-kesehatan"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
          <li>Daftar Pasien Terdaftar</li>
          <li class="active">Formulir Pengisian Anamnesis</li>
        </ol>
      </section>

      <section class="content">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Formulir Pengisian Anamnesis</h3>
          </div>
          <!-- ./box-header -->
          <form role="form" action="<?php echo base_url() ?>simpan-pengisian-anamnesis" method="post">
            <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi; ?>">
            <div class="box-body">
              <?php foreach ($pasien_identitas['data'] as $value): ?>
              <input type="hidden" name="no_bpjs" value="<?php echo $value['no_bpjs']; ?>">
              <input type="hidden" name="nik_tenaga_medis" value="<?php echo $value['nik_tenaga_medis']; ?>">
              <?php echo form_error('id_registrasi'); ?>
              <?php echo form_error('no_bpjs'); ?>
              <?php echo form_error('nik_tenaga_medis'); ?>
              <div class="callout callout-info">
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
            <?php endforeach; ?>
              <!-- ./callout -->
              <div class="box box-primary">
                <div class="box-body">
                  <div id="pemeriksaan-fisik" class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="tekanan-darah" class="control-label">Tekanan Darah</label>
                        <input type="text" name="td" id="tekanan-darah" class="form-control" value="<?php echo set_value('td'); ?>">
                        <?php echo form_error('td', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;<small>', '</small></span>'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="rr" class="control-label">RR</label>
                        <input type="text" name="rr" id="rr" class="form-control" value="<?php echo set_value('rr'); ?>">
                        <?php echo form_error('rr', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;<small>', '</small></span>'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="nadi" class="control-label">Nadi</label>
                        <input type="number" name="nadi" id="nadi" class="form-control" value="<?php echo set_value('nadi'); ?>" min="0" max="999">
                        <?php echo form_error('nadi', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;<small>', '</small></span>'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="suhu-badan" class="control-label">Suhu Badan</label>
                        <input type="number" name="suhu" id="suhu-badan" class="form-control" value="<?php echo set_value('suhu'); ?>" min="0" max="100">
                        <?php echo form_error('suhu', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;<small>', '</small></span>'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="alergi-obat" class="control-label">Alergi Obat</label>
                        <input type="text" name="alergi_obat" id="alergi-obat" class="form-control" value="<?php echo set_value('alergi_obat'); ?>">
                        <span class="help-block"><small>Isi dengan "-" jika tidak terdapat alergi</small></span>
                        <?php echo form_error('alergi_obat', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;<small>', '</small></span>'); ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="alergi_makanan" class="control-label">Alergi Makanan</label>
                        <input type="text" name="alergi_makanan" id="alergi_makanan" class="form-control" value="<?php echo set_value('alergi_makanan'); ?>">
                        <span class="help-block"><small>Isi dengan "-" jika tidak terdapat alergi</small></span>
                        <?php echo form_error('alergi_makanan', '<span class="help-block" style="color: #dd4b39"><i class="fa fa-times-circle-o"></i>&nbsp;<small>', '</small></span>'); ?>
                      </div>
                    </div>
                  </div>
                  <!-- #/pemeriksaan-fisik -->
                  <?php echo form_error('keluhan[]'); ?>
                  <div class="row" style="margin-bottom: 20px !important">
                    <div class="form-group">
                      <div class="col-md-6">
                        <label for="keluhan" class="control-label">Keluhan Pasien</label>
                        <textarea name="keluhan[]" class="form-control"><?php echo set_value('keluhan[]'); ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div id="keluhan-out"></div>
                  <!-- #/keluhan-out -->
                  <div id="tombol-tambah-keluhan" class="row">
                    <div class="form-group">
                      <div class="col-md-12">
                        <button type="button" id="add-anamnesis" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Keluhanan</button>
                      </div>
                    </div>
                  </div>
                  <!-- #/tombol-tambah-keluhan -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                  <button type="reset" class="btn btn-danger">Batal</button>
                  <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
                <!-- ./box-footer -->
              </div>
              <!-- ./box -->
            </div>
            <!-- ./box-body -->
          </form>
          <!-- /form -->
        </div>
      </section>