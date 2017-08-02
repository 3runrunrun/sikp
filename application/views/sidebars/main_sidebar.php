<!-- Left side column. contains the logo and sidebar -->
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url(); ?>../style/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Alexander Pierce</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">MENU UTAMA</li>
          <li>
            <a href="<?php echo base_url(); ?>lihat-data-dasar">
              <i class="fa fa-book"></i> <span>Data Dasar Kesehatan</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-stethoscope"></i> <span>Pengobatan Holistik</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>pendaftaran-pasien"><i class="fa fa-table"></i>&nbsp;Pendaftaran Pengobatan</a></li>
              <li><a href="<?php echo base_url(); ?>daftar-pasien-terdaftar"><i class="fa fa-table"></i>&nbsp;Daftar Pasien</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-medkit"></i>
              <span>Pengelolaan Obat</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>pencatatan-obat"><i class="fa fa-pencil"></i> Pencatatan Obat Keluar</a></li>
              <li><a href="../charts/morris.html"><i class="fa fa-book"></i> Laporan Obat Keluar</a></li>
            </ul>
          </li>
          <li class="header">LABELS</li>
          <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
          <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
          <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->