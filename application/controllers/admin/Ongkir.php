<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ongkir extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_ongkir');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title'   => 'Ongkos Kirim',
            'content' => 'admin/ongkir/view',
            'css'     => 'admin/ongkir/css/view',
            'js'      => 'admin/ongkir/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data ongkir by datatable
    public function get_data_ongkir_dt()
    {
        return $this->m_ongkir->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result   = $this->crud->gda('tb_ongkir', ['id_ongkir' => $post['id']]);
        $response = [
            'id_ongkir' => $result['id_ongkir'],
            'lokasi'    => $result['lokasi'],
            'tarif'     => create_separator($result['tarif']),
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['inpidongkir'])) {
            $data = [
                'id_ongkir' => acak_id('tb_ongkir', 'id_ongkir'),
                'lokasi'    => $post['inplokasi'],
                'tarif'     => remove_separator($post['inptarif']),
            ];

            $this->crud->i('tb_ongkir', $data);
        } else {
            $data = [
                'id_ongkir' => $post['inpidongkir'],
                'lokasi'    => $post['inplokasi'],
                'tarif'     => remove_separator($post['inptarif']),
            ];

            $this->crud->u('tb_ongkir', $data, ['id_ongkir' => $post['inpidongkir']]);
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
        $this->crud->d('tb_ongkir', $post['id'], 'id_ongkir');
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
