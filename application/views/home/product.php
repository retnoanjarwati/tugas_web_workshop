<!-- Our product -->
<section class="bgwhite p-t-45 p-b-58">
<div class="container">
	<div class="sec-title p-b-22">
		<h3 class="m-text5 t-center">
			Our Products
		</h3>
	</div>

	<!-- Tab01 -->
	<div class="tab01">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab">Best Seller</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#featured" role="tab">Featured</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#sale" role="tab">Sale</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#top-rate" role="tab">Top Rate</a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content p-t-35">
			<!-- - -->
			<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
				<div class="row">
					<?php foreach ($product as $product) { ?>
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
						<?php 
							//form untuk memproses belanjaan
							echo form_open(base_url('belanja/add')); 
							//elemen yang dibawa
							echo form_hidden('id', $product->id_product);
							echo form_hidden('qty', 1);
							echo form_hidden('price', $product->harga);
							echo form_hidden('name', $product->nama_product);
							echo form_hidden('id_user', $product->id_user);
							//elemen redirect
							echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
							?>
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
								<img src="<?php echo base_url('assets/upload/image/thumbs/'.$product->gambar) ?>" alt="<?php echo $product->nama_product ?>">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Add to Cart
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="<?php echo base_url('product/detail/'.$product->slug_product) ?>" class="block2-name dis-block s-text3 p-b-5">
									<?php echo $product->nama_product ?>
								</a>
								<p class="block2-name dis-block s-text3 p-b-5">Oleh: <?php echo $product->nama_user ?></p>

								<span class="block2-price m-text6 p-r-5">
									IDR <?php echo number_format($product->harga,'0',',','.') ?>
								</span>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
					<?php } ?>
					
				</div>
			</div>
		</div>
	</div>
</div>
</section>