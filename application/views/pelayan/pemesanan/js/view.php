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


<script type="text/javascript">
    // untuk datatable
    var untukTabelPemesanan = function() {
        tabelPemesananDt = $('#tabel-pemesanan').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= pelayan_url() ?>pemesanan/get_data_pemesanan_dt',
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
                        return `
                            <div class="button-icon-btn button-icon-btn-cl">
                                <a class="btn btn-info btn-sm waves-effect lihat" href="<?= pelayan_url() ?>pemesanan/detail/` + btoa(full.kd_pemesanan) + `">
                                    <i class="fa fa-info"></i>&nbsp;Detail
                                </a>&nbsp;
                                <a class="btn btn-primary btn-sm waves-effect lihat" href="<?= pelayan_url() ?>pemesanan/upd/` + btoa(full.kd_pemesanan) + `">
                                    <i class="fa fa-edit"></i>&nbsp;Ubah
                                </a>&nbsp;
                            </div>`;
                    },
                },
            ],
        });
    }();
</script>