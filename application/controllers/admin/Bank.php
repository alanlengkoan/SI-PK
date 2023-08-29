<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_bank');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load($this->role, 'Bank', 'bank', 'view');
    }

    // untuk get data bank by datatable
    public function get_data_bank_dt()
    {
        return $this->m_bank->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_bank', ['id_bank' => $post['id']]);
        $response = [
            'id_bank'  => $result['id_bank'],
            'nama'     => $result['nama'],
            'rekening' => $result['rekening'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpidbank'])) {
            $data = [
                'id_bank'  => acak_id('tb_bank', 'id_bank'),
                'nama'     => $post['inpnama'],
                'rekening' => $post['inprekening'],
            ];

            $this->crud->i('tb_bank', $data);
        } else {
            $data = [
                'id_bank'  => $post['inpidbank'],
                'nama'     => $post['inpnama'],
                'rekening' => $post['inprekening'],
            ];

            $this->crud->u('tb_bank', $data, ['id_bank' => $post['inpidbank']]);
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
        $this->crud->d('tb_bank', $post['id'], 'id_bank');
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
