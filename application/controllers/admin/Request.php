<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('m_request');
    }

    // untuk halaman default
    public function index()
    {
        $data = [
            'title' => 'Request',
            'content' => 'admin/request/view',
            'css'     => 'admin/request/css/view',
            'js'      => 'admin/request/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    public function get_data_request_dt()
    {
        return $this->m_request->getAllDataDt();
    }
}
