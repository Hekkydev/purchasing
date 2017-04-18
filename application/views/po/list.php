<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
$this->load->view('template/section');
?>


<!-- Main content -->
<section class="content">
<?php $this->load->view('po/menu'); ?>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="<?php echo $hal->judul_icon?> "></i> <?php echo $hal->sub_judul?>  </h3>
          <div class=" box-tools pull-right">
              <a href="<?php echo site_url(''.base_akses().'po/add')?>" class="btn btn-box-tool btn-default" title="Buat Purchase Order"><i class="fa fa-plus"></i> Buat Purchase Order</a>
          </div>
        </div>

        <?php if ($po == TRUE): ?>
          <div class="box-body">
          <?php else: ?>
          <div class="box-body" style="height:300px">
        <?php endif; ?>
            <table class="table table-responsive table-striped">
              <thead>
                <tr>
                  <th> </th>
                  <th> PO </th>
                  <th> Qty</th>
                  <th> Tanggal Permintaan </th>
                  <th> Tanggal Planning </th>
                  <th> Keterangan </th>
                  <th> Supplier </th>
                  <th> Status</th>
                </tr>
              </thead>
              <tbody>

                <?php if ($po == TRUE): ?>
                  <?php foreach ($po as $po): ?>
                    <tr>
                      <td>
                        <a  style="color:#333" target="_blank" href="<?php echo base_url(''.base_akses().'po/download_pdf/'.$po->id_po.'')?>"><i class="fa fa-print"></i></a>
                      </td>
                      <td>
                        <a href="<?php echo site_url(''.base_akses().'po/detail/'.$po->id_po.'')?>" style="color:#333; font-weight:bold;" class="btn btn-xs btn-default">
                          <strong><i class="fa fa-newspaper-o"></i> <?php echo $po->kode_po ?></strong>
                        </a>
                      </td>
                      <td>
                        <?php echo qty_po_total($po->kode_po); ?>
                      </td>
                      <td><?php echo nama_hari($po->tgl_create).', '.tgl_indo($po->tgl_create); ?></td>
                      <td><?php echo nama_hari($po->tgl_plan).', '.tgl_indo($po->tgl_plan); ?></td>
                      <td><?php echo $po->keterangan ?></td>
                      <td><?php echo $po->nama_supplier ?></td>
                      <td> <span class="label <?php echo label_status($po->id_status_transaksi)?>"><i class="fa fa-check-square-o"></i> <?php echo $po->status_transaksi; ?></span> </td>

                      <td>
                        <a href="#" class="label label-merah"><i class="fa fa-trash"></i> Delete</a>
                        <a href="#" class="label label-default"><i class="fa fa-eye"></i> Read</a>
                      </td>

                    </tr>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="8" style="text-align:center;"><i class="fa fa-2x fa-warning"></i><h5>Purchase Order Kosong</h5></td>
                    </tr>
                <?php endif; ?>

              </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            <?php echo $paginator; ?>
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>
