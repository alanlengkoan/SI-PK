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
                <!-- begin:: form -->
                <div class="card">
                    <div class="card-header">
                        <h5><?= $title ?></h5>
                        <span><i>Note :</i> Silahkan bayar sesuai dengan total yang tertera!</span>
                    </div>
                    <div class="card-block">
                        <form id="form-pembayaran" action="<?= admin_url() ?>pemesanan/pembayaran_b" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode Order</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inpkdorder" id="inpkdorder" value="<?= $kd_pemesanan ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Total</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inptotal" id="inptotal" value="<?= create_separator($total) ?>" readonly="readonly" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Penyetor *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inpnamapenyetor" id="inpnamapenyetor" placeholder="Masukkan nama penyetor" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jumlah Bayar *</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inpjumlahbayar" id="inpjumlahbayar" placeholder="Masukkan jumlah bayar" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Bukti Terima *</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="inpbukti" id="inpbukti" placeholder="Masukkan rekening" />
                                    <p>File dengan tipe (*.jpg,*.jpeg,*.png) Max. 20MB</p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="proses"><i class="fa fa-check"></i>&nbsp;Proses</button>
                        </form>
                    </div>
                </div>
                <!-- end:: form -->
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->