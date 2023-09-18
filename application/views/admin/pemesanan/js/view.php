<script src="<?= assets_url() ?>admin/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/jszip.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/pdfmake.min.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/js/vfs_fonts.js"></script>
<script src="<?= assets_url() ?>admin/pages/data-table/extensions/key-table/js/dataTables.keyTable.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= assets_url() ?>admin/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
    let tabelPemesananDt = null;

    // untuk tabel kurir
    var untukTabelKurir = function() {
        $('#tabel-kurir').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>pemesanan/get_data_kurir_dt',
            columns: [{
                    title: 'Nama',
                    data: 'nama',
                    className: 'text-center',
                },
                {
                    title: 'Jenis Kelamin',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        let jenis_kelamin = {
                            'L': 'Laki - laki',
                            'P': 'Perempuan',
                        };
                        return (full.kelamin === null ? '-' : jenis_kelamin[full.kelamin]);
                    },
                },
                {
                    title: 'Email',
                    data: 'email',
                    className: 'text-center',
                },
                {
                    title: 'Telepon',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return (full.telepon === null ? '-' : full.telepon);
                    },
                },
                {
                    title: 'Alamat',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return (full.alamat === null ? '-' : full.alamat);
                    },
                },
                {
                    title: 'Aksi',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return `
                            <div class="button-icon-btn button-icon-btn-cl">
                                <button type="button"  class="btn btn-info btn-sm waves-effect pilih-kurir-ini" id="pilih-kurir-ini" data-id_users="` + full.id_users + `"><i class="fa fa-check"></i>&nbsp;Pilih</button>
                            </div>
                        `;
                    },
                },
            ],
        });
    }();

    // untuk datatable
    var untukTabelPemesanan = function() {
        tabelPemesananDt = $('#tabel-pemesanan').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>pemesanan/get_data_pemesanan_dt',
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Kode Order',
                    data: 'kd_pemesanan',
                    className: 'text-center',
                },
                {
                    title: 'Nama',
                    data: 'nama',
                    className: 'text-center',
                },
                {
                    title: 'Tanggal Pemesanan',
                    data: 'tgl_pemesanan',
                    className: 'text-center',
                },
                {
                    title: 'Jam Pemesanan',
                    data: 'jam_pemesanan',
                    className: 'text-center',
                },
                {
                    title: 'Status Pengantaran',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        var status_pengantaran = ['Dikemas', 'Dikirim', 'Diterima'];
                        if (full.metode_pemesanan === 'e') {
                            return "Ditempat";
                        } else {
                            return status_pengantaran[full.status_pengantaran];
                        }
                    }
                },
                {
                    title: 'Aksi',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        // metode pembayaran
                        if (full.metode_pembayaran === 't' && full.metode_pemesanan === 'a') {
                            // transfer & diantar
                            if (full.status_pembayaran === '1') {
                                // sudah pembayaran
                                if (full.pilih_kurir === 'n') {
                                    // belum pilih kurir
                                    return `
                                        <div class="button-icon-btn button-icon-btn-cl">
                                            <a class="btn btn-info btn-sm waves-effect lihat" data-id="` + full.kd_pemesanan + `" href="<?= admin_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                                <i class="fa fa-info"></i>&nbsp;Detail
                                            </a>&nbsp;
                                            <a class="btn btn-primary btn-sm waves-effect" href="<?= admin_url() ?>pemesanan/lacak/` + btoa(full.kd_pemesanan) + `">
                                                <i class="fa fa-check"></i>&nbsp;Lacak
                                            </a>&nbsp;
                                            <button type="button" id="pilih-kurir" data-id="` + full.kd_pemesanan + `" class="btn btn-warning btn-sm waves-effect" data-toggle="modal" data-target="#modal-pilih-kurir"><i class="fa fa-star"></i>&nbsp;Pilih Kurir</button>&nbsp;
                                            <button type="button" id="btn-batal" data-id="` + full.kd_pemesanan + `" class="btn btn-danger btn-sm waves-effect"><i class="fa fa-close"></i>&nbsp;Batal</button>
                                        </div>
                                        `;
                                } else {
                                    // sudah pilih kurir
                                    return `
                                        <div class="button-icon-btn button-icon-btn-cl">
                                            <a class="btn btn-info btn-sm waves-effect lihat" data-id="` + full.kd_pemesanan + `" href="<?= admin_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                                <i class="fa fa-info"></i>&nbsp;Detail
                                            </a>&nbsp;
                                            <a class="btn btn-primary btn-sm waves-effect" href="<?= admin_url() ?>pemesanan/lacak/` + btoa(full.kd_pemesanan) + `">
                                                <i class="fa fa-check"></i>&nbsp;Lacak
                                            </a>&nbsp;
                                            <a class="btn btn-success btn-sm waves-effect" href="<?= admin_url() ?>pemesanan/ulasan/` + btoa(full.kd_pemesanan) + `">
                                                <i class="fa fa-star"></i>&nbsp;Ulasan
                                            </a>
                                        </div>
                                        `;
                                }
                            } else {
                                return `
                                    <div class="button-icon-btn button-icon-btn-cl">
                                        <a class="btn btn-info btn-sm waves-effect lihat" data-id="` + full.kd_pemesanan + `" href="<?= admin_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                            <i class="fa fa-info"></i>&nbsp;Detail
                                        </a>&nbsp;
                                        <button type="button" id="btn-batal" data-id="` + full.kd_pemesanan + `" class="btn btn-danger btn-sm waves-effect"><i class="fa fa-close"></i>&nbsp;Batal</button>
                                    </div>
                                `;
                            }
                        } else if (full.metode_pembayaran === 't' && full.metode_pemesanan === 'e') {
                            // transfer & ditempat
                            if (full.status_pembayaran === '1') {
                                // sudah pembayaran
                                return `
                                    <div class="button-icon-btn button-icon-btn-cl">
                                        <a class="btn btn-info btn-sm waves-effect lihat" data-id="` + full.kd_pemesanan + `" href="<?= admin_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                            <i class="fa fa-info"></i>&nbsp;Detail
                                        </a>&nbsp;
                                         <a class="btn btn-success btn-sm waves-effect" href="<?= admin_url() ?>pemesanan/ulasan/` + btoa(full.kd_pemesanan) + `">
                                            <i class="fa fa-star"></i>&nbsp;Ulasan
                                        </a>
                                    </div>
                                `;
                            } else {
                                // belum pembayaran
                                return `
                                    <div class="button-icon-btn button-icon-btn-cl">
                                        <a class="btn btn-info btn-sm waves-effect lihat" data-id="` + full.kd_pemesanan + `" href="<?= admin_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                            <i class="fa fa-info"></i>&nbsp;Detail
                                        </a>&nbsp;
                                        <button type="button" id="btn-batal" data-id="` + full.kd_pemesanan + `" class="btn btn-danger btn-sm waves-effect"><i class="fa fa-close"></i>&nbsp;Batal</button>
                                    </div>
                                `;
                            }
                        } else if (full.metode_pembayaran === 'c' && full.metode_pemesanan === 'a') {
                            // cod & diantar
                            if (full.status_pembayaran === '1') {
                                // sudah pembayaran
                                return `
                                <div class="button-icon-btn button-icon-btn-cl">
                                    <a class="btn btn-info btn-sm waves-effect lihat" data-id="` + full.kd_pemesanan + `" href="<?= admin_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                        <i class="fa fa-info"></i>&nbsp;Detail
                                    </a>&nbsp;
                                    <a class="btn btn-primary btn-sm waves-effect" href="<?= admin_url() ?>pemesanan/lacak/` + btoa(full.kd_pemesanan) + `">
                                        <i class="fa fa-check"></i>&nbsp;Lacak
                                    </a>&nbsp;
                                    <a class="btn btn-success btn-sm waves-effect" href="<?= admin_url() ?>pemesanan/ulasan/` + btoa(full.kd_pemesanan) + `">
                                        <i class="fa fa-star"></i>&nbsp;Ulasan
                                    </a>
                                </div>
                                `;
                            } else {
                                // belum pembayaran
                                if (full.pilih_kurir === 'n') {
                                    // belum pilih kurir
                                    return `
                                        <div class="button-icon-btn button-icon-btn-cl">
                                            <a class="btn btn-info btn-sm waves-effect lihat" data-id="` + full.kd_pemesanan + `" href="<?= admin_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                                <i class="fa fa-info"></i>&nbsp;Detail
                                            </a>&nbsp;
                                            <a class="btn btn-primary btn-sm waves-effect" href="<?= admin_url() ?>pemesanan/lacak/` + btoa(full.kd_pemesanan) + `">
                                                <i class="fa fa-check"></i>&nbsp;Lacak
                                            </a>&nbsp;
                                            <button type="button" id="pilih-kurir" data-id="` + full.kd_pemesanan + `" class="btn btn-warning btn-sm waves-effect" data-toggle="modal" data-target="#modal-pilih-kurir"><i class="fa fa-star"></i>&nbsp;Pilih Kurir</button>&nbsp;
                                            <button type="button" id="btn-batal" data-id="` + full.kd_pemesanan + `" class="btn btn-danger btn-sm waves-effect"><i class="fa fa-close"></i>&nbsp;Batal</button>
                                        </div>
                                        `;
                                } else {
                                    // sudah pilih kurir
                                    return `
                                        <div class="button-icon-btn button-icon-btn-cl">
                                            <a class="btn btn-info btn-sm waves-effect lihat" data-id="` + full.kd_pemesanan + `" href="<?= admin_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                                <i class="fa fa-info"></i>&nbsp;Detail
                                            </a>&nbsp;
                                            <a class="btn btn-primary btn-sm waves-effect" href="<?= admin_url() ?>pemesanan/lacak/` + btoa(full.kd_pemesanan) + `">
                                                <i class="fa fa-check"></i>&nbsp;Lacak
                                            </a>
                                        </div>
                                        `;
                                }
                            }
                        } else if (full.metode_pembayaran === 'c' && full.metode_pemesanan === 'e') {
                            // cod & ditempat
                            if (full.status_pembayaran === '1') {
                                // sudah pembayaran
                                return `
                                    <div class="button-icon-btn button-icon-btn-cl">
                                        <a class="btn btn-info btn-sm waves-effect lihat" data-id="` + full.kd_pemesanan + `" href="<?= admin_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                            <i class="fa fa-info"></i>&nbsp;Detail
                                        </a>&nbsp;
                                         <a class="btn btn-success btn-sm waves-effect" href="<?= admin_url() ?>pemesanan/ulasan/` + btoa(full.kd_pemesanan) + `">
                                            <i class="fa fa-star"></i>&nbsp;Ulasan
                                        </a>
                                    </div>
                                `;
                            } else {
                                // belum pembayaran
                                return `
                                    <div class="button-icon-btn button-icon-btn-cl">
                                        <a class="btn btn-info btn-sm waves-effect lihat" data-id="` + full.kd_pemesanan + `" href="<?= admin_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                            <i class="fa fa-info"></i>&nbsp;Detail
                                        </a>&nbsp;
                                        <a class="btn btn-warning btn-sm waves-effect lihat" href="<?= admin_url() ?>pemesanan/bayar/` + btoa(full.kd_pemesanan) + `">
                                            <i class="fa fa-credit-card"></i>&nbsp;Bayar
                                        </a>&nbsp;
                                        <button type="button" id="btn-batal" data-id="` + full.kd_pemesanan + `" class="btn btn-danger btn-sm waves-effect"><i class="fa fa-close"></i>&nbsp;Batal</button>
                                    </div>
                                `;
                            }
                        } else {
                            return `Terdapat Kesalahan Status !`;
                        }
                    },
                },
            ],
        });
    }();

    // untuk lihat detail
    var untukLihatDetail = function() {
        $(document).on('click', '.lihat', function() {
            var ini = $(this);
            var kd_pemesanan = ini.data('id');

            $.post('<?= admin_url() ?>dashboard/read_notification', {
                kd_pemesanan: ini.data('id')
            });
        });
    }();

    // untuk terima paket
    var untukTerimaPaket = function() {
        $(document).on('click', '#btn-diterima', function() {
            var ini = $(this);
            swal({
                title: "Apakah Anda yakin barang telah diterima oleh pelanggan?",
                text: "Data yang telah diubah tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= admin_url() ?>pemesanan/setor",
                        dataType: 'json',
                        data: {
                            id: ini.data('id')
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                        },
                        success: function(response) {
                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            }).then((value) => {
                                location.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();

    // untuk batal transaksi
    var untukBatalTransaksi = function() {
        $(document).on('click', '#btn-batal', function() {
            var ini = $(this);
            let kd_pemesanan = ini.data('id');

            swal({
                title: "Apakah Anda yakin ingin membatalkan transaksi tersebut?",
                text: "Transaksi yang telah dibatalkan tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= admin_url() ?>pemesanan/batal",
                        dataType: 'json',
                        data: {
                            kd_pemesanan: kd_pemesanan
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu');
                        },
                        success: function(response) {
                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            }).then((value) => {
                                location.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();

    // untuk pilih kurir
    var untukPilihKurir = function() {
        $(document).on('click', '#pilih-kurir', function() {
            var ini = $(this);
            let id = ini.data('id');
            $('.pilih-kurir-ini').attr('data-kd_pemesanan', id);
        });

        $(document).on('click', '#pilih-kurir-ini', function() {
            var ini = $(this);
            let id_users = ini.data('id_users');
            let kd_pemesanan = ini.data('kd_pemesanan');

            swal({
                title: "Apakah Anda yakin ingin memilih kurir tersebut?",
                text: "Akun yang telah dipilih tidak dapat diubah!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= admin_url() ?>pemesanan/pilih_kurir",
                        dataType: 'json',
                        data: {
                            id_users: id_users,
                            kd_pemesanan: kd_pemesanan
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu');
                        },
                        success: function(response) {
                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            }).then((value) => {
                                location.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();
</script>