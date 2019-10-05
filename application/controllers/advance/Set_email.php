<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_email extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('template');
        $this->template->if_admin();
		$this->template->set('title',"Set Your Email");
        $this->_init();
        $this->load->model('advance/M_set_advance','set_email');
	}

    function _init()
    {
        $this->template->css('assets/themes/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->template->css('assets/themes/adminlte/plugins/iCheck/all.css');
        $this->template->css('assets/themes/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
        $this->template->js('assets/themes/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->template->js('assets/themes/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->template->js('assets/themes/adminlte/plugins/iCheck/icheck.min.js');
        $this->template->js('assets/themes/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
    }

	public function index()
	{
		$data = array();
		$row = $this->set_email->show(array('kd_advance'=>'set_email'))->row();
		$data['cek'] = $row;
		if (!empty($row->setting) or isset($row->setting)) {
			# code...
			$hasil = explode(',', $row->setting);
			$result = array();
			foreach ($hasil as $k) {
				$u = explode('=>', $k);
				if (count($u) >= 2) {
					# code...
					$result[$u[0]] = $u[1];
				}
			}
			$data['result'] = $result;
		}else{
			$data['result'] = array();
		}
		$this->template->adminlte('advance/email/v_set_email',$data,'advance/email/j_set_email');
	}

	public function set_aksi($value='')
	{
		# code...
		$this->form_validation->set_rules('allow', 'Allow Use', 'trim|min_length[1]|max_length[1]');
		$result = array();
		if ($this->form_validation->run() == FALSE) {
			# code...
			$result['status'] = 'warning';
            $result['ket'] = validation_errors();
		} else {
			$allow = $this->input->post("allow");
			$data = array();
			if ($allow != 'Y') {
				$data = array(
					'setting' => '',
					'allow_use' => 'N'
				);
				$query = $this->set_email->update('set_email', $data);
				if ($query >= 1) {
					$result['status'] = 'success';
	            	$result['ket'] = "update Success";
				}
			}
			else{
				$this->form_validation->set_rules('protocol', 'protocol', 'trim|required|min_length[1]|max_length[32]|alpha_numeric');
				$this->form_validation->set_rules('host', 'host', 'trim|required|min_length[5]|max_length[32]');
				$this->form_validation->set_rules('port', 'port', 'trim|required|min_length[1]|max_length[12]|numeric');
				$this->form_validation->set_rules('account', 'account', 'trim|required|min_length[1]|max_length[32]');
				$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]|max_length[64]');
				if ($this->form_validation->run() == FALSE) {
					$result['status'] = 'warning';
	            	$result['ket'] = validation_errors();
				} else {
					$smtp = $this->input->post("protocol");
					$host = $this->input->post("host");
					$port = $this->input->post("port");
					$account = $this->input->post("account");
					$password = $this->input->post("password");
					$set = "protocol=>".$smtp.",smtp_host=>".$host.",smtp_port=>".$port.",smtp_user=>".$account.",smtp_pass=>".$password.",mailtype=>html,charset=>utf-8";
					$data = array(
						'setting' => $set,
						'allow_use' => 'Y'
					);
					$query = $this->set_email->update('set_email', $data);
					if ($query >= 1) {
						$result['status'] = 'success';
		            	$result['ket'] = "update Success";
					}
					else{
						$result['status'] = 'success';
		            	$result['ket'] = "Nothing update";
					}
				}
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function kirim($value='')
	{
		$this->form_validation->set_rules('to', 'to', 'trim|required|min_length[5]|max_length[32]|valid_email');
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required|min_length[1]|max_length[64]|alpha_numeric_spaces');
		$this->form_validation->set_rules('isi', 'fieldlabel', 'required');
		$result = array();
		if ($this->form_validation->run() == FALSE) {
			$result['status'] = 'warning';
        	$result['ket'] = validation_errors();
		} else {
			$to = $this->input->post("to");
			$judul = $this->input->post("judul");
			$isi = $this->input->post("isi");
			$this->load->library('kirim');
			$kirim = $this->kirim->email($to, $judul, $isi);
			if ($kirim['ket'] == 1) {
				$result['status'] = 'success';
            	$result['ket'] = "Send Email Success";
			}
			else{
				$result['status'] = 'error';
            	$result['ket'] = "Send Email Error";
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}

/* End of file Set_email.php */
/* Location: ./application/controllers/advance/Set_email.php */