<link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"  media="all"/>
<body style="font-size:10px;">
<h3 style="text-align:center;"><img src="<?php echo base_url('assets/image/purchase.png')?>" alt="" style="width:100px;"></h3>
<table class="table table-responsive table-striped" style="background-color:#f1f1f1">
  <thead style="border-bottom:1px black solid;">
    <tr >
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;" >No</th>
      <th style="background-color:#2A72BA; color:#fff;" >ID Barang</th>
      <th style="background-color:#2A72BA; color:#fff;" >Nama Barang</th>
      <th style="background-color:#2A72BA; color:#fff;" >Jenis Barang</th>
      <th style="background-color:#2A72BA; color:#fff;" >Satuan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php $no=1; foreach ($barang as $b): ?>
      <tr>
        <td style="text-align:center"><?php echo $no; ?></td>
        <td><?php echo $b->unique_kode ?></td>
        <td><?php echo $b->item_nama ?></td>
        <td><?php echo $b->nama_category ?></td>
        <td><?php echo $b->nama_atribut ?></td>
      </tr>
    <?php $no++; endforeach; ?>
  </tbody>
</table>
</body>
