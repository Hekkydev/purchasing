<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<style media="screen">
  .read{
      background-color:#fff !important;
      border-color:#fff !important;
  }
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
$this->load->view('template/section');
?>

<!-- Default box -->
<section class="content">
   <div class="box">
       <div class="box-header with-border">
           <h3 class="box-title">
             <i class="fa fa-clipboard "></i>  RG | <span class="label label-default"><?php echo $rg->kode_rg ?></span></h3>
           <div class="box-tools pull-right">
               <b ><?php echo nama_hari($rg->tgl_receive).', '.tgl_indo($rg->tgl_receive)?></b>
           </div>
       </div>
     <form action="http://localhost/purchase/admin/rg/add_proses" method="post" autocomplete="off">
       <div class="box-body">


         <div class="row invoice-info">

          <div class="col-sm-3 invoice-col">
            Kode RG
            <address>
              <strong><?php echo $rg->kode_rg ?></strong><br>

            </address>
          </div>
         <div class="col-sm-3 invoice-col">
           Surat Jalan
           <address>
             <strong><?php echo $rg->kode_surat_jln ?></strong><br>

           </address>
         </div>
         <!-- /.col -->
         <div class="col-sm-3 invoice-col">
           Tanggal Kedatangan
           <address >
             <strong><?php echo tgl_indo($rg->tgl_receive) ?></strong>
           </address>
         </div>
         <!-- /.col -->
         <div class="col-sm-3 invoice-col">
          Supplier
           <address >
             <strong><?php echo $rg->nama_supplier ?></strong>
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
                  <th>Out</th>
                </tr>
            </thead>
            <tbody>

              <?php $total_out = 0 ;foreach ($detail_rg as $item): ?>
                <tr>
                  <td><?php echo $item->kode_po ?></td>
                  <td><?php echo $item->qty_rg ?></td>
                  <td><?php echo $item->item_nama ?></td>
                  <td><?php echo $item->unique_kode ?></td>
                  <td><?php echo $item->nama_atribut ?></td>
                  <td><?php echo number_format( $item->qty_rg * harga_rg_detail($item->kode_po,$item->id_item)); ?></td>
                  <td>
                    <?php
                      echo $item->out_standing;
                      $total_out += $item->out_standing;
                  //  echo qty_result_rg($item->id_item)->total_rg;
                  //  echo "--";
                   //echo $out_stand = qty_po($item->kode_po,$item->id_item) - $item->qty_rg; ?></td>
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
         <div class="table-responsive">

         <table class="table" style="border-top:1px solid; border-top-color:#ddd;">
           <tr>
             <th>Total Qty diterima:</th>
             <td><strong><?php echo jml_rg($rg->kode_rg) ?></strong></td>
           </tr>

         </table>
       </div>
       </div>
       <!-- /.col -->
       <!-- /.col -->
       <div class="col-xs-6">
         <div class="table-responsive">

         <table class="table" style="border-top:1px solid; border-top-color:#ddd;">
           <tr>
             <th>Total Qty Pending:</th>
             <td><strong><?php echo $total_out; ?></strong></td>
           </tr>

         </table>
       </div>
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->

       </div><!-- /.box-body -->
       <div class="box-footer">
         <div class="row no-print">
          <div class="col-xs-12">
            <a href="<?php echo site_url(''.base_akses().'rg')?>" class="btn btn-default btn-sm">
              <i class="fa fa-chevron-left"></i> Kembali</a>
            <a type="button" class="btn btn-default pull-right-app btn-sm" data-toggle="modal" data-target="#laporan_pdf">
              <i class="fa fa-print"></i> Print
            </a>
            <a type="button" class="btn btn-default pull-right-app btn-sm" href="<?php echo base_url(''.base_akses().'rg/download_pdf/'.$rg->id_rg.'')?>" target="_blank">
              <i class="fa fa-download"></i> Download PDF
            </a>
          </div>
        </div>
       </div><!-- /.box-footer-->

     </form>

   </div>

</section><!-- /.content -->

<!-- Modal -->
<div id="laporan_pdf" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" >
  <!-- Modal content-->
    <div class="modal-content" style="border-radius:5px; background-color:#f1f1f1;">
      <div class="modal-body">
        <div class="row">
          <div style="margin-right:-10px;margin-left:-10px;">
            <iframe id="laporan_src" src="<?php echo base_url(''.base_akses().'rg/detail_pdf/'.$rg->id_rg.'')?>" class="col-lg-12" style="height:500px;" frameborder="0"></iframe>

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
