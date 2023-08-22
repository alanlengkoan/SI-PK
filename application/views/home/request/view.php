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

<div class="cart-main-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="small-title mb-30">
                    <h2><?= $title ?></h2>
                    <p><i>Note :</i> Silahkan masukkan request Anda!</p>
                </div>
                <form id="form-transfer" action="<?= base_url() ?>request/add" method="post">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <label>Jenis Produk *</label>
                                <select name="inpjenis" id="inpjenis">
                                    <option value="">- Pilih -</option>
                                    <option value="cake">Cake</option>
                                    <option value="dessert">Dessert</option>
                                    <option value="topper">Topper</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <label>Gambar *</label>
                                <input type="file" name="inpgambar" id="inpgambar" />
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <label>Keterangan *</label>
                                <textarea name="inpketerangan" id="inpketerangan" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="billing-info">
                                <button type="submit" class="btn btn-success" id="proses">
                                    <i class="fa fa-spinner"></i> Proses
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>