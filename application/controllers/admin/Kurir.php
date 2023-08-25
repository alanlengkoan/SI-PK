<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_kurir');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title'   => 'Kurir',
            'content' => 'admin/kurir/view',
            'css'     => 'admin/kurir/css/view',
            'js'      => 'admin/kurir/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_kurir_dt()
    {
        return $this->m_kurir->getAllDataDt();
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
            'roles'    => 'kurir',
        ];
        // data kurir
        $kurir = [
            'id_kurir' => acak_id('tb_kurir', 'id_kurir'),
            'id_users' => $users['id_users'],
        ];
        $this->db->trans_start();
        $this->crud->i('tb_users', $users);
        $this->crud->i('tb_kurir', $kurir);
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

        $data = [
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
        ];
        $this->db->trans_start();
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
        $post   = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_users', ['id_users' => $post['id']]);
        $nma_file = $result['foto'];
        // menghapus foto yg tersimpan
        if ($nma_file !== '' || $nma_file !== null) {
            if (file_exists(upload_path('foto') . $result['foto'])) {
                unlink(upload_path('foto') . $result['foto']);
            }
        }
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
