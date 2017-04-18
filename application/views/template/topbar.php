</head>
<?php $url = $this->uri->uri_string; ?>
<?php if (base_akses()."po/add" ==$url): ?>
<body class="skin-black" onload="get_temp_po();">
<?php elseif(base_akses()."rg/add" == $url): ?>
  <body class="skin-black" onload="get_temp_rg();pilih_supplier();">
<?php else: ?>
  <body class="skin-black">
<?php endif; ?>

    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <a href="<?php echo base_url('/'); ?>" class="logo">
              <img src="<?php echo base_url('assets/image/purchase.png')?>" alt="purchase" width="110px;" />
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                  <?php if ($this->user->id_group == 1): ?>
                      <ul class="nav navbar-nav navbar-left">
                        <li><a href="<?php echo site_url(''.base_akses().'rg') ?>"><i class="ion ion-clipboard text-merah"></i> Receive Goods</a></li>
                        <li><a href="<?php echo site_url(''.base_akses().'po') ?>"><i class="ion ion-card text-merah"></i> Purchase Order</a></li>
                        <li><a href="<?php echo site_url(''.base_akses().'pb') ?>"><i class="fa fa-clipboard text-merah"></i> Purchase Requestion</a></li>
                        <li><a href="<?php echo site_url(''.base_akses().'barang') ?>"><i class="ion ion-cube text-merah"></i> Barang</a></li>
                        <li><a href="<?php echo site_url(''.base_akses().'supplier') ?>"><i class="ion ion-ios-people text-merah"></i> Suplier</a></li>
                      </ul>
                  <?php endif; ?>
                    <ul class="nav navbar-nav">


                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url('assets/image/user-blue.png') ?>" class="user-image" alt="User Image"/>
                                <span class="hidden-xs"><?php echo $this->user->nama_profile ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url('assets/image/user-blue.png') ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $this->user->nama_profile.' - '.$this->user->nama_group ?>
                                        <small >Aktivitas Terakhir</small>
                                        <small>
                                          <?php
                                          $aktivitas =  aktivitas_users($this->user->id_user,"last_data","logout")->activity_time;
                                          $tgl = substr($aktivitas,0,10);
                                          $jam = substr($aktivitas,10,20);
                                          echo nama_hari($tgl).' '.tgl_indo($tgl).' Jam :'.$jam;
                                          ?>
                                        </small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-6 text-center">
                                        <a href="<?php echo site_url(''.base_akses().'account/profile_edit/'.$this->user->id_user.'')?>" class="btn btn-xs btn-merah">Edit Profile</a>
                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <a href="<?php echo site_url(''.base_akses().'account/edit/'.$this->user->id_user.'')?>" class="btn btn-xs btn-merah">Edit Akun</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url(''.base_akses().'account/profile/'.$this->user->id_user.'')?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a onclick="logout()" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->
