<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pelayan extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM tb_pelayan AS p");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('tu.id, tu.id_users, tu.nama, tu.email, tk.kelamin, tk.telepon, tk.alamat');
        $this->datatables->from('tb_users AS tu');
        $this->datatables->join('tb_pelayan AS tk', 'tu.id_users = tk.id_users', 'left');
        $this->datatables->where('tu.roles', 'pelayan');
        return print_r($this->datatables->generate());
    }
}
