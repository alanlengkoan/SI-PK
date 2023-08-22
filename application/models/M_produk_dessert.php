<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_produk_dessert extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT p.id_produk, p.kd_produk, p.nama, ts.nama AS satuan,( SELECT SUM( s.stock) FROM tb_stock AS s WHERE s.kd_produk = p.kd_produk ) AS stock,( SELECT SUM( pd.jumlah ) FROM tb_pemesanan_detail AS pd WHERE pd.kd_produk = p.kd_produk ) AS jumlah, ( SELECT SUM( k.jumlah ) FROM tb_keranjang AS k WHERE k.kd_produk = p.kd_produk ) AS jumlah_keranjang, p.harga, p.gambar, p.tentang, p.jenis, d.diskon FROM tb_produk AS p LEFT JOIN tb_satuan AS ts ON p.satuan = ts.kd_satuan LEFT JOIN tb_diskon AS d ON p.diskon = d.id_diskon WHERE p.jenis = 'dessert'")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('p.id_produk, p.kd_produk, p.nama, s.nama AS satuan, p.harga, p.gambar, p.tentang, (SELECT SUM( s.stock ) FROM tb_stock AS s WHERE s.kd_produk = p.kd_produk) AS stock, (SELECT SUM( pd.jumlah ) FROM tb_pemesanan_detail AS pd WHERE pd.kd_produk = p.kd_produk) AS jumlah, (SELECT SUM( k.jumlah ) FROM tb_keranjang AS k WHERE k.kd_produk = p.kd_produk ) AS jumlah_keranjang, d.diskon');
        $this->datatables->from('tb_produk AS p');
        $this->datatables->join('tb_satuan AS s', 'p.satuan = s.kd_satuan', 'left');
        $this->datatables->join('tb_diskon AS d', 'p.diskon = d.id_diskon', 'left');
        $this->datatables->where('jenis', 'dessert');
        return print_r($this->datatables->generate());
    }
}