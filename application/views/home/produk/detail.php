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

<div class="product-details pt-100 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-img">
                    <img class="zoompro" src="<?= upload_url('gambar') ?><?= $produk->gambar ?>" alt="<?= $produk->nama ?>" title="<?= $produk->nama ?>" />
                    <?php if ($produk->diskon > 0) { ?>
                        <span><?= $produk->diskon ?> %</span>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?= $produk->nama ?></h4>
                    <div class="rating-review">
                        <div class="pro-dec-rating">
                            <i class="ion-android-star-outline theme-star"></i>
                            <i class="ion-android-star-outline theme-star"></i>
                            <i class="ion-android-star-outline theme-star"></i>
                            <i class="ion-android-star-outline theme-star"></i>
                            <i class="ion-android-star-outline"></i>
                        </div>
                        <div class="pro-dec-review">
                            <ul>
                                <li>32 Reviews </li>
                                <li> Add Your Reviews</li>
                            </ul>
                        </div>
                    </div>
                    <!-- begin:: harga -->
                    <?php if ($produk->diskon > 0) {
                        $diskon       = (int) $produk->diskon / 100;
                        $harga_diskon = (int) $produk->harga * $diskon;
                        $result       = (int) $produk->harga - round($harga_diskon);
                    ?>
                        <span><?= rupiah($result) ?></span>
                    <?php } else { ?>
                        <span><?= rupiah($produk->harga) ?></span>
                    <?php } ?>
                    <!-- end:: harga -->
                    <?php if ($produk->jenis === 'dessert') { ?>
                        <div class="in-stock">
                            <?php
                            $stock = ($produk->stock - $produk->jumlah);
                            ?>
                            <p>Available: <span><?= ($stock > 0 ? 'In stock' : 'Out of stock') ?></span></p>
                            <p>Stock: <span><?= $stock ?></span></p>
                        </div>
                        <p><?= $produk->tentang ?></p>
                        <?php if ($stock > 0) { ?>
                            <div class="quality-add-to-cart">
                                <button type="button" class="btn btn-success" id="btn-keranjang" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_produk="<?= $produk->kd_produk ?>" data-jenis="<?= $produk->jenis ?>"><i class="fa fa-shopping-cart"></i>&nbsp;Beli</button>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p><?= $produk->tentang ?></p>
                        <div class="quality-add-to-cart">
                            <button type="button" class="btn btn-success" id="btn-keranjang" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_produk="<?= $produk->kd_produk ?>" data-jenis="<?= $produk->jenis ?>"><i class="fa fa-shopping-cart"></i>&nbsp;Beli</button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="description-review-area pb-70">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav text-center">
                <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                <a data-toggle="tab" href="#des-details2">Review</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <?= $produk->tentang ?>
                    </div>
                </div>
                <div id="des-details2" class="tab-pane">
                    <div class="rattings-wrapper">
                        <?php foreach ($produk_komentar->result() as $key => $row) { ?>
                            <div class="sin-rattings">
                                <div class="star-author-all">
                                    <div class="ratting-star f-left">
                                        <?php for ($i = 0; $i < $row->bintang; $i++) { ?>
                                            <i class="ion-star theme-color"></i>
                                        <?php } ?>
                                        <span>(<?= $row->bintang ?>)</span>
                                    </div>
                                    <div class="ratting-author f-right">
                                        <h3><?= $row->nama_user ?></h3>
                                        <span><?= $row->jam_posting ?></span>
                                        <span><?= tgl_indo($row->tgl_posting) ?></span>
                                    </div>
                                </div>
                                <?= $row->komentar ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($produk->jenis === 'cake') { ?>
    <div class="product-area pb-100">
        <div class="container">
            <div class="product-top-bar section-border mb-35">
                <div class="section-title-wrap">
                    <h3 class="section-title section-bg-white">Topper</h3>
                </div>
            </div>
            <div class="featured-product-active hot-flower owl-carousel product-nav">
                <?php foreach ($produk_topper->result() as $key => $row) { ?>
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="<?= base_url() ?>produk/topper_detail/<?= base64url_encode($row->kd_topper) ?>">
                                <img src="<?= upload_url('gambar') ?><?= $row->gambar ?>" alt="<?= $row->nama ?>" title="<?= $row->nama ?>">
                            </a>
                            <div class="product-action">
                                <a class="action-cart" id="btn-keranjang" href="#" title="Tambah Keranjang" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_produk="<?= $row->kd_topper ?>">
                                    <i class="ion-ios-shuffle-strong"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-content text-left">
                            <div class="product-hover-style">
                                <div class="product-title">
                                    <h4>
                                        <a href="<?= base_url() ?>produk/topper_detail/<?= base64url_encode($row->kd_topper) ?>"><?= $row->nama ?></a>
                                    </h4>
                                </div>
                                <div class="cart-hover">
                                    <h4><a href="<?= base_url() ?>produk/topper_detail/<?= base64url_encode($row->kd_topper) ?>">+ Add to cart</a></h4>
                                </div>
                            </div>
                            <div class="product-price-wrapper">
                                <span><?= rupiah($row->harga) ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>