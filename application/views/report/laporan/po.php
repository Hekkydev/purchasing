<style media="screen">
  table td{
    font-size:10px !important;
  }
</style>
<table class="table table-responsive table-bordered table-striped">
  <thead>
    <tr>
      <th>PO</th>
      <th>PB</th>
      <th>Material</th>
      <th style="text-align:center;">Qty</th>
      <th style="text-align:right;">Harga</th>
      <th style="text-align:center;">Tax</th>
      <th style="text-align:right;">Harga Total</th>
      <th style="text-align:center;">Supplier</th>
      <th style="text-align:center;">Tgl Po</th>
      <th style="text-align:center;">Tgl Planing</th>
      <th style="text-align:center;">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($po as $po): ?>
      <tr>
        <td style="width:110px;"><b><?php echo $po->kode_po ?></b></td>
        <td style="width:100px;">
          <?php foreach (data_po_pb($po->kode_po) as $pb): ?>
              <p><?php echo '<strong>'.$pb->kode_pb.'</strong>'; ?></p>
            <?php endforeach; ?>

        </td>
        <td>

          <?php foreach (data_po_pb($po->kode_po) as $pb): ?>
              <p><?php echo '<strong>'.$pb->unique_kode.'</strong>'.' - '.$pb->item_nama ?></p>
            <?php endforeach; ?>



        </td>
        <td style="text-align:center;">

              <?php foreach (data_po_pb($po->kode_po) as $pb): ?>
                  <p><?php echo $pb->qty_po.' /'.$pb->nama_atribut ?></p>
                <?php endforeach; ?>

        </td>
        <td style="text-align:right;">

              <?php $pajak = 0; $ht = 0; foreach (data_po_pb($po->kode_po) as $pb): ?>
                  <p><?php echo $pb->harga ?></p>
                <?php $ht += $pb->harga; endforeach; $pajak =  $ht * $po->tax/100?>

        </td>
        <td style="text-align:center;"><?php echo $po->tax.' %'; ?></td>
        <td style="text-align:right;"><strong><?php $total_hasil = $ht + $pajak; echo rupiah($total_hasil); ?></strong></td>
        <td style="text-align:center;"><?php echo $po->nama_supplier ?></td>
        <td style="text-align:center;"><?php echo tgl_indo($po->tgl_create) ?></td>
        <td style="text-align:center;"><?php echo tgl_indo($po->tgl_plan) ?></td>
        <td style="text-align:center;"><?php echo $po->status_transaksi ?></td>

      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
