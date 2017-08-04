<section class="content-header">
        <h1>
          Formulir Pendaftaran Pengobatan Pasien
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url(); ?>daftar-pasien-terdaftar"><i class="fa fa-stethoscope"></i>&nbsp;Pengobatan Holistik</a></li>
          <li class="active">Formulir Pendaftaran Pengobatan Pasien</li>
        </ol>
      </section>

      <section class="content">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Formulir Pendaftaran Pengobatan Pasien</h3>
          </div>
          <!-- ./box-header -->

          <form role="form" action="<?php echo base_url() ?>simpan-pendaftaran-pasien" method="post">
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="no-bpjs" class="col-sm-12">Nama Pasien</label>

                    <div class="col-md-12">
                      <select name="no_bpjs" id="no-bpjs" class="form-control select2" style="width: 100%">
                        <option value="" selected>Pilih Pasien</option>
                        <?php foreach ($pasien['data'] as $ar_pasien): ?>
                        <option value="<?php echo $ar_pasien['no_bpjs']; ?>"><?php echo ucwords($ar_pasien['nama']); ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('no_bpjs'); ?>
                    </div>
                  </div>
                  <!-- /no-bpjs -->
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tenaga-medis" class="col-sm-12">Poli / Tenaga Medis</label>

                    <div class="col-md-12">
                      <select name="nik_tenaga_medis" id="tenaga-medis" class="form-control select2" style="width: 100%">
                        <option value="" selected>Pilih Poli</option>
                        <?php foreach ($tenaga_medis['data'] as $ar_tenaga_medis): ?>
                        <option value="<?php echo $ar_tenaga_medis['nik_tenaga_medis']; ?>"><?php echo ucwords($ar_tenaga_medis['poli']); ?>&nbsp;(<?php echo ucwords($ar_tenaga_medis['nama']); ?>)</option>
                        <?php endforeach; ?>
                      </select>
                      <?php echo form_error('nik_tenaga_medis'); ?>
                    </div>
                  </div>
                  <!-- /tenaga-medis -->
                </div>
              </div>
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <button type="reset" class="btn btn-danger">Batal</button>
              <button type="submit" class="btn btn-primary pull-right">Daftar</button>
            </div>  
            <!-- ./box-footer -->
          </form>
        </div>

        {success_alert}
      </section>
