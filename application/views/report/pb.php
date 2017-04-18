<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
// $this->load->view('template/section');
?>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="<?php echo $hal->judul_icon ?>"></i> <?php echo $hal->sub_judul ?></h3>
            <div class="box-tools pull-right-app">

                             <span>
                             <label>Periode Rekapitulasi : </label>
                                 <select onchange="type_rekap();" id="jenis_rekap">
                                     <option value="0" selected="" disabled="">Pilih</option>
                                     <option value="ph">Per Hari</option>
                                     <option value="pb">Per Bulan</option>
                                     <option value="pt">Per Tahun</option>
                                 </select>
                             </span>
                             <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                             <span id="rekap"></span>
                             <span id="btn"></span>


            </div>
        </div>
        <div class="box-body">

                <div>
                    <div class="row">

                        <div class="col-md-12" >
                                <div id="laporan" class="well" style="height:400px; padding:0px;">

                                <?php  $this->load->view('report/laporan/pb'); ?>
                                </div>
                        </div>
                    </div>
                </div>


        </div><!-- /.box-body -->
        <div class="box-footer">
          <a href="#" class="btn btn-sm btn-default"  data-toggle="modal" data-target="#laporan_pdf" onclick="pdf_ajax();"><i class="fa fa-print"></i> Print</a>
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
          <div style="margin-right:-10px;margin-left:-10px;">

            <div class="modal_laporan">

            </div>

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
<script type="text/javascript">

    function type_rekap() {
        var jenis_rekap = $("#jenis_rekap").val();
        $.ajax({
            url:"<?php echo site_url(''.base_akses().'report/type_rekap');?>",
            type:"GET",
            cache:false,
            data:{ jenis_rekap : jenis_rekap},
            success:function(data) {
                $("#rekap").html(data);
                $("#btn").html('<button type="button" onclick="get_data();" class="btn btn-xs btn-default" style="margin-top:-3px;"> Simpan </button>');
            }
        });
    }

    function get_data() {
        var jenis_rekap = $('#jenis_rekap').val();
        var tanggal = $('#tanggal').val();
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();
        $.ajax({
            url:"<?php echo site_url(''.base_akses().'report/data_rekap_pb');?>",
            type:"GET",
            cache:false,
            data:{jenis_rekap:jenis_rekap,tanggal:tanggal,bulan:bulan,tahun:tahun},
            success:function(data) {
                $("#laporan").html(data);
            }
        })
    }

    function pdf_ajax() {
        var jenis_rekap = $('#jenis_rekap').val();
        var tanggal = $('#tanggal').val();
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();
        $.ajax({
            url:"<?php echo site_url(''.base_akses().'report/data_rekap_pb_laporan');?>",
            type:"GET",
            cache:false,
            data:{jenis_rekap:jenis_rekap,tanggal:tanggal,bulan:bulan,tahun:tahun},
            success:function(data) {
                $(".modal_laporan").html(data);
            }
        })
    }



</script>

<?php
$this->load->view('template/foot');
?>
