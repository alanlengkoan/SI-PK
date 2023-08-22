<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slide extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_slide');
        $this->load->model('m_diskon');
    }

    // untuk default
    public function index()
    {
        $data = [
            'title' => 'Slide',
            'diskon'  => $this->m_diskon->getAll(),
            'content' => 'admin/slide/view',
            'css'     => 'admin/slide/css/view',
            'js'      => 'admin/slide/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk get data slide by datatable
    public function get_data_slide_dt()
    {
        return $this->m_slide->getAllDataDt();
    }

    // untuk get data by id
    public function get()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_slide', ['id_slide' => $post['id']]);
        $response = [
            'id_slide'  => $result['id_slide'],
            'id_diskon' => $result['id_diskon'],
            'judul'     => $result['judul'],
            'gambar'    => $result['gambar'],
            'status'    => $result['status'],
        ];
        // untuk response json
        $this->_response($response);
    }

    // untuk simpan & ubah
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        if (empty($post['inpidslide'])) {
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
                    'id_slide'  => acak_id('tb_slide', 'id_slide'),
                    'id_diskon' => $post['inpiddiskon'],
                    'judul'     => $post['inpjudul'],
                    'gambar'    => $detailFile['file_name'],
                    'status'    => $post['inpstatus'],
                ];
                $this->db->trans_start();
                $this->crud->i('tb_slide', $data);
                $this->db->trans_complete();
                if ($this->db->trans_status() === FALSE) {
                    $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                } else {
                    $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                }
            }
        } else {
            $result = $this->crud->gda('tb_slide', ['id_slide' => $post['inpidslide']]);

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
                        'id_slide'  => $post['inpidslide'],
                        'id_diskon' => $post['inpiddiskon'],
                        'judul'     => $post['inpjudul'],
                        'status'    => $post['inpstatus'],
                        'gambar'    => $detailFile['file_name'],
                    ];
                    $this->db->trans_start();
                    $this->crud->u('tb_slide', $data, ['id_slide' => $post['inpidslide']]);
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $response = ['title' => 'Gagal!', 'text' => 'Gagal Simpan!', 'type' => 'error', 'button' => 'Ok!'];
                    } else {
                        $response = ['title' => 'Berhasil!', 'text' => 'Berhasil Simpan!', 'type' => 'success', 'button' => 'Ok!'];
                    }
                }
            } else {
                $data = [
                    'id_slide'  => $post['inpidslide'],
                    'id_diskon' => $post['inpiddiskon'],
                    'judul'     => $post['inpjudul'],
                    'status'    => $post['inpstatus'],
                ];
                $this->db->trans_start();
                $this->crud->u('tb_slide', $data, ['id_slide' => $post['inpidslide']]);
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

    // untuk proses hapus slide
    public function process_del()
    {
        $post = $this->input->post(NULL, TRUE);

        $result = $this->crud->gda('tb_slide', ['id_slide' => $post['id']]);
        $nma_file = $result['gambar'];
        // menghapus foto yg tersimpan
        if ($nma_file !== null) {
            if (file_exists(upload_path('gambar') . $result['gambar'])) {
                unlink(upload_path('gambar') . $result['gambar']);
            }
        }
        $this->db->trans_start();
        $this->crud->d('tb_slide', $post['id'], 'id_slide');
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
