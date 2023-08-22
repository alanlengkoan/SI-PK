<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P_topper extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_topper');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title'   => 'Topper',
            'content'   => 'admin/p_topper/view',
            'css'       => 'admin/p_topper/css/view',
            'js'        => 'admin/p_topper/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data produk topper by datatable
    public function get_data_topper_dt()
    {
        return $this->m_topper->getAllDataDt();
    }

    // untuk ambil kode topper
    public function kd_topper()
    {
        $response = [
            'kd_topper' => get_kode_urut('tb_produk_topper', 'kd_topper', 'KDP-T-'),
        ];
        // untuk response json
        $this->_response($response);
    }


    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_produk_topper', ['id_produk_topper' => $post['id']]);
        $response = [
            'id_produk_topper' => $result['id_produk_topper'],
            'kd_topper'        => $result['kd_topper'],
            'nama'             => $result['nama'],
            'harga'            => $result['harga'],
            'gambar'           => $result['gambar'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk proses simpan & ubah data topper
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        if (empty($post['inpidproduktopper'])) {
            $config['upload_path']   = './' . upload_path('gambar');
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name']  = TRUE;
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('inpgambartopper')) {
                // apa bila gagal
                $error = array('error' => $this->upload->display_errors());

                $response = ['title' => 'Gagal!', 'text' => strip_tags($error['error']), 'type' => 'error', 'button' => 'Ok!'];
            } else {
                // apa bila berhasil
                $detailFile = $this->upload->data();

                $data = [
                    'id_produk_topper' => acak_id('tb_produk_topper', 'id_produk_topper'),
                    'kd_topper'        => $post['inpkdtopper'],
                    'nama'             => $post['inpnamatopper'],
                    'harga'            => remove_separator($post['inphargatopper']),
                    'gambar'           => $detailFile['file_name'],
                ];
                $this->db->trans_start();
                $this->crud->i('tb_produk_topper', $data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        } else {
            $result = $this->crud->gda('tb_produk_topper', ['id_produk_topper' => $post['inpidproduktopper']]);

            if (isset($post['ubah_gambar_topper']) && $post['ubah_gambar_topper'] === 'on') {
                $config['upload_path']   = './' . upload_path('gambar');
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['encrypt_name']  = TRUE;
                $config['overwrite']     = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('inpgambartopper')) {
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
                        'id_produk_topper' => $post['inpidproduktopper'],
                        'kd_topper'        => $post['inpkdtopper'],
                        'nama'             => $post['inpnamatopper'],
                        'harga'            => remove_separator($post['inphargatopper']),
                        'gambar'           => $detailFile['file_name'],
                    ];
                    $this->db->trans_start();
                    $this->crud->u('tb_produk_topper', $data, ['id_produk_topper' => $post['inpidproduktopper']]);
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                    } else {
                        $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                    }
                }
            } else {
                $data = [
                    'id_produk_topper' => $post['inpidproduktopper'],
                    'kd_topper'        => $post['inpkdtopper'],
                    'nama'             => $post['inpnamatopper'],
                    'harga'            => remove_separator($post['inphargatopper']),
                ];
                $this->db->trans_start();
                $this->crud->u('tb_produk_topper', $data, ['id_produk_topper' => $post['inpidproduktopper']]);
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

    // untuk proses hapus data topper
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_produk_topper', ['id_produk_topper' => $post['id']]);
        $nma_file = $result['gambar'];
        // menghapus foto yg tersimpan
        if ($nma_file !== '' || $nma_file !== null) {
            if (file_exists(upload_path('gambar') . $result['gambar'])) {
                unlink(upload_path('gambar') . $result['gambar']);
            }
        }
        $this->db->trans_start();
        $this->crud->d('tb_produk_topper', $post['id'], 'id_produk_topper');
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
