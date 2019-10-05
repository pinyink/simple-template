<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba_lima extends CI_Controller {

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
		$this->template->authlogin('r',5);
		$data = array(
			'hi' => "Coba lima",
			'url' => 'coba_lima'
			);
		$this->template->set('title',"Coba lima Read bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function update($value='')
	{
		$this->template->authlogin('u',5);
		$data = array(
			'hi' => "Halaman Update Coba lima",
			'url' => 'coba_lima'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function create($value='')
	{
		$this->template->authlogin('c',5);
		$data = array(
			'hi' => "Halaman Create Coba lima",
			'url' => 'coba_lima'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function delete($value='')
	{
		$this->template->authlogin('d',5);
		$data = array(
			'hi' => "Halaman Delete Coba lima",
			'url' => 'coba_lima'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

	public function upload($value='')
	{
		$this->template->authlogin('y',5);
		$data = array(
			'hi' => "Halaman upload Coba lima",
			'url' => 'coba_lima'
			);
		$this->template->set('title',"home bro");
		$this->template->adminlte('layouts/home', $data);
	}

}

/* End of file Coba_lima.php */
/* Location: ./application/controllers/Coba_lima.php */