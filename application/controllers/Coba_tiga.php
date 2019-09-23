<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba_tiga extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
	}

	public function index()
	{
		$this->template->authlogin('r',3);
		$data = array(
			'hi' => "Coba tiga",
			'url' => 'coba_tiga'
			);
		$this->template->set('title',"Coba tiga Read bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function update($value='')
	{
		$this->template->authlogin('u',3);
		$data = array(
			'hi' => "Halaman Update Coba tiga",
			'url' => 'coba_tiga'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function create($value='')
	{
		$this->template->authlogin('c',3);
		$data = array(
			'hi' => "Halaman Create Coba tiga",
			'url' => 'coba_tiga'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function delete($value='')
	{
		$this->template->authlogin('d',3);
		$data = array(
			'hi' => "Halaman Delete Coba tiga",
			'url' => 'coba_tiga'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function upload($value='')
	{
		$this->template->authlogin('y',3);
		$data = array(
			'hi' => "Halaman upload Coba tiga",
			'url' => 'coba_tiga'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

}

/* End of file Coba_tiga.php */
/* Location: ./application/controllers/Coba_tiga.php */