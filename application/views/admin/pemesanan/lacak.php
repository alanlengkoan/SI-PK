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
                        <div class="row">
                            <!-- begin:: lacak -->
                            <div class="col-lg-6">
                                <div class="latest-update-card">
                                    <div class="card-block">
                                        <div class="latest-update-box">
                                            <?php
                                            $status_pengantaran = ['Dikemas', 'Dikirim', 'Diterima'];
                                            $icon_pengantaran   = ['gift', 'motorcycle', 'check'];
                                            $color_pengantaran  = ['yellow', 'blue', 'green'];
                                            foreach ($pengantaran->result() as $row) { ?>
                                                <div class="row p-t-20 p-b-20">
                                                    <div class="col-auto text-right update-meta">
                                                        <p class="text-muted m-b-0 d-inline">
                                                            <?= $status_pengantaran[$row->status] ?>
                                                        </p>
                                                        <i class="fa fa-<?= $icon_pengantaran[$row->status] ?> bg-c-<?= $color_pengantaran[$row->status] ?> update-icon"></i>
                                                    </div>
                                                    <div class="col">
                                                        <h6>Pesanan Anda saat ini pada waktu :</h6>
                                                        <p class="text-muted m-b-0">
                                                            <?= $row->waktu ?> | <?= $row->jam ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: lacak -->
                            <!-- begin:: pesan -->
                            <div class="col-lg-6 col-md-6 messages-content ">
                                <!-- begin:: chat -->
                                <div id="dom_chat"></div>
                                <!-- end:: chat -->
                                <div class="right-icon-control">
                                    <form id="form-send" class="form-material" action="<?= admin_url() ?>pemesanan/send_chat" method="POST">
                                        <!-- begin:: kd pemesanan -->
                                        <input type="hidden" name="kd_pemesanan" id="kd_pemesanan" value="<?= base64url_encode($kd_pemesanan) ?>" />
                                        <!-- end:: kd pemesanan -->

                                        <div class="form-group form-primary">
                                            <input type="text" name="pesan" id="pesan" class="form-control" />
                                            <span class="form-bar"></span>
                                            <label class="float-label">Masukkan Pesan Anda</label>
                                        </div>
                                        <div class="form-icon ">
                                            <button type="submit" id="kirim" class="btn btn-primary btn-icon  waves-effect waves-light">
                                                <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end:: pesan -->
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