<script type="text/javascript">
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
</script>