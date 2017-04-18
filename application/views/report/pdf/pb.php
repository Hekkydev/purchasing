<link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"  media="all"/>
<body style="font-size:10px;">
<h3 style="text-align:center;"><img src="<?php echo base_url('assets/image/purchase.png')?>" alt="" style="width:100px;"></h3>
<h5 style="text-align:center"><?php echo $info;?></h5>
<table  class="table table-responsive table-striped table-bordered" style="background-color:#f1f1f1 border-color:#ddd;" border="0.5">
  <thead style="border-bottom:1px black solid;">
    <tr >
      <th style="background-color:#2A72BA; color:#fff;padding:2px;text-align:left;" >No Faktur</th>
      <th style="background-color:#2A72BA; color:#fff; padding:2px; text-align:left" >Material</th>
      <th style="background-color:#2A72BA; color:#fff; padding 2px; " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qty</th>
      <th style="background-color:#2A72BA; color:#fff; padding 2px; text-align:center" >Total</th>
      <th style="background-color:#2A72BA; color:#fff; padding 2px; text-align:center" >Tgl Permintaan</th>
      <th style="background-color:#2A72BA; color:#fff; padding 2px; text-align:center" >Tgl Planning</th>
      <th style="background-color:#2A72BA; color:#fff; padding 2px; text-align:center" >Status</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pb as $pb): ?>
      <tr>
        <td style="padding:2px; text-align:left; border-bottom:1px solid #ddd;"><?php echo $pb->kode_pb ?></td>
        <td style="padding:2px; text-align:left; border-bottom:1px solid #ddd;">
          <?php foreach (material_item_pb_detail($pb->kode_pb) as $m): ?>
            <p>
            <?php echo $m->item_nama; ?>
            </p>
          <?php endforeach; ?>
        </td>
        <td style="padding:2px; text-align:left; border-bottom:1px solid #ddd;">
          <?php foreach (material_item_pb_detail($pb->kode_pb) as $m): ?>
            <p><?php echo $m->qty." / ".$m->nama_atribut ?></p>
          <?php endforeach; ?>
        </td>
        <td style="padding:2px; text-align:center; border-bottom:1px solid #ddd;">
          <?php echo jml_material_item($pb->kode_pb)->jml ?>
        </td>
        <td style="padding:2px; text-align:center; border-bottom:1px solid #ddd;">
          <?php echo tgl_lengkap($pb->tgl_create) ?>
        </td>
        <td style="padding:2px; text-align:center; border-bottom:1px solid #ddd;">
          <?php echo tgl_lengkap($pb->tgl_plan) ?></td>
        <td style="padding:2px; text-align:center; border-bottom:1px solid #ddd;">
          <?php echo $pb->status_transaksi ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</body>
