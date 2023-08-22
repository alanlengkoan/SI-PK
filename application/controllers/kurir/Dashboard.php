<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['kurir']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pemesanan');
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Kurir',
            'no'      => $this->m_pemesanan->getPemesananNo($this->session->userdata('id_users'))->num_rows(),
            'yes'     => $this->m_pemesanan->getPemesananYes($this->session->userdata('id_users'))->num_rows(),
            'content' => 'kurir/dashboard/view',
            'css'     => '',
            'js'      => ''
        ];
        // untuk load view
        $this->load->view('kurir/base', $data);
    }

    // untuk load pemberitahuan
    public function load_notification()
    {
        $get = $this->m_pemesanan->getNotifikasiKurir($this->session->userdata('id_users'));
        $num = $get->num_rows();

        $response = [
            'count'  => $num,
            'result' => $get->result()
        ];

        // untuk response json
        $this->_response($response);
    }

    // untuk read notification
    public function read_notification()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'status_lihat' => 'lihat'
        ];

        $this->crud->u('tb_pengantaran', $data, ['kd_pemesanan' => $post['kd_pemesanan']]);
    }
}
