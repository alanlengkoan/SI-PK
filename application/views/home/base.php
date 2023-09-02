<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Selamat Datang | <?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistem Informasi Pemesanan" />
    <meta name="keywords" content="Sistem Informasi Pemesanan" />
    <meta name="author" content="Sistem Informasi Pemesanan" />

    <link rel="shortcut icon" type="image/x-icon" href="<?= (empty($pengaturan->logo) ? "//placehold.it/150" : upload_url('gambar') . '' . $pengaturan->logo) ?>" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/chosen.min.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/meanmenu.min.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>page/css/responsive.css">

    <!-- begin:: css local -->
    <?php empty($css) ? '' : $this->load->view($css); ?>
    <!-- end:: css local -->

    <style>
        .parsley-errors-list {
            color: red;
            list-style-type: none;
            padding: 0;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= assets_url() ?>page/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- begin:: header -->
    <header class="header-area gray-bg clearfix">
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="<?= base_url() ?>">
                            <img alt="<?= (empty($pengaturan->nama) ? null : $pengaturan->nama) ?>" src="<?= (empty($pengaturan->logo) ? "//placehold.it/150" : upload_url('gambar') . '' . $pengaturan->logo) ?>" width="100" height="100">
                        </a>
                    </div>
                    <div class="col-lg-9 col-md-8 col-6">
                        <div class="header-bottom-right">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li><a href="<?= base_url() ?>">Beranda</a></li>
                                        <li><a href="<?= base_url() ?>tentang">Tentang</a></li>
                                        <li><a href="<?= base_url() ?>kontak">Kontak</a></li>
                                        <li><a href="<?= base_url() ?>panduan">Panduan</a></li>
                                        <?php if (count($kategori) > 0) { ?>
                                            <li class="top-hover">
                                                <a href="<?= base_url() ?>produk">Produk</a>
                                                <ul class="submenu">
                                                    <?php foreach ($kategori as $row) { ?>
                                                        <li>
                                                            <a href="<?= base_url() ?>produk/kategori/<?= $row->id_kategori ?>">
                                                                <?= $row->nama ?>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } else { ?>
                                            <a href="<?= base_url() ?>produk">Produk</a>
                                        <?php } ?>
                                        <?php if ($this->session->userdata('id_users')) { ?>
                                            <li><a href="<?= base_url() ?>riwayat">Riwayat</a></li>
                                            <li><a href="<?= logout_url() ?>">Logout</a></li>
                                        <?php } else { ?>
                                            <li><a href="<?= register_url() ?>">Register</a></li>
                                            <li><a href="<?= login_url() ?>">Masuk</a></li>
                                        <?php } ?>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-currency"></div>
                            <div class="header-cart">
                                <a href="<?= base_url() ?>keranjang">
                                    <div class="cart-icon">
                                        <i class="ti-shopping-cart"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-menu-area">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="<?= base_url() ?>">Beranda</a></li>
                                <li><a href="<?= base_url() ?>tentang">Tentang</a></li>
                                <li><a href="<?= base_url() ?>kontak">Kontak</a></li>
                                <li><a href="#">Produk</a>
                                    <ul>
                                        <li><a href="<?= base_url() ?>produk">Cake & Dessert</a></li>
                                        <li><a href="<?= base_url() ?>produk/topper ">Topper</a></li>
                                    </ul>
                                </li>
                                <?php if ($this->session->userdata('id_users')) { ?>
                                    <li><a href="<?= base_url() ?>riwayat">Riwayat</a></li>
                                    <li><a href="<?= logout_url() ?>">Logout</a></li>
                                <?php } else { ?>
                                    <li><a href="<?= register_url() ?>">Register</a></li>
                                    <li><a href="<?= login_url() ?>">Login</a></li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end:: header -->

    <!-- begin:: content -->
    <?php $this->load->view($content); ?>
    <!-- end:: content -->

    <!-- begin:: footer -->
    <footer class="footer-area pt-75 gray-bg-3">
        <div class="footer-top gray-bg-3 pb-35">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="footer-widget footer-widget-red footer-black-color mb-40">
                            <div class="footer-title mb-25">
                                <h4>Kontak Kami</h4>
                            </div>
                            <div class="footer-about">
                                <p><?= (empty($pengaturan->alamat) ? null : $pengaturan->alamat) ?></p>
                                <div class="footer-contact mt-20">
                                    <ul>
                                        <li><?= (empty($pengaturan->telepon) ? null : $pengaturan->telepon) ?></li>
                                    </ul>
                                </div>
                                <div class="footer-contact mt-20">
                                    <ul>
                                        <li><?= (empty($pengaturan->email) ? null : $pengaturan->email) ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom pb-25 pt-25 gray-bg-2">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                <a href="https://alanlengkoan.netlify.app/" target="_blank"> AL</a> - Sistem Informasi Pemesanan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end:: footer -->

    <!-- begin:: modal rating -->
    <div class="modal fade" id="modal-rating" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Berikan Rating untuk kami.</h4>
                </div>
                <form id="form-rating" action="<?= base_url() ?>riwayat/save_rating" method="POST">
                    <!-- begin:: id -->
                    <input type="hidden" name="id_users" id="id_users" />
                    <input type="hidden" name="kd_pemesanan" id="kd_pemesanan" />
                    <!-- end:: id -->

                    <div class="modal-body">
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-12 col-form-label">Beri rating : *</label>
                            <div class="col-sm-3">
                                <div class="rating">
                                    <input type="radio" name="bintang" id="bintang1" value="5"><label for="bintang1"></label>
                                    <input type="radio" name="bintang" id="bintang2" value="4"><label for="bintang2"></label>
                                    <input type="radio" name="bintang" id="bintang3" value="3"><label for="bintang3"></label>
                                    <input type="radio" name="bintang" id="bintang4" value="2"><label for="bintang4"></label>
                                    <input type="radio" name="bintang" id="bintang5" value="1"><label for="bintang5"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Punya saran buat kami ? *</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name="komentar" id="komentar" rows="5" cols="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="save"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end:: modal rating -->

    <script type="text/javascript" src="<?= assets_url() ?>page/js/vendor/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/popper.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/ajax-mail.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/plugins.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>page/js/main.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/sweetalert/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

    <script type="text/javascript">
        load_rating();

        function load_rating() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url() ?>riwayat/load_rating',
                dataType: 'json',
                success: function(response) {
                    const pemesanan = response.pemesanan;
                    pemesanan.forEach(function(object) {
                        $('#id_users').val(object.id_users);
                        $('#kd_pemesanan').val(object.kd_pemesanan);
                        $('#modal-rating').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Request Ajax Gagal : ' + xhr.responseText;
                    console.log(errorMsg);
                }
            });
        }
        // untuk submit rating
        var untukSubmitRating = function() {
            $('#form-rating').submit(function(e) {
                e.preventDefault();
                $('#komentar').attr('required', 'required');

                if ($('#form-rating').parsley().isValid() == true) {
                    $.ajax({
                        method: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        beforeSend: function() {},
                        success: function(data) {
                            swal({
                                    title: data.title,
                                    text: data.text,
                                    icon: data.type,
                                    button: data.button,
                                })
                                .then((value) => {
                                    location.reload();
                                });
                        }
                    })
                }
            });
        }();
        // untuk angka
        function justAngka(e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190, 77]) !== -1 ||
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        };
        // untuk format harga
        function autoSeparator(Num) {
            Num += '';
            Num = Num.replace('.', '');
            Num = Num.replace('.', '');
            Num = Num.replace('.', '');
            Num = Num.replace('.', '');
            Num = Num.replace('.', '');
            Num = Num.replace('.', '');
            x = Num.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1))
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            return x1 + x2;
        };
    </script>

    <!-- begin:: js local -->
    <?php empty($js) ? '' : $this->load->view($js); ?>
    <!-- end:: js local -->
</body>

</html>