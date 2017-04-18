<div class="row">

  <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box-app bg-red">
           <span class="info-box-icon-app"><i class="fa fa-database"></i></span>

           <div class="info-box-content-app">
             <span class="info-box-text">Data Supplier</span>
             <span class="info-box-number"><?php echo count(supplier()).' supplier'; ?> </span>

           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->

  <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box-app bg-red">
           <span class="info-box-icon-app"><i class="fa fa-check-square-o"></i></span>

           <div class="info-box-content-app">
             <span class="info-box-text">Aktif</span>
             <span class="info-box-number"><?php echo count(supplier_aktif()).' supplier'; ?></span>

           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->

  <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="info-box-app bg-red">
           <span class="info-box-icon-app"><i class="fa  fa-check-square"></i></span>

           <div class="info-box-content-app">
             <span class="info-box-text">Pasif</span>
             <span class="info-box-number"> <?php echo count(supplier_pasif()).' supplier'; ?></span>

           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->

</div>
