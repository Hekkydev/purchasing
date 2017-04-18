  <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
  <body style="font-size:10px;">
    <h3 style="text-align:center;"><img src="<?php echo base_url('assets/image/purchase.png')?>" alt="" style="width:100px;"></h3>

    <!-- Main content -->
      <section class="content" style="background-color:#fff; margin:10px;">

        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">

          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->

        <div class="row invoice-info" >
        <div class="col-xs-12 table-responsive">
          <br>
            <table   class="table table-responsive">
            <tr>
              <td width="58"><strong>PO </strong></td>
              <td width="145">: <?php echo $po->kode_po ?></td>
              <td width="150">&nbsp;</td>
              <td width="129"><strong>Tgl Planning </strong></td>
              <td width="170">: <?php echo tgl_indo($po->tgl_plan) ?></td>
            </tr>
            <tr>
              <td><strong>Keterangan </strong></td>
              <td>: <?php echo $po->keterangan ?></td>
              <td>&nbsp;</td>
              <td>Tgl PO </td>
              <td>: <?php  echo tgl_indo($po->tgl_create); ?></td>
            </tr>
            <tr>
              <td><strong>Supplier </strong></td>
              <td>: <?php echo $po->nama_supplier ?></td>
              <td>&nbsp;</td>
              <td><strong>Status </strong></td>
              <td>: <?php echo $po->status_transaksi ?></td>
            </tr>
          </table>
          </div>

      </div>
        <!-- /.row -->

        <br>
        <!-- Table row -->
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-responsive">
              <thead>
                  <tr>
                    <th style="background:#2a72ba; color:#fff; padding:2px;">Kode Permintaan</th>
                    <th style="background:#2a72ba; color:#fff; padding:2px;">Qty</th>
                    <th style="background:#2a72ba; color:#fff; padding:2px;">Nama Material</th>
                    <th style="background:#2a72ba; color:#fff; padding:2px;">Kode</th>
                    <th style="background:#2a72ba; color:#fff; padding:2px;">Satuan</th>
                    <th style="background:#2a72ba; color:#fff; padding:2px;">Harga</th>
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
                <?php $total += $i->harga; endforeach;   $pajak =  $total * $po->tax/100;?>
              </tbody>
            </table>
          </div>
          <br>
          <div class="col-md-6">
            <table width="500">
             <tr>
               <th width="58">Sub Total </th>
               <td>: <strong><?php echo rupiah($total); ?></strong></td>
             </tr>
             <tr>
               <th width="58">Tax </th>
               <td>: <strong><?php echo $po->tax;?>%</strong></td>
             </tr>
             <tr>
               <th width="58">Total </th>
               <td>: <strong>
                <?php $total_hasil = $total + $pajak;
                echo rupiah($total_hasil); ?></strong></td>
             </tr>
           </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->



      </section>
      <!-- /.content -->

  </body>
