<link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"  media="all"/>
<body style="font-size:9px;">
<h3 style="text-align:center;"><img src="<?php echo base_url('assets/image/purchase.png')?>" alt="" style="width:100px;"></h3>
<h5 style="text-align:center;"><?php echo $info; ?></h5>
<table  cellspacing="100" class="table table-responsive table-bordered" style="border-bottom:1px #ddd solid;">
  <thead>
    <tr>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:left;">PO</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:left;">PB</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:left;">Material</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Qty</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:right;">Harga</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Tax</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:right;">Harga Total</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Supplier</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Tgl PO</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Tgl Planing</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Status</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($po as $po): ?>
      <tr>
        <td style="width:70px; padding:5px;"><b><?php echo $po->kode_po ?></b></td>
        <td style="width:70px; padding:5px;">
          <?php foreach (data_po_pb($po->kode_po) as $pb): ?>
              <p><?php echo '<strong>'.$pb->kode_pb.'</strong>'; ?></p>
            <?php endforeach; ?>

        </td>
        <td style="padding:5px;">

          <?php foreach (data_po_pb($po->kode_po) as $pb): ?>
              <p><?php echo '<strong>'.$pb->unique_kode.'</strong>'.' - '.$pb->item_nama ?></p>
            <?php endforeach; ?>



        </td>
        <td style="text-align:center; padding:5px;">

              <?php foreach (data_po_pb($po->kode_po) as $pb): ?>
                  <p><?php echo $pb->qty_po.' /'.$pb->nama_atribut ?></p>
                <?php endforeach; ?>

        </td>
        <td style="text-align:right; padding:5px;">

              <?php $pajak = 0; $ht = 0; foreach (data_po_pb($po->kode_po) as $pb): ?>
                  <p><?php echo $pb->harga ?></p>
                <?php $ht += $pb->harga; endforeach; $pajak =  $ht * $po->tax/100?>

        </td>
        <td style="text-align:center; padding:5px;"><?php echo $po->tax.' %'; ?></td>
        <td style="text-align:right; padding:5px;"><strong><?php $total_hasil = $ht + $pajak; echo rupiah($total_hasil); ?></strong></td>
        <td style="text-align:center; padding:5px;"><?php echo $po->nama_supplier ?></td>
        <td style="text-align:center; width:70px; padding:5px;"><?php echo tgl_indo($po->tgl_create) ?></td>
        <td style="text-align:center; width:70px; padding:5px;"><?php echo tgl_indo($po->tgl_plan) ?></td>
        <td style="text-align:center; padding:5px;"><?php echo $po->status_transaksi ?></td>

      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


</body>
