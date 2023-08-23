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
    let table = null;

    // untuk datatable
    var untukTable = function() {
        table = $('#tabel-produk').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>produk/get_data_dt',
            columns: [{
                    title: 'No.',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    title: 'Nama',
                    data: 'nama',
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
                    title: 'Kategori',
                    data: 'kategori',
                    className: 'text-center',
                },
                {
                    title: 'Diskon',
                    data: 'diskon',
                    className: 'text-center',
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
                            <button type="button" id="btn-upd" data-id="` + full.id_produk + `" class="btn btn-info btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-pencil"></i>&nbsp;Ubah</button>&nbsp;
                            <button type="button" id="btn-del" data-id="` + full.id_produk + `" class="btn btn-warning btn-sm waves-effect"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        </div>
                    `;
                    },
                },
            ],
        });
    }();

    // untuk ubah gambar topper
    var untukUbahGambarTopper = function() {
        $(document).on('click', '#ubah_gambar', function() {
            var ini = $(this);
            if (ini.is(':checked')) {
                $("input[name*='gambar']").removeAttr('disabled');
                $("input[name*='gambar']").attr('id', 'gambar');
            } else {
                $("input[name*='gambar']").attr('disabled', 'disabled');
                $("input[name*='gambar']").removeAttr('id');
                $("input[name*='gambar']").removeAttr('required');
            }
        });
    }();

    // untuk reset form topper
    var untukResetFormTopper = function() {
        $(document).on('click', '#btn-add', function() {
            $.post("<?= admin_url() ?>produk/kd_produk", function(response) {
                $('#kd_produk').val(response.kd_produk);
            }, 'json');

            $('#judul-add-upd').html('Tambah');
            $('#id_produk').val('');

            $("input[name*='gambar']").removeAttr('disabled');
            $("input[name*='gambar']").attr('id', 'gambar');
            $('#gambar').val('');
            $('#lihat_gambar').empty();
            $('#lihat_gambar').removeAttr('style');
            $('#centang_gambar').empty();
            $('#centang_gambar').removeAttr('style');

            $('#form-add-upd').parsley().reset();
            $('#form-add-upd')[0].reset();
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#nama').attr('required', 'required');
            $('#harga').attr('required', 'required');
            $('#id_kategori').attr('required', 'required');
            $('#id_diskon').attr('required', 'required');
            $('#gambar').attr('required', 'required');
            $('#deskripsi').attr('required', 'required');

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
                            table.ajax.reload();
                        });
                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
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
                url: "<?= admin_url() ?>produk/get",
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

                    $('#centang_gambar').html(`<div class="checkbox-fade fade-in-default"><label><input type="checkbox" name="ubah_gambar" id="ubah_gambar" /><span class="cr"><i class="cr-icon icofont icofont-ui-check txt-default"></i></span><span>Ubah Gambar!</span></label></div>`);
                    $('#centang_gambar').attr('style', 'padding-top: 10px');

                    $('#id_produk').val(response.id_produk);
                    $('#kd_produk').val(response.kd_produk);
                    $('#nama').val(response.nama);
                    $('#harga').val(autoSeparator(response.harga));
                    $('#id_kategori').val(response.id_kategori);
                    $('#id_diskon').val(response.id_diskon);
                    $('#deskripsi').val(response.deskripsi);

                    $('#gambar').attr('disabled', 'disabled');
                    $('#gambar').removeAttr('id');

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
                        type: "POST",
                        url: "<?= admin_url() ?>produk/process_del",
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
                                table.ajax.reload();
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