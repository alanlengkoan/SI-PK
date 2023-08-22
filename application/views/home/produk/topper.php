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
                            <!-- begin:: topper -->
                            <?php foreach ($produk_topper->result() as $key => $row) { ?>
                                <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                    <div class="product-wrapper">
                                        <div class="product-img">
                                            <a href="<?= base_url() ?>produk/topper_detail/<?= base64url_encode($row->kd_topper) ?>">
                                                <img src="<?= upload_url('gambar') ?><?= $row->gambar ?>" alt="<?= $row->nama ?>" title="<?= $row->nama ?>">
                                            </a>
                                            <div class="product-action">
                                                <a href="#" class="action-cart" id="add-topper" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_topper="<?= $row->kd_topper ?>">
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
                                </div>
                            <?php } ?>
                            <!-- end:: topper -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- begin:: modal -->
<div class="modal fade" id="modalTopper" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Cake</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>keranjang/add" id="form-keranjang" method="post">
                <div class="modal-body">
                    <!-- begin:: id -->
                    <input type="hidden" name="inpidusers" id="inpidusers" value="<?= $this->session->userdata('id_users') ?>" />
                    <input type="hidden" name="inpkdproduk" id="inpkdproduk" />
                    <!-- end:: id -->

                    <select class="form-select" name="kd_produk" id="kd_produk">
                        <option selected>Pilih</option>
                        <?php foreach ($keranjang_cake->result() as $key => $value) { ?>
                            <option value="<?= $value->kd_produk ?>"><?= $value->nama ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-keranjang" title="Tambah Keranjang">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end:: modal -->