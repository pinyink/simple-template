  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<section class="content-header">
  		<h1>
  			Setting Company
  			<small>Preview</small>
  		</h1>
  		<ol class="breadcrumb">
  			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  			<li><a href="#">setting</a></li>
  			<li class="active">company</li>
  		</ol>
  	</section>

  	<!-- Main content -->
  	<section class="content"  style="min-height:720px;">
  		<div class="row">
  			<div class="col-md-12 col-sm-12 col-xs-12">

  			</div>
  		</div>


  		<div class="box box-info">
  			<div class="box-header with-border">
  				<div>
  					<button class="btn btn-sm btn-default btn-flat" onclick="reload_table()" data-toggle="tooltip" data-placement="top" title="refresh"><i class="fa fa-refresh"></i></button>
  					<button class="btn btn-sm btn-info btn-flat" onclick="add()" data-toggle="tooltip" data-placement="top" title="add"><i class="fa fa-plus"></i></button>
  				</div>
  				<h3 class="box-title"></h3>
  				<div class="box-tools pull-right">
  					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
  				</div>
  			</div>
  			<!-- /.box-header -->
  			<div class="box-body" id="box_body_content">
  				<div class="row">
  					<div class="col-md-12 col-sm-12 col-xs-12">
  						<table id="table" class="table table-bordered table-striped" cellspacing="0" width="100%">
  							<thead>
  								<tr>
  									<th>No</th>
  									<th>Name Company</th>
  									<th>Address Company</th>
  									<th></th>
  								</tr>
  							</thead>
  							<tbody>
  							</tbody>
  						</table>
  					</div>
  					<!-- /.col -->
  				</div>
  				<!-- /.row -->
  			</div>
  			<!-- /.box-body -->
  			<div class="box-footer" id="box_footer_content">
  			</div>
  		</div>
  		<!-- /.box -->

  	</section>
  	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_add" role="dialog">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-header bg-purple">
  				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  				<h3 class="modal-title">Book Form</h3>
  			</div>
  			<div class="modal-body form">
  				<div class="row" id="row_fa">
  					<div class="col-md-12 col-sm-12 col-xs-12" id="modal_form">
  						<?=
								form_open('admin/company/add', 'id="form_add" class="form-horizontal"');
							?>
  						<input type="hidden" value="" name="inputId" />
  						<div class="form-body">
  							<div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-3">Name Company</label>
  								<div class="col-md-7 col-sm-7 col-xs-7"><input name="inputDesc" placeholder="Name Company" class="form-control" type="text"></div>
  							</div>
  						</div>
  						<div class="form-body">
  							<div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-3">Address Company</label>
  								<div class="col-md-7 col-sm-7 col-xs-7"><textarea class="form-control" name="inputAddress"></textarea></div>
  							</div>
  						</div>
  						<?=
								form_close();
							?>
  					</div>
  				</div>
  			</div>
  			<div class="modal-footer">
  				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-sm btn-flat">Save</button>
  				<button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal">Cancel</button>
  			</div>
  		</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
