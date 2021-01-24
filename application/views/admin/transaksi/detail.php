<p class="text-right">
	<div class="btn-group pull-right">
		<a href="<?php echo base_url('admin/transaksi/cetak/'.$detail_transaksi->kode_transaksi) ?>" target="_blank" title="Cetak" class="btn btn-success btn-sm">
			<i class="fa fa-print"> Cetak</i>
		</a>
		<?php if($this->session->userdata('akses_level')=='Tengkulak'){ ?>
		<a href="<?php echo base_url('transaksi') ?>" title="Kembali" class="btn btn-info btn-sm">
			<i class="fa fa-backward"> Kembali</i>
		<?php }else{?>
			<a href="<?php echo base_url('admin/transaksi') ?>" title="Kembali" class="btn btn-info btn-sm">
			<i class="fa fa-backward"> Kembali</i>
		<?php } ?> ?>
		</a>
	</div>
</p>
<div class="clearfix"></div><hr>
<table class="table table-bordered">
<thead>
	<tr>
		<th width="20%">KODE TRANSAKSI</th>
		<th>: <?php echo $detail_transaksi->kode_transaksi ?></th>
	</tr>
	<?php if($detail_transaksi->status_bayar =="Dikirim" or $detail_transaksi->status_bayar =="Selesai"){ ?>
	<tr>
		<th>NOMOR RESI</th>
		<th>: <?php echo $detail_transaksi->no_resi ?></th>
	</tr>
<?php } ?>
	<tr>
		<th width="20%">NAMA DISTRIBUTOR</th>
		<th>: <?php echo $detail_transaksi->nama_distributor ?></th>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td>: <?php echo date('d-m-Y', strtotime($detail_transaksi->tanggal_transaksi)) ?></td>
	</tr>

	<tr>
		<td>Jumlah Total</td>
		<td>: <?php echo number_format($detail_transaksi->jumlah_transaksi) ?></td>
	</tr>
	<tr>
		<td>Status Bayar</td>
		<td>: <?php echo $detail_transaksi->status_bayar ?></td>
	</tr>
	<tr>
		<td>Bukti Bayar</td>
		<td>: <?php if($detail_transaksi->bukti_bayar ==""){echo "Belum Ada"; }else{?>
		<img src="<?php echo base_url('assets/upload/image/'.$detail_transaksi->bukti_bayar) ?>" class="img img-thumbnail" width="200"></td>
	<?php } ?>
	</tr>
	<tr>
		<td>Tanggal Bayar</td>
		<td>: <?php echo date('d-m-Y', strtotime($detail_transaksi->tanggal_bayar)) ?></td>
	</tr>
	<tr>
		<td>Jumlah Bayar</td>
		<td>: Rp. <?php echo number_format($detail_transaksi->jumlah_bayar, '0',',','.') ?></td>
	</tr>
	<tr>
		<td>Pembayaran dari</td>
		<td>: <?php echo $detail_transaksi->nama_bank ?> No. Rekening: <?php echo $detail_transaksi->rekening_pembayaran ?> a.n <?php echo $detail_transaksi->rekening_distributor ?></td>
	</tr>
	<tr>
		<td>Pembayaran ke rekening</td>
		<td>: <?php echo $rekening->nama_bank ?> No. Rekening: <?php echo $rekening->nomor_rekening ?> a.n <?php echo $rekening->nama_pemilik ?></td>
	</tr>

</thead>
</table>
<hr>
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
		<td><?php echo "Rp.".number_format($transaksi->jumlah) ?></td>
		<td><?php echo $transaksi->harga ?></td>
		<td><?php echo $transaksi->total_harga ?></td>
	</tr>
<?php } ?>
</tbody>
</table>