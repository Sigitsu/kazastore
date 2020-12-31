<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $data = array(
            'title' => 'KAZASTORE',
            'view'  => 'home/index'
        );

        $this->load->view('layout/index', $data);
    }
}

/* End of file Home.php */
