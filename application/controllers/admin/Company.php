<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_company');
		$this->template->if_admin();
		$this->template->set("title", "welcome to adminlte");
	}

	public function index()
	{
		$this->_init();
		$data = array();
		$this->template->adminlte('admin/v_company', $data, 'admin/v_company_js');
	}

	function _init()
	{
		$this->template->css('assets/themes/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
		$this->template->css('assets/themes/adminlte/plugins/iCheck/all.css');
		$this->template->js('assets/themes/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js');
		$this->template->js('assets/themes/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
		$this->template->js('assets/themes/adminlte/plugins/iCheck/icheck.min.js');
	}

	public function ajax_list()
	{
		$list = $this->M_company->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$id = "";
		$x = 1;
		foreach ($list as $u) {
			$row = array();
			$id = $u->id_company;
			$row[] = $x;
			$x++;
			$row[] = $u->desc_company;
			$row[] = $u->address;
			$row[] =    "<button class='btn btn-xs btn-primary btn-flat' data-toggle='tooltip' data-placement='top' title='edit data' onclick=\"edit('" . $id . "')\"><i class='fa fa-edit'></i></button>";
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_company->count_all(),
			"recordsFiltered" => $this->M_company->count_filtered(),
			"data" => $data
		);
		//output to json format
		echo json_encode($output);
	}

	public function add_data()
	{
		// $this->input->post('inputIdPriv');
		$this->form_validation->set_rules('inputDesc', 'Desc Company', 'required|min_length[3]|max_length[255]');
		$desc = $this->input->post('inputDesc');
		$this->form_validation->set_rules('inputAddress', 'Address Company', 'required|max_length[255]');
		$address = $this->input->post('inputAddress');
		$result = array();
		if ($this->form_validation->run() == FALSE) {
			$result['status'] = 'warning';
			$result['ket'] = validation_errors();
		} else {
			$data = array(
				'desc_company' => $desc,
				'address' => $address
			);
			$query = $this->M_company->insert_data($data);
			if ($query >= 1) {
				$result['status'] = 'success';
				$result['ket'] = "saving success";
			} else {
				$result['status'] = 'warning';
				$result['ket'] = "saving error";
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function ajax_edit($id)
	{
		$query = $this->M_company->show(array('id_company' => $id))->row();
		$data = array(
			'result' => $query
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
		// echo json_encode($data);
	}

	public function update_data()
	{
		$this->form_validation->set_rules('inputId', 'Id Company', 'required|numeric');
		$id = $this->input->post('inputId');
		$this->form_validation->set_rules('inputDesc', 'Desc Company', 'required|min_length[3]|max_length[255]');
		$desc = $this->input->post('inputDesc');
		$this->form_validation->set_rules('inputAddress', 'Address Company', 'required|max_length[255]');
		$address = $this->input->post('inputAddress');
		$result = array();
		if ($this->form_validation->run() == FALSE) {
			$result['status'] = 'warning';
			$result['ket'] = validation_errors();
		} else {
			$data = array(
				'desc_company' => $desc,
				'address' => $address
			);
			$query = $this->M_company->update_data($id, $data);
			if ($query >= 1) {
				$result['status'] = 'success';
				$result['ket'] = "update success";
			}elseif ($query == 0) {
				$result['status'] = 'warning';
				$result['ket'] = "Nothing Update";
			} else {
				$result['status'] = 'warning';
				$result['ket'] = "update error";
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

}

/* End of file Company.php */
/* Location: ./application/controllers/admin/Company.php */