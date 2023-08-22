<script type="text/javascript">
    // untuk ubah data
    var untukPilihCake = function() {
        $(document).on('click', '#add-topper', function(e) {
            e.preventDefault();
            var ini = $(this);
            var id_users = ini.data('id_users');
            var kd_topper = ini.data('kd_topper');

            if (id_users === '') {
                swal({
                        title: 'Info',
                        text: 'Jika ingin melakukan transaksi silahkan registrasi terlebih dahulu!',
                        icon: 'info',
                        button: 'Okay!',
                    })
                    .then((value) => {
                        window.location = '<?= login_url() ?>';
                    });
            } else {
                $('#inpkdproduk').val(kd_topper);
                $('#modalTopper').modal('show');
            }
        });
    }();

    // untuk tambah data
    var untukTambahKeranjang = function() {
        $(document).on('submit', '#form-keranjang', function(e) {
            e.preventDefault();
            $('#kd_produk').attr('required', 'required');

            if ($('#form-keranjang').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#btn-keranjang').attr('disabled', 'disabled');
                        $('#btn-keranjang').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        window.location = '<?= base_url() ?>keranjang';
                    }
                })
            }
        });
    }();
</script>