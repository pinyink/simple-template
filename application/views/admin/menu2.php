  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting Nav and Menus
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">setting</a></li>
        <li class="active">Nav and Menus</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

        </div>
      </div>

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div>
                <button class="btn btn-sm btn-default btn-flat" onclick="reload_nav()" data-toggle="tooltip" data-placement="top" title="refresh"><i class="fa fa-refresh"></i></button>
                <button class="btn btn-sm btn-info btn-flat" onclick="add_nav('')" data-toggle="tooltip" data-placement="top" title="add"><i class="fa fa-plus"></i></button>
              </div>
              <hr>
              <table id="nav" class="table table-bordered table-striped" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Order</th>
                        <th></th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
            </div>
            <!-- /.col -->
            <div class="col-md-6 col-sm-12 col-xs-12">
              <div>
                <button class="btn btn-sm btn-default btn-flat" onclick="reload_content()" data-toggle="tooltip" data-placement="top" title="refresh nav"><i class="fa fa-refresh"></i></button>
                <button class="btn btn-sm btn-info btn-flat" onclick="add_content()" data-toggle="tooltip" data-placement="top" title="add"><i class="fa fa-plus"></i></button>
              </div>
              <hr>
              <table id="menu_content" class="table table-bordered table-striped" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Menu</th>
                          <th>Order</th>
                          <th>URL</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_nav_add" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Book Form</h3>
        </div>
        <div class="modal-body form">
          <div class="row" id="row_fa">
            <div class="col-md-12 col-sm-12 col-xs-12" id="list_fa">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div id="bt_fa_next_back"></div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
