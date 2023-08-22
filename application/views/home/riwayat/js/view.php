<script>
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
                        url: "<?= base_url() ?>batal",
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
</script>