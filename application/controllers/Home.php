<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
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
        $this->load->model('m_slide');
        $this->load->model('m_produk');
        $this->load->model('m_kategori');
    }

    public function index()
    {
        $bulan = (int) date('m');

        $data = [
            'slide'                  => $this->m_slide->getAll(),
            'p_laris'                => $this->m_produk->getLaris(),
            'p_laris_bulan_sekarang' => $this->m_produk->getLarisMonth($bulan),
        ];

        // untuk load view
        $this->template->page('Home', 'home', 'view', $data);
    }

    public function tentang()
    {
        // untuk load view
        $this->template->page('Tentang Kami', 'tentang', 'view');
    }

    public function kontak()
    {
        // untuk load view
        $this->template->page('Kontak Kami', 'kontak', 'view');
    }

    public function panduan()
    {
        // untuk load view
        $this->template->page('Panduan', 'panduan', 'view');
    }

    public function diskon()
    {
        $diskon = $this->uri->segment('2');

        $data = [
            'title' => 'Diskon',
            'content' => 'home/diskon/view',
            'produk'  => $this->m_produk->getDiskon($diskon),
            'css'     => '',
            'js'      => 'home/diskon/js/view'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }
}
