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
        <li><a href="<?php echo base_url('factory-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('factory-job-list'); ?>">Manage Jobs</a></li>
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
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">S.No</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Project Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Project Number</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Job Name</th><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">View PDF</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Add Date</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:170px;" aria-label="CSS grade: activate to sort column ascending">Action</th></tr>
                </thead>
                <!-- <i class="fa fa-check-square-o" aria-hidden="true"></i> -->
                <tbody id="changeStatusID">   
                 <?php
                   $count = 1;
                   foreach($result as $list):
                     echo '<tr> 
                        <td>'.$count.'</td>
                        <td>'.ucfirst($list['project_name']).'&nbsp;&nbsp;'.($list['job_seen_status'] == 1 ? '<span class="label label-info ">New</span>' :'').'</td>
                        <td>'.ucfirst($list['projetc_number']).'</td>
                        <td>'.ucfirst($list['job_name']).'</td>
                        <td>'.(!empty($list['pdf_url']) ? '<a href="'.base_url('uploads/pdf/'.$list['pdf_url']).'" target="_blank">View Job</a>' : '').'</td>
                         <td>'.date('d-M-Y',$list['add_date']).'</td>
                         <td><span class="label label-'.($list['job_status'] == 1 ? 'warning' : ($list['job_status'] == 2 ? 'info' : 'success' )  ).' ">'.($list['job_status'] == 1 ? 'IN PROGRESS' : ($list['job_status'] == 2 ? 'READY' : 'PICKED') ).'</span></td>
                         <td><a href="'.base_url('factory-job-view/'.$list['job_id']).'"><span class="btn btn-info btn-sm">View</span></a></td>
                        </tr>';
                          $count++;
                   endforeach; 
                 ?>
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
