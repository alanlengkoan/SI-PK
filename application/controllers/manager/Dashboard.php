<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['manager']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_kurir');
        $this->load->model('m_produk');
        $this->load->model('m_pelanggan');
        $this->load->model('m_pemesanan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'produk'    => count($this->m_produk->getAll()),
            'pelanggan' => $this->m_pelanggan->getAll()->num_rows(),
            'kurir'     => $this->m_kurir->getAll()->num_rows(),
        ];

        // untuk load view
        $this->template->load($this->role, 'Dashboard Manager', 'dashboard', 'view', $data);
    }

    // untuk ambil produk sering dibeli
    public function get_best_produk()
    {
        $get = $this->m_produk->getBestProduk();
        $num = $get->num_rows();
        $res = [];

        if ($num > 0) {
            foreach ($get->result() as $val) {
                $res[] = [$val->nama, (int) $val->jumlah];
            }
        }
        // untuk respon json
        $this->_response($res);
    }

    // untuk ambil produk sering dibeli
    public function get_best_customer()
    {
        $get = $this->m_pelanggan->getBestCustomer();
        $num = $get->num_rows();
        $res = [];

        if ($num > 0) {
            foreach ($get->result() as $val) {
                $res[] = [$val->nama, (int) $val->jumlah];
            }
        }
        // untuk respon json
        $this->_response($res);
    }
}
