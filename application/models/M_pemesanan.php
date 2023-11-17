<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pemesanan extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("")->result();
        return $result;
    }

    public function getAllDataDt($status_batal)
    {
        $this->datatables->select('tp.id_users, tp.kd_pemesanan, tu.nama, DATE_FORMAT( tp.tgl_pemesanan, "%d-%m-%Y") AS tgl_pemesanan, DATE_FORMAT( tp.tgl_pemesanan, "%H:%i:%s") AS jam_pemesanan, tp.metode_pembayaran, tp.metode_pemesanan, tp.status_pengantaran, tp.pilih_kurir, tp.status_batal, tp.status_lihat, tp.status_pembayaran, ( SELECT SUM( tpd.sub_total) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_pemesanan = tp.kd_pemesanan) AS total,( SELECT SUM( tf.jumlah_transfer ) FROM tb_transfer AS tf WHERE tf.kd_pemesanan = tp.kd_pemesanan ) AS transfer,( SELECT SUM( tc.jumlah_bayar ) FROM tb_cod AS tc WHERE tc.kd_pemesanan = tp.kd_pemesanan ) AS bayar');
        $this->datatables->where('tp.status_batal', $status_batal);
        $this->datatables->from('tb_pemesanan AS tp');
        $this->datatables->join('tb_users AS tu', 'tp.id_users = tu.id_users', 'left');
        return print_r($this->datatables->generate());
    }

    public function getAllDataDtUsers($status_batal, $id_users)
    {
        $this->datatables->select('tp.id_users, tp.kd_pemesanan, tu.nama, DATE_FORMAT( tp.tgl_pemesanan, "%d-%m-%Y") AS tgl_pemesanan, DATE_FORMAT( tp.tgl_pemesanan, "%H:%i:%s") AS jam_pemesanan, tp.metode_pembayaran, tp.metode_pemesanan, tp.status_pengantaran, tp.pilih_kurir, tp.status_batal, tp.status_lihat, tp.status_pembayaran, ( SELECT SUM( tpd.sub_total) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_pemesanan = tp.kd_pemesanan) AS total,( SELECT SUM( tf.jumlah_transfer ) FROM tb_transfer AS tf WHERE tf.kd_pemesanan = tp.kd_pemesanan ) AS transfer,( SELECT SUM( tc.jumlah_bayar ) FROM tb_cod AS tc WHERE tc.kd_pemesanan = tp.kd_pemesanan ) AS bayar');
        $this->datatables->where('tp.status_batal', $status_batal);
        $this->datatables->where('tp.id_users', $id_users);
        $this->datatables->from('tb_pemesanan AS tp');
        $this->datatables->join('tb_users AS tu', 'tp.id_users = tu.id_users', 'left');
        return print_r($this->datatables->generate());
    }

    public function getPemesanan($id_users, $kd_pemesanan)
    {
        $result = $this->db->query("SELECT tp.id_users, tp.kd_pemesanan, tp.metode_pembayaran, tp.metode_pemesanan, tu.nama, tu.email, tc.telepon, DATE_FORMAT( tp.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tp.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, tp.status_pembayaran, tp.status_pengantaran, tc.kelamin, tc.alamat, ti.tarif, tm.no_meja, tm.jumlah_kursi FROM tb_pemesanan AS tp LEFT JOIN tb_pelanggan AS tc ON tp.id_users = tc.id_users LEFT JOIN tb_users AS tu ON tp.id_users = tu.id_users LEFT JOIN tb_ongkir AS ti ON tp.id_ongkir = ti.id_ongkir LEFT JOIN tb_meja AS tm ON tm.id_meja = tp.id_meja WHERE tp.id_users = '$id_users' AND tp.kd_pemesanan = '$kd_pemesanan'");
        return $result;
    }

    public function getPemesananPembayaran()
    {
        $result = $this->db->query("SELECT tp.id_users, tp.kd_pemesanan, tp.metode_pembayaran, tp.metode_pemesanan, tu.nama, tu.email, tc.telepon, DATE_FORMAT( tp.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tp.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, tp.status_pembayaran, tp.status_pengantaran, tc.kelamin, tc.alamat, ti.tarif, tm.no_meja, tm.jumlah_kursi FROM tb_pemesanan AS tp LEFT JOIN tb_pelanggan AS tc ON tp.id_users = tc.id_users LEFT JOIN tb_users AS tu ON tp.id_users = tu.id_users LEFT JOIN tb_ongkir AS ti ON tp.id_ongkir = ti.id_ongkir LEFT JOIN tb_meja AS tm ON tm.id_meja = tp.id_meja ORDER BY tp.kd_pemesanan ASC")->result();
        return $result;
    }

    public function getPemesananAdmin($kd_pemesanan)
    {
        $result = $this->db->query("SELECT tp.id_users, tp.kd_pemesanan, tp.metode_pembayaran, tp.metode_pemesanan, tu.nama, tu.email, tc.telepon, DATE_FORMAT( tp.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tp.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, tp.status_pembayaran, tp.status_pengantaran, tc.kelamin, tc.alamat, ti.tarif, tm.no_meja, tm.jumlah_kursi FROM tb_pemesanan AS tp LEFT JOIN tb_pelanggan AS tc ON tp.id_users = tc.id_users LEFT JOIN tb_users AS tu ON tp.id_users = tu.id_users LEFT JOIN tb_ongkir AS ti ON tp.id_ongkir = ti.id_ongkir LEFT JOIN tb_meja AS tm ON tm.id_meja = tp.id_meja WHERE tp.id_users = tu.id_users AND tp.kd_pemesanan = '$kd_pemesanan'");
        return $result;
    }

    public function getPemesananDetail($kd_pemesanan)
    {
        $result = $this->db->query("SELECT tpd.id_pemesanan_detail, tpd.kd_pemesanan, tp.kd_produk, tp.nama, tp.gambar, tpd.jumlah, tpd.harga, tpd.sub_total, td.diskon, tke.nama AS kategori FROM tb_pemesanan_detail AS tpd LEFT JOIN tb_produk AS tp ON tpd.kd_produk = tp.kd_produk LEFT JOIN tb_diskon AS td ON td.id_diskon = tp.id_diskon LEFT JOIN tb_kategori AS tke ON tke.id_kategori = tp.id_kategori WHERE tpd.kd_pemesanan = '$kd_pemesanan'");
        return $result;
    }

    public function getPemesananDetailTopper($kd_pemesanan, $kd_produk)
    {
        $result = $this->db->query("SELECT pt.kd_topper, pt.nama, pt.harga, k.jumlah FROM tb_produk_topper AS pt RIGHT JOIN tb_pemesanan_detail AS k ON pt.kd_topper = k.kd_pasang WHERE k.kd_pemesanan = '$kd_pemesanan' AND k.kd_produk = '$kd_produk'");
        return $result;
    }

    public function getTotalPemesananDetail($kd_pemesanan)
    {
        $result = $this->db->query("SELECT(( SELECT SUM( tpd.sub_total) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_pemesanan = tp.kd_pemesanan) + IFNULL( o.tarif, 0)) AS total FROM tb_pemesanan AS tp LEFT JOIN tb_ongkir AS o ON o.id_ongkir = tp.id_ongkir WHERE tp.kd_pemesanan = '$kd_pemesanan'");
        return $result;
    }

    // untuk mengambil pembelian
    public function getAllDataPembelianDt()
    {
        $this->datatables->select('tp.kd_pemesanan, DATE_FORMAT( tp.tgl_pemesanan, "%d-%m-%Y" ) AS tgl_pemesanan, DATE_FORMAT( tp.tgl_pemesanan, "%H:%i:%s" ) AS jam_pemesanan, SUM( tpd.sub_total ) AS total, ( SELECT SUM( tt.jumlah_transfer ) FROM tb_transfer AS tt WHERE tt.kd_pemesanan = tp.kd_pemesanan ) AS transfer, ( SELECT SUM( tc.jumlah_bayar ) FROM tb_cod AS tc WHERE tc.kd_pemesanan = tp.kd_pemesanan ) AS cod');
        $this->datatables->from('tb_pemesanan AS tp');
        $this->datatables->join('tb_pemesanan_detail AS tpd', 'tp.kd_pemesanan = tpd.kd_pemesanan', 'left');
        $this->datatables->group_by(['tp.kd_pemesanan', 'tp.tgl_pemesanan']);
        return print_r($this->datatables->generate());
    }

    // untuk mengambil data pemesanan kurir
    public function getPemesananKurir($id_users)
    {
        $result = $this->db->query("SELECT tp.id_users, tp.kd_pemesanan, tu.nama, DATE_FORMAT( tp.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tp.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, tp.metode_pembayaran, tp.metode_pemesanan, tp.status_pembayaran, tp.status_pengantaran, tp.pilih_kurir,(( SELECT SUM( tpd.sub_total) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_pemesanan = tp.kd_pemesanan ) + IFNULL( o.tarif, 0 )) AS total FROM tb_pemesanan AS tp LEFT JOIN tb_pengantaran AS tpn ON tp.kd_pemesanan = tpn.kd_pemesanan LEFT JOIN tb_users AS tu ON tp.id_users = tu.id_users LEFT JOIN tb_ongkir AS o ON o.id_ongkir = tp.id_ongkir WHERE tpn.id_users = '$id_users'");
        return $result;
    }

    // untuk mengambil data pemesanan pelayan
    public function getPemesananPelayan($id_users)
    {
        $result = $this->db->query("SELECT tp.id_users, tp.kd_pemesanan, tu.nama, DATE_FORMAT( tp.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tp.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, tp.metode_pembayaran, tp.metode_pemesanan, tp.status_pembayaran, tp.status_pengantaran,( SELECT SUM( tpd.sub_total) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_pemesanan = tp.kd_pemesanan ) AS total FROM tb_pemesanan AS tp LEFT JOIN tb_pengantaran AS tpn ON tp.kd_pemesanan = tpn.kd_pemesanan LEFT JOIN tb_users AS tu ON tp.id_users = tu.id_users WHERE tpn.id_users = '$id_users'");
        return $result;
    }

    // untuk menampilkan notifikasi admin
    public function getNotifikasiAdmin()
    {
        $result = $this->db->query("SELECT tp.id_users, tp.kd_pemesanan, tu.nama, DATE_FORMAT(tp.tgl_pemesanan, '%d-%m-%Y' ) AS tgl_pemesanan, DATE_FORMAT(tp.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan FROM tb_pemesanan AS tp LEFT JOIN tb_users AS tu ON tp.id_users = tu.id_users WHERE tp.status_lihat = 'belum-lihat'");
        return $result;
    }

    // untuk menampilkan notifikasi kurir
    public function getNotifikasiKurir($id_users)
    {
        $result = $this->db->query("SELECT tpm.id_users, tpm.kd_pemesanan, tpm.tgl_pemesanan, tu.nama, tpm.metode_pembayaran, tpm.status_pembayaran, tpm.status_pengantaran, tpm.pilih_kurir FROM tb_pemesanan as tpm LEFT JOIN tb_pengantaran as tpe ON tpm.kd_pemesanan = tpe.kd_pemesanan LEFT JOIN tb_users as tu on tpm.id_users = tu.id_users WHERE tpe.id_users = '$id_users' AND tpe.status_lihat = 'belum-lihat'");
        return $result;
    }

    // untuk menampilkan pemesanan belum rating
    public function getRating($id_users)
    {
        $result = $this->db->query("SELECT tp.id_users, tp.kd_pemesanan, tp.tgl_pemesanan, tp.metode_pembayaran, tp.status_pembayaran, tp.status_pengantaran, tp.pilih_kurir FROM tb_pemesanan AS tp WHERE tp.id_users = '$id_users' AND( tp.status_pengantaran = '2' OR tp.status_pembayaran = '1') AND tp.bintang IS NULL AND tp.komentar IS NULL");
        return $result;
    }

    // untuk mengambil data pembelian laporan
    public function getReportPembelian($tgl_awal, $tgl_akhir, $jenis)
    {
        if ($jenis === 'all') {
            $result = $this->db->query("SELECT tu.nama AS customer, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, DATE_FORMAT( tpe.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tpe.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, SUM( tpd.sub_total) AS total,( SELECT SUM( pe.jumlah_transfer ) FROM tb_transfer AS pe WHERE pe.kd_pemesanan = tpe.kd_pemesanan ) AS transfer,( SELECT SUM( c.jumlah_bayar ) FROM tb_cod AS c WHERE c.kd_pemesanan = tpe.kd_pemesanan ) AS bayar FROM tb_pemesanan AS tpe LEFT JOIN tb_pemesanan_detail AS tpd ON tpe.kd_pemesanan = tpd.kd_pemesanan LEFT JOIN tb_produk AS tp ON tpd.kd_produk = tp.kd_produk LEFT JOIN tb_users AS tu ON tpe.id_users = tu.id_users WHERE DATE( tpe.tgl_pemesanan ) BETWEEN '$tgl_awal' AND '$tgl_akhir' GROUP BY tu.nama, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, tpe.tgl_pemesanan");
        } else {
            $result = $this->db->query("SELECT tu.nama AS customer, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, DATE_FORMAT( tpe.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tpe.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, SUM( tpd.sub_total) AS total,( SELECT SUM( pe.jumlah_transfer ) FROM tb_transfer AS pe WHERE pe.kd_pemesanan = tpe.kd_pemesanan ) AS transfer,( SELECT SUM( c.jumlah_bayar ) FROM tb_cod AS c WHERE c.kd_pemesanan = tpe.kd_pemesanan ) AS bayar FROM tb_pemesanan AS tpe LEFT JOIN tb_pemesanan_detail AS tpd ON tpe.kd_pemesanan = tpd.kd_pemesanan LEFT JOIN tb_produk AS tp ON tpd.kd_produk = tp.kd_produk LEFT JOIN tb_users AS tu ON tpe.id_users = tu.id_users WHERE tp.id_kategori = '$jenis' AND DATE( tpe.tgl_pemesanan ) BETWEEN '$tgl_awal' AND '$tgl_akhir' GROUP BY tu.nama, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, tpe.tgl_pemesanan");
        }
        return $result;
    }

    // untuk mengambil data pembelian laporan
    public function getReportPembelianBulanan($bulan, $tahun, $jenis)
    {
        if ($jenis === 'all') {
            $result = $this->db->query("SELECT tu.nama AS customer, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, DATE_FORMAT( tpe.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tpe.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, SUM( tpd.sub_total) AS total,( SELECT SUM( pe.jumlah_transfer ) FROM tb_transfer AS pe WHERE pe.kd_pemesanan = tpe.kd_pemesanan ) AS transfer,( SELECT SUM( c.jumlah_bayar ) FROM tb_cod AS c WHERE c.kd_pemesanan = tpe.kd_pemesanan ) AS bayar FROM tb_pemesanan AS tpe LEFT JOIN tb_pemesanan_detail AS tpd ON tpe.kd_pemesanan = tpd.kd_pemesanan LEFT JOIN tb_produk AS tp ON tpd.kd_produk = tp.kd_produk LEFT JOIN tb_users AS tu ON tpe.id_users = tu.id_users WHERE MONTH( tpe.tgl_pemesanan ) = '$bulan' AND YEAR( tpe.tgl_pemesanan ) = '$tahun' GROUP BY tu.nama, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, tpe.tgl_pemesanan");
        } else {
            $result = $this->db->query("SELECT tu.nama AS customer, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, DATE_FORMAT( tpe.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tpe.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, SUM( tpd.sub_total) AS total,( SELECT SUM( pe.jumlah_transfer ) FROM tb_transfer AS pe WHERE pe.kd_pemesanan = tpe.kd_pemesanan ) AS transfer,( SELECT SUM( c.jumlah_bayar ) FROM tb_cod AS c WHERE c.kd_pemesanan = tpe.kd_pemesanan ) AS bayar FROM tb_pemesanan AS tpe LEFT JOIN tb_pemesanan_detail AS tpd ON tpe.kd_pemesanan = tpd.kd_pemesanan LEFT JOIN tb_produk AS tp ON tpd.kd_produk = tp.kd_produk LEFT JOIN tb_users AS tu ON tpe.id_users = tu.id_users WHERE tp.id_kategori = '$jenis' AND MONTH( tpe.tgl_pemesanan ) = '$bulan' AND YEAR( tpe.tgl_pemesanan ) = '$tahun' GROUP BY tu.nama, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, tpe.tgl_pemesanan");
        }
        return $result;
    }

    // untuk mengambil data pembelian laporan
    public function getReportPembelianTahunan($tahun, $jenis)
    {
        if ($jenis === 'all') {
            $result = $this->db->query("SELECT tu.nama AS customer, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, DATE_FORMAT( tpe.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tpe.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, SUM( tpd.sub_total) AS total,( SELECT SUM( pe.jumlah_transfer) FROM tb_transfer AS pe WHERE pe.kd_pemesanan = tpe.kd_pemesanan) AS transfer,( SELECT SUM( c.jumlah_bayar ) FROM tb_cod AS c WHERE c.kd_pemesanan = tpe.kd_pemesanan ) AS bayar FROM tb_pemesanan AS tpe LEFT JOIN tb_pemesanan_detail AS tpd ON tpe.kd_pemesanan = tpd.kd_pemesanan LEFT JOIN tb_produk AS tp ON tpd.kd_produk = tp.kd_produk LEFT JOIN tb_users AS tu ON tpe.id_users = tu.id_users WHERE YEAR( tpe.tgl_pemesanan ) = '$tahun' GROUP BY tu.nama, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, tpe.tgl_pemesanan");
        } else {
            $result = $this->db->query("SELECT tu.nama AS customer, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, DATE_FORMAT( tpe.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tpe.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, SUM( tpd.sub_total) AS total,( SELECT SUM( pe.jumlah_transfer) FROM tb_transfer AS pe WHERE pe.kd_pemesanan = tpe.kd_pemesanan) AS transfer,( SELECT SUM( c.jumlah_bayar ) FROM tb_cod AS c WHERE c.kd_pemesanan = tpe.kd_pemesanan ) AS bayar FROM tb_pemesanan AS tpe LEFT JOIN tb_pemesanan_detail AS tpd ON tpe.kd_pemesanan = tpd.kd_pemesanan LEFT JOIN tb_produk AS tp ON tpd.kd_produk = tp.kd_produk LEFT JOIN tb_users AS tu ON tpe.id_users = tu.id_users WHERE tp.id_kategori = '$jenis' AND YEAR( tpe.tgl_pemesanan ) = '$tahun' GROUP BY tu.nama, tp.kd_produk, tpe.kd_pemesanan, tpe.id_users, tpe.tgl_pemesanan");
        }
        return $result;
    }

    // untuk ambil data pemesanan oleh kurir
    public function getPemesananYes($id_users)
    {
        $result = $this->db->query("SELECT tpm.id_users, tpm.kd_pemesanan, DATE_FORMAT( tpm.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tpm.tgl_pemesanan, '%H:%i:%s' ) AS jam_pemesanan, tu.nama, tpm.metode_pembayaran, tpm.status_pembayaran, tpm.status_pengantaran, tpm.pilih_kurir,( SELECT SUM( tpd.sub_total ) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_pemesanan = tpm.kd_pemesanan ) AS total FROM tb_pemesanan AS tpm LEFT JOIN tb_pengantaran AS tpn ON tpm.kd_pemesanan = tpn.kd_pemesanan LEFT JOIN tb_users AS tu ON tpm.id_users = tu.id_users WHERE tpn.id_users = '$id_users' AND tpm.status_pengantaran = '2'");
        return $result;
    }

    public function getPemesananNo($id_users)
    {
        $result = $this->db->query("SELECT tpm.id_users, tpm.kd_pemesanan, DATE_FORMAT( tpm.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tpm.tgl_pemesanan, '%H:%i:%s' ) AS jam_pemesanan, tu.nama, tpm.metode_pembayaran, tpm.status_pembayaran, tpm.status_pengantaran, tpm.pilih_kurir,( SELECT SUM( tpd.sub_total ) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_pemesanan = tpm.kd_pemesanan ) AS total FROM tb_pemesanan AS tpm LEFT JOIN tb_pengantaran AS tpn ON tpm.kd_pemesanan = tpn.kd_pemesanan LEFT JOIN tb_users AS tu ON tpm.id_users = tu.id_users WHERE tpn.id_users = '$id_users' AND tpm.status_pengantaran != '2'");
        return $result;
    }
}
