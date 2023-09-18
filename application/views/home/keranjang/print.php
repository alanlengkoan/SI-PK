<!-- CSS -->
<style media="screen">
    .judul {
        padding: 4mm;
        text-align: center;
    }

    .nama {
        text-decoration: underline;
        font-weight: bold;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    h3 {
        font-family: times;
    }

    p {
        margin: 0;
    }
</style>
<!-- CSS -->

<div class="judul">
    <table align="center">
        <tr>
            <td align="center">
                <h3>NOTA</h3>
                <h3><?= $this->m_pengaturan->getFirstRecord()->nama ?? '-' ?></h3>
            </td>
        </tr>
    </table>
    <hr>

    <h3>Pemesanan</h3>
    <table>
        <tr>
            <td>Kode Order</td>
            <td><?= $data_pemesanan->kd_pemesanan ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><?= $data_pemesanan->nama ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= $data_pemesanan->email ?></td>
        </tr>
        <tr>
            <td>No. Telepon</td>
            <td><?= $data_pemesanan->telepon ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td><?= ($data_pemesanan->kelamin === 'L' ? 'Laki - laki' : 'Perempuan') ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><?= $data_pemesanan->alamat ?></td>
        </tr>
        <tr>
            <td>Tanggal Pemesanan</td>
            <td><?= $data_pemesanan->tgl_pemesanan ?></td>
        </tr>
        <tr>
            <td>Jam Pemesanan</td>
            <td><?= $data_pemesanan->jam_pemesanan ?></td>
        </tr>
        <tr>
            <td>Status Pengantaran</td>
            <?php $status_pengantaran = ['Dikemas', 'Dikirim', 'Diterima']; ?>
            <td><?= $status_pengantaran[$data_pemesanan->status_pengantaran] ?></td>
        </tr>
    </table>
    <h3>Pembayaran</h3>
    <table>
        <tr>
            <td>Metode Pembayaran</td>
            <td><?= ($data_pemesanan->metode_pembayaran === 'c' ? 'COD' : 'Transfer') ?></td>
        </tr>
        <tr>
            <td>Status Pembayaran</td>
            <td><?= ($data_pemesanan->status_pembayaran === 0 ? 'Menunggu Pembayaran' : 'Telah Melakukan Pembayaran') ?></td>
        </tr>
        <?php if ($data_pemesanan->metode_pembayaran === 't') { ?>
            <tr>
                <td>Bank</td>
                <td><?= $data_pembayaran->nama ?></td>
            </tr>
            <tr>
                <td>Rekening</td>
                <td><?= $data_pembayaran->rekening ?></td>
            </tr>
            <tr>
                <td>Atas Nama</td>
                <td><?= $data_pembayaran->atas_nama ?></td>
            </tr>
            <tr>
                <td>Nama Penyetor</td>
                <td><?= $data_pembayaran->nama_penyetor ?></td>
            </tr>
            <tr>
                <td>Tanggal Transfer</td>
                <td><?= $data_pembayaran->tgl_transfer ?></td>
            </tr>
            <tr>
                <td>Jam Transfer</td>
                <td><?= $data_pembayaran->jam_transfer ?></td>
            </tr>
            <tr>
                <td>Bukti Transfer</td>
                <td><img src="./public/uploads/gambar/<?= $data_pembayaran->bukti ?>" width="100" heigth="100" /></td>
            </tr>
            <tr>
                <td>Jumlah Transfer</td>
                <td><?= create_separator($data_pembayaran->jumlah_transfer) ?></td>
            </tr>
        <?php } else { ?>
            <tr>
                <td>Nama Bayar</td>
                <td><?= $data_pembayaran->nama_bayar ?></td>
            </tr>
            <tr>
                <td>Jumlah Bayar</td>
                <td><?= $data_pembayaran->jumlah_bayar ?></td>
            </tr>
            <tr>
                <td>Tanggal Bayar</td>
                <td><?= $data_pembayaran->tgl_bayar ?></td>
            </tr>
            <tr>
                <td>Jam Bayar</td>
                <td><?= $data_pembayaran->jam_bayar ?></td>
            </tr>
        <?php } ?>
    </table>
    <h3>Detail Pemesanan</h3>
    <table align="center" border="1" width="100%">
        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Sub Total</th>
        </tr>
        <?php
        $total = 0;
        $no = 1;
        foreach ($data_pemesanan_detail as $key => $row) {
            $total = ($total + $row->sub_total);
        ?>
            <tr align="center">
                <td><?= $no++ ?></td>
                <td><img src="./public/uploads/gambar/<?= $row->gambar ?>" width="100" heigth="100" /></td>
                <td><?= $row->nama ?></td>
                <td><?= $row->jumlah ?></td>
                <td><?= rupiah($row->harga) ?></td>
                <td><?= rupiah($row->sub_total) ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="5" align="center">
                Total
            </td>
            <td align="center">
                <span><?= rupiah($total) ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="5" align="center">
                Grand Total
            </td>
            <td align="center">
                <span><?= rupiah($total) ?></span>
            </td>
        </tr>
    </table>
</div>