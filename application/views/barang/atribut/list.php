<?php
$this->load->view('template/head');
$object = items_atribut();
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
                <a href="<?php echo site_url('admin/barang/atribut/add')?>" class="btn btn-box-tool btn-default" title="Tambahkan Atribut Baru"><i class="fa fa-plus"></i> Tambah Atribut</a>
            </div>
        </div>
        <?php if ($object == TRUE): ?>
          <div class="box-body">
          <?php else: ?>
          <div class="box-body" style="height:300px;">
        <?php endif; ?>
          <table class="table table-responsive table-striped table-hover">
            <thead>
              <tr>
                <th>Nama Atribut</th>

              </tr>
            </thead>
            <tbody>
              <?php if ($object == TRUE): ?>
                <?php
                 foreach ($object as $items): ?>
                 <tr>
                   <td><?php echo $items->nama_atribut; ?></td>
                   <td class="col-xs-2">
                     <a href="<?php echo site_url('admin/barang/atribut/open/'.$items->id_item_atribut.'')?>" class="label label-info btn-xs pull-right-app"><i class="fa fa-pencil"></i> Open</a>
                     <a href="<?php echo site_url('admin/barang/delete_data?get=3&id='.$items->id_item_atribut.'')?>" class="label label-danger btn-xs pull-right-app"><i class="fa fa-trash"></i> Delete</a></td>
                 </tr>
                <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="2" style="text-align:center;">
                      <i class="fa fa-warning fa-3x"></i>
                      <h5>Atribut Satuan Kosong</h5>
                    </td>
                  </tr>
              <?php endif; ?>
            </tbody>
          </table>

        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>
