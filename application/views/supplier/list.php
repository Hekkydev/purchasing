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
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="<?php echo $hal->judul_icon?> "></i> <?php echo $hal->sub_judul?> |  <small><i class="fa fa-user"></i> <?php echo count(supplier()) ?></small>  </h3>
          <div class=" box-tools pull-right">
              <a href="<?php echo site_url('admin/supplier/add')?>" class="btn btn-box-tool btn-default" title="Tambahkan Supplier Baru"><i class="fa fa-plus"></i> Tambah Supplier</a>
          </div>
        </div>

          <?php if ($supplier == TRUE): ?>
              <div class="box-body">
            <?php else: ?>
              <div class="box-body" style="height:300px;">
          <?php endif; ?>
          <table class="table table-responsive table-hover table-striped">
            <thead>
              <tr>
                <th>Supplier</th>
                <th>Kode</th>


              </tr>
              <tbody>
                  <?php if ($supplier == TRUE): ?>
                    <?php foreach ($supplier as $var): ?>
                      <tr>
                        <td>
                        <strong><?php echo $var->nama_supplier ?></strong>
                        <article class="">
                        Alamat :  <i><?php echo $var->alamat ?></i> <br>
                        Telepon :  <?php echo $var->telepon ?> / Fax : <?php echo $var->fax ?>
                        </article>
                        </td>
                        <td class="col-md-1"><?php echo $var->kode_supplier ?></td>
                        <td class="col-md-2">
                            <a href="<?php echo site_url('admin/supplier/update/'.$var->id_supplier.'')?>" class="btn btn-primary btn-xs pull-right-app"> <i class="fa fa-edit"></i> Update</a>
                          </td>
                      </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5" style="text-align:center;">
                          <i class="fa fa-warning fa-3x"></i>
                          <h5>Supplier Kosong</h5>
                        </td>
                      </tr>
                  <?php endif; ?>
              </tbody>
            </thead>
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">

              <?php echo $paginator?>

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
