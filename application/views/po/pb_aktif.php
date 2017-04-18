<link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.min.css') ?>">
<style media="screen">
.select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: rgb(255, 0, 0);
  color: white;
}
</style>
<!-- css -->
<div id="pilih_pb" class="modal fade" role="dialog">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content" style="border-radius:5px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-clipboard"></i> Pilih Faktur Permintaan</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Kode Faktur</label>
              <select class="form-control  select2" id="id_pb" style="width:100%;">
                <?php
                foreach ($pb_aktif as $b): ?>
                  <option value="<?php echo $b->id_pb ?>"><?php echo $b->kode_pb ?></option>
                <?php endforeach; ?>
              </select>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="input_pb pull-left" style="color:#ff0000;"></div>
        <button type="button" onclick="simpan_pb()" class="btn  btn-xs btn-merah" style="color:white;">Tambah ke Daftar Permintaan</button>
        <button type="button" class="btn  btn-xs btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/select2/select2.full.min.js')?>"></script>
<script type="text/javascript">
  $(function() {
    $(".select2").select2();
  });

  function simpan_pb(){

    var id_pb = $('#id_pb').val();
    $.ajax({
      url:"<?php echo site_url(''.base_akses().'po/add_temp')?>",
      cache:false,
      type:"POST",
      data :{id_pb : id_pb},
      success:function(data){
          tempalert(data,1000);
          return get_temp_po();
        //alert(data);
      }
    });

  }


   function tempalert(msg,durasi)
  {
       var el = $('.input_pb').html(msg);
           setTimeout(function(){
            $('.input_pb').html('');
          },durasi);
  }
</script>
