<script>
    // untuk simpan
    var untukTambahDanUbahData = function() {
        $(document).on('submit', '#form-checkout', function(e) {
            e.preventDefault();
            $('#nama').attr('required', 'required');
            $('#kelamin').attr('required', 'required');
            $('#email').attr('required', 'required');
            $('#telepon').attr('required', 'required');
            $('#alamat').attr('required', 'required');
            $('#tgl_pemesanan').attr('required', 'required');
            $('#metode_pemesanan').attr('required', 'required');
            $('#metode_pembayaran').attr('required', 'required');

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
                            location.href = '<?= base_url() ?>nota/' + btoa($('#kd_pemesanan').val());
                        });

                        $('#save').removeAttr('disabled');
                        $('#save').html('Proses');
                    }
                })
            }
        });
    }();

    // untuk pilih metode pemesanan
    var untukMetodePembayaran = function() {
        $(document).on('change', '#metode_pemesanan', function() {
            var ini = $(this);
            var val = ini.val();
            if (val == 'a') {
                $('#diantar').attr('style', 'width: 100%');
                $('#ditempat').attr('style', 'display: none');
                $('#id_ongkir').attr('required', 'required');
            } else if (val == 'e') {
                $('#ditempat').attr('style', 'width: 100%');
                $('#diantar').attr('style', 'display: none');
                $('#id_meja').attr('required', 'required');
            } else {
                $('#ditempat').attr('style', 'display: none');
                $('#id_meja').removeAttr('required');
                $('#id_meja').val('');

                $('#diantar').attr('style', 'display: none');
                $('#id_ongkir').removeAttr('required');
                $('#id_ongkir').val('');
            }
        });
    }();

    // untuk pilih metode pembayaran
    var untukMetodePembayaran = function() {
        $(document).on('change', '#metode_pembayaran', function() {
            var ini = $(this);
            var val = ini.val();
            if (val == 't') {
                $('#transfer').attr('style', 'width: 100%');
                $('#id_bank').attr('required', 'required');
            } else {
                $('#transfer').attr('style', 'display: none');
                $('#id_bank').removeAttr('required');
                $('#id_bank').val('');
            }
        });
    }();

    // untuk tampilkan nomor rekening
    var untukNoRekening = function() {
        $(document).on('change', '#id_bank', function() {
            var ini = $(this);
            var no_rekening = ini.find(':selected').data('rekening');
            if (ini.val() != '') {
                $('#nomor_rekening').attr('style', 'width: 100%');
                $('#rekening').val(no_rekening);
            } else {
                $('#nomor_rekening').attr('style', 'display: none');
            }
        });
    }();
</script>