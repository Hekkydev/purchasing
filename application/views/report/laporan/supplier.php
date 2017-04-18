<table class="table table-responsive">
<thead>
  <tr>
    <th>No</th>
    <th>Kode</th>
    <th>Nama Supplier</th>
    <th>Alamat</th>
    <th>Telepon</th>
    <th>Fax</th>
  </tr>
</thead>
<tbody>
  <?php $no=1;foreach ($supplier as $s): ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $s->kode_supplier ?></td>
      <td><?php echo $s->nama_supplier ?></td>
      <td><?php echo $s->alamat ?></td>
      <td><?php echo $s->telepon ?></td>
      <td><?php echo $s->fax ?></td>
    </tr>
  <?php $no++;endforeach; ?>
</tbody>
</table>
