<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class kirim
{
	private $CI;
	
	function __construct()
	{
		$this->CI =& get_instance();
	}

	public function email()
	{
		//Load email library
		$this->CI->load->library('email');
		$this->CI->load->model('advance/M_set_advance','set_email');
		$row = $this->CI->set_email->show(array('kd_advance'=>'set_email'))->row();

		//SMTP & mail configuration
		$config = array(
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8'
		);

		if (!empty($row->setting) or isset($row->setting)) {
			# code...
			$hasil = explode(',', $row->setting);
			foreach ($hasil as $k) {
				$u = explode('=>', $k);
				if (count($u) >= 2) {
					# code...
					$config[$u[0]] = $u[1];
				}
			}
		}else{
			echo "konfigurasi Kosong";
			break;
		}
		$this->CI->email->initialize($config);
		$this->CI->email->set_mailtype("html");
		$this->CI->email->set_newline("\r\n");

		//Email content
		$htmlContent = '<h1>Sending email via SMTP server</h1>';
		$htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

		$this->CI->email->to('nurkhafindi@gmail.com');
		$this->CI->email->from('akun779@gmail.com','MyWebsite');
		$this->CI->email->subject('How to send email via SMTP server in CodeIgniter');
		$this->CI->email->message($htmlContent);

		//Send email
		$this->CI->email->send();
		return TRUE;
	}

	public function yo($value='')
	{
		# code...
		return 1;
	}
}

?>