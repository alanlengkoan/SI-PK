<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_topper extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT * FROM tb_produk_topper AS tpt");
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('tpt.id_produk_topper, tpt.kd_topper, tpt.nama AS topper, tpt.harga, tpt.gambar');
        $this->datatables->from('tb_produk_topper AS tpt');
        return print_r($this->datatables->generate());
    }

    public function getProdukTopperDetail($kd_produk)
    {
        $result = $this->db->query("SELECT * FROM tb_produk_topper AS tpt WHERE tpt.kd_produk = '$kd_produk'");
        return $result;
    }

    public function getProdukTopperCount($kd_produk)
    {
        $query  = $this->db->query("SELECT * FROM tb_produk_topper AS tpt WHERE tpt.kd_produk = '$kd_produk'");
        $result = $query->num_rows();
        return $result;
    }

    public function getTopperDetail($kd_topper)
    {
        $result = $this->db->query("SELECT * FROM tb_produk_topper AS tpt WHERE tpt.kd_topper = '$kd_topper'")->row();
        return $result;
    }
}
