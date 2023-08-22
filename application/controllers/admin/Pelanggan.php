<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pelanggan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title' => 'Pelanggan',
            'content' => 'admin/pelanggan/view',
            'css'     => 'admin/pelanggan/css/view',
            'js'      => 'admin/pelanggan/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_pelanggan_dt()
    {
        return $this->m_pelanggan->getAllDataDt();
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
