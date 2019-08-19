function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
		  c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
		  return c.substring(name.length, c.length);
		}
	}
	return "";
}

function form_serialize_csrf( data ) {
	return data+'&'+getCookie('key')+'='+getCookie('value_key');
}

function append_csrf( data )
{
	data.append('csrf_test_name', getCookie('value_key'));
	return data;
}