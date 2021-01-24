<p>
	<a href="<?php echo base_url('admin/product/tambah') ?>" class="btn btn-success btn-lg" >
		<i class="fa fa-plus"></i> Tambah Baru
	</a>
</p>

<?php 
//notifikasi
if($this->session->flashdata('sukses')){
	echo '<p class="alert alert-success">';
	echo $this->session->flashdata('sukses');
	echo '</div>';
 }
 ?>

 <table class="table table-bordered" id="example1">
 	<thead>
 		<tr>
 			<th>NO</th>
 			<th>GAMBAR</th>
 			<th>NAMA</th>
 			<th>KATEGORI</th>
 			<th>HARGA</th>
 			<th>STATUS</th>
 			<th>ACTION</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php $no=1; foreach ($product as $product) { ?>
 		<tr>
 			<td><?php echo $no++ ?></td>
 			<td>
 				<img src="<?php echo base_url('assets/upload/image/thumbs/'.$product->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
 			</td>
 			<td><?php echo $product->nama_product ?></td>
 			<td><?php echo $product->nama_kategori ?></td>
 			<td><?php echo number_format($product->harga,'0',',','.') ?></td>
 			<td><?php echo $product->status_product ?></td>
 			<td>
 				<a href="<?php echo base_url('admin/product/gambar/'.$product->id_product) ?>" class="btn btn-success btn-xs" ><i class="fa fa-image"></i> Gambar (<?php echo $product->total_gambar ?>)</a>

 				<a href="<?php echo base_url('admin/product/edit/'.$product->id_product) ?>" class="btn btn-warning btn-xs" ><i class="fa fa-edit"></i> Edit</a>

 				<?php include('delete.php') ?>
 			</td>
 		</tr>
 	<?php } ?>
 	</tbody>
 </table>
