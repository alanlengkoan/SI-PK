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
        $this->load->model('m_keranjang');
    }

    // untuk halaman default
    public function index()
    {
        $data = [
            'produk' => $this->m_produk->getAll(),
        ];

        // untuk load view
        $this->template->page('Produk', 'produk', 'view', $data);
    }

    // untuk detail produk
    public function detail()
    {
        $kd_produk = base64url_decode($this->uri->segment('3'));

        $data = [
            'produk'          => $this->m_produk->getProdukWhere('p.kd_produk', $kd_produk)->row(),
            'produk_komentar' => $this->m_produk->getProdukCommentar($kd_produk),
        ];

        // untuk load view
        $this->template->page('Produk Detail', 'produk', 'detail', $data);
    }

    // untuk halaman default
    public function kategori()
    {
        $id_kategori = $this->uri->segment('3');

        $data = [
            'produk' => $this->m_produk->getProdukWhere('p.id_kategori', $id_kategori)->result(),
        ];

        // untuk load view
        $this->template->page('Produk Kategori', 'produk', 'kategori', $data);
    }
}
