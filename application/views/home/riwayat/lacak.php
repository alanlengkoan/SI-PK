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
                    <p><i>Note :</i> Silahkan chat kami jika terdapat keterlambatan!</p>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div id="tracking">
                            <div class="tracking-list">
                                <?php
                                $status_pengantaran = ['Dikemas', 'Dikirim', 'Diterima'];
                                $icon_pengantaran   = ['gift', 'motorcycle', 'check'];
                                $color_pengantaran  = ['yellow', 'blue', 'green'];
                                foreach ($pengantaran->result() as $row) { ?>
                                    <div class="tracking-item">
                                        <div class="tracking-icon status-intransit" style="background-color: <?= $color_pengantaran[$row->status] ?>">
                                            <i class="fa fa-<?= $icon_pengantaran[$row->status] ?>" style="font-size: 25px; padding-top: 7px;"></i>
                                        </div>
                                        <div class="tracking-date">
                                            <?= $row->waktu ?><span><?= $row->jam ?></span>
                                        </div>
                                        <div class="tracking-content">
                                            Pesanan Anda saat ini sedang :
                                            <span><?= $status_pengantaran[$row->status] ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="chat-box bg-white">
                            <!-- begin:: chat -->
                            <div id="dom_chat"></div>
                            <!-- end:: chat -->
                        </div>
                        <form id="form-send" class="bg-light" action="<?= base_url() ?>send_chat" method="POST">
                            <!-- begin:: kd pemesanan -->
                            <input type="hidden" name="kd_pemesanan" id="kd_pemesanan" value="<?= base64url_encode($kd_pemesanan) ?>" />
                            <!-- end:: kd pemesanan -->

                            <div class="input-group">
                                <input type="text" name="pesan" id="pesan" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" placeholder="Masukkan Pesan Anda">
                                <div class="input-group-append">
                                    <button type="submit" id="kirim" class="btn btn-default" style="height: 48px;">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>