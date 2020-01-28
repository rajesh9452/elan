<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span.activateShow a {font-size: 19px;color: green;}span.deleteShow a {font-size: 19px;color: red;}img.img-thumbnail {width: 225px;}</style>
    <style type="text/css">.well{padding: 10px;}span>p {
    color: red;
    margin: 0px;
}.list-group-item {
    position: relative;
    display: block;
    padding: 20px 15px;
    margin-bottom: -1px;
    background-color: #fff;
    border: 1px solid #ddd;
}
.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size:14px;
    font-weight: 700;
    line-height: 1;
    color: #a29b9b;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #fff;
    border-radius: 10px;
}</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Project Job
        <small>Details</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="">Project Job</a></li>
        <li class="active">Details</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
         <!-- Start Here -->
      <div class="col-xs-12">
        <div class="col-xs-3" style="padding: 0px;">
          <!-- Start Here -->
           <div class="col-xs-12"  style="padding: 0px;">
            <!--  -->
            <div class="box">
                <ul class="list-group">
                <li class="list-group-item" style="color: #928f8a;">Details
                  <span class="badge"></span>
                </li>
                <li class="list-group-item" style="color: #928f8a;">
                  <span style="background-color: #d3e8e8;padding: 5px;border-radius: 50%;color: #38a0fb;"><i class="fa fa-user-plus" aria-hidden="true"></i></span> Project Name
                  <span class="badge"><?php echo (!empty($result['project_name']) ? $result['project_name'] : ''  ); ?></span>
                </li>
                <li class="list-group-item" style="color: #928f8a;"><span style="background-color:#c4ffd6;padding: 5px;border-radius: 50%;color:#28dc57;"><i class="fa fa-refresh" aria-hidden="true"></i></span> Project Number<span class="badge"><?php echo (!empty($result['projetc_number']) ? $result['projetc_number'] : ''  ); ?></span></li>
               <li class="list-group-item" style="color: #928f8a;"><span style="background-color:#e6e6e6;padding: 5px;border-radius: 50%;color:#c8ccd0;"><i class="fa fa-clock-o" aria-hidden="true"></i></span> Company Name<span class="badge"><?php echo (!empty($result['companyName']) ? $result['companyName'] : ''  ); ?></span></li>
                <li class="list-group-item" style="color: #928f8a;"><span style="background-color:#f1e08f;padding: 5px;border-radius: 50%;color:#ef7933;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span> Address &nbsp;&nbsp;&nbsp;&nbsp; 
                  <div style="overflow-wrap: break-word;float: right;"><?php echo (!empty($result['address']) ? $result['address'] : ''  ); ?></div>
                </li>
                <li class="list-group-item" style="color: #928f8a;"><span style="background-color:#57c5a7;padding: 5px;border-radius: 50%;color:#fff;"><i class="fa fa-tasks" aria-hidden="true"></i></span> Job Name &nbsp;&nbsp;&nbsp;&nbsp; 
                  <div style="overflow-wrap: break-word;float: right;"><?php echo (!empty($result['job_name']) ? $result['job_name'] : ''  ); ?></div>
                </li>
                 <li class="list-group-item" style="color: #928f8a;"><span style="background-color:#ffe1cc;padding: 5px;border-radius: 50%;color:#e82727;"><i class="fa fa-times-circle" aria-hidden="true"></i></span> Status<span class="badge">
                        <?php echo ($result['jobAssignStatus'] == 1 ? 'IN PROGRESS' : ($result['jobAssignStatus'] == 2 ? 'READY': '')); ?>
                 </span></li>
            </ul>
           <!-- /.box-footer -->
             </div>
            <!--  -->
          </div>
           <!-- Close Here -->
           <!-- Start Here -->
        <h3 style="color: #a6aaad;">Job Status</h3>
          <div class="col-xs-12"  style="padding: 0px;">
            <!--  -->
                <ul class="list-group" <?php echo ($result['jobAssignStatus'] == 1 ? '' : ($result['jobAssignStatus'] == 2 ? 'onclick="inProgressData()"': '')); ?> >
                   <li class="list-group-item" style="color: #fff;text-align: center;font-size: 25px;padding: 5px;background:<?php echo ($result['jobAssignStatus'] == 1 ? '#634723' : ($result['jobAssignStatus'] == 2 ? '#655f583d': '')); ?>;cursor: pointer;">In Progress</li>
               </ul>
               <ul class="list-group" <?php echo ($result['jobAssignStatus'] == 1 ? 'onclick="ReadyFunction()"' : ($result['jobAssignStatus'] == 2 ? '': '')); ?> >
                   <li class="list-group-item"  style="color:#fff;text-align: center;font-size: 25px;padding: 5px;background: <?php echo ($result['jobAssignStatus'] == 1 ? '#8bf578a6' : ($result['jobAssignStatus'] == 2 ? '#22e200a6': '')); ?>;cursor: pointer;">READY</li>
               </ul>
           <!-- /.box-footer -->
            <!--  -->
          </div>
           <!-- Close Here -->
        </div>
           <!-- Start PDF Show -->
           <div class="col-xs-8" style="width: 75%;">
                <ul class="list-group">
                <li class="list-group-item" style="color: #928f8a;">Job View
                  <span class="badge"><a href="<?php echo (!empty($result['pdf_url']) ? base_url('uploads/pdf/'.$result['pdf_url']) : '#'); ?>" download><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download</a></span>
                </li>
                <?php if(!empty($result['pdf_url'])): ?>
                <embed src="<?php echo base_url('uploads/pdf/'.$result['pdf_url']); ?>#toolbar=0&amp;navpanes=0&amp;scrollbar=0" type="application/pdf" width="100%" height="1090px">
                  <?php else: echo '<center><img src="'.base_url('uploads/data-not-found.svg').'"></center>'; endif; ?>
                </ul>
           </div>
           <!-- Close PDF -->
      </div>


        <!-- Close Here -->
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Details</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-body -->
              <form class="form-horizontal" method="post" action="<?php echo base_url('add-projects-post'); ?>"  enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Company Name:</label>
                  <div class="col-sm-10">
                   <input type="text"  readonly class="form-control" value="<?php echo (!empty(set_value('name')) ? set_value('name') : (!empty($result['companyName']) ? $result['companyName'] : ''  ) ); ?>" name="name"  placeholder="Please enter project name">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Project Name:</label>
                  <div class="col-sm-10">
                    <input type="text"  readonly class="form-control" value="<?php echo (!empty(set_value('name')) ? set_value('name') : (!empty($result['project_name']) ? $result['project_name'] : ''  ) ); ?>" name="name"  placeholder="Please enter project name">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Project Number:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  readonly name="number" placeholder="Please enter project number"  value="<?php echo (!empty(set_value('number')) ? set_value('number') : (!empty($result['projetc_number']) ? $result['projetc_number'] : ''  ) ); ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Address:</label>
                  <div class="col-sm-10">
                      <textarea name="address"  readonly class="form-control" placeholder="Enter address"><?php echo (!empty(set_value('address')) ? set_value('address') : (!empty($result['address']) ? $result['address'] : ''  ) ); ?></textarea>
                  </div>
                </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Job Name:</label>
                  <div class="col-sm-10">
                    <input type="text"  readonly class="form-control" value="<?php echo (!empty(set_value('name')) ? set_value('name') : (!empty($result['job_name']) ? $result['job_name'] : ''  ) ); ?>" name="name"  placeholder="Please enter project name">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Job Name:</label>
                  <div class="col-sm-10">
                    <?php echo (!empty($result['pdf_url']) ? '<a href="'.base_url('uploads/pdf/'.$result['pdf_url']).'" target="_blank">View Job</a>' : ''); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Job Status:</label>
                  <div class="col-sm-10">
                      <select class="form-control" name="jobStatus" id="jobStatusChange">
                        <option value="">Change Job Status</option>
                        <option value="1" <?php echo ($result['jobAssignStatus'] == 1 ? 'selected':''); ?> >IN PROGRESS</option>
                        <option value="2" <?php echo ($result['jobAssignStatus'] == 2 ? 'selected':''); ?> >READY</option>
                <!--         <option value="3" <?php echo ($result['jobAssignStatus'] == 3 ? 'selected':''); ?> >PICKED </option> -->
                      </select>
                  </div>
                </div>
                <div class="form-group" >
                  <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" id="saveData" class="btn btn-info">Save</button>
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
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    // $('#saveData').click(function(){
    //     var jobStatusChange  = $('#jobStatusChange').val();
    //      var getId            = '<?php echo $result['id']; ?>';
    //      if(jobStatusChange.length == 0){
    //          alert('Please select any option');
    //          return false;
    //      }
    //      $.post('<?php echo base_url('admin/Factory/changeJobsStatus'); ?>',{getId:getId,status:jobStatusChange},function(res){
    //        window.location.href = "<?php echo base_url('factory-job-list'); ?>";
    //    });
    // });
    function ReadyFunction(){
      var getId            = '<?php echo $result['id']; ?>';
       $.post('<?php echo base_url('admin/Factory/changeJobsStatus'); ?>',{getId:getId,status:2},function(res){
           window.location.href = "<?php echo base_url('factory-job-list'); ?>";
       });
    }
    function inProgressData(){
      var getId            = '<?php echo $result['id']; ?>';
       $.post('<?php echo base_url('admin/Factory/changeJobsStatus'); ?>',{getId:getId,status:1},function(res){
           window.location.href = "<?php echo base_url('factory-job-list'); ?>";
       });
    }
  </script>