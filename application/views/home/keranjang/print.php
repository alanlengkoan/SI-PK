<!-- CSS -->
<style media="screen">
    .body {
        padding: 4mm;
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

    table {
        font-size: 15px;
        border-collapse: collapse;
    }

    table td {
        padding-left: 5px;
    }

    hr {
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
    }
</style>
<!-- CSS -->

<div class="body">
    <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
        <tr>
            <td width='100%' align='CENTER'>
                <span style='color:black;'>
                    <h3>NOTA</h3>
                    </br>
                    <?= $this->m_pengaturan->getFirstRecord()->nama ?? '-' ?>
                </span>
            </td>
        </tr>
        <tr>
            <td colspan='5'>
                <hr>
            </td>
        </tr>
    </table>

    <h3>Detail Pembayaran</h3>
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
    <br />
    <h3>Pembayaran</h3>
    <table>
        <tr>
            <td>Metode Pembayaran</td>
            <td><?= ($data_pemesanan->metode_pembayaran === 'c' ? 'Tunai' : 'Transfer') ?></td>
        </tr>
        <tr>
            <td>Status Pembayaran</td>
            <td><?= ($data_pemesanan->status_pembayaran === 0 ? 'Menunggu Pembayaran' : 'Telah Melakukan Pembayaran') ?></td>
        </tr>
    </table>
    <br />
    <h3>Tabel Produk</h3>
    <table cellpadding="4" cellspacing="0">
        <tr align='center'>
            <th width='10%'>Nama</th>
            <th width='4%'>Jumlah</th>
            <th width='13%'>Harga</th>
            <th width='13%'>Sub Total</th>
        </tr>
        <?php
        $total = 0;
        foreach ($data_pemesanan_detail as $key => $row) {
            $total = ($total + $row->sub_total);
        ?>
            <tr align="center">
                <td><?= $row->nama ?></td>
                <td><?= $row->jumlah ?></td>
                <td><?= rupiah($row->harga) ?></td>
                <td><?= rupiah($row->sub_total) ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="3" align="right">
                Total
            </td>
            <td align="right">
                <span><?= rupiah($total) ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="right">
                Ongkos Kirim
            </td>
            <td align="right">
                <span><?= rupiah($data_pemesanan->tarif) ?></span>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="right">
                Grand Total
            </td>
            <td align="right">
                <?php $grand_total = ($total + $data_pemesanan->tarif) ?>
                <span><?= rupiah($grand_total) ?></span>
            </td>
        </tr>
    </table>
</div>