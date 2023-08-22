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
    // untuk datatable
    var untukTabelPembelian = function() {
        $('#tabel-pembelian').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            ajax: '<?= admin_url() ?>pembelian/get_data_pembelian_dt',
            footerCallback: function(row, data, start, end, display) {
                var api = this.api();

                var totalPembelian = 0;
                var totalPembayaran = 0;

                $(data).each(function(i) {
                    let t = (data[i].transfer == null) ? 0 : data[i].transfer;
                    let c = (data[i].cod == null) ? 0 : data[i].cod;

                    totalPembelian += parseInt(data[i].total);
                    totalPembayaran += (parseInt(t) + parseInt(c));
                });

                // untuk footer
                $(api.column(4).footer()).html(autoSeparator(totalPembelian));
                $(api.column(5).footer()).html(autoSeparator(totalPembayaran));
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
                    title: 'Kode Order',
                    data: 'kd_pemesanan',
                    className: 'text-center',
                },
                {
                    title: 'Tanggal Pembelian',
                    data: 'tgl_pemesanan',
                    className: 'text-center',
                },
                {
                    title: 'Jam Pembelian',
                    data: 'jam_pemesanan',
                    className: 'text-center',
                },
                {
                    title: 'Total Pembelian',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return autoSeparator(full.total);
                    },
                },
                {
                    title: 'Total Pembayaran',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        let transfer = (full.transfer == null) ? 0 : full.transfer;
                        let cod = (full.cod == null) ? 0 : full.cod;
                        var pembayaran = (parseInt(transfer) + parseInt(cod));

                        return autoSeparator(pembayaran);
                    },
                }
            ],
        });
    }();
</script>