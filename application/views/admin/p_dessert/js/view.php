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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    let tabelProdukDt = null;

    // untuk textarea editor
    CKEDITOR.replace('inptentang', {
        language: 'en',
    });

    // untuk datatable
    var untukTabelProduk = function() {
        tabelProdukDt = $('#tabel-produk-dessert').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>p_dessert/get_data_dessert_dt',
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
                    title: 'Satuan',
                    data: 'satuan',
                    className: 'text-center',
                },
                {
                    title: 'Diskon',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return full.diskon + ' %';
                    },
                },
                {
                    title: 'Stock',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        let stock_terjual = (parseInt(full.stock) - parseInt(full.jumlah));
                        let stock = (parseInt(full.stock) - parseInt(full.jumlah));
                        return (isNaN(stock) ? 0 : stock);
                    },
                },
                {
                    title: 'Harga',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return 'Rp. ' + autoSeparator(full.harga);
                    },
                },
                {
                    title: 'Harga Diskon',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        let diskon = parseInt(full.diskon) / 100;
                        let hargaDiskon = parseInt(full.harga) * diskon;
                        let result = parseInt(full.harga) - Math.round(hargaDiskon);

                        return 'Rp. ' + autoSeparator(result);
                    },
                },
                {
                    title: 'Gambar',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return `<img src="<?= upload_url('gambar') ?>` + full.gambar + `" width="100" heigth="100" />`
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
                            <button type="button" id="btn-upd" data-id="` + full.kd_produk + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>
                            <button type="button" id="btn-del" data-id="` + full.kd_produk + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
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

            $.post("<?= admin_url() ?>p_dessert/kd_produk", function(response) {
                $('#inpkdproduk').val(response.kd_produk);
            }, 'json');
            $('#inpnama').val('');
            $('#inpsatuan').val('');
            $('#inpdiskon').val('');
            $('#inpukuran').val('');
            $('#inpharga').val('');
            $("input[name*='inpgambar']").removeAttr('disabled');
            $("input[name*='inpgambar']").attr('id', 'inpgambar');
            $('#inpgambar').val('');
            CKEDITOR.instances.inptentang.setData('');
            $('#lihat_gambar').empty();
            $('#lihat_gambar').removeAttr('style');
            $('#centang_gambar').empty();
            $('#centang_gambar').removeAttr('style');
        });
    }();

    // untuk tambah & ubah data
    var untukTambahData = function() {
        $(document).on('submit', '#form-add', function(e) {
            e.preventDefault();
            $('#inpnama').attr('required', 'required');
            $('#inpsatuan').attr('required', 'required');
            $('#inpdiskon').attr('required', 'required');
            $('#inpukuran').attr('required', 'required');
            $('#inpharga').attr('required', 'required');
            $('#inpgambar').attr('required', 'required');
            $('#inptentang').attr('required', 'required');

            if ($('#form-add').parsley().isValid() == true) {
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
                            })
                            .then((value) => {
                                $('#modal-add-upd').modal('hide');
                                location.reload()
                            });
                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                })
            }
        });
    }();

    // untuk tambah & ubah data
    var untukUbahData = function() {
        $(document).on('submit', '#form-upd', function(e) {
            e.preventDefault();
            $('#inpnama').attr('required', 'required');
            $('#inpsatuan').attr('required', 'required');
            $('#inpdiskon').attr('required', 'required');
            $('#inpukuran').attr('required', 'required');
            $('#inpharga').attr('required', 'required');
            $('#inpgambar').attr('required', 'required');
            $('#inptentang').attr('required', 'required');

            if ($('#form-upd').parsley().isValid() == true) {
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
                            })
                            .then((value) => {
                                $('#modal-add-upd').modal('hide');
                                tabelProdukDt.ajax.reload();
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

            $('#inpkdproduk').empty();
            selectKdProduk('<?= admin_url() ?>p_dessert/search_kd_produk_yes');

            $.ajax({
                type: "POST",
                url: "<?= admin_url() ?>p_dessert/get",
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
                    $('form').attr('action', '<?= admin_url() ?>p_dessert/process_upd');
                    $('form').attr('id', 'form-upd');

                    $('#lihat_gambar').html(`<img src="<?= upload_url('gambar') ?>` + response.gambar + `" width="100" heigth="100" />`);
                    $('#lihat_gambar').attr('style', 'padding-bottom: 10px');

                    $('#centang_gambar').html(`<div class="checkbox-fade fade-in-default"><label><input type="checkbox" name="ubah_gambar" id="ubah_gambar" /><span class="cr"><i class="cr-icon icofont icofont-ui-check txt-default"></i></span><span>Ubah Gambar!</span></label></div>`);
                    $('#centang_gambar').attr('style', 'padding-top: 10px');

                    $('#inpkdproduk').val(response.kd_produk).trigger('change');;
                    $('#inpnama').val(response.nama);
                    $('#inpsatuan').val(response.satuan);
                    $('#inpdiskon').val(response.diskon);
                    $('#inpukuran').val(response.ukuran);
                    $('#inpharga').val(autoSeparator(response.harga));
                    $('#inpgambar').attr('disabled', 'disabled');
                    $('#inpgambar').removeAttr('id');
                    CKEDITOR.instances.inptentang.setData(response.tentang);

                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-pencil"></i>&nbsp;Ubah');
                }
            });
        });
    }();

    // untuk ubah gambar
    var untukUbahGambar = function() {
        $(document).on('click', '#ubah_gambar', function() {
            var ini = $(this);
            if (ini.is(':checked')) {
                $("input[name*='inpgambar']").removeAttr('disabled');
                $("input[name*='inpgambar']").attr('id', 'inpgambar');
            } else {
                $("input[name*='inpgambar']").attr('disabled', 'disabled');
                $("input[name*='inpgambar']").removeAttr('id');
                $("input[name*='inpgambar']").removeAttr('required');
                ini.parent().parent().find('#error').empty();
            }
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
                        type: "POST",
                        url: "<?= admin_url() ?>p_dessert/process_del",
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
                                tabelProdukDt.ajax.reload();
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