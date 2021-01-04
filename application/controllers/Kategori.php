<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
    }


    public function index()
    {
        $data = [
            'title'     => 'Halaman Kategori',
            'view'      => 'kategori/index',
            'kategori'  => $this->Kategori_model->get_data()->result()
        ];
        $this->load->view('layout/index_admin', $data);
    }

    public function save()
    {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori'),
            'slug'          => $this->input->post('slug')
        ];
        $query = $this->Kategori_model->save($data);
        if ($query) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di input</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal di input</div>');
        }
        redirect('kategori');
    }
}

/* End of file Kategori.php */
