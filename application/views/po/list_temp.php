<fieldset class="material-form">
  <label><i class="fa fa-cubes"></i> Material</label>
  <!-- Table row -->
<div class="row">
 <div class="col-xs-12 table-responsive">
   <table class="table table-striped">
     <thead>
     <tr>
       <th style="width:10px;"></th>
       <th>Kode Permintaan</th>
       <th>Qty</th>
       <th>Material Barang</th>
       <th>Kode Barang</th>
       <th>Satuan</th>
       <th >Harga</th>
       <th><div align="right">Total </div></th>
     </tr>
     </thead>
     <tbody >
    <?php $total=0; $total_hasil = 0; $pajak=0; $po_temp = get_temp_po();foreach ($po_temp as $po): ?>
      <tr>
        <td><a href="#" onclick="remove_temp_po(<?php echo $po->id_po_temp?>)" class="text-merah"><i class="fa fa-minus"></i></a></td>
        <td><?php echo $po->kode_pb ?></td>
        <td><input type="number" id="number<?php echo $po->id_po_temp;?>" style="width:50px" value="<?php echo $po->qty_po ?>" onchange="qty_edit<?php echo $po->id_po_temp?>(<?php echo $po->id_po_temp?>)" max="<?php echo max_pb($po->kode_pb,$po->id_item); ?>" min="1"></td>
        <td><?php echo $po->item_nama ?></td>
        <td><?php echo $po->unique_kode ?></td>
        <td><?php echo $po->nama_atribut ?></td>
        <td style="width:70px">
          <input type="text" id="harga<?php echo $po->id_po_temp?>" required="" onblur="simpan_harga<?php echo $po->id_po_temp?>(<?php echo $po->id_po_temp?>)"
          <?php if ($po->harga > 0): ?>
              value="<?php echo round($po->harga,2)?>"
            <?php else: ?>
              placeholder="<?php echo $po->harga?>"
          <?php endif; ?> >
        </td>
        <td style="width:70px;">
          <div align="right">
          <?php $total_price = $po->qty_po * $po->harga; echo round($total_price,2) ?>
        </div>
      </td>

      </tr>
    <?php
    $total += $total_price;
    endforeach;
    $pajak =  $total * tax()->tax/100;?>
    <input type="hidden" id="jumlah_temp" value="<?php echo count(get_temp_po());?>">
     </tbody>
   </table>
 </div>
 <!-- /.col -->
</div>
<!-- /.row -->
</fieldset>
<br>
<div class="row">
 <!-- accepted payments column -->
 <div class="col-xs-6">

 </div>
 <!-- /.col -->
 <div class="col-xs-6">
     <div class="table-responsive">

     <table class="table" style="border:1px solid; border-color:#ddd;">
       <tr>
         <th>Sub Total:</th>
         <td><strong><?php echo rupiah($total); ?></strong></td>
       </tr>
       <tr>
         <th>Tax:</th>
         <td><input type="text" name="tax" class="tax" onblur="tax()"  value="<?php echo tax()->tax;?>" style="width:40px" > <strong>%</strong></td>
       </tr>
       <tr>
         <th><h4>Total:</h4></th>
         <td><strong><h4>
          <div id="total">
            <?php
            $total_hasil = $total + $pajak;
            echo rupiah($total_hasil); ?>
          </div> </h4></strong></td>
       </tr>
     </table>
   </div>
 </div>
 <!-- /.col -->
</div>
<!-- /.row -->
<script type="text/javascript">

  $('.tax').blur(function() {
    var tax = $(".tax").val();
    $.ajax({
      url:"<?php echo site_url(''.base_akses().'po/tax')?>",
      type:"POST",
      cache:false,
      data :{tax : tax },
      success:function(data){
        return get_temp_po();
      }
    });
  });


function remove_temp_po(n) {
  var id = n;
  $.ajax({
    url:"<?php echo site_url(''.base_akses().'po/remove_temp_po')?>",
    type:"POST",
    cache:false,
    data :{id : id },
    success:function(data){
      return get_temp_po();
    }
  });
}

</script>
<?php $po_temp = get_temp_po();foreach ($po_temp as $po): ?>
  <script type="text/javascript">
    function simpan_harga<?php echo $po->id_po_temp?>(id) {
      var harga = $('#harga<?php echo $po->id_po_temp?>').val();
      var id = id;
      $.ajax({
        url:"<?php echo site_url(''.base_akses().'po/save_price')?>",
        cache:false,
        type:"POST",
        data :{id : id , harga : harga },
        success:function(data){
          setTimeout(
           get_temp_po()
          ,60);
        }
      });
    }


    function qty_edit<?php echo $po->id_po_temp?>(id) {
      var id = id;
      var qty = $("#number<?php echo $po->id_po_temp?>").val();
      $.ajax({
        url:"<?php echo site_url(''.base_akses().'po/qty_edit_temp')?>",
        type:"POST",
        cache:false,
        data:{id:id , qty:qty},
        success:function(data){
          return get_temp_po();
        }
      });
    }


  </script>
<?php endforeach; ?>
