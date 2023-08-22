<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_kurir extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM tb_kurir AS p");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('tu.id, tu.id_users, tu.nama, tu.email, tk.kelamin, tk.telepon, tk.alamat');
        $this->datatables->from('tb_users AS tu');
        $this->datatables->join('tb_kurir AS tk', 'tu.id_users = tk.id_users', 'left');
        $this->datatables->where('tu.roles', 'kurir');
        return print_r($this->datatables->generate());
    }
}
