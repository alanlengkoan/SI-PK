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
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Bintang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?= ($ulasan['bintang'] === null ? '-' : $ulasan['bintang']) ?>" readonly="readonly" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Komentar</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" readonly="readonly"><?= ($ulasan['komentar'] === null ? '-' : $ulasan['komentar']) ?></textarea>
                            </div>
                        </div>
                        <a class="btn btn-danger btn-sm waves-effect" href="<?= admin_url() ?>pemesanan">
                            <i class="fa fa-arrow-left"></i>&nbsp;Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->