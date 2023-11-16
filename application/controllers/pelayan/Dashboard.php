<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['pelayan']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pemesanan');
    }

    public function index()
    {
        $data = [
            'no'  => $this->m_pemesanan->getPemesananNo($this->id_users)->num_rows(),
            'yes' => $this->m_pemesanan->getPemesananYes($this->id_users)->num_rows(),
        ];

        // untuk load view
        $this->template->load($this->role, 'Dashboard Pelayan', 'dashboard', 'view', $data);
    }

    // untuk load pemberitahuan
    public function load_notification()
    {
        $get = $this->m_pemesanan->getNotifikasiKurir($this->id_users);
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
