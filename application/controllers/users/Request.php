<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk mengecek status login
        if (!empty($this->session->userdata('username'))) {
            checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['users']);
        }

        // untuk load model
        $this->load->model('crud');
    }

    // untuk halaman default
    public function index()
    {
        $data = [
            'title'   => 'Request',
            'content'   => 'home/request/view',
            'css'       => '',
            'js'        => 'home/request/js/view'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk tambah rewuest
    public function add()
    {
        $post = $this->input->post(NULL, TRUE);

        $config['upload_path']   = './' . upload_path('gambar');
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name']  = TRUE;
        $config['overwrite']     = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('inpgambar')) {
            // apa bila gagal
            $error = array('error' => $this->upload->display_errors());

            $response = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
        } else {
            // apa bila berhasil
            $detailFile = $this->upload->data();

            // update transfer
            $data = [
                'id_request' => acak_id('tb_request', 'id_request'),
                'id_users'   => $this->session->userdata('id_users'),
                'jenis'      => $post['inpjenis'],
                'gambar'     => $detailFile['file_name'],
                'keterangan' => $post['inpketerangan'],
            ];

            $this->db->trans_start();
            $this->crud->i('tb_request', $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }
        // untuk response json
        $this->_response($response);
    }
}
