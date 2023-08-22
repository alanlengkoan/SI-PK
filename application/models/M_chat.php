<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_chat extends CI_Model
{
    public function getDetailChat($kd_pemesanan)
    {
        $result = $this->db->query("SELECT tc.id_chat, tc.kd_pemesanan, tc.id_users, tc.level, tc.pesan, DATE_FORMAT(tc.date_send, '%d-%m-%Y' ) AS tgl_post, DATE_FORMAT(tc.date_send, '%H:%i:%s' ) AS jam_post FROM tb_chat tc WHERE tc.kd_pemesanan = '$kd_pemesanan' ORDER BY tc.date_send ASC")->result();
        return $result;
    }
}
