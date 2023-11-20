<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_cod');
        $this->load->model('m_transfer');
        $this->load->model('m_pemesanan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'pemesanan' => $this->_getPemesanan(),
        ];

        // untuk load view
        $this->template->load($this->role, 'Pembayaran', 'pembayaran', 'view', $data);
    }

    public function get_pemesanan()
    {
        $post = $this->input->post(NULL, TRUE);

        $kd_pemesanan = $post['id'];

        $get_pemesanan = $this->m_pemesanan->getPemesananAdmin($kd_pemesanan);
        $row_pemesanan = $get_pemesanan->row();

        if ($row_pemesanan->metode_pembayaran == 'c') {
            // metode pembayaran cod
            $bayar = $this->m_cod->getTotalBayar($kd_pemesanan)->row('total');
        } else {
            // metode pembayaran transfer
            $bayar = $this->m_transfer->getTotalBayar($kd_pemesanan)->row('total');
        }

        $total = $this->m_pemesanan->getTotalPemesananDetail($kd_pemesanan)->row('total');

        $sisah = ($total - $bayar);

        $response = [
            'metode_pembayaran' => ($row_pemesanan->metode_pembayaran === 'c' ? 'Tunai' : 'Transfer'),
            'total'             => create_separator($sisah)
        ];

        $this->_response($response);
    }

    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $kd_pemesanan = $post['kd_pemesanan'];

        $get_pemesanan = $this->m_pemesanan->getPemesananAdmin($kd_pemesanan);
        $row_pemesanan = $get_pemesanan->row();

        $this->db->trans_start();
        if ($row_pemesanan->metode_pembayaran == 'c') {
            // metode pembayaran cod
            $cod = [
                'kd_pemesanan'  => $post['kd_pemesanan'],
                'jumlah_bayar'  => $post['bayar'],
                'tanggal_bayar' => date('Y-m-d H:i:s'),
            ];
            $this->crud->i('tb_cod', $cod);
        } else {
            // metode pembayaran transfer
            $transfer = [
                'kd_pemesanan'     => $post['kd_pemesanan'],
                'jumlah_transfer'  => $post['bayar'],
                'tanggal_transfer' => date('Y-m-d H:i:s'),
            ];
            $this->crud->i('tb_transfer', $transfer);
        }

        // update pemesanan
        $pemesanan = [
            'status_pembayaran' => '1'
        ];
        $this->crud->u('tb_pemesanan', $pemesanan, ['kd_pemesanan' => $post['kd_pemesanan']]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        
        // untuk response json
        $this->_response($response);
    }

    public function _getPemesanan()
    {
        $get_pemesanan = $this->m_pemesanan->getPemesananPembayaran();

        $result = [];
        foreach ($get_pemesanan as $key => $value) {
            if ($value->metode_pembayaran == 'c') {
                // metode pembayaran cod
                $bayar = $this->m_cod->getTotalBayar($value->kd_pemesanan)->row('total');
            } else {
                // metode pembayaran transfer
                $bayar = $this->m_transfer->getTotalBayar($value->kd_pemesanan)->row('total');
            }

            $total = $this->m_pemesanan->getTotalPemesananDetail($value->kd_pemesanan)->row('total');

            $sisah = ($total - $bayar);

            if ($sisah > 0) {
                $result[] = [
                    'id_users'           => $value->id_users,
                    'kd_pemesanan'       => $value->kd_pemesanan,
                    'metode_pembayaran'  => $value->metode_pembayaran,
                    'metode_pemesanan'   => $value->metode_pemesanan,
                    'nama'               => $value->nama,
                    'email'              => $value->email,
                    'telepon'            => $value->telepon,
                    'tgl_pemesanan'      => $value->tgl_pemesanan,
                    'jam_pemesanan'      => $value->jam_pemesanan,
                    'status_pembayaran'  => $value->status_pembayaran,
                    'status_pengantaran' => $value->status_pengantaran,
                    'kelamin'            => $value->kelamin,
                    'alamat'             => $value->alamat,
                    'tarif'              => $value->tarif,
                    'no_meja'            => $value->no_meja,
                    'jumlah_kursi'       => $value->jumlah_kursi,
                ];
            }
        }

        return $result;
    }
}
