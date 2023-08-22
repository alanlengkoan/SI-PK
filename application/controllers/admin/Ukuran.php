<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ukuran extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_ukuran');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title' => 'Ukuran',
            'content' => 'admin/ukuran/view',
            'css'     => 'admin/ukuran/css/view',
            'js'      => 'admin/ukuran/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_ukuran_dt()
    {
        return $this->m_ukuran->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_ukuran', ['id_ukuran' => $post['id']]);
        $response = [
            'id_ukuran' => $result['id_ukuran'],
            'nama'      => $result['nama'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'nama'      => $post['inpnama'],
        ];

        $this->db->trans_start();
        if (empty($post['inpidukuran'])) {
            $this->crud->i('tb_ukuran', $data);
        } else {
            $this->crud->u('tb_ukuran', $data, ['id_ukuran' => $post['inpidukuran']]);
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
        $this->crud->d('tb_ukuran', $post['id'], 'id_ukuran');
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
