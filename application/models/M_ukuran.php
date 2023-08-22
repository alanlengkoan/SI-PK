<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_ukuran extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT tu.id_ukuran, tu.nama FROM tb_ukuran AS tu ORDER BY tu.ins DESC")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('tu.id_ukuran, tu.nama');
        $this->datatables->from('tb_ukuran AS tu');
        return print_r($this->datatables->generate());
    }
}
