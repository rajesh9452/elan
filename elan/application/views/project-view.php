<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span.activateShow a {font-size: 19px;color: green;}
  /*span.deleteShow a {font-size: 19px;color: red;}*/
img.img-thumbnail {width: 225px;}</style>
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
      <h1>
        Project Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="javascript:deleteUsersProject(<?php echo $result['id']; ?>)"  id="id<?php echo $result['id']; ?>" getId="<?php echo base64_encode($result['id']); ?>"><span style="border: 2px solid #ea0d0d;
    padding: 3px;color: #ea0d0d;">Project Delete</span></a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php echo base_url('project-gallery-view/'.base64_encode($result['id'])); ?>"><span style="border: 2px solid #afc118;
    padding: 3px;color:#afc118;">Gallery</span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
       <!-- <li></li> -->
         <!-- <li class="active">&nbsp;&nbsp;&nbsp;</li> project-gallery-view-->
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
             <!-- New -->
        <div class="col-xs-12">
           <?php $message = $this->session->flashdata('message'); echo (!empty($message) ? $this->session->flashdata('message') :''); ?>
         <div class="col-xs-3" style="padding: 0px;">
          <!-- New -->
              <div class="box">
              <!-- /.box-header -->
              <ul class="list-group">
                <li class="list-group-item" style="color: #928f8a;">Details 
                  <span style="font-size: 22px;" class="badge">
                      <a href="<?php echo base_url('update-projects-post/'.base64_encode($result['id'])); ?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </a>
                  </span>
                </li>
              <li class="list-group-item" style="color: #928f8a;"><span style="background-color: #d3e8e8;padding: 5px;border-radius: 50%;color: #38a0fb;"><i class="fa fa-user-plus" aria-hidden="true"></i></span> Project Name<span class="badge"><?php echo (!empty(set_value('name')) ? set_value('name') : (!empty($result['project_name']) ? $result['project_name'] : ''  ) ); ?></span></li>
              <li class="list-group-item"  style="color: #928f8a;"><span style="background-color:#c4ffd6;padding: 5px;border-radius: 50%;color:#28dc57;"><i class="fa fa-refresh" aria-hidden="true"></i></span> Project Number<span class="badge"><?php echo (!empty(set_value('number')) ? set_value('number') : (!empty($result['projetc_number']) ? $result['projetc_number'] : ''  ) ); ?></span></li>
               <li class="list-group-item"  style="color: #928f8a;"><span style="background-color:#e6e6e6;padding: 5px;border-radius: 50%;color:#c8ccd0;"><i class="fa fa-clock-o" aria-hidden="true"></i></span> Company Name<span class="badge" style="font-weight: bold;">
                  <?php foreach($companyResult as $val){
                      echo (!empty($result['company_id']) && $result['company_id'] == $val['id'] ? $val['name'] : '' );
                    }
                   ?>
               </span></li>
                <li class="list-group-item"  style="color: #928f8a;"><span style="background-color:#f1e08f;padding: 5px;border-radius: 50%;color:#ef7933;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span> Address &nbsp;&nbsp; 
                  <div style="overflow-wrap: break-word;float: right;font-weight: bold;" ><?php echo (!empty(set_value('address')) ? set_value('address') : (!empty($result['address']) ? (strlen($result['address']) > 17 ? substr($result['address'], 0,17).'...' : $result['address']) : ''  ) ); ?></div>

                </li>
                 <li class="list-group-item"  style="color: #928f8a;"><span style="background-color:#ffe1cc;padding: 5px;border-radius: 50%;color:#e82727;"><i class="fa fa-times-circle" aria-hidden="true"></i></span> Status<span class="badge"><?php echo  ($result['projectStatus'] == 1 ? 'In Progress':'Completed'); ?></span></li>
            </ul>
           <!-- /.box-footer -->
             </div>
          <!-- Old  -->
             </div>
              <div class="col-xs-6" >
                 <style type="text/css">
                  .bg {
                  /* The image used */
                  background-image: url('<?php echo (!empty($result['projectImage']) ? base_url('uploads/project/'.$result['projectImage']) : ''); ?>');
                  /* Full height */
                  height: 100%; 
                  /* Center and scale the image nicely */
                  background-position: center;
                  background-repeat: no-repeat;
                  background-size: cover;
                }
                 </style>
               <!-- New -->
                <div class="box bg" style="height: 369px;">
            <!-- /.box-body -->

            <!-- /.box-footer -->
                 </div>
               <!-- Old  -->
             </div>
              <div class="col-xs-3" style="padding: 0px;">
                <!-- New -->
               <div class="box">
            <!-- /.box-header -->
              <ul class="list-group" style="height: 366px; overflow-y: scroll;white-space: nowrap; ">
                <li class="list-group-item" style="color: #928f8a;">Project Files <span style="font-size: 27px;
    line-height: 0;" class="badge"><a href="<?php echo base_url('update-projects-post/'.base64_encode($result['id'])); ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></span></li>
               <?php
                  if(!empty($document)){
                      foreach($document as $list){
                        echo '<span id="get'.$list['id'].'"><li class="list-group-item" style="color: #928f8a;"><a href="'.base_url('uploads/document/'.$list['project_url']).'" target="_blank"><img style=" width: 19px;" src="'.base_url('uploads/pdf.png').'">'. (strlen($list['project_url']) > 20 ? substr($list['project_url'], 0,20) :$list['project_url'] ) .'</a> <span  onclick="deleteFile('.$list['id'].')"  style="font-size: 25px;line-height: 0;color: #ef4c0d;cursor: pointer;" class="badge"><i class="fa fa-trash" aria-hidden="true"></i></span></li></span>';
                      }
                  } 
              ?>
              <!--  -->
              <!--  -->
            </ul>
            <!-- /.box-body -->
          </div>
                <!-- Old  -->
             </div>

             </div>
             <!-- Old -->

        <h1 style="padding-left: 22px;font-size: 25px;color: #9a9a9a;">Recent Jobs</h1>
        <!-- Job list show here -->
        <div class="col-xs-12">
        <div class="col-xs-9" style="padding-left: 0px;">
            <div class="box">
               <!-- Open -->
            <ul class="list-group" style="height:357px">
                <li class="list-group-item" style="color: #928f8a;padding: 8px;text-align: right;"><a href="<?php echo base_url('jobs-list/'.base64_encode($result['id'])); ?>"><span style="border: 2px solid #0aa0ce;
    padding-top: 3px;
    padding-bottom: 3px;
    padding-right: 15px;
    padding-left: 15px;color: #0aa0ce;cursor: pointer;">See All</span></a></li>
                <!-- <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> -->
             <!--  <div class="row">
              <div class="col-sm-12"> -->
              <table  class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row"><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;color: #717477;" aria-label="Browser: activate to sort column ascending">Job Name</th><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;color: #717477;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">View PDF</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;color: #717477;" aria-label="Engine version: activate to sort column ascending">Add Date</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;color: #717477;" aria-label="Engine version: activate to sort column ascending">Job Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;color: #717477;" aria-label="Engine version: activate to sort column ascending">Factory Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:170px;color: #717477;" aria-label="CSS grade: activate to sort column ascending">Action</th></tr>
                </thead>
                <!-- <i class="fa fa-check-square-o" aria-hidden="true"></i> ($list->job_status == 1 ? 'NEW' :'SEEN') -->
                <tbody id="changeStatusID">   
                 <?php
                   foreach($jobList as $list):
                    echo '<tr> 
                        <td><a href="'.base_url('factory-assign-job/'.$list->id).'">'.ucfirst($list->job_name).'</a>&nbsp;&nbsp;'.($list->status_seen == 1 ? '<span class="label label-warning  " >NEW</span>' :'').'</td>
                        <td>'.(!empty($list->pdf_url) ? '<a href="'.base_url('uploads/pdf/'.$list->pdf_url).'" target="_blank">View Job</a>' : '').'</td>
                        <td>'.date('d-M-Y',$list->add_date).'</td>
                        <td><span class="label label-'.($list->job_status== 1 ? 'warning' : ($list->job_status== 2 ? 'info' : ($list->job_status== 3 ? 'danger':'success') )  ).' ">'.($list->job_status== 1 ? 'IN PROGRESS' : ($list->job_status== 2 ? 'APPROVED' : ($list->job_status == 3 ? 'DISAPPROVE':'COMPLETED') )  ).'</span></td>
                        
                        <td><span class="label label-'.($list->assignJobStatus == 1 ? ($list->job_status == 4 ? 'success' : 'warning')  : ($list->assignJobStatus== 2 ? 'success' : ($list->job_status == 4 ? 'success' : 'warning')  )  ).' ">'.($list->assignJobStatus == 1 ? ($list->job_status == 4 ? 'COMPLETED' : 'IN PROGRESS')  : ($list->assignJobStatus == 2 ? 'READY' : ($list->job_status == 4 ? 'COMPLETED' : 'IN PROGRESS') )  ).'</span></td>
                        
                        <td>';
                        if($list->status == 1):
                         echo  '<a href="javascript:deactivateUsers('.$list->id.')"  id="idS'.$list->id.'" getId="'.base64_encode($list->id).'"  class="btn btn-success btn-xs">Active</a>';
                       else:
                        echo  '<a href="javascript:ActivateUsers('.$list->id.')" class="btn btn-danger  btn-xs"  id="idS'.$list->id.'" getId="'.base64_encode($list->id).'"  >Deactive</a>';
                       endif; 
                        echo '&nbsp;&nbsp;<span class="deleteShow"><a href="javascript:deleteUsers('.$list->id.')" class="btn btn-danger btn-xs" id="id'.$list->id.'" getId="'.base64_encode($list->id).'" ><i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
                         </tr>';
                   endforeach; 
                 ?>
                </tbody>
              </table>
              </ul>
            <!-- </div></div> -->
            <!-- </div> -->
               <!-- Close -->
            </div>
        </div>
        <div class="col-xs-3" style="padding: 0px;">
          <div class="box">
                <ul class="list-group" style="height:357px; overflow-y:scroll;">
                  <li class="list-group-item" style="color: #928f8a;padding:11px;">User<span style="font-size: 27px;line-height: 0;margin-top: -5px;" class="badge"><a target="_blank" href="<?php echo base_url('assign-project-list/'.base64_encode($result['id'])); ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></span></li>
                  <!-- Start here -->
                  <?php foreach($users as $getlist): ?>
                <div class="col-xs-12" style="border-bottom: 1px solid #ded7d7;">
                  <div class="col-xs-3" style="padding: 4px;">
                      <img  width="304" height="236" class="img-responsive img-circle" src="<?php echo base_url().'uploads/'.(!empty($getlist->profile) ? $getlist->profile :'user.png'); ?>">
                  </div>
                  <div class="col-xs-9"  style="padding: 4px;padding-right: 0px;">
                    <p style="margin: 0 0 0px;color: #707575;font-weight: bold;cursor: pointer;"><?php echo ucfirst($getlist->name); ?> 
                    <a href="javascript:deleteUsersAssign(<?php echo $getlist->assign_id; ?>)" id="id<?php echo $getlist->assign_id; ?>" getId="<?php echo base64_encode($getlist->assign_id); ?>" >
                      <span style="float: right;cursor: pointer;">
                        <i class="fa fa-close" aria-hidden="true"></i>
                      </span></a>
                      &nbsp;&nbsp;
                      <a style="color: #7b7f82;" target="_blank" href="<?php echo base_url('add-new-users/'.base64_encode($getlist->userid)); ?>">
                      <span style="float: right;padding-right: 7px;cursor: pointer;">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                      </span></a>

                    </p>
                    <p style="margin: 0 0 0px;color: #707575;"><?php echo $getlist->email; ?> </p>
                    <p style="margin: 0 0 0px;color: #707575;">Mobile: <?php echo $getlist->mobileNumber; ?> </p>
                  </div>
                </div>
                <div class="col-xs-12" style="border-bottom: 1px solid #ded7d7;">
                  <p style="margin: 0px;padding: 2px;text-align: center;color: #9e9b96;">Total Jobs-<?php echo count($this->login->getTotalJobs($getlist->userid)); ?></p>
                </div>
                <!-- Close here -->
              <?php endforeach; ?>
              </ul>
            </div>
        </div>
      </div>
     <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
  var projectID = '<?php echo $result['id']; ?>';
   function deleteUsers(get) {
      var argument = $('#id'+get).attr('getId');
      var r = confirm("Are you sure you want to delete this record.");
      if (r == true) {
        window.location.href = '<?php echo base_url('jobs-list-deleted'); ?>/'+argument+'/'+projectID+'/1';
      }
  }
  function ActivateUsers(get) {
      var argument = $('#idS'+get).attr('getId');
      var r = confirm("Are you sure you want to activate this record.");
      if (r == true) {
        window.location.href = '<?php echo base_url('jobs-list-active'); ?>/'+argument+'/'+projectID+'/1';
      }
  }
  function deactivateUsers(get) {
      var argument = $('#idS'+get).attr('getId');
      var r = confirm("Are you sure you want to deactivate this record.");
      if (r == true) {
        window.location.href = '<?php echo base_url('jobs-list-deactive'); ?>/'+argument+'/'+projectID+'/1';
      }
  }
  function deleteFile(argument) {
       if(confirm('Are you sure. You want to delete this pdf file') == true){
          //
          $.post('<?php echo base_url("admin/welcome/deleteProjectPdf"); ?>',{argument:argument},function(res){
             $('#get'+argument).remove();
             alert("Project pdf has been delete successfully");
          });
       }
     
    }
function deleteUsersAssign(get) {
    var argument = $('#id'+get).attr('getId');
    var r = confirm("Are you sure you want to delete this record.");
    if (r == true) {
      window.location.href = '<?php echo base_url('project-list-delete'); ?>/'+argument+'/'+'<?php echo base64_encode($result['id']);?>/1';
    }
}

function deleteUsersProject(get) {
        var argument = $('#id'+get).attr('getId');
        var r = confirm("Are you sure you want to delete this record.");
        if (r == true) {
          window.location.href = '<?php echo base_url('projects-delete'); ?>/'+argument;
        }
    }
</script>