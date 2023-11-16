<!doctype html>
<html class="no-js" lang="">

<head>
    <title>Sistem Informasi Pemesanan - <?= $title ?> | <?= ucfirst($this->session->userdata('role')) ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistem Informasi Pemesanan" />
    <meta name="keywords" content="Sistem Informasi Pemesanan" />
    <meta name="author" content="Sistem Informasi Pemesanan" />

    <link rel="shortcut icon" type="image/x-icon" href="<?= (empty($pengaturan->logo) ? "//placehold.it/150" : upload_url('gambar') . '' . $pengaturan->logo) ?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/pages/waves/css/waves.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/icon/feather/css/feather.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/css/widget.css" />

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

    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery/js/jquery.min.js"></script>
</head>

<body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <!-- begin:: navbar -->
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="feather icon-toggle-right"></i>
                        </a>
                        <a href="<?= admin_url() ?>">
                            <img class="img-fluid" src="<?= (empty($pengaturan->logo) ? "//placehold.it/75" : upload_url('gambar') . '' . $pengaturan->logo) ?>" alt="<?= (empty($pengaturan->nama) ? 'Logo' : $pengaturan->nama) ?>" width="75" height="75" />
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="full-screen feather icon-maximize"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <!-- begin:: profil navbar -->
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?= (get_users_detail($this->session->userdata('id'))->foto !== null ? upload_url('gambar') . '' . get_users_detail($this->session->userdata('id'))->foto : "//placehold.it/150") ?>" class="img-radius" alt="User-Profile-Image">
                                        <span><?= get_users_detail($this->session->userdata('id'))->nama ?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="<?= pelayan_url() ?>profil">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= logout_url() ?>">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- end:: profil navbar -->
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- end:: navbar -->

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- begin:: sidebar -->
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <!-- begin:: profil sidebar -->
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-menu-user img-radius" src="<?= (get_users_detail($this->session->userdata('id'))->foto !== null ? upload_url('gambar') . '' . get_users_detail($this->session->userdata('id'))->foto : "//placehold.it/150") ?>" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <p id="more-details"><?= get_users_detail($this->session->userdata('id'))->nama ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- end:: profil sidebar -->
                            <!-- begin:: menu sidebar -->
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="<?= ($this->uri->segment(2) === null ? 'active' : '') ?>">
                                    <a href="<?= pelayan_url() ?>">
                                        <span class="pcoded-micon">
                                            <i class="feather icon-home"></i>
                                        </span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Transaksi</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="<?= ($this->uri->segment(2) === 'pemesanan' ? 'active' : '') ?>">
                                    <a href="<?= pelayan_url() ?>pemesanan">
                                        <span class="pcoded-micon">
                                            <i class="feather icon-box"></i>
                                        </span>
                                        <span class="pcoded-mtext">Pemesanan</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- end:: menu sidebar -->
                        </div>
                    </nav>
                    <!-- end:: sidebar -->

                    <!-- begin:: content -->
                    <div class="pcoded-content">
                        <?php $this->load->view($content); ?>
                    </div>
                    <!-- end:: content -->

                    <!-- begin:: custom style -->
                    <div id="styleSelector">
                    </div>
                    <!-- end:: custom style -->
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/waves/js/waves.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/chart/float/jquery.flot.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/chart/float/jquery.flot.categories.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/chart/float/curvedLines.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/chart/float/jquery.flot.tooltip.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/widget/amchart/amcharts.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/widget/amchart/serial.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/widget/amchart/light.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/pcoded.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/vertical/vertical-layout.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/dashboard/custom-dashboard.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/script.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/sweetalert/js/sweetalert.min.js"></script>

    <script type="text/javascript">
        // untuk update baca pemberitahuan
        $(document).on('click', '.lihat', function() {
            var ini = $(this);
            var kd_pemesanan = ini.data('id');

            $.post('<?= pelayan_url() ?>dashboard/read_notification', {
                kd_pemesanan: ini.data('id')
            });

            location.href = '<?= pelayan_url() ?>pemesanan/detail/' + btoa(kd_pemesanan);
        });

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