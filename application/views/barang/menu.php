<div class="row">
<a href="<?php echo site_url(''.base_akses().'barang/');?>" title="Barang">
  <div class="col-md-3 col-sm-6 col-xs-12" style="color:black; ">
         <div class="info-box-app bg-blue">
           <span class="info-box-icon-app"><i class="fa fa-cubes"></i></span>

           <div class="info-box-content-app">
             <span class="info-box-text">Data Barang</span>
             <span class="info-box-number"><?php echo jumlah_item().' items'; ?> </span>

           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
</a>
<a href="<?php echo site_url(''.base_akses().'barang/kategori');?>" title="Kategori">
  <div class="col-md-3 col-sm-6 col-xs-12" style="color:black; ">
         <div class="info-box-app bg-blue">
           <span class="info-box-icon-app"><i class="fa fa-tag"></i></span>

           <div class="info-box-content-app">
             <span class="info-box-text">Data Kategori</span>
             <span class="info-box-number"><?php echo jumlah_kategori().' kategori'; ?></span>

           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
</a>

<a href="<?php echo site_url(''.base_akses().'barang/atribut');?>" title="Atribut / satuan">
  <div class="col-md-3 col-sm-6 col-xs-12" style="color:black; ">
         <div class="info-box-app bg-blue">
           <span class="info-box-icon-app"><i class="fa fa-tags"></i></span>

           <div class="info-box-content-app">
             <span class="info-box-text">Data Atribut</span>
             <span class="info-box-number"> <?php echo jumlah_atribut().' Satuan'; ?></span>

           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
       </div>
       <!-- /.col -->
</a>
</div>
