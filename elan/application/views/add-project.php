<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span.activateShow a {font-size: 19px;color: green;}span.deleteShow a {font-size: 19px;color: red;}img.img-thumbnail {width: 225px;}</style>
    <style type="text/css">.well{padding: 10px;}span>p {
    color: red;
    margin: 0px;
}</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small><?php echo (!empty($result) ? 'Update Project' : 'Add New Project'); ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('manage-projects-list'); ?>"><?php echo (!empty($result) ? 'Update Project' : 'Add New Project'); ?></a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo (!empty($result) ? 'Update Project' : 'Add New Project'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- /.box-body -->
              <form class="form-horizontal" method="post" action="<?php echo base_url('add-projects-post'); ?>"  enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Company Name:</label>
                  <div class="col-sm-10">
                   <select name="company_id" class="form-control" required="">
                       <option value="">Select</option>
                       <?php foreach($companyResult as $val){ ?>
                       
                       <option value="<?php echo $val['id']; ?>" <?php echo !empty($result['company_id']) ? (($result['company_id'] == $val['id']) ? "selected" : "") : "" ?>><?php echo $val['name']; ?></option>
                       <?php } ?>
                   </select> 
                    <span><?php echo form_error('name'); ?></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Project Name:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo (!empty(set_value('name')) ? set_value('name') : (!empty($result['project_name']) ? $result['project_name'] : ''  ) ); ?>" name="name"  placeholder="Please enter project name">
                    <input type="hidden" name="id" value="<?php echo (!empty($result['id']) ? $result['id'] : ''); ?>">
                    <span><?php echo form_error('name'); ?></span>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Project Number:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="number" placeholder="Please enter project number"  value="<?php echo (!empty(set_value('number')) ? set_value('number') : (!empty($result['projetc_number']) ? $result['projetc_number'] : ''  ) ); ?>">
                     <span><?php echo form_error('number'); ?></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Address:</label>
                  <div class="col-sm-10">
                      <textarea name="address" class="form-control" placeholder="Enter address"><?php echo (!empty(set_value('address')) ? set_value('address') : (!empty($result['address']) ? $result['address'] : ''  ) ); ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Project Image:</label>
                   <div class="col-sm-5">
                     <input type="file" name="projectImages">
                  </div>
                   <div class="col-sm-5">
                       <?php 
                          if(!empty($result['projectImage'])){
                            echo '<img style="width: 100px;" src="'.base_url('uploads/project/'.$result['projectImage']).'">';
                          }
                         ?>
                        
                  </div>
                </div>
                 <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Upload Files:</label>
                   <div class="col-sm-10">
                     <input type="file" name="document[]" multiple="" accept=".pdf" >
                      <div class="col-sm-12">
                        <?php
                          if(!empty($document)){
                              foreach($document as $list){
                                echo '<span id="get'.$list['id'].'"><span onclick="deleteFile('.$list['id'].')" style="position: relative;left: 87px;top: -39px;cursor: pointer;" class="label label-info"><i class="fa fa-trash" aria-hidden="true"></i></span><a href="'.base_url('uploads/document/'.$list['project_url']).'" target="_blank"><img style="width: 100px;" src="'.base_url('uploads/pdf.png').'"></a></span>';
                              }
                          } 
                         ?>
                        
                      </div>
                   </div>
                </div>
                <?php if(!empty($result)): ?>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Project Status:</label>
                  <div class="col-sm-10">
                    <select name="projectStatus" class="form-control" >
                       <option value="" hidden="">Select Status</option>
                       <option value="1"  <?php echo (!empty($result) && $result['projectStatus'] == 1 ? 'selected':''); ?> >Progress</option>
                       <option value="2" <?php echo (!empty($result) && $result['projectStatus'] == 2 ? 'selected':''); ?>  >Completed</option>
                    </select>
                  </div>
                </div>
              <?php endif; ?>
                <div class="form-group"> 
                  <div class="col-sm-offset-1 col-sm-4">
                   <button type="submit" class="btn btn-default"><?php echo (!empty($result) ? 'Update' : 'Submit'); ?></button>
                  </div>
                </div>
              </form>
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
  <script type="text/javascript">
    function deleteFile(argument) {
       if(confirm('Are you sure. You want to delete this pdf file') == true){
          //
          $.post('<?php echo base_url("admin/welcome/deleteProjectPdf"); ?>',{argument:argument},function(res){
             $('#get'+argument).remove();
             alert("Project pdf has been delete successfully");
          });
       }
     
    }
  </script>
  <!-- /.content-wrapper -->