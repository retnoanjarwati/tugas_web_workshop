
<table class="table table-bordered" width="100%">
<thead>
		<tr class="bg-success">
			<th>NO</th>
			<th>PELANGGAN</th>
			<th>KODE</th>
			<th>TANGGAL</th>
			<th>JUMLAH TOTAL</th>
			<th>JUMLAH ITEM</th>
			<th>STATUS BAYAR</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=1;foreach ($detail_transaksi as $detail_transaksi) { ?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $detail_transaksi->nama_distributor ?>
				<br><small>
					Telephon: <?php echo $detail_transaksi->telephon ?>
					<br>Email: <?php echo $detail_transaksi->email ?>
					<br>Alamat Kirim: <br><?php echo nl2br($detail_transaksi->alamat) ?>
				</small>
			</td>
			<td><?php echo $detail_transaksi->kode_transaksi ?></td>
			<td><?php echo date('d-m-Y', strtotime($detail_transaksi->tanggal_transaksi)) ?></td>
			<td><?php echo number_format($detail_transaksi->jumlah_transaksi) ?></td>
			<td><?php echo $detail_transaksi->total_item ?></td>
			<td><?php echo $detail_transaksi->status_bayar ?></td>
			<td>
				<div class="btn-group">
					<a href="<?php echo base_url('admin/transaksi/detail/'.$detail_transaksi->kode_transaksi) ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Detail</a>
					<a href="<?php echo base_url('admin/transaksi/cetak/'.$detail_transaksi->kode_transaksi) ?>" target="_blank" class="btn btn-info btn-xs" ><i class="fa fa-print"></i> Cetak</a>
					<?php if($detail_transaksi->status_bayar == 'Konfirmasi'){ ?>
						<a href="<?php echo base_url('admin/transaksi/status/'.$detail_transaksi->kode_transaksi) ?>" class="btn btn-warning btn-xs"><i class="fa fa-check"></i> Update Status</a>
					<?php } ?>	
				</div>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>