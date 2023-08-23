<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meja extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_meja');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title'   => 'Meja',
            'content' => 'admin/meja/view',
            'css'     => 'admin/meja/css/view',
            'js'      => 'admin/meja/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_dt()
    {
        return $this->m_meja->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result   = $this->crud->gda('tb_meja', ['id_meja' => $post['id']]);
        $response = [
            'id_meja'      => $result['id_meja'],
            'no_meja'      => $result['no_meja'],
            'jumlah_kursi' => $result['jumlah_kursi'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['id_meja'])) {
            $data = [
                'id_meja'      => acak_id('tb_meja', 'id_meja'),
                'no_meja'      => $post['no_meja'],
                'jumlah_kursi' => $post['jumlah_kursi'],
            ];

            $this->crud->i('tb_meja', $data);
        } else {
            $data = [
                'id_meja'      => $post['id_meja'],
                'no_meja'      => $post['no_meja'],
                'jumlah_kursi' => $post['jumlah_kursi'],
            ];

            $this->crud->u('tb_meja', $data, ['id_meja' => $post['id_meja']]);
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
        $this->crud->d('tb_meja', $post['id'], 'id_meja');
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
