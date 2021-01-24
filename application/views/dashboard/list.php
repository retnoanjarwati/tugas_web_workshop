<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
			<div class="leftbar p-r-20 p-r-0-sm">
				<?php include('menu.php') ?>
			</div>
		</div>

		<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">

			<!-- Product -->
				<div class="alert alert-success">
					<h1>Selamat datang <i><strong><?php echo $this->session->userdata('nama_distributor'); ?></strong></i></h1>
				</div>
				<?php if($detail_transaksi){ ?>
				<table class="table table-bordered" width="100%">
					<thead>
							<tr class="bg-success">
								<th>NO</th>
								<th>KODE</th>
								<th>TANGGAL</th>
								<th>JUMLAH ITEM</th>
								<th>JUMLAH BAYAR</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;foreach ($detail_transaksi as $detail_transaksi) { ?>
							<tr>
								<td><?php echo $i++; ?></td>
								<td><?php echo $detail_transaksi->kode_transaksi ?></td>
								<td><?php echo date('d-m-Y', strtotime($detail_transaksi->tanggal_transaksi)) ?></td>
								<td><?php echo $detail_transaksi->total_item ?></td>
								<td ><?php echo 'Rp. '.number_format($detail_transaksi->total_bayar,'0',',','.') ?>
								<br><small>
									<?php if($detail_transaksi->status_bayar=='Belum Bayar'){ ?>
										<a href="#" class="btn btn-danger btn-sm">
									<?php }elseif($detail_transaksi->status_bayar=='Diproses'){ ?>
										<a href="#" class="btn btn-warning btn-sm">
									<?php }elseif($detail_transaksi->status_bayar=='Selesai'){ ?>
										<a href="#" class="btn btn-success btn-sm">
									<?php }else{ ?>
										<a href="#" class="btn btn-info btn-sm">
									<?php } ?>
									<?php echo $detail_transaksi->status_bayar ?></a>
				                </small>
				            	</td>
								<td>
									<div class="btn-group">
										<a href="<?php echo base_url('dashboard/detail/'.$detail_transaksi->kode_transaksi) ?>" class="btn btn-outline-success btn-sm"><i class="fa fa-eye"></i> Detail</a>
										<?php if($detail_transaksi->status_bayar=='Belum Bayar'){ ?>
											<a href="<?php echo base_url('dashboard/konfirmasi/'.$detail_transaksi->kode_transaksi) ?>" class="btn btn-info btn-sm"><i class="fa fa-upload"></i> Pembayaran</a>	
										<?php }elseif($detail_transaksi->status_bayar=='Dikirim'){ ?>
											<?php include('diterima.php') ?>	
										<?php }else{ ?>
										<a href="<?php echo base_url('dashboard/bukti_bayar/'.$detail_transaksi->kode_transaksi) ?>" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Bukti Bayar</a>
									<?php } ?>
									</div>
								</td>
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