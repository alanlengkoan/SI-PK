<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_produk');
        $this->load->model('m_diskon');
        $this->load->model('m_kategori');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title'    => 'Produk',
            'diskon'   => $this->m_diskon->getAll(),
            'kategori' => $this->m_kategori->getAll(),
            'content'  => 'admin/produk/view',
            'css'      => 'admin/produk/css/view',
            'js'       => 'admin/produk/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data bank by datatable
    public function get_data_dt()
    {
        return $this->m_produk->getAllDataDt();
    }

    // untuk ambil kode produk
    public function kd_produk()
    {
        $response = [
            'kd_produk' => get_kode_urut('tb_produk', 'kd_produk', 'KDP-'),
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result   = $this->crud->gda('tb_produk', ['id_produk' => $post['id']]);
        $response = [
            'id_produk'   => $result['id_produk'],
            'id_diskon'   => $result['id_diskon'],
            'id_kategori' => $result['id_kategori'],
            'kd_produk'   => $result['kd_produk'],
            'nama'        => $result['nama'],
            'harga'       => $result['harga'],
            'gambar'      => $result['gambar'],
            'deskripsi'   => $result['deskripsi'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        if (empty($post['id_produk'])) {
            $config['upload_path']   = './' . upload_path('gambar');
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name']  = TRUE;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                // apa bila gagal
                $error = array('error' => $this->upload->display_errors());

                $response = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
            } else {
                // apa bila berhasil
                $detailFile = $this->upload->data();

                $data = [
                    'id_produk'   => acak_id('tb_produk', 'id_produk'),
                    'id_diskon'   => $post['id_diskon'],
                    'id_kategori' => $post['id_kategori'],
                    'kd_produk'   => $post['kd_produk'],
                    'nama'        => $post['nama'],
                    'harga'       => remove_separator($post['harga']),
                    'deskripsi'   => $post['deskripsi'],
                    'gambar'      => $detailFile['file_name'],
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
        } else {
            $result = $this->crud->gda('tb_produk', ['id_produk' => $post['id_produk']]);

            if (isset($post['ubah_gambar']) && $post['ubah_gambar'] === 'on') {
                $config['upload_path']   = './' . upload_path('gambar');
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name']  = TRUE;
                $config['overwrite']     = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar')) {
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
                        'id_produk'   => $post['id_produk'],
                        'id_diskon'   => $post['id_diskon'],
                        'id_kategori' => $post['id_kategori'],
                        'kd_produk'   => $post['kd_produk'],
                        'nama'        => $post['nama'],
                        'harga'       => remove_separator($post['harga']),
                        'deskripsi'   => $post['deskripsi'],
                        'gambar'      => $detailFile['file_name'],
                    ];

                    $this->db->trans_start();
                    $this->crud->u('tb_produk', $data, ['id_produk' => $post['id_produk']]);
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                    } else {
                        $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                    }
                }
            } else {
                $data = [
                    'id_produk'   => $post['id_produk'],
                    'id_diskon'   => $post['id_diskon'],
                    'id_kategori' => $post['id_kategori'],
                    'kd_produk'   => $post['kd_produk'],
                    'nama'        => $post['nama'],
                    'harga'       => remove_separator($post['harga']),
                    'deskripsi'   => $post['deskripsi'],
                ];
                $this->db->trans_start();
                $this->crud->u('tb_produk', $data, ['id_produk' => $post['id_produk']]);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
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

    // untuk proses hapus data
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $result   = $this->crud->gda('tb_produk', ['id_produk' => $post['id']]);
        $nma_file = $result['gambar'];
        // menghapus foto yg tersimpan
        if ($nma_file !== '' || $nma_file !== null) {
            if (file_exists(upload_path('gambar') . $result['gambar'])) {
                unlink(upload_path('gambar') . $result['gambar']);
            }
        }
        $this->db->trans_start();
        $this->crud->d('tb_produk', $post['id'], 'id_produk');
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
