<script>
    // untuk simpan
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-checkout', function(e) {
            e.preventDefault();
            $('#inpnama').attr('required', 'required');
            $('#inpemail').attr('required', 'required');
            $('#inpnotelpon').attr('required', 'required');
            $('#inpkelamin').attr('required', 'required');
            $('#inpalamat').attr('required', 'required');
            $('#inptglpengambilan').attr('required', 'required');
            $('#inpmetodepengantaran').attr('required', 'required');
            $('#inpmetodepembayaran').attr('required', 'required');

            if ($('#inpmetodepengantaran').val() === 's') {
                $('#inpidongkir').attr('required', 'required');
            }

            if ($('#inpmetodepembayaran').val() === 't') {
                $('#inpidbank').attr('required', 'required');
            }

            if ($('#form-checkout').parsley().isValid() == true) {
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
                        $('#save').html('Menunggu...');
                    },
                    success: function(response) {
                        swal({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            button: response.button,
                        }).then((value) => {
                            location.href = '<?= base_url() ?>nota/' + btoa($('#inpkodeorder').val());
                        });

                        $('#save').removeAttr('disabled');
                        $('#save').html('Proses');
                    }
                })
            }
        });
    }();

    // untuk pilih metode pengiriman
    var untukMetodePembayaran = function() {
        $(document).on('change', '#inpmetodepengantaran', function() {
            var ini = $(this);
            var val = ini.val();
            if (val == 's') {
                $('#pengiriman').attr('style', 'width: 100%');
                $('#inpidongkir').attr('required', 'required');
            } else {
                $('#pengiriman').attr('style', 'display: none');
                $('#inpidongkir').removeAttr('required');
                $('#inpidongkir').val('');
            }
        });
    }();

    // untuk pilih metode pembayaran
    var untukMetodePembayaran = function() {
        $(document).on('change', '#inpmetodepembayaran', function() {
            var ini = $(this);
            var val = ini.val();
            if (val == 't') {
                $('#transfer').attr('style', 'width: 100%');
                $('#inpidbank').attr('required', 'required');
            } else {
                $('#transfer').attr('style', 'display: none');
                $('#inpidbank').removeAttr('required');
                $('#inpidbank').val('');
            }
        });
    }();

    // untuk tampilkan nomor rekening
    var untukNoRekening = function() {
        $(document).on('change', '#inpidbank', function() {
            var ini = $(this);
            var no_rekening = ini.find(':selected').data('rekening');
            if (ini.val() != '') {
                $('#nomor_rekening').attr('style', 'width: 100%');
                $('#inprekening').val(no_rekening);
            } else {
                $('#nomor_rekening').attr('style', 'display: none');
            }
        });
    }();
</script>