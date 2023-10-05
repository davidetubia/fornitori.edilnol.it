<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inizio extends CI_Controller {
	public function index()
	{
		$this->load->view('header');
		$this->load->view('index');
		$this->load->view('footer');
	}

	public function accedi()
	{
		$this->load->view('header');
		$this->load->view('accedi');
		$this->load->view('footer');
	}

	public function registrati()
	{
		$this->load->view('header');
		$this->load->view('registrati');
		$this->load->view('footer');
	}
}
