<!-- Left side column. contains the logo and sidebar -->
<?php $adminData = $this->session->userdata('adminData'); ?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('uploads/'.$adminData['profile']); ?>" class="img-circle" alt="User Image">
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
          <a href="<?php echo base_url('admin-dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="<?php echo ($pageIndex == 'usersList' ? 'active' : '');  ?>">
          <a href="<?php echo base_url('manage-users'); ?>">
            <i class="fa fa-user" aria-hidden="true"></i> <span>Manage Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
         <li class="<?php echo ($pageIndex == 'projects' ? 'active' : '');  ?>">
          <a href="<?php echo base_url('manage-projects-list'); ?>">
           <i class="fa fa-tasks" aria-hidden="true"></i>  <span>Manage Projects</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
         <li class="<?php echo ($pageIndex == 'company' ? 'active' : '');  ?>">
          <a href="<?php echo base_url('manage-company-list'); ?>">
           <i class="fa fa-tasks" aria-hidden="true"></i>  <span>Manage Company</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="<?php echo ($pageIndex == 'factory' ? 'active' : '');  ?>">
          <a href="<?php echo base_url('manage-factory-list'); ?>">
           <i class="fa fa-industry" aria-hidden="true"></i>  <span>Manage Factory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>