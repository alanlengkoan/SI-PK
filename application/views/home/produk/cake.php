<!-- begin:: breadcrumb -->
<div class="breadcrumb-area bg-image-3 ptb-200">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3><?= $title ?></h3>
            <ul>
                <li><a href="<?= base_url() ?>">Beranda</a></li>
                <li class="active"><?= $title ?> </li>
            </ul>
        </div>
    </div>
</div>
<!-- end:: breadcrumb -->

<div class="shop-page-area ptb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-12">
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <!-- begin:: cake -->
                            <?php foreach ($p_cake as $key => $row) { ?>
                                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                            <a href="<?= base_url() ?>produk/detail/<?= base64url_encode($row->kd_produk) ?>">
                                                <img src="<?= upload_url('gambar') ?><?= $row->gambar ?>" alt="<?= $row->nama ?>" title="<?= $row->nama ?>">
                                            </a>
                                            <?php if ($row->diskon > 0) { ?>
                                                <span><?= $row->diskon ?> %</span>
                                            <?php } ?>
                                            <div class="product-action">
                                                <a class="action-cart" id="btn-keranjang" href="#" title="Tambah Keranjang" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_produk="<?= $row->kd_produk ?>" data-jenis="<?= $row->jenis ?>">
                                                    <i class="ion-ios-shuffle-strong"></i>
                                                </a>
                                            </div>
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
                            <!-- end:: cake -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>