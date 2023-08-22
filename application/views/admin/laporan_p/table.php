<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-6">
                <h5 class="w-75 p-2">Daftar <?= $title ?></h5>
            </div>
            <div class="col-lg-6 text-right">
            </div>
        </div>
    </div>
    <div class="card-block table-border-style">
        <div class="table-responsive">
            <table id="tabel_laporan" class="table table-striped table-bordered display no-wrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kode Order</th>
                        <th>Kode Produk</th>
                        <th>Tanggal Pembelian</th>
                        <th>Jam Pembelian</th>
                        <th>Total Pembelian</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_pembelian = 0;
                    $total_bayar = 0;
                    foreach ($laporan as $key => $value) { ?>
                        <tr>
                            <td rowspan="<?= count($value) + 1 ?>"><?= $key ?></td>
                            <?php foreach ($value as $row) {
                                $total_pembelian = $total_pembelian + $row['total_pembelian'];
                                $total_bayar = $total_bayar + $row['total_bayar'];
                            ?>
                        <tr>
                            <td><?= $row['kode_order'] ?></td>
                            <td><?= $row['kode_produk'] ?></td>
                            <td><?= $row['tanggal_pembelian'] ?></td>
                            <td><?= $row['jam_pembelian'] ?></td>
                            <td><?= create_separator($row['total_pembelian']) ?></td>
                            <td><?= create_separator($row['total_bayar']) ?></td>
                        </tr>
                    <?php } ?>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" style="text-align: center;">Total</th>
                        <th><?= create_separator($total_pembelian) ?></th>
                        <th><?= create_separator($total_bayar) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>