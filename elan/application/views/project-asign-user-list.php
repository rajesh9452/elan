<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span#addNew {
    position: absolute;
    right: 22px;cursor: pointer;    z-index: 9;
}</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Assign
        <small>user List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('manage-users'); ?>">Assign user</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Assign user</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php $message = $this->session->flashdata('message'); echo (!empty($message) ? $this->session->flashdata('message') :''); ?>
            <!-- /.box-body -->
            
             <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
             <!--  <div class="row">
              <div class="col-sm-12"> -->
              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending">S.No</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Number</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Email</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Add Date</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width:254px;" aria-label="Engine version: activate to sort column ascending">Action</th></tr>
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
                        <td>'.$list->email.'</td>
                        <td>'.date('d-M-Y',$list->addDate).'</td>
                        <td><button type="button" onclick="addUsers('.$list->id.')" class="btn btn-info btn-sm" >Add</button></td>
                         </tr>';  $count++;
                   endforeach; 
                 ?>
                </tbody>
              </table>
            <!-- </div></div> -->
            </div>
            <!-- /.box-body --> 
              </div>
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
  <script type="text/javascript">
    function addUsers(checkbox){
        var getId = checkbox;
        var projetcID = '<?php echo $projetcID; ?>';
        $.post('<?php echo base_url("admin/welcome/addProjectAssignUsers");?>',{getId:getId,projetcID:projetcID},function(res){
          alert('User has been add successfully');
          location.reload();
        });
    }
  </script>