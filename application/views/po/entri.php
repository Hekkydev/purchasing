<?php
$this->load->view('template/head');
 $supplier = supplier();
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.min.css') ?>">
<style media="screen">
.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: #ddd !important;
  color: black !important;
}
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
$this->load->view('template/section');
?>

<form action="<?php echo site_url(''.base_akses().'po/add_proses'); ?>" method="post">
   <!-- Main content -->
   <section class="content" style="background-color:#fff; margin:10px;">

     <!-- title row -->
     <div class="row">
       <div class="col-xs-12">
         <h2 class="page-header">
           <i class="<?php echo $hal->judul_icon ?>"></i> <?php echo $hal->sub_judul ?> | <span class="label label-default"><?php echo unique_kode_po() ; ?></span>          <small class="pull-right"><strong><i class="fa fa-calendar"></i> <?php echo nama_hari(date('Y-m-d')).', '.tgl_indo('Y-m-d')?></strong></small>
         </h2>
       </div>
       <!-- /.col -->
     </div>
     <!-- info row -->
     <div class="row invoice-info">
      <div class="col-sm-3 invoice-col">
         <label><strong> Kode PO</strong></label>
         <address>
          <input type="text" name="kode_po" value="<?php echo unique_kode_po() ; ?>" class="form-control input-sm"     readonly="" >

         </address>
       </div>
       <!-- /.col -->
       <div class="col-sm-3 invoice-col">
         <label><strong> Tanggal Planning</strong></label>
         <address>
          <input type="date" name="tgl_plan" value="<?php echo date('Y-m-d')?>" class="form-control input-sm">

         </address>
       </div>
       <!-- /.col -->
       <div class="col-sm-3 invoice-col">
         <label><strong> Keterangan</strong></label>
         <address >
           <textarea name="keterangan" rows="1" cols="40" class="form-control input-sm"></textarea>
         </address>
       </div>
       <!-- /.col -->
       <div class="col-sm-3 invoice-col">
         <label><strong> Supplier</strong></label>
         <address >
          <select class="form-control  select2 input-sm" id="supplier" style="width:100%;" name="id_supplier" required="">
            <?php if ($supplier == TRUE): ?>
              <?php foreach ($supplier as $b): ?>
                <option value="<?php echo $b->id_supplier ?>"><?php echo $b->kode_supplier.' - '.$b->nama_supplier ?></option>
              <?php endforeach; ?>
              <?php else: ?>
                <option value="" selected="" disabled="">Pilih</option>
            <?php endif; ?>
          </select>
         </address>
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->
     <div  id="list_temp_po">

     </div>

         <hr>
     <!-- this row will not appear when printing -->
     <div class="row no-print">
       <div class="col-xs-12">
          <a href="<?php echo site_url(''.base_akses().'po');?>"  class="btn btn-default btn-sm pull-right"><i class="fa fa-chevron-left"></i> Kembali</a>

         <button type="submit" class="btn btn-primary  btn-sm text-putih "><i class="fa fa-credit-card"></i> Simpan PO
         </button>
         <button type="button" data-toggle="modal" data-target="#pilih_pb" class="btn btn-merah pull-right btn-sm text-putih" style="margin-right: 5px;">
           <i class="fa fa-database"></i> No Purchase Request
         </button>
         <button type="button" onclick="hapus_temp()" class="btn btn-default pull-right btn-sm " style="margin-right: 5px;">
           <i class="fa fa-close"></i> Reset
         </button>
       </div>
     </div>
   </section>
   <!-- /.content -->
   <div class="clearfix"></div>
   <!-- </section> -->

</form>
<?php
$this->load->view('po/pb_aktif');
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.full.min.js')?>"></script>
<script type="text/javascript">
  $(function() {
    $(".select2").select2();
  });


  function get_temp_po() {
    $.ajax({
    type: "GET",
    cache:false,
    url: "<?php echo site_url(''.base_akses().'po/get_temp')?>" }).done(function( data ) {
         $('#list_temp_po').html(data);
    });
  }

  function hapus_temp() {
    $.ajax({
    type: "GET",
    cache:false,
    url: "<?php echo site_url(''.base_akses().'po/remove_temp')?>" }).done(function( data ) {
         return get_temp_po();
    });
  }

</script>

<?php
$this->load->view('template/foot');
?>
