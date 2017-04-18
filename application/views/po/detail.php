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
   <section class="content" style="background-color:#fff; margin:10px;">

     <!-- title row -->
     <div class="row">
       <div class="col-xs-12">
         <h2 class="page-header">
           <i class="fa fa-credit-card"></i>Purchase Order | <span class="label label-default"> <?php echo $PO->kode_po;?></span>
           <small class="pull-right"><strong><?php echo nama_hari($PO->tgl_create).', '.tgl_indo($PO->tgl_create) ?></strong></small>
         </h2>
       </div>
       <!-- /.col -->
     </div>
     <!-- info row -->
     <div class="row invoice-info">

        <div class="col-sm-3 invoice-col">
          Kode PO
          <address>
            <strong><?php echo $PO->kode_po ?></strong><br>

          </address>
        </div>
       <div class="col-sm-3 invoice-col">
         Tanggal Planning
         <address>
           <strong><?php echo tgl_indo($PO->tgl_plan) ?></strong><br>

         </address>
       </div>
       <!-- /.col -->
       <div class="col-sm-3 invoice-col">
         Keterangan
         <address >
           <strong>
          <?php echo $PO->keterangan ?>
         </strong>
         </address>
       </div>
       <!-- /.col -->
       <div class="col-sm-3 invoice-col">
        Supplier
         <address >
           <strong>
          <?php echo $PO->nama_supplier ?></strong>
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
                <th>Kode Permintaan</th>
                <th>Qty</th>
                <th>Nama Material</th>
                <th>Kode</th>
                <th>Satuan</th>
                <th>Harga</th>
              </tr>
          </thead>
          <tbody>
            <?php $pajak=0;$total= 0; foreach ($items as $i): ?>
              <tr>
                <td><?php echo $i->kode_pb ?></td>
                <td><?php echo $i->qty_po ?></td>
                <td><?php echo $i->item_nama ?></td>
                <td><?php echo $i->unique_kode ?></td>
                <td><?php echo $i->nama_atribut ?></td>
                <td><?php echo round($i->harga,2); ?></td>
              </tr>
            <?php $total += $i->harga; endforeach;   $pajak =  $total * $PO->tax/100;?>
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
       <!-- /.col -->
       <div class="col-xs-6">
           <div class="table-responsive">

           <table class="table" style="border:1px solid; border-color:#ddd;">
             <tr>
               <th>Sub Total:</th>
               <td><strong><?php echo rupiah($total); ?></strong></td>
             </tr>
             <tr>
               <th>Tax:</th>
               <td><strong><?php echo $PO->tax;?>%</strong></td>
             </tr>
             <tr>
               <th><h4>Total:</h4></th>
               <td><strong><h4>
                <div id="total">
                  <?php
                  $total_hasil = $total + $pajak;
                  echo rupiah($total_hasil); ?>
                </div> </h4></strong></td>
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
         <a href="<?php echo site_url(''.base_akses().'po');?>" class="btn btn-default btn-sm">
           <i class="fa fa-chevron-left"></i> Kembali</a>
         <button type="button" class="btn btn-default pull-right-app btn-sm" data-toggle="modal" data-target="#laporan_pdf">
           <i class="fa fa-print"></i> Print
         </button>
         <a target="_blank" class="btn btn-default pull-right-app btn-sm" href="<?php echo base_url(''.base_akses().'po/download_pdf/'.$PO->id_po.'')?>">
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
               <iframe id="laporan_src" src="<?php echo base_url(''.base_akses().'po/detail_pdf/'.$PO->id_po.'')?>" class="col-lg-12" style="height:500px;" frameborder="0"></iframe>

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
