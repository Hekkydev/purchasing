<link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"  media="all"/>

<body style="font-size:10px;">
  <h3 style="text-align:center;"><img src="<?php echo base_url('assets/image/purchase.png')?>" alt="" style="width:100px;"></h3>

  <table class="table table-responsive table-striped">
  <thead>
    <tr>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">No</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Kode</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:left;">Nama Supplier</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:left;">Alamat</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:left;">Telepon</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:left;">Fax</th>
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
    <?php $no=1;foreach ($supplier as $s): ?>
      <tr>
        <td style="text-align:center"><?php echo $no; ?></td>
        <td style="text-align:center"><?php echo $s->kode_supplier ?></td>
        <td style="text-align:left"><?php echo $s->nama_supplier ?></td>
        <td style="text-align:left"><?php echo $s->alamat ?></td>
        <td style="text-align:left"><?php echo $s->telepon ?></td>
        <td style="text-align:left"><?php echo $s->fax ?></td>
      </tr>
    <?php $no++;endforeach; ?>
  </tbody>
  </table>
</body>
