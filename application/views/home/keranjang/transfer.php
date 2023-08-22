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
                    <i>Note :</i>
                    <ul>
                        <li>Silahkan transfer sesuai dengan total yang tertera.</li>
                        <li>Silahkan melakukan pembayaran 1 * 24 jam. Jika, belum melakukan pembayaran sistem akan membatalkan pesanan.</li>
                    </ul>
                </div>
                <form id="form-transfer" action="<?= base_url() ?>pembayaran" method="post">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <label>Kode Order</label>
                                <input type="text" id="inpkkorder" name="inpkkorder" value="<?= $kd_pemesanan ?>" readonly="readonly" />
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <label>Bank</label>
                                <input type="text" value="<?= $pembayaran->nama ?>" readonly="readonly" />
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <label>Rekening</label>
                                <input type="text" value="<?= $pembayaran->rekening ?>" readonly="readonly" />
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <label>Total</label>
                                <input type="text" name="inptotal" id="inptotal" value="<?= create_separator($total) ?>" readonly="readonly" />
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <label>Nama Penyetor *</label>
                                <input type="text" name="inpnamapenyetor" id="inpnamapenyetor" />
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <label>Atas Nama *</label>
                                <input type="text" name="inpatasnama" id="inpatasnama" />
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <label>Bukti Pembayaran *</label>
                                <input type="file" name="inpbukti" id="inpbukti" />
                                <p>File dengan tipe (*.jpg,*.jpeg,*.png) Max. 20MB</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <button type="submit" class="btn btn-success" id="proses">
                                    <i class="fa fa-spinner"></i> Proses
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>