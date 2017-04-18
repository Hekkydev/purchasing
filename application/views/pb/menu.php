<div class="row">

  <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box-app bg-blue">
           <span class="info-box-icon-app"><i class="fa fa-clipboard"></i></span>

           <div class="info-box-content-app">
             <span class="info-box-text">Data Request</span>
             <span class="info-box-number"><?php echo count($PB).' Permintaan'; ?> </span>

           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->

  <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box-app bg-blue">
           <span class="info-box-icon-app"><i class="fa fa-check-square-o"></i></span>

           <div class="info-box-content-app">
             <span class="info-box-text">Open</span>
             <span class="info-box-number"><?php echo count(pb_status_open()).' transaksi'; ?></span>

           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->

  <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box-app bg-blue">
           <span class="info-box-icon-app"><i class="fa  fa-refresh"></i></span>

           <div class="info-box-content-app">
             <span class="info-box-text">On Proses</span>
             <span class="info-box-number"><?php echo count(pb_status_onproses()).' transaksi'; ?></span>

           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->

         <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-app bg-blue">
                  <span class="info-box-icon-app"><i class="fa  fa-check-square"></i></span>

                  <div class="info-box-content-app">
                    <span class="info-box-text">Full Receive</span>
                    <span class="info-box-number"><?php echo count(pb_status_full()).' transaksi'; ?></span>

                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

</div>
