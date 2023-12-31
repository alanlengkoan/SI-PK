<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['kurir']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_cod');
        $this->load->model('m_pemesanan');
    }

    // untuk default
    public function index()
    {
        $data = [
            'pemesanan' => $this->m_pemesanan->getPemesananKurir($this->session->userdata('id_users')),
        ];

        // untuk load view
        $this->template->load($this->role, 'Pemesanan', 'pemesanan', 'view', $data);
    }

    // untuk detail pemesanan
    public function detail()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));

        // untuk data pemesanan
        $get_pemesanan = $this->m_pemesanan->getPemesananAdmin($kd_pemesanan);

        // untuk data pemesanan detail
        $get_pemesanan_detail = $this->m_pemesanan->getPemesananDetail($kd_pemesanan);

        $data = [
            'data_pemesanan'        => $get_pemesanan->row(),
            'data_pemesanan_detail' => $get_pemesanan_detail->result(),
        ];

        // untuk load view
        $this->template->load($this->role, 'Detail', 'pemesanan', 'detail', $data);
    }

    // untuk halaman cetak
    public function cetak()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));

        // untuk data pemesanan
        $get_pemesanan = $this->m_pemesanan->getPemesananAdmin($kd_pemesanan);

        // untuk data pemesanan detail
        $get_pemesanan_detail = $this->m_pemesanan->getPemesananDetail($kd_pemesanan);

        $data = [
            'data_pemesanan'        => $get_pemesanan->row(),
            'data_pemesanan_detail' => $get_pemesanan_detail->result(),
        ];
        // untuk load view
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('nota', 'kurir/pemesanan/print', $data);
    }

    // untuk bayar
    public function cod()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));

        $bayar = $this->m_cod->getTotalBayar($kd_pemesanan)->row('total');
        $total = $this->m_pemesanan->getTotalPemesananDetail($kd_pemesanan)->row('total');

        $sisah = ($total - $bayar);

        $data = [
            'kd_pemesanan' => $kd_pemesanan,
            'pembayaran'   => $this->m_cod->getDetail($kd_pemesanan)->row(),
            'total'        => $sisah,
        ];

        // untuk load view
        $this->template->load($this->role, 'Bayar', 'pemesanan', 'cod', $data);
    }

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

    // untuk pemabayaran transfer
    public function pembayaran()
    {
        $post = $this->input->post(NULL, TRUE);

        $total = remove_separator($post['inptotal']);
        $bayar = remove_separator($post['inpjumlahbayar']);

        if ($bayar !== $total) {
            $response = ['title' => 'Gagal!', 'text' => 'Maaf, jumlah bayar Anda tidak sesuai dengan total bayar!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
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
                    'kd_pemesanan'  => $post['inpkdorder'],
                    'nama_bayar'    => $post['inpnamapenyetor'],
                    'jumlah_bayar'  => remove_separator($post['inpjumlahbayar']),
                    'tanggal_bayar' => date('Y-m-d H:i:s'),
                    'bukti'         => $detailFile['file_name']
                ];
                $this->crud->i('tb_cod', $cod);

                // untuk update tabel pemesanan
                $pemesanan = [
                    'status_pembayaran'  => '1',
                    'status_pengantaran' => '2',
                ];
                $this->crud->u('tb_pemesanan', $pemesanan, ['kd_pemesanan' => $post['inpkdorder']]);

                // untuk insert tabel pengantaran detail
                $pengantaran_detail = [
                    'kd_pemesanan' => $post['inpkdorder'],
                    'status'       => '2',
                ];
                $this->crud->i('tb_pengantaran_detail', $pengantaran_detail);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        }
        // untuk response json
        $this->_response($response);
    }
}
