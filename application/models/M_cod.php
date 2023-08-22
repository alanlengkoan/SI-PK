<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_cod extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("")->result();
        return $result;
    }

    public function getDetail($kd_pemesanan)
    {
        $result = $this->db->query("SELECT tc.nama_bayar, tc.jumlah_bayar, DATE_FORMAT(tc.tanggal_bayar, '%d-%m-%Y') AS tgl_bayar, DATE_FORMAT(tc.tanggal_bayar, '%H:%i:%s') AS jam_bayar, tc.bukti FROM tb_cod as tc WHERE tc.kd_pemesanan = '$kd_pemesanan'");
        return $result;
    }
}
