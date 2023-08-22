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

<script>
    let tabelRequestDt = null;

    // untuk datatable
    var untukTabelRequest = function() {
        tabelRequestDt = $('#tabel-request').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>request/get_data_request_dt',
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
                    title: 'Telepon',
                    data: 'telepon',
                    className: 'text-center',
                },
                {
                    title: 'E-Mail',
                    data: 'email',
                    className: 'text-center',
                },
                {
                    title: 'Jenis',
                    data: 'jenis',
                    className: 'text-center',
                },
                {
                    title: 'Keterangan',
                    data: 'keterangan',
                    className: 'text-center',
                },
                {
                    title: 'Gambar',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return `<a href="<?= upload_url('gambar') ?>` + full.gambar + `"><img src="<?= upload_url('gambar') ?>` + full.gambar + `" width="100" heigth="100" /></a>`
                    },
                },
            ],
        });
    }();
</script>