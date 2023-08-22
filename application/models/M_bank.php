<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_bank extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT b.id_bank, b.nama, b.rekening FROM tb_bank AS b ORDER BY b.ins DESC")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('b.id_bank, b.nama, b.rekening');
        $this->datatables->from('tb_bank AS b');
        return print_r($this->datatables->generate());
    }
}
