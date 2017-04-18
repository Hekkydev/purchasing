
<table class="table table-responsive">
  <thead>
    <tr>
      <th>No Urut</th>
      <th>ID Barang</th>
      <th>Nama Barang</th>
      <th>Jenis Barang</th>
      <th>Satuan</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach ($barang as $b): ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $b->unique_kode ?></td>
        <td><?php echo $b->item_nama ?></td>
        <td><?php echo $b->nama_category ?></td>
        <td><?php echo $b->nama_atribut ?></td>
      </tr>
    <?php $no++; endforeach; ?>
  </tbody>
</table>
