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
                        <th>Kode Order</th>
                        <th>Nama</th>
                        <th>Tanggal Pembelian</th>
                        <th>Jam Pembelian</th>
                        <th>Kode Produk</th>
                        <th>Total</th>
                        <th>Total Pembelian</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $total_pembelian = 0; ?>
                    <?= $total_bayar = 0; ?>
                    <?= $kd_pemesanan_ = ''; ?>
                    <?php foreach ($laporan as $key => $value) { ?>
                        <?php foreach ($value as $row) { ?>
                            <?php
                            $sub_total       = array_sum(array_column($laporan[$key], 'total_pembelian'));
                            $total_pembelian = $total_pembelian + $row['total_pembelian'];
                            if ($kd_pemesanan_ != $row['kode_order']) {
                                $total_bayar = $total_bayar + $row['total_bayar'];
                            }
                            ?>
                            <tr>
                                <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $row['kode_order']); ?></td>
                                <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $row['customer']); ?></td>
                                <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $row['tanggal_pembelian']); ?></td>
                                <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $row['jam_pembelian']); ?></td>
                                <td><?= $row['kode_produk'] ?></td>
                                <td><?= $row['total_pembelian'] ?></td>
                                <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $sub_total); ?></td>
                                <td><?= ($kd_pemesanan_ == $row['kode_order'] ? null : $row['total_bayar']); ?></td>
                            </tr>

                            <?php $kd_pemesanan_ = $row['kode_order'] ?>
                        <?php } ?>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6" style="text-align: center;">Total</th>
                        <th><?= create_separator($total_pembelian) ?></th>
                        <th><?= create_separator($total_bayar) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>