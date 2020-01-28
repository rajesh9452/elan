<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span#addNew {
    position: absolute;
    right: 22px;cursor: pointer;    z-index: 9;
}span#addNew1 {
    position: absolute;
    right: 62px;
    cursor: pointer;
    z-index: 9;
}</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Project List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('manage-projects-list'); ?>">Manage Project</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Project</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php $message = $this->session->flashdata('message'); echo (!empty($message) ? $this->session->flashdata('message') :''); ?>

                <form style="position: absolute;right: 126px;top: 58px;z-index:999;" class="form-inline" action="<?php echo base_url('manage-projects-list'); ?>" method="GET" >
                  <div class="form-group">
                       <select class="form-control" name="filter">
                         <option value="" hidden="">Select</option>
                         <option value="3"   <?php echo (!empty($search) && $search['filter'] == 3 ? 'selected':''); ?> >All</option>
                         <option value="1" <?php echo (!empty($search) && $search['filter'] == 1 ? 'selected':''); ?> >In Progress</option>
                         <option value="2"  <?php echo (!empty($search) && $search['filter'] == 2 ? 'selected':''); ?> >Completed</option>
                       </select>
                  </div>
                  <button type="submit" class="btn btn-info">Search</button>
                </form>
            </div>
            <!-- /.box-body -->
             
            <a href="<?php echo base_url('add-projects'); ?>"> <span class="btn btn-info" id="addNew"><i class="fa fa-plus" aria-hidden="true"></i></span></a>
             <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
             <!--  <div class="row">
              <div class="col-sm-12"> -->
              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">S.No</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Project Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Project Number</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Total Jobs</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Total Users</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Add Date</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:180px;" aria-label="Engine version: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:250px;" aria-label="CSS grade: activate to sort column ascending">Action</th></tr>
                </thead>
                <!-- <i class="fa fa-check-square-o" aria-hidden="true"></i> -->
                <tbody id="changeStatusID">   
                <!--'.base_url('project-asign-user-list/'.base64_encode($list->id)).'-->
                 <?php
                   $count = 1;
                   foreach($result as $list):
                    echo '<tr> 
                        <td>'.$count.'</td>
                        <td><a href="'.base_url('project-view/'.base64_encode($list->id)).'">'.ucfirst($list->project_name).'</a></td>
                        <td>'.$list->projetc_number.'</td>
                        <td><a href="'.base_url('jobs-list/'.base64_encode($list->id)).'">'.$list->totalJobs.'</a></td>
                        <td><a href="'.base_url('project-assign-user-list/'.base64_encode($list->id)).'">'.$list->totalUsers.'</a></td>
                        <td>'.date('d-M-Y',$list->add_date).'</td>
                        <td><span class="label label-'.($list->projectStatus == 1 ? 'warning':'success').'  label-xs">'.($list->projectStatus == 1 ? 'In Progress':'Completed').'</span></td>
                        <td>';
                        if($list->status == 1):
                       echo  '<a href="javascript:deactivateUsers('.$list->id.')" id="idS'.$list->id.'" getId="'.base64_encode($list->id).'"  class="btn btn-success btn-xs">Active</a>';
                       else:
                        echo  '<a href="javascript:ActivateUsers('.$list->id.')" id="idS'.$list->id.'" getId="'.base64_encode($list->id).'" class="btn btn-danger  btn-xs">Deactive</a>';
                       endif;
                        echo '&nbsp;&nbsp;<span class="deleteShow"><a href="javascript:deleteUsers('.$list->id.')"  id="id'.$list->id.'" getId="'.base64_encode($list->id).'" class="btn btn-danger  btn-xs" ><i class="fa fa-trash" aria-hidden="true"></i></a></span>&nbsp;&nbsp;<span> <a href="'.base_url('project-gallery-view/'.base64_encode($list->id)).'" class="btn btn-warning  btn-xs" >Gallery</a></span>
                         </td>
                         </tr>';  $count++;
                   endforeach; 
                 ?>
                 <!-- <span class="deleteShow"><a href="'.base_url('user-account-delete/'.base64_encode($list->id)).'"><i class="fa fa-trash" aria-hidden="true"></i></a></span> -->
                 <!-- <a href="'.base_url('project-view/'.base64_encode($list->id)).'" class="btn btn-info  btn-xs" >View</a> -->
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
  <!-- /.content-wrapper-->
      <!-- /.content-wrapper -->
  <script type="text/javascript">
     function deleteUsers(get) {
        var argument = $('#id'+get).attr('getId');
        var r = confirm("Are you sure you want to delete this record.");
        if (r == true) {
          window.location.href = '<?php echo base_url('projects-delete'); ?>/'+argument;
        }
    }
    function ActivateUsers(get) {
        var argument = $('#idS'+get).attr('getId');
        var r = confirm("Are you sure you want to activate this record.");
        if (r == true) {
          window.location.href = '<?php echo base_url('activate-projects'); ?>/'+argument;
        }
    }
    function deactivateUsers(get) {
        var argument = $('#idS'+get).attr('getId');
        var r = confirm("Are you sure you want to deactivate this record.");
        if (r == true) {
          window.location.href = '<?php echo base_url('deactivate-projects'); ?>/'+argument;
        }
    }
  </script>