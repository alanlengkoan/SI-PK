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
    let table = null;

    // untuk datatable
    var untukTabel = function() {
        table = $('#tabel-users').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>users/get_data_dt',
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
                    title: 'Email',
                    data: 'email',
                    className: 'text-center',
                },
                {
                    title: 'Username',
                    data: 'username',
                    className: 'text-center',
                },
                {
                    title: 'Roles',
                    data: 'roles',
                    className: 'text-center',
                },
                {
                    title: 'Aksi',
                    responsivePriority: -1,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        if (full.roles == 'admin') {
                            return `
                                <div class="button-icon-btn button-icon-btn-cl">
                                    <button class="btn btn-warning btn-sm" type="button" id="btn-res-pass" data-id="` + full.id_users + `"><i class="fa fa-refresh"></i>&nbsp;Reset Password</button>
                                </div>
                            `;
                        } else {
                            var status = (full.status === '1') ? '<i class="fa fa-check"></i>&nbsp;Nonaktifkan' : '<i class="fa fa-times"></i>&nbsp;Aktifkan';
                            return `
                                <div class="button-icon-btn button-icon-btn-cl">
                                    <button class="btn btn-warning btn-sm" type="button" id="btn-res-pass" data-id="` + full.id_users + `"><i class="fa fa-refresh"></i>&nbsp;Reset Password</button>&nbsp;
                                    <button class="btn btn-primary btn-sm" type="button" id="sts" data-sts="` + full.status + `" data-id="` + full.id_users + `">` + status + `</button>&nbsp;
                                    <button class="btn btn-danger btn-sm" type="button" id="btn-del" data-id="` + full.id_users + `"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                                </div>
                            `;
                        }
                    },
                },
            ],
        });
    }();

    // untuk reset form
    var untukResetForm = function() {
        $(document).on('click', '#btn-add', function() {
            $('#judul-add-upd').html('Tambah');
            $('#nama').val('');
            $('#email').val('');
            $('#username').val('');
            $('#roles').val('');
        });
    }();

    // untuk tambah & ubah data
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            $('#nama').attr('required', 'required');
            $('#email').attr('required', 'required');
            $('#username').attr('required', 'required');
            $('#roles').attr('required', 'required');

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

    let untukResetPassData = function() {
        $(document).on('click', '#btn-res-pass', function() {
            var ini = $(this);
            swal({
                title: "Apakah Anda yakin ingin mereset password?",
                text: "Akun yang telah direset tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= admin_url() ?>users/reset_password",
                        dataType: 'json',
                        data: {
                            id: ini.data('id')
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

    let untukStatusData = function() {
        $(document).on('click', '#sts', function() {
            var id = $(this).data('id');
            var sts = $(this).data('sts');
            $.ajax({
                type: "post",
                url: "<?= admin_url() ?>users/status",
                dataType: 'json',
                data: {
                    id: id,
                    status: sts
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
                        url: "<?= admin_url() ?>users/process_del",
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