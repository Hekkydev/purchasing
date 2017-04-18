<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
$this->load->view('template/section');
?>


   <!-- Content Header (Page header) -->
   <!-- <section class="content"> -->

   <!-- Main content -->
   <section class="content" style="background-color:#fff; margin:10px;">

     <!-- title row -->
     <div class="row">
       <div class="col-xs-12">
         <h2 class="page-header">
           <i class="<?php echo $hal->judul_icon?>"></i><?php echo $hal->judul.' | Faktur: '.$PB->kode_pb?>
           <small class="pull-right"><strong><?php echo tgl_lengkap($PB->tgl_create); ?></strong></small>
         </h2>
       </div>
       <!-- /.col -->
     </div>
     <!-- info row -->
     <div class="row invoice-info">

       <div class="col-sm-4 invoice-col">
         Tanggal Planning
         <address>
           <strong><?php echo tgl_lengkap($PB->tgl_plan); ?></strong><br>

         </address>
       </div>
       <!-- /.col -->
       <div class="col-sm-4 invoice-col">
         Keterangan :
         <address >
           <strong>
           <?php echo $PB->keterangan ?></strong>
         </address>
       </div>
       <!-- /.col -->
       <div class="col-sm-4 invoice-col">
         status :
         <address >
           <strong>
           <?php echo $PB->status_transaksi ?></strong>
         </address>
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->

     <!-- Table row -->
     <div class="row">
       <div class="col-xs-12 table-responsive">
         <table class="table table-striped">
           <thead>
           <tr>
             <th>Qty</th>
             <th>Material Barang</th>
             <th>Kode Barang</th>
             <th>Satuan</th>
           </tr>
           </thead>
           <tbody>
             <?php $total=0;foreach (material_item_pb_detail($PB->kode_pb) as $i): $total += $i->qty;?>
               <tr>
                 <td><?php echo $i->qty ?></td>
                 <td><?php echo $i->item_nama ?></td>
                 <td><?php echo $i->unique_kode ?></td>
                 <td><?php echo $i->nama_atribut ?></td>
               </tr>
             <?php endforeach; ?>

           </tbody>
         </table>
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->

     <div class="row">
       <!-- accepted payments column -->
       <div class="col-xs-6">

       </div>
       <!-- /.col -->
       <div class="col-xs-6">
           <div class="table-responsive">
           <table class="table">

             <tr>
               <th>Total:</th>
               <td><strong><?php echo $total ?></strong></td>
             </tr>
           </table>
         </div>
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->

     <!-- this row will not appear when printing -->
     <div class="row no-print">
       <div class="col-xs-12">
         <a href="#" data-toggle="modal" data-target="#laporan_pdf" class="btn btn-default btn-sm pull-right-app"><i class="fa fa-print"></i> Print</a>
         <a target="_blank" href="<?php echo base_url(''.base_akses().'pb/download_pdf/'.$PB->id_pb.'')?>" class="btn btn-default pull-right-app btn-sm" style="margin-right: 5px;">
           <i class="fa fa-download"></i> Download PDF
         </a>
       </div>
     </div>
   </section>
   <!-- /.content -->
   <div class="clearfix"></div>
   <!-- </section> -->


   <!-- Modal -->
   <div id="laporan_pdf" class="modal fade" role="dialog">
     <div class="modal-dialog modal-lg" >

       <!-- Modal content-->
       <div class="modal-content" style="border-radius:5px; background-color:#f1f1f1;">
         <div class="modal-body">
           <div class="row">
             <div style="margin-right:-10px;margin-left:-10px;">
               <iframe id="laporan_src" src="<?php echo base_url(''.base_akses().'pb/detail_pdf/'.$PB->id_pb.'')?>" class="col-lg-12" style="height:500px;" frameborder="0"></iframe>

             </div>
           </div>
         </div>
       </div>

     </div>
   </div>


<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>
