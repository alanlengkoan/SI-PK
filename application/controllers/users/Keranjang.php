<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends MY_Controller
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
        $this->load->model('m_cod');
        $this->load->model('m_bank');
        $this->load->model('m_users');
        $this->load->model('m_produk');
        $this->load->model('m_ongkir');
        $this->load->model('m_transfer');
        $this->load->model('m_keranjang');
        $this->load->model('m_pemesanan');
    }

    // untuk halaman default
    public function index()
    {
        $data = [
            'title'   => 'Keranjang',
            'keranjang' => $this->m_keranjang->getBuyCustomerKeranjang($this->session->userdata('id_users')),
            'content'   => 'home/keranjang/view',
            'css'       => '',
            'js'        => 'home/keranjang/js/view'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk detail produk
    public function detail()
    {
        $kd_produk = base64url_decode($this->uri->segment('3'));

        $data = [
            'title'   => 'Detail Keranjang',
            'keranjang' => $this->m_keranjang->getBuyCustomerKeranjangDetail($kd_produk),
            'content'   => 'home/keranjang/detail',
            'css'       => '',
            'js'        => ''
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk tambah data
    public function add()
    {
        $post = $this->input->post(NULL, TRUE);

        $get = $this->m_keranjang->getCheckKeranjang($post['inpidusers'], $post['inpkdproduk']);
        $row = $get->row();
        $num = $get->num_rows();

        if ($num == 1) {
            $jumlah = $row->jumlah + 1;
            // untuk mengubah data cake dan dessert
            $data = [
                'id_users'  => $post['inpidusers'],
                'kd_produk' => $post['inpkdproduk'],
                'jumlah'    => $jumlah,
                'harga'     => $row->harga,
                'sub_total' => $jumlah * $row->harga,
            ];

            $this->crud->u('tb_keranjang', $data, ['id_users' => $post['inpidusers'], 'kd_produk' => $post['inpkdproduk']]);
        } else {
            $get_produk = $this->m_produk->getProdukDetail($post['inpkdproduk']);

            if ($get_produk !== null) {
                $produk = $this->m_keranjang->getProdukDetailKeranjang($post['inpkdproduk']);

                // proses untuk menyimpan data cake dan dessert dalam keranjang
                $data = [
                    'id_users'  => $post['inpidusers'],
                    'kd_produk' => $post['inpkdproduk'],
                    'jumlah'    => 1,
                    'harga'     => $produk['harga'],
                    'sub_total' => 1 * $produk['harga'],
                ];

                $this->crud->i('tb_keranjang', $data);
            } else {
                $get_topper = $this->m_keranjang->getCheckKeranjangTopper($post['inpidusers'], $post['inpkdproduk'], $post['kd_produk']);
                $num_topper = $get_topper->num_rows();

                if ($num_topper == 1) {
                    $data = [
                        'kd_pasang' => $post['inpkdproduk'],
                    ];

                    $this->crud->u('tb_keranjang', $data, ['id_users' => $post['inpidusers'], 'kd_pasang' => $post['inpkdproduk'], 'kd_produk' => $post['kd_produk']]);
                } else {
                    $produk = $this->m_keranjang->getProdukDetailKeranjang($post['kd_produk']);

                    $this->db->where('kd_produk', $post['kd_produk']);
                    $this->db->where('kd_pasang', null);
                    $this->db->delete('tb_keranjang');

                    $data = [
                        'id_users'  => $post['inpidusers'],
                        'kd_produk' => $post['kd_produk'],
                        'kd_pasang' => $post['inpkdproduk'],
                        'jumlah'    => 1,
                        'harga'     => $produk['harga'],
                        'sub_total' => 1 * $produk['harga'],
                    ];

                    $this->crud->i('tb_keranjang', $data);
                }
            }
        }
        // untuk response json
        $this->_response($post);
    }

    // untuk hapus keranjang
    public function del()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_keranjang', $post['id'], 'kd_produk');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk checkout
    public function checkout()
    {
        $post = $this->input->post(NULL, TRUE);

        $id_keranjang = $post['inpidkeranjang'];
        $jumlah       = $post['inpjumlah'];
        $harga        = $post['inpharga'];
        $sub_total    = $post['inpsubtotal'];

        if ($id_keranjang === null) {
            // apa bila keranjang kosong
            redirect(base_url('produk'));
        } else {
            $count = count($id_keranjang);

            // untuk update data pada keranjang
            for ($i = 0; $i < $count; $i++) {
                $data = [
                    'jumlah'    => $jumlah[$i],
                    'harga'     => $harga[$i],
                    'sub_total' => $sub_total[$i],
                ];
                $this->crud->u('tb_keranjang', $data, ['id_keranjang' => $id_keranjang[$i]]);
            }

            $data = [
                'title'   => 'Checkout',
                'kd_order'  => get_kode_urut('tb_pemesanan', 'kd_pemesanan', 'ODR-'),
                'keranjang' => $this->m_keranjang->getBuyCustomerKeranjang($this->session->userdata('id_users')),
                'ongkir'    => $this->m_ongkir->getAll(),
                'user'      => $this->m_users->getRoleUsers('users', $this->session->userdata('id_users')),
                'bank'      => $this->m_bank->getAll(),
                'content'   => 'home/keranjang/checkout',
                'css'       => '',
                'js'        => 'home/keranjang/js/checkout'
            ];
            // untuk load view
            $this->load->view('home/base', $data);
        }
    }

    // untuk checkout finish
    public function checkout_finish()
    {
        $post = $this->input->post(NULL, TRUE);

        $id_users           = $this->session->userdata('id_users');
        $id_ongkir          = $post['inpidongkir'];
        $kd_order           = $post['inpkodeorder'];
        $id_bank            = $post['inpidbank'];
        $nama               = $post['inpnama'];
        $email              = $post['inpemail'];
        $telepon            = $post['inpnotelpon'];
        $alamat             = $post['inpalamat'];
        $tgl_pengambilan    = $post['inptglpengambilan'];
        $metode_pengantaran = $post['inpmetodepengantaran'];
        $metode_pembayaran  = $post['inpmetodepembayaran'];

        $this->db->trans_start();
        // update tabel users
        $tb_users = [
            'nama'  => $nama,
            'email' => $email
        ];
        $this->crud->u('tb_users', $tb_users, ['id_users' => $id_users]);

        // update tabel pelanggan
        $tb_pelanggan = [
            'telepon' => $telepon,
            'alamat'  => $alamat
        ];
        $this->crud->u('tb_pelanggan', $tb_pelanggan, ['id_users' => $id_users]);

        // insert tabel pemesanan
        $tb_pemesanan = [
            'kd_pemesanan'       => $kd_order,
            'id_users'           => $id_users,
            'id_ongkir'          => $id_ongkir,
            'tgl_pemesanan'      => date('Y-m-d H:i:s'),
            'tgl_pengambilan'    => $tgl_pengambilan,
            'metode_pembayaran'  => $metode_pembayaran,
            'metode_pengantaran' => $metode_pengantaran,
            'status_pembayaran'  => '0',
            'status_pengantaran' => '0',
            'status_lihat'       => 'belum-lihat',
            'status_batal'       => 'n',
            'pilih_kurir'        => 'n',
        ];
        $this->crud->i('tb_pemesanan', $tb_pemesanan);

        // insert tabel pemesanan detail
        $checkout = $this->m_keranjang->getBuyCustomerKeranjangAll($this->session->userdata('id_users'));
        foreach ($checkout->result() as $row) {
            $tb_pemesanan_detail = [
                'kd_pemesanan' => $kd_order,
                'kd_produk'    => $row->kd_produk,
                'kd_pasang'    => $row->kd_pasang,
                'jumlah'       => $row->jumlah_keranjang,
                'harga'        => $row->harga,
                'sub_total'    => $row->sub_total,
            ];
            $this->crud->i('tb_pemesanan_detail', $tb_pemesanan_detail);
        }

        // insert tabel pengantaran detail
        $tb_pengantaran_detail = [
            'kd_pemesanan' => $kd_order,
            'status'       => '0',
        ];
        $this->crud->i('tb_pengantaran_detail', $tb_pengantaran_detail);

        // untuk simpan data pembayaran
        if ($metode_pembayaran == 't') {
            $tb_transfer = [
                'kd_pemesanan' => $kd_order,
                'id_bank'      => $id_bank,
            ];
            $this->crud->i('tb_transfer', $tb_transfer);
        } else {
            $tb_cod = [
                'kd_pemesanan' => $kd_order,
            ];
            $this->crud->i('tb_cod', $tb_cod);
        }

        // delete tabel keranjang
        $this->crud->d('tb_keranjang', $id_users, 'id_users');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            if ($metode_pembayaran == 't') {
                $response = ['title' => 'Berhasil!', 'text' => 'Silahkan melakukan pembayaran!', 'type' => 'success', 'button' => 'Ok!'];
            } else {
                $response = ['title' => 'Berhasil!', 'text' => 'Pesanan Anda telah kami proses!', 'type' => 'success', 'button' => 'Ok!'];
            }
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk bukti bayar
    public function nota()
    {
        $id_users     = $this->session->userdata('id_users');
        $kd_pemesanan = base64url_decode($this->uri->segment('2'));

        // untuk data pemesanan
        $get_pemesanan = $this->m_pemesanan->getPemesanan($id_users, $kd_pemesanan);
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
            'title'               => 'Nota',
            'data_pemesanan'        => $get_pemesanan->row(),
            'data_pemesanan_detail' => $get_pemesanan_detail->result(),
            'data_pembayaran'       => $get_pembayaran->row(),
            'content'               => 'home/keranjang/nota',
            'css'                   => '',
            'js'                    => ''
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk detail produk
    public function nota_detail()
    {
        $get = $this->input->get(NULL, TRUE);
        $kd_pemesanan = base64url_decode($get['kd_pemesanan']);
        $kd_produk    = base64url_decode($get['kd_produk']);

        $data = [
            'title'   => 'Detail Nota',
            'keranjang' => $this->m_pemesanan->getPemesananDetailTopper($kd_pemesanan, $kd_produk),
            'content'   => 'home/keranjang/detail',
            'css'       => '',
            'js'        => ''
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk halaman cetak
    public function cetak()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('2'));

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
        $this->pdf->cetakPdf('nota', 'home/keranjang/print', $data);
    }

    // untuk transfer
    public function transfer()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('2'));

        $data = [
            'title'      => 'Bayar',
            'kd_pemesanan' => $kd_pemesanan,
            'pembayaran'   => $this->m_transfer->getDetail($kd_pemesanan)->row(),
            'total'        => $this->m_pemesanan->getTotalPemesananDetail($kd_pemesanan)->row('total'),
            'content'      => 'home/keranjang/transfer',
            'css'          => '',
            'js'           => 'home/keranjang/js/transfer'
        ];
        // untuk load view
        $this->load->view('home/base', $data);
    }

    // untuk pemabayaran transfer
    public function pembayaran()
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

            // update transfer
            $transfer = [
                'nama_penyetor'    => $post['inpnamapenyetor'],
                'atas_nama'        => $post['inpatasnama'],
                'tanggal_transfer' => date('Y-m-d H:i:s'),
                'bukti'            => $detailFile['file_name'],
            ];

            // update pemesanan
            $pemesanan = [
                'status_pembayaran' => '1'
            ];
            $this->db->trans_start();
            $this->crud->u('tb_transfer', $transfer, ['kd_pemesanan' => $post['inpkkorder']]);
            $this->crud->u('tb_pemesanan', $pemesanan, ['kd_pemesanan' => $post['inpkkorder']]);
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
}
