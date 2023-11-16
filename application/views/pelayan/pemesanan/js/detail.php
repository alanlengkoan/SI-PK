<script>
    // untuk terima paket
    var untukTerimaPaket = function() {
        $(document).on('click', '#diterima', function() {
            var ini = $(this);
            swal({
                title: "Apakah Anda yakin barang telah diterima oleh pelanggan?",
                text: "Data yang telah diubah tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= kurir_url() ?>pemesanan/setor",
                        dataType: 'json',
                        data: {
                            id: ini.data('id')
                        },
                        beforeSend: function () {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                        },
                        success: function (response) {
                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            })
                            .then((value) => {
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