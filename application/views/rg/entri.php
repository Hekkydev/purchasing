<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
$this->load->view('template/section');
?>
<!-- Default box -->
<section class="content">
   <div class="box">
       <div class="box-header with-border">
           <h3 class="box-title">
             <i class="fa fa-clipboard "></i> Form RG | <span class="label label-default"><?php echo unique_kode_rg() ?></span></h3>
           <div class="box-tools pull-right">
               <b ><?php echo nama_hari(date('Y-m-d')).', '.tgl_indo(date('Y-m-d')) ?></b>
           </div>
       </div>
     <form action="<?php echo site_url(''.base_akses().'rg/add_proses');?>" method="post" autocomplete="off">
       <div class="box-body">

         <div class="row">
           <div class="col-md-3">

             <div class="form-group">
               <label>Kode RG</label>
               <input type="text" name="kode_rg" id="kode_rg" class="form-control input-sm" value="<?php echo unique_kode_rg()?>" readonly="" required="">
             </div>

             <!-- /.form-group -->
           </div>
         <div class="col-md-3">

           <div class="form-group">
             <label>Surat Jalan</label>
             <input type="text" name="surat_jalan" class="form-control input-sm"  required="">
           </div>

           <!-- /.form-group -->
         </div>
         <!-- /.col -->
         <div class="col-md-3">
           <div class="form-group">
             <label>Tanggal Kedatangan</label>
             <input type="date"  name="tgl_plan" class="form-control input-sm" value="<?php echo date('Y-m-d')?>"  >
           </div>
         </div>
         <!-- /.col -->
         <div class="col-md-3">
           <div class="form-group">
             <label>Supplier</label>
             <select class="form-control input-sm" name="supplier" id="supplier_id" required="" onchange="pilih_supplier()" >
               <option value="0" disabled="" selected="">Pilih</option>
               <?php foreach ($PO as $P): ?>
                 <?php if ($cek_supplier_rg->id_supplier == $P->id_supplier): ?>
                     <option value="<?php echo $P->id_supplier ?>" selected=""><?php echo $P->nama_supplier ?></option>
                   <?php else: ?>
                     <option value="<?php echo $P->id_supplier ?>"><?php echo $P->nama_supplier ?></option>
                 <?php endif; ?>
               <?php endforeach; ?>
             </select>
           </div>
         </div>
       </div>
       <!-- /.row -->
       <div  id="list_temp_rg">

       </div>

       </div><!-- /.box-body -->
       <div class="box-footer">
           <button type="submit" name="entri" value="simpan" class="btn btn-primary btn-sm">Simpan</button>

           <a href="http://localhost/purchase/admin/pb" class="pull-right-app btn btn-default btn-sm">Kembali</a>
           <button id="pilih_po" type="button" name="button" class="btn btn-merah btn-sm pull-right-app" data-toggle="modal" data-target="#pilih_data_po" style="color:#fff; display:none;">
             <i class="fa fa-upload"></i> Pilih PO</button>
          <button type="reset"  class="pull-right-app btn btn-default btn-sm" onclick="hapus_temp()">
            <i class="fa fa-close"></i> Reset</button>
       </div><!-- /.box-footer-->

     </form>

   </div>

</section><!-- /.content -->

<div class="po_list_template"></div>
<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script type="text/javascript">
    function pilih_supplier() {
      var rg = $("#kode_rg").val();
      var id = document.getElementById("supplier_id").value;

      if(id > 0){
          $.ajax({
            url:"<?php echo site_url(''.base_akses().'rg/cek_supplier_po')?>",
            type:"POST",
            cache:false,
            data : {kode_rg : rg, id_supplier:id},
            success:function(data){
                document.getElementById("pilih_po").style.display="block";
                $(".po_list_template").html(data);
                return get_temp_rg();
            }
          });

      }else{
          document.getElementById("pilih_po").style.display="none";
      }
    }

    function get_temp_rg() {
      $.ajax({
      type: "GET",
      cache:false,
      url: "<?php echo site_url(''.base_akses().'rg/get_temp')?>" }).done(function( data ) {
           $('#list_temp_rg').html(data);
      });
    }

    function hapus_temp() {
      $.ajax({
      type: "GET",
      cache:false,
      url: "<?php echo site_url(''.base_akses().'rg/remove_temp')?>" }).done(function( data ) {
           window.location.href="<?php echo site_url(''.base_akses().'rg/add')?>";
      });
    }
</script>
<?php if ($this->session->flashdata('gagal_entri')):?>
<?php $this->load->view('rg/gagal_entri'); ?>
<script>
    $('#gagal_entri').modal('show');
</script>
<?php endif;?>
<?php
$this->load->view('template/foot');
?>
