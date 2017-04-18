</div><!-- /.content-wrapper -->

<footer class="main-footer" style="border-top:1px solid; border-color:#2a72ba;">
    <div class="pull-right hidden-xs">
        <b>Version</b> 0.1
    </div>
    <strong><a href="#" style="color:black">Purchase App</a> &copy</strong>.
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/slimScroll/jquery.slimScroll.min.js') ?>" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url('assets/AdminLTE-2.0.5/plugins/fastclick/fastclick.min.js') ?>'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/app.min.js') ?>" type="text/javascript"></script>


<script type="text/javascript">

function logout(){
    var reallyLogout = confirm("Anda yakin akan keluar?");
    if(reallyLogout){
        location.href="<?php echo site_url('auth/logout')?>";
    }
}

</script>
