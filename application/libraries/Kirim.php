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

	public function email($to, $judul, $isi)
	{
		//Load email library
		$ket = '';
		$pesan = '';
		$this->CI->load->library('email');
		$this->CI->load->model('advance/M_set_advance','set_email');
		$row = $this->CI->set_email->show(array('kd_advance'=>'set_email'))->row();

		//SMTP & mail configuration
		$config = array(
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8'
		);

		if ($row->allow_use == 'Y') {
			if (!empty($row->setting) or isset($row->setting) or $row->setting != '') {
				# code...
				$hasil = explode(',', $row->setting);
				foreach ($hasil as $k) {
					$u = explode('=>', $k);
					if (count($u) >= 2) {
						# code...
						$config[$u[0]] = $u[1];
					}
				}

				try {
					$this->CI->email->initialize($config);
					$this->CI->email->set_mailtype("html");
					$this->CI->email->set_newline("\r\n");
					//Email content
					$htmlContent = $isi;

					$this->CI->email->to($to);
					$this->CI->email->from($config['smtp_user'],'Simple Template');
					$this->CI->email->subject($judul);
					$this->CI->email->message($htmlContent);
					//Send email
					$this->CI->email->send();
					$ket = 1;
					$pesan = 'kirim email berhasil';
				} catch (Exception $e) {
					$ket = 0;
					$pesan = $e->getMessage();
				}
			}else{
				$ket = 0;
				$pesan = "tidak ada konfigurasi";
			}

		}
		else{
			$ket = 0;
			$pesan = 'Please enable allow use email for first !!';
		}

		$data = array(
			'ket' => $ket,
			'pesan' => $pesan
			);
		return $data;
	}

	public function yo($value='')
	{
		# code...
		$data = array(
			'ket' => 1,
			'pesan' => 'yoi'
			);
		return $data;
	}
}

?>