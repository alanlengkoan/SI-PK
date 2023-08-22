<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_satuan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title' => 'Satuan',
            'content' => 'admin/satuan/view',
            'css'     => 'admin/satuan/css/view',
            'js'      => 'admin/satuan/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_satuan_dt()
    {
        return $this->m_satuan->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_satuan', ['id_satuan' => $post['id']]);
        $response = [
            'id_satuan' => $result['id_satuan'],
            'kd_satuan' => $result['kd_satuan'],
            'nama'      => $result['nama'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpidsatuan'])) {
            $data = [
                'id_satuan' => acak_id('tb_satuan', 'id_satuan'),
                'kd_satuan' => $post['inpkdsatuan'],
                'nama'      => $post['inpnama'],
            ];

            $this->crud->i('tb_satuan', $data);
        } else {
            $data = [
                'id_satuan' => $post['inpidsatuan'],
                'kd_satuan' => $post['inpkdsatuan'],
                'nama'      => $post['inpnama'],
            ];

            $this->crud->u('tb_satuan', $data, ['id_satuan' => $post['inpidsatuan']]);
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
        $this->crud->d('tb_satuan', $post['id'], 'id_satuan');
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
