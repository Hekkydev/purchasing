<!-- Modal -->
  <div class="modal fade" id="gagal_entri" role="dialog" >
    <div class="modal-dialog" >

      <!-- Modal content-->
      <div class="modal-content" style="border-radius:5px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title" align="center"><i class="fa fa-warning"></i>  Informasi</h5>
        </div>
        <div class="modal-body" align="center">
          <p><?php echo $this->session->flashdata('gagal_entri'); ?></p>
        </div>
      </div>

    </div>
  </div>
