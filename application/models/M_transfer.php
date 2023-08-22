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
        $result = $this->db->query("SELECT tt.nama_penyetor, tt.atas_nama, tt.jumlah_transfer, DATE_FORMAT(tt.tanggal_transfer, '%d-%m-%Y') AS tgl_transfer, DATE_FORMAT(tt.tanggal_transfer, '%H:%i:%s') AS jam_transfer, tt.bukti, tb.nama, tb.rekening, tt.ins FROM tb_transfer AS tt LEFT JOIN tb_bank AS tb ON tt.id_bank = tb.id_bank WHERE tt.kd_pemesanan = '$kd_pemesanan'");
        return $result;
    }
}
