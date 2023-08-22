<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

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
            'title'   => 'Dashboard Admin',
            'produk'    => $this->m_produk->getAll()->num_rows(),
            'pelanggan' => $this->m_pelanggan->getAll()->num_rows(),
            'kurir'     => $this->m_kurir->getAll()->num_rows(),
            'content'   => 'admin/dashboard/view',
            'css'       => 'admin/dashboard/css/view',
            'js'        => 'admin/dashboard/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk load pemberitahuan
    public function load_notification()
    {
        $get = $this->m_pemesanan->getNotifikasiAdmin();
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

        $this->crud->u('tb_pemesanan', $data, ['kd_pemesanan' => $post['kd_pemesanan']]);
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
