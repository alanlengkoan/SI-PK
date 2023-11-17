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
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75 p-2">Daftar <?= $title ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form-add-upd" action="<?= admin_url() ?>pembayaran/process_save" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode Pemesanan *</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kd_pemesanan" id="kd_pemesanan">
                                        <option value="">- Pilih Pemesanan -</option>
                                        <?php foreach ($pemesanan as $key => $row) { ?>
                                            <option value="<?= $row['kd_pemesanan'] ?>"><?= $row['kd_pemesanan'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Metode Pembayaran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metode_pembayaran" placeholder="Metode pembayaran" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Total</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="total" placeholder="0" readonly="readonly" />
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Bayar</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="bayar" id="bayar" placeholder="0" />
                                </div>
                            </div>
                            <button type="submit" id="save" class="btn btn-success btn-block btn-sm waves-effect"><i class="fa fa-credit-card"></i>&nbsp;Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->