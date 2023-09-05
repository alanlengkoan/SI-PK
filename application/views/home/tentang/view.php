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
					<h2><?= (empty($pengaturan->nama) ? null : $pengaturan->nama) ?></h2>
					<p class="peragraph-blog">
						<?= (empty($pengaturan->alamat) ? null : $pengaturan->alamat) ?> merupakan rumah makan yang bergerak di bidang pelayanan jasa kuliner RM Bone tamparang mengakat konsep dari bangunan bambu patongko dan farian motif plafon kain RM Bone tamparang merupakan rumah makan pertama yang didirikan oleh bapak adi akbar dari ke 6 cabang lain nya RM Bone tamparang di dirikan pada tanggal 18 januari 2018 Kata tamparang yang berarti lautan menjadi simbol dan ciri khas khusus tersediri RM Bone tamparang menyediakan cita rasa khas dari berbagai menu lokal seperti masakan dari bahan dasar dari lautan seperti ikan laut bakar, goreng, cumi bakar, cumi goreng tepung, cumi asam manis dan cumi saos hitam, udang bakar, udang rebus udang goreng tepung udang asam manis saos pedas, serta kerang rebus dan masih banyak yang lainnya rumah makan Bonetamparang ini selain menyediakan makanan dari bahan dasar cumi udang kerang masih ada menu makan lain seperti ayam bakar, ayam goreng tepung, bolu bakar bolu goreng tepung, bolu pallukaci nasi goreng mie goreng serta mie kering selain dari semua menu makanan yang disebutkan di atas rumah makan ini juga menyediakan berbagai macam menu minuman seperti minuman yang berbahan dasar dari buah asli seperti jus alvokat, jus buah naga, jus sirsak, jus jeruk, jus melon, jus jeruk nipis dan masih banyak lainnya.
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