<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span.activateShow a {font-size: 19px;color: green;}span.deleteShow a {font-size: 19px;color: red;}img.img-thumbnail {width: 225px;}</style>
    <style type="text/css">.well{padding: 10px;}span>p {
    color: red;
    margin: 0px;
}</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small><?php echo (!empty($result) ? 'Update User' : 'Add New User'); ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('manage-users'); ?>"><?php echo (!empty($result) ? 'Update User' : 'Add New User'); ?></a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo (!empty($result) ? 'Update User' : 'Add New User'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-body -->
              <form class="form-horizontal" method="post" action="<?php echo base_url('register-new-users'); ?>" onsubmit="return validate()">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Name:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo (!empty($result['name']) ? ucfirst($result['name']) : set_value('name')); ?>" name="name"  placeholder="Please enter your name">
                    <input type="hidden" name="id" value="<?php echo (!empty($result['id']) ? $result['id'] :''); ?>">
                    <span id="nameError"><?php echo form_error('name'); ?></span>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Email:</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" value="<?php echo (!empty(set_value('email')) ? set_value('email') : (!empty($result['email']) ? $result['email'] : ''  ) ); ?>" name="email" placeholder="Please enter email id">
                     <span id="emailError"><?php echo form_error('email'); ?></span>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Mobile Number:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="number" placeholder="Please enter mobile number"  value="<?php echo  (!empty(set_value('number')) ? set_value('number') : (!empty($result['mobileNumber']) ? $result['mobileNumber'] : ''  ) ); ?>">
                     <span id="numberError"><?php echo form_error('number'); ?></span>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Password:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Enter user password" name="password" value="<?php echo (!empty($result['password']) ? base64_decode($result['password']) :''); ?>">
                     <span id="passwordError"><?php echo form_error('password'); ?></span>
                  </div>
                </div>
                <div class="form-group"> 
                  <div class="col-sm-offset-1 col-sm-4">
                    <?php if(!empty($result['profile'])): ?>
                    <img src="<?php echo base_url().'/uploads/profile/'.(!empty($result['profile']) ? $result['profile'] :'defult.jpg') ?>" class="img-thumbnail" alt="Cinque Terre">
                  <?php endif; ?>
                   <button type="submit" class="btn btn-default"><?php echo (!empty($result) ? 'Update' : 'Submit'); ?></button>
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
  <script>
      function validate(){
          var name = $('input[name="name"]').val();
          var email = $('input[name="email"]').val();
          var number = $('input[name="number"]').val();
          var password = $('input[name="password"]').val();
           if(name.length == 0){
               $('#nameError').html('<p>Please enter your name.</p>'); return false;
           }
          if(email.length == 0){
               $('#emailError').html('<p>Please enter your email.</p>'); return false;
           }
          if(number.length == 0){
               $('#numberError').html('<p>Please enter your number.</p>'); return false;
           }else if(isNaN(number)){
             $('#numberError').html('<p>Please enter your valid number.</p>'); return false;
           }
           if(password.length == 0){
               $('#passwordError').html('<p>Please enter your password.</p>'); return false;
           }
      }
  </script> 
  <!-- /.content-wrapper -->