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
      <form action="<?php echo site_url('admin/barang/update_proses')?>" method="post" autocomplete="off">
        <input type="hidden" name="id_item" value="<?php echo $items->id_item;?>">
        <div class="box-body">

          <div class="row">
          <div class="col-md-6">

            <div class="form-group">
              <label>Kode Barang</label>
              <input type="text" name="unique_kode" class="form-control input-sm" value="<?php echo $items->unique_kode;?>" readonly="" required="">
            </div>

            <div class="form-group">
              <label>Nama Barang</label>
              <input type="text" name="item_nama" class="form-control input-sm" value="<?php echo $items->item_nama;?>"  placeholder="Tentukan nama barang" required="">
            </div>

            <div class="form-group">
              <label>Deskripsi Barang</label>
              <textarea name="item_desc" class="form-control input-sm"><?php echo $items->item_desc;?></textarea>
            </div>

          

            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Kategori Barang</label>
              <select class="form-control select2 " style="width: 100%;" name="id_item_category" required="">
                <option value=""  disabled="" >pilih kategori</option>
                <?php
                $ic = items_category();
                foreach ($ic as $ic): ?>
                <?php if ($ic->id_item_category == $items->id_item_category): ?>
                    <option value="<?php echo $items->id_item_category;?>" selected=""><?php echo $items->nama_category;?></option>
                  <?php else: ?>
                    <option value="<?php echo $ic->id_item_category;?>"><?php echo $ic->nama_category;?></option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>Disabled Result</label>
              <select class="form-control select2" style="width: 100%;" name="id_item_atribut" required="">
                <option value=""  disabled="" >pilih atribut</option>
                <?php
                $ia = items_atribut();
                foreach ($ia as $ia): ?>
                <?php if ($ia->id_item_atribut == $items->id_item_atribut): ?>
                    <option value="<?php echo $items->id_item_atribut?>"selected=""><?php echo $items->id_item_atribut?></option>
                  <?php else: ?>
                    <option value="<?php echo $ia->id_item_atribut;?>"><?php echo $ia->nama_atribut;?></option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        </div><!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" name="entri" value="simpan" class="btn btn-primary btn-sm">Simpan</button>
            <button type="reset"  name="reset" value="reset" class="btn btn-default btn-sm">Reset</button>
            <a href="<?php echo site_url('admin/barang/')?>" class="pull-right btn btn-default btn-sm">Kembali</a>
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
