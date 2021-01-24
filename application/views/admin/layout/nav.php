  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li> 
        <!-- MENU DASHBOARD -->
        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard text-aqua"></i> <span>DASHBOARD</span></a></li>

        <!-- MENU ADMIN -->
        <?php if($this->session->userdata('akses_level')=='Admin'){ ?>
           <!-- MENU TRANSAKSI -->
        <li><a href="<?php echo base_url('admin/transaksi') ?>"><i class="fa fa-check"></i> <span>TRANSAKSI</span></a></li>
        
         <!-- MENU REKENING -->
        <li><a href="<?php echo base_url('admin/rekening') ?>"><i class="fa fa-dollar"></i> <span>DATA REKENING</span></a></li>
        <!-- MENU PENGOLAHAN DATA -->
        <li class="treeview">
            <a href="#">
              <i class="fa fa-table"></i> <span>PENGOLAHAN DATA</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>admin/tengkulak"><i class="fa fa-tags"></i> Data Tengkulak</a></li>
            <li><a href="<?php echo base_url() ?>admin/petani"><i class="fa fa-tags"></i> Data Petani</a></li>
          </ul>
        </li>

        <!-- MENU USER -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-lock"></i> <span>PENGGUNA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>admin/user"><i class="fa fa-table"></i> Data Pengguna</a></li>
            <li><a href="<?php echo base_url() ?>admin/user/tambah"><i class="fa fa-plus"></i> Tambah Pengguna</a></li>
          </ul>
        </li>

        <!-- MENU USER -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i> <span>KONFIGURASI</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>admin/konfigurasi"><i class="fa fa-home"></i> Konfigurasi Umum</a></li>
            <li><a href="<?php echo base_url() ?>admin/konfigurasi/logo"><i class="fa fa-image"></i> Konfigurasi Logo</a></li>
            <li><a href="<?php echo base_url() ?>admin/konfigurasi/icon"><i class="fa fa-home"></i> Konfigurasi Icon</a></li>
          </ul>
        </li>


        <!-- MENU TENGKULAK -->
        <?php } 
        elseif($this->session->userdata('akses_level')=='Tengkulak'){ ?>
          <!-- MENU PRODUK -->
          <li class="treeview">
            <a href="#">
              <i class="fa fa-sitemap"></i> <span>PRODUK</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>admin/product"><i class="fa fa-table"></i> Data Produk</a></li>
            <li><a href="<?php echo base_url() ?>admin/product/tambah"><i class="fa fa-plus"></i> Tambah Produk</a></li>
            <li><a href="<?php echo base_url() ?>admin/kategori"><i class="fa fa-tags"></i> Kategori Produk</a></li>
          </ul>
        </li>


         <!-- MENU TRANSAKSI -->
          <!-- MENU PRODUK -->
          <li class="treeview">
            <a href="#">
              <i class="fa fa-check"></i> <span>Transaksi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('transaksi') ?>"><i class="fa fa-table"></i> Proses Transaksi</a></li>
            <li><a href="<?php echo base_url('transaksi/transaksi_tengkulak') ?>"><i class="fa fa-tags"></i> Semua Produk</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>PROFIL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url() ?>admin/tengkulak/profil"><i class="fa fa-table"></i> Profil Saya</a></li>
            <li><a href="<?php echo base_url() ?>admin/user/ganti_pass"><i class="fa fa-lock"></i> Edit Password</a></li>
          </ul>
        </li>
        <?php } ?>
        <!-- MENU PRODUK -->
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">