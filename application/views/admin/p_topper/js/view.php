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
    // untuk datatable topper
    var untukTabelTopper = function() {
        tabelProdukDt = $('#tabel-produk-cake-topper').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>p_topper/get_data_topper_dt',
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Kode Topper',
                    data: 'kd_topper',
                    className: 'text-center',
                },
                {
                    title: 'Nama Topper',
                    data: 'topper',
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
                            <button type="button" id="btn-upd" data-id="` + full.id_produk_topper + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>
                            <button type="button" id="btn-del" data-id="` + full.id_produk_topper + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        </div>
                    `;
                    },
                },
            ],
        });
    }();

    // untuk reset form topper
    var untukResetFormTopper = function() {
        $(document).on('click', '#btn-add', function() {
            $.post("<?= admin_url() ?>p_topper/kd_topper", function(response) {
                $('#inpkdtopper').val(response.kd_topper);
            }, 'json');

            $('#judul-add-upd').html('Tambah');
            $('#inpidproduktopper').val('');
            $('#inpnamatopper').val('');
            $('#inphargatopper').val('');
            $("input[name*='inpgambartopper']").removeAttr('disabled');
            $("input[name*='inpgambartopper']").attr('id', 'inpgambartopper');
            $('#inpgambartopper').val('');
            $('#lihat_gambar').empty();
            $('#lihat_gambar').removeAttr('style');
            $('#centang_gambar').empty();
            $('#centang_gambar').removeAttr('style');
        });
    }();

    // untuk ubah gambar topper
    var untukUbahGambarTopper = function() {
        $(document).on('click', '#ubah_gambar_topper', function() {
            var ini = $(this);
            if (ini.is(':checked')) {
                $("input[name*='inpgambartopper']").removeAttr('disabled');
                $("input[name*='inpgambartopper']").attr('id', 'inpgambartopper');
            } else {
                $("input[name*='inpgambartopper']").attr('disabled', 'disabled');
                $("input[name*='inpgambartopper']").removeAttr('id');
                $("input[name*='inpgambartopper']").removeAttr('required');
            }
        });
    }();

    // untuk tambah & ubah data topper
    var untukTambahDanUbahDataTopper = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#inpnamatopper').attr('required', 'required');
            $('#inphargatopper').attr('required', 'required');
            $('#inpgambartopper').attr('required', 'required');

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
                        $('#save_topper').attr('disabled', 'disabled');
                        $('#save_topper').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
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
                        $('#save_topper').removeAttr('disabled');
                        $('#save_topper').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                })
            }
        });
    }();

    // untuk get id topper
    var untukGetIdDataTopper = function() {
        $(document).on('click', '#btn-upd', function() {
            var ini = $(this);

            $.ajax({
                type: "POST",
                url: "<?= admin_url() ?>p_topper/get",
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
                    $('#lihat_gambar').html(`<img src="<?= upload_url('gambar') ?>` + response.gambar + `" width="100" heigth="100" />`);
                    $('#lihat_gambar').attr('style', 'padding-bottom: 10px');

                    $('#centang_gambar').html(`<div class="checkbox-fade fade-in-default"><label><input type="checkbox" name="ubah_gambar_topper" id="ubah_gambar_topper" /><span class="cr"><i class="cr-icon icofont icofont-ui-check txt-default"></i></span><span>Ubah Gambar!</span></label></div>`);
                    $('#centang_gambar').attr('style', 'padding-top: 10px');

                    $('#inpidproduktopper').val(response.id_produk_topper);
                    $('#inpkdtopper').val(response.kd_topper);
                    $('#inpnamatopper').val(response.nama);
                    $('#inphargatopper').val(autoSeparator(response.harga));
                    $('#inpgambartopper').attr('disabled', 'disabled');
                    $('#inpgambartopper').removeAttr('id');

                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-pencil"></i>&nbsp;Ubah');
                }
            });
        });
    }();

    // untuk hapus data topper
    var untukHapusDataTopper = function() {
        $(document).on('click', '#btn-del', function() {
            var ini = $(this);

            swal({
                    title: "Apakah Anda yakin ingin menghapusnya?",
                    text: "Data yang telah dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((del) => {
                    if (del) {
                        $.ajax({
                            type: "POST",
                            url: "<?= admin_url() ?>p_topper/process_del",
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
                                    })
                                    .then((value) => {
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