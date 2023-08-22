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
                    <p>Daftar Detail Keranjang Anda.</p>
                </div>
                <div class="table-content table-responsive">
                    <table width="100%">
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
                                    <td><?= $row->kd_topper ?></td>
                                    <td><?= $row->nama ?></td>
                                    <td><?= $row->jumlah ?></td>
                                    <td><?= create_separator($row->harga) ?></td>
                                    <td><?= create_separator($sub_total) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>