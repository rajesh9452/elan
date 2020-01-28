<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span.activateShow a {font-size: 19px;color: green;}span.deleteShow a {font-size: 19px;color: red;}img.img-thumbnail {width: 225px;}</style>
    <style type="text/css">.well{padding: 10px;}</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Update Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Update Admin</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Admin Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-body -->
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="<?php echo base_url('profile-admin'); ?>">
                 <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Name:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?= $result['name'];?>" name="name">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Email:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?= $result['email'];?>" name="email">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Password:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value=""  name="password">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Profile:</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="images">
                    <img src="<?php echo base_url('uploads/'.$result['profile']); ?>" style="width:100px;">
                  </div>
                </div>
                <div class="form-group"> 
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Update</button>
                  </div>
                </div>
              </form>
            <!-- /.box-body --> 
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper