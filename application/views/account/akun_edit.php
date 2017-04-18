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
            <form role="form" action="<?php echo site_url(''.base_akses().'account/update_accountproses')?>" method="post">
              <input type="hidden" name="id_user" value="<?php echo $this->user->id_user?>">
              <div class="box-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control"  placeholder="Username" name="username" value="<?php echo $this->user->username?>">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control"  placeholder="Password" name="password"  value="<?php echo $this->user->password?>">
                    </div>
                  </div>

                </div>
                <button type="submit"  class="btn btn-primary btn-md">Update</button>
              </div>
              <!-- /.box-body -->


            </form>

          </div>
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
