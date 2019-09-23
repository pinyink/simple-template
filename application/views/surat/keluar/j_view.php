<script type="text/javascript">
   
  var table;
  var save_method;
   
  $(document).ready(function() {
   
      //datatables
      table = $('#table').DataTable({ 
   
          "processing": false, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [], //Initial no order.
   
          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": "<?php echo base_url('surat/keluar/ajax_list')?>",
              "type": "POST",
              data : function ( d ) {
                d.csrf_test_name = getCookie('value_key');
              }
          },
   
          //Set column definition initialisation properties.
          "columnDefs": [
          { 
              "targets": [ 0 ], //first column / numbering column
              "orderable": false, //set not orderable
          },
          ],
   
      });
   
  });

  $('#tgl').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })


  function reload_table()
  {
    table.ajax.reload(null, false);
  }

  <?php if (isset($create) and $create == 1): ?>
  function add()
  {
    save_method = 'add';
    $('#form_add')[0].reset();
    $.ajax({
      url : "<?php echo base_url('surat/keluar/add_ajax')?>",
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        // console.log(data);
        $('[name="pengolah"]').empty();
        $('[name="pengolah"]').append('<option value="">Pilih Satu</option>');
        $.each(data.bidang, function(key, value) {
          $('[name="pengolah"]').append('<option value="'+ value.id_bidang +'">'+ value.nama_bidang +'</option>');       
        });
        $('#modal_add .modal-title').text('Tambah Data');
        $('#modal_add').modal('show'); // show bootstrap modal
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          notify('error', 'error', 'Error Loading From Ajax');
      }
    });
  }
  <?php endif ?>

  function cek_no()
  {
    $.ajax({
      url : "<?php echo base_url('surat/keluar/cek')?>",
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="no"]').val(data.nomer);
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          notify('error', 'error', 'Error Loading From Ajax');
      }
    });
  }

  <?php if (isset($update) and $update == 1): ?>
  function edit(id)
  {
    save_method = 'edit';
    $('#form_add')[0].reset();
    $.ajax({
      url : "<?php echo base_url('surat/keluar/edit/')?>"+id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="id"]').val(data.result.id_sulur);
        $('[name="no"]').val(data.result.nomer_sulur);
        $('[name="kode"]').val(data.result.kode_sulur);
        $('[name="kepada"]').val(data.result.kepada_sulur);
        $('[name="perihal"]').val(data.result.perihal_sulur);
        $('[name="tgl"]').val(data.result.tanggal_sulur);
        $('[name="pengolah"]').empty();
        $('[name="pengolah"]').append('<option value="">Pilih Satu</option>');
        $.each(data.bidang, function(key, value) {
          if (data.result.pengolah_sulur === value.id_bidang) {
            $('[name="pengolah"]').append('<option value="'+ value.id_bidang +'" selected>'+ value.nama_bidang +'</option>');
          }
          else{
            $('[name="pengolah"]').append('<option value="'+ value.id_bidang +'">'+ value.nama_bidang +'</option>');
          }       
        });
        $('#modal_add .modal-title').text('Edit Data');
        $('#modal_add').modal('show'); // show bootstrap modal
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          notify('error', 'error', 'saving data error');
      }
    });
  }
  <?php endif?>

  <?php if (isset($upload) and $upload == 1): ?>
  function upload(id)
  {
    var u = "<?php echo base_url().'assets/image/surat/keluar/'; ?>";
    $('#form_upload')[0].reset();
    $('[name="id"]').val(id);
    $.ajax({
      url: "<?php echo base_url().'surat/keluar/lihat_scan/'; ?>"+id,
      type: "GET",
      processData: false,
      contentType:false,
      cache : false,
      async : true,
    })
    .done(function(data) {
      $('#list_scan').empty();
      $.each(data, function(key, value) {
        <?php if (isset($delete) and $delete == 1): ?>
        var a = "<span id="+value.id+">"+value.deskripsi+" <button type='button' class='btn btn-xs btn-primary btn-flat' data-toggle='tooltip' data-placement='top' title='hapus data' onclick=\"hapus('"+value.id+"')\"><i class='fa fa-trash'></i></button> <a class='btn btn-xs btn-info btn-flat' href='"+u+value.path+"' target='_blank' data-toggle='tooltip' data-placement='top' title='lihat file'><i class='fa fa-download'></i></a><br/><br/></span>";
        $('#list_scan').append(a);
        <?php endif ?>
        <?php if (isset($delete) and $delete == 0): ?>
        var a = "<span id="+value.id+">"+value.deskripsi+" <a class='btn btn-xs btn-info btn-flat' href='"+u+value.path+"' target='_blank' data-toggle='tooltip' data-placement='top' title='lihat file'><i class='fa fa-download'></i></a><br/><br/></span>";
        $('#list_scan').append(a);
        <?php endif ?>
      });
      $('#modal_upload .modal-title').text('Upload File');
      $('#modal_upload').modal('show'); // show bootstrap modal
    })
    .fail(function() {
      notify('error', 'error', "error");
    });
  }

  $('#form_upload').submit(function(event) {
    /* Act on the event */
    $.ajax({
      url: "<?php echo base_url().'surat/keluar/upload'; ?>",
      type: "POST",
      data: append_csrf (new FormData(this)),
      processData: false,
      contentType:false,
      cache : false,
      async : true,
    })
    .done(function(data) {
      if (data.stat == 0) {
        notify('error', 'error', data.error.error);
      }
      else{
        // $('#photo1').attr("src", data.result);
        // $('#list_scan').empty();
        var a = "<span id="+data.id+">"+data.nama+" <button type='button' class='btn btn-xs btn-primary btn-flat' data-toggle='tooltip' data-placement='top' title='hapus data' onclick=\"hapus('"+data.id+"')\"><i class='fa fa-trash'></i></button> <a class='btn btn-xs btn-info btn-flat' href='"+data.photo+"' target='_blank' data-toggle='tooltip' data-placement='top' title='lihat file'><i class='fa fa-download'></i></a><br/><br/></span>";
        $('#list_scan').append(a);
        $('#form_upload')[0].reset();
        notify('success', 'success','upload successfully');
      }
    })
    .fail(function() {
      notify('error', 'error', "error");
    });
    event.preventDefault();
  });
  <?php endif ?>

  <?php if (isset($delete) and $delete == 1): ?>
  function hapus(id)
  {
    $.ajax({
      url: "<?php echo base_url().'surat/keluar/hapus_scan/'; ?>"+id,
      type: "GET",
      processData: false,
      contentType:false,
      cache : false,
      async : true,
    })
    .done(function(data) {
      notify(data.status, data.status, data.ket);
      $('#'+data.id+'').remove();
    })
    .fail(function() {
      notify('error', 'error', "error");
    });
  }
  <?php endif ?>

  function save()
  {
    var url;
    if(save_method == 'add')
    {
      url = "<?php echo base_url('surat/keluar/add')?>";
    }
    else if(save_method == 'edit')
    {
      url = "<?php echo base_url('surat/keluar/update')?>";
    }
    $.ajax({
      url : url,
      type: "POST",
      data: form_serialize_csrf ($('#form_add').serialize()),
      dataType: "JSON",
      success: function(data)
      {
        if (data.kode == 1) {
          notify(data.status, data.status, data.ket);
        }
        else{
          $('#modal_add').modal('hide');
          notify(data.status, data.status, data.ket);
          reload_table();
        }
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        notify('error', 'error', 'saving data error');
        // $.notify("Saving Error", "warn");
      }
    });
  }
  </script>