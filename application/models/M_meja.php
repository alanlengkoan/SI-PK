<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_meja extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT m.id_meja, m.no_meja, m.jumlah_kursi FROM tb_meja AS m ORDER BY m.ins DESC")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('m.id_meja, m.no_meja, m.jumlah_kursi');
        $this->datatables->from('tb_meja AS m');
        return print_r($this->datatables->generate());
    }
}
