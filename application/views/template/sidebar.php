<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <!-- <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div> -->
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <!-- <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div> -->
            <div class="" align="center" style="color:#333;">
              <i class="ion ion-ios-calendar"></i> <?php echo nama_hari(date('Y-m-d')).' '.tgl_indo(date('Y-m-d'));?>
            </div>

        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active" > <a href="<?php echo site_url('/')?>"><i class="ion ion-ios-speedometer"></i> Dashboard</a></li>
         
            <?php if(hak_akses() == 1): ?>
            <li class="treeview">
                <a href="#">
                    <i class="ion ion-ios-folder"></i>
                    <span>Master Data</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url(''.base_akses().'barang/')?>"><i class="ion ion-ios-arrow-forward"></i> Data Barang</a></li>
                    <li><a href="<?php echo site_url(''.base_akses().'supplier/')?>"><i class="ion ion-ios-arrow-forward"></i> Data Suplier</a></li>
                    <li><a href="<?php echo site_url(''.base_akses().'pb/')?>"><i class="ion ion-ios-arrow-forward"></i> Data Permintaan Barang</a></li>
                    <li><a href="<?php echo site_url(''.base_akses().'po/')?>"><i class="ion ion-ios-arrow-forward"></i> Data Purchase Order</a></li>
                    <li><a href="<?php echo site_url(''.base_akses().'rg/')?>"><i class="ion ion-ios-arrow-forward"></i> Data Receive Good</a></li>
                </ul>
            </li>
            <li > <a href="<?php echo site_url(''.base_akses().'report')?>"><i class="ion ion-ios-list"></i> Data Report</a></li>


            <li class="header">OTHER LINK</li>
            <li class="treeview">
                <a href="#">
                    <i class="ion ion-ios-people"></i>
                    <span>Pegawai</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url(''.base_akses().'account/add');?>"><i class="ion ion-ios-personadd"></i> Buat Pegawai</a></li>
                    <li><a href="<?php echo site_url(''.base_akses().'account/');?>"><i class="ion ion-ios-people"></i> Data Pegawai</a></li>
                </ul>
            </li>
            <li><a href="<?php echo site_url('admin/konfigurasi')?>"><i class="fa fa-cog"></i> Pengaturan</a></li>
        <?php endif; ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
