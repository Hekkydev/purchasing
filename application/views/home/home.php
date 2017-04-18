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

<div class="row">
  <div class="col-lg-8">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-bar-chart-o"></i> Grafik Kategori</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              </div>
        </div>
        <div class="box-body">
            <!-- <div id="container" style="min-width: 310px; width:auto ; height:350px; margin: 0 auto"></div> -->
              <div class="">
                <table class="table-responsive table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>RG</th>
                      <th style="text-align:center;">Outstanding</th>
                      <th style="text-align:center;">Received</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($rg as $rg): ?>
                      <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $rg->kode_rg ?></td>
                          <td style="text-align:center;"><?php echo cek_outstanding_rg($rg->kode_rg);?></td>
                          <td style="text-align:center;"><?php echo jml_rg($rg->kode_rg); ?></td>
                        </tr>
                    <?php $no++; endforeach; ?>
                  </tbody>
                </table>
              </div>
        </div><!-- /.box-body -->

    </div><!-- /.box -->
  </div>
  <div class="col-lg-4">
    <?php $this->load->view('home/widget'); ?>
  </div>

</div>

</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script src="<?php echo base_url('assets/js/highcharts.js')?>" charset="utf-8"></script>
<style type="text/css">
${demo.css}
</style>
<script type="text/javascript">
$(function () {
$('#container').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: false
    },
    xAxis: {
        categories: <?php echo $kategori;?>,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Barang'
        }
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Barang',
        data: <?php echo $graf;?>

    }]
});
});
</script>
<?php
$this->load->view('template/foot');
?>
