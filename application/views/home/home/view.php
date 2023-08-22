<!-- begin:: slider -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($slide as $key => $row) { ?>
            <div class="carousel-item <?= ($key === 0 ? 'active' : '') ?>">
                <a href="<?= base_url() ?>diskon/<?= $row->diskon ?>">
                    <img class="d-block w-100" src="<?= upload_url('gambar') ?><?= $row->gambar ?>" alt="<?= $row->judul ?>">
                </a>
            </div>
        <?php } ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- end:: slider -->

<!-- begin:: product -->
<div class="product-area gray-bg pt-90 pb-65">
    <div class="container">
        <div class="product-top-bar section-border mb-55">
            <div class="section-title-wrap text-center">
                <h3 class="section-title">Produk Terlaris</h3>
            </div>
        </div>
        <div class="row flex-row-reverse">
            <div class="col-lg-12">
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <!-- begin:: produk laris -->
                            <?php foreach ($p_laris as $key => $row) { ?>
                                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                            <a href="<?= base_url() ?>produk/detail/<?= base64url_encode($row->kd_produk) ?>">
                                                <img src="<?= upload_url('gambar') ?><?= $row->gambar ?>" alt="<?= $row->nama ?>" title="<?= $row->nama ?>">
                                            </a>
                                            <?php if ($row->diskon > 0) { ?>
                                                <span><?= $row->diskon ?> %</span>
                                            <?php } ?>

                                            <?php if ($row->jenis === 'dessert') { ?>
                                                <?php
                                                $stock_terjual = ($row->stock - $row->jumlah);
                                                $stock = ($row->jumlah_keranjang == null) ? $row->stock - $row->jumlah : $stock_terjual - $row->jumlah_keranjang;
                                                if ($stock > 0) { ?>
                                                    <div class="product-action">
                                                        <a class="action-cart" id="btn-keranjang" href="#" title="Tambah Keranjang" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_produk="<?= $row->kd_produk ?>" data-jenis="<?= $row->jenis ?>">
                                                            <i class="ion-ios-shuffle-strong"></i>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <div class="product-action">
                                                    <a class="action-cart" id="btn-keranjang" href="#" title="Tambah Keranjang" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_produk="<?= $row->kd_produk ?>" data-jenis="<?= $row->jenis ?>">
                                                        <i class="ion-ios-shuffle-strong"></i>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="product-content text-left">
                                            <div class="product-hover-style">
                                                <div class="product-title">
                                                    <h4>
                                                        <a href="<?= base_url() ?>produk/detail/<?= base64url_encode($row->kd_produk) ?>"><?= $row->nama ?></a>
                                                    </h4>
                                                </div>
                                                <div class="cart-hover">
                                                    <h4><a href="<?= base_url() ?>produk/detail/<?= base64url_encode($row->kd_produk) ?>">+ Add to cart</a></h4>
                                                </div>
                                            </div>
                                            <!-- begin:: harga -->
                                            <div class="product-price-wrapper">
                                                <?php if ($row->diskon > 0) {
                                                    $diskon       = (int) $row->diskon / 100;
                                                    $harga_diskon = (int) $row->harga * $diskon;
                                                    $result       = (int) $row->harga - round($harga_diskon);
                                                ?>
                                                    <span><?= rupiah($result) ?> |</span>
                                                    <span class="product-price-old"><?= rupiah($row->harga) ?></span>
                                                <?php } else { ?>
                                                    <span><?= rupiah($row->harga) ?></span>
                                                <?php } ?>
                                            </div>
                                            <!-- end:: harga -->
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- end:: produk laris -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="product-top-bar section-border mb-55">
            <div class="section-title-wrap text-center">
                <h3 class="section-title">Produk Terlaris Bulan Ini</h3>
            </div>
        </div>
        <div class="row flex-row-reverse">
            <div class="col-lg-12">
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <!-- begin:: produk laris -->
                            <?php foreach ($p_laris_bulan_sekarang as $key => $row) { ?>
                                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                            <a href="<?= base_url() ?>produk/detail/<?= base64url_encode($row->kd_produk) ?>">
                                                <img src="<?= upload_url('gambar') ?><?= $row->gambar ?>" alt="<?= $row->nama ?>" title="<?= $row->nama ?>">
                                            </a>
                                            <?php if ($row->diskon > 0) { ?>
                                                <span><?= $row->diskon ?> %</span>
                                            <?php } ?>

                                            <?php if ($row->jenis === 'dessert') { ?>
                                                <?php
                                                $stock_terjual = ($row->stock - $row->jumlah);
                                                $stock = ($row->jumlah_keranjang == null) ? $row->stock - $row->jumlah : $stock_terjual - $row->jumlah_keranjang;
                                                if ($stock > 0) { ?>
                                                    <div class="product-action">
                                                        <a class="action-cart" id="btn-keranjang" href="#" title="Tambah Keranjang" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_produk="<?= $row->kd_produk ?>" data-jenis="<?= $row->jenis ?>">
                                                            <i class="ion-ios-shuffle-strong"></i>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <div class="product-action">
                                                    <a class="action-cart" id="btn-keranjang" href="#" title="Tambah Keranjang" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_produk="<?= $row->kd_produk ?>" data-jenis="<?= $row->jenis ?>">
                                                        <i class="ion-ios-shuffle-strong"></i>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="product-content text-left">
                                            <div class="product-hover-style">
                                                <div class="product-title">
                                                    <h4>
                                                        <a href="<?= base_url() ?>produk/detail/<?= base64url_encode($row->kd_produk) ?>"><?= $row->nama ?></a>
                                                    </h4>
                                                </div>
                                                <div class="cart-hover">
                                                    <h4><a href="<?= base_url() ?>produk/detail/<?= base64url_encode($row->kd_produk) ?>">+ Add to cart</a></h4>
                                                </div>
                                            </div>
                                            <!-- begin:: harga -->
                                            <div class="product-price-wrapper">
                                                <?php if ($row->diskon > 0) {
                                                    $diskon       = (int) $row->diskon / 100;
                                                    $harga_diskon = (int) $row->harga * $diskon;
                                                    $result       = (int) $row->harga - round($harga_diskon);
                                                ?>
                                                    <span><?= rupiah($result) ?> |</span>
                                                    <span class="product-price-old"><?= rupiah($row->harga) ?></span>
                                                <?php } else { ?>
                                                    <span><?= rupiah($row->harga) ?></span>
                                                <?php } ?>
                                            </div>
                                            <!-- end:: harga -->
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- end:: produk laris -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: product -->