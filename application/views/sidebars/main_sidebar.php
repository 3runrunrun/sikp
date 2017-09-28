<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo base_url(); ?>../style/dist/img/avatar.png" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo ucwords($this->session->userdata('nama')); ?></p>
      <a href="#"><i class="fa fa-circle text-success"></i>
        <?php 
          switch ($this->session->userdata('tabel')) {
            case 'keperawatan':
              echo 'Perawat';
              break;

            case 'medis':
              echo 'Dokter';
              break;

            case 'kefarmasian':
              echo 'Tenaga Kefarmasian';
              break;

            case 'administrasi':
              echo 'Staf Adminstrasi';
              break;

            case 'admin':
              echo 'Admin';
              break;
            
            default:
              echo 'Tenaga Dalam';
              break;
          }
         ?>
      </a>
    </div>
  </div>

  <?php if($this->session->userdata('aktif') === TRUE): ?>
  <div class="sidebar-form">
    <button type="button" class="btn btn-sm" style="width: 100% !important;" onclick="window.location='<?php echo base_url(); ?>logout'"><i class="fa fa-lock"></i>&nbsp; Logout</button>
  </div>
  <?php endif; ?>

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MENU UTAMA</li>
    <?php if($this->session->userdata('tabel') == 'keperawatan' || $this->session->userdata('tabel') == 'medis' || $this->session->userdata('tabel') == 'administrasi'): ?>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-stethoscope"></i> <span>Pengobatan Holistik</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <?php if($this->session->userdata('tabel') == 'administrasi'): ?>
        <li><a href="<?php echo base_url(); ?>pendaftaran-pasien"><i class="fa fa-pencil"></i>&nbsp;Pendaftaran Pengobatan</a></li>
        <?php endif; ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Data Pengobatan Harian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php if($this->session->userdata('tabel') == 'administrasi'): ?>
            <li><a href="<?php echo base_url(); ?>pasien-terdaftar-harian"><i class="fa fa-database"></i>&nbsp;Pasien Terdaftar</a></li>
            <?php endif; ?>

            <?php if($this->session->userdata('tabel') == 'keperawatan'): ?>
            <li><a href="<?php echo base_url(); ?>pasien-anamnesis-harian"><i class="fa fa-database"></i>&nbsp;Data Anamnesis Pasien</a></li>
            <?php endif; ?>

            <?php if($this->session->userdata('tabel') == 'medis'): ?>
            <li><a href="<?php echo base_url(); ?>pasien-diagnosis-harian"><i class="fa fa-database"></i>&nbsp;Data Diagnosis Pasien</a></li>
            <?php endif; ?>
          </ul>
        </li>
      </ul>
    </li>
    <!-- Pengobatan Holistik -->
    <?php endif; ?>


    <?php if($this->session->userdata('tabel') == 'keperawatan' || $this->session->userdata('tabel') == 'medis' || $this->session->userdata('tabel') == 'administrasi'): ?>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-book"></i> <span>Data Dasar Kesehatan</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url(); ?>lihat-data-dasar"><i class="fa fa-database"></i> <span>Data Dasar Kesehatan</span></a></li>
      </ul>
    </li>
    <!-- Data Dasar Kesehatan -->
    <?php endif; ?>

    <?php if($this->session->userdata('tabel') == 'kefarmasian'): ?>
    <li class="active treeview">
      <a href="#">
        <i class="fa fa-medkit"></i>
        <span>Pengelolaan Obat</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="">
          <a href="#"><i class="fa fa-pencil"></i> Pencatatan Obat
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?php echo base_url(); ?>formulir-obat-baru"><i class="fa fa-pencil"></i>&nbsp;Penambahan Obat Baru</a></li>
            <li><a href="<?php echo base_url(); ?>formulir-pencatatan-obat-masuk"><i class="fa fa-pencil"></i>&nbsp;Pencatatan Obat Masuk</a></li>
            <li><a href="<?php echo base_url(); ?>formulir-pencatatan-obat-keluar"><i class="fa fa-pencil"></i>&nbsp;Pencatatan Obat Keluar</a></li>
          </ul>
        </li>
        <li class="">
          <a href="#"><i class="fa fa-book"></i> Laporan Obat
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?php echo base_url(); ?>data-obat"><i class="fa fa-book"></i>&nbsp;Data Obat</a></li>
            <li><a href="<?php echo base_url(); ?>data-obat-masuk"><i class="fa fa-book"></i>&nbsp;Laporan Obat Masuk</a></li>
            <li><a href="<?php echo base_url(); ?>data-obat-keluar"><i class="fa fa-book"></i>&nbsp;Laporan Obat Keluar</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <!-- /pengelolaan-obat -->
    <?php endif; ?>

    <?php if($this->session->userdata('tabel') == 'keperawatan' || $this->session->userdata('tabel') == 'medis' || $this->session->userdata('tabel') == 'administrasi'): ?>
    <li class="header">ARSIP POLIKLINIK</li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-book"></i> <span>Pasien</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url(); ?>lihat-data-pasien-bpjs"><i class="fa fa-database"></i> <span>Data Pasien BPJS</span></a></li>
      </ul>
    </li>
    <!-- /pasien -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-book"></i> <span>Pengobatan</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url(); ?>riwayat-pengobatan"><i class="fa fa-database"></i> <span>&nbsp;Riwayat Pengobatan</span></a></li>
      </ul>
    </li>
    <!-- /pengobatan -->
    <?php endif; ?>


    <?php if($this->session->userdata('tabel') == 'admin'): ?>
    <li class="header">DATA MASTER</li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-database"></i> <span>Wilayah Administratif</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url(); ?>provinsi"><i class="fa fa-database"></i> <span>Provinsi</span></a></li>
        <li><a href="<?php echo base_url(); ?>kabupaten"><i class="fa fa-database"></i> <span>Kabupaten</span></a></li>
        <li><a href="<?php echo base_url(); ?>kecamatan"><i class="fa fa-database"></i> <span>Kecamatan</span></a></li>
        <li><a href="<?php echo base_url(); ?>kelurahan"><i class="fa fa-database"></i> <span>Kelurahan</span></a></li>
      </ul>
    </li>
    <!-- /wilayah-administratif -->
    <li class="treeview">
      <a href="#">
        <i class="fa fa-database"></i> <span>Modul Andal</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url(); ?>modul-penyakit"><i class="fa fa-database"></i> <span>Modul Penyakit</span></a></li>
        <li><a href="<?php echo base_url(); ?>modul-faktor-risiko"><i class="fa fa-database"></i> <span>Modul Faktor Risiko</span></a></li>
        <li><a href="<?php echo base_url(); ?>modul-faktor-pemicu"><i class="fa fa-database"></i> <span>Modul Faktro Pemicu</span></a></li>
      </ul>
    </li>
    <?php endif; ?>
    <!-- /modul-andal -->
  </ul>
</section>