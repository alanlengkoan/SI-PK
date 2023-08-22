<script>
    // untuk ubah jumlah
    var untukUbahJumlah = function() {
        $('body').on('input', '#inpjumlah', function() {
            var txt1 = $(this).val();
            var txt2 = $(this).parent().parent().parent().find('#inpharga').val();
            var stock = $(this).data('stock');
            // untuk membatasi value stock
            if (txt1 >= stock) {
                $(this).val(Math.max(Math.min(txt1, stock), -stock));
                txt1 = stock;
            } else {
                txt1 = txt1;
            }
            var total = $('[id="inpsubtotal"]');
            var jumlah = parseInt(txt1) * parseInt(txt2);
            if (txt1 == 0 || isNaN(jumlah)) {
                $(this).parent().parent().parent().find('#sub-total').html('0')
                $(this).parent().parent().parent().find('#inpsubtotal').val('0')
            } else {
                $(this).parent().parent().parent().find('#sub-total').html(autoSeparator(jumlah))
                $(this).parent().parent().parent().find('#inpsubtotal').val(jumlah)
            }
            var totalSum = [];
            for (let i = 0; i < total.length; i++) {
                totalSum.push(parseInt($(total[i]).val()));
            }
            var sum = totalSum.reduce(function(a, b) {
                return a + b;
            }, 0);
            $('#total').html(autoSeparator(sum));
        });
    }();

    // untuk hapus data
    var untukHapusData = function() {
        $(document).on('click', '#btn-hapus', function() {
            var ini = $(this);
            swal({
                title: "Apakah Anda yakin ingin menghapusnya?",
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url() ?>keranjang/del",
                        dataType: 'json',
                        data: {
                            id: ini.data('id')
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>');
                        },
                        success: function(response) {
                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            })
                            .then((value) => {
                                location.reload()
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