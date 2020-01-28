  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo @$totalProjects; ?></h3>
              <p> Total Projects</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks" aria-hidden="true"></i> 
            </div>
            <a href="<?= base_url('manage-projects-list');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo @$totalJobs; ?><sup style="font-size: 20px"></sup></h3>
              <p>Total Jobs</p>
            </div>
            <div class="icon">
              <i class="fa fa-quora" aria-hidden="true"></i> 
            </div>
            <a href="<?= base_url('manage-projects-list');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo @$totalUsers; ?><sup style="font-size: 20px"></sup></h3>
              <p>Total Users</p>
            </div>
            <div class="icon">
             <i class="fa fa-user" aria-hidden="true"></i> 
            </div>
            <a href="<?= base_url('manage-users');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->

        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Jobs</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Project Name</th>
                    <th>Project Number</th>
                    <th>Job Name</th>
                    <th>View PDF</th>
                    <th>Job Status</th>
                    <th>Job Type</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                    <tbody id="setHtml">
                    </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="<?php echo base_url('manage-projects-list'); ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Project</a>
            </div>
            <!-- /.box-footer -->
          </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
    var lastMessageDate = '';
    $(document).ready(function(){
        responseData();
        responseLiveData();
    });
    function responseData(){
       $.post("<?php echo base_url('admin/welcome/getDashboardLiveData'); ?>",function(res){
          var response = JSON.parse(res);
            if(response.status == 201){
               $('#setHtml').html(response.result);
               lastMessageDate = response.lastMessage;
            }
       });
    }

    function responseLiveData() {
       if(lastMessageDate.length != 0){
          $.post("<?php echo base_url('admin/welcome/getDashboardLiveData'); ?>",{lastMessageDate:lastMessageDate},function(res){
            var response = JSON.parse(res);
              if(response.status == 201){
                 $('#setHtml').prepend(response.result);
                 lastMessageDate = response.lastMessage;
             }
         });
       }
      setTimeout(function(){responseLiveData(); },3000);
   }
  </script>
  <!-- /.content-wrapper setHtml -->