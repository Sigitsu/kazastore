<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
            'title' => 'LOGIN',
            'view'  => 'auth/login'
        );
        $this->load->view('layout/index', $data);
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');


        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'REGISTRATION',
                'view'  => 'auth/registration'
            );
            $this->load->view('layout/index', $data);
        } else {
            echo 'yuhu';
        }
    }
}

/* End of file Login.php */
