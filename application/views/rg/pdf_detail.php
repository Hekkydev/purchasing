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
            <td width="58"><strong>RG </strong></td>
            <td width="145">: <?php echo $RG->kode_rg ?></td>
            <td width="150">&nbsp;</td>
            <td width="129"><strong>Tgl Kedatangan </strong></td>
            <td width="170">: <?php echo tgl_indo($RG->tgl_plan) ?></td>
          </tr>
          <tr>
            <td><strong>Surat Jalan </strong></td>
            <td>: <?php echo $RG->kode_surat_jln ?></td>
            <td>&nbsp;</td>
            <td>Tgl RG </td>
            <td>: <?php  echo tgl_indo($RG->tgl_receive); ?></td>
          </tr>
          <tr>
            <td><strong>Supplier </strong></td>
            <td>: <?php echo $RG->nama_supplier ?></td>
            <td>&nbsp;</td>

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
                  <th style="background:#2a72ba; color:#fff; padding:2px; text-align:left;">Kode Permintaan</th>
                  <th style="background:#2a72ba; color:#fff; padding:2px; text-align:center;">Qty</th>
                  <th style="background:#2a72ba; color:#fff; padding:2px; text-align:left;">Nama Material</th>
                  <th style="background:#2a72ba; color:#fff; padding:2px; text-align:center;">Kode</th>
                  <th style="background:#2a72ba; color:#fff; padding:2px; text-align:center;">Satuan</th>
                  <th style="background:#2a72ba; color:#fff; padding:2px; text-align:right;">Harga</th>
                  <th style="background:#2a72ba; color:#fff; padding:2px; text-align:center;">Out</th>

                </tr>
            </thead>
            <tbody>
              <?php $total_out = 0 ;foreach ($detail_rg as $item): ?>
                <tr>
                  <td style="padding:2px; text-align:left;"><?php echo $item->kode_po ?></td>
                  <td style="padding:2px; text-align:center;"><?php echo $item->qty_rg ?></td>
                  <td style="padding:2px; text-align:left;"><?php echo $item->item_nama ?></td>
                  <td style="padding:2px; text-align:center;"><?php echo $item->unique_kode ?></td>
                  <td style="padding:2px; text-align:center;"><?php echo $item->nama_atribut ?></td>
                  <td style="padding:2px; text-align:right;"><?php echo number_format( $item->qty_rg * harga_rg_detail($item->kode_po,$item->id_item)); ?></td>
                  <td style="padding:2px; text-align:center;">
                    <?php
                      echo $item->out_standing;
                      $total_out += $item->out_standing;
                    ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <br>
        <div class="col-md-12">
          <table width="50%">
            <tr>
              <th width="100">Total Qty diterima:</th>
              <td><strong><?php echo jml_rg($RG->kode_rg) ?></strong></td>
            </tr>
            <tr>
              <th width="100">Total Qty Pending:</th>
              <td><strong><?php echo $total_out; ?></strong></td>
            </tr>
         </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



    </section>
    <!-- /.content -->

</body>
