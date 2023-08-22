<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_satuan extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT ts.id_satuan, ts.kd_satuan, ts.nama FROM tb_satuan AS ts ORDER BY ts.ins DESC")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('ts.id_satuan, ts.kd_satuan, ts.nama');
        $this->datatables->from('tb_satuan AS ts');
        return print_r($this->datatables->generate());
    }
}
