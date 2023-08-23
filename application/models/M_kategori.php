<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT k.id_kategori, k.nama FROM tb_kategori AS k ORDER BY k.ins DESC")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('k.id_kategori, k.nama');
        $this->datatables->from('tb_kategori AS k');
        return print_r($this->datatables->generate());
    }
}
