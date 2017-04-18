<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo nama_program(); ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/square/blue.css') ?>" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?php echo base_url('assets/image/favicon.png'); ?>" />

        <style media="screen">
          .btn-danger{
            background-color: #ff0000;
          }
        </style>
    </head>
    <body class="login-page">
        <div class="login-box" style="background-color:#fff; padding-top:40px; border-radius:5px;">
            <div class="login-logo">
              <img src="<?php echo base_url('assets/image/purchase.png')?>" alt="purchase" width="200px;" />
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">
                  <?php if($this->session->flashdata('login') == TRUE ){
                    echo $this->session->flashdata('login');
                  }else {
                    echo "Log in untuk management system";
                  } ?>
                </p>
                <form action="<?php echo site_url('auth/login') ?>" method="post" autocomplete="off">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="username" placeholder="Username"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="Password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">

                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Log in</button>
                        </div><!-- /.col -->
                    </div>
                </form>



            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
