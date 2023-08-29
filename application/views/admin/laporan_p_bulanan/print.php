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
                <h3>LAPORAN PENJUALAN</h3>
                <h3><?= $judul ?></h3>
            </td>
        </tr>
    </table>
    <hr>

    <table align="center" border="1" cellpadding="4" cellspacing="0">
        <tr>
            <th>Kode Order</th>
            <th>Nama</th>
            <th>Tanggal Pembelian</th>
            <th>Jam Pembelian</th>
            <th>Kode Produk</th>
            <th>Total</th>
            <th>Total Pembelian</th>
            <th>Total Bayar</th>
        </tr>
        <?= $total_pembelian = 0; ?>
        <?= $total_bayar = 0; ?>
        <?= $kd_pemesanan_ = ''; ?>
        <?php foreach ($laporan as $key => $value) { ?>
            <?php foreach ($value as $row) { ?>
                <?php
                $sub_total       = array_sum(array_column($laporan[$key], 'total_pembelian'));
                $total_pembelian = $total_pembelian + $row['total_pembelian'];
                if ($kd_pemesanan_ != $row['kode_order']) {
                    $total_bayar = $total_bayar + $row['total_bayar'];
                }
                ?>
                <tr>
                    <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $row['kode_order']); ?></td>
                    <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $row['customer']); ?></td>
                    <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $row['tanggal_pembelian']); ?></td>
                    <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $row['jam_pembelian']); ?></td>
                    <td><?= $row['kode_produk'] ?></td>
                    <td><?= $row['total_pembelian'] ?></td>
                    <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $sub_total); ?></td>
                    <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $row['total_bayar']); ?></td>
                </tr>

                <?php $kd_pemesanan_ = $row['kode_order'] ?>
            <?php } ?>
        <?php } ?>
        <tr>
            <th colspan="6" style="text-align: center;">Total</th>
            <th><?= create_separator($total_pembelian) ?></th>
            <th><?= create_separator($total_bayar) ?></th>
        </tr>
    </table>

    <br /><br />
    <br /><br />
    <table>
        <tr>
            <td align="center">
                <p>MAKASSAR, <?= tgl_indo(date('Y-m-d')) ?></p>
                <br />
                <br />
                <br />
                <br />
                <p class="nama"><?= get_users_detail($this->session->userdata('id'))->nama ?></p>
                <p>Administrator</p>
            </td>
        </tr>
    </table>
</div>