<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
$this->load->view('template/section');
?>

<!-- Main content -->
<section class="content">

  <!-- Info boxes -->
        <div class="row">

          <a href="<?php echo site_url(''.base_akses().'report/pb')?>" style="color:rgb(42, 114, 186);">

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box" style="border:1px solid; border-color:#ddd;">
              <span class="info-box-icon bg-default"><i class="ion ion-ios-list-outline"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Purchase Request</span>
                <span class="info-box-number"><?php echo record_pb();?> <small>record</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


          </a>

          <a href="<?php echo site_url(''.base_akses().'report/po')?>" style="color:rgb(42, 114, 186);">

<!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box" style="border:1px solid; border-color:#ddd;">
              <span class="info-box-icon bg-default"><i class="ion ion-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Purchase Order</span>
                <span class="info-box-number"><?php echo record_po();?> <small>record</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


          </a>

          <a href="<?php echo site_url(''.base_akses().'report/rg')?>" style="color:rgb(42, 114, 186);">

<div class="clearfix visible-sm-block"></div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box" style="border:1px solid; border-color:#ddd;">
              <span class="info-box-icon bg-default"><i class="ion ion-clipboard"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Receive Goods</span>
                <span class="info-box-number"><?php echo record_rg();?> <small>record</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            </div>

          </a>

          <a href="<?php echo site_url(''.base_akses().'report/supplier')?>" style="color:rgb(42, 114, 186);">

            <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box" style="border:1px solid; border-color:#ddd;">
              <span class="info-box-icon bg-default"><i class="ion ion-ios-people-outline"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Supplier</span>
                <span class="info-box-number"><?php echo record_supplier();?> <small>record</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          </a>

          <a href="<?php echo site_url(''.base_akses().'report/barang')?>" style="color:rgb(42, 114, 186);">

             <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box" style="border:1px solid; border-color:#ddd;">
              <span class="info-box-icon bg-default"><i class="ion ion-cube"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Barang</span>
                <span class="info-box-number"><?php echo record_barang();?> <small>record</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          </a>

           </div>

</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>
