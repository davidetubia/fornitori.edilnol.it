<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accedi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'login');
        $this->userdata = $this->session->userdata('user');
        if($this->userdata){
            redirect('/fornitore');
        }
    }

	public function index()
	{
		$this->load->view('header');
		$this->load->view('accedi');
		$this->load->view('footer');
	}

    public function login()
    {
        $codforn = $this->input->post('codforn');
        $password = $this->input->post('password');
        $userData = $this->login->check_user_exist($codforn, $password);
        print '<pre>';
        print_r($userData);
        if($userData){
            if(isset($userData->password)){
                // utente esiste ma no login
                echo 'utente esiste ma no login';
                redirect('accedi');
            } elseif($userData === true) {
                // utente e login ok
                echo 'utente e login ok';
                redirect('fornitore');
            } else {
                echo 'utente non registrato';
            }
        } elseif($userData === false){
            echo 'non registrato';
            // $this->session->set_flashdata('codforn', $userData->conto);
            // redirect('registrati');
        } elseif($userData === null){
            // utente non esistente
            echo 'utente non esistente';
            redirect('accedi');
        } else {
            echo 'non registrato';
        }
    }

    public function notfound()
    {

    }

    public function recupero()
    {
        $this->load->view('header');
		$this->load->view('recupero');
		$this->load->view('footer');
    }
}
