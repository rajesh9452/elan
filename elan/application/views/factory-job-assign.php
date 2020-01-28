<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span.activateShow a {font-size: 19px;color: green;}span.deleteShow a {font-size: 19px;color: red;}img.img-thumbnail {width: 225px;}</style>
    <style type="text/css">.well{padding: 10px;}span>p {
    color: red;
    margin: 0px;
}
.list-group-item {
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
}
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="color: #95999e;">Project Job Details</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="">Project Job</a></li>
        <li class="active">Details</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- Start  -->
        <div class="col-xs-12">
          <div class="col-xs-3" style="padding: 0px;">
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
                        <?php echo ($result['job_status'] == 1 ? 'IN PROGRESS' : ($result['job_status'] == 2 ? 'APPROVE': ($result['job_status'] == 3 ? 'DISAPPROVE': ($result['job_status'] == 4 ? 'COMPLETED':'')))); ?>
                 </span></li>
            </ul>
           <!-- /.box-footer -->
             </div>
            <!--  -->
          </div>
          <?php if(!empty($result['delivery_date'])): ?>
          <h3 style="color: #a6aaad;">Job Status</h3>
          <div class="col-xs-12"  style="padding: 0px;">
            <!--  -->
                <ul class="list-group"  <?php echo ($result['job_status'] == 1 ? '' : 'onclick="inProgressStatus()"'); ?> >
                   <li class="list-group-item" style="color: #fff;text-align: center;font-size: 25px;padding: 5px;background:<?php echo ($result['job_status'] == 1 ? '#403931' : '#a29e998a'); ?>;cursor: pointer;">In Progress</li>
               </ul>
               <ul class="list-group" <?php echo ($result['job_status'] == 2 ? '' : 'onclick="approvedStatus()"'); ?> >
                   <li class="list-group-item"  style="color:#fff;text-align: center;font-size: 25px;padding: 5px;background:<?php echo ($result['job_status'] == 2 ? '#8bf578a6' : '#a29e998a'); ?>;cursor: pointer;" disabled >Approved</li>
               </ul>
               <ul class="list-group" <?php echo ($result['job_status'] == 3 ? '' : 'onclick="rejectedStatus()"'); ?> >
                   <li class="list-group-item"  style="color:#fff;text-align: center;font-size: 25px;padding: 5px;background:<?php echo ($result['job_status'] == 3 ? '#efa17c' : '#a29e998a'); ?>;cursor: pointer;">Rejected</li>
               </ul>
               <ul class="list-group" <?php echo ($result['job_status'] == 4 ? '' : 'onclick="completedStatus()"'); ?> >
                   <li class="list-group-item"  style="color:#ffffff;text-align: center;font-size: 25px;padding: 5px;background:<?php echo ($result['job_status'] ==4 ? '#ecb36f' : '#a29e998a'); ?>;cursor: pointer;">Completed</li>
               </ul>
           <!-- /.box-footer -->
            <!--  -->
          </div>
           <?php endif; ?>
          <!--  -->
          <!--  -->
       </div>
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
        </div>
        <!-- End -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assign Factory</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="post"  enctype="multipart/form-data">
                <div class="form-group" id="Assign">
                  <!-- <label class="control-label col-sm-2" for="email">Job Assign Factory:</label> -->
                  <div class="col-sm-12">
                      <select class="form-control" name="jobAssignFactory" id="jobAssignFactory">
                        <option value="">Select Factory</option>
                        <?php
                          foreach($factory as $list):
                            echo '<option value="'.$list['id'].'" '.(!empty($result['factory_id']) && $result['factory_id'] == $list['id'] ? 'selected':'').'>'.ucfirst($list['name']).'</option>';
                          endforeach; 
                         ?>
                      </select>
                  </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="saveData" class="btn btn-info">Save</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  <script type="text/javascript">
    $('#saveData').click(function(){
        var getId = '<?php echo $result['id']; ?>';
        var jobStatusChange  = 2;
        var jobAssignFactory = $('#jobAssignFactory').val();
         if(jobStatusChange == 2 && jobAssignFactory.length == 0){
             alert('Please select factory name');
             return false;
         }
        $.post('<?php echo base_url('admin/welcome/changeJobsStatus'); ?>',{getId:getId,status:jobStatusChange,jobAssignFactory:jobAssignFactory},function(res){
         window.location.href = "<?php echo base_url('factory-assign-job/'.$result['id']); ?>";
       });
    });
    function inProgressStatus(){
       var getId = '<?php echo $result['id']; ?>';
       var jobStatusChange = 1;
       var jobAssignFactory = $('#jobAssignFactory').val();
      $.post('<?php echo base_url('admin/welcome/changeJobsStatus'); ?>',{getId:getId,status:jobStatusChange,jobAssignFactory:jobAssignFactory},function(res){
          window.location.href = "<?php echo base_url('factory-assign-job/'.$result['id']); ?>";
       });
    }
    function approvedStatus(){
       $('#myModal').modal('show');
    }
    function rejectedStatus(){
       var getId = '<?php echo $result['id']; ?>';
       var jobStatusChange = 3;
       var jobAssignFactory = $('#jobAssignFactory').val();
      $.post('<?php echo base_url('admin/welcome/changeJobsStatus'); ?>',{getId:getId,status:jobStatusChange,jobAssignFactory:jobAssignFactory},function(res){
          window.location.href = "<?php echo base_url('factory-assign-job/'.$result['id']); ?>";
       });
    }
    function completedStatus(){
       var getId = '<?php echo $result['id']; ?>';
       var jobStatusChange = 4;
       var jobAssignFactory = $('#jobAssignFactory').val();
      $.post('<?php echo base_url('admin/welcome/changeJobsStatus'); ?>',{getId:getId,status:jobStatusChange,jobAssignFactory:jobAssignFactory},function(res){
          window.location.href = "<?php echo base_url('factory-assign-job/'.$result['id']); ?>";
       });
    }
  </script>