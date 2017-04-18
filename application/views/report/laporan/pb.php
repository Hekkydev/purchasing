<?php if ($pb == TRUE): ?>
<style media="screen">
  table td{
    font-size:10px !important;
  }
</style>
<?php endif; ?>

<table class="table table-responsive table-striped">
	<thead>
		<tr>
			<th></th>
			<th>No Faktur</th>
			<th><div align="center">Material</div></th>
			<th><div align="center">Qty</div></th>
			<th><div align="center">Total</div></th>
			<th><div align="center">Tgl Permintaan</div></th>
			<th><div align="center">Tanggal Planning</div></th>
			<th><div align="center">Status</div></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($pb as $pb): ?>
			<tr>
				<td style="width:10px"> <i class="fa fa-minus"></i> </td>
				<td style="width:120px"> <u><strong><?php echo $pb->kode_pb; ?></strong></u></td>
				<td style="width:160px;">
					<div class="" align="left">
						<ol>
						<?php foreach (material_item_pb_detail($pb->kode_pb) as $m): ?>
							<li>
							<?php echo $m->item_nama."</br>"; ?>
							</li>
						<?php endforeach; ?>
						</ol>
					</div>
				</td>
				<td style="width:120px;">
					<div class="" align="left">
						<ul style="list-style:none;">
						<?php foreach (material_item_pb_detail($pb->kode_pb) as $m): ?>
							<li>
							<?php echo $m->qty." / ".$m->nama_atribut."</br>" ?>
							</li>
						<?php endforeach; ?>
					</ul>
					</div>
				</td>
				<td style="width:40px;"><div align="center"><?php echo jml_material_item($pb->kode_pb)->jml ?></div></td>
				<td style="width:200px;"><div align="center"><?php echo tgl_lengkap($pb->tgl_create) ?></div></td>
				<td style="width:200px;"><div align="center"><?php echo tgl_lengkap($pb->tgl_plan) ?></div></td>
				<td><div align="center"><?php echo $pb->status_transaksi ?></div></td>
			</tr>
		<?php endforeach; ?>
	</tbody>

</table>
