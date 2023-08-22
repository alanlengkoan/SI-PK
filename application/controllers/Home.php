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
        $this->load->model('m_produk_cake');
        $this->load->model('m_produk_dessert');
    }

    public function index()
    {
        $bulan = (int) date('m');

        $data = [
            'title'                => 'Home',
            'content'                => 'home/home/view',
            'slide'                  => $this->m_slide->getAll(),
            'p_laris'                => $this->m_produk->getLaris(),
            'p_laris_bulan_sekarang' => $this->m_produk->getLarisMonth($bulan),
            'css'                    => '',
            'js'                     => 'home/home/js/view'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    public function tentang()
    {
        $data = [
            'title' => 'Tentang Kami',
            'content' => 'home/tentang/view',
            'css'     => '',
            'js'      => ''
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    public function kontak()
    {
        $data = [
            'title' => 'Kontak Kami',
            'content' => 'home/kontak/view',
            'css'     => '',
            'js'      => 'home/kontak/js/view'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    public function panduan()
    {
        $data = [
            'title' => 'Panduan',
            'content' => 'home/panduan/view',
            'css'     => '',
            'js'      => ''
        ];
        // untuk load view
        $this->load->view('home/base', $data);
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
