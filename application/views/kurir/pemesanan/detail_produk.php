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
                <div class="card">
                    <div class="card-header">
                        <h5 class="w-75 p-2"><?= $title ?></h5>
                    </div>
                    <div class="card-block">
                        <!-- end:: form -->
                        <h3>Tabel Produk</h3>
                        <!-- begin:: table -->
                        <table class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Kode Produk</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($keranjang->result() as $key => $row) {
                                    $sub_total = ($row->jumlah * $row->harga);
                                ?>
                                    <tr>
                                        <td class="product-name"><?= $row->kd_topper ?></td>
                                        <td class="product-name"><?= $row->nama ?></td>
                                        <td class="product-quantity"><?= $row->jumlah ?></td>
                                        <td class="product-price-cart"><?= create_separator($row->harga) ?></td>
                                        <td class="product-price-cart"><span id="sub-total"><?= create_separator($sub_total) ?></span></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- end:: table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->