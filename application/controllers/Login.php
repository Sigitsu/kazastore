<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {
        $data['view'] = 'login/index';
        $this->load->view('layout/index', $data);
    }
}

/* End of file Login.php */
