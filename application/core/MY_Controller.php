<?php
defined('BASEPATH') or exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller
{
    public $id;
    public $id_users;
    public $username;
    public $password;
    public $role;

    public function __construct()
    {
        parent::__construct();
        $this->id       = $this->session->userdata('id');
        $this->id_users = $this->session->userdata('id_users');
        $this->username = $this->session->userdata('username');
        $this->password = $this->session->userdata('password');
        $this->role     = $this->session->userdata('role');
    }

    public function _response($data)
    {
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit();
    }
}
