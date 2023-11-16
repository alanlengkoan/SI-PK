<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_keranjang extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("")->result();
        return $result;
    }

    public function getBuyCustomerKeranjangAll($id_users)
    {
        $result = $this->db->query("SELECT tk.id_keranjang, tk.id_users, tk.kd_produk, tk.jumlah AS jumlah_keranjang,( SELECT SUM( ts.stock) FROM tb_stock AS ts WHERE ts.kd_produk = tp.kd_produk) AS stock, IFNULL(( SELECT SUM( tpd.jumlah) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_produk = tp.kd_produk ), 0 ) AS jumlah, tp.nama, tp.gambar, tp.harga, tk.sub_total, td.diskon FROM tb_keranjang AS tk LEFT JOIN tb_produk AS tp ON tk.kd_produk = tp.kd_produk LEFT JOIN tb_diskon AS td ON td.id_diskon = tp.id_diskon WHERE tk.id_users = '$id_users'");
        return $result;
    }

    public function getCheckKeranjang($id_users, $kd_produk)
    {
        $result = $this->db->query("SELECT * FROM tb_keranjang AS tk WHERE tk.id_users = '$id_users' AND tk.kd_produk = '$kd_produk'");
        return $result;
    }

    public function getBuyCustomerKeranjang($id_users)
    {
        $result = $this->db->query("SELECT tk.id_keranjang, tk.id_users, tk.kd_produk, tk.jumlah AS jumlah_keranjang,( SELECT SUM( ts.stock) FROM tb_stock AS ts WHERE ts.kd_produk = tp.kd_produk) AS stock,( SELECT SUM( tpd.jumlah) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_produk = tp.kd_produk ) AS jumlah, tk.harga, tk.sub_total, tp.nama, tp.gambar, td.diskon, tke.nama AS kategori FROM tb_keranjang AS tk LEFT JOIN tb_produk AS tp ON tk.kd_produk = tp.kd_produk LEFT JOIN tb_diskon AS td ON td.id_diskon = tp.id_diskon LEFT JOIN tb_kategori AS tke ON tke.id_kategori = tp.id_kategori WHERE tk.id_users = '$id_users'");
        return $result;
    }

    public function getProdukDetailKeranjang($kd_produk)
    {
        $produk        = $this->db->query("SELECT tp.kd_produk, tp.nama, tp.harga, td.diskon FROM tb_produk AS tp LEFT JOIN tb_diskon AS td ON td.id_diskon = tp.id_diskon WHERE tp.kd_produk = '$kd_produk'");
        $num_produk    = $produk->num_rows();

        $result = [];
        if ($num_produk === 1) {
            foreach ($produk->result() as $row) {
                $diskon       = (int) $row->diskon / 100;
                $harga_diskon = (int) $row->harga * $diskon;
                $harga        = (int) $row->harga - round($harga_diskon);

                $result = [
                    'kd_produk' => $row->kd_produk,
                    'nama'      => $row->nama,
                    'harga'     => $harga,
                ];
            }
        }

        return $result;
    }
}
