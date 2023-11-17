<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_transfer extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("")->result();
        return $result;
    }

    public function getDetail($kd_pemesanan)
    {
        $result = $this->db->query("SELECT tt.nama_penyetor AS nama_bayar, tt.atas_nama, tt.jumlah_transfer AS jumlah_bayar, DATE_FORMAT( tt.tanggal_transfer, '%d-%m-%Y') AS tgl_bayar, DATE_FORMAT( tt.tanggal_transfer, '%H:%i:%s') AS jam_bayar, tt.bukti, tb.nama, tb.rekening, tt.ins FROM tb_transfer AS tt LEFT JOIN tb_bank AS tb ON tt.id_bank = tb.id_bank WHERE tt.kd_pemesanan = '$kd_pemesanan'");
        return $result;
    }

    public function getTotalBayar($kd_pemesanan)
    {
        $result = $this->db->query("SELECT IFNULL( SUM( tt.jumlah_transfer), 0) AS total FROM tb_transfer AS tt WHERE tt.kd_pemesanan = '$kd_pemesanan'");
        return $result;
    }
}
