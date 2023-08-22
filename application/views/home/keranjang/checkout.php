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
                                                        <input type="text" name="inpkodeorder" id="inpkodeorder" value="<?= $kd_order ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Nama *</label>
                                                        <input type="text" name="inpnama" id="inpnama" value="<?= $user->nama ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>E-Mail *</label>
                                                        <input type="text" name="inpemail" id="inpemail" value="<?= $user->email ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>No. Telepon *</label>
                                                        <input type="text" name="inpnotelpon" id="inpnotelpon" value="<?= $user->telepon ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Alamat *</label>
                                                        <textarea name="inpalamat" id="inpalamat"><?= $user->alamat ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Tanggal Pengambilan *</label>
                                                        <input type="date" name="inptglpengambilan" id="inptglpengambilan" />
                                                        <p style="font-size: 10px;"><i>Note :</i> Tanggal Pengambilan 1 Hari Sebelumnya Tanggal Pemesanan.</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Metode Pengiriman *</label>
                                                        <select name="inpmetodepengantaran" id="inpmetodepengantaran">
                                                            <option value="">- Pilih -</option>
                                                            <option value="b">Dijemput</option>
                                                            <option value="s">Diantar</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="pengiriman" style="display: none;">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Lokasi Pengiriman *</label>
                                                            <select name="inpidongkir" id="inpidongkir">
                                                                <option value="">- Pilih -</option>
                                                                <?php foreach ($ongkir as $key => $row) { ?>
                                                                    <option value="<?= $row->id_ongkir ?>"><?= $row->lokasi ?> (<?= rupiah($row->tarif) ?>)</option>
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
                                                        <select name="inpmetodepembayaran" id="inpmetodepembayaran">
                                                            <option value="">- Pilih -</option>
                                                            <option value="c">COD</option>
                                                            <option value="t">Transfer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="transfer" style="display: none;">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Bank *</label>
                                                            <select name="inpidbank" id="inpidbank">
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
                                                            <input type="text" id="inprekening" value="0" readonly="readonly" />
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