<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_keranjang extends CI_Model
{
    // public function getAll()
    // {
    //     $result = $this->db->query("")->result();
    //     return $result;
    // }

    // public function getCheckKeranjangTopper($id_users, $kd_produk, $kd_pasang)
    // {
    //     $result = $this->db->query("SELECT * FROM tb_keranjang AS tk WHERE tk.id_users = '$id_users' AND tk.kd_produk = '$kd_produk' AND tk.kd_pasang = '$kd_pasang'");
    //     return $result;
    // }

    // public function getBuyCustomerKeranjangCake($id_users)
    // {
    //     $result = $this->db->query("SELECT tk.id_users, tk.kd_produk, tk.jumlah AS jumlah_keranjang,( SELECT SUM( ts.stock) FROM tb_stock AS ts WHERE ts.kd_produk = tp.kd_produk ) AS stock,( SELECT SUM( tpd.jumlah ) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_produk = tp.kd_produk ) AS jumlah, tp.nama, tp.gambar, tp.jenis,( CASE WHEN tp.jenis = 'cake' THEN IFNULL(( SELECT SUM( pt.harga ) FROM tb_produk_topper AS pt RIGHT JOIN tb_keranjang AS k ON pt.kd_topper = k.kd_produk WHERE pt.harga IS NOT NULL ), 0 ) + tp.harga ELSE tp.harga END ) AS harga,( CASE WHEN tp.jenis = 'cake' THEN IFNULL(( SELECT SUM(( k.jumlah * pt.harga )) AS harga FROM tb_produk_topper AS pt RIGHT JOIN tb_keranjang AS k ON pt.kd_topper = k.kd_produk WHERE pt.harga IS NOT NULL ), 0 ) + tk.sub_total ELSE tk.sub_total END ) AS sub_total, d.diskon FROM tb_keranjang AS tk LEFT JOIN tb_produk AS tp ON tk.kd_produk = tp.kd_produk LEFT JOIN tb_diskon AS d ON tp.diskon = d.id_diskon WHERE tp.jenis = 'cake' AND tk.id_users = '$id_users'");
    //     return $result;
    // }



    // public function getBuyCustomerKeranjangAll($id_users)
    // {
    //     $result = $this->db->query("SELECT tk.id_keranjang, tk.id_users, tk.kd_produk, tk.kd_pasang, tk.jumlah AS jumlah_keranjang,( SELECT SUM( ts.stock) FROM tb_stock AS ts WHERE ts.kd_produk = tp.kd_produk ) AS stock, ( SELECT SUM( tpd.jumlah ) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_produk = tp.kd_produk ) AS jumlah, IFNULL( tp.nama, tpt.nama ) AS nama, IFNULL( tp.gambar, tpt.gambar ) AS gambar, IFNULL( tp.harga, tpt.harga ) AS harga, tp.jenis, tk.sub_total, d.diskon FROM tb_keranjang AS tk LEFT JOIN tb_produk AS tp ON tk.kd_produk = tp.kd_produk LEFT JOIN tb_diskon AS d ON tp.diskon = d.id_diskon LEFT JOIN tb_produk_topper AS tpt ON tk.kd_produk = tpt.kd_topper WHERE tk.id_users = '$id_users'");
    //     return $result;
    // }




















    public function getCheckKeranjang($id_users, $kd_produk)
    {
        $result = $this->db->query("SELECT * FROM tb_keranjang AS tk WHERE tk.id_users = '$id_users' AND tk.kd_produk = '$kd_produk'");
        return $result;
    }

    public function getBuyCustomerKeranjang($id_users)
    {
        $result = $this->db->query("SELECT tk.id_keranjang, tk.id_users, tk.kd_produk, tk.jumlah AS jumlah_keranjang,( SELECT SUM( ts.stock) FROM tb_stock AS ts WHERE ts.kd_produk = tp.kd_produk) AS stock,( SELECT SUM( tpd.jumlah) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_produk = tp.kd_produk ) AS jumlah, tk.harga, tk.sub_total, tp.nama, tp.gambar, td.diskon FROM tb_keranjang AS tk LEFT JOIN tb_produk AS tp ON tk.kd_produk = tp.kd_produk LEFT JOIN tb_diskon AS td ON td.id_diskon = tp.id_diskon WHERE tk.id_users = '$id_users'");
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
