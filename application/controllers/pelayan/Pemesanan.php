<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['pelayan']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_cod');
        $this->load->model('m_meja');
        $this->load->model('m_bank');
        $this->load->model('m_produk');
        $this->load->model('m_transfer');
        $this->load->model('m_pemesanan');
        $this->load->model('m_keranjang');
    }

    // untuk default
    public function index()
    {
        // untuk load view
        $this->template->load($this->role, 'Pemesanan', 'pemesanan', 'view');
    }

    public function get_data_pemesanan_dt()
    {
        return $this->m_pemesanan->getAllDataDtUsers('n', $this->session->userdata('id_users'));
    }

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
            'data_pemesanan'        => $get_pemesanan->row(),
            'data_pemesanan_detail' => $get_pemesanan_detail->result(),
            'data_pembayaran'       => $get_pembayaran->row(),
        ];
        // untuk load view
        $this->template->load($this->role, 'Detail', 'pemesanan', 'detail', $data);
    }

    public function add()
    {
        $data = [
            'no_transaksi' => get_kode_urut('tb_pemesanan', 'kd_pemesanan', 'ODR-'),
            'produk'       => $this->m_produk->getAll(),
            'meja'         => $this->m_meja->getAll(),
            'bank'         => $this->m_bank->getAll(),
        ];

        $this->template->load($this->role, 'Pemesanan', 'pemesanan', 'add', $data);
    }

    public function upd()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));

        // untuk data pemesanan
        $get_pemesanan = $this->m_pemesanan->getPemesananAdmin($kd_pemesanan);

        $data = [
            'kd_pemesanan'   => $this->uri->segment('4'),
            'produk'         => $this->m_produk->getAll(),
            'data_pemesanan' => $get_pemesanan->row(),
        ];
        // untuk load view
        $this->template->load($this->role, 'Pemesanan', 'pemesanan', 'upd', $data);
    }

    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $id_users          = $this->session->userdata('id_users');
        $id_bank           = $post['id_bank'];
        $id_meja           = $post['id_meja'];
        $kd_pemesanan      = $post['kd_pemesanan'];
        $tgl_pemesanan     = date('Y-m-d H:i:');
        $metode_pemesanan  = 'e';
        $metode_pembayaran = $post['metode_pembayaran'];

        $this->db->trans_start();
        $tb_pemesanan = [
            'kd_pemesanan'       => $kd_pemesanan,
            'id_users'           => $id_users,
            'id_meja'            => $id_meja,
            'tgl_pemesanan'      => $tgl_pemesanan,
            'metode_pemesanan'   => $metode_pemesanan,
            'metode_pembayaran'  => $metode_pembayaran,
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
                'kd_pemesanan' => $kd_pemesanan,
                'kd_produk'    => $row->kd_produk,
                'jumlah'       => $row->jumlah_keranjang,
                'harga'        => $row->harga,
                'sub_total'    => $row->sub_total,
            ];
            $this->crud->i('tb_pemesanan_detail', $tb_pemesanan_detail);
        }

        // delete tabel keranjang
        $this->crud->d('tb_keranjang', $id_users, 'id_users');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!', 'id' => $kd_pemesanan];
        }
        // untuk response json
        $this->_response($response);
    }
    
    // untuk get data temp
    public function get_data_detail_dt()
    {
        $kd_pemesanan = base64url_decode($this->uri->segment('4'));
        
        $get = $this->m_pemesanan->getPemesananDetail($kd_pemesanan);
        $num = $get->num_rows();

        $result = [];
        if ($num > 0) {
            foreach ($get->result() as $key => $value) {
                $result[] = [
                    'id_pemesanan_detail' => $value->id_pemesanan_detail,
                    'kd_produk'           => $value->kd_produk,
                    'nama'                => $value->nama,
                    'kategori'            => $value->kategori,
                    'jumlah'              => $value->jumlah,
                    'harga'               => $value->harga,
                    'total'               => $value->sub_total
                ];
            }
        }
        $response = ['data' => $result];
        // untuk reponse json
        $this->_response($response);
    }

    // untuk get data by id
    public function get_detail()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_pemesanan_detail', ['id_pemesanan_detail' => $post['id']]);
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah & ubah data temp
    public function process_save_detail()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'kd_pemesanan' => $post['kd_pemesanan'],
            'kd_produk'    => $post['kd_produk'],
            'jumlah'       => $post['jumlah'],
            'harga'        => remove_separator($post['harga']),
            'sub_total'    => remove_separator($post['total']),
        ];

        $this->db->trans_start();
        if (empty($post['id_pemesanan_detail'])) {
            $this->crud->i('tb_pemesanan_detail', $data);
        } else {
            $this->crud->u('tb_pemesanan_detail', $data, ['id_pemesanan_detail' => $post['id_pemesanan_detail']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses hapus data temp
    public function process_del_detail()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_pemesanan_detail', $post['id'], 'id_pemesanan_detail');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk get data temp
    public function get_data_temp_dt()
    {
        $get = $this->m_keranjang->getBuyCustomerKeranjang($this->session->userdata('id_users'));
        $num = $get->num_rows();

        $result = [];
        if ($num > 0) {
            foreach ($get->result() as $key => $value) {
                $result[] = [
                    'id_keranjang' => $value->id_keranjang,
                    'kd_produk'    => $value->kd_produk,
                    'nama'         => $value->nama,
                    'kategori'     => $value->kategori,
                    'jumlah'       => $value->jumlah_keranjang,
                    'harga'        => $value->harga,
                    'total'        => $value->sub_total
                ];
            }
        }
        $response = ['data' => $result];
        // untuk reponse json
        $this->_response($response);
    }

    // untuk get data by id
    public function get_temp()
    {
        $post = $this->input->post(NULL, TRUE);

        $response = $this->crud->gda('tb_keranjang', ['id_keranjang' => $post['id']]);
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah & ubah data temp
    public function process_save_temp()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'id_users'  => $this->session->userdata('id_users'),
            'kd_produk' => $post['kd_produk'],
            'jumlah'    => $post['jumlah'],
            'harga'     => remove_separator($post['harga']),
            'sub_total' => remove_separator($post['total']),
        ];

        $this->db->trans_start();
        if (empty($post['id_keranjang'])) {
            $this->crud->i('tb_keranjang', $data);
        } else {
            $this->crud->u('tb_keranjang', $data, ['id_keranjang' => $post['id_keranjang']]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk proses hapus data temp
    public function process_del_temp()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->crud->d('tb_keranjang', $post['id'], 'id_keranjang');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }

    // untuk mencari barang
    public function search_barang()
    {
        $post = $this->input->post(NULL, TRUE);

        $get = $this->m_produk->getProdukWhere('kd_produk', $post['id'])->row();

        $stok = ($get->stock - $get->jumlah);

        $response = [
            "id_produk" => $get->id_produk,
            "kd_produk" => $get->kd_produk,
            "nama"      => $get->nama,
            "harga"     => $get->harga,
            "kategori"  => $get->kategori,
            "stok"      => $stok
        ];
        // untuk response json
        $this->_response($response);
    }
}
