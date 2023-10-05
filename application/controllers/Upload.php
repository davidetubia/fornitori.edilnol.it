<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('listini_model', 'listini');
    }

	public function expert()
	{
        $listino = $_FILES['listino'];
        print_r($this->listini->check_file($listino));
	}
    
	public function basic()
	{
        $listino = $_FILES['listino'];
        $id_fornitore = $this->session->userdata('user')->conto;
        echo $this->listini->check_base($listino, $id_fornitore);
	}
}