<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba_dua extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('template');
	}

	public function index()
	{
		$this->template->authlogin('r',1);
		$data = array(
			'hi' => "Coba Dua",
			'url' => 'coba_dua'
			);
		$this->template->set('title',"Coba Dua Read bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function update($value='')
	{
		$this->template->authlogin('u',2);
		$data = array(
			'hi' => "Halaman Update Coba Dua",
			'url' => 'coba_dua'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function create($value='')
	{
		$this->template->authlogin('c',2);
		$data = array(
			'hi' => "Halaman Create Coba Dua",
			'url' => 'coba_dua'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function delete($value='')
	{
		$this->template->authlogin('d',2);
		$data = array(
			'hi' => "Halaman Delete Coba Dua",
			'url' => 'coba_dua'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function upload($value='')
	{
		$this->template->authlogin('y',2);
		$data = array(
			'hi' => "Halaman upload Coba Dua",
			'url' => 'coba_dua'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

}

/* End of file Coba_dua.php */
/* Location: ./application/controllers/Coba_dua.php */