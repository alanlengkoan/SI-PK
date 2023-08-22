<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pelanggan extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM tb_pelanggan AS p");
        return $result;
    }
   
    public function getBestCustomer()
    {
        $result = $this->db->query("SELECT tp.id_users, tu.nama,( SELECT COUNT( tpd.id_users) FROM tb_pemesanan AS tpd WHERE tpd.id_users = tp.id_users ) AS jumlah FROM tb_pelanggan AS tp LEFT JOIN tb_users AS tu ON tp.id_users = tu.id_users");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('tu.id, tu.id_users, tu.nama, tu.email, tp.kelamin, tp.telepon, tp.alamat');
        $this->datatables->from('tb_users AS tu');
        $this->datatables->join('tb_pelanggan AS tp', 'tu.id_users = tp.id_users', 'left');
        $this->datatables->where('tu.roles', 'users');
        return print_r($this->datatables->generate());
    }
}