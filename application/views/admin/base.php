<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Sistem Informasi Pemesanan - <?= $title ?> | <?= ucfirst($this->session->userdata('role')) ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Sistem Informasi Pemesanan" />
    <meta name="keywords" content="Sistem Informasi Pemesanan" />
    <meta name="author" content="Sistem Informasi Pemesanan" />

    <link rel="shortcut icon" type="image/x-icon" href="<?= assets_url() ?>admin/images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/icon/icofont/css/icofont.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/pages/waves/css/waves.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/icon/feather/css/feather.css" />
    <link rel="stylesheet" type="text/css" href="<?= assets_url() ?>admin/select2/css/select2.min.css">
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
            <?php $this->load->view('admin/layouts/navbar'); ?>
            <!-- end:: navbar -->

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- begin:: sidebar -->
                    <?php $this->load->view('admin/layouts/sidebar'); ?>
                    <!-- end:: sidebar -->

                    <!-- begin:: content -->
                    <div class="pcoded-content">
                        <?php $this->load->view($content); ?>
                    </div>
                    <!-- end:: content -->
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/pages/waves/js/waves.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/pcoded.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/vertical/vertical-layout.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/js/script.min.js"></script>
    <script type="text/javascript" src="<?= assets_url() ?>admin/sweetalert/js/sweetalert.min.js"></script>

    <script type="text/javascript">
        // untuk load notifikasi
        load_notification();

        function load_notification() {
            $.ajax({
                type: 'GET',
                url: '<?= admin_url() ?>dashboard/load_notification',
                dataType: 'json',
                success: function(response) {
                    if (response.count > 0) {
                        const order = response.result;
                        var html = "";

                        order.forEach(function(object) {
                            html += `
                                <li>
                                    <div class="media lihat" data-id="` + object.kd_pemesanan + `">
                                        <div class="media-body">
                                            <h5 class="notification-user">` + object.kd_pemesanan + `</h5>
                                            <p class="notification-msg">` + object.nama + `</p>
                                            <span class="notification-time">` + object.tgl_pemesanan + ` | ` + object.jam_pemesanan + `</span>
                                        </div>
                                    </div>
                                </li>
                            `;
                        });
                        $('#count').html(`<span class="badge bg-c-red">` + response.count + `</span>`);
                        $('#notification-info').html("Baru");
                        $('#notification').html(html);
                    } else {
                        $('#notification-info').html("Kosong");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Request Ajax Gagal : ' + xhr.responseText;
                }
            });
        };

        setInterval(function() {
            load_notification()
        }, 5000);

        // untuk update baca pemberitahuan
        $(document).on('click', '.lihat', function() {
            var ini = $(this);
            var kd_pemesanan = ini.data('id');

            $.post('<?= admin_url() ?>dashboard/read_notification', {
                kd_pemesanan: ini.data('id')
            });

            location.href = '<?= admin_url() ?>pemesanan/detail/' + btoa(kd_pemesanan);
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