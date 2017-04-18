  <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
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
        <table  border="0" class="col-xs-12 table-responsive">
        <tr>
          <td width="58"><strong>PB </strong></td>
          <td width="145">: <?php echo $pb->kode_pb ?></td>
          <td width="150">&nbsp;</td>
          <td width="129"><strong>Planning </strong></td>
          <td width="170">: <?php echo tgl_indo($pb->tgl_plan) ?></td>
        </tr>
        <tr>
          <td><strong>Keterangan </strong></td>
          <td>: <?php echo $pb->keterangan ?></td>
          <td>&nbsp;</td>
          <td><strong>Status </strong></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </div>
  </div>
    <!-- /.row -->

    <br>
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <td style="background:#2a72ba; color:#fff; padding:5px; text-align:center"><strong>No</strong></td>
            <td style="background:#2a72ba; color:#fff; padding:5px; text-align:center"><strong>Qty</strong></td>
            <td style="background:#2a72ba; color:#fff; padding:5px; text-align:center"><strong>Material</strong></td>
            <td style="background:#2a72ba; color:#fff; padding:5px; text-align:center"><strong>Kode Barang</strong></td>
            <td style="background:#2a72ba; color:#fff; padding:5px; text-align:center"><strong>Satuan</strong></td>
          </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <?php $no = 1; $total=0;foreach (material_item_pb_detail($pb->kode_pb) as $i): $total += $i->qty;?>
              <tr>
                <td style="text-align:center"><?php echo $no ?></td>
                <td style="text-align:center"><?php echo $i->qty ?></td>
                <td style="text-align:center"><?php echo $i->item_nama ?></td>
                <td style="text-align:center"><?php echo $i->unique_kode ?></td>
                <td style="text-align:center"><?php echo $i->nama_atribut ?></td>
              </tr>
            <?php $no++; endforeach; ?>

          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p>Total Qty : <strong><?php echo $total; ?></strong></p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
  <div class="clearfix"></div>
  <!-- </section> -->
