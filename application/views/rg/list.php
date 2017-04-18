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
            <h3 class="box-title"><i class="<?php echo $hal->judul_icon?> "></i> <?php echo $hal->sub_judul?>  </h3>
            <div class=" box-tools pull-right">
                <a href="<?php echo site_url(''.base_akses().'rg/add')?>" class="btn btn-box-tool btn-default" title="Buat Received Goods"><i class="fa fa-plus"></i> Buat Received Goods</a>
            </div>
        </div>
        <?php if ($RG == FALSE): ?>
          <div class="box-body" style="height:300px;">
            <?php else: ?>
          <div class="box-body">
        <?php endif; ?>
          <?php $this->load->view('rg/list_data'); ?>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            <?php echo $paginator;?>
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>
