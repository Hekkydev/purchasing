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
<?php $this->load->view('barang/menu'); ?>
<?php echo $this->session->flashdata('info'); ?>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="<?php echo $hal->judul_icon?> "></i> <?php echo $hal->sub_judul?></h3>

            <div class=" box-tools pull-right">
                <a href="<?php echo site_url(''.base_akses().'barang/add')?>" class="btn btn-box-tool btn-default" title="Tambahkan Barang Baru"><i class="fa fa-plus"></i> Tambah Item</a>
            </div>
        </div>
        <?php if ($barang == TRUE): ?>
          <div class="box-body">
          <?php else: ?>
          <div class="box-body" style="height:300px;">
        <?php endif; ?>
          <table class="table table-responsive table-striped table-hover">
            <thead>
              <tr>
                <th>Nama Barang</th>
                <th>Kode</th>
                <th>Kategori</th>
                <th>Atribut</th>
                <th>Keterangan</th>

              </tr>
            </thead>
            <tbody>
              <?php if ($barang == TRUE): ?>
                <?php
                  foreach ($barang as $items): ?>
                 <tr>
                   <td><b><?php echo $items->item_nama; ?></b></td>
                   <td><?php echo $items->unique_kode; ?></td>
                   <td><?php echo $items->nama_category; ?></td>
                    <td><?php echo $items->nama_atribut; ?></td>
                    <td><?php echo $items->item_desc; ?></td>
                   <td class="col-xs-2">
                     <a href="<?php echo site_url(''.base_akses().'barang/b_open/'.$items->id_item.'')?>" class="label label-info btn-xs pull-right-app"><i class="fa fa-pencil"></i> Open</a>
                     <a href="<?php echo site_url(''.base_akses().'barang/delete_data?get=1&id='.$items->id_item.'')?>" class="label label-primary btn-xs pull-right-app"><i class="fa fa-trash"></i> Delete</a></td>
                 </tr>
                <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" style="text-align:center;"><i class="fa fa-warning fa-3x"></i><h5>Barang Kosong</h5></td>
                  </tr>
              <?php endif; ?>
            </tbody>
          </table>

        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            <?php echo $paginator;?>
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
