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
                <a href="<?= admin_url() ?>">
                    <span class="pcoded-micon">
                        <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Master</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'bank' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>bank">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Bank</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'diskon' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>diskon">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Diskon</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'kategori' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>kategori">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Kategori</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'meja' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>meja">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Meja</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'slide' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>slide">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Slide</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'ongkir' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>ongkir">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Ongkos Kirim</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'produk' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>produk">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Produk</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'stok' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>stok">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Stok</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Pustaka</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'pelanggan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>pelanggan">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Pelanggan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'pelayan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>pelayan">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Pelayan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'kurir' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>kurir">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Kurir</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'users' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>users">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Users</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Transaksi</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'pemesanan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>pemesanan">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Pemesanan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'pembelian' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>pembelian">
                    <span class="pcoded-micon">
                        <i class="feather icon-package"></i>
                    </span>
                    <span class="pcoded-mtext">Pembelian</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label">Laporan</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(3) === 'l_pembelian' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/l_pembelian">
                    <span class="pcoded-micon">
                        <i class="feather icon-file"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'l_pembelian_bulanan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/l_pembelian_bulanan">
                    <span class="pcoded-micon">
                        <i class="feather icon-file"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Bulanan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'l_pembelian_tahunan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/l_pembelian_tahunan">
                    <span class="pcoded-micon">
                        <i class="feather icon-file"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Tahunan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'l_pelanggan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/l_pelanggan">
                    <span class="pcoded-micon">
                        <i class="feather icon-file"></i>
                    </span>
                    <span class="pcoded-mtext">Laporan Pelanggan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(3) === 'l_kurir' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>laporan/l_kurir">
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