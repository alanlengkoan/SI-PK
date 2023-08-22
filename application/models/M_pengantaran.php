<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pengantaran extends CI_Model
{
    public function getAll()
    {
        $result = $this->db->query("")->result();
        return $result;
    }

    public function getPengataran($kd_pemesanan)
    {
        $result = $this->db->query("");
        return $result;
    }

    public function getPengataranDetail($kd_pemesanan)
    {
        $result = $this->db->query("SELECT tpd.kd_pemesanan, tpd.status, DATE_FORMAT( tpd.ins, '%d-%m-%Y' ) AS waktu, DATE_FORMAT( tpd.ins, '%H:%i' ) AS jam FROM tb_pengantaran_detail AS tpd WHERE tpd.kd_pemesanan = '$kd_pemesanan'");
        return $result;
    }
}