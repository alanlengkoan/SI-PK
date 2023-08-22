<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_produk_cake extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT p.id_produk, p.kd_produk, p.nama, s.nama AS satuan, p.harga, p.gambar, p.tentang, p.jenis, d.diskon FROM tb_produk AS p LEFT JOIN tb_satuan AS s ON p.satuan = s.kd_satuan LEFT JOIN tb_diskon AS d ON p.diskon = d.id_diskon WHERE jenis = 'cake'")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('p.id_produk, p.kd_produk, p.nama, s.nama AS satuan, p.harga, p.gambar, p.tentang, d.diskon');
        $this->datatables->from('tb_produk AS p');
        $this->datatables->join('tb_satuan AS s', 'p.satuan = s.kd_satuan', 'left');
        $this->datatables->join('tb_diskon AS d', 'p.diskon = d.id_diskon', 'left');
        $this->datatables->where('jenis', 'cake');
        return print_r($this->datatables->generate());
    }

    public function getProdukDetail($kd_produk)
    {
        $result = $this->db->query("SELECT * FROM tb_produk AS tp WHERE tp.kd_produk = '$kd_produk'")->row();
        return $result;
    }

    public function getProdukCount($kd_produk)
    {
        $query  = $this->db->query("SELECT * FROM tb_produk AS tp WHERE tp.kd_produk = '$kd_produk'");
        $result = $query->num_rows(); 
        return $result;
    }
}