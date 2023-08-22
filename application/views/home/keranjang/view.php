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
                    <p>Daftar Keranjang Anda.</p>
                </div>
                <form action="<?= base_url() ?>checkout" method="post">
                    <div class="table-content table-responsive">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th>Kode Produk</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Sub Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($keranjang->result() as $key => $row) {
                                    $total         = ($total + $row->sub_total);
                                    $stock_terjual = ($row->stock - $row->jumlah);
                                    $stock         = $stock_terjual;
                                    // untuk diskon
                                    $diskon       = (int) $row->diskon / 100;
                                    $harga_diskon = (int) $row->harga * $diskon;
                                    $harga        = (int) $row->harga - round($harga_diskon);
                                ?>
                                    <tr>
                                        <td class="product-name"><?= $row->kd_produk ?></td>
                                        <td class="product-name">
                                            <?= $row->nama ?>
                                            <input type="hidden" name="inpidkeranjang[]" id="inpidkeranjang" value="<?= $row->id_keranjang ?>" />
                                        </td>
                                        <td class="product-quantity">
                                            <div class="pro-dec-cart">
                                                <input class="cart-plus-minus-box" type="text" onkeydown="return justAngka(event)" name="inpjumlah[]" id="inpjumlah" data-stock="<?= $stock ?>" value="<?= $row->jumlah_keranjang ?>" />
                                            </div>
                                        </td>
                                        <td class="product-price-cart">
                                            <?= create_separator($row->harga) ?>
                                            <input type="hidden" name="inpharga[]" id="inpharga" value="<?= $harga ?>" />
                                        </td>
                                        <td><?= ($row->diskon === null ? 0 : $row->diskon) ?>&nbsp;%</td>
                                        <td class="product-price-cart">
                                            <span id="sub-total"><?= create_separator($row->sub_total) ?></span>
                                            <input type="hidden" name="inpsubtotal[]" id="inpsubtotal" value="<?= $row->sub_total ?>" />
                                        </td>
                                        <td class="product-remove">
                                            <?php if ($row->jenis === 'cake') { ?>
                                                <a href="<?= base_url() ?>keranjang/detail/<?= base64url_encode($row->kd_produk) ?>"><i class="fa fa-info"></i></a>
                                            <?php } ?>
                                            <a href="#" id="btn-hapus" data-id="<?= $row->kd_produk ?>"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="<?= base_url() ?>produk">Lanjut Belanja</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6"></div>
                        <div class="col-lg-4 col-md-6"></div>
                        <div class="col-lg-4 col-md-12">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h4 class="grand-totall-title">Grand Total <span id="total"><?= create_separator($total) ?></span></h4>
                                <button type="submit" class="btn btn-success">Checkout</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>