  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Arsip Surat Masuk
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Surat</a></li>
        <li class="active">Masuk</li>
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
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">
            <form action="#" method="post" accept-charset="utf-8" id="form-datatables">
              <div class="input-group input-group-sm">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-sm btn-default btn-flat" onclick="reload_table()" data-toggle="tooltip" data-placement="top" title="refresh"><i class="fa fa-refresh"></i></button>
                  <?php if (isset($create) and $create == 1): ?>
                  <button type="button" class="btn btn-sm btn-info btn-flat" onclick="add()" data-toggle="tooltip" data-placement="top" title="add"><i class="fa fa-plus"></i></button>
                  <?php endif ?>
                </span>
                <input type="text" class="form-control input-sm" name="tgl_bulan" id="tgl_bulan" value="<?php echo date('m-Y'); ?>">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-info btn-flat">Go!</button>
                </span>
              </div>
              </form>
            </div>
          </div>
          <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <hr>
              <table id="table" class="table table-bordered table-striped" cellspacing="0" width="100%">
                  <thead class="bg-gray color-palette">
                      <tr>
                          <th>No</th>
                          <th>No Surat</th>
                          <th>Pengirim</th>
                          <th>Perihal</th>
                          <th>Tanggal</th>
                          <th>Diterima</th>
                          <th>Disposisi</th>
                          <th>Bidang</th>
                          <?php if ($this->session->userdata('level') == 1): ?>
                          <th>Instansi</th>
                          <?php endif ?>
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
        <div class="box-footer">
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_add" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-olive">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Book Form</h3>
        </div>
        <div class="modal-body form">
         <form action="#" id="form_add" class="form-horizontal">
            <input type="hidden" value="" name="id"/>
            <div class="row">
              <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">No Surat</label>
                    <div class="col-md-7 col-sm-7 col-xs-7">
                      <input name="no" placeholder="No Surat" class="form-control" type="text">
                    </div>
                  </div>
                </div>
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Pengirim</label>
                    <div class="col-md-9 col-sm-7 col-xs-7">
                      <textarea class="form-control" name="pengirim"></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Perihal</label>
                    <div class="col-md-9 col-sm-7 col-xs-7">
                      <textarea class="form-control" name="perihal"></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tanggal Surat</label>
                    <div class="col-md-9 col-sm-7 col-xs-7">
                      <input class="form-control" name="tgl" id="tgl"/>
                    </div>
                  </div>
                </div>
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Tanggal Diterima</label>
                    <div class="col-md-9 col-sm-7 col-xs-7">
                      <input class="form-control" name="tgl_te" id="tgl_te"/>
                    </div>
                  </div>
                </div>
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Pengolah</label>
                    <div class="col-md-9 col-sm-7 col-xs-7">
                      <select class="form-control" name="pengolah">

                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Disposisi</label>
                    <div class="col-md-9 col-sm-7 col-xs-7">
                      <textarea class="form-control" name="disposisi"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 text-center">
                <h3><b>Tutorial Singkat</b></h3>
                <p>
                  <ol>
                    <li>Silahkan isi data sesuai dengan surat masuk</li>
                    <li>Kolom Pengolah dan disposisi bisa di kosongi dahulu menunggu disposisi pimpinan</li>
                  </ol>
                </p>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-sm btn-flat">Save</button>
          <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal">Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_upload" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-maroon color-palette">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Book Form</h3>
        </div>
        <div class="modal-body form">
         <form action="#" id="form_upload" class="form-horizontal">
            <input type="hidden" value="" name="id"/>
            <div class="row">
              <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Deskripsi</label>
                    <div class="col-md-5 col-sm-7 col-xs-7">
                      <input type="text" class="form-control" name="desc">
                    </div>
                  </div>
                </div>
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Pilih File</label>
                    <div class="col-md-5 col-sm-7 col-xs-7">
                      <label class="btn btn-sm btn-flat btn-info btn-block">
                        <input type="file" name="file" hidden>
                      </label>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                      <button type="submit" class="btn btn-sm btn-info">Simpan</button>
                    </div>
                  </div>
                  <br/>
                  <br/>
                  <div id="list_scan" class="col-md-12 col-sm-12 col-xs-12 text-center">

                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 text-center">
                <h3><b>Tutorial Singkat</b></h3>
                <p><ol>
                  <li>Maksimum ukurun file yang di upload adalah 2 MB</li>
                  <li>Hanya file pdf, jpg dan png yang bisa di upload</li>
                </ol></p>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-sm btn-flat">Save</button> -->
          <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal">Tutup</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->