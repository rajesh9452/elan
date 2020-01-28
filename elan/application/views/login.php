<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= ELAN; ?> - Admin Login App</title>
  <link rel="icon" href="<?php echo base_url('uploads/fav-icon.png'); ?>" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('theme'); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('theme'); ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('theme'); ?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('theme'); ?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('theme'); ?>/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<style type="text/css">span p{color: red;}
}
/*.login-logo, .register-logo {
    font-size: 35px;
    text-align: center;
    margin-bottom: 0px;
    font-weight: 300;
}*/
.login-logo, .register-logo {
    font-size: 35px;
    text-align: center;
    margin-bottom: 0px;
    font-weight: 300;
}body.hold-transition.login-page {
    height: auto;
}
</style>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background: url('<?php echo base_url('uploads/loginbanner.jpg'); ?>');background-position: center center;background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
<div class="login-box" >
  <!-- /.login-logo -->
  <div class="login-box-body">

    <div class="login-logo">
      <a href="#"><b><?= ELAN; ?></b> App</a>
      <h3>Admin Panel</h3>
  </div> 
    <p class="login-box-msg">
     <?php $getMessage = $this->session->flashdata('message'); echo (!empty($getMessage) ? $this->session->flashdata('message') :'Sign in to start your session'); ?></p>
    <form action="<?php echo base_url('admin-login');?>" method="post" >
      <div class="form-group has-feedback">
        <select name="userType" class="form-control">
           <option value="" hidden="">Select Login Type</option>
           <option value="1">Admin</option>
           <option value="2">Factory</option>
        </select>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span><?php echo form_error('userType'); ?></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span><?php echo form_error('email'); ?></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span><?php echo form_error('password'); ?></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('theme'); ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('theme'); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url('theme'); ?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
