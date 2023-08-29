<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_pemesanan');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load($this->role, 'Pembelian', 'pembelian', 'view');
    }

    // untuk get data pembelian by datatable
    public function get_data_pembelian_dt()
    {
        return $this->m_pemesanan->getAllDataPembelianDt();
    }
}
