<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo nama_program() ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/ionicons-2.0.1/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/skins/_all-skins.min.css') ?>" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="<?php echo base_url('assets/image/favicon.png'); ?>" />

    <style media="screen">
    .box{
      border-left: 1px #ddd solid;
      border-right: 1px #ddd solid;

    }
    .content-wrapper, .right-side {
        min-height: 100%;
        background-color: #f9fbfd;
        z-index: 800;
    }
    .skin-black .main-header>.navbar {
          background-color: #dfebf8 !important;
      }
      .skin-black .main-header>.navbar .nav>li>a:hover, .skin-black .main-header>.navbar .nav>li>a:active, .skin-black .main-header>.navbar .nav>li>a:focus, .skin-black .main-header>.navbar .nav .open>a, .skin-black .main-header>.navbar .nav .open>a:hover, .skin-black .main-header>.navbar .nav .open>a:focus {
          background: rgb(224, 228, 234);
          color: #333;
          border-left:2px white solid;
      }
      header{
        border-bottom: 1px solid;
        border-color: rgb(65, 135, 202);;
      }
      .skin-black .sidebar>.sidebar-menu>li>a:hover, .skin-black .sidebar>.sidebar-menu>li.active>a {
          color: #fff;
          background: rgba(255, 0, 0, 0.71);
          border-left-color: #fff;
          border-top-color:#fff;
          border-bottom-color:#fff;
      }

      .skin-black .main-header>.navbar>.sidebar-toggle {
          color: rgb(65, 135, 202);;
          border-right: 1px solid #eee;
      }

      .btn-merah{

          font-color: #fff;
          background-color: rgb(65, 135, 202);;

      }

      .text-merah{
        color: rgb(65, 135, 202); !important;
      }

      .text-putih{
        color: #fff !important;
      }
      .label-merah{
        background-color: rgb(65, 135, 202); !important;
        color: #fff;
      }

      .navbar-nav>.user-menu>.dropdown-menu>.user-body a {
          color: #f4f4f4 !important;
      }

      .navbar-nav>.user-menu>.dropdown-menu>li.user-header>img {
        background-color: #fff;
      }

      .skin-black .main-header li.user-header {
        margin-top: -1px;
        border-top: 1px solid;
        border-top-color:rgb(65, 135, 202);;
      }
      .skin-black .main-header li.user-header {
            background-color: #dfebf8;
        }
        .navbar-nav>.user-menu>.dropdown-menu>li.user-header>p {
            z-index: 5;
            color: #fff;
            color: #333;
            font-size: 17px;
            margin-top: 10px;
        }
      .skin-black .main-header>.navbar .sidebar-toggle:hover {
          color: rgb(65, 135, 202); !important;
          background: #fff;
      }
      .skin-black .main-sidebar, .skin-black .left-side, .skin-black .wrapper {
          background: #fff;
          border-right: 1px #ddd solid;
      }
      .skin-black .sidebar>.sidebar-menu>li.header {
          background: #e0e4ea;
          color: #999;
      }
      .skin-black .sidebar>.sidebar-menu>li>a:hover, .skin-black .sidebar>.sidebar-menu>li.active>a {
          color: #fff;
          background: rgb(65, 135, 202);
          border-left-color: #fff;
          border-top-color: #fff;
          border-bottom-color: #fff;
      }
      .skin-black .sidebar a {
          color: #333;
      }
      .skin-black .sidebar>.sidebar-menu>li>.treeview-menu {
          background: #f9f9f9;
      }

      .skin-black .treeview-menu>li>a {
            color: #333;
      }
      .skin-black .treeview-menu>li> :hover{
            color: rgb(124, 181, 236) !important;

        }
        .skin-black .sidebar>.sidebar-menu>li>a {
          margin-right: 1px;
          border-left: 3px solid #337ab7;
      }
      .main-footer {
          background: #dfebf8;
          padding: 15px;
          color: #444;
          border-top: 1px solid #eee;
      }
    .info-box-icon-app {
        border-top-left-radius: 2px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 2px;
        display: block;
        float: left;
        height: 55px;
        width: 55px;
        text-align: center;
        font-size: 30px;
        line-height: 60px;
        background: rgba(0,0,0,0.2);
    }

    .info-box-app {
        display: block;
        min-height: 30px;
        background: #fff;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        border-radius: 2px;
        margin-bottom: 10px;
    }

    .info-box-content-app {
        padding: 5px 10px;
        margin-left: 50px;
    }

    .table>thead>tr>th {
        border-bottom: 2px solid #312121;
    }


    .pull-right-app{
      float: right;
      margin:2px;
    }

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        font-size: 12px;
        border-top: 1px solid #ddd;
    }

    .material-form{
      border: 1px solid;
      border-color: #ddd;
      padding-left: 5px;
      padding-right: 5px;
      padding-top: 10px;
    }
    .material{
      margin-top: 10px;
    }

    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
          z-index: 2;
          color: #fff;
          cursor: default;
          background-color: rgb(65, 135, 202); !important;
          border-color: rgb(65, 135, 202); !important;
      }

      .bg-blue {
          background-color: #56a1e8  !important;
      }
    </style>
    <style>


      h3{
         text-align:center; }
      table {
         border-collapse:collapse;
         border-spacing:0;
         font-family:Arial, sans-serif;
         font-size:16px;
         padding-left:300px;
         margin:auto;

        }

      table th {
         font-weight:bold;
         padding:10px;
         color:#fff;
         background-color:rgb(65, 135, 202);;
         border-top:1px black solid;
         border-bottom:1px black solid;

       }
      table td {
         padding:10px;
         border-top:1px black solid;
         border-bottom:1px #ddd solid;
          }
      tr:nth-child(even) {
        background-color: #DFEBF8; }

      </style>
