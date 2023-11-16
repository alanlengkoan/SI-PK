<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelayan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_pelayan');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load($this->role, 'Pelayan', 'pelayan', 'view');
    }

    // untuk get data bank by datatable
    public function get_data_kurir_dt()
    {
        return $this->m_pelayan->getAllDataDt();
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        // data users
        $users = [
            'id_users' => acak_id('tb_users', 'id_users'),
            'nama'     => $post['inpnama'],
            'email'    => $post['inpemail'],
            'username' => $post['inpusername'],
            'password' => password_hash($post['inppassword'], PASSWORD_DEFAULT),
            'roles'    => 'pelayan',
        ];
        // data kurir
        $kurir = [
            'id_pelayan' => acak_id('tb_pelayan', 'id_pelayan'),
            'id_users' => $users['id_users'],
        ];
        $this->db->trans_start();
        $this->crud->i('tb_users', $users);
        $this->crud->i('tb_pelayan', $kurir);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }
}
