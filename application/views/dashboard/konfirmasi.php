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
							<tr>
								<td>Bukti Bayar</td>
								<td>: <?php if($detail_transaksi->bukti_bayar !=""){ ?>
									<img src="<?php echo base_url('assets/upload/image/'.$detail_transaksi->bukti_bayar) ?>" class="img img-thumbnail" width="200">
								<?php }else{ echo 'Belum ada bukti bayar';} ?>
								</td>
							</tr>
						</thead>
					</table>
					<?php 
					if(isset($error)){
						echo '<p class="alert alert-warning"'.$error.'</p>';
					}
					//notif error
					echo validation_errors('<p class="alert alert-warning">','</p>');

					//form open
					echo form_open_multipart(base_url('dashboard/konfirmasi/'.$detail_transaksi->kode_transaksi));
					 ?>
					 <table class="table">
					 	<tbody>
					 		<tr>
					 			<td width="30%">Pembayaran ke rekening</td>
					 			<td>
					 				<select name="id_rekening" class="form-control">
					 					<?php foreach ($rekening as $rekening) { ?>
					 						<option value="<?php echo $rekening->id_rekening ?>">
					 							<?php echo $rekening->nama_bank ?> (NO. rekening: <?php echo $rekening->nomor_rekening ?> a.n <?php echo $rekening->nama_pemilik ?>)
					 						</option>
					 					<?php } ?>
					 				</select>
					 			</td>
					 		</tr>
					 		<tr>
					 			<td>Tanggal Bayar</td>
					 			<td>
					 				<input type="date" name="tanggal_bayar" class="form-control-lg" placeholder="dd-mm-yyyy" value="<?php echo date('d-m-y'); ?>">
					 			</td>
					 		</tr>
					 		<tr>
					 			<td>Jumlah Pembayaran</td>
					 			<td>
					 				<input type="number" name="jumlah_bayar" class="form-control-lg" placeholder="jumlah_bayar" value="<?php echo $detail_transaksi->total_bayar;  ?>">

					 			</td>
					 		</tr>
					 		<tr>
					 			<td>Dari Bank</td>
					 			<td>
					 				<input type="text" name="nama_bank" class="form-control" placeholder="Nama Bank"></input>
					 				<small>Misal: BANK BCA</small>
					 			</td>
					 		</tr>
					 		<tr>
					 			<td>Dari Nomor Rekening</td>
					 			<td>
					 				<input type="number" name="rekening_pembayaran" class="form-control" placeholder="Nama Bank"></input>
					 				<small>Misal: 224242424</small>
					 			</td>
					 		</tr>
					 		<tr>
					 			<td>Nama Pemilik Rekening</td>
					 			<td>
					 				<input type="text" name="rekening_distributor" class="form-control" placeholder="Nama Pembayaran Rekening"></input>
					 				<small>Misal: Andoyo</small>
					 			</td>
					 		</tr>
					 		<tr>
					 			<td>Upload Bukti Bayar</td>
					 			<td>
					 				<input type="file" name="bukti_bayar" class="form-control" placeholder="Upload Bukti Pembayaran"></input>
					 			</td>
					 		</tr>
					 		<tr>
					 			<td></td>
					 			<td>
					 				<div class="btn-group">
					 					<button class="btn btn-success btn-lg" type="submit" name="submit"><i class="fa fa-upload"></i> Submit</button>
					 					<button class="btn btn-info btn-lg" type="reset" name="reset"><i class="fa fa-times"></i> Reset</button>
					 				</div>
					 			</td>
					 		</tr>
					 	</tbody>
					 </table>

				 <?php 
				 //kalau gk ada tampilkan notifikasi
				}else{ 
					?>
				 	<p class="alert alert-success">
				 		<i class="fa fa-warning"></i> Belum ada data Transaksi
				 	</p>
				<?php } ?>
			
		</div>
	</div>
</div>
</section>