<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P_dessert extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_satuan');
        $this->load->model('m_diskon');
        $this->load->model('m_ukuran');
        $this->load->model('m_produk_dessert');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title'   => 'Dessert',
            'satuan'    => $this->m_satuan->getAll(),
            'diskon'    => $this->m_diskon->getAll(),
            'ukuran'    => $this->m_ukuran->getAll(),
            'content'   => 'admin/p_dessert/view',
            'css'       => 'admin/p_dessert/css/view',
            'js'        => 'admin/p_dessert/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk ambil kode produk
    public function kd_produk()
    {
        $response = [
            'kd_produk' => get_kode_urut('tb_produk', 'kd_produk', 'KDP-D-'),
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk get data bank by datatable
    public function get_data_dessert_dt()
    {
        return $this->m_produk_dessert->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_produk', ['kd_produk' => $post['id']]);
        $response = [
            'id_produk' => $result['id_produk'],
            'kd_produk' => $result['kd_produk'],
            'nama'      => $result['nama'],
            'satuan'    => $result['satuan'],
            'diskon'    => $result['diskon'],
            'ukuran'    => $result['ukuran'],
            'harga'     => $result['harga'],
            'gambar'    => $result['gambar'],
            'tentang'   => $result['tentang'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_add()
    {
        $post = $this->input->post(NULL, TRUE);

        $config['upload_path']   = './' . upload_path('gambar');
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name']  = TRUE;
        $config['overwrite']     = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('inpgambar')) {
            // apa bila gagal
            $error = array('error' => $this->upload->display_errors());

            $response = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
        } else {
            // apa bila berhasil
            $detailFile = $this->upload->data();

            $data = [
                'id_produk' => acak_id('tb_produk', 'id_produk'),
                'kd_produk' => $post['inpkdproduk'],
                'nama'      => $post['inpnama'],
                'satuan'    => $post['inpsatuan'],
                'diskon'    => $post['inpdiskon'],
                'ukuran'    => $post['inpukuran'],
                'harga'     => remove_separator($post['inpharga']),
                'gambar'    => $detailFile['file_name'],
                'tentang'   => $post['inptentang'],
                'jenis'     => 'dessert',
            ];
            $this->db->trans_start();
            $this->crud->i('tb_produk', $data);
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

    // untuk proses ubah data
    public function process_upd()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_produk', ['kd_produk' => $post['inpkdproduk']]);

        if (isset($post['ubah_gambar']) && $post['ubah_gambar'] === 'on') {
            $config['upload_path']   = './' . upload_path('gambar');
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name']  = TRUE;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('inpgambar')) {
                // apa bila gagal
                $error = array('error' => $this->upload->display_errors());

                $response = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
            } else {
                // apa bila berhasil
                $detailFile = $this->upload->data();

                $nma_file = $result['gambar'];
                // menghapus foto yg tersimpan
                if ($nma_file !== '' || $nma_file !== null) {
                    if (file_exists(upload_path('gambar') . $result['gambar'])) {
                        unlink(upload_path('gambar') . $result['gambar']);
                    }
                }

                $data = [
                    'kd_produk' => $post['inpkdproduk'],
                    'nama'      => $post['inpnama'],
                    'satuan'    => $post['inpsatuan'],
                    'diskon'    => $post['inpdiskon'],
                    'ukuran'    => $post['inpukuran'],
                    'harga'     => remove_separator($post['inpharga']),
                    'gambar'    => $detailFile['file_name'],
                    'tentang'   => $post['inptentang'],
                    'jenis'     => 'dessert',
                ];
                $this->db->trans_start();
                $this->crud->u(
                    'tb_produk',
                    $data,
                    ['kd_produk' => $post['inpkdproduk']]
                );
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        } else {
            $data = [
                'kd_produk' => $post['inpkdproduk'],
                'nama'      => $post['inpnama'],
                'satuan'    => $post['inpsatuan'],
                'diskon'    => $post['inpdiskon'],
                'ukuran'    => $post['inpukuran'],
                'harga'     => remove_separator($post['inpharga']),
                'tentang'   => $post['inptentang'],
                'jenis'     => 'dessert',
            ];
            $this->db->trans_start();
            $this->crud->u('tb_produk', $data, ['kd_produk' => $post['inpkdproduk']]);
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

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_produk', ['kd_produk' => $post['id']]);
        $nma_file = $result['gambar'];
        // menghapus foto yg tersimpan
        if ($nma_file !== '' || $nma_file !== null) {
            if (file_exists(upload_path('gambar') . $result['gambar'])) {
                unlink(upload_path('gambar') . $result['gambar']);
            }
        }
        $this->db->trans_start();
        $this->crud->d('tb_produk', $post['id'], 'kd_produk');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $response = ['title' => 'Gagal!', 'text' => 'Gagal Hapus!', 'type' => 'error', 'button' => 'Ok!'];
        } else {
            $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        }
        // untuk response json
        $this->_response($response);
    }
}
