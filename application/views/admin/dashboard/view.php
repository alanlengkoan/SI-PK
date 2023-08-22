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
                <div class="row">
                    <!-- begin:: subscribe -->
                    <div class="col-md-12 col-lg-4">
                        <div class="card">
                            <div class="card-block text-center">
                                <i class="feather icon-box text-c-blue d-block f-40"></i>
                                <h4 class="m-t-20"><span class="text-c-blue"><?= $produk ?></span>&nbsp;Produk</h4>
                                <p class="m-b-20">Gabungan Produk Cake dan Dessert.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-block text-center">
                                <i class="feather icon-users text-c-green d-block f-40"></i>
                                <h4 class="m-t-20"><span class="text-c-green"><?= $pelanggan ?></span>&nbsp;Pelanggan</h4>
                                <a class="btn btn-success btn-sm btn-round" href="<?= admin_url() ?>pelanggan">Lihat</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-block text-center">
                                <i class="feather icon-users text-c-red d-block f-40"></i>
                                <h4 class="m-t-20"><span class="text-c-red"><?= $kurir ?></span>&nbsp;Kurir</h4>
                                <a class="btn btn-danger btn-sm btn-round" href="<?= admin_url() ?>kurir">Lihat</a>
                            </div>
                        </div>
                    </div>
                    <!-- end:: subscribe -->

                    <!-- begin:: chart -->
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Pemesanan</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                        <li><i class="feather icon-maximize full-card"></i></li>
                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                        <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                        <li><i class="feather icon-trash close-card"></i></li>
                                        <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <figure class="highcharts-figure">
                                    <div id="pemesanan"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Pelanggan</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                        <li><i class="feather icon-maximize full-card"></i></li>
                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                        <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                        <li><i class="feather icon-trash close-card"></i></li>
                                        <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <figure class="highcharts-figure">
                                    <div id="pelanggan"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <!-- end:: chart -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->