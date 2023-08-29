<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_cod');
        $this->load->model('m_chat');
        $this->load->model('m_kurir');
        $this->load->model('m_transfer');
        $this->load->model('m_pemesanan');
        $this->load->model('m_pengantaran');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load($this->role, 'Pemesanan', 'pemesanan', 'view');
    }

    // untuk halaman bayar
    public function bayar()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));

        $data = [
            'title'        => 'Bayar',
            'kd_pemesanan' => $kd_pemesanan,
            'pembayaran'   => $this->m_cod->getDetail($kd_pemesanan)->row(),
            'total'        => $this->m_pemesanan->getTotalPemesananDetail($kd_pemesanan)->row('total'),
            'content'      => 'admin/pemesanan/bayar',
            'css'          => '',
            'js'           => 'admin/pemesanan/js/bayar'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    public function get_data_pemesanan_dt()
    {
        return $this->m_pemesanan->getAllDataDt('n');
    }

    public function get_data_kurir_dt()
    {
        return $this->m_kurir->getAllDataDt();
    }

    // untuk detail pemesanan
    public function detail()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));

        // untuk data pemesanan
        $get_pemesanan = $this->m_pemesanan->getPemesananAdmin($kd_pemesanan);
        $row_pemesanan = $get_pemesanan->row();

        // untuk data pemesanan detail
        $get_pemesanan_detail = $this->m_pemesanan->getPemesananDetail($kd_pemesanan);

        // mengecek metode pembayaran
        if ($row_pemesanan->metode_pembayaran == 'c') {
            // metode pembayaran cod
            $get_pembayaran = $this->m_cod->getDetail($kd_pemesanan);
        } else {
            // metode pembayaran transfer
            $get_pembayaran = $this->m_transfer->getDetail($kd_pemesanan);
        }

        $data = [
            'title'                 => 'Detail',
            'data_pemesanan'        => $get_pemesanan->row(),
            'data_pemesanan_detail' => $get_pemesanan_detail->result(),
            'data_pembayaran'       => $get_pembayaran->row(),
            'content'               => 'admin/pemesanan/detail',
            'css'                   => '',
            'js'                    => 'admin/pemesanan/js/detail'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk halaman cetak
    public function cetak()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));

        // untuk data pemesanan
        $get_pemesanan = $this->m_pemesanan->getPemesananAdmin($kd_pemesanan);
        $row_pemesanan = $get_pemesanan->row();

        // untuk data pemesanan detail
        $get_pemesanan_detail = $this->m_pemesanan->getPemesananDetail($kd_pemesanan);

        // mengecek metode pembayaran
        if ($row_pemesanan->metode_pembayaran == 'c') {
            // metode pembayaran cod
            $get_pembayaran = $this->m_cod->getDetail($kd_pemesanan);
        } else {
            // metode pembayaran transfer
            $get_pembayaran = $this->m_transfer->getDetail($kd_pemesanan);
        }

        $data = [
            'data_pemesanan'        => $get_pemesanan->row(),
            'data_pemesanan_detail' => $get_pemesanan_detail->result(),
            'data_pembayaran'       => $get_pembayaran->row(),
        ];
        // untuk load view
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('nota', 'admin/pemesanan/print', $data);
    }

    // untuk lacak pemesanan
    public function lacak()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));

        $data = [
            'title'        => 'Lacak',
            'kd_pemesanan' => $kd_pemesanan,
            'pengantaran'  => $this->m_pengantaran->getPengataranDetail($kd_pemesanan),
            'content'      => 'admin/pemesanan/lacak',
            'css'          => 'admin/pemesanan/css/lacak',
            'js'           => 'admin/pemesanan/js/lacak'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk ulasan pemesanan
    public function ulasan()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));

        $ulasan = $this->crud->gda('tb_pemesanan', ['kd_pemesanan' => $kd_pemesanan]);

        $data = [
            'title'   => 'Ulasan',
            'ulasan'  => $ulasan,
            'content' => 'admin/pemesanan/ulasan',
            'css'     => '',
            'js'      => ''
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk pembayaran cod | jemput
    public function pembayaran_b()
    {
        $post = $this->input->post(NULL, TRUE);

        $config['upload_path']   = './' . upload_path('gambar');
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name']  = TRUE;
        $config['overwrite']     = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('inpbukti')) {
            // apa bila gagal
            $error = array('error' => $this->upload->display_errors());

            $response = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
        } else {
            // apa bila berhasil
            $detailFile = $this->upload->data();

            $this->db->trans_start();
            // untuk update tabel cod
            $cod = [
                'nama_bayar'    => $post['inpnamapenyetor'],
                'jumlah_bayar'  => remove_separator($post['inpjumlahbayar']),
                'tanggal_bayar' => date('Y-m-d H:i:s'),
                'bukti'         => $detailFile['file_name']
            ];
            $this->crud->u('tb_cod', $cod, ['kd_pemesanan' => $post['inpkdorder']]);

            // untuk update tabel pemesanan
            $pemesanan = [
                'status_pembayaran' => '1',
            ];
            $this->crud->u('tb_pemesanan', $pemesanan, ['kd_pemesanan' => $post['inpkdorder']]);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk pembayaran transfer | 
    public function pembayaran()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'jumlah_transfer' => remove_separator($post['inpjumlahtransfer']),
        ];
        $this->db->trans_start();
        $this->crud->u('tb_transfer', $data, ['kd_pemesanan' => $post['inpkdorder']]);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk terima barang
    public function setor()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        // untuk update tabel pemesanan
        $pemesanan = [
            'status_pengantaran' => '2',
        ];
        $this->crud->u('tb_pemesanan', $pemesanan, ['kd_pemesanan' => $post['id']]);

        // untuk insert tabel pengantaran detail
        $pengantaran_detail = [
            'kd_pemesanan' => $post['id'],
            'status'       => '2',
        ];
        $this->crud->i('tb_pengantaran_detail', $pengantaran_detail);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk batal transaksi
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

    public function pilih_kurir()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        // untuk update tabel pemesanan
        $pemesanan = [
            'status_pengantaran' => '1',
            'pilih_kurir'        => 'y'
        ];
        $this->crud->u('tb_pemesanan', $pemesanan, ['kd_pemesanan' => $post['kd_pemesanan']]);

        // untuk insert tabel pengantaran
        $pengantaran = [
            'kd_pemesanan' => $post['kd_pemesanan'],
            'id_users'     => $post['id_users'],
            'status_lihat' => 'belum-lihat'
        ];
        $this->crud->i('tb_pengantaran', $pengantaran);

        // untuk insert tabel pengantaran detail
        $pengantaran_detail = [
            'kd_pemesanan' => $post['kd_pemesanan'],
            'status'       => '1',
        ];
        $this->crud->i('tb_pengantaran_detail', $pengantaran_detail);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk load chat
    public function load_chat()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));

        $data = [
            'id_users' => $this->session->userdata('id_users'),
            'chat'     => $this->m_chat->getDetailChat($kd_pemesanan),
        ];

        $this->load->view('admin/pemesanan/pesan', $data);
    }

    // untuk send chat
    public function send_chat()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'kd_pemesanan' => base64url_decode($post['kd_pemesanan']),
            'id_users'     => $this->session->userdata('id_users'),
            'pesan'        => $post['pesan'],
            'level'        => 'admin',
        ];

        $this->crud->i('tb_chat', $data);
    }
}
