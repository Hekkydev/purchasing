<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->

<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.min.css') ?>">

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
$this->load->view('template/section');
echo $this->session->flashdata('info');
?>


<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="<?php echo $hal->judul_icon?> "></i> <?php echo $hal->sub_judul?> | <?php echo unique_kode_pb() ?></h3>
            <div class="box-tools pull-right">
                <b ><?php echo nama_hari(date('Y-m-d')).'-'.tgl_indo(date('Y-m-d'))?></b>
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
      <form action="<?php echo site_url(''.base_akses().'pb/add_proses')?>" method="post" autocomplete="off">
        <div class="box-body">

          <div class="row">
          <div class="col-md-6">

            <div class="form-group">
              <label>FAKTUR</label>
              <input type="text" name="unique_kode_pb" class="form-control input-sm" value="<?php echo unique_kode_pb() ?>" readonly="" required="">
            </div>

            <div class="form-group">
              <label>Keterangan Permintaan</label>
              <textarea name="keterangan" class="form-control input-sm" placeholder="Berikan keterangan"></textarea>
            </div>


            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Permintaan Barang</label>
              <input type="text" name="tgl_create" class="form-control input-sm" value="<?php echo date('d/m/Y')?>"  required="" readonly="">
            </div>
            <div class="form-group">
              <label>Tanggal Planning</label>
              <input type="date"  name="tgl_plan" class="form-control input-sm" value="<?php echo date('Y-m-d')?>"  >
            </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        </div><!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" name="entri" value="simpan" class="btn btn-primary btn-sm">Simpan</button>
            <button type="reset"  class="btn btn-default btn-sm">Reset</button>
            <a href="<?php echo site_url(''.base_akses().'pb')?>" class="pull-right-app btn btn-default btn-sm">Kembali</a>
            <button type="button" name="button" class="btn btn-merah btn-sm pull-right-app" data-toggle="modal" data-target="#pilih_item" style="color:#fff;">
              <i class="fa fa-upload"></i> Pilih Barang</button>

        </div><!-- /.box-footer-->

      </form>

    </div><!-- /.box -->
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-cubes"></i> Material Barang</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              </div>
        </div>
        <div class="box-body">
        <div class="row">
        <div class="col-lg-12">
          <table class="table table-responsive">
            <thead>
              <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Qty</th>

              </tr>
            </thead>
            <tbody class="list" onload="get_list_pb()">

            </tbody>
          </table>
        </div>
      </div>
        </div>

    </div>
</section><!-- /.content -->

<?php
$this->load->view('template/js');
$this->load->view('pb/pilih_item');
?>

<!--tambahkan custom js disini-->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.full.min.js')?>"></script>
<script type="text/javascript">
  $(function() {
    $(".select2").select2();
  });

function get_list_pb() {
    $.ajax({
    type: "GET",
    cache:false,
    url: "<?php echo site_url(''.base_akses().'pb/get_list_pb')?>" }).done(function( data ) {
         $('.list').html(data);
    });

  }

  setInterval(get_list_pb,1000);

</script>



<?php
$this->load->view('template/foot');
?>
