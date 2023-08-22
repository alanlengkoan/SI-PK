<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_stock extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT s.id_stock, s.kd_produk, p.nama, s.stock, DATE_FORMAT(s.ins, '%d-%m-%Y') AS tgl_masuk, DATE_FORMAT(s.ins, '%H:%i:%s') AS jam_masuk FROM tb_stock AS s LEFT JOIN tb_produk AS p ON s.kd_produk = p.kd_produk")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('s.id_stock, s.kd_produk, p.nama, s.stock, DATE_FORMAT(s.ins, "%d-%m-%Y") AS tgl_masuk, DATE_FORMAT(s.ins, "%H:%i:%s") AS jam_masuk');
        $this->datatables->from('tb_stock AS s');
        $this->datatables->join('tb_produk AS p', 's.kd_produk = p.kd_produk', 'left');
        return print_r($this->datatables->generate());
    }
}
