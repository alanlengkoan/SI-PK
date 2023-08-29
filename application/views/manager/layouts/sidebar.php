<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <!-- begin:: profil sidebar -->
        <div class="">
            <div class="main-menu-header">
                <img class="img-menu-user img-radius" src="<?= (get_users_detail($this->session->userdata('id'))->foto !== null ? upload_url('gambar') . '' . get_users_detail($this->session->userdata('id'))->foto : "//placehold.co/150") ?>" alt="User-Profile-Image">
                <div class="user-details">
                    <p id="more-details"><?= get_users_detail($this->session->userdata('id'))->nama ?></p>
                </div>
            </div>
        </div>
        <!-- end:: profil sidebar -->
        <!-- begin:: menu sidebar -->
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === null ? 'active' : '') ?>">
                <a href="<?= manager_url() ?>">
                    <span class="pcoded-micon">
                        <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Laporan</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(3) === 'l_pembelian' ? 'active' : '') ?>">
                <a href="<?= manager_url() ?>laporan/l_pembelian">
                    <span class="pcoded-micon">
                        <i class="feather icon-file"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'l_pembelian_bulanan' ? 'active' : '') ?>">
                <a href="<?= manager_url() ?>laporan/l_pembelian_bulanan">
                    <span class="pcoded-micon">
                        <i class="feather icon-file"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Bulanan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'l_pembelian_tahunan' ? 'active' : '') ?>">
                <a href="<?= manager_url() ?>laporan/l_pembelian_tahunan">
                    <span class="pcoded-micon">
                        <i class="feather icon-file"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Tahunan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'l_pelanggan' ? 'active' : '') ?>">
                <a href="<?= manager_url() ?>laporan/l_pelanggan">
                    <span class="pcoded-micon">
                        <i class="feather icon-file"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Pelanggan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'l_kurir' ? 'active' : '') ?>">
                <a href="<?= manager_url() ?>laporan/l_kurir">
                    <span class="pcoded-micon">
                        <i class="feather icon-file"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Kurir</span>
                </a>
            </li>
        </ul>
        <!-- end:: menu sidebar -->
    </div>
</nav>