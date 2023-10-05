<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornitore extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->userdata = $this->session->userdata('user');
        if(!$this->userdata){
            redirect('/');
        }
    }

	public function index()
	{
		$this->load->view('header');
		$this->load->view('fornitore/index');
		$this->load->view('footer');
	}

    public function profilo()
    {
		$this->load->view('header');
		$this->load->view('fornitore/profilo');
		$this->load->view('footer');
    }
}
