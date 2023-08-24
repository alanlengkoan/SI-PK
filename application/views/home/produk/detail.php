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
                                <li><?= count($produk_komentar->result()) ?> Reviews </li>
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
                    <div class="in-stock">
                        <?php
                        $stock = ($produk->stock - $produk->jumlah);
                        ?>
                        <p>Available: <span><?= ($stock > 0 ? 'In stock' : 'Out of stock') ?></span></p>
                        <p>Stock: <span><?= $stock ?></span></p>
                    </div>
                    <p><?= $produk->kategori ?></p>
                    <?php if ($stock > 0) { ?>
                        <div class="quality-add-to-cart">
                            <button type="button" class="btn btn-success" id="btn-keranjang" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_produk="<?= $produk->kd_produk ?>"><i class="fa fa-shopping-cart"></i>&nbsp;Beli</button>
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
                        <?= $produk->deskripsi ?>
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