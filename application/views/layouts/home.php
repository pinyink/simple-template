  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <div>
            <?php if (isset($create) and $create == 1): ?>
            <a href="<?php echo base_url().$url.'/create'; ?>" class="btn btn-info btn-sm">Add Data</a>
            <?php endif ?>
            <?php if (isset($update) and $update == 1): ?>
            <a href="<?php echo base_url().$url.'/update'; ?>" class="btn btn-success btn-sm">Update Data</a>
            <?php endif ?>
            <?php if (isset($delete) and $delete == 1): ?>
            <a href="<?php echo base_url().$url.'/delete'; ?>" class="btn btn-warning btn-sm">Delete Data</a>
            <?php endif ?>
            <?php if (isset($upload) and $upload == 1): ?>
            <a href="<?php echo base_url().$url.'/upload'; ?>" class="btn btn-danger btn-sm">Upload Data</a>
            <?php endif ?>
          </div>
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <?php echo $hi; ?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
