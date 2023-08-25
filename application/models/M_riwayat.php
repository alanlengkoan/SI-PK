<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_riwayat extends CI_Model
{
    public function getAllByUsers($id_users, $status_batal)
    {
        $result = $this->db->query("SELECT tp.id_users, tp.kd_pemesanan, tu.nama, DATE_FORMAT( tp.tgl_pemesanan, '%d-%m-%Y') AS tgl_pemesanan, DATE_FORMAT( tp.tgl_pemesanan, '%H:%i:%s') AS jam_pemesanan, tp.metode_pembayaran, tp.metode_pemesanan, tp.status_pembayaran, tp.status_pengantaran,(( SELECT SUM( tpd.sub_total) FROM tb_pemesanan_detail AS tpd WHERE tpd.kd_pemesanan = tp.kd_pemesanan) + IFNULL( o.tarif, 0 )) AS total FROM tb_pemesanan AS tp LEFT JOIN tb_users AS tu ON tp.id_users = tu.id_users LEFT JOIN tb_ongkir AS o ON o.id_ongkir = tp.id_ongkir WHERE tp.id_users = '$id_users' AND tp.status_batal = '$status_batal'");
        return $result;
    }
}
