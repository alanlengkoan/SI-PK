<!-- begin:: breadcumb -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h4 class="m-b-10"><?= $title ?></h4>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="feather icon-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#!">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end:: breadcumb -->

<!-- begin:: content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="w-75 p-2"><?= $title ?></h5>
                    </div>
                    <div class="card-block">
                        <?php if ($data_pemesanan->status_pembayaran === '1' && $data_pemesanan->status_pengantaran === '2') { ?>
                            <div class="alert alert-success background-success">
                                <strong>Berhasil!</strong> Transaksi telah diproses!
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-info background-info">
                                <strong>Progress!</strong> Transaksi sedang diproses!
                            </div>
                        <?php } ?>

                        <!-- begin:: form -->
                        <h3>Detail Pembayaran</h3>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode Order</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inpkdpemesanan" value="<?= $data_pemesanan->kd_pemesanan ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="<?= $data_pemesanan->nama ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal Pemesanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="<?= $data_pemesanan->tgl_pemesanan ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jam Pemesanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="<?= $data_pemesanan->jam_pemesanan ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Metode Pemesanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="<?= ($data_pemesanan->metode_pemesanan === 'e' ? 'Ditempat' : 'Diantar') ?>" readonly="readonly" />
                            </div>
                        </div>
                        <?php if ($data_pemesanan->metode_pemesanan == 'e') { ?>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Meja</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="<?= $data_pemesanan->no_meja ?> (Jumlah kursi <?= $data_pemesanan->jumlah_kursi ?>)" readonly="readonly" />
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status Pengantaran</label>
                                <div class="col-sm-10">
                                    <?php $status_pengantaran = ['Dikemas', 'Dikirim', 'Diterima']; ?>
                                    <input type="text" class="form-control" placeholder="<?= $status_pengantaran[$data_pemesanan->status_pengantaran] ?>" readonly="readonly" />
                                </div>
                            </div>
                        <?php } ?>
                        <!-- end:: form -->
                        <h3>Tabel Produk</h3>
                        <!-- begin:: table -->
                        <table class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr align="center">
                                    <th>No.</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                $no = 1;
                                foreach ($data_pemesanan_detail as $key => $row) {
                                    $total = ($total + $row->sub_total);
                                ?>
                                    <tr align="center">
                                        <td><?= $no++ ?></td>
                                        <td><img src="<?= upload_url('gambar/produk') ?><?= $row->gambar ?>" width="100" heigth="100" /></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= $row->jumlah ?></td>
                                        <td><?= rupiah($row->harga) ?></td>
                                        <td><?= rupiah($row->sub_total) ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
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
                                        Ongkos Kirim
                                    </td>
                                    <td align="center">
                                        <span><?= rupiah($data_pemesanan->tarif) ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="center">
                                        Grand Total
                                    </td>
                                    <td align="center">
                                        <?php $grand_total = ($total + $data_pemesanan->tarif) ?>
                                        <span><?= rupiah($grand_total) ?></span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- end:: table -->
                        <a class="btn btn-danger btn-sm waves-effect" href="<?= kurir_url() ?>pemesanan">
                            <i class="fa fa-arrow-left"></i>&nbsp;Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->