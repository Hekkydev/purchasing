<div id="pilih_data_po" class="modal fade" role="dialog">
  <div class="modal-dialog" >

    <!-- Modal content-->
    <div class="modal-content" style="border-radius:5px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><i class="fa fa-clipboard"></i> Pilih Purchase Order</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Kode PO</label>
              <input type="hidden" class="id_supplier" value="<?php echo $id_supplier?>">
              <select class="form-control  select2" id="kode_po" style="width:100%;">
                <?php foreach ($po_list as $po): ?>
                  <?php if ($po->id_status_transaksi < 3): ?>
                    <option value="<?php echo $po->kode_po ?>"><?php echo $po->kode_po ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="input_rg pull-left" style="color:#ff0000;"></div>
        <button type="button" onclick="simpan_rg()" class="btn  btn-xs btn-merah" style="color:white;">Tambah ke Daftar RG</button>
        <button type="button" class="btn  btn-xs btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  function simpan_rg() {
    var rg = $("#kode_rg").val();
    var kode_po = $('#kode_po').val();
    var id_supplier = $('.id_supplier').val();
    $.ajax({
      url:"<?php echo site_url(''.base_akses().'rg/add_temp')?>",
      type:"POST",
      cache:false,
      data:{kode_po:kode_po,id_supplier:id_supplier,kode_rg:rg},
      success:function(data) {
        $('.input_rg').html(data);
        return get_temp_rg();
      }
    });
  }
</script>
