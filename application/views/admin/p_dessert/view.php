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
                            <div class="col-lg-6 text-right">
                                <button type="button" id="btn-add" class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <table class="table table-striped table-bordered nowrap" id="tabel-produk-dessert">
                        </table>
                    </div>
                </div>
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
            <form id="form-add" action="<?= admin_url() ?>p_dessert/process_add" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kode Produk&nbsp;*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="inpkdproduk" id="inpkdproduk" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="inpnama" id="inpnama" placeholder="Masukkan nama produk" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Satuan *</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="inpsatuan" id="inpsatuan">
                                <option value="">- Pilih Satuan -</option>
                                <?php foreach ($satuan as $key => $row) { ?>
                                    <option value="<?= $row->kd_satuan ?>"><?= $row->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Diskon *</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="inpdiskon" id="inpdiskon">
                                <option value="">- Pilih Diskon -</option>
                                <?php foreach ($diskon as $key => $row) { ?>
                                    <option value="<?= $row->id_diskon ?>"><?= $row->diskon ?>&nbsp;%</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ukuran *</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="inpukuran" id="inpukuran">
                                <option value="">- Pilih Ukuran -</option>
                                <?php foreach ($ukuran as $key => $row) { ?>
                                    <option value="<?= $row->id_ukuran ?>"><?= $row->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Harga *</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="inpharga" id="inpharga" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" placeholder="Masukkan harga" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Gambar *</label>
                        <div class="col-sm-10">
                            <div id="lihat_gambar"></div>
                            <input type="file" class="form-control" name="inpgambar" id="inpgambar" placeholder="Masukkan rekening" />
                            <div id="centang_gambar"></div>
                            <p>File dengan tipe (*.jpg,*.jpeg,*.png) Max. 20MB</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Deskripsi *</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="inptentang" id="inptentang" placeholder="Masukkan deskripsi produk"></textarea>
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