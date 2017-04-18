
<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.min.css') ?>">
<style media="screen">
.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: rgb(255, 0, 0);
  color: white;
}
</style>
<!-- Modal -->
<div id="pilih_item" class="modal fade" role="dialog">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content" style="border-radius:5px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-cubes"></i> Pilih Barang</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Barang</label>
              <select class="form-control  select2" id="barang" style="width:100%;">
                <?php $barang = items();
                foreach ($barang as $b): ?>
                  <option value="<?php echo $b->id_item ?>"><?php echo $b->item_nama ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <input type="number" min="0"  class="form-control input-sm" id="qty" required="">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="informasi_input pull-left"></div>
        <button type="button" onclick="simpanlist()" class="btn  btn-xs btn-merah" style="color:white;">Tambah ke Daftar Permintaan</button>
        <button type="button" class="btn  btn-xs btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!--tambahkan custom js disini-->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.full.min.js')?>"></script>
<script type="text/javascript">
  $(function() {
    $(".select2").select2();
  });


  function simpanlist() {
    var id_item = $('#barang').val();
    var qty = $('#qty').val();
    if(qty > 0){
    $.ajax({
      url:"<?php echo site_url(''.base_akses().'pb/simpan_ke_list')?>",
      type:"POST",
      cache:false,
      data:{id_item:id_item,qty:qty},
      success:function(data){

          tempalert(data,1000);


      }
    });
    }

  }

  function tempalert(msg,durasi)
  {
       var el = $('.informasi_input').html(msg);
           setTimeout(function(){
            $('.informasi_input').html('');
          },durasi);
  }

</script>
