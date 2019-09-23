<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba_empat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
	}

	public function index()
	{
		// authlogin('kode', 'id content', 'default ajax = NULL, use ajax = "Y"')
		$this->template->authlogin('r',4);
		$data = array(
			'hi' => "Coba empat",
			'url' => 'coba_empat'
			);
		$this->template->set('title',"Coba empat Read bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function update($value='')
	{
		$this->template->authlogin('u',4);
		$data = array(
			'hi' => "Halaman Update Coba empat",
			'url' => 'coba_empat'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function create($value='')
	{
		$this->template->authlogin('c',4);
		$data = array(
			'hi' => "Halaman Create Coba empat",
			'url' => 'coba_empat'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function delete($value='')
	{
		$this->template->authlogin('d',4);
		$data = array(
			'hi' => "Halaman Delete Coba empat",
			'url' => 'coba_empat'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function upload($value='')
	{
		$this->template->authlogin('y',4);
		$data = array(
			'hi' => "Halaman upload Coba empat",
			'url' => 'coba_empat'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

}

/* End of file Coba_empat.php */
/* Location: ./application/controllers/Coba_empat.php */