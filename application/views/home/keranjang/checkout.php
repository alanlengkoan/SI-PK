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
                        <form id="form-checkout" action="<?= base_url() ?>checkout/finish" method="post">
                            <!-- begin:: detail pembayaran -->
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
                                                        <input type="text" name="kd_pemesanan" id="kd_pemesanan" value="<?= $kd_order ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Nama *</label>
                                                        <input type="text" name="nama" id="nama" value="<?= $user->nama ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Jenis Kelamin *</label>
                                                        <select name="kelamin" id="kelamin">
                                                            <option value="">- Pilih -</option>
                                                            <option value="L" <?= ($user->kelamin === 'L' ? 'selected' : '') ?>>Laki - laki</option>
                                                            <option value="P" <?= ($user->kelamin === 'P' ? 'selected' : '') ?>>Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>E-Mail *</label>
                                                        <input type="text" name="email" id="email" value="<?= $user->email ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>No. Telepon *</label>
                                                        <input type="text" name="telepon" id="telepon" value="<?= $user->telepon ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Alamat *</label>
                                                        <textarea name="alamat" id="alamat"><?= $user->alamat ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Tanggal Pemesanan *</label>
                                                        <input type="datetime-local" name="tgl_pemesanan" id="tgl_pemesanan" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Metode Pemesanan *</label>
                                                        <select name="metode_pemesanan" id="metode_pemesanan">
                                                            <option value="">- Pilih -</option>
                                                            <option value="e">Ditempat</option>
                                                            <option value="a">Diantar</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="diantar" style="display: none;">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Lokasi Pengiriman *</label>
                                                            <select name="id_ongkir" id="id_ongkir">
                                                                <option value="">- Pilih -</option>
                                                                <?php foreach ($ongkir as $key => $row) { ?>
                                                                    <option value="<?= $row->id_ongkir ?>"><?= $row->lokasi ?> (<?= rupiah($row->tarif) ?>)</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="ditempat" style="display: none;">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Pilih Meja *</label>
                                                            <select name="id_meja" id="id_meja">
                                                                <option value="">- Pilih -</option>
                                                                <?php foreach ($meja as $key => $row) { ?>
                                                                    <option value="<?= $row->id_meja ?>"><?= $row->no_meja ?> (Jumlah kursi <?= $row->jumlah_kursi ?>)</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: detail pembayaran -->
                            <!-- begin:: produk order -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>2.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-2">detail pemesanan</a></h5>
                                </div>
                                <div id="payment-2" class="panel-collapse collapse show">
                                    <div class="panel-body">
                                        <div class="order-review-wrapper">
                                            <div class="order-review">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
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
                                                            $no = 1;
                                                            $total = 0;
                                                            foreach ($keranjang->result() as $key => $row) {
                                                                $total = ($total + $row->sub_total);
                                                            ?>
                                                                <tr>
                                                                    <td><?= $no++ ?></td>
                                                                    <td><?= $row->kd_produk ?></td>
                                                                    <td>
                                                                        <?= $row->nama ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $row->jumlah_keranjang ?>
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
                                                                <td colspan="6" align="center">
                                                                    Total
                                                                </td>
                                                                <td align="center">
                                                                    <span><?= rupiah($total) ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6" align="center">
                                                                    Grand Total
                                                                </td>
                                                                <td align="center">
                                                                    <span><?= rupiah($total) ?></span>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: produk order -->
                            <!-- begin:: pembayaran -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>3.</span> <a data-toggle="collapse" data-parent="#faq" href="#payment-3">pembayaran</a></h5>
                                </div>
                                <div id="payment-3" class="panel-collapse collapse show">
                                    <div class="panel-body">
                                        <div class="billing-information-wrapper">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Metode Pembayaran</label>
                                                        <select name="metode_pembayaran" id="metode_pembayaran">
                                                            <option value="">- Pilih -</option>
                                                            <option value="c">Tunai</option>
                                                            <option value="t">Transfer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="transfer" style="display: none;">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Bank *</label>
                                                            <select name="id_bank" id="id_bank">
                                                                <option value="">- Pilih -</option>
                                                                <?php foreach ($bank as $key => $row) { ?>
                                                                    <option value="<?= $row->id_bank ?>" data-rekening="<?= $row->rekening ?>"><?= $row->nama ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="nomor_rekening" style="display: none">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Rekening</label>
                                                            <input type="text" id="rekening" value="0" readonly="readonly" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: pembayaran -->
                            <button type="submit" class="btn btn-success" id="save">
                                <i class="fa fa-spinner"></i> Proses
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>