<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_request extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('r.id_request, r.jenis, r.gambar, r.keterangan, tu.nama, tu.email, tp.telepon');
        $this->datatables->join('tb_users AS tu', 'r.id_users = tu.id_users', 'left');
        $this->datatables->join('tb_pelanggan AS tp', 'r.id_users = tp.id_users', 'left');
        $this->datatables->from('tb_request AS r');
        return print_r($this->datatables->generate());
    }
}
