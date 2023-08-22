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

<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-1">pemesanan</a></h5>
                            </div>
                            <div id="payment-1" class="panel-collapse collapse show">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Kode Order</label>
                                                    <input type="text" placeholder="<?= $data_pemesanan->kd_pemesanan ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Nama</label>
                                                    <input type="text" placeholder="<?= $data_pemesanan->nama ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>E-Mail</label>
                                                    <input type="text" placeholder="<?= $data_pemesanan->email ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>No. Telepon</label>
                                                    <input type="text" placeholder="<?= $data_pemesanan->telepon ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Jenis Kelamin</label>
                                                    <input type="text" placeholder="<?= ($data_pemesanan->kelamin === 'L' ? 'Laki - laki' : 'Perempuan') ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Alamat</label>
                                                    <input type="text" placeholder="<?= $data_pemesanan->alamat ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Tanggal Pemesanan</label>
                                                    <input type="text" placeholder="<?= $data_pemesanan->tgl_pemesanan ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Jam Pemesanan</label>
                                                    <input type="text" placeholder="<?= $data_pemesanan->jam_pemesanan ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Tanggal Pemesanan</label>
                                                    <input type="text" placeholder="<?= $data_pemesanan->tgl_pengambilan ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Metode Pengantaran</label>
                                                    <input type="text" placeholder="<?= ($data_pemesanan->metode_pengantaran === 'b' ? 'Dijemput' : 'Diantar') ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <?php if ($data_pemesanan->metode_pengantaran == 's') { ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Status Pengantaran</label>
                                                        <?php $status_pengantaran = ['Dikemas', 'Dikirim', 'Diterima']; ?>
                                                        <input type="text" placeholder="<?= $status_pengantaran[$data_pemesanan->status_pengantaran] ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-2">pembayaran</a></h5>
                            </div>
                            <div id="payment-2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Metode Pembayaran</label>
                                                    <input type="text" placeholder="<?= ($data_pemesanan->metode_pembayaran === 'c' ? 'COD' : 'Transfer') ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="billing-info">
                                                    <label>Status Pembayaran</label>
                                                    <input type="text" placeholder="<?= ($data_pemesanan->status_pembayaran === '0' ? 'Menunggu Pembayaran' : 'Telah Melakukan Pembayaran') ?>" readonly="readonly" />
                                                </div>
                                            </div>
                                            <?php if ($data_pemesanan->metode_pembayaran === 't') { ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Bank</label>
                                                        <input type="text" placeholder="<?= $data_pembayaran->nama ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Rekening</label>
                                                        <input type="text" placeholder="<?= $data_pembayaran->rekening ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Atas Nama</label>
                                                        <input type="text" placeholder="<?= ($data_pembayaran->nama_penyetor === null ? '-' : $data_pembayaran->nama_penyetor) ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Nama Penyetor</label>
                                                        <input type="text" placeholder="<?= ($data_pembayaran->atas_nama === null ? '-' : $data_pembayaran->atas_nama) ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Tanggal Transfer</label>
                                                        <input type="text" placeholder="<?= ($data_pembayaran->tgl_transfer === null ? '-' : $data_pembayaran->tgl_transfer) ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Jam Transfer</label>
                                                        <input type="text" placeholder="<?= ($data_pembayaran->jam_transfer === null ? '-' : $data_pembayaran->jam_transfer) ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <?= ($data_pembayaran->bukti === null ? '-' : '<img src="' . upload_url('gambar') . '' . $data_pembayaran->bukti  . '" width="100" heigth="100" />') ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Jumlah Transfer</label>
                                                        <input type="text" placeholder="<?= ($data_pembayaran->jumlah_transfer === null ? '-' : rupiah($data_pembayaran->jumlah_transfer)) ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <?php if ($data_pemesanan->status_pembayaran == '0') { ?>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <a class="btn btn-success" href="<?= base_url() ?>transfer/<?= base64_encode($data_pemesanan->kd_pemesanan) ?>"><i class="fa fa-money"></i>&nbsp;Transfer</a>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Nama Bayar</label>
                                                        <input type="text" placeholder="<?= ($data_pembayaran->nama_bayar === null ? '-' : $data_pembayaran->nama_bayar) ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Jumlah Bayar</label>
                                                        <input type="text" placeholder="<?= ($data_pembayaran->jumlah_bayar === null ? '-' : $data_pembayaran->jumlah_bayar) ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Tanggal Bayar</label>
                                                        <input type="text" placeholder="<?= ($data_pembayaran->tgl_bayar === null ? '-' : $data_pembayaran->tgl_bayar) ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Jam Bayar</label>
                                                        <input type="text" placeholder="<?= ($data_pembayaran->jam_bayar === null ? '-' : $data_pembayaran->jam_bayar) ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-3">detail pemesanan</a></h5>
                            </div>
                            <div id="payment-3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="order-review-wrapper">
                                        <div class="order-review">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Detail</th>
                                                            <th>Gambar</th>
                                                            <th>Nama</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Diskon</th>
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
                                                            <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td class="text-center">
                                                                    <?php if ($row->jenis === 'cake') { ?>
                                                                        <a href="<?= base_url() ?>detail?kd_pemesanan=<?= base64url_encode($row->kd_pemesanan) ?>&kd_produk=<?= base64_encode($row->kd_produk) ?>" target="_blank"><i class="fa fa-info"></i></a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <img src="<?= upload_url('gambar') ?><?= $row->gambar ?>" width="100" heigth="100" />
                                                                </td>
                                                                <td>
                                                                    <?= $row->nama ?>
                                                                </td>
                                                                <td>
                                                                    <?= $row->jumlah ?>
                                                                </td>
                                                                <td>
                                                                    <?= rupiah($row->harga) ?>
                                                                </td>
                                                                <td>
                                                                    <?= ($row->diskon === null ? 0 : $row->diskon) ?>&nbsp;%
                                                                </td>
                                                                <td>
                                                                    <?= rupiah($row->sub_total) ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="7" align="center">
                                                                Total
                                                            </td>
                                                            <td align="center">
                                                                <span><?= rupiah($total) ?></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="7" align="center">
                                                                Ongkos Kirim
                                                            </td>
                                                            <td align="center">
                                                                <span><?= rupiah($data_pemesanan->tarif) ?></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6" align="center">
                                                                Grand Total
                                                            </td>
                                                            <td align="center">
                                                                <?php $grand_total = ($total + $data_pemesanan->tarif) ?>
                                                                <span><?= rupiah($grand_total) ?></span>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <?php if ($data_pemesanan->status_pembayaran === '1') { ?>
                                                <a class="btn btn-primary btn-sm" href="<?= base_url() ?>cetak/<?= base64url_encode($data_pemesanan->kd_pemesanan) ?>" target="_blank">
                                                    <i class="fa fa-print"></i>&nbsp;Cetak
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>