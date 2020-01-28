<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageTitle; ?></title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?php echo base_url('uploads/parking_logo.jpg'); ?>" type="image/x-icon">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('theme/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('theme/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('theme/'); ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('theme/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('theme/'); ?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('theme/'); ?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('theme/'); ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('theme/'); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('theme/'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('theme/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?php echo base_url('theme/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript">
     document.onreadystatechange=function(){
      var state=document.readyState;if(state=='interactive'){
      }else if(state=='complete'){
          setTimeout(function(){document.getElementById('interactive');
            document.getElementById('loaderDisplay').style.visibility='hidden';
           document.getElementById('showLoder').style.visibility='hidden' 
         },1000)}
    }
  </script>
  <style>
.skin-blue .main-header .logo:hover,.skin-blue .main-header .navbar,.skin-blue .main-header .navbar .sidebar-toggle:hover,.skin-blue .main-header li.user-header{background-color:#09c6c6}.skin-blue .main-header .logo{background-color:#09c6c6;color:#fff;border-bottom:0 solid transparent}.skin-blue .sidebar-menu>li.active>a{border-left-color:#09c6c6}.loader{border:6px solid #f3f3f3;border-radius:50%;border-top:6px solid #08c7c7;width:52px;height:53px;-webkit-animation:spin 2s linear infinite;animation:spin 2s linear infinite}@-webkit-keyframes spin{0%{-webkit-transform:rotate(0)}100%{-webkit-transform:rotate(360deg)}}@keyframes spin{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}.showLoder{position:fixed;z-index:9999999;right:50%;top:35%}div#loaderDisplay{position:fixed;width:100%;height:100%;background:0 0;z-index:9999999999}.user-panel>.image>img {width: 100%;max-width: 45px;height: auto;height: 45px;}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="showLoder" id="showLoder" >
  <div class="loader"></div></div>
<div class="wrapper">
<div   id="loaderDisplay"></div>
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('admin-dashboard'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?= ELAN?> </b>App</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php $adminData = $this->session->userdata('adminData');?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('uploads/'.$adminData['profile']); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ucfirst($adminData['name']); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('uploads/'.$adminData['profile']); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo ucfirst($adminData['name']); ?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('admin-profile-update'); ?>" class="btn btn-default btn-flat">Update</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('logout-account'); ?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>