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
                <?php
                $status_pengantaran = ['Dikemas', 'Dikirim', 'Diterima'];
                foreach ($pemesanan->result() as $row) { ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="w-75 p-2"><?= $row->kd_pemesanan ?></h5>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <a href="<?= kurir_url() ?>pemesanan/detail/<?= base64url_encode($row->kd_pemesanan) ?>" class="btn btn-info btn-sm waves-effect lihat" data-id="<?= $row->kd_pemesanan ?>" target="_blank"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Nama</label>
                                <div class="col-sm-6">
                                    : <?= $row->nama ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Total</label>
                                <div class="col-sm-6">
                                    : <?= rupiah($row->total) ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Status Pengataran</label>
                                <div class="col-sm-6">
                                    : <?= $status_pengantaran[$row->status_pengantaran] ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Tanggal Pemesanan</label>
                                <div class="col-sm-6">
                                    : <?= $row->tgl_pemesanan ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Jam Pemesanan</label>
                                <div class="col-sm-6">
                                    : <?= $row->jam_pemesanan ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->