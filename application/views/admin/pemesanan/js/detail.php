<script>
    var untukUbahAkun = function() {
        $(document).on('click', '#btn-simpan', function(e) {
            e.preventDefault();
            var ini = $(this);
            var kdPemesanan = $('#inpkdpemesanan').val();
            var jumlahTransfer = $('#inpjumlahtransfer').val();

            if (jumlahTransfer === '') {
                $('#inpjumlahtransfer').attr('required', 'required');
                alert('Jumlah Transfer tidak boleh kosong!');
            } else {
                $.ajax({
                    method: 'post',
                    url: '<?php admin_url() ?>../pembayaran',
                    dataType: 'json',
                    data: {
                        inpkdorder: kdPemesanan,
                        inpjumlahtransfer: jumlahTransfer,
                    },
                    beforeSend: function() {
                        ini.attr('disabled', 'disabled');
                    },
                    success: function(response) {
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
            }
        });
    }();
</script>