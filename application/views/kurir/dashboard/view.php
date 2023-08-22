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
                    <div class="col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-block text-center">
                                <i class="feather icon-box text-c-red d-block f-40"></i>
                                <h4 class="m-t-20"><span class="text-c-red"><?= $no ?></span> Belum Selesai</h4>
                                <p class="m-b-20">Pemesanan yang belum selesai.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-block text-center">
                                <i class="feather icon-box text-c-green d-block f-40"></i>
                                <h4 class="m-t-20"><span class="text-c-green"><?= $yes ?></span> Selesai</h4>
                                <p class="m-b-20">Pemesanan yang telah selesai.</p>
                            </div>
                        </div>
                    </div>
                    <!-- end:: subscribe -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->