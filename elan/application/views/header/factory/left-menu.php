<!-- Left side column. contains the logo and sidebar -->
<?php $adminData = $this->session->userdata('factoryData'); ?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('uploads/'.(!empty($adminData['profile']) ? $adminData['profile'] :'logo.png')); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="font-size: 11px;"><?= ucfirst($adminData['name']);?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php echo ($pageIndex == 'dashboard' ? 'active' : '');  ?>">
          <a href="<?php echo base_url('factory-dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="<?php echo ($pageIndex == 'jobList' ? 'active' : '');  ?>">
          <a href="<?php echo base_url('factory-job-list'); ?>">
            <i class="fa fa-tasks" aria-hidden="true"></i> <span>Manage Jobs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>