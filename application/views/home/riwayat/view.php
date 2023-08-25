<!-- begin:: breadcrumb -->
<div class="breadcrumb-area bg-image-3 ptb-200">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3><?= $title ?></h3>
            <ul>
                <li><a href="<?= base_url() ?>">Beranda</a></li>
                <li class="active"><?= $title ?> </li>
            </ul>
        </div>
    </div>
</div>
<!-- end:: breadcrumb -->

<div class="cart-main-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="small-title mb-30">
                    <h2><?= $title ?></h2>
                    <p>Daftar Riwayat Pembelian Anda.</p>
                </div>
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Order</th>
                                <th>Nama</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Jam Pemesanan</th>
                                <th>Metode Pembayaran</th>
                                <th>Status Pengantaran</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $status_pengantaran = ['Dikemas', 'Dikirim', 'Diterima'];
                            foreach ($riwayat->result() as $key => $row) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->kd_pemesanan ?></td>
                                    <td><?= $row->nama ?></td>
                                    <td><?= $row->tgl_pemesanan ?></td>
                                    <td><?= $row->jam_pemesanan ?></td>
                                    <td><?= ($row->metode_pembayaran === 'c' ? 'COD' : 'Transfer') ?></td>
                                    <td>
                                        <?php if ($row->metode_pemesanan === 'e') { ?>
                                            Ditempat
                                        <?php } else { ?>
                                            <a href="<?= base_url() ?>lacak/<?= base64url_encode($row->kd_pemesanan) ?>"><?= $status_pengantaran[$row->status_pengantaran] ?></a>
                                        <?php } ?>
                                    </td>
                                    <td><?= rupiah($row->total) ?></td>
                                    <td>
                                        <?php if ($row->status_pembayaran === '1') { ?>
                                            <a href="<?= base_url() ?>nota/<?= base64url_encode($row->kd_pemesanan) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>&nbsp;Nota</a>
                                        <?php } else { ?>
                                            <a href="<?= base_url() ?>nota/<?= base64url_encode($row->kd_pemesanan) ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>&nbsp;Nota</a>
                                            <button type="button" id="btn-batal" data-id="<?= $row->kd_pemesanan ?>" class="btn btn-danger btn-sm"><i class="fa fa-close"></i>&nbsp;Batal</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>