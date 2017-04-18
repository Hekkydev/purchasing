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
  <div class="col-md-6">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="<?php echo $hal->judul_icon?>"></i>  <?php echo $hal->sub_judul?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
          <!-- form start -->
            <form role="form" action="<?php echo site_url(''.base_akses().'account/updateproses')?>" method="post">
              <input type="hidden" name="id_user" value="<?php echo $this->user->id_user?>">
              <div class="box-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Nama Akun</label>
                      <input type="text" class="form-control"  placeholder="Nama Akun" name="nama_akun" readonly="" value="<?php echo $this->user->nama_user?>">
                    </div>
                    <div class="form-group">
                      <label>Nama Profile</label>
                      <input type="text" class="form-control"  placeholder="nama profile" name="nama_profile" readonly="" value="<?php echo $this->user->nama_profile?>">
                    </div>
                    <div class="form-group">
                      <label>Hak Akses</label>
                      <input type="text" name="" class="form-control" value="<?php echo $this->user->id_group ?>" readonly="">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control"  placeholder="Username" name="username" readonly="" value="<?php echo $this->user->username?>">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control"  placeholder="Password" name="password" readonly="" value="<?php echo $this->user->password?>">
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->


            </form>

          </div>
        </div><!-- /.box-body -->

    </div><!-- /.box -->
    <div class="col-md-6">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-refresh"></i> Activity</h3>
            <a href="<?php echo site_url(''.base_akses().'account/truncate_activity/'.$this->user->id_user.'')?>" class=" pull-right btn btn-sm btn-default">
              <i class="fa fa-trash"></i> Hapus Activity
            </a>
          </div>
          <div class="box-body" style="overflow-y:scroll; height:400px;">
            <table class="table table-responsive">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Activity Time</th>
                  <th>Info</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach (activity_time($this->user->id_user) as $a): ?>
                  <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $a->activity_time ?></td>
                    <td>
                      <?php if ($a->info == "login"): ?>
                          <p style="color:blue;"><?php echo $a->info ?></p>
                        <?php else: ?>
                          <p style="color:red;"><?php echo $a->info ?></p>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php $no++; endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
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
