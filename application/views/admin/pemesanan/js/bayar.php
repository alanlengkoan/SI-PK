<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
    // untuk proses pembayaran
    var untukProsesPembayaran = function() {
        $(document).on('submit', '#form-pembayaran', function(e) {
            e.preventDefault();
            $('#inpnamapenyetor').attr('required', 'required');
            $('#inpjumlahbayar').attr('required', 'required');

            if ($('#form-pembayaran').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#proses').attr('disabled', 'disabled');
                        $('#proses').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        swal({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            button: response.button,
                        }).then((value) => {
                            location.href = '<?= admin_url() ?>pemesanan/detail/<?= base64url_encode($kd_pemesanan) ?>';
                        });
                        $('#proses').removeAttr('disabled');
                        $('#proses').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                })
            }
        });
    }();
</script>