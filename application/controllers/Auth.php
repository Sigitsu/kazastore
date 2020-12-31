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
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'matches'     => 'Email belum terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'matches'     => 'Email belum terdaftar'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'LOGIN',
                'view'  => 'auth/login'
            );
            $this->load->view('layout/index', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email'     => $this->input->post('email'),
                        'password'  => $this->input->post('password')

                    ];
                    $this->session->set_userdata($data);
                    if ($user['level'] == 'admin') {
                        redirect('admin');
                    } else {
                        redirect('home');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, password salah</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Maaf, email anda belum di aktivasi. Silakan aktivasi terlebih dahulu</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, email anda belum terdaftar. Silakan daftar</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('nama', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]', [
            'is_unique'     => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]', [
            'matches'       => 'Password tidak sama',
            'min_length'    => 'Password minimal 3 karakter!',
        ]);
        $this->form_validation->set_rules('password_conf', 'Password', 'trim|required|matches[password]');


        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'REGISTRATION',
                'view'  => 'auth/registration'
            );
            $this->load->view('layout/index', $data);
        } else {
            $data = array(
                'nama'      => htmlspecialchars($this->input->post('nama'), true),
                'email'     => htmlspecialchars($this->input->post('email'), true),
                'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'level'     => 'member',
                'is_active' => '1',
                'image'     => 'default.jpg'
            );

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat, akun anda berhasil dibuat. Silakan login</div>');
            redirect('auth');
        }
    }

    public function logout()
    {


        $this->session->unset_userdata('email');
        $this->session->unset_userdata('level');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil logout..</div>');
        redirect('auth');
    }
}

/* End of file Login.php */
