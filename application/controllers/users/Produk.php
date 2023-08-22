<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // untuk mengecek status login
        if (!empty($this->session->userdata('username'))) {
            checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['users']);
        }

        // untuk load model
        $this->load->model('m_produk');
        $this->load->model('m_topper');
        $this->load->model('m_keranjang');
        $this->load->model('m_produk_cake');
        $this->load->model('m_produk_dessert');
    }

    // untuk halaman default
    public function index()
    {
        $data = [
            'title'   => 'Cake & Dessert',
            'p_cake'    => $this->m_produk_cake->getAll(),
            'p_dessert' => $this->m_produk_dessert->getAll(),
            'content'   => 'home/produk/view',
            'css'       => '',
            'js'        => 'home/produk/js/view'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk detail produk
    public function detail()
    {
        $kd_produk = base64url_decode($this->uri->segment('3'));

        $data = [
            'title'         => 'Produk Detail',
            'produk'          => $this->m_produk->getProdukDetail($kd_produk),
            'produk_komentar' => $this->m_produk->getProdukCommentar($kd_produk),
            'produk_topper'   => $this->m_topper->getAll(),
            'content'         => 'home/produk/detail',
            'css'             => '',
            'js'              => 'home/produk/js/detail'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk halaman default
    public function cake()
    {
        $data = [
            'title'   => 'Cake',
            'p_cake'    => $this->m_produk_cake->getAll(),
            'content'   => 'home/produk/cake',
            'css'       => '',
            'js'        => 'home/produk/js/cake'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk halaman default
    public function dessert()
    {
        $data = [
            'title'   => 'Dessert',
            'p_dessert' => $this->m_produk_dessert->getAll(),
            'content'   => 'home/produk/dessert',
            'css'       => '',
            'js'        => 'home/produk/js/dessert'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk detail produk topper
    public function topper()
    {
        $data = [
            'title'        => 'Topper',
            'produk_topper'  => $this->m_topper->getAll(),
            'keranjang_cake' => $this->m_keranjang->getBuyCustomerKeranjangCake($this->session->userdata('id_users')),
            'content'        => 'home/produk/topper',
            'css'            => '',
            'js'             => 'home/produk/js/topper'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk detail produk topper
    public function topper_detail()
    {
        $kd_topper = base64url_decode($this->uri->segment('3'));

        $data = [
            'title'        => 'Topper Detail',
            'content'        => 'home/produk/topper_detail',
            'produk_topper'  => $this->m_topper->getTopperDetail($kd_topper),
            'keranjang_cake' => $this->m_keranjang->getBuyCustomerKeranjangCake($this->session->userdata('id_users')),
            'css'            => '',
            'js'             => 'home/produk/js/topper_detail'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }
}
