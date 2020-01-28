<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span#addNew {
    position: absolute;
    right: 22px;cursor: pointer;    z-index: 9;
}</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Jobs List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('manage-projects-list'); ?>">Manage Jobs</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Jobs</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php $message = $this->session->flashdata('message'); echo (!empty($message) ? $this->session->flashdata('message') :''); ?>
            </div>
            <!-- /.box-body -->
           <!--  <a href="<?php //echo base_url('add-new-users'); ?>"> <span class="btn btn-info" id="addNew"><i class="fa fa-plus" aria-hidden="true"></i></span></a> -->
             <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
             <!--  <div class="row">
              <div class="col-sm-12"> -->
              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">S.No</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Job Name</th><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">View PDF</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Add Date</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Job Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Factory Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:170px;" aria-label="CSS grade: activate to sort column ascending">Action</th></tr>
                </thead>
                <!-- <i class="fa fa-check-square-o" aria-hidden="true"></i> ($list->job_status == 1 ? 'NEW' :'SEEN') -->
                <tbody id="changeStatusID">   
                 <?php
                   $count = 1;
                   foreach($result as $list):
                    echo '<tr> 
                        <td>'.$count.'</td>
                        <td><a href="'.base_url('factory-assign-job/'.$list->id).'">'.ucfirst($list->job_name).'</a>&nbsp;&nbsp;'.($list->status_seen == 1 ? '<span class="label label-warning  " >NEW</span>' :'').'</td>
                        <td>'.(!empty($list->pdf_url) ? '<a href="'.base_url('uploads/pdf/'.$list->pdf_url).'" target="_blank">View Job</a>' : '').'</td>
                        <td>'.date('d-M-Y',$list->add_date).'</td>
                        <td><span class="label label-'.($list->job_status== 1 ? 'warning' : ($list->job_status== 2 ? 'info' : ($list->job_status== 3 ? 'danger':'success') )  ).' ">'.($list->job_status== 1 ? 'IN PROGRESS' : ($list->job_status== 2 ? 'APPROVED' : ($list->job_status == 3 ? 'DISAPPROVE':'COMPLETED') )  ).'</span></td>
                        
                        <td><span class="label label-'.($list->assignJobStatus == 1 ? ($list->job_status == 4 ? 'success' : 'warning')  : ($list->assignJobStatus== 2 ? 'success' : ($list->job_status == 4 ? 'success' : 'warning')  )  ).' ">'.($list->assignJobStatus == 1 ? ($list->job_status == 4 ? 'COMPLETED' : 'IN PROGRESS')  : ($list->assignJobStatus == 2 ? 'READY' : ($list->job_status == 4 ? 'COMPLETED' : 'IN PROGRESS') )  ).'</span></td>
                        
                        <td>';
                        if($list->status == 1):
                         echo  '<a href="javascript:deactivateUsers('.$list->id.')"  id="idS'.$list->id.'" getId="'.base64_encode($list->id).'"  class="btn btn-success">Active</a>';
                       else:
                        echo  '<a href="javascript:ActivateUsers('.$list->id.')" class="btn btn-danger"  id="idS'.$list->id.'" getId="'.base64_encode($list->id).'"  >Deactive</a>';
                       endif; 
                        echo '&nbsp;&nbsp;<span class="deleteShow"><a href="javascript:deleteUsers('.$list->id.')" class="btn btn-danger" id="id'.$list->id.'" getId="'.base64_encode($list->id).'" ><i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
                         </tr>';

                          $count++;
                   endforeach; 
                 ?>
                 <!-- <span class="deleteShow"><a href="'.base_url('user-account-delete/'.base64_encode($list->id)).'"><i class="fa fa-trash" aria-hidden="true"></i></a></span> -->
                </tbody>
              </table>
            <!-- </div></div> -->
            </div>
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
  <!-- /.content-wrapper .content-wrapper -->
<script type="text/javascript">
  var projectID = '<?php echo $projectsID; ?>';
   function deleteUsers(get) {
      var argument = $('#id'+get).attr('getId');
      var r = confirm("Are you sure you want to delete this record.");
      if (r == true) {
        window.location.href = '<?php echo base_url('jobs-list-deleted'); ?>/'+argument+'/'+projectID;
      }
  }
  function ActivateUsers(get) {
      var argument = $('#idS'+get).attr('getId');
      var r = confirm("Are you sure you want to activate this record.");
      if (r == true) {
        window.location.href = '<?php echo base_url('jobs-list-active'); ?>/'+argument+'/'+projectID;
      }
  }
  function deactivateUsers(get) {
      var argument = $('#idS'+get).attr('getId');
      var r = confirm("Are you sure you want to deactivate this record.");
      if (r == true) {
        window.location.href = '<?php echo base_url('jobs-list-deactive'); ?>/'+argument+'/'+projectID;
      }
  }
</script>