<fieldset class="material-form">
  <label><i class="fa fa-cubes"></i> Material</label>
  <!-- Table row -->
<div class="row">
 <div class="col-xs-12 table-responsive">
   <table class="table table-striped">
     <thead>
     <tr>
       <th style="width:10px;"></th>
       <th>Purchase Order</th>
       <th>Qty</th>
       <th>Material Barang</th>
       <th>Kode Barang</th>
       <th>Satuan</th>
     </tr>
     </thead>
     <tbody >
       <?php   $rg_temp = get_temp_rg(); $rg_detail = $this->db->get_where('t_rg_detail')->result();?>
         <?php  foreach ($rg_temp as $rg): ?>
           <?php
           $cek_qty_rg = qty_rg_out_stand($rg->kode_po,$rg->id_item);
           if($rg->aktif == 1){
            ?>
             <tr>
               <td><a href="#" onclick="remove_list(<?php echo $rg->id_rg_temp_detail?>)" class="text-merah"><i class="fa fa-minus"></i></a></td>
               <td><?php echo $rg->kode_po ?></td>
               <td><input id="number<?php echo $rg->id_rg_temp_detail?>" type="number" value="<?php echo $rg->qty_rg ?>" max="<?php echo $rg->qty_rg ?>" min="1" onchange="rubah_nilai<?php echo $rg->id_rg_temp_detail?>()"></td>
               <td><?php echo $rg->item_nama ?></td>
               <td><?php echo $rg->unique_kode ?></td>
               <td><?php echo $rg->nama_atribut ?></td>
             </tr>

         <?php } endforeach; ?>

     </tbody>
   </table>
 </div>
 <!-- /.col -->
</div>
<!-- /.row -->
</fieldset>

<script type="text/javascript">
  function remove_list(n) {
    var id = n;
    $.ajax({
      url:"<?php echo site_url(''.base_akses().'rg/remove_list')?>",
      type:"POST",
      cache:false,
      data :{id:id},
      success:function(data){
        return get_temp_rg();
      }
    })
  }
</script>
<?php  foreach ($rg_temp as $rg): ?>
<input type="hidden" id="id<?php echo $rg->id_rg_temp_detail?>" value="<?php echo $rg->id_rg_temp_detail?>">
<script type="text/javascript">
  function rubah_nilai<?php echo $rg->id_rg_temp_detail?>() {
      var id = $("#id<?php echo $rg->id_rg_temp_detail?>").val();
      var number = $("#number<?php echo $rg->id_rg_temp_detail?>").val();
      $.ajax({
        url:"<?php echo site_url(''.base_akses().'rg/ubah_nilai_temp')?>",
        type:"POST",
        cache:false,
        data:{id:id,number:number},
        success: function(){

        }
      });
  }
</script>
<?php endforeach?>
