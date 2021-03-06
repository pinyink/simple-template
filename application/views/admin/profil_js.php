<script type="text/javascript" charset="utf-8" async defer>
	var percen;

	$(document).ready(function() {
		$.ajax({
			url: "<?php echo base_url() . 'profil/view'; ?>",
			type: "GET",
			data: $('#form_settings').serialize(),
			dataType: "JSON",
			success: function(data) {
				$('[name="inputFullName"]').val(data.result.user_fullname);
				$('[name="inputEmail"]').val(data.result.user_email);
				$('[name="inputAddress"]').val(data.result.user_address);
				$('#email_profil').text(data.result.user_email);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				notify('error', 'error', 'Load data error');
			}
		});
		$('.progress-container').hide();
	});

	$("#form_settings").submit(function(event) {
		$.ajax({
			url: "<?php echo base_url() . 'profil/setting'; ?>",
			type: "POST",
			data: form_serialize_csrf($('#form_settings').serialize()),
			dataType: "JSON",
			success: function(data) {
				$('.profile-username').text(data.fullname);
				$('#ms_name1').text(data.fullname);
				$('#ms_name2').text(data.fullname);
				notify(data.status, data.status, data.ket);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				notify('error', 'error', 'update data error');
			}
		});
		event.preventDefault();
	});

	$('#form_change_photo').submit(function(event) {
		/* Act on the event */
		event.preventDefault();	
		
		$.ajax({
				url: "<?php echo base_url() . 'profil/change_photo'; ?>",
				type: "POST",
				data: append_csrf (new FormData(this)),
				processData: false,
				contentType: false,
				cache: false,
				async: true,
				beforeSend: function() {
					// setting a timeout
					$(".progress-bar").width(0);
					$('#sr_only').text(0 + '%');
				},
				xhr: function() {
					// get the native XmlHttpRequest object
					var xhr = $.ajaxSettings.xhr();
					// set the onprogress event handler
					xhr.upload.onprogress = function(evt) {
						percen = Math.round(evt.loaded / evt.total * 100);
						// console.log('progress', evt.loaded/evt.total*100);
						$('.progress-container').show();
						$(".progress-bar").animate({
							width: percen + "%"
						});
						$('#sr_only').text(percen + '%');
					};
					// set the onload event handler
					xhr.upload.onload = function() {
						setTimeout(
							function() {
								//do something special
								$('.progress-container').hide();
							}, 1000);
					};
					// return the customized object
					return xhr;
				}
			})
			.done(function(data) {
				if (data.stat == 0) {
					notify('error', 'error', data.error.error);
				} else {
					$('.profile-user-img').attr("src", data.result);
					$('#photo1').attr("src", data.result);
					$('#photo2').attr("src", data.result);
					$('#photo3').attr("src", data.result);
					notify('success', 'success', 'upload successfully');
					// console.log(data.log);
				}
			})
			.fail(function() {
				notify('error', 'Please Try Again', "error");
			});

	});

	$('#form_change_password').submit(function(event) {
		/* Act on the event */
		if ($('[name="inputNewPassword"]').val() != $('[name="inputRetypePassword"]').val()) {
			notify('warning', 'warning', 'Retype Password Not Same');
		} else {
			$.ajax({
					url: "<?php echo base_url() . 'profil/change_password'; ?>",
					type: 'POST',
					dataType: 'JSON',
					data: form_serialize_csrf( $('#form_change_password').serialize() ),
				})
				.done(function(data) {
					notify(data.status, 'Notify', data.ket);
					$('#form_change_password')[0].reset();
				})
				.fail(function() {
					notify('error', 'error', 'update Password error');
				});
		}
		event.preventDefault();
	});

	$(function() {
		$('[name="profil_photo"]').on("change", function() {
			var fileExtension = ['jpeg', 'jpg', 'png'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				notify('warning', 'File Error', 'Not Allowed File Type');
			};

			var files = !!this.files ? this.files : [];
			if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

			if (/^image/.test(files[0].type)) { // only image file
				var reader = new FileReader(); // instance of the FileReader
				reader.readAsDataURL(files[0]); // read the local file

				reader.onloadend = function() { // set image data as background of div
					$("#image-holder").css("background-image", "url(" + this.result + ")");
				}
			}
		});
	});
</script>
