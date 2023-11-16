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
                <form id="form-add-upd-head" action="<?= pelayan_url() ?>pemesanan/process_save" method="POST">
                    <!-- begin:: form 1 -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="w-75 p-2">Transaksi <?= $title ?></h5>
                                </div>
                                <div class="col-lg-6 text-right">
                                </div>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode Order</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kd_pemesanan" id="kd_pemesanan" placeholder="Masukkan kode barang" value="<?= $no_transaksi ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Meja</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="id_meja" id="id_meja">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($meja as $key => $row) { ?>
                                            <option value="<?= $row->id_meja ?>"><?= $row->no_meja ?> (Jumlah kursi <?= $row->jumlah_kursi ?>)</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Metode Pembayaran</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="metode_pembayaran" id="metode_pembayaran">
                                        <option value="">- Pilih -</option>
                                        <option value="c">COD</option>
                                        <option value="t">Transfer</option>
                                    </select>
                                </div>
                            </div>
                            <div id="transfer" style="display: none;">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Bank *</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="id_bank" id="id_bank">
                                            <option value="">- Pilih -</option>
                                            <?php foreach ($bank as $key => $row) { ?>
                                                <option value="<?= $row->id_bank ?>" data-rekening="<?= $row->rekening ?>"><?= $row->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="nomor_rekening" style="display: none">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Rekening</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="rekening" class="form-control" value="0" readonly="readonly" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:: form 1 -->
                    <!-- begin:: table -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="w-75 p-2">Detail Transaksi <?= $title ?></h5>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <button type="button" id="btn-add" class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <table class="table table-striped table-bordered nowrap" id="tabel-temp-pemesanan" style="width: 100%;"></table>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jumlah_stok" id="jumlah_stok" value="0" placeholder="0" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Total Akhir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="total_akhir" id="total_akhir" value="0" placeholder="0" readonly="readonly" />
                                </div>
                            </div>
                            <div id="btn-simpan"></div>
                        </div>
                    </div>
                    <!-- end:: table -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->

<!-- begin:: modal tambah & ubah -->
<div class="modal fade" id="modal-add-upd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="judul-add-upd"></span> <?= $title ?></h4>
            </div>
            <form id="form-add-upd" action="<?= pelayan_url() ?>pemesanan/process_save_temp" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="id_keranjang" id="id_keranjang" />
                <!-- end:: id -->

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Barang *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="kd_produk" id="kd_produk">
                                <option value="">- Pilih Barang -</option>
                                <?php foreach ($produk as $key => $row) { ?>
                                    <option value="<?= $row->kd_produk ?>">(<?= $row->kd_produk ?>) - <?= $row->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Barang" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kategori *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Satuan Barang" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Harga *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="harga" id="harga" value="0" placeholder="0" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Stok Produksi *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="stok" id="stok" value="0" placeholder="0" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jumlah *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="jumlah" id="jumlah" onkeydown="return justAngka(event)" placeholder="0" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="total" id="total" value="0" placeholder="0" readonly="readonly" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm waves-effect" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="save"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end:: modal tambah & ubah -->