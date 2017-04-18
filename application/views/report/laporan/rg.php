<style media="screen">
  table td{
    font-size:10px !important;
  }
</style>
<div class="table-scroll">
<table class="table table-responsive table-striped  table-bordered">
	<thead>
		<tr>
			<th>RG</th>
			<th style="width:10px;">PO</th>
			<th>Material</th>
			<th>Qty</th>
			<th>Harga</th>
			<th>Sub Total</th>
			<th>Total</th>
			<th>Supplier</th>
			<th>Tgl Received</th>
			<th>Tgl Planing</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($rg as $rg):?>
			<tr>
			<td><strong><?php echo $rg->kode_rg?></strong></td>
			<td>
				<?php
				foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
					echo '<p>'.$kode_po->kode_po.'</p>';
				}
				?>
			</td>
			<td>
				<?php
				foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
					echo '<p><strong>'.$kode_po->unique_kode.'</strong> - <i>'.$kode_po->item_nama.'</i></p>';
				}
				?>
			</td>
			<td style="text-align:center;">
				<?php
				foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
					echo '<p><b>'.$kode_po->qty_rg.' /'.$kode_po->nama_atribut.'</b></p>';
				}
				?>
			</td>
			<td style="text-align:right;">
			<?php
			foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
			echo '<p>'.number_format(cek_harga_material($kode_po->id_item,$kode_po->kode_po),'2').'</p>';
			}
			?>
			</td>
			<td style="text-align:right;">
			<?php
			foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
			echo '<p>'.number_format(cek_harga_material($kode_po->id_item,$kode_po->kode_po) * $kode_po->qty_rg,'2').'</p>';
			}
			?>
			</td>
			<td style="text-align:right;">
			<?php
			$total = 0;
			foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
			$total += cek_harga_material($kode_po->id_item,$kode_po->kode_po) * $kode_po->qty_rg;
			}
				echo "<p>".number_format($total,'2')."</p>";
			?>
			</td>
			<!-- <td>
			<?php
				foreach (cek_rg_po($rg->kode_rg) as $kode_po) {
					echo '<p>'.tax_po($kode_po->kode_po).'</p>';
				}
				?>
			</td> -->
			<td><?php echo $rg->nama_supplier?></td>
			<td style="text-align:center;"><?php echo $rg->tgl_receive?></td>
			<td style="text-align:center;"><?php echo $rg->tgl_plan?></td>

<!--
			<td><?php //echo cek_rg_total_harga($rg->kode_rg);?></td>
			<td><?php //echo cek_rg_total_harga_tax($rg->kode_rg);?></td> -->
		</tr>
		<?php endforeach;?>
	</tbody>

</table>

</div>
