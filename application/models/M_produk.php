<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_produk extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("SELECT p.id_produk, p.id_diskon, p.id_kategori, p.kd_produk, p.nama, p.harga, p.gambar, p.deskripsi, k.nama AS kategori, d.diskon AS diskon,( SELECT SUM( s.stock) FROM tb_stock AS s WHERE s.kd_produk = p.kd_produk) AS stock,( SELECT SUM( pd.jumlah) FROM tb_pemesanan_detail AS pd WHERE pd.kd_produk = p.kd_produk ) AS jumlah,( SELECT SUM( k.jumlah ) FROM tb_keranjang AS k WHERE k.kd_produk = p.kd_produk ) AS jumlah_keranjang FROM tb_produk AS p LEFT JOIN tb_kategori AS k ON k.id_kategori = p.id_kategori LEFT JOIN tb_diskon AS d ON d.id_diskon = p.id_diskon")->result();
        return $result;
    }

    public function getAllDataDt()
    {
        $this->datatables->select('p.id_produk, p.id_diskon, p.id_kategori, p.kd_produk, p.nama, p.harga, p.gambar, p.deskripsi, k.nama AS kategori, d.diskon AS diskon,( SELECT SUM( s.stock) FROM tb_stock AS s WHERE s.kd_produk = p.kd_produk) AS stock,( SELECT SUM( pd.jumlah) FROM tb_pemesanan_detail AS pd WHERE pd.kd_produk = p.kd_produk ) AS jumlah,( SELECT SUM( k.jumlah ) FROM tb_keranjang AS k WHERE k.kd_produk = p.kd_produk ) AS jumlah_keranjang');
        $this->datatables->from('tb_produk AS p');
        $this->datatables->join('tb_kategori AS k', 'k.id_kategori = p.id_kategori', 'left');
        $this->datatables->join('tb_diskon AS d', 'd.id_diskon = p.id_diskon', 'left');
        return print_r($this->datatables->generate());
    }

    public function getProdukWhere($column, $value)
    {
        $result = $this->db->query("SELECT p.id_produk, p.kd_produk, p.nama, p.harga, p.gambar, p.deskripsi, td.diskon, tk.nama AS kategori,( SELECT SUM( s.stock) FROM tb_stock AS s WHERE s.kd_produk = p.kd_produk) AS stock,( SELECT SUM( pd.jumlah) FROM tb_pemesanan_detail AS pd LEFT JOIN tb_pemesanan AS pe ON pd.kd_pemesanan = pe.kd_pemesanan WHERE pd.kd_produk = p.kd_produk AND pe.status_pembayaran = '1' AND pe.status_pengantaran = '2' ) AS jumlah FROM tb_produk AS p LEFT JOIN tb_kategori AS tk ON tk.id_kategori = p.id_kategori LEFT JOIN tb_diskon AS td ON td.id_diskon = p.id_diskon WHERE $column = '$value'");
        return $result;
    }

    public function getLaris()
    {
        $result = $this->db->query("SELECT tpd.kd_produk, tpo.nama, tpo.harga, tpo.gambar, tpo.deskripsi, d.diskon,( SELECT SUM( s.stock) FROM tb_stock AS s WHERE s.kd_produk = tpo.kd_produk) AS stock,( SELECT SUM( pd.jumlah) FROM tb_pemesanan_detail AS pd WHERE pd.kd_produk = tpo.kd_produk) AS jumlah,( SELECT SUM( k.jumlah) FROM tb_keranjang AS k WHERE k.kd_produk = tpo.kd_produk ) AS jumlah_keranjang FROM tb_pemesanan_detail AS tpd LEFT JOIN tb_pemesanan AS tp ON tpd.kd_pemesanan = tp.kd_pemesanan LEFT JOIN tb_produk AS tpo ON tpd.kd_produk = tpo.kd_produk LEFT JOIN tb_diskon AS d ON d.id_diskon = tpo.id_diskon WHERE tp.bintang IS NOT NULL GROUP BY tpd.kd_produk, tpo.nama, tpo.harga, tpo.gambar, tpo.deskripsi, d.diskon LIMIT 5")->result();
        return $result;
    }

    public function getLarisMonth($bulan)
    {
        $result = $this->db->query("SELECT tpd.kd_produk, tpo.nama, tpo.harga, tpo.gambar, tpo.deskripsi, d.diskon,( SELECT SUM( s.stock) FROM tb_stock AS s WHERE s.kd_produk = tpo.kd_produk) AS stock,( SELECT SUM( pd.jumlah) FROM tb_pemesanan_detail AS pd WHERE pd.kd_produk = tpo.kd_produk) AS jumlah,( SELECT SUM( k.jumlah ) FROM tb_keranjang AS k WHERE k.kd_produk = tpo.kd_produk ) AS jumlah_keranjang FROM tb_pemesanan_detail AS tpd LEFT JOIN tb_pemesanan AS tp ON tpd.kd_pemesanan = tp.kd_pemesanan LEFT JOIN tb_produk AS tpo ON tpd.kd_produk = tpo.kd_produk LEFT JOIN tb_diskon AS d ON d.id_diskon = tpo.id_diskon WHERE tp.bintang IS NOT NULL AND MONTH( tp.tgl_pemesanan ) = '$bulan' GROUP BY tpd.kd_produk, tpo.nama, tpo.harga, tpo.gambar, tpo.deskripsi, d.diskon LIMIT 5")->result();
        return $result;
    }

    public function getProdukCommentar($kd_produk)
    {
        $result = $this->db->query("SELECT tpo.kd_produk, tpo.nama AS nama_produk, tpd.kd_pemesanan, tpe.bintang, tpe.komentar, DATE_FORMAT( tpe.upd, '%Y-%m-%d' ) AS tgl_posting, DATE_FORMAT( tpe.upd, '%H:%i:%s') AS jam_posting, tu.nama AS nama_user FROM tb_produk AS tpo LEFT JOIN tb_pemesanan_detail AS tpd ON tpo.kd_produk = tpd.kd_produk LEFT JOIN tb_pemesanan AS tpe ON tpd.kd_pemesanan = tpe.kd_pemesanan LEFT JOIN tb_users AS tu ON tpe.id_users = tu.id_users WHERE tpo.kd_produk = '$kd_produk' AND tpe.bintang IS NOT NULL AND tpe.komentar IS NOT NULL");
        return $result;
    }










































































    // public function getDiskon($diskon)
    // {
    //     $result = $this->db->query("SELECT tpo.kd_produk, tpo.nama, tpo.satuan, tpo.harga, tpo.gambar, tpo.tentang, tpo.jenis, d.diskon FROM tb_produk AS tpo LEFT JOIN tb_diskon AS d ON tpo.diskon = d.id_diskon WHERE d.diskon = '$diskon'")->result();
    //     return $result;
    // }

    // public function getBestProduk()
    // {
    //     $result = $this->db->query("SELECT tpo.kd_produk, tpo.nama,( SELECT COUNT( tpd.kd_produk) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_produk = tpo.kd_produk ) AS jumlah FROM tb_produk AS tpo GROUP BY tpo.kd_produk, tpo.nama ORDER BY( SELECT COUNT( tpd.kd_produk ) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_produk = tpo.kd_produk ) DESC LIMIT 5");
    //     return $result;
    // }




}
