<div class="content-wrapper">
  <style type="text/css">span.mobileVerify {color: #14c7e4eb;padding-left: 8px;}span.emailVerify {color: #14c7e4eb;padding-left: 8px;}span.activateShow a {font-size: 19px;color: green;}span.deleteShow a {font-size: 19px;color: red;}img.img-thumbnail {width: 225px;}</style>
    <style type="text/css">.well{padding: 10px;}span>p {
    color: red;
    margin: 0px;
}
div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 180px;height: 214px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: 177px;
}
div.desc {
    padding: 7px;
    text-align: center;
    background: #d05252;
    font-weight: bold;
    color: #ffff;
    cursor: pointer;
}
</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Gallery</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin-dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('project-gallery-view/'.base64_encode($projectId)); ?>">Gallery</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Gallery List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <span id="messageShow"> <?php $message = $this->session->flashdata('message'); echo (!empty($message) ? $this->session->flashdata('message') :''); ?></span>
            <!-- /.box-body -->
                 <form class="form-inline" action="<?php echo base_url('admin/welcome/projectGalleryViewPost'); ?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                      <label for="email">Upload Gallery:</label>
                      <input type="file" class="form-control" name="gallery[]" multiple="">
                      <input type="hidden" class="form-control" name="project" value="<?php echo $projectId; ?>">
                  </div>
                  <button type="submit" class="btn btn-info">Upload</button>
                </form>
                <hr>
                 <?php 
                      if(!empty($result)): 
                         foreach($result as $list):
                    ?>
                    <div class="gallery" id="get<?php echo $list['id']; ?>">
                      <a target="_blank" href="<?php echo base_url('uploads/gallery/'.$list['imageUrl']); ?>">
                        <img src="<?php echo base_url('uploads/gallery/'.$list['imageUrl']); ?>" alt="Cinque Terre" width="600" height="400">
                      </a>
                       <div class="desc" onclick="deleteFile(<?php echo $list['id']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</div>
                    </div>
                 <?php endforeach; endif; ?>
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
       if(confirm('Are you sure. You want to delete this image') == true){
          //
          $.post('<?php echo base_url("admin/welcome/deleteProjectGalleryImages"); ?>',{argument:argument},function(res){
             $('#get'+argument).remove();
             alert("Gallery image has been delete successfully");
          });
       }
     
    }
    setTimeout(function(){ $('#messageShow').hide('slow'); },3000);
    
  </script>
  <!-- /.content-wrapper -->