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

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-trash-o"></i> Drop Table </h3>

      </div>
        <div class="box-body">
            <div class="row ">

              <div class="col-md-3 col-sm-6 col-xs-12">
                 <div class="info-box-app bg-dark" style="background:#ddd;">
                   <span class="info-box-icon-app"><i class="fa fa-clipboard"></i></span>

                   <div class="info-box-content-app">
                     <span class="info-box-text">Data Permintaan</span>
                     <span class="info-box-number"><a href="<?php echo site_url(''.base_akses().'konfigurasi/drop_pb')?>"style="color:#f5f5f5";>Drop Data</a></span>

                   </div>
                   <!-- /.info-box-content -->
                 </div>
                 <!-- /.info-box -->
               </div>

               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box-app bg-dark" style="background:#ddd;">
                    <span class="info-box-icon-app"><i class="fa fa-credit-card"></i></span>

                    <div class="info-box-content-app">
                      <span class="info-box-text">Data Purchase Order</span>
                      <span class="info-box-number"><a href="<?php echo site_url(''.base_akses().'konfigurasi/drop_po')?>"style="color:#f5f5f5";>Drop Data</a></span>

                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                   <div class="info-box-app bg-dark" style="background:#ddd;">
                     <span class="info-box-icon-app"><i class="ion ion-ios-list"></i></span>

                     <div class="info-box-content-app">
                       <span class="info-box-text">Data Received Goods</span>
                       <span class="info-box-number"><a href="<?php echo site_url(''.base_akses().'konfigurasi/drop_rg')?>"style="color:#f5f5f5";>Drop Data</a></span>

                     </div>
                     <!-- /.info-box-content -->
                   </div>
                   <!-- /.info-box -->
                 </div>

                 <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-app bg-dark" style="background:#ddd;">
                      <span class="info-box-icon-app"><i class="ion ion-cube"></i></span>

                      <div class="info-box-content-app">
                        <span class="info-box-text">Data Barang</span>
                        <span class="info-box-number"><a href="<?php echo site_url(''.base_akses().'konfigurasi/drop_barang')?>"style="color:#f5f5f5";>Drop Data</a></span>

                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>

                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <div class="info-box-app bg-dark" style="background:#ddd;">
                       <span class="info-box-icon-app"><i class="ion ion-cube"></i></span>

                       <div class="info-box-content-app">
                         <span class="info-box-text">Data Atribut</span>
                         <span class="info-box-number"><a href="<?php echo site_url(''.base_akses().'konfigurasi/drop_barang_atribut')?>"style="color:#f5f5f5";>Drop Data</a></span>

                       </div>
                       <!-- /.info-box-content -->
                     </div>
                     <!-- /.info-box -->
                   </div>

                   <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box-app bg-dark" style="background:#ddd;">
                        <span class="info-box-icon-app"><i class="ion ion-cube"></i></span>

                        <div class="info-box-content-app">
                          <span class="info-box-text">Data Kategori</span>
                          <span class="info-box-number"><a href="<?php echo site_url(''.base_akses().'konfigurasi/drop_barang_category')?>"style="color:#f5f5f5";>Drop Data</a></span>

                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>

                  <div class="col-md-3 col-sm-6 col-xs-12">
                     <div class="info-box-app bg-dark" style="background:#ddd;">
                       <span class="info-box-icon-app"><i class="ion ion-ios-people"></i></span>

                       <div class="info-box-content-app">
                         <span class="info-box-text">Data Supplier</span>
                         <span class="info-box-number"><a href="<?php echo site_url(''.base_akses().'konfigurasi/drop_supplier')?>"style="color:#f5f5f5";>Drop Data</a></span>

                       </div>
                       <!-- /.info-box-content -->
                     </div>
                     <!-- /.info-box -->
                   </div>




            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>
