<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
    // load chat by ajax
    $.ajax({
        type: 'GET',
        url: '<?= admin_url() ?>pemesanan/load_chat/' + $('#kd_pemesanan').val(),
        dataType: 'html',
        success: function(response) {
            $('#dom_chat').html(response);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Request Ajax Gagal : ' + xhr.responseText;
            alert(errorMsg);
        }
    });

    function load_chat(kd_pemesanan) {
        $.ajax({
            type: 'GET',
            url: '<?= admin_url() ?>pemesanan/load_chat/' + kd_pemesanan,
            dataType: 'html',
            success: function(response) {
                $('#dom_chat').html(response);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                var errorMsg = 'Request Ajax Gagal : ' + xhr.responseText;
                alert(errorMsg);
            }
        });
    }

    // untuk kirim pesan
    var untukKirimPesan = function() {
        $(document).on('submit', '#form-send', function(e) {
            e.preventDefault();
            $('#pesan').attr('required', 'required')
            if ($('#form-send').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'html',
                    beforeSend: function() {
                        $('#kirim').attr('disabled', 'disabled');
                        $('#kirim').html('<i class="fa fa-spinner"></i>');
                    },
                    success: function(response) {
                        load_chat($('#kd_pemesanan').val());
                        $('#pesan').val('');
                        $('#kirim').removeAttr('disabled');
                        $('#kirim').html('<i class="fa fa-paper-plane"></i>');
                    }
                })
            }
        });
    }();

    setInterval(function() {
        load_chat($('#kd_pemesanan').val())
    }, 5000);
</script>