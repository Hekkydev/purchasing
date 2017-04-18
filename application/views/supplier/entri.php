<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->

<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.min.css') ?>">
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
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
      <form action="<?php echo site_url('admin/supplier/add_proses')?>" method="post" autocomplete="off">
        <div class="box-body">

          <div class="row">
          <div class="col-md-6">

            <div class="form-group">
              <label>Kode Supplier</label>
              <input type="text" name="unique_kode_supplier" class="form-control input-sm" value="<?php echo unique_kode_supplier()?>" readonly="" required="">
            </div>

            <div class="form-group">
              <label>Nama Supplier</label>
              <input type="text" name="nama_supplier" class="form-control input-sm" value=""  placeholder="Tentukan nama supplier" required="">
            </div>

            <div class="form-group">
              <label>Alamat Supplier</label>
              <textarea name="alamat" class="form-control input-sm"></textarea>
            </div>


            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Telp</label>
              <input type="text" name="telepon" class="form-control input-sm" value=""  placeholder="isi no telp" required="">
            </div>
            <div class="form-group">
              <label>Fax</label>
              <input type="text" name="fax" class="form-control input-sm" value=""  placeholder="isi jika ada" >
            </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        </div><!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" name="entri" value="simpan" class="btn btn-primary btn-sm">Simpan</button>
            <button type="reset"  class="btn btn-default btn-sm">Reset</button>
            <a href="<?php echo site_url('admin/supplier/')?>" class="pull-right btn btn-default btn-sm">Kembali</a>
        </div><!-- /.box-footer-->

      </form>

    </div><!-- /.box -->

</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.full.min.js')?>"></script>
<script type="text/javascript">
  $(function() {
    $(".select2").select2();
  });
</script>



<?php
$this->load->view('template/foot');
?>
