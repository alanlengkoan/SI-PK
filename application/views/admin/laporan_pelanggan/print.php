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
                <h3>LAPORAN DETAIL PELANGGAN</h3>
            </td>
        </tr>
    </table>
    <hr>
    <h3>Detail Pelanggan</h3>
    <table align="center">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $pelanggan->nama ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><?= $pelanggan->email ?></td>
        </tr>
        <tr>
            <td>No. Hp</td>
            <td>:</td>
            <td><?= $pelanggan->telepon ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?= ($pelanggan->kelamin == "L" ? "Laki - laki" : "Perempuan") ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $pelanggan->alamat ?></td>
        </tr>
    </table>

    <br>
    <h3>Detail Order</h3>
    <table align="center" border="1" cellpadding="4" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Pemesanan</th>
                <th>Tanggal Pemesanan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            $no = 1;
            foreach ($laporan as $key => $row) { ?>
                <tr>
                    <td rowspan="<?= count($row['detail']) + 1 ?>"><?= $no++ ?></td>
                    <td rowspan="<?= count($row['detail']) + 1 ?>"><?= $row['kd_order'] ?></td>
                    <td rowspan="<?= count($row['detail']) + 1 ?>"><?= $row['tgl_pemesanan'] ?></td>
                    <td colspan="4"></td>
                    <?php foreach ($row['detail'] as $rows) {
                        $total = $total + $rows->sub_total;
                    ?>
                <tr>
                    <td><?= $rows->nama ?></td>
                    <td><?= $rows->jumlah ?></td>
                    <td><?= create_separator($rows->harga) ?></td>
                    <td><?= create_separator($rows->sub_total) ?></td>
                </tr>
            <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" style="text-align: center;">Total</th>
                <th><?= create_separator($total) ?></th>
            </tr>
        </tfoot>
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