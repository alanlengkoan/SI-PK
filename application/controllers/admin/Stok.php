<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->username, $this->role, ['admin']);

        // untuk load model
        $this->load->model('m_stock');
        $this->load->model('m_produk');
    }

    // untuk default
    public function index()
    {
        $data = [
            'produk' => $this->m_produk->getAll(),
        ];

        // untuk load view
        $this->template->load($this->role, 'Stok', 'stok', 'view', $data);
    }

    // untuk get data stock by datatable
    public function get_data_stock_dt()
    {
        return $this->m_stock->getAllDataDt();
    }

    // untuk proses tambah data
    public function process_save()
    {
        $post = $this->input->post(NULL, TRUE);

        $data = [
            'id_stock'  => acak_id('tb_stock', 'id_stock'),
            'kd_produk' => $post['inpkdproduk'],
            'stock'     => $post['inpstock'],
        ];
        $this->db->trans_start();
        $this->crud->i('tb_stock', $data);
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
