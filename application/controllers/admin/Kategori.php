<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_kategori');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load($this->role, 'Kategori', 'kategori', 'view');
    }

    // untuk get data bank by datatable
    public function get_data_dt()
    {
        return $this->m_kategori->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result   = $this->crud->gda('tb_kategori', ['id_kategori' => $post['id']]);
        $response = [
            'id_kategori' => $result['id_kategori'],
            'nama'        => $result['nama'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['id_kategori'])) {
            $data = [
                'id_kategori' => acak_id('tb_kategori', 'id_kategori'),
                'nama'        => $post['nama'],
            ];

            $this->crud->i('tb_kategori', $data);
        } else {
            $data = [
                'id_kategori' => $post['id_kategori'],
                'nama'        => $post['nama'],
            ];

            $this->crud->u('tb_kategori', $data, ['id_kategori' => $post['id_kategori']]);
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

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_kategori', $post['id'], 'id_kategori');
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
