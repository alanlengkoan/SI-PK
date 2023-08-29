<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diskon extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_diskon');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load($this->role, 'Diskon', 'diskon', 'view');
    }

    // untuk get data bank by datatable
    public function get_data_diskon_dt()
    {
        return $this->m_diskon->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_diskon', ['id_diskon' => $post['id']]);
        $response = [
            'id_diskon' => $result['id_diskon'],
            'diskon'    => $result['diskon'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpiddiskon'])) {
            $data = [
                'id_diskon' => acak_id('tb_diskon', 'id_diskon'),
                'diskon'    => $post['inpdiskon'],
            ];

            $this->crud->i('tb_diskon', $data);
        } else {
            $data = [
                'id_diskon' => $post['inpiddiskon'],
                'diskon'    => $post['inpdiskon'],
            ];

            $this->crud->u('tb_diskon', $data, ['id_diskon' => $post['inpiddiskon']]);
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
        $this->crud->d('tb_diskon', $post['id'], 'id_diskon');
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
