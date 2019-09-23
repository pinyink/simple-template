<script type="text/javascript">
	var table;
	var save_method;
	var form_modal = '';
	var form_setting = '<div class="row"><div class="col-md-12 col-sm-12 col-xs-12"></div></div>';
	var content = '';

	$(document).ready(function() {

		//datatables
		table = $('#table').DataTable({

			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.

			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo base_url('admin/company/ajax_list') ?>",
				"type": "POST",
				data : function ( d ) {
					d.csrf_test_name = getCookie('value_key');
				}
			},

			//Set column definition initialisation properties.
			"columnDefs": [{
				"targets": [0], //first column / numbering column
				"orderable": false, //set not orderable
			}, ],

		});

	});

	function reload_table() {
		table.ajax.reload(null, false);
	}

	function add() {
		save_method = 'add';
		$('#form_add')[0].reset();
		// $('#modal_form').empty();
		// $('#modal_form').html(form_modal);
		$('#modal_add .modal-title').text('Add Data Company');
		$('#modal_add').modal('show'); // show bootstrap modal
	}

	function edit(id) {
		save_method = 'edit';
		// $('#form_add')[0].reset();
		$.ajax({
			url: "<?php echo base_url('admin/company/ajax_edit/') ?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				// $('#modal_form').empty();
				// $('#modal_form').html(form_modal);
				$('#form_add')[0].reset();
				$('[name="inputId"]').val(data.result.id_company);
				$('[name="inputDesc"]').val(data.result.desc_company);
				$('[name="inputAddress"]').val(data.result.address);
				$('#modal_add .modal-title').text('Edit Company');
				$('#modal_add').modal('show'); // show bootstrap modal
			},
			error: function(jqXHR, textStatus, errorThrown) {
				notification('Error loading from ajax !!!');
			}
		});
	}

	function setting(id) {
		window.location.replace("<?php echo base_url('admin/priv/permission/') ?>" + id);
	}

	function save() {
		var url;
		if (save_method == 'add') {
			url = "<?php echo base_url('admin/company/add_data') ?>";
		} else if (save_method == 'edit') {
			url = "<?php echo base_url('admin/company/update_data') ?>";
		}
		// ajax adding data to database
		if (!$('[name="inputDesc"]').val()) {
			notify('warning', 'notification', 'Data Must Be Set First');
		} else {
			$.ajax({
				url: url,
				type: "POST",
				data: $('#form_add').serialize()+'&'+getCookie('key')+'='+getCookie('value_key'),
				dataType: "JSON",
				success: function(data) {
					// if add success
					$('#modal_add').modal('hide');
					$('[name="' + data.name_key + '"]').val(data.key);
					notify(data.status, data.status, data.ket)
					reload_table();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$('#modal_add').modal('hide');
					notify('error', 'error', errorThrown);
					// $.notify("Saving Error", "warn");
				}
			});
		}
	}

	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
	})
</script>
