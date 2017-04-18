<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
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
            <h3 class="box-title"><i class="<?php echo $hal->judul_icon ?>"></i> <?php echo $hal->sub_judul ?></h3>
            <div class="box-tools pull-right">
              <!-- cari -->
              <form class="" action="index.html" method="post">
                <div class="input-group input-group-sm" style="width: 550px;">
                    <div class="input-group-btn">
                      <a href="#" class="btn btn-default" data-toggle="modal" data-target="#laporan_pdf"><i class="fa fa-print"></i> print</a>
                    </div>
                    <div class="input-group-btn">

                    </div>

                    <input type="text" name="table_search" class="form-control pull-right" placeholder="supplier">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> cari</button>
                    </div>
                  </div>
              </form>
            </div>
        </div>
        <div class="box-body">
           <?php $this->load->view('report/laporan/supplier'); ?>
        </div><!-- /.box-body -->
        <div class="box-footer">

        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->



<!-- Modal -->
<div id="laporan_pdf" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" >

    <!-- Modal content-->
    <div class="modal-content" style="border-radius:5px; background-color:#f1f1f1;">
      <div class="modal-body">
        <div class="row">
          <div style="margin-left:-10px;margin-right:-10px;">
            <iframe src="<?php echo base_url(''.base_akses().'report/get_pdf_supplier')?>" class="col-lg-12" style="height:500px;" frameborder="0"></iframe>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>
