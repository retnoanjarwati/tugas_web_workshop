<!-- Content page --> 
<section class="bgwhite p-t-55 p-b-65">
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-3 col-lg-3 p-b-50">
			<div class="leftbar p-r-20 p-r-0-sm">
				<?php include('menu.php') ?>
			</div>
		</div>

		<div class="col-sm-6 col-md-9 col-lg-9 p-b-50">
			<h2><?php echo $title ?></h2>
				<hr>
				<p>Berikut adalah riwayat belanja Anda</p>
				<?php if($detail_transaksi){ ?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="20%">KODE TRANSAKSI</th>
								<th>: <?php echo $detail_transaksi->kode_transaksi ?></th>
							</tr>
							<tr>
								<td>Tanggal</td>
								<td>: <?php echo date('d-m-Y', strtotime($detail_transaksi->tanggal_transaksi)) ?></td>
							</tr>
							<tr>
								<td>Total Belanja</td>
								<td>: <?php echo 'Rp. '.number_format($detail_transaksi->jumlah_transaksi, '0',',','.') ?></td>
							</tr>
							<tr>
								<td>Ongkos kirim</td>
								<td>: <?php echo 'Rp. '.number_format($detail_transaksi->ongkir, '0',',','.') ?></td>
							</tr>
							<tr>
								<td>Jumlah Bayar</td>
								<td>: <?php echo 'Rp. '.number_format($detail_transaksi->total_bayar, '0',',','.') ?></td>
							</tr>
							<tr>
								<td>Status Bayar</td>
								<td>: <?php echo $detail_transaksi->status_bayar ?></td>
							</tr>
						</thead>
					</table>
				<table class="table table-bordered" width="100%">
					<thead>
							<tr class="bg-success">
								<th>NO</th>
								<th>KODE</th>
								<th>NAMA PRODUCT</th>
								<th>JUMLAH (KWINTAL)</th>
								<th>HARGA</th>
								<th>SUB TOTAL</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach ($transaksi as $transaksi) { ?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $transaksi->kode_transaksi ?></td>
								<td><?php echo $transaksi->nama_product ?></td>
								<td><?php echo $transaksi->jumlah ?></td>
								<td><?php echo 'Rp. '.number_format($transaksi->harga, '0',',','.') ?></td>
								<td><?php echo 'Rp. '.number_format($transaksi->total_harga, '0',',','.') ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				 <?php }else{ ?>
				 	<p class="alert alert-success">
				 		<i class="fa fa-warning"></i> Belum ada data Transaksi
				 	</p>
				<?php } ?>
			
		</div>
	</div>
</div>
</section>