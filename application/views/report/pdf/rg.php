<link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"  media="all"/>
<body style="font-size:9px;">
<h3 style="text-align:center;"><img src="<?php echo base_url('assets/image/purchase.png')?>" alt="" style="width:100px;"></h3>
<h5 style="text-align:center;"><?php echo $info ?></h5>
<table  cellspacing="100" class="table table-responsive table-bordered" style="border-bottom:1px #ddd solid;">
  <thead>
    <tr>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:left;">RG</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:left;">PO</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:left;">Material</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Qty</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:right;">Harga</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:right;">Sub Total</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:right;">Total</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Supplier</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Tgl permintaan</th>
      <th style="background-color:#2A72BA; color:#fff;padding:5px;text-align:center;">Tgl planing</th>
    </tr>
  </thead>
  <tbody>
		<?php foreach($rg as $rg):?>
			<tr>
			<td style="background-color:#f5f5f5; color:#333;padding:5px;text-align:left;"><strong><?php echo $rg->kode_rg?></strong></td>
			<td style="padding:5px;text-align:left;">
				<?php
				foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
					echo '<p>'.$kode_po->kode_po.'</p>';
				}
				?>
			</td>
			<td style="padding:5px;text-align:left;">
				<?php
				foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
					echo '<p><strong>'.$kode_po->unique_kode.'</strong> - <i>'.$kode_po->item_nama.'</i></p>';
				}
				?>
			</td>
			<td style="padding:5px;text-align:center;">
				<?php
				foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
					echo '<p><b>'.$kode_po->qty_rg.' /'.$kode_po->nama_atribut.'</b></p>';
				}
				?>
			</td>
			<td style="padding:5px;text-align:right;">
			<?php
			foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
			echo '<p>'.number_format(cek_harga_material($kode_po->id_item,$kode_po->kode_po),'2').'</p>';
			}
			?>
			</td>
			<td style="padding:5px;text-align:right;">
			<?php
			foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
			echo '<p>'.number_format(cek_harga_material($kode_po->id_item,$kode_po->kode_po) * $kode_po->qty_rg,'2').'</p>';
			}
			?>
			</td>
			<td style="padding:5px;text-align:right;">
			<?php
			$total = 0;
			foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
			$total += cek_harga_material($kode_po->id_item,$kode_po->kode_po) * $kode_po->qty_rg;
			}
				echo "<p>".number_format($total,'2')."</p>";
			?>
			</td>
			<td style="padding:5px;text-align:left;"><?php echo $rg->nama_supplier?></td>
			<td style="padding:5px;text-align:center; width:50px;"><?php echo $rg->tgl_receive?></td>
			<td style="padding:5px;text-align:center; width:50px;"><?php echo $rg->tgl_plan?></td>


		</tr>
		<?php endforeach;?>
	</tbody>
</table>
</body>
