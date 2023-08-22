<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_pemesanan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title' => 'Pembelian',
            'content' => 'admin/pembelian/view',
            'css'     => 'admin/pembelian/css/view',
            'js'      => 'admin/pembelian/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data pembelian by datatable
    public function get_data_pembelian_dt()
    {
        return $this->m_pemesanan->getAllDataPembelianDt();
    }
}
