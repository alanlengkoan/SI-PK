<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // untuk mengecek status login
        checking_session($this->session->userdata('username'), $this->session->userdata('role'), ['admin']);

        // untuk load model
        $this->load->model('crud');
        $this->load->model('m_kurir');
        $this->load->model('m_users');
        $this->load->model('m_riwayat');
        $this->load->model('m_pelanggan');
        $this->load->model('m_pemesanan');
    }

    // untuk default
    public function index()
    {
    }

    // untuk halaman laporan pembelian produk
    public function l_pembelian()
    {
        $data = [
            'title' => 'Laporan Pembelian',
            'content' => 'admin/laporan_p/view',
            'css'     => '',
            'js'      => 'admin/laporan_p/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk lihat laporan pembelian produk
    public function l_pembelian_show()
    {
        $post = $this->input->post(NULL, TRUE);

        $get = $this->m_pemesanan->getReportPembelian($post['tgl_awal'], $post['tgl_akhir'], $post['jenis']);
        $num = $get->num_rows();

        if ($num > 0) {
            foreach ($get->result() as $value) {
                $transfer = ($value->transfer === null) ? 0 : $value->transfer;
                $bayar    = ($value->bayar === null) ? 0 : $value->bayar;
                $total    = $transfer + $bayar;

                $result[$value->customer][] = [
                    'kode_order'        => $value->kd_pemesanan,
                    'kode_produk'       => $value->kd_produk,
                    'customer'          => $value->customer,
                    'tanggal_pembelian' => $value->tgl_pemesanan,
                    'jam_pembelian'     => $value->jam_pemesanan,
                    'total_pembelian'   => $value->total,
                    'total_bayar'       => ($total == 0) ? 0 : $total,
                ];
            }
        } else {
            $result['Data Kosong!'][] = [
                'kode_order'        => 'Data Kosong!',
                'kode_produk'       => 'Data Kosong!',
                'customer'          => 'Data Kosong!',
                'tanggal_pembelian' => 'Data Kosong!',
                'jam_pembelian'     => 'Data Kosong!',
                'total_pembelian'   => 0,
                'total_bayar'       => 0,
            ];
        }
        $data = [
            'title' => 'Laporan Pembelian',
            'laporan' => $result
        ];
        // untuk load view
        $this->load->view('admin/laporan_p/table', $data);
    }

    // untuk export laporan pembelian produk
    public function l_pembelian_export()
    {
        $post = $this->input->get(NULL, TRUE);

        $get = $this->m_pemesanan->getReportPembelian(base64url_decode($post['tgl_awal']), base64url_decode($post['tgl_akhir']), base64_decode($post['jenis']));
        $num = $get->num_rows();

        if ($num > 0) {
            foreach ($get->result() as $value) {
                $transfer = ($value->transfer === null) ? 0 : $value->transfer;
                $bayar    = ($value->bayar === null) ? 0 : $value->bayar;
                $total    = $transfer + $bayar;

                $result[$value->customer][] = [
                    'kode_order'        => $value->kd_pemesanan,
                    'kode_produk'       => $value->kd_produk,
                    'customer'          => $value->customer,
                    'tanggal_pembelian' => $value->tgl_pemesanan,
                    'jam_pembelian'     => $value->jam_pemesanan,
                    'total_pembelian'   => $value->total,
                    'total_bayar'       => ($total == 0) ? 0 : $total,
                ];
            }
        } else {
            $result['Data Kosong!'][] = [
                'kode_order'        => 'Data Kosong!',
                'kode_produk'       => 'Data Kosong!',
                'customer'          => 'Data Kosong!',
                'tanggal_pembelian' => 'Data Kosong!',
                'jam_pembelian'     => 'Data Kosong!',
                'total_pembelian'   => 0,
                'total_bayar'       => 0,
            ];
        }

        if (base64_decode($post['jenis']) === 'all') {
            $judul = "CAKE & DESSERT";
        } else {
            $judul = strtoupper(base64_decode($post['jenis']));
        }

        $data = [
            'judul'   => $judul,
            'laporan' => $result
        ];
        // untuk load view
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('laporan_pembelian', 'admin/laporan_p/print', $data);
    }

    // untuk laporan pembelian produk bulanan 
    public function l_pembelian_bulanan()
    {
        $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        $data = [
            'title' => 'Laporan Pembelian Bulanan',
            'bulan'   => $bulan,
            'content' => 'admin/laporan_p_bulanan/view',
            'css'     => '',
            'js'      => 'admin/laporan_p_bulanan/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk lihat laporan pembelian produk bulanan
    public function l_pembelian_bulanan_show()
    {
        $post = $this->input->post(NULL, TRUE);

        $get = $this->m_pemesanan->getReportPembelianBulanan($post['inpbulan'], date('Y'), $post['jenis']);
        $num = $get->num_rows();

        if ($num > 0) {
            foreach ($get->result() as $value) {
                $transfer = ($value->transfer === null) ? 0 : $value->transfer;
                $bayar    = ($value->bayar === null) ? 0 : $value->bayar;
                $total    = $transfer + $bayar;

                $result[$value->customer][] = [
                    'kode_order'        => $value->kd_pemesanan,
                    'kode_produk'       => $value->kd_produk,
                    'customer'          => $value->customer,
                    'tanggal_pembelian' => $value->tgl_pemesanan,
                    'jam_pembelian'     => $value->jam_pemesanan,
                    'total_pembelian'   => $value->total,
                    'total_bayar'       => ($total == 0) ? 0 : $total,
                ];
            }
        } else {
            $result['Data Kosong!'][] = [
                'kode_order'        => 'Data Kosong!',
                'kode_produk'       => 'Data Kosong!',
                'customer'          => 'Data Kosong!',
                'tanggal_pembelian' => 'Data Kosong!',
                'jam_pembelian'     => 'Data Kosong!',
                'total_pembelian'   => 0,
                'total_bayar'       => 0,
            ];
        }
        $data = [
            'title' => 'Laporan Pembelian Bulanan',
            'laporan' => $result
        ];
        // untuk load view
        $this->load->view('admin/laporan_p_bulanan/table', $data);
    }

    // untuk export laporan pembelian produk bulanan
    public function l_pembelian_bulanan_export()
    {
        $post = $this->input->get(NULL, TRUE);

        $get = $this->m_pemesanan->getReportPembelianBulanan(base64url_decode($post['bulan']), date('Y'), base64url_decode($post['jenis']));
        $num = $get->num_rows();

        if ($num > 0) {
            foreach ($get->result() as $value) {
                $transfer = ($value->transfer === null) ? 0 : $value->transfer;
                $bayar    = ($value->bayar === null) ? 0 : $value->bayar;
                $total    = $transfer + $bayar;

                $result[$value->customer][] = [
                    'kode_order'        => $value->kd_pemesanan,
                    'kode_produk'       => $value->kd_produk,
                    'customer'          => $value->customer,
                    'tanggal_pembelian' => $value->tgl_pemesanan,
                    'jam_pembelian'     => $value->jam_pemesanan,
                    'total_pembelian'   => $value->total,
                    'total_bayar'       => ($total == 0) ? 0 : $total,
                ];
            }
        } else {
            $result['Data Kosong!'][] = [
                'kode_order'        => 'Data Kosong!',
                'kode_produk'       => 'Data Kosong!',
                'customer'          => 'Data Kosong!',
                'tanggal_pembelian' => 'Data Kosong!',
                'jam_pembelian'     => 'Data Kosong!',
                'total_pembelian'   => 0,
                'total_bayar'       => 0,
            ];
        }

        if (base64_decode($post['jenis']) === 'all') {
            $judul = "CAKE & DESSERT";
        } else {
            $judul = strtoupper(base64_decode($post['jenis']));
        }

        $data = [
            'judul'   => $judul,
            'laporan' => $result
        ];
        // untuk load view
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('laporan_pembelian_bulanan', 'admin/laporan_p_bulanan/print', $data);
    }

    // untuk laporan pembelian produk tahunan
    public function l_pembelian_tahunan()
    {
        $tahun = date('Y');
        for ($i = $tahun; $i >= 2019; $i--) {
            $rTahun[] = $i;
        }

        $data = [
            'title' => 'Laporan Pembelian Tahunan',
            'tahun'   => $rTahun,
            'content' => 'admin/laporan_p_tahunan/view',
            'css'     => '',
            'js'      => 'admin/laporan_p_tahunan/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk lihat laporan pembelian produk tahunan
    public function l_pembelian_tahunan_show()
    {
        $post = $this->input->post(NULL, TRUE);

        $get = $this->m_pemesanan->getReportPembelianTahunan($post['inptahun'], $post['jenis']);
        $num = $get->num_rows();

        if ($num > 0) {
            foreach ($get->result() as $value) {
                $transfer = ($value->transfer === null) ? 0 : $value->transfer;
                $bayar    = ($value->bayar === null) ? 0 : $value->bayar;
                $total    = $transfer + $bayar;

                $result[$value->customer][] = [
                    'kode_order'        => $value->kd_pemesanan,
                    'kode_produk'       => $value->kd_produk,
                    'customer'          => $value->customer,
                    'tanggal_pembelian' => $value->tgl_pemesanan,
                    'jam_pembelian'     => $value->jam_pemesanan,
                    'total_pembelian'   => $value->total,
                    'total_bayar'       => ($total == 0) ? 0 : $total,
                ];
            }
        } else {
            $result['Data Kosong!'][] = [
                'kode_order'        => 'Data Kosong!',
                'kode_produk'       => 'Data Kosong!',
                'customer'          => 'Data Kosong!',
                'tanggal_pembelian' => 'Data Kosong!',
                'jam_pembelian'     => 'Data Kosong!',
                'total_pembelian'   => 0,
                'total_bayar'       => 0,
            ];
        }
        $data = [
            'title' => 'Laporan Pembelian Tahunan',
            'laporan' => $result
        ];
        // untuk load view
        $this->load->view('admin/laporan_p_tahunan/table', $data);
    }

    // untuk export laporan pembelian produk tahunan
    public function l_pembelian_tahunan_export()
    {
        $post = $this->input->get(NULL, TRUE);

        $get = $this->m_pemesanan->getReportPembelianTahunan(base64url_decode($post['tahun']), base64url_decode($post['jenis']));
        $num = $get->num_rows();

        if ($num > 0) {
            foreach ($get->result() as $value) {
                $transfer = ($value->transfer === null) ? 0 : $value->transfer;
                $bayar    = ($value->bayar === null) ? 0 : $value->bayar;
                $total    = $transfer + $bayar;

                $result[$value->customer][] = [
                    'kode_order'        => $value->kd_pemesanan,
                    'kode_produk'       => $value->kd_produk,
                    'customer'          => $value->customer,
                    'tanggal_pembelian' => $value->tgl_pemesanan,
                    'jam_pembelian'     => $value->jam_pemesanan,
                    'total_pembelian'   => $value->total,
                    'total_bayar'       => ($total == 0) ? 0 : $total,
                ];
            }
        } else {
            $result['Data Kosong!'][] = [
                'kode_order'        => 'Data Kosong!',
                'kode_produk'       => 'Data Kosong!',
                'customer'          => 'Data Kosong!',
                'tanggal_pembelian' => 'Data Kosong!',
                'jam_pembelian'     => 'Data Kosong!',
                'total_pembelian'   => 0,
                'total_bayar'       => 0,
            ];
        }

        if (base64_decode($post['jenis']) === 'all') {
            $judul = "CAKE & DESSERT";
        } else {
            $judul = strtoupper(base64_decode($post['jenis']));
        }

        $data = [
            'judul'   => $judul,
            'laporan' => $result
        ];

        // untuk load view
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('laporan_pembelian_tahunan', 'admin/laporan_p_tahunan/print', $data);
    }

    // untuk laporan pelanggan
    public function l_pelanggan()
    {
        $data = [
            'title' => 'Laporan Pelanggan',
            'content' => 'admin/laporan_pelanggan/view',
            'css'     => 'admin/laporan_pelanggan/css/view',
            'js'      => 'admin/laporan_pelanggan/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk lihat laporan pelanggan by datatable
    public function l_pelanggan_dt()
    {
        return $this->m_pelanggan->getAllDataDt();
    }

    // untuk cetak detail pelanggan
    public function l_pelanggan_cetak()
    {
        $id_users = base64url_decode($this->uri->segment('4'));

        $riwayat = $this->m_riwayat->getAllByUsers($id_users);
        $users   = $this->m_users->getRoleUsers('users', $id_users);

        $results = [];
        foreach ($riwayat->result() as $key => $row) {
            $detail = $this->m_pemesanan->getPemesananDetail($row->kd_pemesanan);

            $results[] = [
                'kd_order'      => $row->kd_pemesanan,
                'tgl_pemesanan' => $row->tgl_pemesanan,
                'detail'        => $detail->result()
            ];
        }

        $data = [
            'pelanggan' => $users,
            'laporan'   => $results
        ];
        // untuk load view
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('laporan_pelanggan', 'admin/laporan_pelanggan/print', $data);
    }

    // untuk laporan kurir
    public function l_kurir()
    {
        $data = [
            'title' => 'Laporan Kurir',
            'content' => 'admin/laporan_kurir/view',
            'css'     => 'admin/laporan_kurir/css/view',
            'js'      => 'admin/laporan_kurir/js/view'
        ];
        // untuk load view
        $this->load->view('admin/base', $data);
    }

    // untuk lihat laporan kurir by datatable
    public function l_kurir_dt()
    {
        return $this->m_kurir->getAllDataDt();
    }

    // untuk cetak detail kurir
    public function l_kurir_cetak()
    {
        $id_users = base64url_decode($this->uri->segment('4'));

        $riwayat = $this->m_pemesanan->getPemesananKurir($id_users);
        $users   = $this->m_users->getRoleUsers('kurir', $id_users);

        $results = [];
        foreach ($riwayat->result() as $key => $row) {
            $status_pengantaran = ['Dikemas', 'Dikirim', 'Diterima'];

            $results[] = [
                'kd_order'           => $row->kd_pemesanan,
                'tgl_pemesanan'      => $row->tgl_pemesanan,
                'jam_pemesanan'      => $row->jam_pemesanan,
                'nama'               => $row->nama,
                'metode_pembayaran'  => $row->metode_pembayaran,
                'status_pembayaran'  => $row->status_pembayaran,
                'status_pengantaran' => $status_pengantaran[$row->status_pengantaran],
                'total'              => $row->total,
            ];
        }

        $data = [
            'kurir'   => $users,
            'laporan' => $results
        ];

        // untuk load view
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->cetakPdf('laporan_kurir', 'admin/laporan_kurir/print', $data);
    }
}
