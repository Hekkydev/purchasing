<table class="table table-responsive table-striped">
  <thead>
    <tr>
      <th></th>
      <th style="width:330px;">NO RG</th>
      <th>Surat jalan</th>
      <th>Tanggal Kedatangan</th>
      <th>Supplier</th>
      <th>Qty</th>
      <th>
        <div align="center">
          Outstanding
        </div>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php if ($RG == TRUE): ?>
      <?php foreach ($RG as $rg): ?>
        <tr>
          <td width="10em;"><a href="<?php echo base_url(''.base_akses().'rg/download_pdf/'.$rg->id_rg.'')?>" target="_blank" style="color:#333;"><i class="fa fa-print"></i></a></td>
          <td>
            <a href="<?php echo site_url(''.base_akses().'rg/detail/'.$rg->id_rg.'')?>" class="text-merah">
            <strong><i class="fa fa-download"></i> <?php echo $rg->kode_rg ?></strong>
            </a>
            <article class="">
              <p><b>Material :</b> <?php echo material_rg($rg->kode_rg); ?></p>
            </article>
        </td>
          <td><?php echo $rg->kode_surat_jln ?></td>
          <td><?php echo nama_hari($rg->tgl_plan).", ".tgl_indo($rg->tgl_plan); ?></td>
          <td><?php echo $rg->nama_supplier ?></td>
          <td><?php echo jml_rg($rg->kode_rg); ?></td>
          <td>
            <div align="center">
              <?php echo cek_outstanding_rg($rg->kode_rg);  ?>
            </div>
          </td>

        </tr>
      <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="8" style="text-align:center;"><i class="fa fa-2x fa-warning"></i><h5>Received Goods Kosong</h5></td>
        </tr>
    <?php endif; ?>

  </tbody>
</table>
