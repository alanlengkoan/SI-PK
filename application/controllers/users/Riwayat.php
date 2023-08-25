<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends MY_Controller
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
        $this->load->model('m_chat');
        $this->load->model('m_riwayat');
        $this->load->model('m_pemesanan');
        $this->load->model('m_pengantaran');
    }

    // untuk halaman default
    public function index()
    {
        $data = [
            'riwayat' => $this->m_riwayat->getAllByUsers($this->session->userdata('id_users'), 'n'),
        ];

        // untuk load view
        $this->template->page('Riwayat', 'riwayat', 'view', $data);
    }

    // untuk halaman lacak
    public function lacak()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('2'));

        $data = [
            'kd_pemesanan' => $kd_pemesanan,
            'pengantaran'  => $this->m_pengantaran->getPengataranDetail($kd_pemesanan),
        ];

        // untuk load view
        $this->template->page('Lacak', 'riwayat', 'lacak', $data);
    }

    // untuk load rating
    public function load_rating()
    {
        $response = [
            'pemesanan' => $this->m_pemesanan->getRating($this->session->userdata('id_users'))->result(),
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk save rating
    public function save_rating()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'bintang'  => $post['bintang'],
            'komentar' => $post['komentar']
        ];

        $this->db->trans_start();
        $this->crud->u('tb_pemesanan', $data, ['kd_pemesanan' => $post['kd_pemesanan'], 'id_users' => $post['id_users']]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Terdapat kesalahan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Terima Kasih!', 'text' => 'Ulasan Anda telah kami terima!', 'type' => 'success', 'button' => 'Sip!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk load chat
    public function load_chat()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('2'));

        $data = [
            'id_users' => $this->session->userdata('id_users'),
            'chat'     => $this->m_chat->getDetailChat($kd_pemesanan),
        ];

        $this->load->view('home/riwayat/pesan', $data);
    }

    // untuk send chat
    public function send_chat()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'kd_pemesanan' => base64url_decode($post['kd_pemesanan']),
            'id_users'     => $this->session->userdata('id_users'),
            'pesan'        => $post['pesan'],
            'level'        => 'users',
        ];

        $this->crud->i('tb_chat', $data);
    }

    // batal pemesanan
    public function batal()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'status_batal' => 'y'
        ];
        $this->db->trans_start();
        $this->crud->u('tb_pemesanan', $data, ['kd_pemesanan' => $post['kd_pemesanan']]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }
}
