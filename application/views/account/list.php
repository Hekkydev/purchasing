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

<div class="row">
  <div class="col-lg-12">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="<?php echo $hal->judul_icon?>"></i> <?php echo $hal->sub_judul ?></h3>
            <div class="box-tools pull-right">
                <a class="btn btn-primary" href="<?php echo site_url(''.base_akses().'account/add')?>"><i class="ion ion-ios-person"></i> Tambah</a>
            </div>
        </div>
        <div class="box-body">
             <table  class="table table-responsive table-striped table-condensed table-bordered">
                <thead>
                  <tr>
                  <th>No</th>
                  <th>Nama User</th>
                  <th>Profil</th>
                  <th>Hak Akses</th>
                  <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($account as $i) { ?>
                  <tr>
                    <td><?php echo $no ;?></td>
                    <td><?php echo $i->nama_user; ?></td>
                    <td><?php echo $i->nama_profile;?></td>
                    <td><?php echo $i->nama_group;?></td>
                    <td>
                      <a href="<?php echo site_url(''.base_akses().'account/update/'.$i->id_user.'')?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                      <?php if ($i->id_user != 1): ?>
                        <a href="<?php echo site_url(''.base_akses().'account/delete/'.$i->id_user.'')?>" class="btn btn-default btn-xs"><i class="fa fa-trash"></i></a>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php $no++; } ?>
                </tbody>
              </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>
