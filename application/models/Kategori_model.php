<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    public function save($data)
    {
        return $this->db->insert('kategori', $data);
    }

    public function get_data()
    {
        return $this->db->get('kategori');
    }
}

/* End of file Kategori_model.php */
