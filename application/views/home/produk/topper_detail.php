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
                    <img class="zoompro" src="<?= upload_url('gambar') ?><?= $produk_topper->gambar ?>" alt="<?= $produk_topper->nama ?>" title="<?= $produk_topper->nama ?>" />
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?= $produk_topper->nama ?></h4>
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
                    <span><?= rupiah($produk_topper->harga) ?></span>
                    <div class="quality-add-to-cart">
                        <a href="#" class="btn btn-success" id="add-topper" data-id_users="<?= ($this->session->userdata('id_users') ? $this->session->userdata('id_users') : null) ?>" data-kd_topper="<?= $produk_topper->kd_topper ?>">
                            <i class="fa fa-shopping-cart"></i>&nbsp;Beli
                        </a>
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