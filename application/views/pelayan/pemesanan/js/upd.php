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
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>
    let tabelDataDt = null;
    let harga = $('#harga');
    let jumlah = $('#jumlah');

    // untuk datatable
    var untukTabelTempporaryPemesanan = function() {
        tabelDataDt = $('#tabel-temp-pemesanan').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= pelayan_url() ?>pemesanan/get_data_detail_dt/<?= $kd_pemesanan ?>',
            footerCallback: function(row, data, start, end, display) {
                var countJumlah = 0;
                var total = 0;

                $(data).each(function(i) {
                    countJumlah += data[i].jumlah * 1;
                    total += data[i].total * 1;
                });

                // untuk form footer
                $('#jumlah_stok').val(countJumlah);
                $('#total_akhir').val(autoSeparator(total));
            },
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Kode Produk',
                    data: 'kd_produk',
                    className: 'text-center',
                },
                {
                    title: 'Nama',
                    data: 'nama',
                    className: 'text-center',
                },
                {
                    title: 'Kategori',
                    data: 'kategori',
                    className: 'text-center',
                },
                {
                    title: 'Jumlah',
                    data: 'jumlah',
                    className: 'text-center',
                },
                {
                    title: 'Harga',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return 'Rp. ' + autoSeparator(full.harga);
                    },
                },
                {
                    title: 'Total',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return 'Rp. ' + autoSeparator(full.total);
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
                            <button type="button" id="btn-upd" data-id="` + full.id_pemesanan_detail + `" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>&nbsp;
                            <button type="button" id="btn-del" data-id="` + full.id_pemesanan_detail + `" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        </div>
                    `;
                    },
                },
            ],
        });
    }();

    // untuk reset form
    var untukResetForm = function() {
        $(document).on('click', '#btn-add', function() {
            $('#judul-add-upd').html('Tambah');
            $('#id_pemesanan_detail').val('');
            $('#kd_produk').val('');
            $('#nama').val('');
            $('#kategori').val('');
            $('#harga').val('0');
            $('#stok').val('0');
            $('#jumlah').val('0');
            $('#total').val('0');
            $('#save').attr('disabled', false);
        });
    }();

    // untuk pilih bahan baku
    let untukPilihBahanBaku = function() {
        $(document).on('change', '#kd_produk', function() {
            var ini = $(this);

            $.ajax({
                type: "post",
                url: "<?= pelayan_url() ?>pemesanan/search_barang",
                dataType: 'json',
                data: {
                    id: ini.val(),
                },
                success: function(response) {
                    let h = parseInt(harga.val().replace('.', ''));
                    let j = parseInt(jumlah.val());

                    hitungTotal(j, h);

                    $('#nama').val(response.nama);
                    $('#kategori').val(response.kategori);
                    $('#stok').val(response.stok);
                    harga.val(autoSeparator(response.harga));

                    if (parseInt(response.stok) === 0) {
                        $('#save').attr('disabled', true);
                    } else {
                        $('#save').attr('disabled', false);
                    }
                }
            });
        });
    }();

    // untuk jumlah
    let untukJumlah = function() {
        $(document).on('keyup', '#jumlah', function() {
            var ini = $(this);

            if (ini.val() == "") {
                ini.val('0');
            } else if (ini.val() > 0) {
                ini.val(Number(ini.val()))
            }

            let h = parseInt(harga.val().replace('.', ''));
            let j = ini.val();

            hitungTotal(j, h);
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahDataTemporary = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#kd_produk').attr('required', 'required');
            $('#nama').attr('required', 'required');
            $('#harga').attr('required', 'required');
            $('#jumlah').attr('required', 'required');
            $('#total').attr('required', 'required');

            if ($('#form-add-upd').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save').attr('disabled', 'disabled');
                        $('#save').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        swal({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            button: response.button,
                        }).then((value) => {
                            $('#modal-add-upd').modal('hide');
                            tabelDataDt.ajax.reload();
                        });
                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                })
            }
        });
    }();

    // untuk get id
    var untukGetIdData = function() {
        $(document).on('click', '#btn-upd', function() {
            var ini = $(this);

            $.ajax({
                type: "POST",
                url: "<?= pelayan_url() ?>pemesanan/get_detail",
                dataType: 'json',
                data: {
                    id: ini.data('id')
                },
                beforeSend: function() {
                    $('#judul-add-upd').html('Ubah');
                    ini.attr('disabled', 'disabled');
                    ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                },
                success: function(response) {
                    $('#id_pemesanan_detail').val(response.id_pemesanan_detail);
                    $('#kd_produk').val(response.kd_produk).trigger('change');
                    $('#jumlah').val(response.jumlah);
                    $('#harga').val(response.harga);

                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-pencil"></i>&nbsp;Ubah');
                }
            });
        });
    }();

    // untuk hapus data
    var untukHapusData = function() {
        $(document).on('click', '#btn-del', function() {
            var ini = $(this);
            swal({
                title: "Apakah Anda yakin ingin menghapusnya?",
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= pelayan_url() ?>pemesanan/process_del_detail",
                        dataType: 'json',
                        data: {
                            id: ini.data('id')
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                        },
                        success: function(data) {
                            swal({
                                title: data.title,
                                text: data.text,
                                icon: data.type,
                                button: data.button,
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

    // untuk menghitung total
    function hitungTotal(jumlah, harga) {
        let total = (jumlah * harga);

        $('#total').val(autoSeparator(total));
    }
</script>