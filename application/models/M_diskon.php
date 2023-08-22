<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_diskon extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT d.id_diskon, d.diskon FROM tb_diskon AS d ORDER BY d.ins DESC")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('d.id_diskon, d.diskon');
        $this->datatables->from('tb_diskon AS d');
        return print_r($this->datatables->generate());
    }
}
