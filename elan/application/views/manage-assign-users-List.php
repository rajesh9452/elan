<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span#addNew {
    position: absolute;
    right: 22px;cursor: pointer;    z-index: 9;
}</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Project Assign List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('manage-users'); ?>">Manage Project Assign</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Project Assign List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php $message = $this->session->flashdata('message'); echo (!empty($message) ? $this->session->flashdata('message') :''); ?>
           
            <!-- /.box-body -->
            <a href="<?php echo base_url('assign-project-list/'.$projetcID); ?>"> <span class="btn btn-success" id="addNew">Assign User</span></a>
             <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
             <!--  <div class="row">
              <div class="col-sm-12"> -->
              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">S.No</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Number</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Project Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Project Number</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:170px;" aria-label="CSS grade: activate to sort column ascending">Action</th></tr>
                </thead>
                <!-- <i class="fa fa-check-square-o" aria-hidden="true"></i> -->
                <tbody id="changeStatusID">   
                 <?php
                   $count = 1;
                   foreach($result as $list):
                    echo '<tr> 
                        <td>'.$count.'</td>
                        <td>'.ucfirst($list->name).'</td>
                        <td>'.$list->mobileNumber.'</td>
                        <td>'.$list->project_name.'</td>
                        <td>'.$list->projetc_number.'</td>
                        <td>';
                        echo '&nbsp;&nbsp;<span class="deleteShow"><a href="javascript:deleteUsers('.$list->assign_id.')" class="btn btn-danger" id="id'.$list->assign_id.'" getId="'.base64_encode($list->assign_id).'" ><i class="fa fa-trash" aria-hidden="true"></i></a></span>
                        </td>
                         </tr>';  $count++;
                   endforeach; 
                 ?>
                </tbody>
              </table>
            <!-- </div></div> -->
            </div>
            <!-- /.box-body --> 
          </div> </div>
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
      window.location.href = '<?php echo base_url('project-list-delete'); ?>/'+argument+'/'+'<?php echo $projetcID;?>';
    }
}
</script>