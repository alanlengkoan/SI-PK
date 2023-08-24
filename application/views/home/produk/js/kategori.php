<script type="text/javascript">
    // untuk ubah data
    var untukUbahAkun = function() {
        $(document).on('click', '#btn-keranjang', function(e) {
            e.preventDefault();
            var ini = $(this);
            var id_users = ini.data('id_users');
            var kd_produk = ini.data('kd_produk');
            var jenis = ini.data('jenis');

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
                $.ajax({
                    method: 'post',
                    url: '<?= base_url() ?>keranjang/add',
                    dataType: 'json',
                    data: {
                        inpidusers: id_users,
                        inpkdproduk: kd_produk,
                    },
                    beforeSend: function() {
                        ini.attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        window.location = '<?= base_url() ?>keranjang';
                    }
                });
            }
        });
    }();
</script>