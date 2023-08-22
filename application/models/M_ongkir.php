<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_ongkir extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT o.id_ongkir, o.lokasi, o.tarif FROM tb_ongkir AS o ORDER BY o.ins DESC")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('o.id_ongkir, o.lokasi, o.tarif');
        $this->datatables->from('tb_ongkir AS o');
        return print_r($this->datatables->generate());
    }
}
