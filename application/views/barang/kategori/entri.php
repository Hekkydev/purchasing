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
            <h3 class="box-title"><i class="<?php echo $hal->judul_icon?> "></i> <?php echo $hal->sub_judul?></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="minimize"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="hilangkan"><i class="fa fa-times"></i></button>
            </div>
        </div>
      <form action="<?php echo site_url('admin/barang/add_kategori_proses')?>" method="post" autocomplete="off">
        <div class="box-body">

          <div class="row">
          <div class="col-md-12">



            <div class="form-group">
              <label>Nama Kategori</label>
              <input type="text" name="nama_category" class="form-control input-sm" value=""  placeholder="Tentukan nama kategori" required="">
            </div>


            <!-- /.form-group -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->


        </div><!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" name="entri" value="simpan" class="btn btn-primary btn-sm">Simpan</button>
            <button type="reset"  class="btn btn-default btn-sm">Reset</button>
            <a href="<?php echo site_url('admin/barang/kategori')?>" class="pull-right btn btn-default btn-sm">Kembali</a>
        </div><!-- /.box-footer-->

      </form>

    </div><!-- /.box -->

</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->




<?php
$this->load->view('template/foot');
?>
