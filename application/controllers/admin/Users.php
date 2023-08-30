<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_users');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load($this->role, 'Users', 'users', 'view');
    }

    // untuk get data bank by datatable
    public function get_data_dt()
    {
        return $this->m_users->getAllDataDt();
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['id_users'])) {
            $data = [
                'id_users' => acak_id('tb_users', 'id_users'),
                'nama'     => $post['nama'],
                'email'    => $post['email'],
                'username' => $post['username'],
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'roles'    => $post['roles'],
                'status'   => '1'
            ];

            $this->crud->i('tb_users', $data);
        } else {
            $data = [
                'id_users'  => $post['id_users'],
                'nama'      => $post['nama'],
                'email'     => $post['email'],
                'username'  => $post['username'],
                'roles'     => $post['roles'],
            ];

            $this->crud->u('tb_users', $data, ['id_users' => $post['inpidbank']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk reset password
    public function reset_password()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $data = [
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
        ];
        $this->crud->u('tb_users', $data, ['id_users' => $post['id']]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk status akun
    public function status()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $data = [
            'status' => $post['status'] == '1' ? '0' : '1',
        ];
        $this->crud->u('tb_users', $data, ['id_users' => $post['id']]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_users', $post['id'], 'id_users');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }
}
