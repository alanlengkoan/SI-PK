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
        <div class="pcoded-navigation-label">Pustaka</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?= ($this->uri->segment(2) === 'bank' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>bank">
                    <span class="pcoded-micon">
                        <i class="feather icon-credit-card"></i>
                    </span>
                    <span class="pcoded-mtext">Bank</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'satuan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>satuan">
                    <span class="pcoded-micon">
                        <i class="feather icon-layers"></i>
                    </span>
                    <span class="pcoded-mtext">Satuan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'ukuran' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>ukuran">
                    <span class="pcoded-micon">
                        <i class="feather icon-box"></i>
                    </span>
                    <span class="pcoded-mtext">Ukuran</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'diskon' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>diskon">
                    <span class="pcoded-micon">
                        <i class="feather icon-percent"></i>
                    </span>
                    <span class="pcoded-mtext">Diskon</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'slide' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>slide">
                    <span class="pcoded-micon">
                        <i class="feather icon-image"></i>
                    </span>
                    <span class="pcoded-mtext">Slide</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'ongkir' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>ongkir">
                    <span class="pcoded-micon">
                        <i class="fa fa-truck"></i>
                    </span>
                    <span class="pcoded-mtext">Ongkos Kirim</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'request' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>request">
                    <span class="pcoded-micon">
                        <i class="feather icon-users"></i>
                    </span>
                    <span class="pcoded-mtext">Request</span>
                </a>
            </li>
            <li class="pcoded-hasmenu <?= ($this->uri->segment(2) === 'p_cake' || $this->uri->segment(2) === 'p_dessert' || $this->uri->segment(2) === 'p_topper' ? 'pcoded-trigger active' : '') ?>">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-tag"></i>
                    </span>
                    <span class="pcoded-mtext">Produk</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="<?= ($this->uri->segment(2) === 'p_cake' ? 'active' : '') ?>">
                        <a href="<?= admin_url() ?>p_cake" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">Cake</span>
                        </a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) === 'p_dessert' ? 'active' : '') ?>">
                        <a href="<?= admin_url() ?>p_dessert" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">Dessert</span>
                        </a>
                    </li>
                    <li class="<?= ($this->uri->segment(2) === 'p_topper' ? 'active' : '') ?>">
                        <a href="<?= admin_url() ?>p_topper" class="waves-effect waves-dark">
                            <span class="pcoded-mtext">Topper</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'stok' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>stok">
                    <span class="pcoded-micon">
                        <i class="feather icon-repeat"></i>
                    </span>
                    <span class="pcoded-mtext">Stok</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'pelanggan' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>pelanggan">
                    <span class="pcoded-micon">
                        <i class="feather icon-users"></i>
                    </span>
                    <span class="pcoded-mtext">Pelanggan</span>
                </a>
            </li>
            <li class="<?= ($this->uri->segment(2) === 'kurir' ? 'active' : '') ?>">
                <a href="<?= admin_url() ?>kurir">
                    <span class="pcoded-micon">
                        <i class="feather icon-users"></i>
                    </span>
                    <span class="pcoded-mtext">Kurir</span>
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