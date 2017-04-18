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

  <?php $this->load->view('pb/menu'); ?>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="<?php echo $hal->judul_icon?> "></i> <?php echo $hal->sub_judul?>  </h3>
          <div class=" box-tools pull-right">
              <a href="<?php echo site_url(''.base_akses().'pb/add')?>" class="btn btn-box-tool btn-default" title="Buat Purchase Requestions"><i class="fa fa-plus"></i> Request Items</a>
          </div>
        </div>
        <?php if ($PB == TRUE): ?>
          <div class="box-body" >
            <?php else: ?>
          <div class="box-body" style="height:300px;">
        <?php endif; ?>
            <table class="table table-responsive table-striped">
              <thead >
                <tr>
                  <th style="width:10px;"></th>
                  <th style="width:330px;">FAKTUR</th>
                  <th style="width:170px;">Tanggal Permintaan</th>
                  <th style="width:180px;">Tanggal Planning</th>
                  <th>Qty</th>
                  <th style="width:120px;">Status</th>
                </tr>
              </thead>
              <tbody>

                  <?php if ($PB == TRUE): ?>
                    <?php foreach ($PB as $PB): ?>

                      <tr>
                        <td><a target="_blank" href="<?php echo base_url(''.base_akses().'pb/download_pdf/'.$PB->id_pb.'')?>"  style="color:#333"><i class="fa fa-print"></i></a></td>
                        <td>
                          <a href="<?php echo site_url(''.base_akses().'pb/detail/'.$PB->id_pb.'')?>" style="color:#333"><b><i class="fa fa-newspaper-o"></i> <?php echo $PB->kode_pb ?></b></a>
                          <article class="">
                           <?php echo "<b>Material  : </b>"; material_item_data($PB->kode_pb);
                           $jml_material = count(material_item($PB->kode_pb));
                           if($jml_material > 3){
                             echo "....";
                           }
                             ?>
                          </article>
                        </td>

                        <td>
                          <?php echo tgl_lengkap($PB->tgl_create); ?>
                        </td>
                        <td><?php echo tgl_lengkap($PB->tgl_plan); ?></td>
                        <td><?php echo jml_material_item($PB->kode_pb)->jml ?></td>
                        <td> <span class="label <?php echo label_status($PB->id_status_transaksi)?>"><i class="fa fa-check-square-o"></i> <?php echo $PB->status_transaksi; ?></span> </td>
                        <td style="width:150px;">
                          <a href="#" class="label label-default"><i class="fa fa-pencil"></i> Update</a>
                          <a href="#" class="label label-merah"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="7" style="text-align:center;"><i class="fa fa-2x fa-warning"></i><h5>Purchase Request Kosong</h5></td>
                      </tr>
                  <?php endif; ?>

              </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <?php echo $paginator?>
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
