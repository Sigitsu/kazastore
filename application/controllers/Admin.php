<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Admin-Dashboard',
            'view'  => 'admin/index'
        ];

        $this->load->view('layout/index_admin', $data);
    }
}

/* End of file Admin.php */
