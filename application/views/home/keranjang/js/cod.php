<script>
    // untuk tambah data
    var untukTambahData = function() {
        $('#form-transfer').submit(function(e) {
            e.preventDefault();
            $('#nama_bayar').attr('required', 'required');
            $('#jumlah_bayar').attr('required', 'required');
            $('#bukti').attr('required', 'required');

            if ($('#form-transfer').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#proses').attr('disabled', 'disabled');
                        $('#proses').html('Waiting...');
                    },
                    success: function(response) {
                        swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            })
                            .then((value) => {
                                location.href = '<?= base_url() ?>nota/' + btoa($('#inpkkorder').val());
                            });
                    }
                })
            }
        });
    }();
</script>