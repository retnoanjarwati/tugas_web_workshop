<?php 
//ambil data menu dari konfigurasi
$nav_product	= $this->konfigurasi_model->nav_product();
$nav_product	= $this->konfigurasi_model->nav_product();
 ?>
<div class="wrap_header">
				<!-- Logo -->
				<a href="index.html" class="logo">
					<img src="<?php echo base_url('assets/upload/image/'.$site->logo) ?>" alt="<?php echo $site->namaweb ?> | <?php echo $site->tagline ?>">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<!-- HOME -->
							<li>
								<a href="<?php echo base_url() ?>">Beranda</a>
							</li>
							<!-- MENU Belanja -->
							<li>
								<a href="">Belanja</a>
								<ul class="sub_menu">
									<li><a href="<?php echo base_url('product') ?>">Belanja</a></li>
										<li><a href="<?php echo base_url('belanja') ?>">Keranjang Belanja</a></li>
										<li><a href="<?php echo base_url('dashboard/belanja') ?>">Konfirmasi Pembayaran</a></li>
								</ul>
							</li>
							<!-- MENU PRODUK -->
							<li>
								<a href="<?php echo base_url('product') ?>">Kategori Produk</a>
								<ul class="sub_menu">
									<?php foreach ($nav_product as $nav_product) { ?>
									<li><a href="<?php echo base_url('product/kategori/'.$nav_product->slug_kategori) ?>"><?php echo $nav_product->nama_kategori ?></a></li>
								<?php } ?>
								</ul>
							</li>
							<li>
								<a href="<?php echo base_url('about') ?>">Tentang Kami</a>
							</li>

							<li>
								<a href="<?php echo base_url('kontak') ?>">Kontak</a>
							</li>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
					<?php if($this->session->userdata('email')){ ?>
						<div class="wrap_menu">
						<nav class="menu">
							<ul class="main_menu">
								<li>
									<a href="#" class="header-wrapicon1 dis-block">
										<img src="<?php echo base_url() ?>assets/templates/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">&nbsp;&nbsp;<?php echo $this->session->userdata('nama_distributor'); ?>
									</a>
									<ul class="sub_menu">
										<li><a href="<?php echo base_url('dashboard') ?>">Akun Saya</a></li>
										<li><a href="<?php echo base_url('dashboard/belanja') ?>">Order</a></li>
										<li><a href="<?php echo base_url('masuk/logout') ?>">Logout</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>

					<?php }else{ ?>
					<div class="wrap_menu">
						<nav class="menu">
							<ul class="main_menu">
								<li>
									<a href="<?php echo base_url('registrasi') ?>" class="header-wrapicon1 dis-block">
										<img src="<?php echo base_url() ?>assets/templates/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
									</a>
									<ul class="sub_menu">
										<li><a href="<?php echo base_url('masuk') ?>">Masuk</a></li>
										<li><a href="<?php echo base_url('registrasi') ?>">Daftar</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>	
					<?php } ?>
					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
						<?php 
						//check data belanjaan ada atau tidak
						$keranjang = $this->cart->contents();

						?>
						<img src="<?php echo base_url() ?>assets/templates/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti"><?php echo count($keranjang) ?></span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<?php 
								//kalau ga ada data belanjaan
								if(empty($keranjang)){ ?>
									<li class="header-cart-item">
										<p class="alert alert-success">Keranjang Belanja Kosong</p>
									</li>
									<?php 
									//kalau ada
									}else{
										
										//tampilkan data belanjaan
										foreach ($keranjang as $keranjang) {
											$id_product = $keranjang['id'];
											//ambil data product
											$productnya = $this->product_model->detail($id_product)
										?>
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="<?php echo base_url('assets/upload/image/thumbs/'.$productnya->gambar) ?>" alt="<?php echo $keranjang['name'] ?>">
									</div>

									<div class="header-cart-item-txt">
										<a href="<?php echo base_url('product/detail/'.$productnya->slug_product) ?>" class="header-cart-item-name">
											<?php echo $keranjang['name'] ?>
										</a>

										<span class="header-cart-item-info">
											<?php echo $keranjang['qty'] ?> KW x Rp. <?php echo number_format($keranjang['price'],'0',',','.') ?>
										</span>
									</div>
								</li>
							<?php }} ?>
							</ul>

							<div class="header-cart-total">
								Total: <?php echo 'Rp. '.number_format($this->cart->total() * 100, '0',',','.'); ?>
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="<?php echo base_url('belanja') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="<?php echo base_url('belanja/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="<?php echo base_url() ?>assets/templates/images/icons/logo.png" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="<?php echo base_url() ?>assets/templates/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide2"></span>

					<div class="header-wrapicon2">
						<?php 
						//check data belanjaan ada atau tidak
						$keranjang_mobile = $this->cart->contents();

						?>
						<img src="<?php echo base_url() ?>assets/templates/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">0</span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<?php 
								//kalau ga ada data belanjaan
								if(empty($keranjang_mobile)){ ?>
									<li class="header-cart-item">
										<p class="alert alert-success">Keranjang Belanja Kosong</p>
									</li>
									<?php 
									//kalau ada
									}else{
										//total belanja
										$total_belanja_mobile = 'Rp. '.number_format($this->cart->total(), '0',',','.');
										//tampilkan data belanjaan
										foreach ($keranjang_mobile as $keranjang_mobile) {
											$id_product = $keranjang_mobile['id'];
											//ambil data product
											$product_mobile = $this->product_model->detail($id_product)
										?>
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="<?php echo base_url('assets/upload/image/thumbs/'.$product_mobile->gambar) ?>" alt="<?php echo $keranjang['name'] ?>">
									</div>

									<div class="header-cart-item-txt">
										<a href="<?php echo base_url('product/detail/'.$product_mobile->slug_product) ?>" class="header-cart-item-name">
											<?php echo $keranjang_mobile['name'] ?>
										</a>

										<span class="header-cart-item-info">
											<?php echo $keranjang_mobile['qty'] ?> x Rp. <?php echo number_format($keranjang_mobile['price'],'0',',','.') ?>
										</span>
									</div>
								</li>
							<?php }} ?>
							</ul>

							<div class="header-cart-total">
								Total: <?php echo $total_belanja_mobile ?>
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="<?php echo base_url('belanja/keranjang') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="<?php echo base_url('belanja/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Check Out
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<span class="topbar-child1">
							Free shipping for standard order over $100
						</span>
					</li>

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								fashe@example.com
							</span>

							<div class="topbar-language rs1-select2">
								<select class="selection-1" name="time">
									<option>USD</option>
									<option>EUR</option>
								</select>
							</div>
						</div>
					</li>

					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="#" class="topbar-social-item fa fa-facebook"></a>
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
							<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
							<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
							<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url() ?>">Beranda</a>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url('produk') ?>">Kategori Product</a>
						<ul class="sub-menu">
							<?php foreach ($nav_product_mobile as $nav_product_mobile) { ?>
									<li><a href="<?php echo base_url('product/kategori/'.$nav_product_mobile->slug_kategori) ?>"><?php echo $nav_product_mobile->nama_kategori ?></a></li>
							<?php } ?>
						</ul>
						<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
					</li>

					<li class="item-menu-mobile">
						<a href="<?php echo base_url('kontak') ?>">Kontak</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>