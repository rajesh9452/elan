<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span#addNew {
    position: absolute;
    right: 22px;cursor: pointer;    z-index: 9;
}</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Factory List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('manage-factory-list'); ?>">Manage Factory</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Factory</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php $message = $this->session->flashdata('message'); echo (!empty($message) ? $this->session->flashdata('message') :''); ?>
            </div>
            <!-- /.box-body -->
            <a href="<?php echo base_url('add-new-factory'); ?>"> <span class="btn btn-info" id="addNew"><i class="fa fa-plus" aria-hidden="true"></i></span></a>
             <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
             <!--  <div class="row">
              <div class="col-sm-12"> -->
              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">S.No</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Number</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Email</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Address</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Add Date</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:170px;" aria-label="CSS grade: activate to sort column ascending">Action</th></tr>
                </thead>
                <!-- <i class="fa fa-check-square-o" aria-hidden="true"></i> -->
                <tbody id="changeStatusID">   
                 <?php
                   $count = 1;
                   foreach($result as $list):
                    echo '<tr> 
                        <td>'.$count.'</td>
                        <td><a href="'.base_url('add-new-factory/'.base64_encode($list->id)).'">'.ucfirst($list->name).'</a></td>
                        <td>'.$list->mobile.'</td>
                        <td>'.$list->email.'</td>
                        <td>'.$list->address.'</td>
                        <td>'.date('d-M-Y',$list->add_date).'</td>
                        <td>';
                        if($list->status == 1):
                       echo  '<a href="javascript:deactivateUsers('.$list->id.')"  id="idS'.$list->id.'" getId="'.base64_encode($list->id).'"  class="btn btn-success">Active</a>';
                       else:
                        echo  '<a href="javascript:ActivateUsers('.$list->id.')" class="btn btn-danger"  id="idS'.$list->id.'" getId="'.base64_encode($list->id).'"  >Deactive</a>';
                       endif;
                        echo '&nbsp;&nbsp;<span class="deleteShow"><a href="javascript:deleteUsers('.$list->id.')" class="btn btn-danger" id="id'.$list->id.'" getId="'.base64_encode($list->id).'" ><i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
                         </tr>';  $count++;
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
  <!-- /.content-wrapper -->
  <script type="text/javascript">
     function deleteUsers(get) {
        var argument = $('#id'+get).attr('getId');
        var r = confirm("Are you sure you want to delete this record.");
        if (r == true) {
          window.location.href = '<?php echo base_url('factory-account-delete'); ?>/'+argument;
        }
    }
    function ActivateUsers(get) {
        var argument = $('#idS'+get).attr('getId');
        var r = confirm("Are you sure you want to activate this record.");
        if (r == true) {
          window.location.href = '<?php echo base_url('activate-factoryAccount'); ?>/'+argument;
        }
    }
    function deactivateUsers(get) {
        var argument = $('#idS'+get).attr('getId');
        var r = confirm("Are you sure you want to deactivate this record.");
        if (r == true) {
          window.location.href = '<?php echo base_url('deactivate-factoryAccount'); ?>/'+argument;
        }
    }
  </script>