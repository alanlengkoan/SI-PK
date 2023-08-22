<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_slide extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT s.id_slide, s.id_diskon, s.judul, s.`status`, s.gambar, d.diskon FROM tb_slide AS s LEFT JOIN tb_diskon AS d ON s.id_diskon = d.id_diskon where status = '1'")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('s.id_slide, s.id_diskon, s.judul, s.status, d.diskon');
        $this->datatables->join('tb_diskon AS d', 's.id_diskon = d.id_diskon', 'left');
        $this->datatables->from('tb_slide AS s');
        return print_r($this->datatables->generate());
    }
}
