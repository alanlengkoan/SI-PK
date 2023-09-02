<!-- begin:: breadcrumb -->
<div class="breadcrumb-area bg-image-3 ptb-200">
	<div class="container">
		<div class="breadcrumb-content text-center">
			<h3><?= $title ?></h3>
			<ul>
				<li><a href="<?= base_url() ?>">Beranda</a></li>
				<li class="active"><?= $title ?> </li>
			</ul>
		</div>
	</div>
</div>
<!-- end:: breadcrumb -->

<div class="about-us-area pt-100 pb-100">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 d-flex align-items-center">
				<div class="overview-content-2">
					<h4>Selamat Datang di</h4>
					<h2><?= (empty($pengaturan->alamat) ? null : $pengaturan->alamat) ?></h2>
					<p class="peragraph-blog">
						<?= (empty($pengaturan->alamat) ? null : $pengaturan->alamat) ?> merupakan salah satu usaha mikro yg bergerak di bidang pemesanan dan penjualan cake and dessert ,toko UZ Dapur Jensud dikelolah oleh pemilik yg bernama uzlifah yg didirikan pada tahun 2017 ,UZ Dapur Jensud berlokasi di jalan jendral Sudirman , kecamatan Sinjai Utara.
					</p>
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="overview-img text-center">
					<a href="#">
						<img src="<?= assets_url() ?>page/img/banner/about-us.jpg" alt="">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>